<?php
/**
 * Class PHPExcel
 *
 * @author Hikmahtiar <hikmahtiar.cool@gmail.com>
 */
class Excel {

	private $woorkbook;

	public function __construct()
	{
		return $this->new_workbook();
	}

	public function new_workbook()
	{
        unset($this->workbook);
		$this->workbook = new PHPExcel();

        if(isset($this->workbook)) {
            return TRUE;
        } else {
            return FALSE;
        }
	}

	public function send_to_browser($filename = "workbook.xlsx", $format = 'Excel2007'){

        // load the appropriate IO Factory writer
        $objWriter = PHPExcel_IOFactory::createWriter($this->workbook, $format);

        // output the appropriate headers
        header('Pragma: public');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Content-Type: application/force-download');
        header('Content-Type: application/octet-stream');
        header('Content-Type: application/download');
        header("Content-Disposition: attachment;filename={$filename}");
        header('Content-Transfer-Encoding: binary');

        // output the file
        $objWriter->save('php://output');

        return; // end processing
    }

}
?>