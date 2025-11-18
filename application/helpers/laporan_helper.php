<?php
/**
 * Laporan helper
 *
 * @author Hikmahtiar <hikmahtiar.cool@gmail.com>
 */


/********************************* LAPORAN DIES *****************************************/
function report_dies_get_machine($machine_type_id, $year, $location)
{
	$ci =& get_instance();
	$ci->load->model('Laporan_model');

	$get_data = $ci->Laporan_model->get_dies_by_machine($machine_type_id, $year, $location)->result();
	return $get_data;
}

function report_dies_section_by_machine($machine_type_id, $year, $location)
{
	$ci =& get_instance();
	$ci->load->model('Laporan_model');

	$get_data = $ci->Laporan_model->get_dies_section_by_machine($machine_type_id, $year, $location)->result();
	return $get_data;
}

function report_dies_by_machine_section($machine_type_id, $year, $section, $location)
{
	$ci =& get_instance();
	$ci->load->model('Laporan_model');

	$get_data = $ci->Laporan_model->get_dies_by_machine_section($machine_type_id, $year, $section, $location)->result();
	return $get_data;
}

function report_dies_full($machine_type_id, $year, $location)
{
	$ci =& get_instance();
	$ci->load->model('Laporan_model');

	$get_data = $ci->Laporan_model->machine_report_dies($machine_type_id, $year, $location)->result_array();
	return $get_data;
}



/**
 * generate kode billet untuk laporan
 */
function generate_kode_billet($machine_id, $tanggal, $section_id)
{
	$ci =& get_instance();
	$ci->load->model('Laporan_model');

	$str = "";

	$get_data = $ci->Laporan_model->get_kode_billet($machine_id, $tanggal, $section_id)->result();
	if($get_data)
	{
		foreach($get_data as $get_row) 
		{
			$str .= $get_row->Keterangan.' ,';
		}

		$str = rtrim($str, " ,");
	}

	return $str;
}


function get_lot_billet_detail($master_detail_id = '', $index = '', $show = 'PBilletActual')
{
	$ci =& get_instance();
	$ci->load->model('spk/Lot_billet_model');

	$where = '';

	if($master_detail_id != '')
	{
		$where = [
			'MasterDetailId' => $master_detail_id
		];
	}
	$get_data = $ci->Lot_billet_model->get_data_where($where)->result_array();

	if($get_data)
	{
		if(array_key_exists($index, $get_data)) {
			return $get_data[$index][$show];
		}

		return '';
	}

	return '';
}


function get_lot_detail($master_detail_id = '', $index = '', $show = 'master_detail_id')
{
	$ci =& get_instance();
	$ci->load->model('spk/Lot_new_model');

	$where = '';

	if($master_detail_id != '')
	{
		$where = [
			'master_detail_id' => $master_detail_id
		];
	}
	$get_data = $ci->Lot_new_model->get_data_where($where)->result_array();

	if($get_data)
	{
		if(array_key_exists($index, $get_data)) {

			if($show == 'time_start' || $show == 'time_finish')
			{
				return change_format_date($get_data[$index][$show], 'H:i');
			}
			else
			{
				return $get_data[$index][$show];
			}
		}

		return '';
	}

	return '';
}

function get_lot_scrap_detail($machine_id = '', $tgl ='', $shift_no = '', $show = 'Scrap')
{
	$ci =& get_instance();
	$ci->load->model('spk/Lot_scrap_model');

	$where = '';

	if($machine_id != '')
	{
		$where['sh.machine_id'] =$machine_id;
	}

	if($tgl != '')
	{
		$where['sl.Tanggal'] = $tgl;
	}

	if($shift_no != '')
	{
		$where['sl.Shift'] = $shift_no;
	}

	$get_data = $ci->Lot_scrap_model->get_data_where($where)->row_array();

	if($get_data)
	{
		if(array_key_exists($show, $get_data)) {
			return $get_data[$show];
		}

		return '';
	}

	return '';
}

function get_lot_hasil_detail($master_detail_id = '', $index = '', $show = 'JumlahBtgRak')
{
	$ci =& get_instance();
	$ci->load->model('spk/Lot_hasil_model');

	$where = '';

	if($master_detail_id != '')
	{
		$where = [
			'MasterDetailId' => $master_detail_id
		];
	}
	$get_data = $ci->Lot_hasil_model->get_data_where($where)->result_array();

	if($get_data)
	{
		if(array_key_exists($index, $get_data)) {
			return $get_data[$index][$show];
		}

		return '';
	}

	return '';
}

function get_lot_berat_detail($master_detail_id = '', $index = '', $show = 'BeratAkt')
{
	$ci =& get_instance();
	$ci->load->model('spk/Lot_berat_model');

	$where = '';

	if($master_detail_id != '')
	{
		$where = [
			'MasterDetailId' => $master_detail_id
		];
	}
	$get_data = $ci->Lot_berat_model->get_data_where($where)->result_array();

	if($get_data)
	{
		if(array_key_exists($index, $get_data)) {
			return $get_data[$index][$show];
		}

		return '';
	}

	return '';
}


function count_row_spk3($master_detail_id = '')
{
	$ci =& get_instance();
	$ci->load->model('spk/Lot_hasil_model');
	$ci->load->model('spk/Lot_berat_model');

	$where = '';

	if($master_detail_id != '')
	{
		$where = [
			'MasterDetailId' => $master_detail_id
		];
	}
	$count_hasil  = count($ci->Lot_hasil_model->get_data_where($where)->result_array());
	$count_berat  = count($ci->Lot_berat_model->get_data_where($where)->result_array());
	if($count_hasil > $count_berat)
	{
		return $count_hasil;
	}
	else
	{
		return $count_berat;
	}
	
}

function count_rata2_berat($master_detail_id = '')
{
	$ci =& get_instance();
	$ci->load->model('spk/Lot_berat_model');

	$data['total_rata2_perrow']  = [];
	$total_rata2_perrow = 0;

	$where = '';

	if($master_detail_id != '')
	{
		$where = [
			'MasterDetailId' => $master_detail_id
		];
	}
	$get_data = $ci->Lot_berat_model->get_data_where($where)->result_array();

	if($get_data)
	{
		foreach($get_data as $get_row)
		{
			$total_rata2_perrow = $total_rata2_perrow + to_decimal($get_row['BeratAkt']);
			$data['total_rata2_perrow'][] = to_decimal($get_row['BeratAkt'] * 2 / 1000, 3 , 'true');
		}

		$total_rata2_berat = ($total_rata2_perrow / count($data['total_rata2_perrow']) * 2) / 1000;
		return to_decimal($total_rata2_berat, 3, true);
	}

	return '';
}

function check_options_spk3($berat_actual, $berat_max, $berat_standard, $options = 1)
{

	switch ($options) {
		// melebihi berat maximum 
		case 1:
			if($berat_actual > $berat_max)
			{
				return true;
			}

			return false;
			break;

		// melebihi berat standard
		case 2:
			if($berat_actual > $berat_standard)
			{
				return true;
			}

			return false;
			break;

		// melebihi keduanya
		case 3:
			if($berat_actual > $berat_standard && $berat_actual > $berat_max)
			{
				return true;
			}

			return false;
			break;
		
		default:
			if($berat_actual > $berat_max)
			{
				return true;
			}

			return false;
			break;
	}
}

?>