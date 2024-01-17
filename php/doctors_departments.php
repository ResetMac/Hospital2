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
								<h1 class="no-margin">Врачи-отделения</h1>
								<p>Страница привязки врачей к отделениям. Возможно совместительство врачей.</p>
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
	$query = "DELETE FROM doctors_departments WHERE id=".$_POST['id'];
    $result = mysqli_query($connect, $query);
}
// добавление новой записи
if($_GET['todo'] == 'create'){
	$query = "	INSERT INTO doctors_departments(id_doctor, id_department) 
	            VALUES ('".$_POST['id_doctor']."',
	            		'".$_POST['id_department']."'
	            )";
	$result = mysqli_query($connect, $query);
}
// изменение записи в базе данных
if($_GET['todo'] == 'update'){
	$query = "	UPDATE doctors_departments
	            SET id_doctor='".$_POST['id_doctor']."',
	            	id_department='".$_POST['id_department']."'
	            WHERE id=".$_POST['id'];
	$result = mysqli_query($connect, $query);
}
// новая запись (форма)
if($_GET['act'] == 'new'){

	$query = '	SELECT 	categories.id, categories.name AS \'catname\', doctors.id AS \'docid\', doctors.surname AS \'docsurename\',
						doctors.name AS \'docname\', doctors.lastname AS \'doclastname\'
				FROM categories, doctors
				WHERE doctors.id_category = categories.id';
	$doctors_categories = mysqli_query($connect, $query);

	$query = '	SELECT 	departments.id AS \'depid\', departments.id_specialization, departments.id_housing,
						specializations.id, specializations.name AS \'specname\',
						housings.id, housings.name AS \'housname\', housings.id_hospital, hospitals.id, hospitals.name AS \'hospname\'
				FROM departments, specializations, housings, hospitals
				WHERE (departments.id_specialization = specializations.id AND
						departments.id_housing = housings.id AND
						housings.id_hospital = hospitals.id)';
	$department = mysqli_query($connect, $query);

	?>
	<div class="col-md-6">
		<form action="<?=$_SERVER['PHP_SELF']?>?todo=create" method="POST">

			<div class="form-group">
				<label for="name">Врач</label>
				<select name="id_doctor" class="form-control">
					<?php
					while($rowd = mysqli_fetch_assoc($doctors_categories)){
						echo "<option value=\"".$rowd['docid']."\">".$rowd['docsurename']." ".$rowd['docname']." ".$rowd['doclastname']." - ".mb_strtolower($rowd['catname'])."</option>";
					}
					?>
				</select>
			</div>

			<div class="form-group">
				<label for="name">Отделение</label>
				<select name="id_department" class="form-control">
					<?php
					while($rowd = mysqli_fetch_assoc($department)){
						echo "<option value=\"".$rowd['depid']."\">".$rowd['specname']." - ".$rowd['housname']." (".$rowd['hospname'].")</option>";
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

	$query = '	SELECT 	categories.id, categories.name AS \'catname\', doctors.id AS \'docid\', doctors.surname AS \'docsurename\',
						doctors.name AS \'docname\', doctors.lastname AS \'doclastname\'
				FROM categories, doctors
				WHERE doctors.id_category = categories.id';
	$doctors_categories = mysqli_query($connect, $query);

	$query = '	SELECT 	departments.id AS \'depid\', departments.id_specialization, departments.id_housing,
						specializations.id, specializations.name AS \'specname\',
						housings.id, housings.name AS \'housname\', housings.id_hospital, hospitals.id, hospitals.name AS \'hospname\'
				FROM departments, specializations, housings, hospitals
				WHERE (departments.id_specialization = specializations.id AND
						departments.id_housing = housings.id AND
						housings.id_hospital = hospitals.id)';
	$department = mysqli_query($connect, $query);

	?>
	<div class="col-md-6">
		<form action="<?=$_SERVER['PHP_SELF']?>?todo=update" method="POST">
			<input type="hidden" name="id" value="<?=$_POST['id']?>">
			<div class="form-group">
				<label for="name">Врач</label>
				<select name="id_doctor" class="form-control">
					<?php
					while($rowd = mysqli_fetch_assoc($doctors_categories)){
						if($_POST['id_doctor'] == $rowd['docid'])
							echo "<option value=\"".$rowd['docid']."\" selected>".$rowd['docsurename']." ".$rowd['docname']." ".$rowd['doclastname']." - ".mb_strtolower($rowd['catname'])."</option>";
						else
							echo "<option value=\"".$rowd['docid']."\">".$rowd['docsurename']." ".$rowd['docname']." ".$rowd['doclastname']." - ".mb_strtolower($rowd['catname'])."</option>";
					}
					?>
				</select>
			</div>

			<div class="form-group">
				<label for="name">Отделение</label>
				<select name="id_department" class="form-control">
					<?php
					while($rowd = mysqli_fetch_assoc($department)){
						if($_POST['id_department'] == $rowd['depid'])
							echo "<option value=\"".$rowd['depid']."\" selected>".$rowd['specname']." - ".$rowd['housname']." (".$rowd['hospname'].")</option>";
						else
							echo "<option value=\"".$rowd['depid']."\">".$rowd['specname']." - ".$rowd['housname']." (".$rowd['hospname'].")</option>";
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
	  	<div class="col-md-1"><p style="text-align: right;">Новая привязка к отделению: </p></div>
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
		  	<th>врач</th>
		  	<th>отделение</th>
		  	<th>редактировать</th>
		  	<th>удалить</th>
		</tr>
	</thead>
	<tbody>

	<?php
	$query = "SELECT id, id_doctor, id_department FROM doctors_departments";
	$result = mysqli_query($connect, $query);
	$i = 1;
	while($row = mysqli_fetch_assoc($result)){
		echo "<tr>";
		echo "<td>".($i++)."</td>";
		
		$query = '	SELECT 	categories.id, categories.name AS \'catname\', doctors.id, doctors.surname AS \'docsurename\',
							doctors.name AS \'docname\', doctors.lastname AS \'doclastname\'
					FROM categories, doctors
					WHERE doctors.id_category = categories.id AND doctors.id='.$row['id_doctor'];
        $doccat = mysqli_query($connect, $query);
        $d = mysqli_fetch_assoc($doccat);
        echo "<td>".$d['docsurename']." ".$d['docname']." ".$d['doclastname']." (".mb_strtolower($d['catname']).")"."</td>";

		$query = '	SELECT 	departments.id AS \'depid\', departments.id_specialization, departments.id_housing,
							specializations.id, specializations.name AS \'specname\',
							housings.id, housings.name AS \'housname\', housings.id_hospital, hospitals.id, hospitals.name AS \'hospname\'
					FROM departments, specializations, housings, hospitals
					WHERE (departments.id_specialization = specializations.id AND
							departments.id_housing = housings.id AND
							housings.id_hospital = hospitals.id AND
							departments.id='.$row['id_department'].')';
        $dep = mysqli_query($connect, $query);
        $d = mysqli_fetch_assoc($dep);
        echo "<td>".$d['specname']." - ".$d['housname']." (".$d['hospname'].")</td>";

        ?>
			<td>
			    <form action="<?=$_SERVER['PHP_SELF']?>?act=edit" method="POST">
			        <input type="hidden" name="id" value="<?=$row['id']?>">
			        <input type="hidden" name="id_doctor" value="<?=$row['id_doctor']?>">
			        <input type="hidden" name="id_department" value="<?=$row['id_department']?>">
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