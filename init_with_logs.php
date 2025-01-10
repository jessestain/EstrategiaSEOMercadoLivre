<?php

defined('BASEPATH') or exit('No direct script access allowed');

// Register module
register_activation_hook(ESTRATEGIA_SEO_ML_MODULE_NAME, 'estrategia_seo_ml_activation_hook');
register_deactivation_hook(ESTRATEGIA_SEO_ML_MODULE_NAME, 'estrategia_seo_ml_deactivation_hook');
register_uninstall_hook(ESTRATEGIA_SEO_ML_MODULE_NAME, 'estrategia_seo_ml_uninstall_hook');

// Load module dependencies
$CI = &get_instance();
require_once(__DIR__ . '/helpers/api_helper.php');

// Register hooks
hooks()->add_action('admin_init', 'estrategia_seo_ml_init_menu_items');


        function estrategia_seo_ml_init_menu_items()
        {
            log_message('debug', '[EstrategiaSEOMercadoLivre] Iniciando registro do menu.');
        
{
    $CI = &get_instance();
    
        log_message('debug', '[EstrategiaSEOMercadoLivre] Adicionando item ao menu.');
        $CI->app_menu->add_sidebar_menu_item('estrategia-seo', [
        
        'name'     => 'Estratégias de SEO',
        'href'     => admin_url('estrategia_seo_mercadolivre'),
        'position' => 10, // Posição no menu
        'icon'     => 'fa fa-search', // Ícone
    ]);
}

hooks()->add_action('admin_init', 'estrategia_seo_ml_permissions');

function estrategia_seo_ml_permissions()
{
    $capabilities = [
        'view',
        'create',
        'edit',
        'delete',
    ];

    foreach ($capabilities as $capability) {
        register_staff_capability('estrategia_seo_' . $capability, [
            'staff_capabilities' => true,
        ]);
    }
}

// Define module constants
define('ESTRATEGIA_SEO_ML_MODULE_NAME', 'estrategia_seo_mercadolivre');
