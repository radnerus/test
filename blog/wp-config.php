<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'i4863483_wp3' );

/** MySQL database username */
define( 'DB_USER', 'i4863483_wp3' );

/** MySQL database password */
define( 'DB_PASSWORD', 'E.BMrL2pCYy1w9ZiPeq27' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '8X26WpRnIKRNRtG8B6caPLG9BgH61DO8oRD7709zRIE6KDqh1b0afbe7D8ueBA0o');
define('SECURE_AUTH_KEY',  'CY3IeDDoXtrGxqsqdmCUzf0pNVGqUSV6EimjFV7y6iyqriJz1W0m3fwtIkyl2hmo');
define('LOGGED_IN_KEY',    'JATqgXznbXomaojEK2UfTYZolii2UMCyjIMJuL2qPAIEarIhRV8G5w74ocQhgoCP');
define('NONCE_KEY',        '0Sxa0BKU6n3vPaVmUfbU5Dh1YLWjUcuJJv6MQBsfuSIH6KAsqhegtwgZAbKWSBXn');
define('AUTH_SALT',        'PsBYhpTH8VSFXekgc5aBbv3jVJZ4NrYxBBmUIeOO3wMiCGerYZ3BTMIjif4urej0');
define('SECURE_AUTH_SALT', 'FIGChMGOBKQlWpVPhyyIzoMXOCw5EPcgtZkTQfsSl10IqayVILulqwcJ3HMsqSSn');
define('LOGGED_IN_SALT',   'pUz6SMhPAGguOnji63fs6gfGzhGNfKKXL936bK27Kq3HrJAiblMcs4jlyecJbP5T');
define('NONCE_SALT',       'ojSRXifTkhFxE3vthiD7pZ2ykmkaAA8voMh4lbbxBeuq9LgdNUxQMAQauL0xOFa1');

/**
 * Other customizations.
 */
define('FS_METHOD','direct');
define('FS_CHMOD_DIR',0755);
define('FS_CHMOD_FILE',0644);
define('WP_TEMP_DIR',dirname(__FILE__).'/wp-content/uploads');

/**
 * Turn off automatic updates since these are managed externally by Installatron.
 * If you remove this define() to re-enable WordPress's automatic background updating
 * then it's advised to disable auto-updating in Installatron.
 */
define('AUTOMATIC_UPDATER_DISABLED', true);


/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
