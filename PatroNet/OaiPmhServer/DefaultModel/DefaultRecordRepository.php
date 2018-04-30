<?php

namespace PatroNet\OaiPmhServer\DefaultModel;

use PatroNet\Core\Database\ActiveRecord;
use PatroNet\Core\Entity\TableRepository;
use PatroNet\OaiPmhServer\Util;
use PatroNet\OaiPmhServer\Model\RecordRepository;

/**
 * @method DefaultRecordEntity create()
 * @method DefaultRecordEntity get(mixed $id)
 * @method DefaultRecordEntity[]|\PatroNet\Core\Database\ResultSet getAll(int[] $idList = null, string[string] $order = null, mixed $limit = null)
 * @method DefaultRecordEntity[]|\PatroNet\Core\Database\ResultSet getAllByFilter(mixed $filter = null, string[string] $order = null, mixed $limit = null)
 */
class DefaultRecordRepository extends TableRepository implements RecordRepository {
    
    private $oModel;
    
    public function __construct(DefaultModel $oModel)
    {
        $this->oModel = $oModel;
        parent::__construct($oTable = $oModel->getConnection()->getTable($oModel->getTablePrefix() . "item", "item_id", "item"));
        $oTable->addJoin("item2set", ["item.item_id" => "item2set.item_id"], $oModel->getTablePrefix() . "item2set");
        $oTable->addJoin("set", ["set.set_id" => "item2set.set_id"], $oModel->getTablePrefix() . "set");
    }

    /**
     * @param \PatroNet\Core\Database\ActiveRecord $oActiveRecord
     * @return DefaultRecordEntity;
     */
    protected function wrapActiveRecordToEntity(ActiveRecord $oActiveRecord)
    {
        return new DefaultRecordEntity($this->oModel, $oActiveRecord);
    }
    
    public function getAllByOaiFilter($fromDateTime, $untilDateTime, $setSpec) {
        $filter = null;
        
        if (!is_null($fromDateTime)) {
            $reformattedFromDateTime = $this->reformatDate($fromDateTime);
            $filter["item.datetime_changed"] = [">=", $reformattedFromDateTime];
        }
        
        if (!is_null($untilDateTime)) {
            $reformattedUntilDateTime = $this->reformatDate($untilDateTime);
            if (empty($filter["item.datetime_changed"])) {
                $reformattedFromDateTime = $filter["item.datetime_changed"][1];
                $filter["item.datetime_changed"] = ["between", [$reformattedFromDateTime, $reformattedUntilDateTime]];
            } else {
                $filter["item.datetime_changed"] = ["<", $reformattedUntilDateTime];
            }
        }
        
        if (!is_null($setSpec)) {
            $oSet = $this->oModel->getSetRepository()->getBySpec($setSpec);
            $setId = $oSet ? $oSet->getId() : null;
            $filter["item2set.set_id"] = $setId;
        }
        
        return $this->getAllByFilter($filter);
    }
    
    public function getByIdentifier($identifier) {
        $records = $this->getAllByFilter(['oai_identifier' => $identifier], null, 1)->fetchAll();
        
        if (empty($records)) {
            return null;
        }
        
        return $records[0];
    }
    
    public function getEarliestChangeUtcDateTime() {
        $records = $this->getAllByFilter(null, ['datetime_changed' => 'asc'], 1)->fetchAll();
        
        if (empty($records)) {
            return Util::toUtc(time());
        } else {
            return $records[0]->getLastChangeUtcDateTime();
        }
    }
    
    public static function reformatDate($utcDate) {
        return date("Y-m-d H:i:s", strtotime($utcDate));
    }
    
}
