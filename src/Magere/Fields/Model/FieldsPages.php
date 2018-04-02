<?php

namespace Magere\Fields\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * FieldsPages
 */
class FieldsPages
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $fieldsId;

    /**
     * @var integer
     */
    private $pagesId;

	/**
	 * @var integer
	 */
	private $position;

    /**
     * @var \Magere\Fields\Model\Fields
     */
    private $fields;

    /**
     * @var \Magere\Fields\Model\Pages
     */
    private $pages;


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
     * Set fieldsId
     *
     * @param integer $fieldsId
     * @return FieldsPages
     */
    public function setFieldsId($fieldsId)
    {
        $this->fieldsId = $fieldsId;

        return $this;
    }

    /**
     * Get fieldsId
     *
     * @return integer 
     */
    public function getFieldsId()
    {
        return $this->fieldsId;
    }

    /**
     * Set pagesId
     *
     * @param integer $pagesId
     * @return FieldsPages
     */
    public function setPagesId($pagesId)
    {
        $this->pagesId = $pagesId;

        return $this;
    }

    /**
     * Get pagesId
     *
     * @return integer 
     */
    public function getPagesId()
    {
        return $this->pagesId;
    }

	/**
	 * Set position
	 *
	 * @param integer $position
	 * @return FieldsPages
	 */
	public function setPosition($position)
	{
		$this->position = $position;

		return $this;
	}

	/**
	 * Get position
	 *
	 * @return integer
	 */
	public function getPosition()
	{
		return $this->position;
	}

    /**
     * Set fields
     *
     * @param \Magere\Fields\Model\Fields $fields
     * @return FieldsPages
     */
    public function setFields(\Magere\Fields\Model\Fields $fields = null)
    {
        $this->fields = $fields;

        return $this;
    }

    /**
     * Get fields
     *
     * @return \Magere\Fields\Model\Fields 
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * Set pages
     *
     * @param \Magere\Fields\Model\Pages $pages
     * @return FieldsPages
     */
    public function setPages(\Magere\Fields\Model\Pages $pages = null)
    {
        $this->pages = $pages;

        return $this;
    }

    /**
     * Get pages
     *
     * @return \Magere\Fields\Model\Pages 
     */
    public function getPages()
    {
        return $this->pages;
    }
}
