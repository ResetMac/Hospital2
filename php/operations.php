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
								<h1 class="no-margin">Операции врачей</h1>
								<p>Описание и характеристика операций, проведённых врачами.</p>
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
	$query = "DELETE FROM operations WHERE id=".$_POST['id'];
    $result = mysqli_query($connect, $query);
}
// добавление новой записи
if($_GET['todo'] == 'create'){
	$query = "	INSERT INTO operations(surname, name, lastname, description, deth, id_doctor, beginning_time, ending_time) 
	            VALUES ('".$_POST['surname']."',
	            		'".$_POST['name']."',
	            		'".$_POST['lastname']."',
	            		'".$_POST['description']."',
	            		'".$_POST['deth']."',
	            		'".$_POST['id_doctor']."',
	            		'".$_POST['beginning_time']."',
	            		'".$_POST['ending_time']."'
	            )";
	$result = mysqli_query($connect, $query);
}
// изменение записи в базе данных
if($_GET['todo'] == 'update'){
	$query = "	UPDATE operations
	            SET   	surname='".$_POST['surname']."',
	            		name='".$_POST['name']."',
	            		lastname='".$_POST['lastname']."',
	            		description='".$_POST['description']."',
	            		deth='".$_POST['deth']."',
	            		id_doctor='".$_POST['id_doctor']."',
	            		beginning_time='".$_POST['beginning_time']."',
	            		ending_time='".$_POST['ending_time']."'
	            WHERE id=".$_POST['id'];
	$result = mysqli_query($connect, $query);
}
// новая запись (форма)
if($_GET['act'] == 'new'){

	$query = '	SELECT categories.id, categories.name AS \'catname\', doctors.id AS \'docid\', doctors.surname AS \'docsurename\', doctors.name AS \'docname\', doctors.lastname AS \'doclastname\', doctors.id_category
				FROM categories, doctors
				WHERE doctors.id_category = categories.id';
	$doctors_categories = mysqli_query($connect, $query);

	?>
	<div class="col-md-6">
		<form action="<?=$_SERVER['PHP_SELF']?>?todo=create" method="POST">

			<div class="form-group">
				<label for="surname">Фамилия пациента</label>
				<input type="text" name ="surname" class="form-control" id="surname" required>
			</div>

			<div class="form-group">
				<label for="name">Имя пациента</label>
				<input type="text" name ="name" class="form-control" id="name" required>
			</div>

			<div class="form-group">
				<label for="lastname">Отчество пациента</label>
				<input type="text" name ="lastname" class="form-control" id="lastname" required>
			</div>

			<div class="form-group">
				<label for="description">Описание</label>
				<textarea name ="description" class="form-control" id="description" style="max-width: 100%;" required></textarea>
			</div>

			<div class="form-group">
				<label>Летальный исход</label><br><br>
				<label for="deth">Да</label>
				<input type="radio" name ="deth" value="1" id="deth">
				<label for="deth1">Нет</label>
				<input type="radio" name ="deth" value="0" id="deth1" checked>
			</div>

			<div class="form-group">
				<label for="id_doctor">Врач</label>
				<select name="id_doctor" class="form-control">
					<?php
					while($rowc = mysqli_fetch_assoc($doctors_categories)){
						echo "<option value=\"".$rowc['docid']."\">".$rowc['docsurename']." ".$rowc['docname']." ".$rowc['doclastname']." - ".$rowc['catname']."</option>";
					}
					?>
				</select>
			</div>

			<div class="form-group">
				<label for="beginning_time">Время начала операции</label>
				<input type="datetime-local" name ="beginning_time" class="form-control" id="beginning_time">
			</div>

			<div class="form-group">
				<label for="ending_time">Время окончания операции</label>
				<input type="datetime-local" name ="ending_time" class="form-control" id="ending_time">
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

	$query = '	SELECT categories.id, categories.name AS \'catname\', doctors.id AS \'docid\', doctors.surname AS \'docsurename\', doctors.name AS \'docname\', doctors.lastname AS \'doclastname\'
				FROM categories, doctors
				WHERE doctors.id_category = categories.id';
	$doctors_categories = mysqli_query($connect, $query);

	$start = substr($_POST['beginning_time'], 0, 10)."T".substr($_POST['beginning_time'], 11, 5);
	$end = substr($_POST['ending_time'], 0, 10)."T".substr($_POST['ending_time'], 11, 5);

	?>
	<div class="col-md-6">
		<form action="<?=$_SERVER['PHP_SELF']?>?todo=update" method="POST">

			<input type="hidden" name="id" value="<?=$_POST['id']?>">

			<div class="form-group">
				<label for="surname">Фамилия пациента</label>
				<input type="text" name ="surname" class="form-control" id="surname" value="<?=$_POST['surname']?>" required>
			</div>

			<div class="form-group">
				<label for="name">Имя пациента</label>
				<input type="text" name ="name" class="form-control" id="name" value="<?=$_POST['name']?>" required>
			</div>

			<div class="form-group">
				<label for="lastname">Отчество пациента</label>
				<input type="text" name ="lastname" class="form-control" id="lastname" value="<?=$_POST['lastname']?>" required>
			</div>

			<div class="form-group">
				<label for="description">Описание</label>
				<textarea name ="description" class="form-control" id="description" required><?=$_POST['description']?></textarea>
			</div>

			<div class="form-group">
				<label>Летальный исход</label><br>
				<?php if($_POST['deth'] == 1) {?>
					<label for="deth">Да</label>
					<input type="radio" name ="deth" value="1" id="deth" checked>
				<?php }else {?>
					<label for="deth">Да</label>
					<input type="radio" name ="deth" value="1" id="deth">
				<?php }if($_POST['deth'] == 0) {?>
					<label for="deth1">Нет</label>
					<input type="radio" name ="deth" value="0" id="deth1" checked>
				<?php }else {?>
					<label for="deth1">Нет</label>
					<input type="radio" name ="deth" value="0" id="deth1">
				<?php }?>
				<br>
			</div>

			<div class="form-group">
				<label for="id_doctor">Врач</label>
				<select name="id_doctor" class="form-control">
					<?php
					while($rowc = mysqli_fetch_assoc($doctors_categories)){
						if($_POST['id_doctor'] == $rowc['docid'])
							echo "<option value=\"".$rowc['docid']."\" selected>".$rowc['docsurename']." ".$rowc['docname']." ".$rowc['doclastname']." - ".$rowc['catname']."</option>";
						else
							echo "<option value=\"".$rowc['docid']."\">".$rowc['docsurename']." ".$rowc['docname']." ".$rowc['doclastname']." - ".$rowc['catname']."</option>";
					}
					?>
				</select>
			</div>

			<div class="form-group">
				<label for="beginning_time">Время начала операции</label>
				<input type="datetime-local" name ="beginning_time" value="<?=$start?>" class="form-control" id="beginning_time">
			</div>

			<div class="form-group">
				<label for="ending_time">Время окончания операции</label>
				<input type="datetime-local" name ="ending_time" value="<?=$end?>" class="form-control" id="ending_time">
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
	  	<div class="col-md-1"><p style="text-align: right;">Новая операция: </p></div>
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
		  	<th>фамилия пациента</th>
		  	<th>имя пациента</th>
		  	<th>отчество пациента</th>
		  	<th>описание</th>
		  	<th>летальный исход</th>
		  	<th>врач</th>
		  	<th>время начала</th>
		  	<th>время окончания</th>
		  	<th>редактировать</th>
		  	<th>удалить</th>
		</tr>
	</thead>
	<tbody>

	<?php
	$query = "SELECT id, surname, name, lastname, description, deth, id_doctor, beginning_time, ending_time FROM operations";
	$result = mysqli_query($connect, $query);
	$i = 1;
	while($row = mysqli_fetch_assoc($result)){
		echo "<tr>";
		echo "<td>".($i++)."</td>";
		echo "<td>".$row['surname']."</td>";
		echo "<td>".$row['name']."</td>";
		echo "<td>".$row['lastname']."</td>";
		echo "<td>".$row['description']."</td>";
		if($row['deth'] == 1)
			echo "<td>да</td>";
		else
			echo "<td>нет</td>";

		$query = "SELECT id, surname, name, lastname FROM doctors WHERE id=".$row['id_doctor'];
        $doc = mysqli_query($connect, $query);
        $d = mysqli_fetch_assoc($doc);
        echo "<td>".$d['surname']." ".$d['name']." ".$d['lastname']."</td>";

		echo "<td>".$row['beginning_time']."</td>";
		echo "<td>".$row['ending_time']."</td>";

		?>
			<td>
			    <form action="<?=$_SERVER['PHP_SELF']?>?act=edit" method="POST">
			        <input type="hidden" name="id" value="<?=$row['id']?>">
			        <input type="hidden" name="surname" value="<?=$row['surname']?>">
			        <input type="hidden" name="name" value="<?=$row['name']?>">
			        <input type="hidden" name="lastname" value="<?=$row['lastname']?>">
			        <input type="hidden" name="description" value="<?=$row['description']?>">
			        <input type="hidden" name="deth" value="<?=$row['deth']?>">
			        <input type="hidden" name="id_doctor" value="<?=$row['id_doctor']?>">
			        <input type="hidden" name="beginning_time" value="<?=$row['beginning_time']?>">
			        <input type="hidden" name="ending_time" value="<?=$row['ending_time']?>">
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