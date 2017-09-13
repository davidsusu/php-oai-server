<?php

namespace PatroNet\OaiPmhServer\Model;

interface OaiModel {
    
    /**
     * @return string
     */
    public function getRepositoryName();
    
    /**
     * @return string[]
     */
    public function getAdminEmails();
    
    /**
     * @return string
     */
    public function getEarliestDatestamp();
    
    /**
     * @return string
     */
    public function getDeletedRecordPolicy();
    
    /**
     * @return boolean
     */
    public function supportsSets();
    
    /**
     * @return SetRepository
     */
    public function getSetRepository();
    
    /**
     * @return RecordRepository
     */
    public function getRecordRepository();
    
}

