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
								<h1 class="no-margin">Особенности категорий</h1>
								<p>Привязка особенностей к категориям с указанием степени значимости особенности.</p>
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
	$query = "DELETE FROM features_of_categories WHERE id=".$_POST['id'];
    $result = mysqli_query($connect, $query);
}
// добавление новой записи
if($_GET['todo'] == 'create'){
	$query = "	INSERT INTO features_of_categories(value, id_category, id_feature) 
	            VALUES ('".$_POST['value']."',
	            		'".$_POST['id_category']."',
	            		'".$_POST['id_feature']."'
	            )";
	$result = mysqli_query($connect, $query);
}
// изменение записи в базе данных
if($_GET['todo'] == 'update'){
	$query = "	UPDATE features_of_categories
	            SET   	value='".$_POST['value']."',
	            		id_category='".$_POST['id_category']."',
	            		id_feature='".$_POST['id_feature']."'
	            WHERE id=".$_POST['id'];
	$result = mysqli_query($connect, $query);
}
// новая запись (форма)
if($_GET['act'] == 'new'){

	$query = "SELECT id, name FROM categories";
	$categories = mysqli_query($connect, $query);

	$query = "SELECT id, name FROM features";
	$features = mysqli_query($connect, $query);

	?>
	<div class="col-md-6">
		<form action="<?=$_SERVER['PHP_SELF']?>?todo=create" method="POST">	
			<div class="form-group">
				<label for="name">Значение</label>
				<input type="number" step="0.1" min="0" name="value" class="form-control" required>
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
				<label for="name">Особенность</label>
				<select name="id_feature" class="form-control">
					<?php
					while($rowf = mysqli_fetch_assoc($features)){
						echo "<option value=\"".$rowf['id']."\">".$rowf['name']."</option>";
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

	$query = "SELECT id, name FROM categories";
	$categories = mysqli_query($connect, $query);

	$query = "SELECT id, name FROM features";
	$features = mysqli_query($connect, $query);

	?>
	<div class="col-md-6">
		<form action="<?=$_SERVER['PHP_SELF']?>?todo=update" method="POST">
		<input type="hidden" name="id" value="<?=$_POST['id']?>">
			<div class="form-group">
				<label for="name">Значение</label>
				<input type="number" step="0.1" min="0" name="value" class="form-control" value="<?=$_POST['value']?>" required>
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
				<label for="name">Особенность</label>
				<select name="id_feature" class="form-control">
					<?php
					while($rowf = mysqli_fetch_assoc($features)){
						if($_POST['id_feature'] == $rowf['id'])
							echo "<option value=\"".$rowf['id']."\" selected>".$rowf['name']."</option>";
						else
							echo "<option value=\"".$rowf['id']."\">".$rowf['name']."</option>";
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
	  	<div class="col-md-1"><p style="text-align: right;">Новая особенность категории: </p></div>
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
		  	<th>значение</th>
		  	<th>категория</th>
		  	<th>особенность</th>
		  	<th>редактировать</th>
		  	<th>удалить</th>
		</tr>
	</thead>
	<tbody>";

	<?php
	$query = "SELECT id, value, id_category, id_feature FROM features_of_categories";
	$result = mysqli_query($connect, $query);
	$i = 1;
	while($row = mysqli_fetch_assoc($result)){
		echo "<tr>";
		echo "<td>".($i++)."</td>";
		echo "<td>".$row['value']."</td>";

		$query = "SELECT id, name FROM categories WHERE id=".$row['id_category'];
        $cat = mysqli_query($connect, $query);
        $c = mysqli_fetch_assoc($cat);
        echo "<td>".$c['name']."</td>";

        $query = "SELECT id, name FROM features WHERE id=".$row['id_feature'];
        $fea = mysqli_query($connect, $query);
        $f = mysqli_fetch_assoc($fea);
        echo "<td>".$f['name']."</td>";

        ?>
			<td>
			    <form action="<?=$_SERVER['PHP_SELF']?>?act=edit" method="POST">
			        <input type="hidden" name="id" value="<?=$row['id']?>">
			        <input type="hidden" name="value" value="<?=$row['value']?>">
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