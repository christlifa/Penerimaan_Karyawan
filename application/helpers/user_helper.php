<?php 
/**
 * User Helper untuk pengecekan user yg sedang login
 *
 * @author Hikmahtiar <hikmahtiar.cool@gmail.com>
 */
function logged_user($show)
{
	$ci =& get_instance();

	$ci->load->model('Login_model');

	$user_id = $ci->session->userdata('user_id');

	// cek ke server berdasarkan session user id
	$check_user = $ci->Login_model->get_data_advance($user_id, '')->row_array();

	// ketika user tersedia
	// maka check kembali array exists 
	// jika tersedia maka return data user 

	if($check_user)
	{
		if(array_key_exists($show, $check_user))
		{
			return $check_user[$show];
		}
		
		return '';
	}

	return '';
}


?>