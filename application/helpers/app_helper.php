<?php
/**
 * App Helper
 *
 * @author Hikmahtiar <hikmahtiar.cool@gmail.com>
 */

/**
 * Menampilkan Config COdeigniter
 */
function show_config($key = '')
{
    $ci =& get_instance();

    $config = $ci->config->config;

    if(array_key_exists($key, $config))
    {
        return $config[$key];
    }

    return '-';
}

/**
 * Helper untuk upload via Codeigniter
 */
function upload_file($path=null, $name=null, $rename=null, $allowed_types = '')
{
	$ci =& get_instance();
	
    ini_set('memory_limit','960M');
    ini_set('post_max_size','2084M');
    ini_set('upload_max_filesize', '2084M');
    $config['upload_path'] = $path;

    $allow = '*';

    if($allowed_types != '')
    {
        $allow = $allowed_types;
    }
    $config['allowed_types'] = $allow;
    //$config['max_size'] = '6400000';

    if($rename!=null) {
        $config['file_name'] = $rename;
    }
    $ci->load->library('upload',$config);
    if(!$ci->upload->do_upload($name)) {
        return false;
    } else {
        return true;
    }
}

/**
 * Helper untuk If CLause in Twig
 */
function same($word1, $word2)
{
    if($word1 == $word2)
    {
        return true;
    }
    
    return false;
}

function check_array($array)
{
    if(is_array($array))
    {
        return true;
    }

    return false;
}

/****************
 * Helper mesin *
 ****************/
function get_detail_machine($machine_id , $show = 'MachineId')
{
    $ci =& get_instance();
    $ci->load->model('Mesin_model');

    $get_data = $ci->Mesin_model->get_data_advance($machine_id)->row_array();
    if($get_data)
    {
        if(array_key_exists($show, $get_data))
        {
            return $get_data[$show];
        }
        return '';
    }

    return '';
}


function get_type_machine($machine_type = '', $initial = '', $show = 'MachineTypeId')
{
    $ci =& get_instance();
    $ci->load->model('Mesin_model');

    $get_data = $ci->Mesin_model->get_type_advance($machine_type, $initial)->row_array();
    if($get_data)
    {
        if(array_key_exists($show, $get_data))
        {
            return $get_data[$show];
        }
        return '';
    }

    return '';
}

/****************
 * Helper Billet *
 ****************/
/** 
 * Get Total Billet
 */
function get_total_billet($master_detail_id = '', $billet_weight = 0)
{
    $ci =& get_instance();
    $ci->load->model('Spk_model');
    
    $data = $ci->Spk_model->get_lot_billet($master_detail_id)->result();
    
    $sum = 0;
    
    if($data)
    {
        foreach($data as $row) 
        {
            $sum += $row->PBilletActual * $row->JumlahBillet * $billet_weight;
        }
    }
    
    $hasil = $sum;
    
    return $hasil;
}

/**
 * Get rata2 berat Akt
 */
function get_rata2_berat_akt($master_detail_id = '')
{
    $ci =& get_instance();
    $ci->load->model('Spk_model');
    
    $data = $ci->Spk_model->get_lot_berat_actual($master_detail_id)->result();
    
    $sum = 0;
    
    if($data)
    {
        foreach($data as $row) 
        {
            $sum += $row->BeratAkt;
        }
    }
    
    if(count($data) > 0)
    {
        $hasil = ($sum / count($data) * 2) / 1000;
        return $hasil; 
    }
    
    return $sum;
}

/**
 * Get hasil berat billet
 */
function get_hasil_prod_kg($master_detail_id = '', $len = '0', $rata2_berat_ak = '')
{
    $ci =& get_instance();
    $ci->load->model('Spk_model');
    
    $data = $ci->Spk_model->get_lot_hasil($master_detail_id)->result();
    
    $sum = 0;
    
    if($data)
    {
        foreach($data as $row) 
        {
            $sum += $row->JumlahBtgRak;
        }
    }
    
    $hasil = $sum * $len * $rata2_berat_ak;
    
    return $hasil;
}

/**
 * Cek isian lot
 */
function cek_isian_lot($master_detail_id = '')
{
    $ci =& get_instance();
    $ci->load->model('Spk_model');

    $exists = array();

    $cek_billet = $ci->Spk_model->get_isian_billet($master_detail_id, 'billet');
    $cek_berat_aktual = $ci->Spk_model->get_isian_billet($master_detail_id, 'berat_aktual');
    $cek_hasil = $ci->Spk_model->get_isian_billet($master_detail_id, 'hasil');

    if(count($cek_billet) > 0) {
        array_push($exists, 1);
    }

    if(count($cek_berat_aktual) > 0) {
        array_push($exists, 1);
    }

    if(count($cek_hasil) > 0) {
        array_push($exists, 1);
    }

    return count($exists);
}

/***************
 * Helper Dies *
 * *************/
function super_unique_die($array)
{
    $res = array();
    $result = array_map("unserialize", array_unique(array_map("serialize", $array)) );

    foreach ($result as $rr) {
        $res[] = array(
            'text' => $rr['text'],
            'value' => $rr['value'],
            'id' => $rr['id'],
        );
    }

    return $res;
}

function convert_dice($dice)
{
    $dice_txt = ($dice == null) ? '' : $dice;
    
    $txt = '';
    $expl = explode(",", $dice_txt);

    if(count($expl) > 0)
    {
        foreach($expl as $rexpl)
        {
            if($rexpl != '' || $rexpl != null)
            {
                $txt .= $rexpl.', ';
            }
        }
    }
    else
    {
        $txt = $dice_txt;
    }

    return rtrim($txt, ', ');
}

/**************
 * Lot Helper *
 * ************/
function get_row_master($show = 'SectionId', $machine_id = '', $section_id = '', $length_id = '')
{
    $ci =& get_instance();
    $ci->load->model('Spk_model');

    $get_data = $ci->Spk_model->get_master_advance($machine_id, $section_id, $length_id)->row_array();

    if($get_data)
    {
        if(array_key_exists($show, $get_data))
        {
            return $get_data[$show];
        }

        return '';
    }
    
    return '';
}

function counting_panjang_aktual($master_detail_id)
{
    $ci =& get_instance();
    $ci->load->model('Lot_model');   
    
    $get_data = $ci->Lot_model->counting_panjang_actual($master_detail_id)->row();
    if($get_data)
    {
        return $get_data->total;
    }

    return '';
}

function get_last_billet_actual($master_detail_id = '', $machine_id = '', $section_id = '')
{
    $ci =& get_instance();
    $ci->load->model('Spk_model');
    
    return $ci->Spk_model->get_last_billet_actual($master_detail_id, $machine_id, $section_id);
}

function get_effective_item_dimension($section_id, $show = 'WeightUpperLimit')
{
    $ci =& get_instance();
    $ci->load->model('Spk_model');

    $get_data = $ci->Spk_model->get_effective_item_dimension($section_id)->row_array();

    if($get_data)
    {
        if(array_key_exists($show, $get_data))
        {
            return $get_data[$show];
        }
        return '';
    }

    return '';
}

function dir_section()
{
    $ci =& get_instance();

    return $ci->config->item('dir_section');
}

function list_vendor_lot()
{
    $data = array('PM', 'EL', 'EV', 'FM', 'INA', 'VGA');
    return $data;
}

/**
 * Reporting
 */
function convert_dice2($dice)
{
    $dice_txt = ($dice == null) ? '' : $dice;
    
    $txt = '';
    $expl = explode(",", $dice_txt);

    if(count($expl) > 0)
    {
        foreach($expl as $rexpl)
        {
            if($rexpl != '' || $rexpl != null)
            {
                if(strpos($rexpl, '.') !== false) {
                  // explodable
                    $expl2 = end((explode(".", $rexpl)));
                    $txt .= substr($expl2, 2, 10).', ';
                } else {
                  // not explodable
                    $txt .= $rexpl.', ';
                }
            }
        }
    }
    else
    {
        $txt = $dice_txt;
    }

    return rtrim($txt, ', ');
}

function sum_target_section($header_id, $machine, $shift, $tgl)
{
    $ci =& get_instance();
    $ci->load->model('Spk_model');

    $target_prod_btg = '';
    $weight_standard = '';
    $len = '';

    $sum = array();

    $data = $ci->Spk_model->get_data_for_grid_dinamic($header_id, $shift, false, $machine, $tgl);
    if($data)
    {
        foreach($data as $row)
        {
            $get_master_query =  $ci->Spk_model->get_master_advance($machine, $row->section_id)->row();

            $target_prod = $row->target_prod;
            $f2_estfg = ($get_master_query) ? $get_master_query->F2_EstFG : '';
            $weight_standard = ($get_master_query) ? (float) round($get_master_query->WeightStandard, 3) : '';
            $hole_count = ($get_master_query) ? $get_master_query->HoleCount : '';
            $len = $row->Length;
            $target_prod_btg = $f2_estfg * $target_prod * $hole_count;
            $target_section = $weight_standard * $target_prod_btg * $len;

            array_push($sum, $target_section);
        }
        
        return array_sum($sum); 
    }

    return '0';
}


function get_lot_scrap($header_id, $tgl, $shift = '')
{
    $ci =& get_instance();
    $ci->load->model('Spk_model');

    $data = $ci->Spk_model->get_scrap_tgl_header($header_id, $tgl, $shift);
    if($data)
    {
        return array(
            'scrap'   => $data->Scrap,
            'lost'    => $data->Lost,
            'endbutt' => $data->EndButt,
            'opr1'    => $data->Opr1,
            'opr2'    => $data->Opr2,
        );
    }

    return array(
        'scrap'   => '',
        'lost'    => '',
        'endbutt' => '',
        'opr1'    => '',
        'opr2'    => '',
    );
}

function get_detail_advance($machine_id = '', $tanggal = '', $shift = 0, $distinct = false)
{   
    $ci =& get_instance();
    $ci->load->model('Spk_model');

    return $ci->Spk_model->get_report_advance($machine_id, $tanggal, $shift, $distinct)->result();
}

function sum_scrap($field, $machine, $shift, $tanggal)
{
    $ci =& get_instance();
    $ci->load->model('Spk_model');
    
    return $ci->Spk_model->sum_field($field, $machine, $shift, $tanggal);
}

function get_detail_advance_lot($machine_id = '', $tanggal = '', $shift = 0)
{   
    $ci =& get_instance();
    $ci->load->model('Spk_model');

    return $ci->Spk_model->get_report_advance_lot($machine_id, $tanggal, $shift)->result();
}

function get_target_prod_btg($machine_id, $section_id, $target_prod, $len)
{
    $ci =& get_instance();
    $ci->load->model('Spk_model');

    $get_master_query =  $ci->Spk_model->get_master_advance($machine_id, $section_id)->row();

    $target_prod_btg = $target_prod;
    $f2_estfg = ($get_master_query) ? $get_master_query->F2_EstFG : '';
    $hole_count = ($get_master_query) ? $get_master_query->HoleCount : '';
    $weight_standard = ($get_master_query) ? (float) round($get_master_query->WeightStandard, 3) : '';

    if($f2_estfg != NULL)
    {
        $target_prod_btg = $f2_estfg * $target_prod * $hole_count; 
    }
    $target_section = $weight_standard * $target_prod_btg * $len;

    return array(
        'target_prod_btg'   => to_decimal($target_prod_btg, '2', false),
        'target_section_kg' => to_decimal($target_section, '2', true)
    );
}

function get_hasil_prod_btg($mesin_id = '', $section_id = '', $shift = '', $tgl = '', $master_detail_id = '')
{
    error_reporting(0);
    $ci =& get_instance();
    $ci->load->model('Spk_model');

    return $ci->Spk_model->get_hasil_prod_btg($mesin_id, $section_id, $shift, $tgl, $master_detail_id);
}

/**
 * Dies
 */
function get_last_status_log_dies($dies_id)
{
    $ci =& get_instance();
    $ci->load->model('Dies_model');

    $data = $ci->Dies_model->get_last_status_log($dies_id);
    if($data)
    {
        return $data->DiesStatus;
    }

    return '-';
}

function get_last_problem_log_dies($dies_id)
{
    $ci =& get_instance();
    $ci->load->model('Dies_model');

    $res['problem'] = '';
    $res['problem_id'] = '';
    $res['koreksi'] = '';
    $res['korektor'] = '';

    $data = $ci->Dies_model->get_last_problem_log($dies_id);
    if($data)
    {
        if($data->DiesStatusId == 29)
        {
            $res['problem'] = $data->Problem;
            $res['problem_id'] = $data->DiesProblemId;
            $res['koreksi'] = $data->Koreksi;
            $res['korektor'] = $data->Korektor;
        }
    }

    return $res;
}

function get_last_log_by_dies($dies_id)
{
    $ci =& get_instance();
    $ci->load->model('Dies_model');

    $data = $ci->Dies_model->get_last_log_by_dies($dies_id);

    return $data;
}


function get_last_datetime_log_dies($dies_id)
{
    $ci =& get_instance();
    $ci->load->model('Dies_model');

    $data = $ci->Dies_model->get_last_datetime_log($dies_id);
    if($data)
    {
        return $data->LogTime;
    }

    return '-';
}

function change_format_date_dies($date, $format = 'Y-m-d', $replace = "/", $changeTo = '-')
{
    if ($date != "-" ) {
        $date_format = str_replace($replace, $changeTo, $date);
        $to_time = strtotime($date_format);
        return date($format, $to_time);
    }else{
        return '-';
    }
}

function get_last_location_log_dies($dies_id)
{
    $ci =& get_instance();
    $ci->load->model('Dies_model');

    $data = $ci->Dies_model->get_last_location_log($dies_id);
    if($data)
    {
        return $data->Location;
    }

    return '-';
}

function get_dies_history_v1($date = '',  $section_id = '', $dies_id = '')
{
    $ci =& get_instance();
    $ci->load->model('Dies_model');

    $data = $ci->Dies_model->get_dies_history_v1($date,  $section_id, $dies_id)->result();

    return $data;
}

function get_dies_history_v2($section_id = '', $year = '', $dies_index = '')
{
    $ci =& get_instance();
    $ci->load->model('Dies_model');

    $data = $ci->Dies_model->get_dies_history_v2($section_id, $year, $dies_index);

    return $data;
}



/**
 * PR
 */
/**
 * count die pr
 */
function count_die_pr_by_header($header_id)
{
    $ci =& get_instance();
    $ci->load->model('Pr_model');
    return $ci->Pr_model->count_die_by_header($header_id);
}

/**
 * History Card
 */
function get_machine_in_spk_detail($master_detail_id)
{
    $ci =& get_instance();
    $ci->load->model('Spk_model');

    $machine = '';
    $data = $ci->Spk_model->get_machine_in_spk_detail($master_detail_id);

    if($data)
    {
        $machine = $data->machine_id;
    }

    return $machine;
}

/**
 * PR
 */
/**
 * convert last dies in pr
 */
function get_last_dies_pr($year, $seqno)
{
    $new_year = substr($year, 2, 2);
    $seq = add_zero($seqno, 4);

    return $new_year.$seq;
}

function qty_pr_per_section($header_id, $section_id)
{
    $ci =& get_instance();
    $ci->load->model('Purchase_model');

    return $ci->Purchase_model->qty_pr_per_section($header_id, $section_id);
}



/********************* SECTION *********************************/

/**
 * Get data Section
 */
function get_section($section_id, $show)
{
    $ci =& get_instance();
    $ci->load->model('Section_model');

    // get data
    $get_data = $ci->Section_model->get_data_advance($section_id)->row_array();

    // cek data dan cek array keynya
    // jika ada tampil sesuai field $show
    // jika tidak ada return -
    if($get_data)
    {
        if(array_key_exists($show, $get_data))
        {
            return $get_data[$show];
        }
    }

    return '-';
}


/****************** LAPORAN LOT ******************************************/

/**
 * Get COunting Kode Billet
 */
function counting_code_billet($machine_id, $date, $shift_no, $billetWeight)
{
    $ci =& get_instance();
    $ci->load->model('Lot_model');

    // get data
    return $get_data = $ci->Lot_model->counting_vendor_billet($machine_id, $date, $shift_no, $billetWeight)->result();
}



/**************************** PURCHASE REQUEST ************************************/

/**
 * Get NUmbering Document Number
 */
function get_number_document_no($document_no)
{
    $expl = explode('-', $document_no);
    return $expl[2];
}

function generate_number_document_purchasing($id = '', $date_search = '', $numbering = '')
{
    // instance and load model
    $ci =& get_instance();
    $ci->load->model('Dies_model');


    // data
    $numbering = ($numbering == '') ? add_zero(1, 4) : add_zero($numbering, 4);
    $date_search = ($date_search == '') ? date('Y-m-d') : $date_search;
    $date = date('y/m', strtotime($date_search));
    $id_fix = strtoupper($id);
    $search = $id_fix.'-'.$date;
    $generate_number = $search.'-'.$numbering; 

    switch ($id) {
        case 'prq':
            $get_document = $ci->Dies_model->check_pr_document_no('', $search)->row();
            $field = 'PurchaseRequestNo';
            break;

        case 'po':
            break;
        
        default:
            break;
    }


    // check data header
    // jika data ada 
    // maka tambah 1 untuk angka belakangnya
    if($get_document)
    {
        $new_number = get_number_document_no($get_document->$field);

        $numbering = ($numbering == '') ? add_zero($new_number + 1, 4) : add_zero($new_number + $numbering, 4);
        $generate_number = $search.'-'.$numbering;
    }

    return $generate_number;
}


/**
 * Generate Dies ID
 */
function generate_dies_id($vendorInitial, $component, $section_id, $machine_type, $hole, $year, $numbering)
{
    return $vendorInitial.'.'.$component.'.'.$section_id.'.'.$machine_type.'.'.$hole.'.'.$year.add_zero($numbering, 4);
}


/*********************** Vendor *********************************/
function get_vendor($vendorId, $initial, $show = 'BussinessPartnerId')
{
    // instance and load model
    $ci =& get_instance();
    $ci->load->model('Vendor_model');

    $get_data = $ci->Vendor_model->get_data_advance($vendorId, $initial)->row_array();
    if($get_data) 
    {
        if(array_key_exists($show, $get_data))
        {
            return $get_data[$show];
        }
    }

    return '';

}



/************************** DIE TYPE **************************/
function get_die_type($show = 'DieTypeId', $die_type_id = '', $die_type_name = '')
{
    // instance and load model
    $ci =& get_instance();
    $ci->load->model('Dies_model');

    $get_data = $ci->Dies_model->get_data_dies_tipe($die_type_id, $die_type_name)->row_array();
    // cek data dan cek array keynya
    // jika ada tampil sesuai field $show
    // jika tidak ada return null
    if($get_data)
    {
        if(array_key_exists($show, $get_data))
        {
            return $get_data[$show];
        }
    }

    return '';
}



/************************** BILLET TYPE ************************/
function get_billet($show = 'BilletTypeId', $billet_type_id = '', $diameter = '')
{
    // instance and load model
    $ci =& get_instance();
    $ci->load->model('Billet_model');

    $get_data = $ci->Billet_model->get_data_advance($billet_type_id, $diameter)->row_array();

    // cek data dan cek array keynya
    // jika ada tampil sesuai field $show
    // jika tidak ada return null
    if($get_data)
    {
        if(array_key_exists($show, $get_data))
        {
            return $get_data[$show];
        }
    }

    return '';
}

// list status SO
function list_status_so()
{
    $data = [
        [
            'StatusId'  => 'Umum',
            'StatusDesc' => 'Umum'
        ],
        [
            'StatusId'  => 'Cepat',
            'StatusDesc' => 'Cepat'
        ]
    ];

    return $data;
}