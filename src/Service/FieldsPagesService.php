<?php
namespace Popov\ZfcFields\Service;

use Doctrine\ORM\EntityRepository,
	Magere\Agere\Service\AbstractEntityService;
use Popov\ZfcCore\Service\DomainServiceAbstract;
use Popov\ZfcFields\Model\FieldsPages;

class FieldsPagesService extends DomainServiceAbstract {

	protected $_repositoryName = 'fieldsPages';

    protected $entity = FieldsPages::class;

	/**
	 * @param $page, example 'controller/action'
	 * @param string $fieldToArray
	 * @return array
	 */
	public function getFieldsByPage($page = ''/*, $fieldToArray = ''*/)
	{
		/** @var \Popov\ZfcFields\Model\Repository\FieldsPagesRepository $repository */
		$repository = $this->getRepository();

		$items = $repository->findFieldsByPage($page);

		/*if ($fieldToArray != '')
		{
			//$items = $this->toArrayKeyField($fieldToArray, $items, true);
            //$itemsPageBind = $servicePageBind->toArrayKeyField('childrenId', $itemsPageBind, true);
            $itemsPageBind = $simpler->setContext($itemsPageBind)->asAssociate('childrenId', true);
		}*/

		return $items;
	}

	/**
	 * @param array $ids
	 * @param string $valToArray
	 * @return array
	 */
	public function getFieldsByIds(array $ids, $valToArray = '')
	{
		/** @var \Popov\ZfcFields\Model\Repository\FieldsPagesRepository $repository */
		$repository = $this->getRepository();

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
		/** @var \Popov\ZfcFields\Model\Repository\FieldsPagesRepository $repository */
		$repository = $this->getRepository();

		return $repository->findNotAddPermission();
	}

}