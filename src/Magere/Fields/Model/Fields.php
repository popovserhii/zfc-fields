<?php

namespace Magere\Fields\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fields
 */
class Fields
{
	/**
	 * @var integer
	 */
	private $id;

	/**
	 * @var string
	 */
	private $name;

	/**
	 * @var string
	 */
	private $mnemo;

	/**
	 * @var integer
	 */
	private $entityId;

	/**
	 * @var \Doctrine\Common\Collections\Collection
	 */
	private $fieldsPages;

	/**
	 * @var \Magere\Entity\Model\Entity
	 */
	private $entity;

	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->fieldsPages = new \Doctrine\Common\Collections\ArrayCollection();
	}

	/**
	 * Get id
	 *
	 * @return integer
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Set name
	 *
	 * @param string $name
	 * @return Fields
	 */
	public function setName($name)
	{
		$this->name = $name;

		return $this;
	}

	/**
	 * Get name
	 *
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * Set mnemo
	 *
	 * @param string $mnemo
	 * @return Fields
	 */
	public function setMnemo($mnemo)
	{
		$this->mnemo = $mnemo;

		return $this;
	}

	/**
	 * Get mnemo
	 *
	 * @return string
	 */
	public function getMnemo()
	{
		return $this->mnemo;
	}

	/**
	 * Set entityId
	 *
	 * @param integer $entityId
	 * @return Fields
	 */
	public function setEntityId($entityId)
	{
		$this->entityId = $entityId;

		return $this;
	}

	/**
	 * Get entityId
	 *
	 * @return integer
	 */
	public function getEntityId()
	{
		return $this->entityId;
	}

	/**
	 * Add fieldsPages
	 *
	 * @param \Magere\Fields\Model\FieldsPages $fieldsPages
	 * @return Fields
	 */
	public function addFieldsPage(\Magere\Fields\Model\FieldsPages $fieldsPages)
	{
		$this->fieldsPages[] = $fieldsPages;

		return $this;
	}

	/**
	 * Remove fieldsPages
	 *
	 * @param \Magere\Fields\Model\FieldsPages $fieldsPages
	 */
	public function removeFieldsPage(\Magere\Fields\Model\FieldsPages $fieldsPages)
	{
		$this->fieldsPages->removeElement($fieldsPages);
	}

	/**
	 * Get fieldsPages
	 *
	 * @return \Doctrine\Common\Collections\Collection
	 */
	public function getFieldsPages()
	{
		return $this->fieldsPages;
	}

	/**
	 * Set entity
	 *
	 * @param \Magere\Entity\Model\Entity $entity
	 * @return Fields
	 */
	public function setEntity(\Magere\Entity\Model\Entity $entity = null)
	{
		$this->entity = $entity;

		return $this;
	}

	/**
	 * Get entity
	 *
	 * @return \Magere\Entity\Model\Entity
	 */
	public function getEntity()
	{
		return $this->entity;
	}
}
