<?php

namespace PatroNet\OaiPmhServer;

use PatroNet\Core\Request\Controller;
use PatroNet\Core\Request\Request;

class ListMetadataFormatsController implements Controller {
    
    private $oMainController;
    
    public function __construct(MainController $oMainController) {
        $this->oMainController = $oMainController;
    }
    
    public function handle(Request $oRequest) {
        $requestData = MainController::getRequestData($oRequest);
        
        if (isset($requestData['identifier'])) {
            $oRecordRepository = $this->oMainController->getModel()->getRecordRepository();
            $oRecordEntity = $oRecordRepository->getByIdentifier($requestData['identifier']);
            if (empty($oRecordEntity)) {
                return MainController::createXmlResponse(MainController::getErrorXmlString('noMetadataFormats', 'There are no metadata formats available'), 404);
            }
        }
        
        $metadataFormats = $this->oMainController->getMetadataFormats();
        if (empty($metadataFormats)) {
            return MainController::createXmlResponse(MainController::getErrorXmlString('idDoesNotExist', 'Record not found'), 404);
        }
        
        $xmlContent = '<ListMetadataFormats>';
        
        foreach ($metadataFormats as $oMetadataFormat) {
            $xmlContent .= '<metadataFormat>';
            $xmlContent .= '<metadataPrefix>' . htmlspecialchars($oMetadataFormat->getMetadataPrefix()) . '</metadataPrefix>';
            $xmlContent .= '<schema>' . htmlspecialchars($oMetadataFormat->getSchema()) . '</schema>';
            $xmlContent .= '<metadataNamespace>' . htmlspecialchars($oMetadataFormat->getMetadataNamespace()) . '</metadataNamespace>';
            $xmlContent .= '</metadataFormat>';
        }
        
        $xmlContent .= '</ListMetadataFormats>';
        
        return MainController::createXmlResponse($xmlContent);
    }
    
}
