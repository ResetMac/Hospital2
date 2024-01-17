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
								<h1 class="no-margin">Койки</h1>
								<p>В каждой палате располагается некоторое количество коек, информация о которых размещена здесь.</p>
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
	$query = "DELETE FROM cots WHERE id=".$_POST['id'];
    $result = mysqli_query($connect, $query);
}
// добавление новой записи
if($_GET['todo'] == 'create'){
	$query = "	INSERT INTO cots(numb, occupied_from, occupied_to, id_chamber, id_patient) 
	            VALUES ('".$_POST['numb']."',
	            		'".$_POST['occupied_from']."',
	            		'".$_POST['occupied_to']."',
	            		'".$_POST['id_chamber']."',
	            		'".$_POST['id_patient']."'
	            )";
	$result = mysqli_query($connect, $query);
}
// изменение записи в базе данных
if($_GET['todo'] == 'update'){
	$query = "	UPDATE cots
	            SET numb='".$_POST['numb']."',
            		occupied_from='".$_POST['occupied_from']."',
            		occupied_to='".$_POST['occupied_to']."',
            		id_chamber='".$_POST['id_chamber']."',
	            	id_patient='".$_POST['id_patient']."'
	            WHERE id=".$_POST['id'];
	$result = mysqli_query($connect, $query);
}
// новая запись (форма)
if($_GET['act'] == 'new'){

	$query = '	SELECT 	chambers.id AS \'chid\', chambers.id_department, chambers.numb AS \'chnumb\', departments.id,
						departments.id_specialization, departments.id_housing,
						specializations.id, specializations.name AS \'specname\',
						housings.id, housings.name AS \'housname\', housings.id_hospital, hospitals.id, hospitals.name AS \'hospname\',
						hospitals.hospital AS \'ishospital\'
				FROM chambers, departments, specializations, housings, hospitals
				WHERE (	chambers.id_department = departments.id AND
						departments.id_specialization = specializations.id AND
						departments.id_housing = housings.id AND
						housings.id_hospital = hospitals.id)';
	$departments = mysqli_query($connect, $query);

	$query = '	SELECT 	patients.id AS \'idpacient\', patients.surname AS \'surname\', patients.name AS \'name\', patients.lastname AS \'lastname\', patients.id_department,
						departments.id, departments.id_housing,
						housings.id, housings.id_hospital,
						hospitals.id, hospitals.hospital
				FROM patients, departments, housings, hospitals
				WHERE (	patients.id_department = departments.id AND
						departments.id_housing = housings.id AND
						housings.id_hospital = hospitals.id AND
						hospitals.hospital = 1 
				)';
	$patients = mysqli_query($connect, $query);

	?>
	<div class="col-md-6">
		<form action="<?=$_SERVER['PHP_SELF']?>?todo=create" method="POST">
			<div class="form-group">
				<label for="numb">Номер</label>
				<input type="text" name ="numb" class="form-control" id="numb" required>
			</div>

			<div class="form-group">
				<label for="occupied_from">Занято с</label>
				<input type="date" name ="occupied_from" class="form-control" id="occupied_from">
			</div>

			<div class="form-group">
				<label for="occupied_to">Занято по</label>
				<input type="date" name ="occupied_to" class="form-control" id="occupied_to">
			</div>

			<div class="form-group">
				<label for="name">Палата</label>
				<select name="id_chamber" class="form-control">
					<?php
					while($rowd = mysqli_fetch_assoc($departments)){
						if($rowd['ishospital'] == '1')
							echo "<option value=\"".$rowd['chid']."\">".$rowd['chnumb']." - ".$rowd['specname']." - ".$rowd['housname']." (".$rowd['hospname'].")</option>";
					}
					?>
				</select>
			</div>

			<div class="form-group">
				<label for="name">Пациент</label>
				<select name="id_patient" class="form-control">
					<?php
					while($rowp = mysqli_fetch_assoc($patients)){
						if($rowp['idpacient'] == '1')
							echo "<option value=\"".$rowp['idpacient']."\">- Нет -</option>";
						else
							echo "<option value=\"".$rowp['idpacient']."\">".$rowp['surname']." ".$rowp['name']." ".$rowp['lastname']."</option>";
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

	$query = '	SELECT 	chambers.id AS \'chid\', chambers.id_department, chambers.numb AS \'chnumb\', departments.id,
						departments.id_specialization, departments.id_housing,
						specializations.id, specializations.name AS \'specname\',
						housings.id, housings.name AS \'housname\', housings.id_hospital, hospitals.id, hospitals.name AS \'hospname\',
						hospitals.hospital AS \'ishospital\'
				FROM chambers, departments, specializations, housings, hospitals
				WHERE (	chambers.id_department = departments.id AND
						departments.id_specialization = specializations.id AND
						departments.id_housing = housings.id AND
						housings.id_hospital = hospitals.id)';
	$departments = mysqli_query($connect, $query);

	$query = '	SELECT 	patients.id AS \'idpacient\', patients.surname AS \'surname\', patients.name AS \'name\', patients.lastname AS \'lastname\', patients.id_department,
						departments.id, departments.id_housing,
						housings.id, housings.id_hospital,
						hospitals.id, hospitals.hospital
				FROM patients, departments, housings, hospitals
				WHERE (	patients.id_department = departments.id AND
						departments.id_housing = housings.id AND
						housings.id_hospital = hospitals.id AND
						hospitals.hospital = 1 
				)';
	$patients = mysqli_query($connect, $query);

	?>
	<div class="col-md-6">
		<form action="<?=$_SERVER['PHP_SELF']?>?todo=update" method="POST">
			<input type="hidden" name="id" value="<?=$_POST['id']?>">
			<div class="form-group">
				<label for="numb">Номер</label>
				<input type="text" name ="numb" value="<?=$_POST['numb']?>" class="form-control" id="numb" required>
			</div>

			<div class="form-group">
				<label for="occupied_from">Занято с</label>
				<input type="date" name ="occupied_from" value="<?=$_POST['occupied_from']?>" class="form-control" id="occupied_from">
			</div>

			<div class="form-group">
				<label for="occupied_to">Занято по</label>
				<input type="date" name ="occupied_to" value="<?=$_POST['occupied_to']?>" class="form-control" id="occupied_to">
			</div>

			<div class="form-group">
				<label for="name">Палата</label>
				<select name="id_chamber" class="form-control">
					<?php
					while($rowd = mysqli_fetch_assoc($departments)){
						if($rowd['ishospital'] == '1'){
							if($_POST['id_chamber'] == $rowd['chid'])
								echo "<option value=\"".$rowd['chid']."\" selected>".$rowd['chnumb']." - ".$rowd['specname']." - ".$rowd['housname']." (".$rowd['hospname'].")</option>";
							else
								echo "<option value=\"".$rowd['chid']."\">".$rowd['chnumb']." - ".$rowd['specname']." - ".$rowd['housname']." (".$rowd['hospname'].")</option>";
						}
					}
					?>
				</select>
			</div>

			<div class="form-group">
				<label for="name">Пациент</label>
				<select name="id_patient" class="form-control">
					<?php
					while($rowp = mysqli_fetch_assoc($patients)){
						if($rowp['idpacient'] == '1'){
							if($_POST['id_patient'] == $rowp['idpacient'])
								echo "<option value=\"".$rowp['idpacient']."\" selected>- Нет -</option>";
							else
								echo "<option value=\"".$rowp['idpacient']."\">- Нет -</option>";
						}
						else{
							if($_POST['id_patient'] == $rowp['idpacient'])
								echo "<option value=\"".$rowp['idpacient']."\" selected>".$rowp['surname']." ".$rowp['name']." ".$rowp['lastname']."</option>";
							else
								echo "<option value=\"".$rowp['idpacient']."\">".$rowp['surname']." ".$rowp['name']." ".$rowp['lastname']."</option>";
						}
					}
					?>
				</select>
			</div>

			<div class="form-group">
				<input type="submit" class="btn btn btn-special" value="Редактировать">
			</div>
		</form>
	</div>
	<?php
} else{
	?>
	<div class="row" style="margin-bottom: 30px;">
	  	<div class="col-md-1"><p style="text-align: right;">Новая койка: </p></div>
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
		  	<th>номер</th>
		  	<th>занято с</th>
		  	<th>занято по</th>
		  	<th>палата</th>
		  	<th>пациент</th>
		  	<th>редактировать</th>
		  	<th>удалить</th>
		</tr>
	</thead>
	<tbody>";

	<?php
	$query = 'SELECT id, numb, occupied_from, occupied_to, id_chamber, id_patient FROM cots';
	$result = mysqli_query($connect, $query);
	$i = 1;
	while($row = mysqli_fetch_assoc($result)){
		if($row['id'] == 1)
			continue;
		echo "<tr>";
		echo "<td>".($i++)."</td>";
		echo "<td>".$row['numb']."</td>";
		
		if($row['occupied_from'] !== "0000-00-00")
        	echo "<td>".$row['occupied_from']."</td>";
        else
        	echo "<td>-</td>";

        if($row['occupied_to'] !== "0000-00-00")
        	echo "<td>".$row['occupied_to']."</td>";
        else
        	echo "<td>-</td>";

		$query = '	SELECT 	chambers.id AS \'chid\', chambers.id_department, chambers.numb AS \'chnumb\', departments.id,
							departments.id_specialization, departments.id_housing,
							specializations.id, specializations.name AS \'specname\',
							housings.id, housings.name AS \'housname\', housings.id_hospital, hospitals.id, hospitals.name AS \'hospname\'
					FROM chambers, departments, specializations, housings, hospitals
					WHERE (	chambers.id_department = departments.id AND
							departments.id_specialization = specializations.id AND
							departments.id_housing = housings.id AND
							housings.id_hospital = hospitals.id AND
							chambers.id = '.$row['id_chamber'].')';
        $cha = mysqli_query($connect, $query);
        $c = mysqli_fetch_assoc($cha);
        echo "<td>".$c['chnumb']." - ".$c['specname']." - ".$c['housname']." (".$c['hospname'].")</td>";

        $query = "SELECT id, surname, name, lastname FROM patients WHERE id=".$row['id_patient'];
        $pac = mysqli_query($connect, $query);
        $p = mysqli_fetch_assoc($pac);
        if($p['id'] == '1')
        	echo "<td>- Нет -</td>";
        else
        	echo "<td>".$p['surname']." ".$p['name']." ".$p['lastname']."</td>";

        ?>
			<td>
			    <form action="<?=$_SERVER['PHP_SELF']?>?act=edit" method="POST">
			    	<input type="hidden" name="id" value="<?=$row['id']?>">
			        <input type="hidden" name="numb" value="<?=$row['numb']?>">
			        <input type="hidden" name="occupied_from" value="<?=$row['occupied_from']?>">
			        <input type="hidden" name="occupied_to" value="<?=$row['occupied_to']?>">
			        <input type="hidden" name="id_chamber" value="<?=$row['id_chamber']?>">
			        <input type="hidden" name="id_patient" value="<?=$row['id_patient']?>">
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