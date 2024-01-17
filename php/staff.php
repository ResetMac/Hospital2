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
								<h1 class="no-margin">Обслуживающий персонал</h1>
								<p>Те, кто занимается организацией эффективной деятельности лечебных учреждений.</p>
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
	$query = "DELETE FROM staff WHERE id=".$_POST['id'];
    $result = mysqli_query($connect, $query);
}
// добавление новой записи
if($_GET['todo'] == 'create'){
	$query = "	INSERT INTO staff(surname, name, lastname, birthdate, hiring_date, salary, last_vacation_from,
									last_vacation_to, next_vacation_from, next_vacation_to, id_occupy, id_department) 
	            VALUES ('".$_POST['surname']."',
	            		'".$_POST['name']."',
	            		'".$_POST['lastname']."',
	            		'".$_POST['birthdate']."',
	            		'".$_POST['hiring_date']."',
	            		'".$_POST['salary']."',
	            		'".$_POST['last_vacation_from']."',
	            		'".$_POST['last_vacation_to']."',
	            		'".$_POST['next_vacation_from']."',
	            		'".$_POST['next_vacation_to']."',
	            		'".$_POST['id_occupy']."',
	            		'".$_POST['id_department']."'
	            )";
	$result = mysqli_query($connect, $query);
}
// изменение записи в базе данных
if($_GET['todo'] == 'update'){
	$query = "	UPDATE staff
	            SET   	surname='".$_POST['surname']."',
	            		name='".$_POST['name']."',
	            		lastname='".$_POST['lastname']."',
	            		birthdate='".$_POST['birthdate']."',
	            		hiring_date='".$_POST['hiring_date']."',
	            		salary='".$_POST['salary']."',
	            		last_vacation_from='".$_POST['last_vacation_from']."',
	            		last_vacation_to='".$_POST['last_vacation_to']."',
	            		next_vacation_from='".$_POST['next_vacation_from']."',
	            		next_vacation_to='".$_POST['next_vacation_to']."',
	            		id_occupy='".$_POST['id_occupy']."',
	            		id_department='".$_POST['id_department']."'
	            WHERE id=".$_POST['id'];
	$result = mysqli_query($connect, $query);
}
// новая запись (форма)
if($_GET['act'] == 'new'){

	$query = "SELECT id, name FROM occupies";
	$occupies = mysqli_query($connect, $query);

	$query = '	SELECT 	departments.id AS \'depid\', departments.id_specialization, departments.id_housing,
						specializations.id, specializations.name AS \'specname\',
						housings.id, housings.name AS \'housname\', housings.id_hospital, hospitals.id, hospitals.name AS \'hospname\'
				FROM departments, specializations, housings, hospitals
				WHERE (departments.id_specialization = specializations.id AND
						departments.id_housing = housings.id AND
						housings.id_hospital = hospitals.id)';
	$departments = mysqli_query($connect, $query);

	?>
	<div class="col-md-6">
		<form action="<?=$_SERVER['PHP_SELF']?>?todo=create" method="POST">
			<div class="form-group">
				<label for="surname">Фамилия</label>
				<input type="text" name ="surname" class="form-control" id="surname" required>
			</div>

			<div class="form-group">
				<label for="name">Имя</label>
				<input type="text" name ="name" class="form-control" id="name" required>
			</div>

			<div class="form-group">
				<label for="lastname">Отчество</label>
				<input type="text" name ="lastname" class="form-control" id="lastname" required>
			</div>

			<div class="form-group">
				<label for="birthdate">Дата рождения</label>
				<input type="date" name ="birthdate" class="form-control" id="birthdate" required>
			</div>

			<div class="form-group">
				<label for="hiring_date">Дата найма</label>
				<input type="date" name ="hiring_date" class="form-control" id="hiring_date" required>
			</div>

			<div class="form-group">
				<label for="salary">Оклад</label>
				<input type="number" step="0.1" min="0" name="salary" class="form-control" required>
			</div>

			<div class="form-group">
				<label for="last_vacation_from">Последний отпуск с</label>
				<input type="date" name ="last_vacation_from" class="form-control" id="last_vacation_from">
			</div>

			<div class="form-group">
				<label for="last_vacation_to">Последний отпуск по</label>
				<input type="date" name ="last_vacation_to" class="form-control" id="last_vacation_to">
			</div>

			<div class="form-group">
				<label for="name">Должность</label>
				<select name="id_occupy" class="form-control">
					<?php
					while($rowo = mysqli_fetch_assoc($occupies)){
						echo "<option value=\"".$rowo['id']."\">".$rowo['name']."</option>";
					}
					?>
				</select>
			</div>

			<div class="form-group">
				<label for="name">Отделение</label>
				<select name="id_department" class="form-control">
					<?php
					while($rowd = mysqli_fetch_assoc($departments)){
						echo "<option value=\"".$rowd['depid']."\">".$rowd['specname']." - ".$rowd['housname']." (".$rowd['hospname'].")</option>";
					}
					?>
				</select>
			</div>

			<div class="form-group">
				<label for="next_vacation_from">Следующий отпуск с</label>
				<input type="date" name ="next_vacation_from" class="form-control" id="next_vacation_from">
			</div>

			<div class="form-group">
				<label for="next_vacation_to">Следующий отпуск по</label>
				<input type="date" name ="next_vacation_to" class="form-control" id="next_vacation_to">
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

	$query = "SELECT id, name FROM occupies";
	$occupies = mysqli_query($connect, $query);

	$query = '	SELECT 	departments.id AS \'depid\', departments.id_specialization, departments.id_housing,
						specializations.id, specializations.name AS \'specname\',
						housings.id, housings.name AS \'housname\', housings.id_hospital, hospitals.id, hospitals.name AS \'hospname\'
				FROM departments, specializations, housings, hospitals
				WHERE (departments.id_specialization = specializations.id AND
						departments.id_housing = housings.id AND
						housings.id_hospital = hospitals.id)';
	$departments = mysqli_query($connect, $query);

	?>
	<div class="col-md-6">
		<form action="<?=$_SERVER['PHP_SELF']?>?todo=update" method="POST">
			<input type="hidden" name="id" value="<?=$_POST['id']?>">
			<div class="form-group">
				<label for="surname">Фамилия</label>
				<input type="text" name ="surname" value="<?=$_POST['surname']?>" class="form-control" id="surname" required>
			</div>

			<div class="form-group">
				<label for="name">Имя</label>
				<input type="text" name ="name" value="<?=$_POST['name']?>" class="form-control" id="name" required>
			</div>

			<div class="form-group">
				<label for="lastname">Отчество</label>
				<input type="text" name ="lastname" value="<?=$_POST['lastname']?>" class="form-control" id="lastname" required>
			</div>

			<div class="form-group">
				<label for="birthdate">Дата рождения</label>
				<input type="date" name ="birthdate" value="<?=$_POST['birthdate']?>" class="form-control" id="birthdate" required>
			</div>

			<div class="form-group">
				<label for="hiring_date">Дата найма</label>
				<input type="date" name ="hiring_date" value="<?=$_POST['hiring_date']?>" class="form-control" id="hiring_date" required>
			</div>

			<div class="form-group">
				<label for="salary">Оклад</label>
				<input type="number" step="0.1" min="0" name="salary" value="<?=$_POST['salary']?>" class="form-control" required>
			</div>

			<div class="form-group">
				<label for="last_vacation_from">Последний отпуск с</label>
				<input type="date" name ="last_vacation_from" value="<?=$_POST['last_vacation_from']?>" class="form-control" id="last_vacation_from">
			</div>

			<div class="form-group">
				<label for="last_vacation_to">Последний отпуск по</label>
				<input type="date" name ="last_vacation_to" value="<?=$_POST['last_vacation_to']?>" class="form-control" id="last_vacation_to">
			</div>

			<div class="form-group">
				<label for="name">Должность</label>
				<select name="id_occupy" class="form-control">
					<?php
					while($rowo = mysqli_fetch_assoc($occupies)){
						if($_POST['id_occupy'] == $rowo['id'])
							echo "<option value=\"".$rowo['id']."\" selected>".$rowo['name']."</option>";
						else
							echo "<option value=\"".$rowo['id']."\">".$rowo['name']."</option>";
					}
					?>
				</select>
			</div>

			<div class="form-group">
				<label for="name">Отделение</label>
				<select name="id_department" class="form-control">
					<?php
					while($rowd = mysqli_fetch_assoc($departments)){
						if($_POST['id_department'] == $rowd['depid'])
							echo "<option value=\"".$rowd['depid']."\" selected>".$rowd['specname']." - ".$rowd['housname']." (".$rowd['hospname'].")</option>";
						else
							echo "<option value=\"".$rowd['depid']."\">".$rowd['specname']." - ".$rowd['housname']." (".$rowd['hospname'].")</option>";
					}
					?>
				</select>
			</div>

			<div class="form-group">
				<label for="next_vacation_from">Следующий отпуск с</label>
				<input type="date" name ="next_vacation_from" value="<?=$_POST['next_vacation_from']?>" class="form-control" id="next_vacation_from">
			</div>

			<div class="form-group">
				<label for="next_vacation_to">Следующий отпуск по</label>
				<input type="date" name ="next_vacation_to" value="<?=$_POST['next_vacation_to']?>" class="form-control" id="next_vacation_to">
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
	  	<div class="col-md-1"><p style="text-align: right;">Новый сотрудник: </p></div>
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
		  	<th>фамилия</th>
		  	<th>имя</th>
		 	<th>отчество</th>
		  	<th>дата рождения</th>
		  	<th>дата найма</th>
		  	<th>оклад</th>
		  	<th>последний отпуск с</th>
		  	<th>последний отпуск по</th>
		  	<th>должность</th>
		  	<th>отделение</th>
		  	<th>следующий отпуск с</th>
		  	<th>следующий отпуск по</th>
		  	<th>редактировать</th>
		  	<th>удалить</th>
		</tr>
	</thead>
	<tbody>

	<?php
	$query = "SELECT 	id, surname, name, lastname, birthdate, hiring_date, salary, last_vacation_from,
						last_vacation_to, next_vacation_from, next_vacation_to, id_occupy, id_department FROM staff";
	$result = mysqli_query($connect, $query);
	$i = 1;
	while($row = mysqli_fetch_assoc($result)){
		echo "<tr>";
		echo "<td>".($i++)."</td>";
		echo "<td>".$row['surname']."</td>";
		echo "<td>".$row['name']."</td>";
		echo "<td>".$row['lastname']."</td>";
		echo "<td>".$row['birthdate']."</td>";
		echo "<td>".$row['hiring_date']."</td>";
		echo "<td>".$row['salary']."</td>";

		if($row['last_vacation_from'] !== "0000-00-00")
        	echo "<td>".$row['last_vacation_from']."</td>";
        else
        	echo "<td>-</td>";
		
		if($row['last_vacation_to'] !== "0000-00-00")
        	echo "<td>".$row['last_vacation_to']."</td>";
        else
        	echo "<td>-</td>";

		$query = "SELECT id, name FROM occupies WHERE id=".$row['id_occupy'];
        $occ = mysqli_query($connect, $query);
        $o = mysqli_fetch_assoc($occ);
        echo "<td>".$o['name']."</td>";

        $query = '	SELECT 	departments.id, departments.id_specialization, departments.id_housing,
							specializations.id, specializations.name AS \'specname\',
							housings.id, housings.name AS \'housname\', housings.id_hospital, hospitals.id, hospitals.name AS \'hospname\'
					FROM departments, specializations, housings, hospitals
					WHERE (departments.id_specialization = specializations.id AND
							departments.id_housing = housings.id AND
							housings.id_hospital = hospitals.id AND
							departments.id = '.$row['id_department'].')';
        $dep = mysqli_query($connect, $query);
        $d = mysqli_fetch_assoc($dep);
        echo "<td>".$d['specname']." - ".$d['housname']." (".$d['hospname'].")</td>";

        if($row['next_vacation_from'] !== "0000-00-00")
        	echo "<td>".$row['next_vacation_from']."</td>";
        else
        	echo "<td>-</td>";

        if($row['next_vacation_to'] !== "0000-00-00")
			echo "<td>".$row['next_vacation_to']."</td>";
		else
        	echo "<td>-</td>";

        ?>
			<td>
			    <form action="<?=$_SERVER['PHP_SELF']?>?act=edit" method="POST">
			        <input type="hidden" name="id" value="<?=$row['id']?>">
			        <input type="hidden" name="surname" value="<?=$row['surname']?>">
			        <input type="hidden" name="name" value="<?=$row['name']?>">
			        <input type="hidden" name="lastname" value="<?=$row['lastname']?>">
			        <input type="hidden" name="birthdate" value="<?=$row['birthdate']?>">
			        <input type="hidden" name="hiring_date" value="<?=$row['hiring_date']?>">
			        <input type="hidden" name="salary" value="<?=$row['salary']?>">
			        <input type="hidden" name="last_vacation_from" value="<?=$row['last_vacation_from']?>">
			        <input type="hidden" name="last_vacation_to" value="<?=$row['last_vacation_to']?>">
			        <input type="hidden" name="id_occupy" value="<?=$row['id_occupy']?>">
			        <input type="hidden" name="id_department" value="<?=$row['id_department']?>">
			        <input type="hidden" name="next_vacation_from" value="<?=$row['next_vacation_from']?>">
			        <input type="hidden" name="next_vacation_to" value="<?=$row['next_vacation_to']?>">
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