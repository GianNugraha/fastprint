<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *  Post Controller
 */
class Item extends CI_Controller
{

	function __construct()
	{
		parent::__construct();

		$this->load->library('form_validation', 'encryption');
		// $this->load->library('encryption');
		$this->load->model('crud');
	}

	public function index()
	{
		$data['data'] = $this->crud->get_records('items', 'bisa dijual');
		$this->load->view('item/list', $data);
	}


	public function create()
	{
		$this->load->view('item/create');
	}

	public function generate()
	{	
		$password = "bisacoding-".date('d-m-y', strtotime('now'));
		$url = "https://recruitment.fastprint.co.id/tes/api_tes_programmer";
		$hashpassword = md5($password);

		date_default_timezone_set('Asia/Manila');
		$username = "tesprogrammer".date("dmy")."C".date("H");
		$data_array = array('username' => $username,'password' => $hashpassword, 
		'https' => array('header' => 'Content-Type: application/json'));

			$data = http_build_query($data_array);
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

			$reply=curl_exec($ch);
			
			if($e = curl_error($ch)){
				echo $e;
			}else{
				$decode_data = json_decode($reply);
				foreach ($decode_data->data as $key => $value){
					$dataToSave = array(
						'id_produk' => $value->id_produk,
						'nama_produk' => $value->nama_produk,
						'kategori' => $value->kategori,
						'harga' => $value->harga,
						'status' => $value->status,
					 );
					 $this->crud->generate('items', $dataToSave);

					if ($this->db->trans_status() === FALSE)
					{
							$this->db->trans_rollback();
							$this->session->set_flashdata('message', '<div class="alert alert-danger">Data Gagal di Generate</div>');
							
					}
					else
					{
							$this->session->set_flashdata('message', '<div class="alert alert-success">Data Berhasil di Generate</div>');
							$this->db->trans_commit();
					}
				}
				redirect(base_url());
			}
			
			curl_close($ch);
			}

	public function store()
	{
		$this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required|integer');

        if ($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('message', '<div class="alert alert-danger">' .validation_errors().'</div>');
            redirect(base_url('item/create'));
        }else{
			$data['nama_produk'] = $this->input->post('nama_produk');
			$data['kategori'] = $this->input->post('kategori');
			$data['harga'] = $this->input->post('harga');
			$data['status'] = $this->input->post('status');
	
			$this->crud->insert('items', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success">Data Berhasil disimpan</div>');
			redirect(base_url());
        }

		
	}

	public function edit($id)
	{
		$data['data'] = $this->crud->find_record_by_id('items', $id);
		$this->load->view('item/edit', $data);
	}

	public function update($id)
	{
		$this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required|integer');
		if ($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('message', '<div class="alert alert-danger"> validation_errors()</div>');
            redirect(base_url('item/edit/' . $id));
        }
		else{
			$data['nama_produk'] = $this->input->post('nama_produk');
			$data['kategori'] = $this->input->post('kategori');
			$data['harga'] = $this->input->post('harga');
			$data['status'] = $this->input->post('status');

			$this->crud->update('items', $data, $id);
			$this->session->set_flashdata('message', '<div class="alert alert-success">Data Berhasil Diubah.</div>');
			redirect(base_url());
		}
	}

	public function delete($id)
	{
		$this->crud->delete('items', $id);
		$this->session->set_flashdata('message', '<div class="alert alert-success">Data Berhasil Dihapus</div>');
		redirect(base_url());
	}
}
