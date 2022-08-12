<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");


class Order extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->helper('url', 'form');
        $this->load->library('form_validation');
        $this->load->model('Morder', 'order');
    }

    public function index()
    {
        $data['title'] = 'Choir Express | Order';
        $data['titleMenu'] = 'Menu Order';
        $data['menu'] = 'Master';
        $data['submenu'] = 'Order';

        $data['user'] = $this->db->get_where('tb_user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['tb_kurir'] = $this->db->get('tb_kurir')->result_array();

        $data['tb_barang'] = $this->db->get('tb_barang')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('order', $data);
        $this->load->view('templates/footer');
    }


    public function get_harga($idBarang)
    {
        $data = $this->order->get_harga($idBarang);
        echo json_encode($data);
    }

    public function get_harga_kurir($idKurir)
    {
        $data = $this->order->get_harga_kurir($idKurir);
        echo json_encode($data);
    }

    public function act_order_list()
    {
        $list = $this->order->get_datatables();
        $data = array();
        $no = $_POST['start'];
        $akses = $this->session->userdata('akses');
        foreach ($list as $order) {
            $status = $order->status;
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $order->namaBarang;
            $row[] = $order->penerima;
            $row[] = $order->alamatPenerima;
            $row[] = $order->noHpPenerima;
            $row[] = "Rp. " . number_format($order->totalHarga, 2) . ",-";

            if ($status == 'SUDAH PESAN') {
                $row[] = "<label style='background-color: green; color: white;' class='label-status'  > BELUM BAYAR </label>";
                if ($akses == 'admin') {
                    $row[] = "";
                } else {
                    $row[] = '<a class="btn btn-sm btn-primary border--r20" href="javascript:void(0)" title="Edit" onclick="pembayaran(' . "'" . $order->idOrder . "'" . ')"><i class="bi bi-cart-plus"></i> Pembayaran</a>';
                }
            } else if ($status == 'SUDAH BAYAR') {
                $row[] = "<label style='background-color: green; color: white;' class='label-status' > CHECK BY ADMIN </label>";
                if ($akses == 'admin') {
                    $row[] = '<a class="btn btn-sm btn-primary border--r20" href="javascript:void(0)" title="Edit" onclick="konfirmasi_buktitransfer(' . "'" . $order->idOrder . "'" . ')"><i class="bi bi-cart-check"></i> Konfirmasi</a>';
                } else {
                    $row[] = '<a class="btn btn-sm btn-primary border--r20" href="javascript:void(0)" title="Edit" onclick="detail_order(' . "'" . $order->idOrder . "'" . ')"><i class="bi bi-search"></i> Detail</a>';
                }
            } else if ($status == 'BUKTI TIDAK VALID') {
                $row[] = "<label style='background-color: green; color: white;' class='label-status'> BUKTI TIDAK VALID </label>";
                if ($akses == 'admin') {
                    $row[] = "";
                } else {
                    $row[] = '<a class="btn btn-sm btn-primary border--r20" href="javascript:void(0)" title="Edit" onclick="pembayaran(' . "'" . $order->idOrder . "'" . ')"><i class="bi bi-cart-plus"></i> Pembayaran</a>';
                }
            } else if ($status == 'PEMBAYARAN BERHASIL') {
                $row[] = "<label style='background-color: green; color: white;' class='label-status' > SEDANG PROSES </label>";

                if ($akses == 'admin') {
                    $row[] = '<a class="btn btn-sm btn-primary border--r20" href="javascript:void(0)" title="Edit" onclick="kirim_paket(' . "'" . $order->idOrder . "'" . ')"><i class="bi bi-cart-check"></i> Kirim Paket</a>';
                } else {
                    $row[] = '<a class="btn btn-sm btn-primary border--r20" href="javascript:void(0)" title="Edit" onclick="detail_order(' . "'" . $order->idOrder . "'" . ')"><i class="bi bi-search"></i> Detail</a>';
                }
            } else if ($status == 'SUDAH DIKIRIM') {
                $row[] = "<label style='background-color: green; color: white;' class='label-status' > SUDAH DIKIRIM </label>";
                if ($akses == 'admin') {
                    $row[] = '<a class="btn btn-sm btn-primary border--r20" href="javascript:void(0)" title="Edit" onclick="detail_order(' . "'" . $order->idOrder . "'" . ')"><i class="bi bi-search"></i> Detail</a>
                    <a class="btn btn-sm btn-primary border--r20" href="javascript:void(0)" title="Edit" onclick="terima_paket(' . "'" . $order->idOrder . "'" . ')"><i class="bi bi-check-all"></i> Sudah Diterima</a>';
                } else {
                    $row[] = '<a class="btn btn-sm btn-primary border--r20" href="javascript:void(0)" title="Edit" onclick="detail_order(' . "'" . $order->idOrder . "'" . ')"><i class="bi bi-search"></i> Detail</a>';
                }
            } else if ($status == 'SUDAH DITERIMA') {
                $row[] = "<label style='background-color: green; color: white;' class='label-status' > SUDAH DITERIMA </label>";
                if ($akses == 'admin') {
                    $row[] = "<label style='background-color: green; color: white;' class='label-status' > SELESAI </label>";
                } else {
                    $row[] = '<a class="btn btn-sm btn-primary border--r20" href="javascript:void(0)" title="Edit" onclick="detail_order(' . "'" . $order->idOrder . "'" . ')"><i class="bi bi-search"></i> Detail</a>';
                }
            }

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->order->count_all(),
            "recordsFiltered" => $this->order->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }


    public function act_get_by_id($id)
    {
        $data = $this->order->get_by_id($id);
        echo json_encode($data);
    }

    public function act_order_add()
    {
        $this->_validate_order();
        $date = date('Y-m-d G:i:s');
        $data = array(
            'idBarang' => $this->input->post('idBarang'),
            'beratBarang' => $this->input->post('beratBarang'),
            'hargaJual' => $this->input->post('hargaJual'),
            'jumlahBeli' => $this->input->post('jumlahBeli'),
            'penerima' => $this->input->post('penerima'),
            'noHpPenerima' => $this->input->post('noHpPenerima'),
            'alamatPenerima' => $this->input->post('alamatPenerima'),
            'totalBerat' => $this->input->post('totalBeratVal'),
            'totalHarga' => $this->input->post('totalHargaVal'),
            'idKurir' => $this->input->post('idKurir'),
            'status' => 'SUDAH PESAN',
            'createdDate' => $date,
            'createdBy' => $this->session->userdata('id_user'),
        );

        $insert = $this->order->insert($data);
        echo json_encode(array("status" => TRUE));
    }

    public function act_konfirmasi_update()
    {
        $date = date('Y-m-d G:i:s');
        $idUser = $this->session->userdata('id_user');

        $idOrder = $this->input->post('idOrder');
        $data = array(
            'idOrder' => $idOrder,
            'status' => $this->input->post('pilihKonfirmasi') == 'VALID' ? 'PEMBAYARAN BERHASIL' : 'BUKTI TIDAK VALID',
            'confirmationDate' => $date,
            'confirmationBy' => $idUser,
        );

        $this->order->update(array('idOrder' => $idOrder), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function act_kirim_update()
    {
        $date = date('Y-m-d G:i:s');
        $idUser = $this->session->userdata('id_user');

        $idOrder = $this->input->post('idOrder');
        $data = array(
            'idOrder' => $idOrder,
            'status' => 'SUDAH DIKIRIM',
            'sendDate' => $date,
            'sendBy' => $idUser,
        );

        $this->order->update(array('idOrder' => $idOrder), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function act_terima_update()
    {
        $date = date('Y-m-d G:i:s');
        $idUser = $this->session->userdata('id_user');
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if ($this->input->post('finishBy') == '') {
            $data['inputerror'][] = 'finishBy';
            $data['error_string'][] = 'Penerima wajib diisi';
            $data['status'] = FALSE;
        }

        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
        $idOrder = $this->input->post('idOrder');
        $data = array(
            'idOrder' => $idOrder,
            'status' => 'SUDAH DITERIMA',
            'finishDate' => $date,
            'finishBy' => $this->input->post('finishBy'),
        );

        $this->order->update(array('idOrder' => $idOrder), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function act_order_delete($id)
    {
        $date = date('Y-m-d G:i:s');
        $data = array(
            'deletedDate' => $date,
            'deletedBy' => 'sistem',
        );
        $this->order->delete(array('id' => $id), $data);
        echo json_encode(array("status" => TRUE));
    }


    private function _do_upload()
    {
        $config['upload_path']          = 'assets/images/bukti/';
        $config['allowed_types']        = 'jpg|png';
        $config['max_size']             = 300;
        $config['file_name']            = round(microtime(true) * 1000);

        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('buktiTransfer')) {
            if ($config['max_size'] > 300) {
                $data['inputerror'][] = 'buktiTransfer';
                $data['error_string'][] = 'Bukti Transfer  maksimal 300KB';
                $data['status'] = FALSE;
                echo json_encode($data);
                exit();
            } else {
                $data['inputerror'][] = 'buktiTransfer';
                $data['error_string'][] = 'Bukti Transfer  maksimal 300KB';
                $data['status'] = FALSE;
                echo json_encode($data);
                exit();
            }
        }
        return $this->upload->data('file_name');
    }

    public function act_order_update()
    {
        $date = date('Y-m-d G:i:s');
        $data = array();
        if (!empty($_FILES['buktiTransfer']['name'])) {
            $upload = $this->_do_upload();
            $data['buktiTransfer'] = $upload;
        }

        $data = array(
            'buktiTransfer' => $data['buktiTransfer'],
            'status' => 'SUDAH BAYAR',
            'transferDate' => $date,
            'transferBy' => $this->session->userdata('id_user'),
        );

        $this->order->update(array('idOrder' => $this->input->post('idOrder')), $data);
        echo json_encode(array("status" => TRUE));
    }

    private function _validate_order()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if ($this->input->post('idBarang') == '') {
            $data['inputerror'][] = 'idBarang';
            $data['error_string'][] = 'Nama barang wajib dipilih';
            $data['status'] = FALSE;
        }

        if ($this->input->post('jumlahBeli') == '') {
            $data['inputerror'][] = 'jumlahBeli';
            $data['error_string'][] = 'Jumlah beli wajib diisi';
            $data['status'] = FALSE;
        }

        if ($this->input->post('penerima') == '') {
            $data['inputerror'][] = 'penerima';
            $data['error_string'][] = 'Nama penerima wajib diisi';
            $data['status'] = FALSE;
        }
        if ($this->input->post('noHpPenerima') == '') {
            $data['inputerror'][] = 'noHpPenerima';
            $data['error_string'][] = 'No. Hp penerima wajib diisi';
            $data['status'] = FALSE;
        }
        if ($this->input->post('alamatPenerima') == '') {
            $data['inputerror'][] = 'alamatPenerima';
            $data['error_string'][] = 'Alamat penerima wajib diisi';
            $data['status'] = FALSE;
        }
        if ($this->input->post('idKurir') == '') {
            $data['inputerror'][] = 'idKurir';
            $data['error_string'][] = 'Kurir wajib dipilih';
            $data['status'] = FALSE;
        }

        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }
    // end of Order Controller
}
