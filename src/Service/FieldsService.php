<?php

namespace Popov\ZfcFields\Service;

use Popov\ZfcCore\Service\DomainServiceAbstract;
use Popov\ZfcFields\Model\Repository\FieldsRepository;
use Popov\ZfcEntity\Model\Entity;
use Popov\ZfcFields\Model\Fields;

/**
 * @method FieldsRepository getRepository()
 */
class FieldsService extends DomainServiceAbstract
{
    protected $entity = Fields::class;

    /**
     * @param $entity
     * @return mixed
     */
    public function getAllByEntity(Entity $entity)
    {
        $repository = $this->getRepository();

        return $repository->findAllByEntityMnemo($entity->getMnemo());
    }

    public function getAllByEntityName($entityName)
    {
        $repository = $this->getRepository();

        return $repository->findAllByEntityMnemo($entityName);
    }

    /**
     * @param string $target
     * @param string $type
     * @param string $parent
     * @param string required
     * @param string $typeField
     * @return array
     */
    public function getRequiredFields($target, $type, $parent, $required, $typeField = 'required')
    {
        $repository = $this->getRepository();

        return $repository->findRequiredFields($target, $type, $parent, $required, $typeField);
    }

    /**
     * @param string $target
     * @param string $type
     * @param string $parent
     * @param string required
     * @param string $typeField
     * @return array
     */
    public function getRequiredFieldsToArray($target, $type, $parent, $required, $typeField = 'required')
    {
        $itemsArray = [];
        $items = $this->getRequiredFields($target, $type, $parent, $required, $typeField);
        foreach ($items as $item) {
            $itemsArray[] = $item->getMnemo();
        }

        return $itemsArray;
    }

    /**
     * @param string $target
     * @param string|array $roleId
     * @param string $filedVals , example 'mnemo' return ['brandId', 'carModelId', 'carEquipmentId']
     * @return array
     */
    public function getFieldsByRole($target, $roleId, $filedVals = '')
    {
        $repository = $this->getRepository();
        $items = $repository->findFieldsByRole($target, $roleId);
        if ($filedVals != '') {
            $items = $this->toArrayKeyVal($filedVals, $items);
        }

        return $items;
    }

    /**
     * @param string $target
     * @param string|array $roleId
     * @return array
     */
    public function getAllFieldsByRole($target, $roleId)
    {
        $repository = $this->getRepository();

        return $repository->findAllFieldsByRole($target, $roleId);
    }
}