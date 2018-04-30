<?php

namespace PatroNet\OaiPmhServer\DefaultModel;

use PatroNet\Core\Database\ActiveRecord;
use PatroNet\Core\Entity\ActiveRecordEntity;
use PatroNet\OaiPmhServer\Util;
use PatroNet\OaiPmhServer\Model\RecordEntity;
use PatroNet\OaiPmhServer\Model\RecordEntityTrait;
use PatroNet\Core\Database\Table;
use PatroNet\OaiPmhServer\Model\SetEntity;

class DefaultRecordEntity extends ActiveRecordEntity implements RecordEntity {
    
    use RecordEntityTrait;
    
    private $oModel;
    
    private $oItemSetTable;
    
    private $oMetaTable;
    
    private $metaValuesToSaveMap = [];
    
    public function __construct(DefaultModel $oModel, ActiveRecord $oActiveRecord)
    {
        parent::__construct($oActiveRecord);
        $this->oModel = $oModel;
        $this->oItemSetTable = $this->oModel->getConnection()->getTable($oModel->getTablePrefix() . "item2set");
        $this->oMetaTable = $this->oModel->getConnection()->getTable($oModel->getTablePrefix() . "item_meta");
    }
    
    public function getLastChangeUtcDateTime() {
        return Util::toUtc($this->oActiveRecord["datetime_changed"]);
    }
    
    public function isDeleted() {
        return !empty($this->oActiveRecord["is_deleted"]);
    }
    
    public function setDeleted($deleted) {
        $this->oActiveRecord["is_deleted"] = $deleted ? 1 : 0;
        return $this;
    }
    
    public function getIdentifier() {
        return $this->oActiveRecord["oai_identifier"];
    }
    
    public function setIdentifier($identifier) {
        $this->oActiveRecord["oai_identifier"] = $identifier;
        return $this;
    }
    
    
    public function getSets() {
        return $this->oModel->getSetRepository()->getAllByFilter(["item2set.item_id" => $this->getId()], ["set.name" => "asc"]);
    }
    
    public function setSets($sets) {
        $id = $this->getId();
        
        if (!$this->oItemSetTable->deleteAll(["item_id" => $id])->isSuccess()) {
            return false;
        }
        
        foreach ($sets as $set) {
            $setId = ($set instanceof SetEntity) ? $set->getId() : $set;
            if (!$this->oItemSetTable->save(["item_id" => $id, "set_id" => $setId])->isSuccess()) {
                return false;
            }
        }
        
        return true;
    }
    
    
    public function getMetaValues($key) {
        if (isset($this->metaValuesToSaveMap[$key])) {
            return $this->metaValuesToSaveMap[$key];
        } else if ($this->isStored()) {
            return $this->oMetaTable->getColumn("value", ["item_id" => $this->getId(), "key" => $key], ["value" => "asc"]);
        } else {
            return [];
        }
    }
    
    public function setMetaValues($key, $values) {
        $this->metaValuesToSaveMap[$key] = $values;
    }
    
    public function requestDeletion() {
        if ($this->oModel->getDeletedRecordPolicy() == 'no') {
            return $this->delete();
        } else {
            return $this->setDeleted(true)->save();
        }
    }
    
    public function save() {
        $now = date("Y-m-d H:i:s");
        
        $wasStored = $this->isStored();
        
        if (!$wasStored) {
            $this->oActiveRecord["datetime_created"] = $now;
        }
        
        $this->oActiveRecord["datetime_changed"] = $now;
        
        if (!parent::save()) {
            return false;
        }
        
        $id = $this->getId();
        
        foreach ($this->metaValuesToSaveMap as $key => $values) {
            if ($wasStored) {
                $this->oMetaTable->deleteAll(["item_id" => $id, "key" => $key]);
            }
            foreach ($values as $value) {
                $this->oMetaTable->save(["item_id" => $id, "key" => $key, "value" => $value]);
            }
        }
        
        return true;
    }
    
    public function delete() {
        $this->oMetaTable->deleteAll(["item_id" => $id]);
        
        $this->oItemSetTable->save(["item_id" => null, ["item_id" => $this->getId()], Table::SAVETYPE_UPDATE_ALL]);
        
        return parent::delete();
    }
    
}
