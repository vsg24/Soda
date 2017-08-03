<?php

namespace Soda\Core\Database;

use MongoDB\Client;

class MongoDBClient
{
    private $dm;

    public function __construct()
    {
        $username_password = MONGO_DB_USERNAME != null && MONGO_DB_USERNAME != "" ? MONGO_DB_USERNAME . ':' . MONGO_DB_PASSWORD . '@' : "";
        $host_and_port = MONGO_DB_HOST . ':' . MONGO_DB_PORT;
        $mongoClient = new Client('mongodb://' . $username_password . $host_and_port);

        $this->dm = $mongoClient->selectDatabase(MONGO_DB_DEFAULT_DATABASE_NAME ?? 'Soda');
    }

    /**
     * Returns an instance of MongoDB Client
     *
     * @return \MongoDB\Database
     */
    public function getDM(): \MongoDB\Database
    {
        return $this->dm;
    }
}