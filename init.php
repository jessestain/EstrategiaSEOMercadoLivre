
<?php
defined('BASEPATH') or exit('No direct script access allowed');

hooks()->add_action('admin_init', function () {
    $CI = &get_instance();
    $CI->app_menu->add_sidebar_menu_item('estrategia_seo_ml', [
        'name' => _l('SEO Mercado Livre'), // Nome exibido no menu
        'icon' => 'fa fa-line-chart', // Ícone
        'href' => admin_url('estrategia_seo_ml'), // URL do módulo
    ]);
});
