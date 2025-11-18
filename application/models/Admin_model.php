<?php 
/**	
 * Perameter Model
 *
 * @author Lifa Christian <LifaChristian2@gmail.com>
 * November 2018
 */
use core\Model;
class Admin_model extends Model 
{
	/**
	 * Variable tabel
	 */
	var $tableLogin = 'login';
	var $tableParameter = 'globalparameter';

	public function __construct()
	{
		parent::__construct();
	}

	public function getData(){

		$sql = $this->db;

		$sql->select('*');
		$sql->from($this->tableLogin.' low');
		// $sql->join($this->tableSkill.' sk', 'sk.lowonganID = low.lowonganID', 'left');
		$get = $sql->get();

		return $get;
	}


	public function saveData($data){
		// return 
		return $this->db->insert($this->tableLogin, $data);
		
	}
	
	public function deleteData($id){
		$this->db->where('LoginId', $id);
		return $this->db->delete($this->tableLogin);
	}

	public function updateData($flagforupdate, $data_save){
		$this->db->where('LoginId', $flagforupdate);

		return $this->db->update($this->tableLogin, $data_save);
	}


}

?>