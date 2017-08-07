<?php

namespace PatroNet\OaiPmhServer;

use PatroNet\Core\Request\Controller;
use PatroNet\Core\Request\Request;

class ListRecordsController implements Controller {
    
    private $oMainController;
    
    public function __construct(MainController $oMainController) {
        $this->oMainController = $oMainController;
    }
    
    public function handle(Request $oRequest) {
        $requestData = MainController::getRequestData($oRequest);
        
        if (!isset($requestData['metadataPrefix'])) {
            return MainController::createXmlResponse(MainController::getErrorXmlString('badArgument', 'Missing metadataPrefix'), 501);
        }
        
        $oRecordRepository = $this->oMainController->getModel()->getRecordRepository();
        
        $oMetadataFormat = $this->oMainController->getMetadataFormat($requestData['metadataPrefix']);
        
        if (empty($oMetadataFormat)) {
            return MainController::createXmlResponse(MainController::getErrorXmlString('cannotDisseminateFormat', 'Unknown metadata format'), 501);
        }
        
        try {
            $filter = ListIdentifiersController::extractFilterData($requestData);
        } catch (\Exception $oException) {
            return MainController::createXmlResponse(MainController::getErrorXmlString('badArgument', $oException->getMessage()), 400);
        }
        
        // TODO: check set
        
        $xmlContent = '<ListRecords>';
        
        $found = false;
        foreach ($oRecordRepository->getAllByOaiFilter($filter['from'], $filter['until'], $filter['set']) as $oRecordEntity) {
            $found = true;
            $xmlContent .= GetRecordController::getRecordXml($oRecordEntity, $oMetadataFormat);
        }
        
        if (!$found) {
            return MainController::createXmlResponse(MainController::getErrorXmlString('noRecordsMatch', 'No such record found'), 404);
        }
        
        $xmlContent .= '</ListRecords>';
        
        return MainController::createXmlResponse($xmlContent);
    }
    
}
