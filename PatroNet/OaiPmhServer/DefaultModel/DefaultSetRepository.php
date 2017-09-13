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
        $oTable->addRelation("item2set", ["set.set_id" => "item2set.set_id"], $oModel->getTablePrefix() . "item2set");
        $oTable->addRelation("item", ["item.item_id" => "item2set.item_id"], $oModel->getTablePrefix() . "item");
    }

    /**
     * @param \PatroNet\Core\Database\ActiveRecord $oActiveRecord
     * @return DefaultSetEntity;
     */
    protected function wrapActiveRecordToEntity(ActiveRecord $oActiveRecord)
    {
        return new DefaultSetEntity($this->oModel, $oActiveRecord);
    }
    
    public function getBySpec($spec) {
        $oSetTable = $this->getTable();
        $tokens = explode(".", $spec);
        $setId = 0;
        foreach ($tokens as $token) {
            $setRow = $oSetTable->getFirst(["parent_id" => $setId, "key" => $token], null, ["set_id"]);
            if (empty($setRow)) {
                return null;
            }
            $setId = $setRow["set_id"];
        }
        $oSet = $this->get($setId);
        return $oSet;
    }
    
    public function getSetsInOrder($setId = 0) {
        $result = [];
        
        $sets = $this->oModel->getSetRepository()->getAllByFilter(["parent_id" => $setId], ["name" => "asc"]);
        foreach ($sets as $oSet) {
            $result[] = $oSet;
            $result = array_merge($result, self::getSetsInOrder($oSet->getId()));
        }
        
        return $result;
    }
    
}
