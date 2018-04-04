<?php
namespace Popov\ZfcFields\Model\Repository;

use Doctrine\ORM\Query\ResultSetMapping;
use	Doctrine\ORM\Query\ResultSetMappingBuilder;
use Popov\ZfcCore\Service\EntityRepository;

class PagesRepository extends EntityRepository {

	protected $_table = 'pages';
	protected $_alias = 'p';

}