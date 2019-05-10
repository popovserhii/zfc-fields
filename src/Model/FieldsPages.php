<?php

namespace Popov\ZfcFields\Model;

use Doctrine\ORM\Mapping as ORM;
use Popov\ZfcFields\Model\Fields;
use Popov\ZfcFields\Model\Pages;

/**
 * FieldsPages
 */
class FieldsPages
{
    const MNEMO = 'fieldsPages';

    const TABLE = 'fields_pages';

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
     * @var \Popov\ZfcFields\Model\Fields
     */
    private $fields;

    /**
     * @var \Popov\ZfcFields\Model\Pages
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
     * @param Fields $fields
     * @return FieldsPages
     */
    public function setFields(Fields $fields = null)
    {
        $this->fields = $fields;

        return $this;
    }

    /**
     * Get fields
     *
     * @return Fields
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * Set pages
     *
     * @param Pages $pages
     * @return FieldsPages
     */
    public function setPages(Pages $pages = null)
    {
        $this->pages = $pages;

        return $this;
    }

    /**
     * Get pages
     *
     * @return Pages
     */
    public function getPages()
    {
        return $this->pages;
    }
}
