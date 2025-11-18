<?php
/**
 * @author Hikmahtiar <hikmahtiar.cool@gmail.com>
 */
class Loginweb extends CI_Controller 
{
	/**
	 * Constructor Codeigniter
	 */
	public function __construct()
	{
		parent::__construct();

		$this->load->model('login_model');
	}

	/**
	 * Halaman Index
	 */
	public function index()
	{
		$this->load->view('login/index');
	}
	
	public function getData(){

			$data = [];
			$get_data = $this->login_model->getData()->result();

			// ketika data tersedia
			// maka generate data json untuk Datatable
			if($get_data)
			{
				$no = 1;
				foreach($get_data as $get_row)
				{
					$data[] = array(
						'no'                => $no,
						'lowonganID'    	=> $get_row->lowonganID,
						'lowonganNama'    	=> $get_row->lowonganNama,
						'pengalaman'		=> $get_row->pengalaman,
						'pendidikan'		=> $get_row->pendidikan,
						'usia'				=> $get_row->usia,
						'Sallary'			=> $get_row->Sallary,
						'NamaPendidikan'    => $get_row->NamaPendidikan,
						'Skills'            => $this->login_model->getDataSKill($get_row->lowonganID)->result()
					);
					$no++;
				}
			}

			$response = [
	            'data'         => $data,
	            'recordsTotal' => count($data)
	        ];
	        // print_r($response);
	        output_json($response['data']);
	}

	public function getDataPendidikan(){

			$data = [];
			$get_data = $this->login_model->getDataPendidikan()->result();

			// ketika data tersedia
			// maka generate data json untuk Datatable
			if($get_data)
			{
				$no = 1;
				foreach($get_data as $get_row)
				{
					$data[] = array(
						'no'        => $no,
						'GlobalId'  => $get_row->GlobalId,
						'Nama'    	=> $get_row->Nama,
						'Code'		=> $get_row->Code
					);
					$no++;
				}
			}

			$response = [
	            'data'         => $data,
	            'recordsTotal' => count($data)
	        ];
	        // print_r($response);
	        output_json($response['data']);
	}

	public function saveData(){
		$dataFromFe = (array)json_decode(file_get_contents('php://input'));
		$dataFinal = array(
		    'nama'				=> $dataFromFe['nama'],
		    'usia'				=> $dataFromFe['usia'],
		    'email'				=> $dataFromFe['email'],
		    'telpon'			=> $dataFromFe['telpon'],
		    'pendidikan'		=> $dataFromFe['pendidikan'],
		    'pengalaman'		=> $dataFromFe['pengalaman'],
		    'gaji'				=> $dataFromFe['gaji'],
		    'isAcc'				=> 0,
		    'isEmailSend'		=> 0,
		    'tanggalUndangan'	=> null,
		    'lowonganID'		=> $dataFromFe['lowonganID'],
		    	
		);
		if($dataFinal){
			$save = $this->login_model->saveData($dataFinal);	
			
			output_json($save);	
		}
	}

	public function saveDataKemampuan(){

		$dataFromFe = (array)json_decode(file_get_contents('php://input'));
		foreach($dataFromFe as $get_row)
		{

			$dataFinal = array(
			    'kemampuan'		=> $get_row->kemampuan,
			    'lamaranID'		=> $get_row->lamaranID
			);
			$save = $this->login_model->saveDataKemampuan($dataFinal);
		}
	}
	/**
	 * Proses Login
	 */
	public function proses_login()
	{
		$usernama = $this->input->post('usernama');
		$sandi = $this->input->post('sandi');
		// echo($sandi);
		// $outletId = $this->input->post('OutletId');
		// echo($outletId);
		// echo "$outletId ";

		$login = $this->login_model->get_data_advance($usernama, $sandi)->row();

		if ($login)
		{
			$session = array(
				'user_id'  => $login->LoginId,
				'Jabatan' => $login->Jabatan
			);

			$this->session->set_userdata($session);

			redirect('adm/Dashboard');	
		}
		else
		{
			$message = "Username atau password tidak sesuai, silahkan login kembali.";

			$this->session->set_flashdata('notifikasi_login', $message);

			$this->index();
		}
	}
}
?>