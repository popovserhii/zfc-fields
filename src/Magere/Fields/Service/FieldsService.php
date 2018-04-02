<?php
namespace Magere\Fields\Service;

use Doctrine\ORM\EntityRepository;
use Magere\Agere\Service\AbstractEntityService;

class FieldsService extends AbstractEntityService {

	protected $_repositoryName = 'fields';

	/**
	 * @param $entity
	 * @return mixed
	 */
	public function getAllByEntity($entity)
	{
		/** @var \Magere\Fields\Model\Repository\FieldsRepository $repository */
		$repository = $this->getRepository($this->_repositoryName);

		return $repository->findAllByEntityMnemo($entity->getMnemo());
	}

    public function getAllByEntityName($entityName)
    {
        /** @var \Magere\Fields\Model\Repository\FieldsRepository $repository */
        $repository = $this->getRepository($this->_repositoryName);

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
		/** @var \Magere\Fields\Model\Repository\FieldsRepository $repository */
		$repository = $this->getRepository($this->_repositoryName);

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

		foreach ($items as $item)
		{
			$itemsArray[] = $item->getMnemo();
		}

		return $itemsArray;
	}

	/**
	 * @param string $target
	 * @param string|array $roleId
	 * @param string $filedVals, example 'mnemo' return ['brandId', 'carModelId', 'carEquipmentId']
	 * @return array
	 */
	public function getFieldsByRole($target, $roleId, $filedVals = '')
	{
		/** @var \Magere\Fields\Model\Repository\FieldsRepository $repository */
		$repository = $this->getRepository($this->_repositoryName);

		$items = $repository->findFieldsByRole($target, $roleId);

		if ($filedVals != '')
		{
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
		/** @var \Magere\Fields\Model\Repository\FieldsRepository $repository */
		$repository = $this->getRepository($this->_repositoryName);

		return $repository->findAllFieldsByRole($target, $roleId);
	}

}