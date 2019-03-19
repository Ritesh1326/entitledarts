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
define('DB_NAME', 'entitledarts');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'iq739_$Yt;R*bnrlXcYbjDNtyHchdjsn4HA&*e?~)]4_W/M]e//Em*t}5,v&wgLR');
define('SECURE_AUTH_KEY',  'Pnio3-`>%t|hh~d|)%rE]sCZB?uz,#hX]>}$zpudpGNHko&fK7G_Kkwf2G%HE;(r');
define('LOGGED_IN_KEY',    '/ [YCl5:!d)2I@9E~ETtcdobW3[h_j=#ep&5Ho3PR 3`jQ.iLl.<3s#)M&#{h}rt');
define('NONCE_KEY',        'P.PPs$.egoTGHHP4j4=8tX~5/-ME2E;J)^59Y~y]F@B^%u6*xjqz2Loi9}o3vt8B');
define('AUTH_SALT',        'o,5l2u67sL|V7+_S&yuW&@V-3[`l`B]rk`^>J$g@^6)5{4>7RuUr ,pJL=Pn9-Ae');
define('SECURE_AUTH_SALT', 'eUb`+J/b{4ZVTJYR<UwA)ry]=CW3hx@2qbO#<:pp<<2+RJL[.J2C{He~S&D[mQWi');
define('LOGGED_IN_SALT',   '=^ce(LN}$[KGJ(6|Hy ?x{<<OAqG!*Rxs>rZ~}u}xH<U?;43,ck*zQc20|c*M9uc');
define('NONCE_SALT',       'V^Mc!pFyLu4fAD,`.C5M^cY~#.YXN|Na`t_l?hbk,2/yRY=F@@zL[wfcJAkNy7rw');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
