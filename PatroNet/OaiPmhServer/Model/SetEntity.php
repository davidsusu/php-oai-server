<?php

namespace PatroNet\OaiPmhServer\Model;

interface SetEntity {
    
    /**
     * @return string
     */
    public function getSpec();
    
    /**
     * @param string $spec
     */
    public function setSpec($spec);
    
    /**
     * @return string
     */
    public function getName();
    
    /**
     * @param string $name
     */
    public function setName($name);
    
}
