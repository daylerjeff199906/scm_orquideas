<?php 
require '../config.php';
header('Content-Type: application/json');
$sql = sprintf("SELECT * FROM scm_monitoreo sm 
                INNER JOIN sanmarcos_nodo sn ON 
                sm.nod_int_id=sn.nod_int_id WHERE 
                mon_int_id IN (SELECT MAX(mon_int_id) 
                FROM scm_monitoreo GROUP BY nod_int_id) 
                ORDER BY mon_int_id DESC");
	$query = $mysqli->query($sql);
	
	$response = array();
	
	while($rows = $query->fetch_array()) {
		
		$response []= array(

                    'nod_txt_name' => $rows['nod_txt_name'],
                    'case_temperatura' => $rows['mon_double_ta'],
                    'case_humedad' => $rows['mon_double_hr'],
                    'case_calor' => $rows['mon_double_ic'],
                    'case_luz' => $rows['mon_double_il'],
                    'case_uv' => $rows['mon_varchar_uv'],
                    'case_rango' => $rows['mon_varchar_rango'],
                    'case_hs' => $rows['mon_varchar_hs'],
                    'case_registro' => $rows['mon_date_registro']
					);
	}
	
	echo json_encode($response);