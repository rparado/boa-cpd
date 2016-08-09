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
define('DB_NAME', 'boa');

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
define('AUTH_KEY',         '@JQA|eBPXc.{ZEoHM;aC-_n-H`JJxJi<DNGf{J8V-_kpLi[+H+muUHm+<:f@.&Oi');
define('SECURE_AUTH_KEY',  '(#bB|o<E@%W{HO Vi% =?GiiUGc/dg{PpY:tDgBR>c%,KX2x*ko{.WS3|hGZ2a[7');
define('LOGGED_IN_KEY',    'SW,miFfygErSC%vE76EL<&=mx2[Q+Q1nC;P$=2jvjxhbqUz>f4M`,(X 9|j6oS J');
define('NONCE_KEY',        'n8@q*n-Z:C9~$_^lU/+}hzJRd jGyyms2&;/6=X`5E%x#i`/h_-eEZ%/Eux3(d|b');
define('AUTH_SALT',        'zK*,hNq]0*}k.a5xxm`uuAd>u qtLc<V 0R7xQiT^v5b}&$lJlgy1M!X!0%xH2:T');
define('SECURE_AUTH_SALT', 'E0YS`nN29RMpgNGxnJUO8lZZ%?K<iLTsFx4b6Hk>Geh)^0p602u9S~)2wS7?t uI');
define('LOGGED_IN_SALT',   'RRv/f$rh]+|sg Uw .n3F?o_9}un&=LCJYT+4km=/[)w&MT8QL>O<Uh,|(Vrho5>');
define('NONCE_SALT',       'aol`t6Eag$[WIpZmGqxdUN!Bb^avF_92mHXmOX [OW2bm`}Q)M1ss9{&}uRkvVHR');

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
