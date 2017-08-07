<?php

namespace PatroNet\OaiPmhServer\DefaultModel;

use PatroNet\Core\Database\ActiveRecord;
use PatroNet\Core\Entity\TableRepository;
use PatroNet\OaiPmhServer\Model\SetRepository;

/**
 * @method DefaultSetEntity create()
 * @method DefaultSetEntity get(mixed $id)
 * @method DefaultSetEntity[]|\PatroNet\Core\Database\ResultSet getAll(int[] $idList = null, string[string] $order = null, mixed $limit = null)
 * @method DefaultSetEntity[]|\PatroNet\Core\Database\ResultSet getAllByFilter(mixed $filter = null, string[string] $order = null, mixed $limit = null)
 */
class DefaultSetRepository extends TableRepository implements SetRepository {
    
    private $oModel;
    
    public function __construct(DefaultModel $oModel)
    {
        $this->oModel = $oModel;
        parent::__construct($oTable = $oModel->getConnection()->getTable($oModel->getTablePrefix() . "set", "set_id", "set"));
    }

    /**
     * @param \PatroNet\Core\Database\ActiveRecord $oActiveRecord
     * @return DefaultSetEntity;
     */
    protected function wrapActiveRecordToEntity(ActiveRecord $oActiveRecord)
    {
        return new DefaultSetEntity($this->oModel, $oActiveRecord);
    }
    
}
