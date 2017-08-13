<?php

namespace PatroNet\OaiPmhServer\Model;

interface RecordEntity {
    
    /*
     * @return string
     */
    public function getLastChangeUtcDateTime();
    
    /*
     * @return boolean
     */
    public function isDeleted();
    
    /*
     * @param boolean $deleted
     */
    public function setDeleted($deleted);
    
    /*
     * @return string
     */
    public function getIdentifier();
    
    /*
     * @param string $identifier
     */
    public function setIdentifier($identifier);
    
    /*
     * @return string|string[]|null
     */
    public function getTitle();
    
    /*
     * @param string|string[]|null $title
     */
    public function setTitle($title);
    
    /*
     * @return string|string[]|null
     */
    public function getCreator();
    
    /*
     * @param string|string[]|null $creator
     */
    public function setCreator($creator);
    
    /*
     * @return string|string[]|null
     */
    public function getSubject();
    
    /*
     * @param string|string[]|null $subject
     */
    public function setSubject($subject);
    
    /*
     * @return string|string[]|null
     */
    public function getDescription();
    
    /*
     * @param string|string[]|null $description
     */
    public function setDescription($description);
    
    /*
     * @return string|string[]|null
     */
    public function getPublisher();
    
    /*
     * @param string|string[]|null $publisher
     */
    public function setPublisher($publisher);
    
    /*
     * @return string|string[]|null
     */
    public function getContributor();
    
    /*
     * @param string|string[]|null $contributor
     */
    public function setContributor($contributor);
    
    /*
     * @return string|string[]|null
     */
    public function getDate();
    
    /*
     * @param string|string[]|null $date
     */
    public function setDate($date);
    
    /*
     * @return string|string[]|null
     */
    public function getType();
    
    /*
     * @param string|string[]|null $type
     */
    public function setType($type);
    
    /*
     * @return string|string[]|null
     */
    public function getFormat();
    
    /*
     * @param string|string[]|null $format
     */
    public function setFormat($format);
    
    /*
     * @return string|string[]|null
     */
    public function getSource();
    
    /*
     * @param string|string[]|null $source
     */
    public function setSource($source);
    
    /*
     * @return string|string[]|null
     */
    public function getLanguage();
    
    /*
     * @param string|string[]|null $language
     */
    public function setLanguage($language);
    
    /*
     * @return string|string[]|null
     */
    public function getRelation();
    
    /*
     * @param string|string[]|null $relation
     */
    public function setRelation($relation);
    
    /*
     * @return string|string[]|null
     */
    public function getCoverage();
    
    /*
     * @param string|string[]|null $coverage
     */
    public function setCoverage($coverage);
    
    /*
     * @return string|string[]|null
     */
    public function getRights();
    
    /*
     * @param string|string[]|null $rights
     */
    public function setRights($rights);
    
    /*
     * @return string|string[]|null
     */
    public function getSetSpec();
    
    /*
     * @param string|string[]|null $setSpec
     */
    public function setSetSpec($setSpec);
    
}
