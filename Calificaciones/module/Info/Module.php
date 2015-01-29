<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonModule for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Info;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Info\Model\Clase;
use Info\Model\ClaseTable;
use Info\Model\Alumno;
use Info\Model\AlumnoTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class Module implements AutoloaderProviderInterface
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
		    // if we're in a namespace deeper than one level we need to fix the \ in the path
                    __NAMESPACE__ => __DIR__ . '/src/' . str_replace('\\', '/' , __NAMESPACE__),
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function onBootstrap(MvcEvent $e)
    {
        // You may not need to do this if you're doing it elsewhere in your
        // application
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

    public function getServiceConfig()
    {
        return array(
        'abstract_factories' => array(),
        'aliases' => array(),
        'factories' => array(
            // DB
            'AlumnoTable' => function($sm) {
                $tableGateway = $sm->get('AlumnoTableGateway');
                $tabletaller = new AlumnoTable($tableGateway);
                return $tabletaller;
            },
            'AlumnoTableGateway' => function ($sm) {
                $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                $resultSetPrototype = new ResultSet();
                $resultSetPrototype->setArrayObjectPrototype(new Alumno());
                return new TableGateway('Alumno', $dbAdapter, null, $resultSetPrototype);
            },
            'ClaseTable' => function($sm) {
                $tableGateway = $sm->get('ClaseTableGateway');
                $table = new ClaseTable($tableGateway);
                return $table;
            },
            'ClaseTableGateway' => function ($sm) {
                $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                $resultSetPrototype = new ResultSet();
                $resultSetPrototype->setArrayObjectPrototype(new Clase());
                return new TableGateway('Clase', $dbAdapter, null, $resultSetPrototype);
            },
        ),
        'invokables' => array(),
        'services' => array(),
        'shared' => array(),
        );
    }
}
