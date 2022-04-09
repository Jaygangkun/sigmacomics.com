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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'elbomber_sigma' );

/** MySQL database username */
define( 'DB_USER', 'elbomber_sigma' );

/** MySQL database password */
define( 'DB_PASSWORD', '(K!vJ-ff1.^G' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         'U^drc1rgqBua>9!2]|~q7[%}`J-}~O02IWH_8NvN%CoaF}tBDd4+FF{X37Pq+(};' );
define( 'SECURE_AUTH_KEY',  'vG Xj<$tyNkc,Rc%+C@@e9uZutEcNy,S;kqZz3qqPR)C{XI8Sl5[Aj/Fe19v#Ekr' );
define( 'LOGGED_IN_KEY',    '3vUZ]$v=Ou1[fjk2}]#|-a*h?Q}4d>J&~UC*gW=1aj%dnD!R%NM*)5A(O&xI&)U1' );
define( 'NONCE_KEY',        ' g1[ppAfIU :f;z89sX2vgSr]%eV.C8`t>2QPP*dCMg(?5Xs@%V330G972{8+SYW' );
define( 'AUTH_SALT',        'm}EL.GPJNIpEi5Ozpp*M`LOI{u[ >o[VGVSzx5Z}VB!M7[`E_$c7o|W1:|7c/r|;' );
define( 'SECURE_AUTH_SALT', 'N(!443w_,*E=)9Uwmdl,M4prhm{^,.y-dQ^yWjj%zr}o=k]ht$zWYlu)sPSzm|Ng' );
define( 'LOGGED_IN_SALT',   '-hm0t4AKXu?O{sikrNrIf,T#PvLU+M0d99grg<i>5QshcGc]iKwQqJ5dc$=F(Pa5' );
define( 'NONCE_SALT',       '4;l.cmivN{EB3$ B&>q~:H5kQAVUi%Gfyhh=(WJjmC.B0L00,_Myjo-6 .x$QiHM' );

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
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
