<?php

namespace Blog\Model;

use Zend\Db\TableGateway\TableGateway;

class BlogTable 
{
	public $tableGateway;

	public function __construct(TableGateway $tableGateway)
	{
		$this->tableGateway = $tableGateway;
	}
}