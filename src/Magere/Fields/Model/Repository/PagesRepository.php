<?php
namespace Magere\Fields\Model\Repository;

use Doctrine\ORM\Query\ResultSetMapping,
	Doctrine\ORM\Query\ResultSetMappingBuilder,
	Magere\Agere\ORM\EntityRepository;

class PagesRepository extends EntityRepository {

	protected $_table = 'pages';
	protected $_alias = 'p';

}