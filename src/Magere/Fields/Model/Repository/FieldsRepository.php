<?php
namespace Magere\Fields\Model\Repository;

use Doctrine\ORM\Query\ResultSetMapping,
	Doctrine\ORM\Query\ResultSetMappingBuilder,
	Magere\Agere\ORM\EntityRepository;

class FieldsRepository extends EntityRepository {

	protected $_table = 'fields';
	protected $_alias = 'f';


	/**
	 * @param string $entityMnemo
	 * @return array
	 */
	public function findAllByEntityMnemo($entityMnemo)
	{
		$rsm = new ResultSetMappingBuilder($this->_em);
		$rsm->addRootEntityFromClassMetadata($this->getEntityName(), $this->_alias);

		$query = $this->_em->createNativeQuery(
			"SELECT {$this->_alias}.*
			FROM `{$this->_table}` {$this->_alias}
			INNER JOIN `entity` e ON {$this->_alias}.`entityId` = e.`id`
			WHERE e.`mnemo` = ?",
			$rsm
		);

		$query = $this->setParametersByArray($query, [$entityMnemo]);

		return $query->getResult();
	}

    /**
     * Alias for findAllByEntityMnemo
     *
     * @param $entityMnemo
     * @return array
     */
    public function findAllByEntityName($entityMnemo)
    {
        return $this->findAllByEntityMnemo($entityMnemo);
    }

	/**
	 * @param string $target
	 * @param string $type
	 * @param int $parent
	 * @param string required
	 * @param string $typeField
	 * @return array
	 */
	public function findRequiredFields($target, $type, $parent, $required, $typeField = 'required')
	{
		$rsm = new ResultSetMappingBuilder($this->_em);
		$rsm->addRootEntityFromClassMetadata($this->getEntityName(), $this->_alias);

		$query = $this->_em->createNativeQuery(
			"SELECT {$this->_alias}.*
			FROM `{$this->_table}` {$this->_alias}
			INNER JOIN `permission` p ON p.`entityId` = {$this->_alias}.`id`
			WHERE p.`target` = ? AND p.`type` = ? AND p.`parent` = ? AND p.`required` = ? AND p.`typeField` = ?",
			$rsm
		);

		$query = $this->setParametersByArray($query, [$target, $type, $parent, $required, $typeField]);

		return $query->getResult();
	}


	/**
	 * @param string $target
	 * @param string|array $roleId
	 * @return array
	 */
	public function findFieldsByRole($target, $roleId)
	{
		$rsm = new ResultSetMappingBuilder($this->_em);
		$rsm->addRootEntityFromClassMetadata($this->getEntityName(), $this->_alias);

		if (! is_array($roleId))
		{
			$roleId = (array) $roleId;
		}

		$idsInRoleId = $this->getIdsIn($roleId);

		$query = $this->_em->createNativeQuery(
			"SELECT {$this->_alias}.*
			FROM `{$this->_table}` {$this->_alias}
			INNER JOIN `fields_pages` fp ON f.`id` = fp.`fieldsId`
			INNER JOIN `pages` p ON fp.`pagesId` = p.`id` AND p.`page` = ?
			INNER JOIN `permission` pn ON fp.`id` = pn.`entityId` AND p.`page` = pn.`target`
			INNER JOIN `permission_access` pa ON pn.`id` = pa.`permissionId` AND pa.`roleId` IN ({$idsInRoleId})
			ORDER BY fp.`position`",
			$rsm
		);

		array_unshift($roleId, $target);

		$query = $this->setParametersByArray($query, $roleId);

		return $query->getResult();
	}

	/**
	 * @param string $target
	 * @param string|array $roleId
	 * @return array
	 */
	public function findAllFieldsByRole($target, $roleId)
	{
		$rsm = new ResultSetMapping();

		$rsm->addScalarResult('id', 'id');
		$rsm->addScalarResult('name', 'name');
		$rsm->addScalarResult('mnemo', 'mnemo');
		$rsm->addScalarResult('access', 'access');

		if (! is_array($roleId))
		{
			$roleId = (array) $roleId;
		}

		$idsInRoleId = $this->getIdsIn($roleId);

		$query = $this->_em->createNativeQuery(
			"SELECT {$this->_alias}.*, pa.`access`
			FROM `{$this->_table}` {$this->_alias}
			INNER JOIN `fields_pages` fp ON f.`id` = fp.`fieldsId`
			LEFT JOIN `pages` p ON fp.`pagesId` = p.`id`
			LEFT JOIN `permission` pn ON fp.`id` = pn.`entityId` AND p.`page` = pn.`target`
			LEFT JOIN `permission_access` pa ON pn.`id` = pa.`permissionId` AND pa.`roleId` IN ({$idsInRoleId})
			WHERE pn.`type` = 'field' AND pn.`typeField` = 'permission' AND p.`page` = ?
			ORDER BY fp.`position`",
			$rsm
		);

		$roleId[] = $target;

		$query = $this->setParametersByArray($query, $roleId);

        //\Zend\Debug\Debug::dump([$query->getSQL(), $query->getParameters()]); die(__METHOD__);


        return $query->getResult();
	}

}