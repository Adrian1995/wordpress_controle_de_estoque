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
define('DB_NAME', 'testewpphp');

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
define('AUTH_KEY',         ';O0.3.93L-$2_pS62Lq2QVp9|=x-!]z9TTG_|,@`X?sxc)|l5U(4cGE<+k]`9sKI');
define('SECURE_AUTH_KEY',  '<8,+%Lj)^]Y>`8-RJ>A+U;@NBs]vAX01.B a/|IYS=o( Mnl~FB1.ItGzC2?RF%V');
define('LOGGED_IN_KEY',    ')  jS4D7BVSL+:vl<_^s,2nff$/gfy//&q1K5}`lj1(rDF8TOmXFGt5eGF5-&V8_');
define('NONCE_KEY',        'mJu(SeuE]1`X(mkmA *H+vz v++-;WBy?sF`iPRs3zj|7Uo+b8k|PUViP+Yr+:sC');
define('AUTH_SALT',        '9cz8cG|=^d-0$@|]eJh@l:fnmJJ;9@nMI3M]6b>-eLGa+GA(9m.4-,]s^*1C/pYQ');
define('SECURE_AUTH_SALT', '{ L55!UT/`e@7.kW[f2&BY-H-G0QI6.+6E>%r[RE>-L5I4+xAfx>+Q]Q{n2;thq~');
define('LOGGED_IN_SALT',   '3$2BCJ{|POTg4z>.=s2?Fb{y0}YNTI[B9-@S vMZ,FpKRB^Q-`~dW*50Z4<xz`4N');
define('NONCE_SALT',       '|pc*xQ~O2>07z_NrP@+J+/^s6W[t~;t)^fiuJ.g?q(`3.=KoYn^a+T;:jhrA,rZm');

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
