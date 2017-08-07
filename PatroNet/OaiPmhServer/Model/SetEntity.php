<?php

namespace PatroNet\OaiPmhServer\Model;

interface SetEntity {
    
    /**
     * @return string
     */
    public function getSpec();
    
    /**
     * @return string
     */
    public function getName();
    
}
