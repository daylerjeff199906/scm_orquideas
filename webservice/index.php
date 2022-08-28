<?php
	/*
		Web Service RESTful en PHP con MySQL (CRUD)
		Marko Robles
		Códigos de Programación
	*/
	include 'conexion.php';
	
	$pdo = new Conexion();
	
/* 	//Listar registros y consultar registro
	if($_SERVER['REQUEST_METHOD'] == 'GET'){
		if(isset($_GET['id']))
		{
			$sql = $pdo->prepare("SELECT * FROM contactos WHERE id=:id");
			$sql->bindValue(':id', $_GET['id']);
			$sql->execute();
			$sql->setFetchMode(PDO::FETCH_ASSOC);
			header("HTTP/1.1 200 hay datos");
			echo json_encode($sql->fetchAll());
			exit;				
			
			} else {
			
			$sql = $pdo->prepare("SELECT * FROM contactos");
			$sql->execute();
			$sql->setFetchMode(PDO::FETCH_ASSOC);
			header("HTTP/1.1 200 hay datos");
			echo json_encode($sql->fetchAll());
			exit;		
		}
	} */
	
	//Insertar registro
	if($_SERVER['REQUEST_METHOD'] == 'GET')
	{
		$sql = "INSERT INTO `scm_monitoreo`(`mon_double_ta`, `mon_double_hr`, `mon_double_ic`, `mon_double_il`, `mon_varchar_uv`, `mon_varchar_rango`,`mon_varchar_hs`, `nod_int_id`, `mon_date_registro`) VALUES (:ta, :hr, :ic, :il, :uv, :rango, :hs, :nodo, :registro)";
		$zonahoraria="-5";
		$formato="Y-m-d H:i:s a";
		$fecha=gmdate($formato, time()+($zonahoraria*3600));
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(':ta', $_GET['ta']);
		$stmt->bindValue(':hr', $_GET['hr']);
		$stmt->bindValue(':ic', $_GET['ic']);
		$stmt->bindValue(':il', $_GET['il']);
		$stmt->bindValue(':uv', $_GET['uv']);
		$stmt->bindValue(':rango', $_GET['rango']);
		$stmt->bindValue(':hs', $_GET['hs']);
		$stmt->bindValue(':nodo', $_GET['nodo']);
		$stmt->bindValue(':registro', $fecha);
		$stmt->execute();
		$idPost = $pdo->lastInsertId(); 
		if($idPost)
		{
			header("HTTP/1.1 200 Ok");
			echo json_encode($idPost);
			exit;
		}
/* 	$sql = "INSERT INTO datos (dato) VALUES(:cuenta)";
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(':cuenta', $_GET['cuenta']);
		$stmt->execute();
		$idPost = $pdo->lastInsertId(); 
		if($idPost)
		{
			header("HTTP/1.1 200 Ok");
			echo json_encode($idPost);
			exit;
		}  */
	}
	
	//Actualizar registro
/* 	if($_SERVER['REQUEST_METHOD'] == 'PUT')
	{		
		$sql = "UPDATE contactos SET nombre=:nombre, telefono=:telefono, email=:email WHERE id=:id";
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(':nombre', $_GET['nombre']);
		$stmt->bindValue(':telefono', $_GET['telefono']);
		$stmt->bindValue(':email', $_GET['email']);
		$stmt->bindValue(':id', $_GET['id']);
		$stmt->execute();
		header("HTTP/1.1 200 Ok");
		exit;
	}
	
	//Eliminar registro
	if($_SERVER['REQUEST_METHOD'] == 'DELETE')
	{
		$sql = "DELETE FROM contactos WHERE id=:id";
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(':id', $_GET['id']);
		$stmt->execute();
		header("HTTP/1.1 200 Ok");
		exit;
	} */
	
	//Si no corresponde a ninguna opción anterior
	header("HTTP/1.1 400 Bad Request");
?>