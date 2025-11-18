<?php
/**
 * Helper for Date
 *
 * @author  HIkmahtiar <hikmahtiar.cool@gmail.com>
 */

function change_format_date($date, $format = 'Y-m-d', $replace = "/", $changeTo = '-')
{
	$date_format = str_replace($replace, $changeTo, $date);
	$to_time = strtotime($date_format);

	return date($format, $to_time);
}

function change_format_date_excel($date, $format = 'Y-m-d')
{
	$explode = '-';
	$str_expl = explode($explode, $date);

	$month = $str_expl[0];
	$day = $str_expl[1];
	$year = $str_expl[2];

	if(strlen($year) == 2)
	{
		$year = '20'.$year;
	}

	$to_time = strtotime($year.'-'.$month.'-'.$day);

	return date($format, $to_time);
}

/**
 * DAte now
 */
function date_now()
{
	return date('Y-m-d');
}

/**
 * get week number
 */
function get_week($date = '')
{
	if($date == '')
	{
		$date = date('Y-m-d');
	}

	return date('W', strtotime($date));
}

/**
 * Date Range
 */
function create_date_range($strDateFrom, $strDateTo) 
{
	$aryRange=array();

	$iDateFrom=mktime(1,0,0,substr($strDateFrom,5,2),     substr($strDateFrom,8,2),substr($strDateFrom,0,4));
	$iDateTo=mktime(1,0,0,substr($strDateTo,5,2),     substr($strDateTo,8,2),substr($strDateTo,0,4));

	if ($iDateTo>=$iDateFrom)
	{
	    array_push($aryRange,date('Y-m-d',$iDateFrom)); // first entry
	    while ($iDateFrom<$iDateTo)
	    {
	        $iDateFrom+=86400; // add 24 hours
	        array_push($aryRange,date('Y-m-d',$iDateFrom));
	    }
	}
	return $aryRange;
}

/**
 * Generate Mingguan dalam 1 Tahun
 *
 * @return Array
 */
function week_in_year($desc = false, $yearP = '', $yearEndP = '') {
	
	$ci =& get_instance();

	$dt = [];

	$year     = date('Y');
	$yearEnd  = date('Y');
	if($yearP != '')
	{
		$year = $yearP;
	}

	if($yearEndP != '')
	{
		$yearEnd = $yearEndP;
	}


	$month      = date('m');
	$startMonth = 1;

	$firstDayOfYear = mktime(0, 0, 0, $startMonth, 1, $year);
	$nextMonday     = strtotime('sunday', $firstDayOfYear);
	$nextSunday     = strtotime('saturday', $nextMonday);

	$no = 0;
	
	while (date('Ym', $nextMonday) <= $yearEnd.'12') {

		$date_start  = date('d/m/Y', $nextMonday);
		$date_finish = date('d/m/Y', $nextSunday);

		$awal = $month - 1;
		$end  = $month + 1;

		if($awal == 0)
		{
			$awal = 1;
			$yearEnd - 1;
		}


		// $numb = 1;
		// $huruf = 'I';

		$no++;

		// if($no == '54')
		// {
		// 	$huruf = 'II';
		// 	$no = $numb++;
		// }
		$dt[] =  array(
			'no'          => add_zero($no),
			// 'nohuruf'     => $huruf.$no,
			'date_start'  => $date_start,
			'date_finish' => $date_finish,
			'year'        => change_format_date($date_start, 'Y')
		);	
		
		/*if($nextSunday <= strtotime($yearEnd.'-'.$endMonth.'-31')) {
		}*/
	
		$nextMonday = strtotime('+1 week', $nextMonday);
		$nextSunday = strtotime('+1 week', $nextSunday);
	}

	// if($desc == 'true')
	// {
	// 	usort($dt, function($a, $b) {
	// 		return $b['nohuruf'] - $a['nohuruf'];
	// 	});
	// }

	return $dt;	
}

/**
 * Selisi waktu lot
 */
function selisih_waktu($waktu_akhir, $waktu_awal)
{
	$date = date('Y-m-d');
	$check_time = check_time_lot($date, $waktu_awal, $waktu_akhir);

	$awal  = new DateTime($check_time['date_start']);
	$akhir = new DateTime($check_time['date_end']);

	$diff  = $awal->diff($akhir);
	
	$res = '';

	if($diff->h > 0)
	{
		$res .= $diff->h.' jam ';
	}

	if($diff->i > 0)
	{
		$res .= $diff->i .' menit';
	}
	
	if($res == '')
	{
		return '-';
	}

	return $res;
}

/**
 * Selisih Waktu untuk Laporan Performance
 */
function selisih_waktu_performance($waktu_akhir, $waktu_awal)
{
	$awal  = new DateTime($waktu_awal);
	$akhir = new DateTime($waktu_akhir);

	$diff  = $awal->diff($akhir);
	
	$res = '';

	if($diff->h > 0)
	{
		$res = $diff->h;
	}

	if($diff->i > 0)
	{
		$menit = $diff->i;
		$menit_fix = to_decimal($menit / 60); 
		$res = $res + $menit_fix;
	}
	
	if($res == '')
	{
		return 0;
	}

	return $res;
}

/**
 * Cek Waktu Mulai dan Pukul pada Spk Lot 
 *
 * @return Array
 */
function check_time_lot($date, $time_start, $time_end)
{
	// var
	$date1 = '';
	$date2 = '';

	if($time_start != '')
	{
		$date1 = date('Y-m-d H:i:s', strtotime($date.' '.$time_start));
	}

	if($time_end != '')
	{
		$date2 = date('Y-m-d H:i:s', strtotime($date.' '.$time_end));
	}


	$strtime1 = strtotime($date1);
	$strtime2 = strtotime($date2);

	// jika strtime2 < strtime1
	// maka date2 ditambah 1 hari
	if($strtime2 < $strtime1)
	{
		$date2 = date('Y-m-d H:i:s', strtotime("+1 day", strtotime($date2)));
	}

	return array(
		'date_start' => $date1,
		'date_end'   => $date2
	);
}

/**
 * Date Y-m-d
 * @param  $date
 * @return Text
 */
function indonesian_date($date, $type = 'full'){
	$bln_indo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
	
	if($type == 'three') 
	{
		$bln_indo = array("Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des");
	}
 
	$tahun = substr($date, 0, 4);
	$bulan = substr($date, 5, 2);
	$tgl   = substr($date, 8, 2);
 
	$result = $tgl . " " . $bln_indo[(int)$bulan-1] . " ". $tahun;		
	return($result);
}

function indonesia_day($date)
{
	$array_hari = array(1=>"Senin","Selasa","Rabu","Kamis","Jumat", "Sabtu","Minggu");
	return $array_hari[date('N', strtotime($date))];
}

/**
 * show time now
 */
function time_now()
{
	return strtotime(date('Y-m-d, H:i:s'));
}

// time
function time_now2() 
{
	return date('H:i:s');
} 

// generate tahun
function get_year_three()
{
	$year  = date('Y');
	$start = $year - 1;
	$end   = $year + 1;

	$data = [];

	for($i=$start; $i<=$end; $i++)
	{
		$data[] = $i;
	}

	return $data;
}
?>