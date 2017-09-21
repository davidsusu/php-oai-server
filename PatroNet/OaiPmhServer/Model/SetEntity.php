<?php

namespace PatroNet\OaiPmhServer\Model;

interface SetEntity {
    
    /**
     * @return SetEntity|null
     */
    public function getParent();
    
    /**
     * @param SetEntity|null
     */
    public function setParent($idOrSetEntity);
    
    /**
     * @return \Traversable|\Countable|SetEntity[]
     */
    public function getChildren();
    
    /**
     * @return integer
     */
    public function getLevel();
    
    /**
     * @return \Traversable|\Countable|RecordEntity[]
     */
    public function getRecords();
    
    /**
     * @return string
     */
    public function getSpec();
    
    /**
     * @return string
     */
    public function getKey();
    
    /**
     * @param string $key
     */
    public function setKey($key);
    
    /**
     * @return string
     */
    public function getName();
    
    /**
     * @return string[]
     */
    public function getNamePath();
    
    /**
     * @param string $name
     */
    public function setName($name);
    
}
