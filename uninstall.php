
<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Uninstallation script for EstrategiaSEOMercadoLivre module.
 */
$CI = &get_instance();
if ($CI->db->table_exists('estrategia_seo_data')) {
    $CI->db->query("DROP TABLE `estrategia_seo_data`;");
}
?>
