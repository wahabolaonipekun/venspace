<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'venspace' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );
define('FS_METHOD', 'direct');

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '.x/:,Zw3<+l7M^s/`v;nk:yg8N,,L}.]9<4f7$Ht_g4+OFc309R[pC@,hi?Nlj9D' );
define( 'SECURE_AUTH_KEY',  'KH[GHrU}2Zp#0U|l(L*1j4Q@foY &s?!oO8Nr1Gy:lq .GXXG_?_{64YBs59]N8S' );
define( 'LOGGED_IN_KEY',    '|-rLdQH;M27)X7UDu2K6H#)1lp dov;cIv[.g*+GwZF<Q_!^w!:<Rl%}|7v-(dan' );
define( 'NONCE_KEY',        'Ul{H|JIEtLrHfcO5M#.JQIY2|r67wSn6mH|PID{<T;T!wXH]0v0RD|24$,L3!bC?' );
define( 'AUTH_SALT',        '0co`%Rz}Z.U|=DRT>sFHJH]3N0H0f>|vdShzln!OU]l^A+OD1{`u!Z:ib>+^HTD_' );
define( 'SECURE_AUTH_SALT', 'J{%da_,JFPoguWK}`cT&^^cn{mz!loH P?A~&o%5|6-+1p/oDoK8y>z?{p:5~-!c' );
define( 'LOGGED_IN_SALT',   'e}!F`D!uA5l}</d7s{:uN~H.gd4i?_2KIi7wn-YTi.BPTcQ|]qHQV9?e9vEPa1ws' );
define( 'NONCE_SALT',       'S!CrmPJOO./U^3v-fTy*vSIA=PN5SU]*FiX,5O7_&I9JFSU}70[]eJSE?Iym1D-~' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'vs_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', true );
define('AUTOMATIC_UPDATER_DISABLED', true);
define('WP_AUTO_UPDATE_CORE', false);
/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
