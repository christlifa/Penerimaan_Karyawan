<?php 
/**	
 * Perameter Model
 *
 * @author Lifa Christian <LifaChristian2@gmail.com>
 * November 2018
 */
use core\Model;
class Seleksi_model extends Model 
{
	/**
	 * Variable tabel
	 */
	var $tableLowongan = 'lowongan';
	var $tableParameter = 'globalparameter';
	var $tableSkill = 'kemampuanLowongan';

	var $tableLamaran = 'lamaran';
	var $tablelamarankemampuan = 'lamarankemampuan';

	public function __construct()
	{
		parent::__construct();
	}

	public function getDataLoker(){

		$sql = $this->db;

		$sql->select('low.*, pr.Nama as NamaPendidikan');
		$sql->from($this->tableLowongan.' low');
		$sql->join($this->tableParameter.' pr', 'low.pendidikan = pr.GlobalId', 'inner');
		// $sql->join($this->tableSkill.' sk', 'sk.lowonganID = low.lowonganID', 'left');
		$get = $sql->get();

		return $get;
	}

	public function getdatalamranforseleksi($id){

		$sql = $this->db;

		$sql->select('lam.*,');
		$sql->from($this->tableLamaran.' lam');
		$sql->where('lowonganID', $id);
		$sql->where('lam.isAcc',0);
		$get = $sql->get();

		return $get;
	}

	public function getData($lowonganID){

		$sql = $this->db;

		$sql->select('low.*, pr.Nama as NamaPendidikan');
		$sql->from($this->tableLowongan.' low');
		$sql->join($this->tableParameter.' pr', 'low.pendidikan = pr.GlobalId', 'inner');
		// $sql->join($this->tableSkill.' sk', 'sk.lowonganID = low.lowonganID', 'left');
		$sql->where('lowonganID', $lowonganID);
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

	public function getDataLamaran($id){

		$sql = $this->db;

		$sql->select('lam.*,glb.Nama as pendidikanName');
		$sql->from($this->tableLamaran.' lam');
		// $sql->join($this->tablelamarankemampuan.' kem', 'lam.lamaranID = kem.lamaranID', 'left');
		$sql->join($this->tableParameter.' glb', 'lam.pendidikan = glb.GlobalId', 'inner');
		$sql->where('lam.lowonganID',$id);
		$sql->where('lam.isAcc',0);
		// $sql->join($this->tableSkill.' sk', 'sk.lowonganID = low.lowonganID', 'left');
		$get = $sql->get();

		return $get;
	}

	public function getDataSkillLamaran($lamaranID){

		$sql = $this->db;

		$sql->select('sk.*,');
		$sql->from($this->tablelamarankemampuan.' sk');
		$sql->where('lamaranID', $lamaranID);
		// $sql->join($this->tableParameter.' pr', 'low.pendidikan = pr.GlobalId', 'inner');
		$get = $sql->get();

		return $get;
	}

	public function accLamaran($flagforupdate, $data_save){
		$this->db->where('lamaranID', $flagforupdate);

		return $this->db->update($this->tableLamaran, $data_save);
	}
}

?>