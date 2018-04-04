<?php
namespace Popov\ZfcFields\View\Helper;

use Agere\Simpler\Plugin\SimplerPlugin;
use Zend\View\Helper\AbstractHelper,
	Magere\Agere\String\StringUtils as AgereString,
	Magere\Users\Acl\Acl,
	Popov\ZfcFields\Service\FieldsService;

class Fields extends AbstractHelper
{
	/**
	 * @var \Popov\ZfcFields\Service\FieldsService
	 */
	protected $_fieldsService;

	/**
	 * @var \Magere\OrderSale\Service\OrderSaleService
	 */
	protected $_orderSaleService;

	protected $_user;
	protected $_itemsFields = [];
	protected $_fieldsPermissionPage;

    /** @var SimplerPlugin simpler */
    protected $simpler;

	/**
	 * @param $sm
	 * @param array $user
	 */
	public function __construct($sm, array $user)
	{
		$this->_fieldsService = $sm->get('FieldsService');
		$this->_orderSaleService = $sm->get('OrderSaleService');

		$this->userHelper = $sm->get('ViewHelperManager')->get('user');
        $this->simpler = $sm->get('ControllerPluginManager')->get('simpler');

		
		$this->_user = $user;
	}

	/**
	 * @param string $target
	 * @param int $parent
	 * @param string $required
	 * @param string $typeField
	 */
	protected function _setParams($target, $parent, $required, $typeField = 'required')
	{
		$type = 'field';
		$where = [$target, $type, $parent, $required, $typeField];

		if (! isset($this->_itemsFields[$typeField]) OR array_diff($this->_itemsFields[$typeField]['where'], $where))
		{
			$this->_itemsFields[$typeField]['where'] = $where;
			$this->_itemsFields[$typeField]['requiredFields'] = $this->_fieldsService->getRequiredFieldsToArray($target, $type, $parent, $required, $typeField);
		}
	}

	/**
	 * @param string $field
	 * @param string $target
	 * @param int $parent
	 * @param string $required
	 * @param string $typeField
	 * @return string
	 */
	public function fieldRequired($field, $target, $parent, $required, $typeField = 'required')
	{
		$requiredStr = '';

		$this->_setParams($target, $parent, $required, $typeField);

		if (in_array($field, $this->_itemsFields[$typeField]['requiredFields']))
		{
			switch ($typeField)
			{
				case 'required':
					$requiredStr = '<span class="red">*</span>';
					break;
				case 'edit':
					$requiredStr = 'disabled';
			}
		}

		return $requiredStr;
	}

	/**
	 * @param string $field
	 * @param string $target
	 * @param int $parent
	 * @param string $required
	 * @return bool
	 */
	public function fieldHide($field, $target, $parent, $required)
	{
		$typeField = 'hide';
		$this->_setParams($target, $parent, $required, $typeField);

		return (! in_array($field, $this->_itemsFields[$typeField]['requiredFields']));
	}

	/**
	 * @param string $field
	 * @param string $target
	 * @return bool
	 */
	public function fieldPermission($field, $target)
	{
		if (is_null($this->_fieldsPermissionPage))
		{
			$roleId = AgereString::getStringAssocDigit($this->_user['roleId'], 'role');
			$this->_fieldsPermissionPage = $this->_fieldsService->getFieldsByRole($target, $roleId, 'mnemo');
		}

		return in_array($field, $this->_fieldsPermissionPage);
	}

	/**
	 * @param string $target
	 * @param array $data
	 * @return array
	 */
	public function fieldsPermission($target, array $data = [])
	{
		$args = [];
		
		$user = $this->userHelper->current();
		$roleIds = $this->simpler->setContext($user->getRoles())->asArrayValue('id');
		
		$roleId = AgereString::getStringAssocDigit($roleIds, 'role');
		$fields = $this->_fieldsService->getAllFieldsByRole($target, $roleId);
		$method = AgereString::getMethodByPage($target).'Access';
        foreach ($fields as $field) {
            if (!is_null($field['mnemo'])) {
                $access = true;
                if (method_exists($this, $method)) {
                    $access = $this->{$method}($field['mnemo'], $data);
                }
                if (!isset($args[$field['mnemo']])) {
                    $permission = ($this->userHelper->isAdmin()) ? Acl::getAccessTotal() : $field['access'];
                    $args[$field['mnemo']] = [
                        'fieldName' => $field['name'],
                        'permission' => $access ? $permission : $access,
                    ];
                } else {
                    $newAccess = $field['access'];
                    if ($newAccess != (int) $args[$field['mnemo']]['permission']) {
                        $newAccess += (int) $args[$field['mnemo']]['permission'];
                    }
                    if ($newAccess > 0 && $newAccess <= Acl::getAccessTotal()) {
                        $args[$field['mnemo']]['permission'] = ($access ? $newAccess : $access);
                    }
                }
            }
        }

        return $args;
	}

	/**
	 * @param string $field
	 * @param array $data
	 * @return bool
	 */
	protected function orderSalePaymentAccess($field, $data)
	{
		static $statuses;

		if (is_null($statuses))
		{
			$statuses = $this->_orderSaleService->getStatuses();
		}

		if ($field == 'permitIssuance' && ! in_array($data['statusId'], [$statuses['fullPayment'], $statuses['toIssueCar'], $statuses['carIssued']]))
		{
			return false;
		}

		return true;
	}

}