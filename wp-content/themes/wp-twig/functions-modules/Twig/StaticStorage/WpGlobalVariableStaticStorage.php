<?php

namespace FunctionsModules\Twig\StaticStorage;

use WP_Post;

final class  WpGlobalVariableStaticStorage
{
    /**
     * ОСНОВНОЙ ЗАПРОС WORDPRESS
     * @see https://wp-kama.ru/id_7641/globalnye-peremennye-v-wordpress.html#osnovnoj-zapros-wordpress
     *
     * @param [WP_VERSION]             - Текущая версия WordPress
     * @param [WP_DB_VERSION]          - Текущая версия базы данных
     * @param [TINYMCE_VERSION]        - Текущая версия редактора TinyMCE
     * @param [MANIFEST_VERSION]       - Версия манифеста кэша
     * @param [REQUIRED_PHP_VERSION]   - Минимальная версия PHP, которая требуется для текущего WordPress
     * @param [REQUIRED_MYSQL_VERSION] - Минимальная версия MySQL, которая требуется для текущего WordPress
     *
     * @return array
     */
    public static function getMainWordPressQuery(): array
    {
        global $wp_query, $more, $single;

        return [
            'WP_QUERY' => $wp_query,
            'MORE'     => $more,
            'SINGLE'   => $single,
        ];
    }

    /**
     * ПЕРЕМЕННЫЕ ВЕРСИЙ
     * @see https://wp-kama.ru/id_7641/globalnye-peremennye-v-wordpress.html#peremennye-versij
     *
     * @param [WP_VERSION]             - Текущая версия WordPress
     * @param [WP_DB_VERSION]          - Текущая версия базы данных
     * @param [TINYMCE_VERSION]        - Текущая версия редактора TinyMCE
     * @param [MANIFEST_VERSION]       - Версия манифеста кэша
     * @param [REQUIRED_PHP_VERSION]   - Минимальная версия PHP, которая требуется для текущего WordPress
     * @param [REQUIRED_MYSQL_VERSION] - Минимальная версия MySQL, которая требуется для текущего WordPress
     *
     * @return array
     */
    public static function getVersionVariables(): array
    {
        global $wp_version, $wp_db_version, $tinymce_version, $manifest_version, $required_php_version, $required_mysql_version;

        return [
            'WP_VERSION'             => $wp_version,
            'WP_DB_VERSION'          => $wp_db_version,
            'TINYMCE_VERSION'        => $tinymce_version,
            'MANIFEST_VERSION'       => $manifest_version,
            'REQUIRED_PHP_VERSION'   => $required_php_version,
            'REQUIRED_MYSQL_VERSION' => $required_mysql_version,
        ];
    }

    /**
     * ПЕРЕМЕННЫЕ БРАУЗЕРОВ
     * @see https://wp-kama.ru/id_7641/globalnye-peremennye-v-wordpress.html#peremennye-brauzerov
     *
     * @param ['IS_IPHONE'] - iPhone Safari
     * @param ['IS_CHROME'] - Google Chrome
     * @param ['IS_SAFARI'] - Safari
     * @param ['IS_NS4']    - Netscape 4
     * @param ['IS_OPERA']  - Opera
     * @param ['IS_MAC_IE'] - Mac Internet Explorer
     * @param ['IS_WIN_IE'] - Windows Internet Explorer
     * @param ['IS_GECKO']  - FireFox
     * @param ['IS_LYNX']   - Linux
     * @param ['IS_IE']     - является ли текущий браузер Internet Explorer
     * @param ['IS_EDGE']   - Microsoft Edge
     *
     * @return array
     */
    public static function getCheckingBrowsers(): array
    {
        global $is_iphone, $is_chrome, $is_safari, $is_NS4, $is_opera, $is_macIE, $is_winIE, $is_gecko, $is_lynx, $is_IE, $is_edge;

        return [
            'IS_IPHONE' => $is_iphone,
            'IS_CHROME' => $is_chrome,
            'IS_SAFARI' => $is_safari,
            'IS_NS4'    => $is_NS4,
            'IS_OPERA'  => $is_opera,
            'IS_MAC_IE' => $is_macIE,
            'IS_WIN_IE' => $is_winIE,
            'IS_GECKO'  => $is_gecko,
            'IS_LYNX'   => $is_lynx,
            'IS_IE'     => $is_IE,
            'IS_EDGE'   => $is_edge,
        ];
    }

    /**
     * ПЕРЕМЕННЫЕ ВЕБ-СЕРВЕРА
     * @see https://wp-kama.ru/id_7641/globalnye-peremennye-v-wordpress.html#peremennye-veb-servera
     *
     * @param [IS_APACHE] - Apache Server
     * @param [IS_NGINX]  - Nginx Server
     * @param [IS_IIS]    - Microsoft Internet Information Services (IIS)
     * @param [IS_IIS7]   - Microsoft Internet Information Services (IIS) v7.x
     *
     * @return array
     */
    public static function getWebServerVariables(): array
    {
        global $is_apache, $is_IIS, $is_iis7, $is_nginx;

        return [
            'IS_APACHE' => $is_apache,
            'IS_NGINX'  => $is_nginx,
            'IS_IIS'    => $is_IIS,
            'IS_IIS7'   => $is_iis7,
        ];
    }

    /**
     * @see https://wp-kama.ru/id_7641/globalnye-peremennye-v-wordpress.html#post
     *
     * @return WP_Post|null
     */
    public static function getWpPost(): ?WP_Post
    {
        global $post;

        return $post;
    }
}