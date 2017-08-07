<?php

namespace PatroNet\OaiPmhServer\Model;

interface RecordRepository {
    
    /**
     * @return RecordEntity[]|Iterator
     */
    public function getAllByOaiFilter($fromDateTime, $untilDateTime, $setSpec);
    
    /**
     * @param string $identifier
     * @return RecordEntity|null
     */
    public function getByIdentifier($identifier);
    
    public function getEarliestChangeUtcDateTime();
}
