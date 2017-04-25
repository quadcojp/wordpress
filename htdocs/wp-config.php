<?php
/**
 * WordPress の基本設定
 *
 * このファイルは、インストール時に wp-config.php 作成ウィザードが利用します。
 * ウィザードを介さずにこのファイルを "wp-config.php" という名前でコピーして
 * 直接編集して値を入力してもかまいません。
 *
 * このファイルは、以下の設定を含みます。
 *
 * * MySQL 設定
 * * 秘密鍵
 * * データベーステーブル接頭辞
 * * ABSPATH
 *
 * @link http://wpdocs.osdn.jp/wp-config.php_%E3%81%AE%E7%B7%A8%E9%9B%86
 *
 * @package WordPress
 */

// 注意:
// Windows の "メモ帳" でこのファイルを編集しないでください !
// 問題なく使えるテキストエディタ
// (http://wpdocs.osdn.jp/%E7%94%A8%E8%AA%9E%E9%9B%86#.E3.83.86.E3.82.AD.E3.82.B9.E3.83.88.E3.82.A8.E3.83.87.E3.82.A3.E3.82.BF 参照)
// を使用し、必ず UTF-8 の BOM なし (UTF-8N) で保存してください。

// ** MySQL 設定 - この情報はホスティング先から入手してください。 ** //
/** WordPress のためのデータベース名 */
define('DB_NAME', 'wordpress');

/** MySQL データベースのユーザー名 */
define('DB_USER', 'wordpress');

/** MySQL データベースのパスワード */
define('DB_PASSWORD', 'wordpress!');

/** MySQL のホスト名 */
define('DB_HOST', 'db');

/** データベースのテーブルを作成する際のデータベースの文字セット */
define('DB_CHARSET', 'utf8mb4');

/** データベースの照合順序 (ほとんどの場合変更する必要はありません) */
define('DB_COLLATE', '');

/**#@+
 * 認証用ユニークキー
 *
 * それぞれを異なるユニーク (一意) な文字列に変更してください。
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org の秘密鍵サービス} で自動生成することもできます。
 * 後でいつでも変更して、既存のすべての cookie を無効にできます。これにより、すべてのユーザーを強制的に再ログインさせることになります。
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '|^(Vd`<*~hsdh<5S)e-v}iWGY`AyOSfN%n/=|~SES$%wcBfG$_en?8e>?G=-]_tk');
define('SECURE_AUTH_KEY',  'dsgjYsF4v(F&[-kFp-uZPU[T[OY,66=C4cbPW[yr#w8j~r}i?}: c9fT__5-Yv$U');
define('LOGGED_IN_KEY',    'Bu%I|uf$h._OKFv3k5n}?O|.Q@JdYD`|a[lwP=:~]Xt}39cG-`~QvPOe8!A-yxX-');
define('NONCE_KEY',        'Z^bYqx@h<(9 FX@%-ZcUd:#Hc#U/c8M&j>B|~e=^$j:umYev^.a*[$j#u ShObMl');
define('AUTH_SALT',        'P%#sa~Bb9RX10]e+qFR(73HM~3JGha_1dZS>z*{?x5&C/U<}-@bsevB;V-31m%*M');
define('SECURE_AUTH_SALT', 'BxcPJVwdBV.7),.7*xwycw#-E,M`%6NN[BW^Ji^s75<^/lrR;U<B[4R#jI>,>8<-');
define('LOGGED_IN_SALT',   'KwNw(q3H.^xtukzOleo,non&@?+^Fi{a2mJH1UnbNZ=[c7(uD/?O|AN6]!rJ?Z=A');
define('NONCE_SALT',       'ph(U0^ec ;C=[we_28E=Vw7Y$h?T#t69RHGe603wglo0w&_EZtyYjU(j]R)V+d{6');

/**#@-*/

/**
 * WordPress データベーステーブルの接頭辞
 *
 * それぞれにユニーク (一意) な接頭辞を与えることで一つのデータベースに複数の WordPress を
 * インストールすることができます。半角英数字と下線のみを使用してください。
 */
$table_prefix  = 'wp_';

/**
 * 開発者へ: WordPress デバッグモード
 *
 * この値を true にすると、開発中に注意 (notice) を表示します。
 * テーマおよびプラグインの開発者には、その開発環境においてこの WP_DEBUG を使用することを強く推奨します。
 *
 * その他のデバッグに利用できる定数については Codex をご覧ください。
 *
 * @link http://wpdocs.osdn.jp/WordPress%E3%81%A7%E3%81%AE%E3%83%87%E3%83%90%E3%83%83%E3%82%B0
 */
define('WP_DEBUG', false);

/* 編集が必要なのはここまでです ! WordPress でブログをお楽しみください。 */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
