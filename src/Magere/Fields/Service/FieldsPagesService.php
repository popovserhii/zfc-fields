<?php
namespace Magere\Fields\Service;

use Doctrine\ORM\EntityRepository,
	Magere\Agere\Service\AbstractEntityService;

class FieldsPagesService extends AbstractEntityService {

	protected $_repositoryName = 'fieldsPages';


	/**
	 * @param $page, example 'controller/action'
	 * @param string $fieldToArray
	 * @return array
	 */
	public function getFieldsByPage($page = '', $fieldToArray = '')
	{
		/** @var \Magere\Fields\Model\Repository\FieldsPagesRepository $repository */
		$repository = $this->getRepository($this->_repositoryName);

		$items = $repository->findFieldsByPage($page);

		if ($fieldToArray != '')
		{
			$items = $this->toArrayKeyField($fieldToArray, $items, true);
		}

		return $items;
	}

	/**
	 * @param array $ids
	 * @param string $valToArray
	 * @return array
	 */
	public function getFieldsByIds(array $ids, $valToArray = '')
	{
		/** @var \Magere\Fields\Model\Repository\FieldsPagesRepository $repository */
		$repository = $this->getRepository($this->_repositoryName);

		$items = $repository->findFieldsByIds($ids);

		if ($valToArray != '')
		{
			$items = $this->toArrayKeyVal($valToArray, $items);
		}

		return $items;
	}

	/**
	 * @return array
	 */
	public function getNotAddPermission()
	{
		/** @var \Magere\Fields\Model\Repository\FieldsPagesRepository $repository */
		$repository = $this->getRepository($this->_repositoryName);

		return $repository->findNotAddPermission();
	}

}