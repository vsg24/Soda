<?php
date_default_timezone_set('UTC');

const SITE_TITLE = 'Soda';

const MAIN_DOMAIN = "localhost.my";
const MAIN_DOMAIN_PORT = ":8080";
const SITE_ADDRESS = 'http://optional-subdomain.' . MAIN_DOMAIN . MAIN_DOMAIN_PORT;

const JWT_SECRET = 'your_secret_here';

const USE_CUSTOM_OPEN_SSL_CERT = false;
const VERIFY_CUSTOM_OPEN_SSL_CERT = false;
const CUSTOM_OPEN_SSL_CERT_PATH = null;