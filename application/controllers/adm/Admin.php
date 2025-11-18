<?php
/**	
 * 
 * @author Lifa Christian <LifaChristian2@gmail.com>
 * November 2018
 */
use libraries\BaseController;
class Admin extends BaseController 
{
	/**
	 * Construcktor CodeIgniter
	 */
	public function __construct()
	{
		parent::__construct();

		$this->auth->check_auth();
		// load model
		$this->load->model('Admin_model');
	}

	public function index(){

		$data['content_title'] = 'Admin';
		$this->twiggy_display('adm/Admin/index', $data);
	}

	public function getData(){

			$data = [];
			$get_data = $this->Admin_model->getData()->result();

			// ketika data tersedia
			// maka generate data json untuk Datatable
			if($get_data)
			{
				$no = 1;
				foreach($get_data as $get_row)
				{
					$data[] = array(
						'no'            => $no,
						'LoginId'    	=> $get_row->LoginId,
						'Username'    	=> $get_row->Username,
						'Password'		=> $get_row->Password
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
		    'Username'	=> $dataFromFe['Username'],
		    'Password'	=> $dataFromFe['Password']
		    	
		);
		if($dataFinal){
			$save = $this->Admin_model->saveData($dataFinal);	
			
		}
	}



	public function deleteData(){
		$dataFromFe = (array)json_decode(file_get_contents('php://input'));
		$dataDelete = $dataFromFe;
		foreach($dataDelete as $row)
		{
			$delete_type = $this->Admin_model->deleteData($row);
		}
	}

	
	public function updateData(){
		$dataFromFe = (array)json_decode(file_get_contents('php://input'));
		$id = $dataFromFe['LoginId'];
		$dataFinal = array(
			'Username'	=> $dataFromFe['Username'],
		    'Password'	=> $dataFromFe['Password']
		);

		if($dataFinal){
			$save = $this->Admin_model->updateData($id,$dataFinal);		
		}
	}
	
}
?>