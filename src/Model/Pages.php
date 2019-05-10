<?php

namespace Popov\ZfcFields\Model;

use Doctrine\ORM\Mapping as ORM;
use Popov\ZfcPermission\Model\PermissionSettingsPages;

/**
 * Pages
 */
class Pages
{
    const MNEMO = 'pages';

    const TABLE = 'pages';

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
     * @param \Popov\ZfcFields\Model\FieldsPages $fieldsPages
     * @return Pages
     */
    public function addFieldsPage(\Popov\ZfcFields\Model\FieldsPages $fieldsPages)
    {
        $this->fieldsPages[] = $fieldsPages;

        return $this;
    }

    /**
     * Remove fieldsPages
     *
     * @param \Popov\ZfcFields\Model\FieldsPages $fieldsPages
     */
    public function removeFieldsPage(\Popov\ZfcFields\Model\FieldsPages $fieldsPages)
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
     * @param PermissionSettingsPages $permissionSettingsPages
     * @return Pages
     */
    public function addPermissionSettingsPage(PermissionSettingsPages $permissionSettingsPages)
    {
        $this->permissionSettingsPages[] = $permissionSettingsPages;

        return $this;
    }

    /**
     * Remove permissionSettingsPages
     *
     * @param PermissionSettingsPages $permissionSettingsPages
     */
    public function removePermissionSettingsPage(PermissionSettingsPages $permissionSettingsPages)
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
