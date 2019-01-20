<?php
date_default_timezone_set('UTC');

const SITE_TITLE = 'Soda';

const MAIN_DOMAIN = "soda.localhost";
const MAIN_DOMAIN_PORT = ":8080";
const SITE_ADDRESS = 'http://optional-subdomain.' . MAIN_DOMAIN . MAIN_DOMAIN_PORT;

const JWT_SECRET = 'your_secret_here';

const USE_CUSTOM_OPEN_SSL_CERT = false;
const VERIFY_CUSTOM_OPEN_SSL_CERT = false;
const CUSTOM_OPEN_SSL_CERT_PATH = null;

const ENVIRONMENT = 'dev'; // 'dev' or 'prod'
const VIEW_ENGINE = 'blade'; // 'blade' or 'php'
const GZIP_ENABLED = false; // can also be set on web server level
const PRETTY_ERROR_PAGES = true;
const PROJECT_ROOT_ABS_PATH = 'D:/repositories/Soda'; // full path to project root without trailing slash

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

class DB_CONS {
    // Define your database table/collection names here
    public const USERS = "Users";
    public const POSTS = "Posts";
}