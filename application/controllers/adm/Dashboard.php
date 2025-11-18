<?php
/**
 * @author Hikmahtiar <hikmahtiar.cool@gmail.com>
 *
 * Juli 2017
 */
use libraries\BaseController;

class Dashboard extends BaseController 
{
	/**
	 * Construcktor CodeIgniter
	 */
	public function __construct()
	{
		parent::__construct();
        // $this->load->library('email');
        // $this->load->config('email');
		$this->auth->check_auth();

        $this->load->model('Lowongan_model');
        $this->load->model('Lamaran_model');
	}

	/**
	 * Halaman Index
	 * 
	 * @return HTML
	 */
	public function index()
	{
		// $data = [];

        $data['content_title'] = 'Dashboard';
		// $handle = printer_open('80mm Series Printer');
		
		// printer_set_option($handle, PRINTER_MODE, "raw"); 
		
		// $html = "
		// 	<b>Head</b>
		// 	<br />
		// 	Bacot anjing goblog tolotl
		// ";
		
		// printer_write($handle, $html);
		// printer_close($handle);
		// $this->print_line_win(1,'Dashboard.php', '80mm Series Printer');
		$this->twiggy_display('adm/dashboard/index', $data);
	}
	
	function print_line_win($id, $fname, $dest)
	{
		$tmpfname = tempnam("", "");
    //  echo $tmpfname;
    $fout = fopen($tmpfname, "w");
    fputs($fout, "***************************************************\r\n");
    fputs($fout, "*    USER: {$id}\r\n");
    fputs($fout, "***************************************************\r\n");
    fputs($fout, "\r\n");
    $line = 0;
    $fp = fopen($fname, 'r');
    while (!feof($fp)) {
        $buffer = fgets($fp, 1000);
        $line++;
        $printstr = sprintf("%3d: %s\r", $line, $buffer);
        fputs($fout, $printstr);
    }
    fclose($fp);
    fclose($fout);
    //  $cmd = "print /d:" . PRINTERNAME . " $tmpfname";
    //  exec($cmd);
    $filename = $tmpfname;
    $handle = fopen($filename, "r");
    $contents = fread($handle, filesize($filename));
    fclose($handle);
    $handle = printer_open($dest);
    if ($handle == FALSE) {
        echo "Can't open printer<br/>";
    }
    printer_set_option($handle, PRINTER_MODE, "raw");
    //if(printer_write($handle, "Hello!")==FALSE)
    //  echo "Print error<br/>";
    // printer_set_option($handle, PRINTER_PAPER_FORMAT, PRINTER_FORMAT_A4);
    printer_start_doc($handle, "source code");
    if (printer_write($handle, $contents) == FALSE) {
        echo "Can't print<br/>";
    }
    printer_end_doc($handle);
    /*
    printer_start_doc($handle,"Source Code");
    printer_start_page($handle);
    printer_draw_text($handle,"Hello world",10,10);
    printer_end_page($handle);
    printer_end_doc($handle);
    */
    //if(printer_write($handle, $contents)==FALSE)
    //  echo "Can't print<br/>";
    /*
     
     
    printer_start_doc($handle,"Source Code");
    printer_start_page($handle);
     
    printer_draw_line($handle,10,10,1000,1000);
    printer_end_page($handle);
    printer_end_doc($handle);
    */
    printer_close($handle);
    unlink($tmpfname);
	}


	/**
	 * Logout
	 */
	public function logout()
	{
		$this->session->sess_destroy();

		redirect('loginweb');
	}

    public function getDataLoker(){

            $data = [];
            $get_data = $this->Lowongan_model->getDataForDashboard()->result();

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
                        'Lamaran'             => $this->Lamaran_model->getDataLamaranForDashBoard($get_row->lowonganID)->result()
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