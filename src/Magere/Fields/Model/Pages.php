<?php

namespace Magere\Fields\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pages
 */
class Pages
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $page;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $fieldsPages;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $permissionSettingsPages;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->fieldsPages = new \Doctrine\Common\Collections\ArrayCollection();
        $this->permissionSettingsPages = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set page
     *
     * @param string $page
     * @return Pages
     */
    public function setPage($page)
    {
        $this->page = $page;

        return $this;
    }

    /**
     * Get page
     *
     * @return string 
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * Add fieldsPages
     *
     * @param \Magere\Fields\Model\FieldsPages $fieldsPages
     * @return Pages
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
     * Add permissionSettingsPages
     *
     * @param \Magere\Permission\Model\PermissionSettingsPages $permissionSettingsPages
     * @return Pages
     */
    public function addPermissionSettingsPage(\Magere\Permission\Model\PermissionSettingsPages $permissionSettingsPages)
    {
        $this->permissionSettingsPages[] = $permissionSettingsPages;

        return $this;
    }

    /**
     * Remove permissionSettingsPages
     *
     * @param \Magere\Permission\Model\PermissionSettingsPages $permissionSettingsPages
     */
    public function removePermissionSettingsPage(\Magere\Permission\Model\PermissionSettingsPages $permissionSettingsPages)
    {
        $this->permissionSettingsPages->removeElement($permissionSettingsPages);
    }

    /**
     * Get permissionSettingsPages
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPermissionSettingsPages()
    {
        return $this->permissionSettingsPages;
    }
}
