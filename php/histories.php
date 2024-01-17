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
								<h1 class="no-margin">Истории болезней</h1>
								<p>По каждому пациенту ведётся история его болезней, чтобы ему было проще оказывать помощь независимо от лечащего врача.</p>
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
	$query = "DELETE FROM histories WHERE id=".$_POST['id'];
    $result = mysqli_query($connect, $query);
}
// добавление новой записи
if($_GET['todo'] == 'create'){
	$query = "	INSERT INTO histories(id_pacient, date_in, date_out, id_doctor, diagnosis, appointment, treatment_result) 
	            VALUES ('".$_POST['id_pacient']."',
	            		'".$_POST['date_in']."',
	            		'".$_POST['date_out']."',
	            		'".$_POST['id_doctor']."',
	            		'".$_POST['diagnosis']."',
	            		'".$_POST['appointment']."',
	            		'".$_POST['treatment_result']."'
	            )";
	$result = mysqli_query($connect, $query);
}
// изменение записи в базе данных
if($_GET['todo'] == 'update'){
	$query = "	UPDATE histories
	            SET   	id_pacient='".$_POST['id_pacient']."',
	            		date_in='".$_POST['date_in']."',
	            		date_out='".$_POST['date_out']."',
	            		id_doctor='".$_POST['id_doctor']."',
	            		diagnosis='".$_POST['diagnosis']."',
	            		appointment='".$_POST['appointment']."',
	            		treatment_result='".$_POST['treatment_result']."'
	            WHERE id=".$_POST['id'];
	$result = mysqli_query($connect, $query);
}
// новая запись (форма)
if($_GET['act'] == 'new'){

	$query = "SELECT id, surname, name, lastname FROM patients";
	$patients = mysqli_query($connect, $query);

	$query = '	SELECT 	categories.id, categories.name AS \'catname\', doctors.id AS \'docid\', doctors.surname AS \'docsurename\',
						doctors.name AS \'docname\', doctors.lastname AS \'doclastname\'
				FROM categories, doctors
				WHERE doctors.id_category = categories.id';
    $doccat = mysqli_query($connect, $query);

	?>
	<div class="col-md-6">
		<form action="<?=$_SERVER['PHP_SELF']?>?todo=create" method="POST">

			<div class="form-group">
				<label for="name">Пациент</label>
				<select name="id_pacient" class="form-control">
					<?php
					while($rowp = mysqli_fetch_assoc($patients)){
						if($rowp['id'] !== '1')
							echo "<option value=\"".$rowp['id']."\">".$rowp['surname']." ".$rowp['name']." ".$rowp['lastname']."</option>";
					}
					?>
				</select>
			</div>

			<div class="form-group">
				<label for="date_in">Время постановки на учёт</label>
				<input type="datetime-local" name ="date_in" class="form-control" id="date_in" required>
			</div>

			<div class="form-group">
				<label for="date_out">Время снятия с учёта</label>
				<input type="datetime-local" name ="date_out" class="form-control" id="date_out" required>
			</div>

			<div class="form-group">
				<label for="name">Лечащий врач</label>
				<select name="id_doctor" class="form-control">
					<?php
					while($rowd = mysqli_fetch_assoc($doccat)){
						echo "<option value=\"".$rowd['docid']."\">".$rowd['docsurename']." ".$rowd['docname']." ".$rowd['doclastname']." - ".$rowd['catname']."</option>";
					}
					?>
				</select>
			</div>

			<div class="form-group">
				<label for="diagnosis">Диагноз</label>
				<input type="text" name ="diagnosis" class="form-control" id="diagnosis" required>
			</div>

			<div class="form-group">
				<label for="appointment">Назначение</label>
				<textarea name ="appointment" class="form-control" id="appointment" style="max-width: 100%;" required></textarea>
			</div>

			<div class="form-group">
				<label for="treatment_result">Результат лечения</label>
				<textarea name ="treatment_result" class="form-control" id="treatment_result" style="max-width: 100%;" required></textarea>
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

	$query = "SELECT id, surname, name, lastname FROM patients";
	$patients = mysqli_query($connect, $query);

	$query = '	SELECT 	categories.id, categories.name AS \'catname\', doctors.id AS \'docid\', doctors.surname AS \'docsurename\',
						doctors.name AS \'docname\', doctors.lastname AS \'doclastname\'
				FROM categories, doctors
				WHERE doctors.id_category = categories.id';
    $doccat = mysqli_query($connect, $query);

    $start = substr($_POST['date_in'], 0, 10)."T".substr($_POST['date_in'], 11, 5);
	$end = substr($_POST['date_out'], 0, 10)."T".substr($_POST['date_out'], 11, 5);

	?>
	<div class="col-md-6">
		<form action="<?=$_SERVER['PHP_SELF']?>?todo=update" method="POST">
			<input type="hidden" name="id" value="<?=$_POST['id']?>">
			<div class="form-group">
				<label for="name">Пациент</label>
				<select name="id_pacient" class="form-control">
					<?php
					while($rowp = mysqli_fetch_assoc($patients)){
						if($rowp['id'] !== '1'){
							if($_POST['id_patient'] == $rowp['id'])
								echo "<option value=\"".$rowp['id']."\" selected>".$rowp['surname']." ".$rowp['name']." ".$rowp['lastname']."</option>";
							else
								echo "<option value=\"".$rowp['id']."\">".$rowp['surname']." ".$rowp['name']." ".$rowp['lastname']."</option>";
						}
					}
					?>
				</select>
			</div>

			<div class="form-group">
				<label for="date_in">Время постановки на учёт</label>
				<input type="datetime-local" name ="date_in" value="<?=$start?>" class="form-control" id="date_in" required>
			</div>

			<div class="form-group">
				<label for="date_out">Время снятия с учёта</label>
				<input type="datetime-local" name ="date_out" value="<?=$end?>" class="form-control" id="date_out" required>
			</div>

			<div class="form-group">
				<label for="name">Лечащий врач</label>
				<select name="id_doctor" class="form-control">
					<?php
					while($rowd = mysqli_fetch_assoc($doccat)){
						if($_POST['id_doctor'] == $rowd['docid'])
							echo "<option value=\"".$rowd['docid']."\" selected>".$rowd['docsurename']." ".$rowd['docname']." ".$rowd['doclastname']." - ".$rowd['catname']."</option>";
						else
							echo "<option value=\"".$rowd['docid']."\">".$rowd['docsurename']." ".$rowd['docname']." ".$rowd['doclastname']." - ".$rowd['catname']."</option>";
					}
					?>
				</select>
			</div>

			<div class="form-group">
				<label for="diagnosis">Диагноз</label>
				<input type="text" name ="diagnosis" value="<?=$_POST['diagnosis']?>" class="form-control" id="diagnosis" required>
			</div>

			<div class="form-group">
				<label for="appointment">Назначение</label>
				<textarea name ="appointment" class="form-control" id="appointment" style="max-width: 100%;" required><?=$_POST['appointment']?></textarea>
			</div>

			<div class="form-group">
				<label for="treatment_result">Результат лечения</label>
				<textarea name ="treatment_result" class="form-control" id="treatment_result" style="max-width: 100%;" required><?=$_POST['treatment_result']?></textarea>
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
	  	<div class="col-md-1"><p style="text-align: right;">Новая история: </p></div>
	  	<div class="col-md-1">
	    	<form action="<?=$_SERVER['PHP_SELF']?>?act=new" method="POST">
	      		<button type="submit" class="btn btn-success" style="height: 4rem; font-size: 1rem;">
	        		<span class="glyphicon glyphicon-plus"></span>
	      		</button>
	    	</form>
	  	</div>
	</div>

	<table class="table table-striped" style="margin-bottom: 50px;">";
	<thead>
		<tr>
		  	<th>№</th>
		  	<th>пациент</th>
		  	<th>поставлен на учёт</th>
		  	<th>снят с учёта (или предполагаемая дата)</th>
		  	<th>лечащий врач</th>
		  	<th>диагноз</th>
		  	<th>назначение</th>
		  	<th>результат лечения</th>
		  	<th>редактировать</th>
		  	<th>удалить</th>
		</tr>
	</thead>
	<tbody>

	<?php
	$query = "SELECT id, id_pacient, date_in, date_out, id_doctor, diagnosis, appointment, treatment_result FROM histories";
	$result = mysqli_query($connect, $query);
	$i = 1;
	while($row = mysqli_fetch_assoc($result)){
		echo "<tr>";
		echo "<td>".($i++)."</td>";

		$query = "SELECT id, surname, name, lastname FROM patients WHERE id=".$row['id_pacient'];
        $pac = mysqli_query($connect, $query);
        $p = mysqli_fetch_assoc($pac);
        echo "<td>".$p['surname']." ".$p['name']." ".$p['lastname']."</td>";

		echo "<td>".$row['date_in']."</td>";
		echo "<td>".$row['date_out']."</td>";

		$query = '	SELECT 	categories.id, categories.name AS \'catname\', doctors.id AS \'docid\', doctors.surname AS \'docsurename\',
						doctors.name AS \'docname\', doctors.lastname AS \'doclastname\'
				FROM categories, doctors
				WHERE doctors.id_category = categories.id AND doctors.id='.$row['id_doctor'];
    	$doccat = mysqli_query($connect, $query);
    	$d = mysqli_fetch_assoc($doccat);
        echo "<td>".$d['docsurename']." ".$d['docname']." ".$d['doclastname']." (".mb_strtolower($d['catname']).")"."</td>";

		echo "<td>".$row['diagnosis']."</td>";
		echo "<td>".$row['appointment']."</td>";
		echo "<td>".$row['treatment_result']."</td>";

		?>
			<td>
			    <form action="<?=$_SERVER['PHP_SELF']?>?act=edit" method="POST">
			        <input type="hidden" name="id" value="<?=$row['id']?>">
			        <input type="hidden" name="id_patient" value="<?=$row['id_pacient']?>">
			        <input type="hidden" name="date_in" value="<?=$row['date_in']?>">
			        <input type="hidden" name="date_out" value="<?=$row['date_out']?>">
			        <input type="hidden" name="id_doctor" value="<?=$row['id_doctor']?>">
			        <input type="hidden" name="diagnosis" value="<?=$row['diagnosis']?>">
			        <input type="hidden" name="appointment" value="<?=$row['appointment']?>">
			        <input type="hidden" name="treatment_result" value="<?=$row['treatment_result']?>">
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