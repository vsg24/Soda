<?php

namespace Soda\Core\Database;

use Doctrine\MongoDB\Connection;
use Doctrine\ODM\MongoDB\Configuration;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\Mapping\Driver\AnnotationDriver;

class DoctrineMongoDBODM
{
    private $dm;

    public function __construct()
    {
        AnnotationDriver::registerAnnotationClasses();

        $config = new Configuration();
        $config->setProxyDir(__DIR__ . '/proxies');
        $config->setProxyNamespace('Proxies');
        $config->setHydratorDir(__DIR__ . '/hydrators');
        $config->setHydratorNamespace('Hydrators');
        $config->setMetadataDriverImpl(AnnotationDriver::create(__DIR__ . '../../../app/models/'));

        AnnotationDriver::registerAnnotationClasses();

        $username_password = MONGO_DB_USERNAME != null && MONGO_DB_USERNAME != "" ? MONGO_DB_USERNAME . ':' . MONGO_DB_PASSWORD . '@' : "";
        $host_and_port = MONGO_DB_HOST . ':' . MONGO_DB_PORT;
        $connection = new Connection('mongodb://' . $username_password . $host_and_port);

        $config->setDefaultDB(MONGO_DB_DEFAULT_DATABASE_NAME ?? 'Soda');

        $this->dm = DocumentManager::create($connection, $config);
    }

    /**
     * Returns an instance of Doctrine ODM DocumentManager
     *
     * @return DocumentManager
     */
    public function getDM(): DocumentManager
    {
        return $this->dm;
    }
}