<?php

namespace PatroNet\OaiPmhServer;

use PatroNet\Core\Request\Controller;
use PatroNet\Core\Request\Request;

class ListSetsController implements Controller {
    
    private $oMainController;
    
    public function __construct(MainController $oMainController) {
        $this->oMainController = $oMainController;
    }
    
    public function handle(Request $oRequest) {
        $requestData = MainController::getRequestData($oRequest);
        
        if (!$this->oMainController->getModel()->supportsSets()) {
            return MainController::createXmlResponse(MainController::getErrorXmlString('noSetHierarchy', 'The repository does not support sets'), 404);
        }
        
        $oSetRepository = $this->oMainController->getModel()->getSetRepository();
        
        $xmlContent = '<ListSets>';
        
        foreach ($oSetRepository->getAll() as $oSetEntity) {
            $xmlContent .= '<set>';
            $xmlContent .= '<setSpec>' . htmlspecialchars($oSetEntity->getSpec()) . '</setSpec>';
            $xmlContent .= '<setName>' . htmlspecialchars($oSetEntity->getName()) . '</setName>';
            $xmlContent .= '</set>';
        }
        
        $xmlContent .= '</ListSets>';
        
        return MainController::createXmlResponse($xmlContent);
    }
    
}
