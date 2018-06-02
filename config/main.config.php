<?php

const ENVIRONMENT = 'dev'; // 'dev' or 'prod'
const VIEW_ENGINE = 'blade'; // 'blade' or 'php'
const GZIP_ENABLED = false; // can also be set on web server level
const PRETTY_ERROR_PAGES = true;
const ALTERNATIVE_CLASS_LOADER = true; // turn on if you're getting Class Not Found exceptions
const PROJECT_ROOT_ABS_PATH = '/path/to/soda'; // full path to project root without trailing slash

const MONGO_DB_ENABLED = true;
const MONGO_DB_HOST = 'localhost';
const MONGO_DB_PORT = '27017'; // mongodb default: 27017
const MONGO_DB_USERNAME = '';
const MONGO_DB_PASSWORD = '';
const MONGO_DB_DEFAULT_DATABASE_NAME = 'soda';

const SQL_DB_ENABLED = false;
const SQL_DB_DRIVER_TYPE = 'mysql'; // http://php.net/manual/en/pdo.drivers.php
const SQL_DB_HOST = 'localhost';
const SQL_DB_PORT = '3306'; // mysql default: 3306
const SQL_DB_USERNAME = 'root';
const SQL_DB_PASSWORD = '';
const SQL_DB_DEFAULT_NAME = 'soda';

require_once 'app.config.php';