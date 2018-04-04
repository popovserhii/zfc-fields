<?php
namespace Popov\ZfcFields\Model\Repository;

use Doctrine\ORM\Query\ResultSetMapping;
use Popov\ZfcCore\Service\EntityRepository;

class FieldsPagesRepository extends EntityRepository {

	protected $_table = 'fields_pages';
	protected $_alias = 'fp';
	protected $_typePermission = 'field';
	protected $_typeFieldPermission = 'permission';


	/**
	 * @param string $page, example 'controller/action'
	 * @return array
	 */
	public function findFieldsByPage($page = '')
	{
		$rsm = new ResultSetMapping();

		$rsm->addEntityResult($this->getEntityName(), $this->_alias);
		$rsm->addFieldResult($this->_alias, 'id', 'id');
		$rsm->addFieldResult($this->_alias, 'fieldsId', 'fieldsId');
		$rsm->addScalarResult('name', 'name');
		$rsm->addScalarResult('mnemo', 'mnemo');
		$rsm->addScalarResult('page', 'page');
		$rsm->addScalarResult('permissionId', 'permissionId');

		$where = ($page != '') ? 'AND p.`page` = ?' : '';

		$query = $this->_em->createNativeQuery(
			"SELECT {$this->_alias}.`id`, {$this->_alias}.`fieldsId`, f.`name`, f.`mnemo`, p.`page`,
			pn.`id` AS permissionId
			FROM `fields` f
			INNER JOIN `{$this->_table}` {$this->_alias} ON f.`id` = {$this->_alias}.`fieldsId`
			INNER JOIN `pages` p ON {$this->_alias}.`pagesId` = p.`id`
			INNER JOIN `permission` pn ON fp.`id` = pn.`entityId` AND p.`page` = pn.`target`
			WHERE pn.`type` = '".$this->_typePermission."' AND pn.`typeField` = '".$this->_typeFieldPermission."' {$where}
			ORDER BY {$this->_alias}.`pagesId`, {$this->_alias}.`position`",
			$rsm
		);

		if ($page != '')
		{
			$query = $this->setParametersByArray($query, [$page]);
		}

		return $query->getResult();
	}

	/**
	 * @param array $ids
	 * @return array
	 */
	public function findFieldsByIds(array $ids)
	{
		$rsm = new ResultSetMapping();

		$rsm->addEntityResult($this->getEntityName(), $this->_alias);
		$rsm->addFieldResult($this->_alias, 'id', 'id');
		$rsm->addScalarResult('mnemo', 'mnemo');

		$idsIn = $this->getIdsIn($ids);

		$query = $this->_em->createNativeQuery(
			"SELECT {$this->_alias}.`id`, f.`mnemo`
			FROM `{$this->_table}` {$this->_alias}
			INNER JOIN `fields` f ON {$this->_alias}.`fieldsId` = f.`id`
			WHERE {$this->_alias}.`id` IN ({$idsIn})",
			$rsm
		);

		$query = $this->setParametersByArray($query, $ids);

		return $query->getResult();
	}

	/**
	 * @return array
	 */
	public function findNotAddPermission()
	{
		$rsm = new ResultSetMapping();

		$rsm->addEntityResult($this->getEntityName(), $this->_alias);
		$rsm->addFieldResult($this->_alias, 'id', 'id');
		$rsm->addScalarResult('page', 'page');

		$sql = "SELECT {$this->_alias}.`id`, p.`page`
			FROM `{$this->_table}` {$this->_alias}
			INNER JOIN `pages` p ON {$this->_alias}.`pagesId` = p.`id`
			LEFT JOIN `permission` pn ON {$this->_alias}.`id` = pn.`entityId` AND pn.`type` = '".$this->_typePermission."'
			AND pn.`typeField` = '".$this->_typeFieldPermission."'
			WHERE pn.`id` IS NULL";
		$query = $this->_em->createNativeQuery($sql, $rsm);

		return $query->getResult();
	}

}