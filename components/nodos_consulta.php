<?php 
require '../config.php';
header('Content-Type: application/json');
$sql = sprintf("SELECT * FROM sanmarcos_monitoreo sm 
                INNER JOIN sanmarcos_nodo sn ON 
                sm.nod_int_id=sn.nod_int_id WHERE 
                mon_int_id IN (SELECT MAX(mon_int_id) 
                FROM sanmarcos_monitoreo GROUP BY nod_int_id) 
                ORDER BY mon_int_id DESC");
	$query = $mysqli->query($sql);
	
	$response = array();
	
	while($rows = $query->fetch_array()) {
		
		$response []= array(

                    'nod_txt_name' => $rows['nod_txt_name'],
                    'case_temperatura' => $rows['mon_double_temperatura'],
                    'case_humedad' => $rows['mon_double_humedad'],
                    'case_calor' => $rows['mon_double_calor'],
                    'case_luz' => $rows['mon_double_luz'],
                    'case_uv' => $rows['mon_varchar_uv'],
                    'case_registro' => $rows['mon_date_registro']
					);
	}
	
	echo json_encode($response);