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
								<h1 class="no-margin">Исследования лабораторий</h1>
								<p>Каждая лаборатория проводит исследования, которые фиксируются для дальнейшего рассчёта выработки лабораторий.</p>
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
	$query = "DELETE FROM surveys WHERE id=".$_POST['id'];
    $result = mysqli_query($connect, $query);
}
// добавление новой записи
if($_GET['todo'] == 'create'){
	$query = "	INSERT INTO surveys(name, id_lab, date_survey) 
	            VALUES ('".$_POST['name']."',
	            		'".$_POST['id_lab']."',
	            		'".$_POST['date_survey']."'
	            )";
	$result = mysqli_query($connect, $query);
}
// изменение записи в базе данных
if($_GET['todo'] == 'update'){
	$query = "	UPDATE surveys
	            SET name='".$_POST['name']."',
	            	id_lab='".$_POST['id_lab']."',
	            	date_survey='".$_POST['date_survey']."'
	            WHERE id=".$_POST['id'];
	$result = mysqli_query($connect, $query);
}
// новая запись (форма)
if($_GET['act'] == 'new'){

	$query = "SELECT id, name FROM labs";
	$labs = mysqli_query($connect, $query);

	?>
	<div class="col-md-6">
		<form action="<?=$_SERVER['PHP_SELF']?>?todo=create" method="POST">
			<div class="form-group">
				<label for="name">Название</label>
				<input type="text" name ="name" class="form-control" id="name" required>
			</div>

			<div class="form-group">
				<label for="name">Лаборатория</label>
				<select name="id_lab" class="form-control">
					<?php
					while($rowl = mysqli_fetch_assoc($labs)){
						echo "<option value=\"".$rowl['id']."\">".$rowl['name']."</option>";
					}
					?>
				</select>
			</div>

			<div class="form-group">
				<label for="date_survey">Дата исследования</label>
				<input type="date" name ="date_survey" class="form-control" id="date_survey" required>
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

	$query = "SELECT id, name FROM labs";
	$labs = mysqli_query($connect, $query);

	?>
	<div class="col-md-6">
		<form action="<?=$_SERVER['PHP_SELF']?>?todo=update" method="POST">
			<div class="form-group">
				<label for="name">Название</label>
				<input type="hidden" name="id" value="<?=$_POST['id']?>">
				<input type="text" name ="name" class="form-control" id="name" value="<?=$_POST['name']?>" required>

				<div class="form-group">
				<label for="name">Лаборатория</label>
				<select name="id_lab" class="form-control">
					<?php
					while($rowl = mysqli_fetch_assoc($labs)){
						if($_POST['id_lab'] == $rowl['id'])
							echo "<option value=\"".$rowl['id']."\" selected>".$rowl['name']."</option>";
						else
							echo "<option value=\"".$rowl['id']."\">".$rowl['name']."</option>";
					}
					?>
				</select>
			</div>

			<div class="form-group">
				<label for="date_survey">Дата исследования</label>
				<input type="date" name ="date_survey" value="<?=$_POST['date_survey']?>" class="form-control" id="date_survey" required>
			</div>

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
	  	<div class="col-md-1"><p style="text-align: right;">Новое иследование: </p></div>
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
		  	<th>название</th>
		  	<th>лаборатория</th>
		  	<th>дата исследования</th>
		  	<th>редактировать</th>
		  	<th>удалить</th>
		</tr>
	</thead>
	<tbody>

	<?php
	$query = "SELECT id, name, id_lab, date_survey FROM surveys";
	$result = mysqli_query($connect, $query);
	$i = 1;
	while($row = mysqli_fetch_assoc($result)){
		echo "<tr>";
		echo "<td>".($i++)."</td>";
		echo "<td>".$row['name']."</td>";

		$query = "SELECT id, name FROM labs WHERE id=".$row['id_lab'];
        $lab = mysqli_query($connect, $query);
        $l = mysqli_fetch_assoc($lab);
        echo "<td>".$l['name']."</td>";

        echo "<td>".$row['date_survey']."</td>";

        ?>
			<td>
			    <form action="<?=$_SERVER['PHP_SELF']?>?act=edit" method="POST">
			        <input type="hidden" name="id" value="<?=$row['id']?>">
			        <input type="hidden" name="name" value="<?=$row['name']?>">
			        <input type="hidden" name="id_lab" value="<?=$row['id_lab']?>">
			        <input type="hidden" name="date_survey" value="<?=$row['date_survey']?>">
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