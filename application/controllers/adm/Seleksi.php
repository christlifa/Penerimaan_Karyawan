<?php
/**	
 * 
 * @author Lifa Christian <LifaChristian2@gmail.com>
 * November 2018
 */
use libraries\BaseController;
class Seleksi extends BaseController 
{
	/**
	 * Construcktor CodeIgniter
	 */
	public function __construct()
	{
		parent::__construct();

		$this->auth->check_auth();
		// load model
		$this->load->model('Seleksi_model');
	}

	public function index(){

		$data['content_title'] = 'Seleksi';
		$this->twiggy_display('adm/Seleksi/index', $data);
	}

	public function getDataLowonganTr($lowonganID){

			$data = [];
			$get_data = $this->Seleksi_model->getData($lowonganID)->result();

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
						'Skills'            => $this->Seleksi_model->getDataSKill($get_row->lowonganID)->result()
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

	public function getDataPelamarTr($Id){

			$data = [];
			$get_data = $this->Seleksi_model->getDataLamaran($Id)->result();

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
						'Skills'            => $this->Seleksi_model->getDataSkillLamaran($get_row->lamaranID)->result()
						
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

	public function sendMail(){
	  $dataFromFe = (array)json_decode(file_get_contents('php://input'));
	
      $config = [
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'protocol'  => 'smtp',
            'smtp_host' => 'smtp.gmail.com',
            'smtp_user' => 'lifachristian2@gmail.com',  // Email gmail
            'smtp_pass'   => 'lifa12061998',  // Password gmail
            'smtp_crypto' => 'ssl',
            'smtp_port'   => 465,
            'crlf'    => "\r\n",
            'newline' => "\r\n"
        ];

        // Load library email dan konfigurasinya
        $this->load->library('email', $config);

        // Email dan nama pengirim
        $this->email->from('PT Clientsolve Mitra Solusi', '');

        // Email penerima
        // $this->email->to("lifachristian3@gmail.com"); 
        $this->email->to($dataFromFe['email']); // Ganti dengan email tujuan

        // Lampiran email, isi dengan url/path file
        // $this->email->attach('https://masrud.com/content/images/20181215150137-codeigniter-smtp-gmail.png');

        // Subject email
        $this->email->subject('undangan interview dari PT Clientsolve Mitra Solusi area Jakarta');

        // Isi email
        $this->email->message($dataFromFe['message']);
        // $this->email->message("masa iya ga masuk lagi babi");

        // Tampilkan pesan sukses atau error
        // $this->email->send();
      
        if ($this->email->send()) {
            echo 'Sukses! email berhasil dikirim.';
        } else {
            echo 'Error! email tidak dapat dikirim.';
        }
    }


    public function accLamaran(){
    	$dataFromFe = (array)json_decode(file_get_contents('php://input'));
    	$id = $dataFromFe['lamaranID'];
    	$dataFinal = array(
    		'isAcc'	=> 1,
    	);
    	if($dataFinal){
    		$save = $this->Seleksi_model->accLamaran($id,$dataFinal);		
    	}
    }

    public function accEmail(){
    	$dataFromFe = (array)json_decode(file_get_contents('php://input'));
    	$id = $dataFromFe['lamaranID'];
    	$dataFinal = array(
    		'isEmailSend'	=> 1,
    		'tanggalUndangan' => $dataFromFe['tanggalUndangan']
    	);
    	if($dataFinal){
    		$save = $this->Seleksi_model->accLamaran($id,$dataFinal);		
    	}
    }

    public function getDataLoker(){

            $data = [];
            $get_data = $this->Seleksi_model->getDataLoker()->result();

            // ketika data tersedia
            // maka generate data json untuk Datatable
            if($get_data)
            {
                $no = 1;
                foreach($get_data as $get_row)
                {
                    $data[] = array(
                        'no'                => $no,
                        'lowonganID'        => $get_row->lowonganID,
                        'lowonganNama'      => $get_row->lowonganNama,
                        'isDone'            => $get_row->isDone,
                        'Lamaran'             => $this->Seleksi_model->getdatalamranforseleksi($get_row->lowonganID)->result()
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