<?php

namespace PatroNet\OaiPmhServer\Model;

interface OeiModel {
    
    public function getRepositoryName();
    
    public function getAdminEmails();
    
    public function getEarliestDatestamp();
    
    public function getDeletedRecordPolicy();
    
    public function supportsSets();
    
    public function getSetRepository();
    
    public function getRecordRepository();
    
}

