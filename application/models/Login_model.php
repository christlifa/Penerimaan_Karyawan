<?php 
/**	
 * Login Model
 *
 * @author Hikmahtiar <hikmahtiar.cool@gmail.com>
 * Juli 2017
 */
use core\Model;
class Login_model extends Model 
{
	/**
	 * Variable tabel
	 */
	var $table = 'login';
	// var $table_karyawan = 'karyawan';
	var $tableLowongan = 'lowongan';
	var $tableParameter = 'globalparameter';
	var $tableSkill = 'kemampuanLowongan';
	var $tablelamaran = 'lamaran';
	var $tablelamaranSkill = 'lamaranKemampuan';

	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Get data secara dinamis
	 */
	public function get_data_advance($userid = '', $password = '')
	{
		$sql = $this->db;

		$sql->select('lg.*,');
		$sql->from($this->table.' lg');
		// $sql->join($this->table_karyawan.' kar', 'lg.KaryawanId = kar.KaryawanId', 'inner');
		if($userid != '')
		{
			$sql->where('Username', $userid);
		}
		
		if($password != '')
		{
			// $sql->where('Password', md5(mb_convert_encoding($password, 'UTF-16LE', 'UTF-8')));
			$sql->where('Password', $password);
		}

		$get = $sql->get();
		// echo($get);
		return $get;
	}


	public function getData(){

		$sql = $this->db;

		$sql->select('low.*, pr.Nama as NamaPendidikan');
		$sql->from($this->tableLowongan.' low');
		$sql->join($this->tableParameter.' pr', 'low.pendidikan = pr.GlobalId', 'inner');
		// $sql->join($this->tableSkill.' sk', 'sk.lowonganID = low.lowonganID', 'left');
		$get = $sql->get();

		return $get;
	}

	public function getDataPendidikan(){

		$sql = $this->db;

		$sql->select('*');
		$sql->from($this->tableParameter);
		$sql->where('Code', 1);
		// $sql->join($this->tableParameter.' pr', 'low.pendidikan = pr.GlobalId', 'inner');
		$get = $sql->get();

		return $get;
	}

	public function getDataSKill($lowonganID){

		$sql = $this->db;

		$sql->select('sk.*, sk.kemampuan as Name ,sk.kemampuanID as Id');
		$sql->from($this->tableSkill.' sk');
		$sql->where('lowonganID', $lowonganID);
		// $sql->join($this->tableParameter.' pr', 'low.pendidikan = pr.GlobalId', 'inner');
		$get = $sql->get();

		return $get;
	}

	public function saveData($data){
		// return 
		$this->db->insert($this->tablelamaran, $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	public function saveDataKemampuan($data){
		// return 
		return $this->db->insert($this->tablelamaranSkill, $data);
		
	}
	
}

?>