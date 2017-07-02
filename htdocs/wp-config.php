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

// ** MySQL settings ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'kaikei' );

/** MySQL database username */
define( 'DB_USER', 'smrj' );

/** MySQL database password */
define( 'DB_PASSWORD', 'kaikei2017' );

/** MySQL hostname */
define( 'DB_HOST', 'db' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '^(wINxiFpbKE[t^;|W!+t;WcA=i*R;];198|fcr!cTn{7z0<&VlS*KE#=~868}}Q');
define('SECURE_AUTH_KEY',  '%yjp=Nl@77h`O Bj-0P-;,i1c|`nN={)!af%+a7Vxw|z/O+3<)@?_-$Rn-a8z.nt');
define('LOGGED_IN_KEY',    'qJ+<ofIH&p]i7oRktD]{ZuMs|evQBoeTnn`H`a:x6Mn2_OQlCEvA,[x-u<VD87k ');
define('NONCE_KEY',        '& VtTPUBF>IJH|`j4P3w%3Io.L/{_eR3PEXY3|/L_dzF<Vx}$-|e2)gHIg+|a*>i');
define('AUTH_SALT',        '+aON|eu?Y(hX]E/?B<g??WUdwIWVr^4}7|{YF^IWZ!F+GYoDHM,)-,1&Z7 pm:!5');
define('SECURE_AUTH_SALT', 'jFLlt*&C0vFKw4Fz &c:#|z;o6n^:!82S2r-Nvhr]XbD|<g:Suu~`0kIH#o=4aof');
define('LOGGED_IN_SALT',   '@New:-/KxLv3nznCFR|2f}VL]3`w8aBnPExs24vTu+dno|b|HY>u[2=a4m_5z0zf');
define('NONCE_SALT',       'B}(10Ie~8Q~4~WC _BFr/tx5L=-BbEO]>?@.dq|^r^18o%5Mi~gEM(5{-kLcgpV%');


/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
