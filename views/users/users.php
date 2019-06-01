<?php

	include './models/users.php';
	$user  = new Users();

	//Si utiliza el filtro de busqueda
	if(isset($search)){
		$users = $user->getUsersBySearch($dataSearch);
	}else{
		//Trae todos los usuarios
		$dataSearch=NULL;
		$users =$user->getUsers();
	}

	$title="Listado de Usuarios";
	include 'toolbar.php';
?>
<div class="row">
	<div class="col text-center">
		<i class="material-icons" style="font-size: 80px;">people</i>
	</div>
</div>
<div class="row">
	<div class="col">
		<form action="./index.php" method="post" accept-charset="utf-8" class="form-inline">
			<div class="form-group mx-sm-3 mb-2">
    			<input type="text" class="form-control" name="dataSearch" autofocus required placeholder="Buscar" value="<?php echo $dataSearch;  ?>">
  			</div>
  			<button type="submit" name="btnSearch" class="btn btn-primary mb-2">Buscar</button>
		</form>
	</div>
</div>
<div class="table-responsive">
		<table class="table table-striped table-bordered table-hover">
			<thead class="thead-dark">
				<th>Id</th>
				<th class="text-center">Nombres y Apellidos</th>
				<th class="text-center">E-mail</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
			</thead>
			<tbody>
				<?php

					if(count($users)>0){

						foreach ($users as $column =>$value) {
				?>

							<tr id="row<?php echo $value['id']; ?>">
								<td><?php echo $value['id']; ?></td>
								<td><?php echo $value['name'].' '.$value['last_name']; ?></td>
								<td><?php echo $value['email']; ?></td>
								<td class="text-center">
									<a href="./index.php?page=edit&id=<?php echo $value['id'] ?>" title="Editar usuario: <?php echo $value['name'].' '.$value['last_name'] ?>">
										<i class="material-icons btn_edit">edit</i>
									</a>
								</td>
								<td class="text-center">
									<a href="#" onclick="btnDeleteUser(<?php echo $value["id"] ?>)" id="btnDeleteUser" title="Borrar usuario: <?php echo $value['name'].' '.$value['last_name'] ?>">
										<i class="material-icons btn_delete">delete_forever</i>
									</a>
								</td>
							</tr>
				<?php
						}
					}else{
				?>
					<tr>
						<td colspan="5">
							<div class="alert alert-info">
								No se encontraron usuarios.
							</div>
						</td>
					</tr>
				<?php
					}
				?>
			</tbody>
		</table>
	</div>
	<div class="row">
		<div class="col">
			<div class="alert alert-success" id="msgSuccess" style="display: none;"></div>
			<div class="alert alert-danger" id="msgDanger" style="display: none;"></div>
		</div>
	</div>
<script type="text/javascript">

	function btnDeleteUser(id){
		if(confirm("Esta seguro de eliminar el usuario?")){
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function(){
			if (this.readyState == 4 && this.status == 200) {
				var response   = JSON.parse(this.responseText);
				var msgSuccess = document.getElementById('msgSuccess');
				var msgDanger   = document.getElementById('msgDanger');
				if(response.success){
					// alert("El usuario ha sido borrado de la base de datos.");
					msgSuccess.style.display = 'inherit';
					msgSuccess.innerHTML     = 'El usuario ha sido borrado de la base de datos.';
					msgDanger.style.display  = 'none';

					//Elimina el registro de la tabla
					var row    = document.getElementById('row'+id);
					var parent = row.parentElement;
        			parent.removeChild(row);

					// location.reload(true);
				}else if(response.error){
					// alert("No se ha podido eliminar el registro");
					msgDanger.style.display  = 'inherit';
					msgDanger.innerHTML      = 'No se ha podido eliminar el registro';
					msgSuccess.style.display = 'none';
				}
			}
			};
			xhttp.open("GET", "./controllers/users_controller.php?delete=true&id="+id, true);
			xhttp.send();
		}
	}


</script>