<?php

namespace PatroNet\OaiPmhServer;

class DcMetadataFormat implements OaiMetadataFormat {
    
    public function getMetadataPrefix() {
        return "oai_dc";
    }
    
    public function getSchema() {
        return "http://www.openarchives.org/OAI/2.0/oai_dc.xsd";
    }
    
    public function getMetadataNamespace() {
        return "http://www.openarchives.org/OAI/2.0/oai_dc/";
    }
    
    public function getRecordMetadataXml(Model\RecordEntity $oRecordEntity) {
        $fieldNames = [
            'identifier', 'title', 'creator', 'subject', 'description', 'publisher', 'contributor',
            'date', 'type', 'format', 'source', 'language', 'relation', 'coverage', 'rights',
        ];
        
        $xmlContent = '<metadata>';
        $xmlContent .= '<oai_dc:dc 
             xmlns:oai_dc="http://www.openarchives.org/OAI/2.0/oai_dc/" 
             xmlns:dc="http://purl.org/dc/elements/1.1/" 
             xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" 
             xsi:schemaLocation="http://www.openarchives.org/OAI/2.0/oai_dc/ 
             http://www.openarchives.org/OAI/2.0/oai_dc.xsd"
         >';
        
        foreach ($fieldNames as $fieldName) {
            $method = 'get' . ucfirst($fieldName);
            $value = $oRecordEntity->$method();
            $valueArray = is_null($value) ? [] : (is_array($value) ? $value : [$value]);
            foreach ($valueArray as $valueItem) {
                $xmlContent .= '<dc:' . $fieldName . '>' . htmlspecialchars($valueItem) . '</dc:' . $fieldName . '>';
            }
        }
        
        $xmlContent .= '</oai_dc:dc>';
        $xmlContent .= '</metadata>';
        
        return $xmlContent;
    }
    
}
