<?php 
/**	
 * Perameter Model
 *
 * @author Lifa Christian <LifaChristian2@gmail.com>
 * November 2018
 */
use core\Model;
class Lamaran_model extends Model 
{
	/**
	 * Variable tabel
	 */
	var $tableLamaran = 'lamaran';
	var $tablelamarankemampuan = 'lamarankemampuan';
	var $tableglobal = 'globalparameter';
	var $tableLowongan = 'lowongan';

	public function __construct()
	{
		parent::__construct();
	}

	public function getData($id){

		$sql = $this->db;

		$sql->select('lam.*,glb.Nama as pendidikanName');
		$sql->from($this->tableLamaran.' lam');
		// $sql->join($this->tablelamarankemampuan.' kem', 'lam.lamaranID = kem.lamaranID', 'left');
		$sql->join($this->tableglobal.' glb', 'lam.pendidikan = glb.GlobalId', 'inner');
		$sql->where('lam.lowonganID',$id);
		// $sql->where('lam.isAcc',0);
		// $sql->join($this->tableSkill.' sk', 'sk.lowonganID = low.lowonganID', 'left');
		$get = $sql->get();

		return $get;
	}

	public function getDataLowongan(){

		$sql = $this->db;

		$sql->select('*');
		$sql->from($this->tableLowongan);

		$get = $sql->get();

		return $get;
	}

	public function getDataSKill($lamaranID){

		$sql = $this->db;

		$sql->select('sk.*,');
		$sql->from($this->tablelamarankemampuan.' sk');
		$sql->where('lamaranID', $lamaranID);
		// $sql->join($this->tableParameter.' pr', 'low.pendidikan = pr.GlobalId', 'inner');
		$get = $sql->get();

		return $get;
	}

	public function getDataLamaran($id){

		$sql = $this->db;

		$sql->select('lam.*,');
		$sql->from($this->tableLamaran.' lam');
		$sql->where('lowonganID', $id);
		$sql->where('lam.isAcc',0);
		$get = $sql->get();

		return $get;
	}

	public function getDataLamaranForDashBoard($id){

		$sql = $this->db;

		$sql->select('lam.*,');
		$sql->from($this->tableLamaran.' lam');
		$sql->where('lowonganID', $id);
		// $sql->where('lam.isAcc',0);
		$get = $sql->get();

		return $get;
	}
}

?>