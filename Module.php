<?php


namespace Blog;

use Zend\Db\ResultSet\ResultSet;
use Blog\Model\Blog;
use Zend\Db\TableGateway\TableGateway;
use Blog\Model\BlogTable;

class Module
{
    
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig()
    {
    	return array(
    		'factories' => array(
    			'BlogTable' => function($sm)
    			{
    				$tableGateway = $sm->get('BlogTableGateway');
    				$table =  new BlogTable($tableGateway);
    				return $table->tableGateway;
    			},
    			'BlogTableGateway' => function($sm)
    			{
    				$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
    				$resultSet = new ResultSet(); 
    				$resultSet->setArrayObjectPrototype(new Blog());
    				return new TableGateway('blog', $dbAdapter, null, $resultSet);
    			},
    		),
    	);
    }
}
