<?php

namespace PatroNet\OaiPmhServer\DefaultModel;

use PatroNet\Core\Database\ActiveRecord;
use PatroNet\Core\Entity\ActiveRecordEntity;
use PatroNet\OaiPmhServer\Model\SetEntity;
use PatroNet\Cms\Modules\OaiPmh\Constants;
use PatroNet\Core\Database\Table;

class DefaultSetEntity extends ActiveRecordEntity implements SetEntity {
    
    private $oModel;
    
    private $oItemSetTable;
    
    public function __construct(DefaultModel $oModel, ActiveRecord $oActiveRecord)
    {
        parent::__construct($oActiveRecord);
        $this->oModel = $oModel;
        $this->oItemSetTable = $this->oModel->getConnection()->getTable(Constants::TABLE_PREFIX . "item2set");
    }
    
    public function getParent() {
        $parentId = $this->getActiveRecord()["parent_id"];
        if (empty($parentId)) {
            return null;
        }
        return $this->oModel->getSetRepository()->get($parentId);
    }
    
    public function setParent($idOrSetEntity) {
        $parentId = ($idOrSetEntity instanceof SetEntity) ? $idOrSetEntity->getId() : $idOrSetEntity;
    }
    
    public function getChildren() {
        return $this->oModel->getSetRepository()->getAllByFilter(["parent_id" => $this->getId()], ["name" => "asc"]);
    }
    
    public function getRecords() {
        return $this->oModel->getRecordRepository()->getAllByFilter(["item2set.set_id" => $this->getId()], ["item.item_id" => "asc"]);
    }
    
    public function getSpec() {
        $path = [];
        $oSet = $this;
        do {
            $path[] = $oSet->getKey();
            $oSet = $oSet->getParent();
        } while(!empty($oSet));
        $spec = implode(".", array_reverse($path));
        return $spec;
    }
    
    public function getKey() {
        return $this->oActiveRecord["key"];
    }
    
    public function setKey($key) {
        $this->oActiveRecord["key"] = $key;
    }
    
    public function getName() {
        return $this->oActiveRecord["name"];
    }
    
    public function getNamePath() {
        $namePath = [];
        $oSet = $this;
        do {
            $namePath[] = $oSet->getName();
            $oSet = $oSet->getParent();
        } while (!empty($oSet));
        $namePath = array_reverse($namePath);
        return $namePath;
    }
    
    public function setName($name) {
        $this->oActiveRecord["name"] = $name;
    }
    
    public function save() {
        if (!parent::save()) {
            return false;
        }
        
        return true;
    }
    
    public function delete() {
        foreach ($this->getChildren() as $oChildSet) {
            if (!$oChildSet->delete()) {
                return false;
            }
        }
        
        $this->oItemSetTable->save(["set_id" => null, ["set_id" => $this->getId()], Table::SAVETYPE_UPDATE_ALL]);
        
        return parent::delete();
    }
    
}
