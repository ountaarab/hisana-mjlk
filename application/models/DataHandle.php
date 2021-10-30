<?php
class DataHandle extends CI_Model
{

    function getAll($tabel, $order = null)
    {
        $this->db->order_by($order);
        return $this->db->get($tabel);
    }

    function countGroup($namatable = null, $fieldcount = null, $order = null, $where = null, $join1 = null, $tabel2 = null)
    {
        $this->db->order_by($order);
        $this->db->group_by($fieldcount);
        $this->db->where($where);
        $this->db->select('count(' . $fieldcount . ') as jumlah, ' . $fieldcount . '');

        $this->db->join($tabel2, $join1);
        return $this->db->get($namatable);
    }



    function getAllWhere($tabel1, $field, $where, $order = null)
    {
        $this->db->select($field);
        $this->db->from($tabel1);
        $this->db->where($where);
        $this->db->order_by($order);
        return $this->db->get();
    }


    function getAllWhereLim($tabel1, $field, $where, $order = null, $limit = null, $offset = null)
    {
        $this->db->select($field);
        $this->db->from($tabel1);
        $this->db->where($where);
        $this->db->limit($limit, $offset);
        $this->db->order_by($order);
        return $this->db->get();
    }
    function getAllWhereLimm($tabel1, $field, $where, $order = null, $limit = null, $start = null)
    {

        return $this->db->select($field)
            ->where($where)
            ->order_by($order)
            ->get($tabel1, $limit, $start);
    }

    function getAllWhereNotIn($tabel1, $field, $where)
    {
        $this->db->select($field);
        $this->db->from($tabel1);
        $this->db->where_not_in($where);
        return $this->db->get();
    }

    function get_like($tabel1, $field, $field2, $value, $where, $order)
    {
        $this->db->select($field);
        $this->db->from($tabel1);
        $this->db->where($where);
        $this->db->like($field2, $value, 'after');
        $this->db->order_by($order);
        return $this->db->get();
    }

    function sum($tabel, $field)
    {
        $this->db->select_sum($field);
        return $this->db->get($tabel)->result();
    }


    function insert($tabel, $insert)
    {
        return  $this->db->insert($tabel, $insert);
    }

    function insert_batch($tabel, $insert)
    {
        return  $this->db->insert_batch($tabel, $insert);
    }

    function update_batch($tabel, $dataUpdate, $id)
    {
        return  $this->db->update_batch($tabel, $dataUpdate, $id);
    }

    function insert_web($tabel, $insert)
    {
        $db2 = $this->load->database('db_web', TRUE);
        return  $db2->insert($tabel, $insert);
    }

    function update($tabel, $data, $where)
    {
        $this->db->where($where);
        return $this->db->update($tabel, $data);
    }

    function delete($tabel, $where)
    {
        return $this->db->delete($tabel, $where);
    }

    function get_last_id()
    {
        return $this->db->insert_id();
    }

    function other_query($query)
    {
        return $this->db->query($query);
    }

    function get($tabel, $where)
    {
        return $this->db->get_where($tabel, $where);
    }

    function get_order($tabel, $where, $order)
    {
        $this->db->where($where);
        $this->db->order_by($order, 'asc');
        return $this->db->get($tabel);
    }

    function insert_verif($tabel, $data)
    {

        return $this->db->insert_batch($tabel, $data);
    }
}
