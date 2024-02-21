<?php
if (!defined('_GNUBOARD_')) exit;

/*************************************************************************
**
**  온라인상담 함수 모음
**
*************************************************************************/

function gen_single_selectbox($human_text, $options_name,$options_array, $options_values,$option_value, $description, $type=0)
{
	echo $human_text ;
	$select_item = '';

	$select_type .= ($type)?' multiple ':'';

	$select_item .= '<select name="'.$options_name.'" id="'.$options_name.'"'.$select_type.'class="form-control input-sm">';
	for( $i = 0; $i < count( $options_array ); $i++ )
	{
		if ( $options_values[$i] == $option_value )
		{
			$select_item .= '<option value="'.$options_values[$i].'" selected>' . $options_array[ $i ];
		} else {
			$select_item .= '<option value="'.$options_values[$i].'">' . $options_array[ $i ];
		}
	}
	$select_item .= '</select>';
	echo $select_item;
	echo $description;
	echo( "\n" );
}

function gen_single_radiobox($human_text, $options_name, $options_array, $options_values, $option_value, $description, $type=0)
{
	echo $human_text ;
	$radio_item = '';
	for( $i = 0; $i < count( $options_array ); $i++ )
	{
		$radio_item .= ($type)?'<div class="radio"><label>':'<label class="radio-inline">';

		if ( $options_values[$i ] == $option_value )
		{
			$radio_item .=
			'<input type="radio" name="'.$options_name.'" id="'.$options_name.'" value="'.$options_values[ $i ].'" checked style="border:0;"> '.$options_array[$i];
		} else {
			$radio_item .=
			'<input type="radio" name="'.$options_name.'" id="'.$options_name.'" value="'.$options_values[ $i ].'" style="border:0;"> '.$options_array[$i];
		}

		$radio_item .= ($type)?'</label></div>':'</label>';

	}
	echo $radio_item;
	echo $description;
	echo( "\n" );
}

function gen_single_checkbox($human_text, $options_name, $options_array, $options_values, $option_value, $description, $type)
{
	echo $human_text ;
	$check_item = '';
	for( $i = 0; $i < count( $options_array ); $i++ )
	{

		$check_item .= ($type)?'<div class="checkbox"><label>':'<label class="checkbox-inline">';

		if ( $options_values[$i] == $option_value[$i] )
		{
			$check_item .= '<input type="checkbox" name="'.$options_name.'['.$i.']" id="'.$options_name.'" value="'.$options_values[$i].'" checked style="border:0;"> '.$options_array[ $i ];
		} else {
			$check_item .= '<input type="checkbox" name="'.$options_name.'['.$i.']" id="'.$options_name.'" value="'.$options_values[$i].'" style="border:0;"> '.$options_array[ $i ];
		}

		$check_item .= ($type)?'</label></div>':'</label>';

	}
	echo $check_item;
	echo $description;
	echo( "\n" );
}

function optArray($code,$mdatas){
	$i=1;
	while($i<=30){
  		if(strlen($mdatas[$code][$i])>0){ $vars[$i-1]=$mdatas[$code][$i]; }
		else{ Break; }
  		$i++;
	}
	return $vars;
}

function get_board_id_select($name, $selected="", $event="")
{
    global $g5;

    $sql = " select bo_table from {$g5['board_table']}";
    $result = sql_query($sql);
    $str = '<select id="'.$name.'" name="'.$name.'" '.$event.'><option value="">선택안함</option>';
    for ($i=0; $row=sql_fetch_array($result); $i++)
    {
		$create_table = $g5['write_prefix'] . $row['bo_table'];
        $str .= '<option value="'.$create_table.'"';
        if ($create_table == $selected) $str .= ' selected';
        $str .= '>'.$row['bo_table'].'</option>';
    }
    $str .= '</select>';
    return $str;
}

/*************************************************************************
**
**  온라인상담 함수 모음 끝
**
*************************************************************************/
?>