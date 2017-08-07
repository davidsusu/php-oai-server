<?php

namespace PatroNet\OaiPmhServer\DefaultModel;

use PatroNet\Core\Database\ActiveRecord;
use PatroNet\Core\Entity\ActiveRecordEntity;
use PatroNet\OaiPmhServer\Util;
use PatroNet\OaiPmhServer\Model\RecordEntity;

class DefaultRecordEntity extends ActiveRecordEntity implements RecordEntity {
    
    private $oModel;
    
    public function __construct(DefaultModel $oModel, ActiveRecord $oActiveRecord)
    {
        parent::__construct($oActiveRecord);
        $this->oModel = $oModel;
    }

    public function isDeleted() {
        return false;
    }
    
    public function getLastChangeUtcDateTime() {
        return Util::toUtc($this->oActiveRecord["datetime_changed"]);
    }
    
    public function getIdentifier() {
        return $this->oActiveRecord["oai_identifier"];
    }
    
    public function getTitle() {
        return $this->oActiveRecord["title"];
    }
    
    public function getCreator() {
        return $this->oActiveRecord["creator"];
    }
    
    public function getSubject() {
        return $this->oActiveRecord["subject"];
    }
    
    public function getDescription() {
        return $this->oActiveRecord["description"];
    }
    
    public function getPublisher() {
        return $this->oActiveRecord["publisher"];
    }
    
    public function getContributor() {
        return $this->oActiveRecord["contributor"];
    }
    
    public function getDate() {
        return $this->oActiveRecord["date"];
    }
    
    public function getType() {
        return $this->oActiveRecord["type"];
    }
    
    public function getFormat() {
        return $this->oActiveRecord["format"];
    }
    
    public function getSource() {
        return $this->oActiveRecord["source"];
    }
    
    public function getLanguage() {
        return $this->oActiveRecord["language"];
    }
    
    public function getRelation() {
        return $this->oActiveRecord["relation"];
    }
    
    public function getCoverage() {
        return $this->oActiveRecord["coverage"];
    }
    
    public function getRights() {
        return $this->oActiveRecord["rights"];
    }
    
    public function getSetSpec() {
        return $this->oActiveRecord["set_spec"];
    }
    
    public function requestDeletion() {
        if ($oModel->getDeletedRecordPolicy() == 'no') {
            return $this->delete();
        } else {
            $this->oActiveRecord["is_deleted"] = 1;
            return $this->save();
        }
    }
    
}
