<?php

/**
 * The environment type: dev, test or live.
 */
define('SS_ENVIRONMENT_TYPE', 'dev');

// ==========
// E-MAIL
// ==========

/**
 * If you define this constant, all emails will be redirected to this address.
 */
// define('SS_SEND_ALL_EMAILS_TO', 'youremail@domain.com');

/**
 *  If you define this constant, all emails will be sent from this address.
 */
// define('SS_SEND_ALL_EMAILS_FROM', 'youremail@domain.com');

// ==========
// DATABASE
// ==========

/**
 * The database class to use, MySQLPDODatabase, MySQLDatabase, MSSQLDatabase,
 * etc.
 *
 * @default MySQLDatabase
 */
define('SS_DATABASE_CLASS', 'MySQLDatabase');

/**
 * Set the database name. Assumes the $database global variable in your
 * config is missing or empty.
 * Use only when every, or the only, website in the subfolders use this
 * very same database.
 */
// define('SS_DATABASE_NAME', 'database_name');

/**
 * Boolean/Int. If defined, then the system will choose a default database
 * name for you if one isn't give in the $database variable. The database
 * name will be "SS_" followed by the name of the folder into which you have
 * installed SilverStripe. If this is enabled, it means that the
 * phpinstaller will work out of the box without the installer needing to
 * alter any files. This helps prevent accidental changes to the environment.
 * If SS_DATABASE_CHOOSE_NAME is an integer greater than one, then an
 * ancestor folder will be used for the database name. This is handy for a
 * site that's hosted from /sites/examplesite/www or
 * /buildbot/allmodules-2.3/build. If it's 2, the parent folder will be
 * chosen; if it's 3 the grandparent, and so on.
 */
// define('SS_DATABASE_CHOOSE_NAME', false);

/**
 * The database server to use.
 *
 * @default localhost
 */
define('SS_DATABASE_SERVER', 'localhost');

/**
 * The database username (mandatory).
 */
define('SS_DATABASE_USERNAME', 'root');

/**
 * The database password (mandatory).
 */
define('SS_DATABASE_PASSWORD', '');

/**
 * The database port.
 *
 * @default 3306
 */
// define('SS_DATABASE_PORT', 'port');

/**
 * A suffix to add to the database name.
 */
// define('SS_DATABASE_SUFFIX', '_suffix');

/**
 * A prefix to add to the database name.
 * This is helpful mainly on shared hosts, when every database has a prefix.
 */
// define('SS_DATABASE_PREFIX', 'prefix_');

/**
 * Set the database timezone to something other than the system timezone.
 */
define('SS_DATABASE_TIMEZONE', '-3:00');

// ==========
// SECURITY
// ==========

/**
 * Protect the site with basic auth (good for test sites). When using
 * CGI/FastCGI with Apache, you will have to add the
 * RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}] rewrite rule
 * to your .htaccess file
 */
// define('SS_USE_BASIC_AUTH', true);

/**
 * These two defines sets a default login which, when used, will always log
 * you in as an admin, even creating one if none exist.
 * Only set in dev environment.
 */
define('SS_DEFAULT_ADMIN_USERNAME', 'admin');
define('SS_DEFAULT_ADMIN_PASSWORD', 'admin');

// ==========
// WARNINGS
// ==========

/**
 * Enable deprecation notices for this environment.
 */
define('SS_DEPRECATION_ENABLED', true);

// ==========
// LOGS
// ==========

/**
 * This causes errors to be written to the BASE_PATH/silverstripe.log file.
 * Path must be relative to BASE_PATH
 */
// define('SS_ERROR_LOG', 'silverstripe.log');

// ==========
// FOLDERS
// ==========

/**
 * Absolute file path to store temporary files such as cached templates or
 * the class manifest. Needs to be writeable by the webserver user.
 * Defaults to silverstripe-cache in the webroot, and falls back to
 * sys_get_temp_dir(). See getTempFolder() in framework/core/TempPath.php.
 */
// define(TEMP_FOLDER, '');
