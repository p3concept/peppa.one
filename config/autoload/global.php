<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */


return array(

       'service_manager' => array(
    		'factories' => array(
    				'Zend\Db\Adapter\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory'
      		),
       ),

    // Database Connection
    'db' => array(
    		'driver'         => 'Pdo',
    		'dsn'            => 'mysql:dbname=db338698_30;host=mysql5.p3-concept.de1.biz',
    		'driver_options' => array(
    				PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
    		),
    		'username' => 'db338698_30',
    		'password' => 'peppa#2810',
    ),
    // End Database Connection
    
);
