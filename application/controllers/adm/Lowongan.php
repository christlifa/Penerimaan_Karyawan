<?php
/**	
 * 
 * @author Lifa Christian <LifaChristian2@gmail.com>
 * November 2018
 */
use libraries\BaseController;
class Lowongan extends BaseController 
{
	/**
	 * Construcktor CodeIgniter
	 */
	public function __construct()
	{
		parent::__construct();

		$this->auth->check_auth();
		// load model
		$this->load->model('Lowongan_model');
	}

	public function index(){

		$data['content_title'] = 'Lowongan';
		$this->twiggy_display('adm/Lowongan/index', $data);
	}

	public function getData(){

			$data = [];
			$get_data = $this->Lowongan_model->getData()->result();

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
						'Skills'            => $this->Lowongan_model->getDataSKill($get_row->lowonganID)->result()
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
			$get_data = $this->Lowongan_model->getDataPendidikan()->result();

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
		    'lowonganNama'	=> $dataFromFe['lowonganNama'],
		    'pengalaman'	=> $dataFromFe['Pengalaman'],
		    'pendidikan'	=> $dataFromFe['Pendidikan'],
		    'usia'			=> $dataFromFe['usia'],
		    'Sallary'		=> $dataFromFe['Sallary'],
		    'isDone'        => 0
		    	
		);
		if($dataFinal){
			$save = $this->Lowongan_model->saveData($dataFinal);	
			
			output_json($save);	
		}
	}

	public function saveDataKemampuan(){

		$dataFromFe = (array)json_decode(file_get_contents('php://input'));
		foreach($dataFromFe as $get_row)
		{

			$dataFinal = array(
			    'kemampuan'		=> $get_row->kemampuan,
			    'lowonganID'	=> $get_row->lowonganID
			);
			$save = $this->Lowongan_model->saveDataKemampuan($dataFinal);
		}
	}


	public function deleteData(){
		$dataFromFe = (array)json_decode(file_get_contents('php://input'));
		$dataDelete = $dataFromFe;
		foreach($dataDelete as $row)
		{
			$delete_type = $this->Lowongan_model->deleteData($row);
		}
	}

	public function deleteDataKemampuan(){
		$dataFromFe = (array)json_decode(file_get_contents('php://input'));
		$dataDelete = $dataFromFe;
		foreach($dataDelete as $row)
		{
			$delete_type = $this->Lowongan_model->deleteDataKemampuan($row);
		}
	}
	
	public function updateData(){
		$dataFromFe = (array)json_decode(file_get_contents('php://input'));
		$id = $dataFromFe['lowonganID'];
		$dataFinal = array(
			'lowonganNama'	=> $dataFromFe['lowonganNama'],
		    'pengalaman'	=> $dataFromFe['Pengalaman'],
		    'pendidikan'	=> $dataFromFe['Pendidikan'],
		    'usia'			=> $dataFromFe['usia'],
		    'Sallary'		=> $dataFromFe['Sallary']
		);

		if($dataFinal){
			$save = $this->Lowongan_model->updateData($id,$dataFinal);		
		}
	}
	
	// ini kalo butuh get data child ga di get semua
	public function getGroupChildByGroupId($GroupId){
	        $data = [];
	        if($GroupId == 'all'){
	            $GroupId = '';
	        }
	        $get_data = $this->Dashboard_model->getGroupChildByGroupId($GroupId)->result();

	        // ketika data tersedia
	        // maka generate data json untuk Datatable
	        if($get_data)
	        {
	            $no = 1;
	            foreach($get_data as $k => $get_row)
	            {
	                $data[] = array(
	                    'no'               => $no,
	                    'GroupChildId'     => $get_row->GroupChildId,
	                    'GroupChildName'   => $get_row->GroupChildName,
	                    'GroupId'          => $get_row->GroupId,
	                    'IsActive'         => $get_row->IsActive,
	                    // 'dataChildFinal'   => $this->Dashboard_model->getGroupChildFinal($get_row->GroupChildId)->result(),


	                );

	                $addArray = array();
	                $temp = $this->Dashboard_model->getGroupChildFinal($get_row->GroupChildId)->result();
	                foreach ($temp as $key => $value) {
	                    
	                    $data[$k]['dataChildFinal'][$key] = array(
	                                    'GroupChildFinalId'         => $value->GroupChildFinalId,
	                                    'GroupChildFinalName'       => $value->GroupChildFinalName,
	                                    'GroupChildId'              => $value->GroupChildId,
	                                    'IsActive'                  => $value->IsActive,
	                                    'Dipilih'                   => 0,
	                                    'Dicek'                     => 0,
	                    );

	                }
	                $no++;
	            }
	        }

	        $response = [
	            'data'         => $data,
	            'recordsTotal' => count($data)
	        ];
	        output_json($response['data']);
	}
	
}
?>