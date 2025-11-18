<?php
/**	
 * 
 * @author Lifa Christian <LifaChristian2@gmail.com>
 * November 2018
 */
use libraries\BaseController;
class Lamaran extends BaseController 
{
	/**
	 * Construcktor CodeIgniter
	 */
	public function __construct()
	{
		parent::__construct();

		$this->auth->check_auth();
		// load model
		$this->load->model('Lamaran_model');
	}

	public function index(){

		$data['content_title'] = 'Lamaran';
		$this->twiggy_display('adm/Lamaran/index', $data);
	}

	public function getDataLowongan(){

			$data = [];
			$get_data = $this->Lamaran_model->getDataLowongan()->result();

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
						// 'pengalaman'		=> $get_row->pengalaman,
						// 'pendidikan'		=> $get_row->pendidikan,
						// 'usia'				=> $get_row->usia,
						// 'Sallary'			=> $get_row->Sallary,
						// 'NamaPendidikan'    => $get_row->NamaPendidikan,
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

	public function getDataPelamar($Id){

			$data = [];
			$get_data = $this->Lamaran_model->getData($Id)->result();

			// ketika data tersedia
			// maka generate data json untuk Datatable
			if($get_data)
			{
				$no = 1;
				foreach($get_data as $get_row)
				{
					$data[] = array(
						'no'        		=> $no,
						'lamaranID'			=> $get_row->lamaranID,
						'nama'    			=> $get_row->nama,
						'usia'    			=> $get_row->usia,
						'email'    			=> $get_row->email,
						'telpon'    		=> $get_row->telpon,
						'pendidikan'    	=> $get_row->pendidikan,
						'pendidikanName'    => $get_row->pendidikanName,
						'pengalaman'    	=> $get_row->pengalaman,
						'gaji'    			=> $get_row->gaji,
						'isAcc'    			=> $get_row->isAcc,
						'isEmailSend'    	=> $get_row->isEmailSend,
						'tanggalUndangan'	=> $get_row->tanggalUndangan,
						'pendidikan'		=> $get_row->pendidikan,
						'Skills'            => $this->Lamaran_model->getDataSKill($get_row->lamaranID)->result()
						
						// 'Sallary'			=> $get_row->Sallary,
						// 'NamaPendidikan'    => $get_row->NamaPendidikan,
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

	
}
?>