<?php

namespace AppBundle\Connection;

use Doctrine\Bundle\DoctrineBundle\ConnectionFactory;
use Doctrine\Common\EventManager;
use Doctrine\DBAL\Configuration;

class CustomConnectionFactory extends ConnectionFactory {

    public function createConnection(array $params, Configuration $config = null, EventManager $eventManager = null, array $mappingTypes = array()) {
        // Discover and override $params array here.
        // A real-world example might obtain them from zookeeper,
        // consul or etcd for example. You'll probably want to cache
        // anything you obtain from such a service too.

        $params['driver'] = 'pdo_mysql';
        $params['host'] = 'localhost';
        $params['port'] = 3306;
        $params['dbname'] = 'partsbox_symfony';
        $params['user'] = 'root';
        $params['password'] = '123456';

        //continue with regular connection creation using new params
        return parent::createConnection($params, $config, $eventManager, $mappingTypes);
    }

}
