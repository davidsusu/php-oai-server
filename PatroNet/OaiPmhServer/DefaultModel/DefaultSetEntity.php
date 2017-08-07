<?php

namespace PatroNet\OaiPmhServer\DefaultModel;

use PatroNet\Core\Database\ActiveRecord;
use PatroNet\Core\Entity\ActiveRecordEntity;
use PatroNet\OaiPmhServer\Model\SetEntity;

class DefaultSetEntity extends ActiveRecordEntity implements SetEntity {
    
    private $oModel;
    
    public function __construct(DefaultModel $oModel, ActiveRecord $oActiveRecord)
    {
        parent::__construct($oActiveRecord);
        $this->oModel = $oModel;
    }
    
    public function getSpec() {
        return $this->oActiveRecord["spec"];
    }
    
    public function getName() {
        return $this->oActiveRecord["name"];
    }
    
    public function delete()
    {
        $spec = $this->getSpec();
        
        $records = $this->oModel->getRecordRepository()->getAllByFilter([""]);
        foreach ($records as $oRecord) {
            // XXX
            $oRecord->getActiveRecord()["set_spec"] = null;
            $oRecord->save();
        }
        
        return parent::delete();
    }
}
