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
								<h1 class="no-margin">Категории</h1>
								<p>Каждый врач принадлежит к определённой категории, определяющей направление его специализации.</p>
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
	$query = "DELETE FROM categories WHERE id=".$_POST['id'];
    $result = mysqli_query($connect, $query);
}
// добавление новой записи
if($_GET['todo'] == 'create'){
	$query = "	INSERT INTO categories(name) 
	            VALUES ('".$_POST['name']."'
	            )";
	$result = mysqli_query($connect, $query);
}
// изменение записи в базе данных
if($_GET['todo'] == 'update'){
	$query = "	UPDATE categories
	            SET   name='".$_POST['name']."'
	            WHERE id=".$_POST['id'];
	$result = mysqli_query($connect, $query);
}
// новая запись (форма)
if($_GET['act'] == 'new'){
	?>
	<div class="col-md-6">
		<form action="<?=$_SERVER['PHP_SELF']?>?todo=create" method="POST">
			<div class="form-group">
				<label for="name">Категория</label>
				<input type="text" name ="name" class="form-control" id="name" required>
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
	?>
	<div class="col-md-6">
		<form action="<?=$_SERVER['PHP_SELF']?>?todo=update" method="POST">
			<div class="form-group">
				<label for="name">Категория</label>
				<input type="hidden" name="id" value="<?=$_POST['id']?>">
				<input type="text" name ="name" class="form-control" id="name" value="<?=$_POST['name']?>" required>
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
	  	<div class="col-md-1"><p style="text-align: right;">Новое звание: </p></div>
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
		  	<th>название</th>
		  	<th>редактировать</th>
		  	<th>удалить</th>
		</tr>
	</thead>
	<tbody>

	<?php
	$query = "SELECT id, name FROM categories";
	$result = mysqli_query($connect, $query);
	$i = 1;
	while($row = mysqli_fetch_assoc($result)){
		?>
		<tr>
			<td><?=($i++)?></td>
			<td><?=$row['name']?></td>
			<td>
		      	<form action="<?=$_SERVER['PHP_SELF']?>?act=edit" method="POST">
		        	<input type="hidden" name="id" value="<?=$row['id']?>">
		        	<input type="hidden" name="name" value="<?=$row['name']?>">
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