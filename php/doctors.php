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
								<h1 class="no-margin">Врачи</h1>
								<p>Те, кто занимается непосредственно релизацией основной деятельности лечебных учреждений.</p>
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
	$query = "DELETE FROM doctors WHERE id=".$_POST['id'];
    $result = mysqli_query($connect, $query);
}
// добавление новой записи
if($_GET['todo'] == 'create'){
	$query = "	INSERT INTO doctors(surname, name, lastname, birthdate, hiring_date, salary, last_vacation_from,
									last_vacation_to, id_degree, id_rank, id_category, next_vacation_from, next_vacation_to) 
	            VALUES ('".$_POST['surname']."',
	            		'".$_POST['name']."',
	            		'".$_POST['lastname']."',
	            		'".$_POST['birthdate']."',
	            		'".$_POST['hiring_date']."',
	            		'".$_POST['salary']."',
	            		'".$_POST['last_vacation_from']."',
	            		'".$_POST['last_vacation_to']."',
	            		'".$_POST['id_degree']."',
	            		'".$_POST['id_rank']."',
	            		'".$_POST['id_category']."',
	            		'".$_POST['next_vacation_from']."',
	            		'".$_POST['next_vacation_to']."'
	            )";
	$result = mysqli_query($connect, $query);
}
// изменение записи в базе данных
if($_GET['todo'] == 'update'){
	$query = "	UPDATE doctors
	            SET   	surname='".$_POST['surname']."',
	            		name='".$_POST['name']."',
	            		lastname='".$_POST['lastname']."',
	            		birthdate='".$_POST['birthdate']."',
	            		hiring_date='".$_POST['hiring_date']."',
	            		salary='".$_POST['salary']."',
	            		last_vacation_from='".$_POST['last_vacation_from']."',
	            		last_vacation_to='".$_POST['last_vacation_to']."',
	            		id_degree='".$_POST['id_degree']."',
	            		id_rank='".$_POST['id_rank']."',
	            		id_category='".$_POST['id_category']."',
	            		next_vacation_from='".$_POST['next_vacation_from']."',
	            		next_vacation_to='".$_POST['next_vacation_to']."'
	            WHERE id=".$_POST['id'];
	$result = mysqli_query($connect, $query);
}
// новая запись (форма)
if($_GET['act'] == 'new'){

	$query = "SELECT id, name FROM categories";
	$categories = mysqli_query($connect, $query);

	$query = "SELECT id, name FROM academic_degrees";
	$academic_degrees = mysqli_query($connect, $query);

	$query = "SELECT id, name FROM ranks";
	$ranks = mysqli_query($connect, $query);

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
				<label for="name">Категория</label>
				<select name="id_category" class="form-control">
					<?php
					while($rowc = mysqli_fetch_assoc($categories)){
						echo "<option value=\"".$rowc['id']."\">".$rowc['name']."</option>";
					}
					?>
				</select>
			</div>

			<div class="form-group">
				<label for="name">Учёная степень</label>
				<select name="id_degree" class="form-control">
					<?php
					while($rowd = mysqli_fetch_assoc($academic_degrees)){
						echo "<option value=\"".$rowd['id']."\">".$rowd['name']."</option>";
					}
					?>
				</select>
			</div>

			<div class="form-group">
				<label for="name">Звание</label>
				<select name="id_rank" class="form-control">
					<?php
					while($rowr = mysqli_fetch_assoc($ranks)){
						echo "<option value=\"".$rowr['id']."\">".$rowr['name']."</option>";
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

	$query = "SELECT id, name FROM categories";
	$categories = mysqli_query($connect, $query);

	$query = "SELECT id, name FROM academic_degrees";
	$academic_degrees = mysqli_query($connect, $query);

	$query = "SELECT id, name FROM ranks";
	$ranks = mysqli_query($connect, $query);

	?>
	<div class="col-md-6">
		<form action="<?=$_SERVER['PHP_SELF']?>?todo=update" method="POST">

			<input type="hidden" name="id" value="<?=$_POST['id']?>">

			<div class="form-group">
				<label for="surname">Фамилия</label>
				<input type="text" name ="surname" class="form-control" id="surname" value="<?=$_POST['surname']?>" required>
			</div>

			<div class="form-group">
				<label for="name">Имя</label>
				<input type="text" name ="name" class="form-control" id="name" value="<?=$_POST['name']?>" required>
			</div>

			<div class="form-group">
				<label for="lastname">Отчество</label>
				<input type="text" name ="lastname" class="form-control" id="lastname" value="<?=$_POST['lastname']?>" required>
			</div>

			<div class="form-group">
				<label for="birthdate">Дата рождения</label>
				<input type="date" name ="birthdate" class="form-control" id="birthdate" value="<?=$_POST['birthdate']?>" required>
			</div>

			<div class="form-group">
				<label for="hiring_date">Дата найма</label>
				<input type="date" name ="hiring_date" class="form-control" id="hiring_date" value="<?=$_POST['hiring_date']?>" required>
			</div>

			<div class="form-group">
				<label for="salary">Оклад</label>
				<input type="number" step="0.1" min="0" name="salary" class="form-control" value="<?=$_POST['salary']?>" required>
			</div>

			<div class="form-group">
				<label for="last_vacation_from">Последний отпуск с</label>
				<input type="date" name ="last_vacation_from" class="form-control" id="last_vacation_from" value="<?=$_POST['last_vacation_from']?>">
			</div>

			<div class="form-group">
				<label for="last_vacation_to">Последний отпуск по</label>
				<input type="date" name ="last_vacation_to" class="form-control" id="last_vacation_to" value="<?=$_POST['last_vacation_to']?>">
			</div>

			<div class="form-group">
				<label for="name">Категория</label>
				<select name="id_category" class="form-control">
					<?php
					while($rowc = mysqli_fetch_assoc($categories)){
						if($_POST['id_category'] == $rowc['id'])
							echo "<option value=\"".$rowc['id']."\" selected>".$rowc['name']."</option>";
						else
							echo "<option value=\"".$rowc['id']."\">".$rowc['name']."</option>";
					}
					?>
				</select>
			</div>

			<div class="form-group">
				<label for="name">Учёная степень</label>
				<select name="id_degree" class="form-control">
					<?php
					while($rowd = mysqli_fetch_assoc($academic_degrees)){
						if($_POST['id_degree'] == $rowd['id'])
							echo "<option value=\"".$rowd['id']."\" selected>".$rowd['name']."</option>";
						else
							echo "<option value=\"".$rowd['id']."\">".$rowd['name']."</option>";
					}
					?>
				</select>
			</div>

			<div class="form-group">
				<label for="name">Звание</label>
				<select name="id_rank" class="form-control">
					<?php
					while($rowr = mysqli_fetch_assoc($ranks)){
						if($_POST['id_rank'] == $rowr['id'])
							echo "<option value=\"".$rowr['id']."\" selected>".$rowr['name']."</option>";
						else
							echo "<option value=\"".$rowr['id']."\">".$rowr['name']."</option>";
					}
					?>
				</select>
			</div>

			<div class="form-group">
				<label for="next_vacation_from">Следующий отпуск с</label>
				<input type="date" name ="next_vacation_from" class="form-control" id="next_vacation_from" value="<?=$_POST['next_vacation_from']?>">
			</div>

			<div class="form-group">
				<label for="next_vacation_to">Следующий отпуск по</label>
				<input type="date" name ="next_vacation_to" class="form-control" id="next_vacation_to" value="<?=$_POST['next_vacation_to']?>">
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
	  	<div class="col-md-1"><p style="text-align: right;">Новый доктор: </p></div>
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
		  	<th>фамилия</th>
		  	<th>имя</th>
		  	<th>отчество</th>
		  	<th>дата рождения</th>
		  	<th>дата найма</th>
		  	<th>оклад</th>
		  	<th>последний отпуск с</th>
		  	<th>последний отпуск по</th>
		  	<th>учёная степень</th>
		  	<th>звание</th>
		  	<th>категория</th>
		  	<th>следующий отпуск с</th>
		  	<th>следующий отпуск по</th>
		  	<th>редактировать</th>
		  	<th>удалить</th>
		</tr>
	</thead>
	<tbody>

	<?php
	$query = "SELECT id, surname, name, lastname, birthdate, hiring_date, salary, last_vacation_from,
					last_vacation_to, id_degree, id_rank, id_category, next_vacation_from, next_vacation_to FROM doctors";
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

		$query = "SELECT id, name FROM academic_degrees WHERE id=".$row['id_degree'];
        $deg = mysqli_query($connect, $query);
        $d = mysqli_fetch_assoc($deg);
        echo "<td>".$d['name']."</td>";

        $query = "SELECT id, name FROM ranks WHERE id=".$row['id_rank'];
        $ran = mysqli_query($connect, $query);
        $r = mysqli_fetch_assoc($ran);
        echo "<td>".$r['name']."</td>";

		$query = "SELECT id, name FROM categories WHERE id=".$row['id_category'];
        $cat = mysqli_query($connect, $query);
        $c = mysqli_fetch_assoc($cat);
        echo "<td>".$c['name']."</td>";

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
			        <input type="hidden" name="id_degree" value="<?=$row['id_degree']?>">
			        <input type="hidden" name="id_rank" value="<?=$row['id_rank']?>">
			        <input type="hidden" name="id_category" value="<?=$row['id_category']?>">
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