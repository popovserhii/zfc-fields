<?php
/**
 * @category Agere
 * @package Agere_Fields
 * @author Popov Sergiy <popov@agere.com.ua>
 * @datetime: 02.05.2016 21:00
 */
namespace Popov\ZfcFields\View\Helper\Factory;

use Popov\ZfcFields\View\Helper\Fields;

class FieldFactory
{
    public function __invoke($vhm)
    {
        $sm = $vhm->getServiceLocator();
        /** @var \Magere\Users\View\Helper\User $userHelper */
        $userHelper = $vhm->get('user');
        $currentUser = $userHelper->getUser();
        $helper = new Fields($sm, $currentUser);

        return $helper;
    }
}
