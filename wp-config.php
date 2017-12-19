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
define('DB_NAME', 'amazon');

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
define('AUTH_KEY',         '/)Cf#qIH=mPE}kzvdGk{7UL cv)v]y`5|(@PZ a%cpX4V.9qxLY&)q0g@)!NY&++');
define('SECURE_AUTH_KEY',  ')3Pu?@C-|m?E9JQ*+Kcd3YNnavKw2y HmW:D@X3NYpS}Fj02#tCr;viOX+.<W3ca');
define('LOGGED_IN_KEY',    '}yW:s8N$?w;$ d|tznx*=uZ4A{O^mR~7+(%d4f)X<vnP[ Lm-B~H2?G&16i$s]V_');
define('NONCE_KEY',        'eVlY7)iAISKI[QXh*W@$aF%.&S4]F^;6OAAzP:%G[FN_GfK``YO~M@/$DL}AE0B[');
define('AUTH_SALT',        'HG$4K=y`^&l`p5$go0B&Dj4YcMa*XD)8dy!)v[AT)dPOhpXjR=T(&&hs|&`9j pr');
define('SECURE_AUTH_SALT', ':gzM!wR&R1IgWUtS(5H^?vKtfK*e.KZ$iiZBBK%mNwQxM?mN;80rYD{v#599Ow0H');
define('LOGGED_IN_SALT',   'WvsJ;*P% L$WA2(c17zXKgtG)v44;_XFH8i2KGq@2U%AB=~+x#Jd.Q(3~P=8>9#q');
define('NONCE_SALT',       'JOF=Tv#g aH%1BL,.yjJB<f7Kv7#YvE_Q87~QQBm*[waZ:=&u=CQ3=/(*E<,O7-8');

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

// Edited by kamrul
