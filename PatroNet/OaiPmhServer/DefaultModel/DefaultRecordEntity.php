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
    
    public function getTitle() {
        return $this->oActiveRecord["title"];
    }
    
    public function setTitle($title) {
        $this->oActiveRecord["title"] = $title;
        return $this;
    }
    
    public function getCreator() {
        return $this->oActiveRecord["creator"];
    }
    
    public function setCreator($creator) {
        $this->oActiveRecord["creator"] = $creator;
        return $this;
    }
    
    public function getSubject() {
        return $this->oActiveRecord["subject"];
    }
    
    public function setSubject($subject) {
        $this->oActiveRecord["subject"] = $subject;
        return $this;
    }
    
    public function getDescription() {
        return $this->oActiveRecord["description"];
    }
    
    public function setDescription($description) {
        $this->oActiveRecord["description"] = $description;
        return $this;
    }
    
    public function getPublisher() {
        return $this->oActiveRecord["publisher"];
    }
    
    public function setPublisher($publisher) {
        $this->oActiveRecord["publisher"] = $publisher;
        return $this;
    }
    
    public function getContributor() {
        return $this->oActiveRecord["contributor"];
    }
    
    public function setContributor($contributor) {
        $this->oActiveRecord["contributor"] = $contributor;
        return $this;
    }
    
    public function getDate() {
        return $this->oActiveRecord["date"];
    }
    
    public function setDate($date) {
        $this->oActiveRecord["date"] = $date;
        return $this;
    }
    
    public function getType() {
        return $this->oActiveRecord["type"];
    }
    
    public function setType($type) {
        $this->oActiveRecord["type"] = $type;
        return $this;
    }
    
    public function getFormat() {
        return $this->oActiveRecord["format"];
    }
    
    public function setFormat($format) {
        $this->oActiveRecord["format"] = $format;
        return $this;
    }
    
    public function getSource() {
        return $this->oActiveRecord["source"];
    }
    
    public function setSource($source) {
        $this->oActiveRecord["source"] = $source;
        return $this;
    }
    
    public function getLanguage() {
        return $this->oActiveRecord["language"];
    }
    
    public function setLanguage($language) {
        $this->oActiveRecord["language"] = $language;
        return $this;
    }
    
    public function getRelation() {
        return $this->oActiveRecord["relation"];
    }
    
    public function setRelation($relation) {
        $this->oActiveRecord["relation"] = $relation;
        return $this;
    }
    
    public function getCoverage() {
        return $this->oActiveRecord["coverage"];
    }
    
    public function setCoverage($coverage) {
        $this->oActiveRecord["coverage"] = $coverage;
        return $this;
    }
    
    public function getRights() {
        return $this->oActiveRecord["rights"];
    }
    
    public function setRights($rights) {
        $this->oActiveRecord["rights"] = $rights;
        return $this;
    }
    
    public function getSetSpec() {
        return $this->oActiveRecord["set_spec"];
    }
    
    public function setSetSpec($setSpec) {
        $this->oActiveRecord["set_spec"] = $setSpec;
        return $this;
    }
    
    public function requestDeletion() {
        if ($oModel->getDeletedRecordPolicy() == 'no') {
            return $this->delete();
        } else {
            return $this->setDeleted(true)->save();
        }
    }
    
}
