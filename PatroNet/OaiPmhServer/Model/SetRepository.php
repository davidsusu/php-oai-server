<?php

namespace PatroNet\OaiPmhServer\Model;

interface SetRepository {
    
    /**
     * @return SetEntity[]|Iterator
     */
    public function getAll();
    
}
