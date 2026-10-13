<?php
define( 'WP_CACHE', true ); // Added by WP Rocket


define('DISABLE_WP_CRON', false);
define( 'WP_AUTO_UPDATE_CORE', false );
define( 'AUTOMATIC_UPDATER_DISABLED', true );


/**
 * As configurações básicas do WordPress
 *
 * O script de criação wp-config.php usa esse arquivo durante a instalação.
 * Você não precisa usar o site, você pode copiar este arquivo
 * para "wp-config.php" e preencher os valores.
 *
 * Este arquivo contém as seguintes configurações:
 *
 * * Configurações do banco de dados
 * * Chaves secretas
 * * Prefixo do banco de dados
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Configurações do banco de dados - Você pode pegar estas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define( 'DB_NAME', 'facisa' );

/** Usuário do banco de dados MySQL */
define( 'DB_USER', 'root' );

/** Senha do banco de dados MySQL */
define( 'DB_PASSWORD', '' );

/** Nome do host do MySQL */
define( 'DB_HOST', 'localhost' );

/** Charset do banco de dados a ser usado na criação das tabelas. */
define( 'DB_CHARSET', 'utf8mb4' );

/** O tipo de Collate do banco de dados. Não altere isso se tiver dúvidas. */
define( 'DB_COLLATE', '' );

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las
 * usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org
 * secret-key service}
 * Você pode alterá-las a qualquer momento para invalidar quaisquer
 * cookies existentes. Isto irá forçar todos os
 * usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'Vg7}|a=K#(Cd9{xH$UjtcT_T-|b(/08pV)w(lIO z{j,-)5Ft6<&.79#Qc!lez}D' );
define( 'SECURE_AUTH_KEY',  'BP<3:t M]`_L=UY&kkUEJ}$ 8x:4?5hRK]gdy:$Q+!UY0^Q)i#-d62/>>0yElp(^' );
define( 'LOGGED_IN_KEY',    '=yI(<y Ro}23fujyL25}l6=nd$(<@[(,-GPwYo=[Z,/|mXRCQ@QSx;Ac/Z%d#0c{' );
define( 'NONCE_KEY',        '(bSyF6Ow.8ldIHw3Ij*|)i.D9J?gg*71Y7.? PnwKZK>v,L6xVl}Eh;s._PP;G,.' );
define( 'AUTH_SALT',        're:x1[1EiXQ(2,P}lb+<Pj])wLFu|q}}RJC6[==1*1Q}Y/Ag2<<48Ub<p!*}C+{;' );
define( 'SECURE_AUTH_SALT', 'dbtig<8AK[~r%zCRxFodslP/ZF3x28#mRqX]]=)avMkO/iKS<u|59[V@jN9~@7@g' );
define( 'LOGGED_IN_SALT',   'mgSVvL~eP!=RyvD22glgzFI7{^cwq+APii6 vfZH~vD]93v0r4m1yfUU*X^HQ=Ec' );
define( 'NONCE_SALT',       'BCQ3>uLv5O`=HxK0,vEs|(8q[tX+m^MPk<tbl8,F>aYPb+CgIL4F<z+W+zP(*|S7' );

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der
 * um prefixo único para cada um. Somente números, letras e sublinhados!
 */
$table_prefix = 'wp_';

/**
 * Para desenvolvedores: Modo de debug do WordPress.
 *
 * Altere isto para true para ativar a exibição de avisos
 * durante o desenvolvimento. É altamente recomendável que os
 * desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 *
 * Para informações sobre outras constantes que podem ser utilizadas
 * para depuração, visite o Codex.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );
define( 'WP_DEBUG_DISPLAY', false );
ini_set('display_errors', 0);
error_reporting(0);

/* Adicione valores personalizados entre esta linha até "Isto é tudo". */



/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Configura as variáveis e arquivos do WordPress. */
require_once ABSPATH . 'wp-settings.php';
