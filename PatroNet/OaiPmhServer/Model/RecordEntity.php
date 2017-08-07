<?php

namespace PatroNet\OaiPmhServer\Model;

interface RecordEntity {
    
    /*
     * @return boolean
     */
    public function isDeleted();
    
    /*
     * @return string
     */
    public function getLastChangeUtcDateTime();
    
    /*
     * @return string|string[]|null
     */
    public function getIdentifier();
    
    /*
     * @return string|string[]|null
     */
    public function getTitle();
    
    /*
     * @return string|string[]|null
     */
    public function getCreator();
    
    /*
     * @return string|string[]|null
     */
    public function getSubject();
    
    /*
     * @return string|string[]|null
     */
    public function getDescription();
    
    /*
     * @return string|string[]|null
     */
    public function getPublisher();
    
    /*
     * @return string|string[]|null
     */
    public function getContributor();
    
    /*
     * @return string|string[]|null
     */
    public function getDate();
    
    /*
     * @return string|string[]|null
     */
    public function getType();
    
    /*
     * @return string|string[]|null
     */
    public function getFormat();
    
    /*
     * @return string|string[]|null
     */
    public function getSource();
    
    /*
     * @return string|string[]|null
     */
    public function getLanguage();
    
    /*
     * @return string|string[]|null
     */
    public function getRelation();
    
    /*
     * @return string|string[]|null
     */
    public function getCoverage();
    
    /*
     * @return string|string[]|null
     */
    public function getRights();
    
    /*
     * @return string|string[]|null
     */
    public function getSetSpec();
    
}
