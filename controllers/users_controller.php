<?php
	include dirname(__file__,2).'/models/users.php';

	$users=new Users();

	//Request: creacion de nuevo usuario
	if(isset($_POST['create']))
	{
		if($users->newUser($_POST)){
			header('location: ../index.php?page=new&success=true');
		}else{
			header('location: ../index.php?page=new&error=true');
		}
	}

	//Request: editar usuario
	if(isset($_POST['edit']))
	{
		if($users->setEditUser($_POST)){
			header('location: ../index.php?page=edit&id='.$_POST['id'].'&success=true');
		}else{
			header('location: ../index.php?page=edit&id='.$_POST['id'].'&error=true');
		}
	}

	//Request: editar usuario
	if(isset($_GET['delete']))
	{
		if($users->deleteUser($_GET['id'])){
			// header('location: ../index.php?page=users&success=true');
			echo json_encode(["success"=>true]);
		}else{
			// header('location: ../index.php?page=users&&error=true');
			echo json_encode(["error"=>true]);
		}
	}

?>