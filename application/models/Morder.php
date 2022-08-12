<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Morder extends CI_Model
{
    var $table = 'tb_order';
    var $column_order = array('namaBarang',  'penerima', 'alamatPenerima', 'noHpPenerima', 'jarakTempuh', 'idKurir', 'totalHarga', 'status', null);
    var $column_search = array('namaBarang', 'penerima', 'status');
    var $order = array('idOrder' => 'DESC');

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }


    public function view()
    {
        return $this->db->get('tb_order')->result();
    }



    public function insert($data)
    {
        $sql = "INSERT INTO tb_order (idBarang, penerima, alamatPenerima, noHpPenerima, idKurir, jumlahBeli, totalBerat, totalHarga, status, createdDate, createdBy)  
        VALUES(" . $this->db->escape($data['idBarang']) . ", " .
            $this->db->escape($data['penerima']) . ", " .
            $this->db->escape($data['alamatPenerima']) . ", " .
            $this->db->escape($data['noHpPenerima']) . ", " .
            $this->db->escape($data['jumlahBeli']) . ", " .
            $this->db->escape($data['idKurir']) . ", " .
            $this->db->escape($data['totalBerat']) . ", " .
            $this->db->escape($data['totalHarga']) . ", " .
            $this->db->escape($data['status']) . ", " .
            $this->db->escape($data['createdDate']) . ", " .
            $this->db->escape($data['createdBy']) . ")";
        $this->db->query($sql);
        return $this->db->affected_rows();
    }

    private function _get_datatables_query()
    {

        $this->db->from($this->table);

        $i = 0;

        foreach ($this->column_search as $item) // loop column 
        {
            if ($_POST['search']['value']) // if datatable send POST for search
            {

                if ($i === 0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        // var_dump('error nih');
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            // $this->db->where('deletedBy', '');
            $this->db->join('tb_barang brg', 'brg.idBarang=tb_order.idBarang');
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        // $this->db->where('deletedBy', '');
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        // $this->db->where('deletedBy', '');
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function get_by_id($idOrder)
    {
        $this->db->from($this->table);
        $this->db->join('tb_user', 'tb_user.id=tb_order.createdBy');
        $this->db->join('tb_kurir', 'tb_kurir.idKurir=tb_order.idKurir');
        $this->db->join('tb_barang', 'tb_barang.idBarang=tb_order.idBarang','left');
        $this->db->where('idOrder', $idOrder);
        $query = $this->db->get();

        return $query->row();
    }

    public function update($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }
    public function delete($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    public function get_harga($idBarang)
    {
        $this->db->where('idBarang', $idBarang);
        $query = $this->db->get('tb_barang');
        return $query->row();
    }

    public function get_harga_kurir($idKurir)
    {
        $this->db->where('idKurir', $idKurir);
        $query = $this->db->get('tb_kurir');
        return $query->row();
    }
}
