<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Seo_model extends App_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->table = 'ml_seo_strategies';
    }

    public function get($id = null)
    {
        if (is_numeric($id)) {
            $this->db->where('id', $id);
            return $this->db->get($this->table)->row();
        }
        return $this->db->get($this->table)->result_array();
    }

    public function add($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }
}