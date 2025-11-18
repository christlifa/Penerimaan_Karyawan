<?php
/**
 * Auth Helper untuk pengecekan session
 *
 * @author Elsa Damayanti <elsadamayanti98@gmail.com>
 */

if(!function_exists('is_logged'))
{
    function is_logged()
    {
        $ci =& get_instance();
        return $ci->session->userdata('user_id');
    }

    function is_OutletId(){

    	$ci =& get_instance();
    	return $ci->session->userdata('outletId');
    }
}
?>