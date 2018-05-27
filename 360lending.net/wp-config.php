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
#define('WP_HOME','https://www.360lending.net');
#define('WP_SITEURL','https://www.360lending.net');

define('WP_HOME','https://www.360homelending.com');
define('WP_SITEURL','https://www.360homelending.com');

define( 'AS3CF_AWS_ACCESS_KEY_ID',     'AKIAJLIEVPKZEWF3Q3ZQ' );
define( 'AS3CF_AWS_SECRET_ACCESS_KEY', '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' );


define('FORCE_SSL_ADMIN', true);
if (strpos($_SERVER['HTTP_X_FORWARDED_PROTO'], 'https') !== false)
       $_SERVER['HTTPS']='on';

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', '360lending-db');

/** MySQL database username */
define('DB_USER', '360lending-user');

/** MySQL database password */
define('DB_PASSWORD', '6iH&2b7[*.3J}6');

/** MySQL hostname */
define('DB_HOST', 'sql.lawrencemcdaniel.com');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         '&MUt-lR|7n!G2E>=6do79`MKY=*kgxUB%)<C@+PyGJUy.;.n-+ZXOP:Hb`4CN,g=');
define('SECURE_AUTH_KEY',  '-ZVh`oth>K p.;&GA`+>Ad)aISjfMZRG+@N#qggFG(keEA|DPQ`am%7|*QZR|d1t');
define('LOGGED_IN_KEY',    'xl8Ph=?Wtkl#z!,ljET%@2/-5%]ZH`Y<riiM*n(_3:+5 S)$>O4LDKByeL-z|?WM');
define('NONCE_KEY',        '+YJg#kkXb}3@ uKP4$wdP(}HAe*dw(z2<AGZqf+33/s`uTamC7!`i(<c{LKs+nb|');
define('AUTH_SALT',        '/S; L--X/(v}Ml++e(V4~ mka|A2>%y2V-CgX#D?WHyDRHma|-?FY&tRTA{33GRO');
define('SECURE_AUTH_SALT', 'c(jX:OjeAjA,K8sYu.xJ*qU$0R*bSY=5.OWfi9.$L+/}:uf{g7Mn||c@|Q[MRRY ');
define('LOGGED_IN_SALT',   'O+B}qnI+)`1+?1L|C++,Icsok{:[3p+fw6|<}cE/`AnK)coW48:#y]O?o$)aoc*r');
define('NONCE_SALT',       '9GbXu+vwt{2W-eE+m~S.;^(,UbhEamHc2!R+n3[[Lm!P/HRB:%`I%XTB+(3+rcSB');
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
