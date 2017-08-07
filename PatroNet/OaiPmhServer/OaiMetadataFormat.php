<?php

namespace PatroNet\OaiPmhServer;

interface OaiMetadataFormat {
    
    public function getMetadataPrefix();
    
    public function getSchema();
    
    public function getMetadataNamespace();
    
    public function getRecordMetadataXml(Model\RecordEntity $oRecordEntity);
    
}
