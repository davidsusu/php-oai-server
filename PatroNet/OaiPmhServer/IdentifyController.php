<?php

namespace PatroNet\OaiPmhServer;

use PatroNet\Core\Request\Controller;
use PatroNet\Core\Request\Request;

class IdentifyController implements Controller {
    
    private $oMainController;
    
    public function __construct(MainController $oMainController) {
        $this->oMainController = $oMainController;
    }
    
    public function handle(Request $oRequest) {
        $requestData = MainController::getRequestData($oRequest);
        
        $oModel = $this->oMainController->getModel();
        
        $xmlContent = '<Identify>';
        $xmlContent .= '<repositoryName>' . htmlspecialchars($oModel->getRepositoryName()) . '</repositoryName>';
        $xmlContent .= '<baseURL>' . htmlspecialchars(MainController::getBaseUrl($oRequest)) . '</baseURL>';
        $xmlContent .= '<protocolVersion>2.0</protocolVersion>';
        foreach ($oModel->getAdminEmails() as $adminEmail) {
            $xmlContent .= '<adminEmail>' . $adminEmail . '</adminEmail>';
        }
        $xmlContent .= '<earliestDatestamp>' . htmlspecialchars($oModel->getEarliestDatestamp()) . '</earliestDatestamp>';
        $xmlContent .= '<deletedRecord>' . htmlspecialchars($oModel->getDeletedRecordPolicy()) . '</deletedRecord>';
        $xmlContent .= '<granularity>YYYY-MM-DDThh:mm:ssZ</granularity>';
        $xmlContent .= '</Identify>';
        
        return MainController::createXmlResponse($xmlContent);
    }
    
}
