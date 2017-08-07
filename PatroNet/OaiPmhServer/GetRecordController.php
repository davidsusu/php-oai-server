<?php

namespace PatroNet\OaiPmhServer;

use PatroNet\Core\Request\Controller;
use PatroNet\Core\Request\Request;

class GetRecordController implements Controller {
    
    private $oMainController;
    
    public function __construct(MainController $oMainController) {
        $this->oMainController = $oMainController;
    }
    
    public function handle(Request $oRequest) {
        $requestData = MainController::getRequestData($oRequest);
        
        if (!isset($requestData['metadataPrefix'])) {
            return MainController::createXmlResponse(MainController::getErrorXmlString('badArgument', 'Missing metadataPrefix'), 501);
        }
        
        if (!isset($requestData['identifier'])) {
            return MainController::createXmlResponse(MainController::getErrorXmlString('badArgument', 'Missing identifier'), 501);
        }
        
        $oMetadataFormat = $this->oMainController->getMetadataFormat($requestData['metadataPrefix']);
        
        if (empty($oMetadataFormat)) {
            return MainController::createXmlResponse(MainController::getErrorXmlString('cannotDisseminateFormat', 'Unknown metadata format'), 501);
        }
        
        $oRecordRepository = $this->oMainController->getModel()->getRecordRepository();
        
        $oRecordEntity = $oRecordRepository->getByIdentifier($requestData['identifier']);
        
        if (empty($oRecordEntity)) {
            return MainController::createXmlResponse(MainController::getErrorXmlString('idDoesNotExist', 'Record not found'), 404);
        }
        
        $xmlContent = '<GetRecord>';
        $xmlContent .= self::getRecordXml($oRecordEntity, $oMetadataFormat);
        $xmlContent .= '</GetRecord>';
        
        return MainController::createXmlResponse($xmlContent);
    }
    
    public static function getRecordXml(Model\RecordEntity $oRecordEntity, OaiMetadataFormat $oMetadataFormat) {
        $xmlContent = '<record>';
        $xmlContent .= ListIdentifiersController::getRecordHeaderXml($oRecordEntity);
        $xmlContent .= $oMetadataFormat->getRecordMetadataXml($oRecordEntity);
        $xmlContent .= '</record>';
        return $xmlContent;
    }
    
}
