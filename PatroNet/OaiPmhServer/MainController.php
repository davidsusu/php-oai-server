<?php

namespace PatroNet\OaiPmhServer;

use PatroNet\Core\Content\ContentSourceList;
use PatroNet\Core\Content\StaticSource;
use PatroNet\Core\Request\Controller;
use PatroNet\Core\Request\Request;
use PatroNet\Core\Request\ResponseBuilder;

class MainController implements Controller {
    
    private $oModel;
    
    private $xslUrl;
    
    private $metadataFormats = [];
    
    public function __construct(Model\OeiModel $oModel, $xslUrl = null) {
        $this->oModel = $oModel;
        $this->xslUrl = $xslUrl;
        
        $this->registerMetadataFormat(new DcMetadataFormat());
    }
    
    public function getModel() {
        return $this->oModel;
    }
    
    public function getMetadataFormats() {
        return $this->metadataFormats;
    }
    
    public function getMetadataFormat($metadataPrefix) {
        return isset($this->metadataFormats[$metadataPrefix]) ? $this->metadataFormats[$metadataPrefix] : null;
    }
    
    public function registerMetadataFormat(OaiMetadataFormat $oMetadataFormat) {
        $this->metadataFormats[$oMetadataFormat->getMetadataPrefix()] = $oMetadataFormat;
    }
    
    public function handle(Request $oRequest) {
        $oSubResponse = $this->getSubResponse($oRequest);
        
        $requestXmlString = $this->getRequestXmlString($oRequest, $oSubResponse->getHttpStatus() == 200);
        $currentDateTimeStamp = Util::toUtc(time());
        
        $oContentSourceList = new ContentSourceList();
        $oContentSourceList->add(new StaticSource('<?xml version="1.0" encoding="UTF-8"?>'));
        if (!is_null($this->xslUrl)) {
            $oContentSourceList->add(new StaticSource('<?xml-stylesheet type="text/xsl" href="' . htmlspecialchars($this->xslUrl) . '" ?>'));
        }
        $oContentSourceList->add(new StaticSource('
            <OAI-PMH
                xmlns="http://www.openarchives.org/OAI/2.0/"
                xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
                xsi:schemaLocation="http://www.openarchives.org/OAI/2.0/ http://www.openarchives.org/OAI/2.0/OAI-PMH.xsd"
            >
                <responseDate>' . $currentDateTimeStamp . '</responseDate>
                ' . $requestXmlString . '
        '));
        $oContentSourceList->add($oSubResponse->getContentSource());
        $oContentSourceList->add(new StaticSource('
            </OAI-PMH>
        '));
        
        return (new ResponseBuilder())
            ->setHttpStatus($oSubResponse->getHttpStatus())
            ->addHeader('Content-type: text/xml; charset=utf-8')
            ->setContentSource($oContentSourceList)
        ->build();
    }
    
    private function getRequestXmlString(Request $oRequest, $includeAttributes = true) {
        $requestData = self::getRequestData($oRequest);
        
        $baseUrl = self::getBaseUrl($oRequest);
        
        $result = '<request';
        if ($includeAttributes) {
            foreach ($requestData as $key => $value) {
                $result .= ' ' . $key . '="' . htmlspecialchars($value) . '"';
            }
        }
        $result .= '>';
        $result .= htmlspecialchars($baseUrl);
        $result .= '</request>';
        
        return $result;
    }
    
    private function getSubResponse(Request $oRequest) {
        $availableVerbs = ['Identify', 'ListMetadataFormats', 'ListSets', 'GetRecord', 'ListIdentifiers', 'ListRecords'];
        
        if (!in_array($oRequest->getMethod(), ['GET', 'POST'])) {
            return self::createXmlResponse(self::getErrorXmlString('badArgument', 'Unsupported HTTP method: ' . $oRequest->getMethod()), 405);
        }
        
        $requestData = self::getRequestData($oRequest);
        $baseUrl = self::getBaseUrl($oRequest);
        
        if (!isset($requestData['verb'])) {
            return self::createXmlResponse(self::getErrorXmlString('badVerb', 'Missing OAI verb'), 400);
        }
        
        if (!in_array($requestData['verb'], $availableVerbs)) {
            return self::createXmlResponse(self::getErrorXmlString('badVerb', 'Illegal OAI verb'), 400);
        }
        
        if (isset($requestData['resumptionToken'])) {
            return self::createXmlResponse(self::getErrorXmlString('badResumptionToken', 'Currently resumptionToken is not supported'), 400);
        }
        
        $subControllerClass = __NAMESPACE__ . '\\' . $requestData['verb'] . 'Controller';
        if (!class_exists($subControllerClass)) {
            return self::createXmlResponse(self::getErrorXmlString('badVerb', 'Not implemented'), 501);
        }
        
        $oSubController = new $subControllerClass($this);
        
        return $oSubController->handle($oRequest);
    }
    
    public static function getBaseUrl(Request $oRequest) {
        return 'http' . (empty($_SERVER['HTTPS']) ? '' : 's') . '://' . $_SERVER["HTTP_HOST"] . '/' . $oRequest->getPath();;
    }
    
    public static function getRequestData(Request $oRequest) {
        return $oRequest->getMethod() == 'GET' ? $oRequest->getGet() : $oRequest->getPost();
    }
    
    public static function getErrorXmlString($code, $description = '') {
        return '<error code="' . htmlspecialchars($code) . '">' . htmlspecialchars($description) . '</error>';
    }
    
    public static function createXmlResponse($xmlContent, $httpStatus = 200, $complete = false, $charset = 'utf-8') {
        return (new ResponseBuilder())
            ->setHttpStatus($httpStatus)
            ->addHeader('Content-type: text/xml; charset=' . $charset)
            ->setContent($xmlContent)
            ->setComplete($complete)
        ->build();
    }
    
}
