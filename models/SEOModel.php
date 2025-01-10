
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SEOModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_seo_data()
    {
        return $this->db->get('mercadolivre_seo_data')->result_array();
    }
}
?>
