<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Main_model extends CI_Model
{


    public function getTable($table,$where = array(),$order = null,$oneField = false){
        if ($oneField){
            $this->db->select($oneField);
        }else{
            $this->db->select('*');
        }
        $this->db->from($table);

        if ($where != NULL) { $this->db->where($where); }
        if ($order != NULL) { $this->db->order_by($order); }
        $query = $this->db->get();

        if (!$oneField){
            return $query->result();
        }else{
            $arr = array();
            $convertArr = json_decode(json_encode($query->result()),true);
            foreach ($convertArr as $item => $k){
                $arr[] = $convertArr[$item][$oneField];
            }
            return $arr;
        }

    }

    public function getRow($table,$where = array()){
        $this->db->select('*');
        $this->db->from($table);
        if ($where != NULL) { $this->db->where($where); }
        $query = $this->db->get();
        return $query->row();
    }

    public function getNumRows($table,$where = array(),$field = false){
        if(!$field){
            $this->db->select('*');
        }
        else
        {
            $this->db->select($field);
        }
        $this->db->from($table);
        if ($where != NULL) { $this->db->where($where); }
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function getSum($table,$field = false,$where = array()){
        $this->db->select('sum('.$field.') as sum');
        $this->db->from($table);
        if ($where != NULL) { $this->db->where($where); }
        $query = $this->db->get();
        return $query->row()->sum;
    }

    public function basicinsert($tablo,$veri)
    {
        return $this->db->insert($tablo,$veri);
    }

    public function basicupdate ($tablo,$veri,$alan,$id)
    {
        $this->db->where($alan, $id);
        $this->db->update($tablo,$veri);
    }

    public function basicdelete ($tablo,$alan,$id)
    {
        $this->db->where($alan, $id);
        $this->db->delete($tablo);
    }

    public function normaldelete ($table,$where)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

   


}
