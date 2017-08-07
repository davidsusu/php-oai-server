<?php

namespace PatroNet\OaiPmhServer;

use PatroNet\Core\Request\Controller;
use PatroNet\Core\Request\Request;

class ListIdentifiersController implements Controller {
    
    private $oMainController;
    
    public function __construct(MainController $oMainController) {
        $this->oMainController = $oMainController;
    }
    
    public function handle(Request $oRequest) {
        $requestData = MainController::getRequestData($oRequest);
        
        $oRecordRepository = $this->oMainController->getModel()->getRecordRepository();
        
        try {
            $filter = self::extractFilterData($requestData);
        } catch (\Exception $oException) {
            return MainController::createXmlResponse(MainController::getErrorXmlString('badArgument', $oException->getMessage()), 400);
        }
        
        // TODO: check set
        
        $xmlContent = '<ListIdentifiers>';
        
        $found = false;
        foreach ($oRecordRepository->getAllByOaiFilter($filter['from'], $filter['until'], $filter['set']) as $oRecordEntity) {
            $found = true;
            $xmlContent .= self::getRecordHeaderXml($oRecordEntity);
        }
        
        if (!$found) {
            return MainController::createXmlResponse(MainController::getErrorXmlString('noRecordsMatch', 'No such record found'), 404);
        }
        
        $xmlContent .= '</ListIdentifiers>';
        
        return MainController::createXmlResponse($xmlContent);
    }
    
    public static function getRecordHeaderXml(\PatroNet\OaiPmhServer\Model\RecordEntity $oRecordEntity) {
        $setSpecValue = $oRecordEntity->getSetSpec();
        $setSpecValueArray = is_null($setSpecValue) ? [] : (is_array($setSpecValue) ? $setSpecValue : [$setSpecValue]);
        
        $xmlContent = '<header';
        if ($oRecordEntity->isDeleted()) {
            $xmlContent .= ' status="deleted"';
        }
        $xmlContent .= '>';
        $xmlContent .= '<identifier>' . htmlspecialchars($oRecordEntity->getIdentifier()) . '</identifier>';
        $xmlContent .= '<datestamp>' . htmlspecialchars($oRecordEntity->getLastChangeUtcDateTime()) . '</datestamp>';
        foreach ($setSpecValueArray as $setSpecValueItem) {
            $xmlContent .= '<setSpec>' . htmlspecialchars($setSpecValueItem) . '</setSpec>';
        }
        $xmlContent .= '</header>';
        
        return $xmlContent;
    }
    
    public static function extractFilterData($requestData) {
        $filter = ['from' => null, 'until' => null, 'set' => null];
        
        if (isset($requestData['from'])) {
            if (!self::checkDateString($requestData['from'])) {
                throw new \Exception("Malformed from value");
            }
            $filter['from'] = $requestData['from'];
        }
        
        if (isset($requestData['until'])) {
            if (!self::checkDateString($requestData['until'])) {
                throw new \Exception("Malformed until value");
            }
            if (isset($filter['from']) && strtotime($filter['from']) > strtotime($requestData['until'])) {
                throw new \Exception("From date can not be later than until date");
            }
            $filter['until'] = $requestData['until'];
        }
        
        if (isset($requestData['set'])) {
            $filter['set'] = $requestData['set'];
        }
        
        return $filter;
    }
    
    public static function checkDateString($date) {
        // TODO
        return true;
    }
    
}
