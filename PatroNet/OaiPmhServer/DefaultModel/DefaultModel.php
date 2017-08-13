<?php

namespace PatroNet\OaiPmhServer\DefaultModel;

use PatroNet\Core\Database\Connection;
use PatroNet\OaiPmhServer\Model\OeiModel;

class DefaultModel implements OeiModel {
    
    
    private static $defaultSettings = [
        'repositoryName' => 'OAI repository',
        'adminEmails' => [],
        'tablePrefix' => 'oai_',
        'deletedRecordPolicy' => 'persistent',
        'supportsSets' => true,
    ];
    
    
    private $oConnection;
    
    private $settings;
    
    private $oSetRepository = null;
    
    private $oRecordRepository = null;
    
    
    public function __construct(Connection $oConnection, $settings = []) {
        $this->oConnection = $oConnection;
        $this->settings = array_merge(self::$defaultSettings, $settings);
    }
    
    public function getRepositoryName() {
        return $this->settings['repositoryName'];
    }
    
    public function getAdminEmails() {
        return $this->settings['adminEmails'];
    }
    
    public function getDeletedRecordPolicy() {
        return $this->settings['deletedRecordPolicy'];
    }
    
    public function getEarliestDatestamp() {
        return $this->getRecordRepository()->getEarliestChangeUtcDateTime();
    }
    
    public function supportsSets() {
        return $this->settings['supportsSets'];
    }
    
    public function getConnection() {
        return $this->oConnection;
    }
    
    public function getTablePrefix() {
        return $this->settings['tablePrefix'];
    }
    
    public function getSetRepository() {
        if (is_null($this->oSetRepository)) {
            $this->oSetRepository = new DefaultSetRepository($this);
        }
        return $this->oSetRepository;
    }
    
    public function getRecordRepository() {
        if (is_null($this->oRecordRepository)) {
            $this->oRecordRepository = new DefaultRecordRepository($this);
        }
        return $this->oRecordRepository;
    }
    
}
