<?php
session_start();

if(!isset($_SESSION['login'])){
	header('Location: ../auth.php');
	exit;
}

include "top.php";

?>

<header id="gtco-header" class="gtco-cover gtco-cover-xs gtco-inner" role="banner" style="height: 400px; margin-bottom: 50px;">
	<div class="gtco-container">
		<div class="row">
			<div class="col-md-12 col-md-offset-0 text-left">
				<div class="display-t">
					<div class="display-tc">
						<div class="row">
							<div class="col-md-8 animate-box">
								<h1 class="no-margin">Отделение</h1>
								<p>Каждый корпус функционально подразделяется на отделения.</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>

<?php

include "db-connect.php";

// удаление записи
if($_GET['act'] == 'del'){
	$query = "DELETE FROM departments WHERE id=".$_POST['id'];
    $result = mysqli_query($connect, $query);
}
// добавление новой записи
if($_GET['todo'] == 'create'){
	$query = "	INSERT INTO departments(id_specialization, id_housing) 
	            VALUES ('".$_POST['id_specialization']."',
	            		'".$_POST['id_housing']."'
	            )";
	$result = mysqli_query($connect, $query);
}
// изменение записи в базе данных
if($_GET['todo'] == 'update'){
	$query = "	UPDATE departments
	            SET id_specialization='".$_POST['id_specialization']."',
	            	id_housing='".$_POST['id_housing']."'
	            WHERE id=".$_POST['id'];
	$result = mysqli_query($connect, $query);
}
// новая запись (форма)
if($_GET['act'] == 'new'){

	$query = "SELECT id, name FROM specializations";
	$specialization = mysqli_query($connect, $query);

	$query = '	SELECT housings.id AS \'housid\', housings.name AS \'housname\', housings.id_hospital, hospitals.id, hospitals.name AS \'hospname\'
				FROM housings, hospitals
				WHERE housings.id_hospital = hospitals.id';
	$housing = mysqli_query($connect, $query);

	?>
	<div class="col-md-6">
		<form action="<?=$_SERVER['PHP_SELF']?>?todo=create" method="POST">

			<div class="form-group">
				<label for="name">Специализация</label>
				<select name="id_specialization" class="form-control">
					<?php
					while($rows = mysqli_fetch_assoc($specialization)){
						echo "<option value=\"".$rows['id']."\">".$rows['name']."</option>";
					}
					?>
				</select>
			</div>

			<div class="form-group">
				<label for="name">Корпус</label>
				<select name="id_housing" class="form-control">
					<?php
					while($rowh = mysqli_fetch_assoc($housing)){
						echo "<option value=\"".$rowh['housid']."\">".$rowh['housname']." - ".$rowh['hospname']."</option>";
					}
					?>
				</select>
			</div>

			<div class="form-group">
				<input type="submit" class="btn btn btn-special" value="Добавить">
			</div>
		</form>
	</div>
	<?php
} else
// редактирование (форма)
if($_GET['act'] == 'edit'){

	$query = "SELECT id, name FROM specializations";
	$specialization = mysqli_query($connect, $query);

	$query = '	SELECT housings.id AS \'housid\', housings.name AS \'housname\', housings.id_hospital, hospitals.id, hospitals.name AS \'hospname\'
				FROM housings, hospitals
				WHERE housings.id_hospital = hospitals.id';
	$housing = mysqli_query($connect, $query);

	?>
	<div class="col-md-6">
		<form action="<?=$_SERVER['PHP_SELF']?>?todo=update" method="POST">
			<input type="hidden" name="id" value="<?=$_POST['id']?>">
			<div class="form-group">
				<label for="name">Специализация</label>
				<select name="id_specialization" class="form-control">
					<?php
					while($rows = mysqli_fetch_assoc($specialization)){
						if($_POST['id_specialization'] == $rows['id'])
							echo "<option value=\"".$rows['id']."\" selected>".$rows['name']."</option>";
						else
							echo "<option value=\"".$rows['id']."\">".$rows['name']."</option>";
					}
					?>
				</select>
			</div>

			<div class="form-group">
				<label for="name">Корпус</label>
				<select name="id_housing" class="form-control">
					<?php
					while($rowh = mysqli_fetch_assoc($housing)){
						if($_POST['id_housing'] == $rowh['housid'])
							echo "<option value=\"".$rowh['housid']."\" selected>".$rowh['housname']." - ".$rowh['hospname']."</option>";
						else
							echo "<option value=\"".$rowh['housid']."\">".$rowh['housname']." - ".$rowh['hospname']."</option>";
					}
					?>
				</select>
			</div>

			<div class="form-group">
				<input type="submit" class="btn btn btn-special" value="Добавить">
			</div>
		</form>
	</div>
	<?php
} else{
	?>
	<div class="row" style="margin-bottom: 30px;">
	  	<div class="col-md-1"><p style="text-align: right;">Новое отделение: </p></div>
	  	<div class="col-md-1">
	    	<form action="<?=$_SERVER['PHP_SELF']?>?act=new" method="POST">
	      		<button type="submit" class="btn btn-success" style="height: 4rem; font-size: 1rem;">
	        		<span class="glyphicon glyphicon-plus"></span>
	      		</button>
	    	</form>
	  	</div>
	</div>

	<table class="table table-striped" style="margin-bottom: 50px;">
	<thead>
		<tr>
		  	<th>№</th>
		  	<th>корпус</th>
		  	<th>специализация</th>
		  	<th>редактировать</th>
		  	<th>удалить</th>
		</tr>
	</thead>
	<tbody>";

	<?php
	$query = "SELECT id, id_specialization, id_housing FROM departments";
	$result = mysqli_query($connect, $query);
	$i = 1;
	while($row = mysqli_fetch_assoc($result)){
		echo "<tr>";
		echo "<td>".($i++)."</td>";
		
		$query = '	SELECT housings.name AS \'housname\', housings.id_hospital, hospitals.id, hospitals.name AS \'hospname\'
					FROM housings, hospitals
					WHERE (housings.id_hospital = hospitals.id AND housings.id='.$row['id_housing'].')';
        $hos = mysqli_query($connect, $query);
        $h = mysqli_fetch_assoc($hos);
        echo "<td>".$h['housname']." (".$h['hospname'].")"."</td>";

		$query = "SELECT id, name FROM specializations WHERE id=".$row['id_specialization'];
        $spe = mysqli_query($connect, $query);
        $s = mysqli_fetch_assoc($spe);
        echo "<td>".$s['name']."</td>";

        ?>
			<td>
			  	<form action="<?=$_SERVER['PHP_SELF']?>?act=edit" method="POST">
			        <input type="hidden" name="id" value="<?=$row['id']?>">
			        <input type="hidden" name="id_specialization" value="<?=$row['id_specialization']?>">
			        <input type="hidden" name="id_housing" value="<?=$row['id_housing']?>">
			        <input type="submit" class="btn btn-info" style="height: 3.1rem; font-size: 0.9rem;" value="редактировать">
			    </form>
		    </td>
			<td>
			    <form action="<?=$_SERVER['PHP_SELF']?>?act=del" method="POST">
			      	<input type="hidden" name="id" value="<?=$row['id']?>">
			      	<input type="submit" class="btn btn-danger" style="height: 3.1rem; font-size: 0.9rem;" value="удалить">
			    </form>
			</td>
		</tr>
		<?php
	}
	?>
	</tbody>
	</table>
	<?php
}

include "footor.php";

?>