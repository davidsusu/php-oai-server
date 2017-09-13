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
        $multiValueFieldMap = [
            'title' => 'getTitles',
            'creator' => 'getCreators',
            'subject' => 'getSubjects',
            'description' => 'getDescriptions',
            'publisher' => 'getPublishers',
            'contributor' => 'getContributors',
            'date' => 'getDates',
            'type' => 'getTypes',
            'format' => 'getFormats',
            'source' => 'getSources',
            'language' => 'getLanguages',
            'relation' => 'getRelations',
            'coverage' => 'getCoverages',
            'rights' => 'getRightses',
        ];
        
        $xmlContent = '<metadata>';
        $xmlContent .= '<oai_dc:dc 
             xmlns:oai_dc="http://www.openarchives.org/OAI/2.0/oai_dc/" 
             xmlns:dc="http://purl.org/dc/elements/1.1/" 
             xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" 
             xsi:schemaLocation="http://www.openarchives.org/OAI/2.0/oai_dc/ 
             http://www.openarchives.org/OAI/2.0/oai_dc.xsd"
         >';
        
        $xmlContent .= '<dc:identifier>' . htmlspecialchars($oRecordEntity->getIdentifier()) . '</dc:identifier>';
        
        foreach ($multiValueFieldMap as $fieldName => $methodName) {
            foreach ($oRecordEntity->$methodName() as $value) {
                $xmlContent .= '<dc:' . $fieldName . '>' . htmlspecialchars($value) . '</dc:' . $fieldName . '>';
            }
        }
        
        $xmlContent .= '</oai_dc:dc>';
        $xmlContent .= '</metadata>';
        
        return $xmlContent;
    }
    
}
