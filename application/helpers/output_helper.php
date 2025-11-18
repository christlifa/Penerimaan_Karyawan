<?php
/**
 * Output Helper
 * @author Hikmahtiar <hikmahtiar.cool@gmail.com>
 */

/**
 * Output JSON
 */
function output_json($array)
{
	$ci =& get_instance();

	return $ci->output->set_output(json_encode($array));
}

/**
 * Convert NUmbering Decimal
 */
function to_decimal($val, $num = 2, $add_null_after = false, $show_zero = false)
{
	if($show_zero == false)
	{
		if($val == 0)
		{
			return '';
		}
	}
	
	$decimal = (float) round($val, $num, PHP_ROUND_HALF_ODD);
	if($add_null_after == true || $add_null_after == 'true')
	{
		return sprintf("%0.".$num."f",$decimal);	
	}
	return $decimal;
}

/**
 * Null to Zero
 */
function null_to_zero($number)
{
	if($number == null || $number == '')
	{
		return '0';
	}
	else 
	{
		return $number;
	}
}

/**
 * DUmping in Twig
 */
function dump($dumping)
{
	return var_dump($dumping);
}

/**
 * Add Zero
 */
function add_zero($numbering, $type = 2)
{
	return str_pad($numbering, $type, '0', STR_PAD_LEFT);
}

/**
 * Trim String
 */
function trims($str, $position = "")
{
	if($position == 'left')
	{
		return ltrim($str);
	}

	if($position == 'right')
	{
		return rtrim($str);
	}
	return str_replace(' ', '', $str);
}

/**
 * Replaced Text
 */
function replaced_text($subject = '', $search = '/', $replace = 'cmr')
{
	return str_replace($search, $replace, $subject);
}

/**
 * Image Loader
 */
function loader_app($width = '')
{	
	$html = '<div class="loader">
				</div>';
	//$img = '<span><img class="app-loader" src="'.base_url('assets/images/loader.gif').'" style="width: '.$width.'"></span>';

	return $html;
}

/**
 * Check array key exist
 */
function check_array_key($array, $key)
{
	if(count($array) > 0)
	{
		if(array_key_exists($key, $array))
		{
			return $array[$key];
		}
	}

	return '';
}

/**
 * Untuk konversi button crud
 */
function convert_button($button_action, $crud_id)
{
	switch ($button_action) {
		case 'save':
			$id = $crud_id;
			break;

		case 'save_new':
			$id = 'new';
			break;

		case 'save_close':
			$id = 'close';
			break;
		
		default:
			$id = 'new';
			break;
	}

	return $id;
}

function count_twig($array)
{
	return count($array);
}

function array_remove_duplicate_key($data, $key) {
	  
	$_data = array();

	foreach ($data as $v) {
		if (isset($_data[$v[$key]])) {
			// found duplicate
			continue;
		}
		// remember unique item
		$_data[$v[$key]] = $v;
	}
	
	// if you need a zero-based array, otheriwse work with $_data
	$data = array_values($_data);
	return $data;
}

/**
 * Search array multiple in array
 */
function multidimensional_search($array, $pairs) 
{
	$found = array();
    foreach ($array as $aKey => $aVal) {
        $coincidences = 0;
        foreach ($pairs as $pKey => $pVal) {
            if (array_key_exists($pKey, $aVal) && $aVal[$pKey] == $pVal) {
                $coincidences++;
            }
        }
        if ($coincidences == count($pairs)) {
            $found[$aKey] = $aVal;
        }
    }

    return $found; 
}

/**
 * Array to string
 */
function array_to_string($array, $key = '')
{
	$text = '';
	if(is_array($array))
	{
		foreach($array as $row)
		{
			if($key != '')
			{
				if(array_key_exists($key, $row))
				{
					$text .= $row[$key].' , ';
				}
			}
			else
			{
				$text .= $row.' , ';
			}
		}
	}
	
	return rtrim($text, ' , ');
}

/**
 * Uppercase String
 */
function string_upper($string = '')
{
	return strtoupper($string);
}

/**
 * Asset URL
 */
function assets_url($path)
{
	return base_url($path).'?'.time_now();
}

function usort_array($a, $order)
{
	usort($a, function ($a, $b) use ($order) {
        $t = array(true => -1, false => 1);
        $r = true;
        $k = 1;
        foreach ($order as $key => $value) {
            $k = ($value === 'asc') ? 1 : -1;
            $r = ($a[$key] < $b[$key]);
                if ($a[$key] !== $b[$key]) {
                        return $t[$r] * $k;
                }

        }
        return $t[$r] * $k;
	});

	return $a;
}

function array_sort_by_column($arr, $col, $dir = SORT_ASC) {
    $sort_col = array();
    foreach ($arr as $key=> $row) {
        $sort_col[$key] = $row[$col];
    }

    array_multisort($sort_col, $dir, $arr);
}

/**
 * CHeck decimal 
 */
function is_decimal( $val )
{
    return is_numeric( $val ) && floor( $val ) != $val;
}

/**
 * Format numbering Dokumen
 */
function generate_number_document($initial, $year, $month, $sqeuence)
{
	$year_two_digit = date('y', strtotime($year));
	$month          = add_zero($month, 2);
	$sqeuence       = add_zero($sqeuence, 4);
	return $initial.'-'.$year_two_digit.'/'.$month.'-'.$sqeuence;
}

// currency
function to_currency($number, $num = 2)
{
	$decimal = to_decimal($number, $num);

	if($number == '' && $number == null)
	{
		return 0;
	}

	if (strpos($decimal, '.') !== false) {
		$replace = number_format(to_decimal($number, $num), $num,',','.');
	}
	else
	{
		$replace = number_format(to_decimal($number, $num), 0,',','.');
	}

	return $replace;
}