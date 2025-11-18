<?php 
/**	
 * Perameter Model
 *
 * @author Lifa Christian <LifaChristian2@gmail.com>
 * November 2018
 */
use core\Model;
class Lowongan_model extends Model 
{
	/**
	 * Variable tabel
	 */
	var $tableLowongan = 'lowongan';
	var $tableParameter = 'globalparameter';
	var $tableSkill = 'kemampuanLowongan';

	public function __construct()
	{
		parent::__construct();
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


	public function getDataForDashboard(){

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
		$this->db->insert($this->tableLowongan, $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	public function saveDataKemampuan($data){
		// return 
		return $this->db->insert($this->tableSkill, $data);
		
	}
	
	public function deleteData($id){
		$this->db->where('lowonganID', $id);
		return $this->db->delete($this->tableLowongan);
	}

	public function deleteDataKemampuan($id){
		$this->db->where('lowonganID', $id);
		return $this->db->delete($this->tableSkill);
	}

	public function updateData($flagforupdate, $data_save){
		$this->db->where('lowonganID', $flagforupdate);

		return $this->db->update($this->tableLowongan, $data_save);
	}


}

?>