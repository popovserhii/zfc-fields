<?php

namespace Popov\ZfcFields\Service;

use Popov\ZfcFields\Model\Pages;
use Popov\ZfcFields\Model\Repository\PagesRepository;
use Popov\ZfcCore\Service\DomainServiceAbstract;

/**
 * @method PagesRepository getRepository()
 */
class PagesService extends DomainServiceAbstract
{
    protected $entity = Pages::MNEMO;
}