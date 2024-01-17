<?php
session_start();

if(!isset($_SESSION['login'])){
	header('Location: ../auth.php');
	exit;
}

include "top.php";

?>

<header id="gtco-header" class="gtco-cover gtco-cover-xs gtco-inner" role="banner" style="height: 110rem; margin-bottom: 50px;">
	<div class="gtco-container">
		<div class="row">
			<div class="col-md-12 col-md-offset-0 text-left">
				<div class="display-t">
					<div class="display-tc">
						<div class="row">
							<div class="col-md-8 animate-box">
								<br><h1 class="no-margin">Запросы</h1><br>
								<ol>
									<li><a href="queries.php?query=1" style="color: white;">Получить перечень и общее число врачей указанного профиля для конкретного медицинского учреждения, больницы, либо поликлиники, либо всех медицинских учреждений города.</a></li>
									<li><a href="queries.php?query=2" style="color: white;">Получить перечень и общее число обслуживающего персонала указанной специальности для конкретного медицинского учреждения, больницы, либо поликлиники, либо всех медицинских учреждений города.</a></li>
									<li><a href="queries.php?query=3" style="color: white;">Получить перечень и общее число врачей указанного профиля, сделавших число операций не менее заданного для конкретного медицинского учреждения, больницы, либо поликлиники, либо всех медицинских учреждений города.</a></li>
									<li><a href="queries.php?query=4" style="color: white;">Получить перечень и общее число врачей указанного профиля, стаж работы которых не менее заданного для конкретного медицинского учреждения, больницы, либо поликлиники, либо всех медицинских учреждений города.</a></li>
									<li><a href="queries.php?query=5" style="color: white;">Получить перечень и общее число врачей указанного профиля со степенью кандидата или доктора медицинских наук, со званием доцента или профессора для конкретного медицинского учреждения, больницы, либо поликлиники, либо всех медицинских учреждений города.</a></li>
									<li><a href="queries.php?query=6" style="color: white;">Получить перечень пациентов указанной больницы, отделения, либо конкретной палаты указанного отделения, с указанием даты поступления, диагноза, лечащего врача.</a></li>
									<li><a href="queries.php?query=7" style="color: white;">Получить перечень пациентов, прошедших стационарное лечение в указанной больнице, либо у конкретного врача за некоторый промежуток времени.</a></li>
									<li><a href="queries.php?query=8" style="color: white;">Получить перечень пациентов, наблюдающихся у врача указанного профиля в конкретной поликлинике.</a></li>
									<li><a href="queries.php?query=9" style="color: white;">Получить общее число палат, коек указанной больницы в общем и по каждому отделению, а так же число свободных коек по каждому отделению.</a></li>
									<li><a href="queries.php?query=10" style="color: white;">Получить перечень и общее число кабинетов указанной поликлиники.</a></li>
									<li><a href="queries.php?query=11" style="color: white;">Получить данные о выработке (среднее число принятых пациентов в день) за указанный период для конкретного врача поликлиники.</a></li>
									<li><a href="queries.php?query=12" style="color: white;">Получить данные о загрузке (число пациентов, у которых врач в настоящее время является лечащим врачом) для указанного врача.</a></li>
									<li><a href="queries.php?query=13" style="color: white;">Получить перечень пациентов, перенёсших операции у конкретного врача.</a></li>
									<li><a href="queries.php?query=14" style="color: white;">Получить данные о выработке лаборатории (среднее число проведённых исследований в день) за указанный период.</a></li>
								</ol>
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



/*
	Получить перечень и общее число врачей указанного профиля для конкретного медицинского учреждения,
	больницы, либо поликлиники, либо всех медицинских учреждений города.
*/
if($_GET['query'] == '1'){

	$query = "SELECT id, name FROM categories";
	$categories = mysqli_query($connect, $query);

	$query = "SELECT id, name FROM hospitals";
	$hospitals = mysqli_query($connect, $query);

	echo "
	<div class=\"row\">
		<div class=\"col-md-6\">
			<form action=\"queries.php?query=1\" method=\"POST\">
					
				<div class=\"form-group\">
					<label for=\"name\">Категория врача</label>
					<select name=\"id_category\" class=\"form-control\">";
						echo "<option value=\"0\">- нет -</option>";
						while($rowc = mysqli_fetch_assoc($categories)){
							echo "<option value=\"".$rowc['id']."\">".$rowc['name']."</option>";
						}
					echo "
					</select>
				</div>

				<div class=\"form-group\">
					<label for=\"name\">Структурное подразделение</label>
					<select name=\"id_hospital\" class=\"form-control\">";
						echo "<option value=\"0\">- нет -</option>";
						while($rowh = mysqli_fetch_assoc($hospitals)){
							echo "<option value=\"".$rowh['id']."\">".$rowh['name']."</option>";
						}
					echo "
					</select>
				</div>
				
				<div class=\"form-group\">
					<input type=\"submit\" class=\"btn btn btn-special\" value=\"Построить запрос\">
				</div>
			</form>
		</div>
		<div class=\"col-md-5 col-md-push-1\">
			<div class=\"gtco-contact-info\">
				<h3>Запрос</h3>
				<p>
					Получить перечень и общее число врачей указанного профиля для конкретного медицинского учреждения,
					больницы, либо поликлиники, либо всех медицинских учреждений города.
				</p>
			</div>
		</div>
	</div><br>";

	$query = '	SELECT 	doctors.surname AS \'docsurname\',
						doctors.name AS \'docname\',
						doctors.lastname AS \'doclastname\',
						categories.name AS \'catname\',
						hospitals.name AS \'hospname\'

				FROM doctors, categories, doctors_departments, departments, housings, hospitals

				WHERE (	doctors.id_category = categories.id AND
						doctors.id = doctors_departments.id_doctor AND
						doctors_departments.id_department = departments.id AND
						departments.id_housing = housings.id AND
						housings.id_hospital = hospitals.id
				';

	if($_POST['id_hospital'] == '0' && $_POST['id_category'] !== '0'){
		$query .= '	AND
							categories.id = '.$_POST['id_category'].'
				)';
	}else if($_POST['id_category'] == '0' && $_POST['id_hospital'] !== '0'){
		$query .= ' AND
							hospitals.id = '.$_POST['id_hospital'].'
					)';
	}else if($_POST['id_hospital'] !== '0' && $_POST['id_category'] !== '0' && isset($_POST['id_hospital']) && isset($_POST['id_category'])){
		$query .= ' AND
							hospitals.id = '.$_POST['id_hospital'].' AND
							categories.id = '.$_POST['id_category'].'
					)';	
	}else{
		$query .= ')';
	}

	echo "<table class=\"table table-striped\" style=\"margin-bottom: 50px;\">";
	echo "
	<thead>
	<tr>
	  <th>№</th>
	  <th>фамилия</th>
	  <th>имя</th>
	  <th>отчество</th>
	  <th>категория</th>
	  <th>структурное подразделение</th>
	</tr>
	</thead>
	<tbody>";

	$result = mysqli_query($connect, $query);
	$i = 1;
	while($row = mysqli_fetch_assoc($result)){
		echo "<tr>";
		echo "<td>".($i++)."</td>";
		echo "<td>".$row['docsurname']."</td>";
		echo "<td>".$row['docname']."</td>";
		echo "<td>".$row['doclastname']."</td>";
		echo "<td>".$row['catname']."</td>";
		echo "<td>".$row['hospname']."</td>";
		echo "</tr>";
	}
	echo "</tbody>";
	echo "</table>";
}


/*
	Получить перечень и общее число обслуживающего персонала указанной специальности для конкретного медицинского учреждения,
	больницы, либо поликлиники, либо всех медицинских учреждений города.
*/
if($_GET['query'] == '2'){

	$query = "SELECT id, name FROM occupies";
	$occupies = mysqli_query($connect, $query);

	$query = "SELECT id, name FROM hospitals";
	$hospitals = mysqli_query($connect, $query);

	echo "
	<div class=\"row\">
		<div class=\"col-md-6\">
			<form action=\"queries.php?query=2\" method=\"POST\">
					
				<div class=\"form-group\">
					<label for=\"name\">Должность</label>
					<select name=\"id_occupy\" class=\"form-control\">";
						echo "<option value=\"0\">- нет -</option>";
						while($rowc = mysqli_fetch_assoc($occupies)){
							echo "<option value=\"".$rowc['id']."\">".$rowc['name']."</option>";
						}
					echo "
					</select>
				</div>

				<div class=\"form-group\">
					<label for=\"name\">Структурное подразделение</label>
					<select name=\"id_hospital\" class=\"form-control\">";
						echo "<option value=\"0\">- нет -</option>";
						while($rowh = mysqli_fetch_assoc($hospitals)){
							echo "<option value=\"".$rowh['id']."\">".$rowh['name']."</option>";
						}
					echo "
					</select>
				</div>
				
				<div class=\"form-group\">
					<input type=\"submit\" class=\"btn btn btn-special\" value=\"Построить запрос\">
				</div>
			</form>
		</div>
		<div class=\"col-md-5 col-md-push-1\">
			<div class=\"gtco-contact-info\">
				<h3>Запрос</h3>
				<p>
					Получить перечень и общее число обслуживающего персонала указанной специальности для конкретного медицинского учреждения,
					больницы, либо поликлиники, либо всех медицинских учреждений города.
				</p>
			</div>
		</div>
	</div><br>";

	$query = '	SELECT 	staff.surname AS \'stsurname\',
						staff.name AS \'stname\',
						staff.lastname AS \'stlastname\',
						occupies.name AS \'occname\',
						hospitals.name AS \'hospname\'

				FROM staff, occupies, departments, housings, hospitals

				WHERE (	staff.id_occupy = occupies.id AND
						staff.id_department =  departments.id AND
						departments.id_housing = housings.id AND
						housings.id_hospital = hospitals.id
				';

	if($_POST['id_hospital'] == '0' && $_POST['id_occupy'] !== '0'){
		$query .= '	AND
							occupies.id = '.$_POST['id_occupy'].'
				)';
	}else if($_POST['id_occupy'] == '0' && $_POST['id_hospital'] !== '0'){
		$query .= ' AND
							hospitals.id = '.$_POST['id_hospital'].'
					)';
	}else if($_POST['id_hospital'] !== '0' && $_POST['id_occupy'] !== '0' && isset($_POST['id_hospital']) && isset($_POST['id_occupy'])){
		$query .= ' AND
							hospitals.id = '.$_POST['id_hospital'].' AND
							occupies.id = '.$_POST['id_occupy'].'
					)';	
	}else{
		$query .= ')';
	}

	echo "<table class=\"table table-striped\" style=\"margin-bottom: 50px;\">";
	echo "
	<thead>
	<tr>
	  <th>№</th>
	  <th>фамилия</th>
	  <th>имя</th>
	  <th>отчество</th>
	  <th>должность</th>
	  <th>структурное подразделение</th>
	</tr>
	</thead>
	<tbody>";

	$result = mysqli_query($connect, $query);
	$i = 1;
	while($row = mysqli_fetch_assoc($result)){
		echo "<tr>";
		echo "<td>".($i++)."</td>";
		echo "<td>".$row['stsurname']."</td>";
		echo "<td>".$row['stname']."</td>";
		echo "<td>".$row['stlastname']."</td>";
		echo "<td>".$row['occname']."</td>";
		echo "<td>".$row['hospname']."</td>";
		echo "</tr>";
	}
	echo "</tbody>";
	echo "</table>";

}



/*
	Получить перечень и общее число врачей указанного профиля, сделавших число операций не менее заданного для конкретного медицинского учреждения,
	больницы, либо поликлиники, либо всех медицинских учреждений города.
*/
if($_GET['query'] == '3'){

	$query = "SELECT id, name FROM categories";
	$categories = mysqli_query($connect, $query);

	$query = "SELECT id, name FROM hospitals";
	$hospitals = mysqli_query($connect, $query);

	echo "
	<div class=\"row\">
		<div class=\"col-md-6\">
			<form action=\"queries.php?query=3\" method=\"POST\">
					
				<div class=\"form-group\">
					<label for=\"name\">Категория врача</label>
					<select name=\"id_category\" class=\"form-control\">";
						echo "<option value=\"0\">- нет -</option>";
						while($rowc = mysqli_fetch_assoc($categories)){
							echo "<option value=\"".$rowc['id']."\">".$rowc['name']."</option>";
						}
					echo "
					</select>
				</div>

				<div class=\"form-group\">
					<label for=\"name\">Структурное подразделение</label>
					<select name=\"id_hospital\" class=\"form-control\">";
						echo "<option value=\"0\">- нет -</option>";
						while($rowh = mysqli_fetch_assoc($hospitals)){
							echo "<option value=\"".$rowh['id']."\">".$rowh['name']."</option>";
						}
					echo "
					</select>
				</div>

				<div class=\"form-group\">
					<label for=\"operations\">Число операций</label>
					<input type=\"number\" step=\"1\" min=\"0\" name=\"operations\" class=\"form-control\">
				</div>
				
				<div class=\"form-group\">
					<input type=\"submit\" class=\"btn btn btn-special\" value=\"Построить запрос\">
				</div>
			</form>
		</div>
		<div class=\"col-md-5 col-md-push-1\">
			<div class=\"gtco-contact-info\">
				<h3>Запрос</h3>
				<p>
					Получить перечень и общее число врачей указанного профиля, сделавших число операций не менее заданного для конкретного медицинского учреждения,
					больницы, либо поликлиники, либо всех медицинских учреждений города.
				</p>
			</div>
		</div>
	</div><br>";

	$query = '	SELECT 	doctors.surname AS \'docsurname\',
						doctors.name AS \'docname\',
						doctors.lastname AS \'doclastname\',
						categories.name AS \'catname\',
						hospitals.name AS \'hospname\',
						doctors.id AS \'docid\'

				FROM doctors, categories, doctors_departments, departments, housings, hospitals

				WHERE (	doctors.id_category = categories.id AND
						doctors.id = doctors_departments.id_doctor AND
						doctors_departments.id_department = departments.id AND
						departments.id_housing = housings.id AND
						housings.id_hospital = hospitals.id
				';

	if($_POST['id_hospital'] == '0' && $_POST['id_category'] !== '0'){
		$query .= '	AND
							categories.id = '.$_POST['id_category'].'
				)';
	}else if($_POST['id_category'] == '0' && $_POST['id_hospital'] !== '0'){
		$query .= ' AND
							hospitals.id = '.$_POST['id_hospital'].'
					)';
	}else if($_POST['id_hospital'] !== '0' && $_POST['id_category'] !== '0' && isset($_POST['id_hospital']) && isset($_POST['id_category'])){
		$query .= ' AND
							hospitals.id = '.$_POST['id_hospital'].' AND
							categories.id = '.$_POST['id_category'].'
					)';	
	}else{
		$query .= ')';
	}

	echo "<table class=\"table table-striped\" style=\"margin-bottom: 50px;\">";
	echo "
	<thead>
	<tr>
	  <th>№</th>
	  <th>фамилия</th>
	  <th>имя</th>
	  <th>отчество</th>
	  <th>категория</th>
	  <th>структурное подразделение</th>
	  <th>количество операций</th>
	</tr>
	</thead>
	<tbody>";

	$result = mysqli_query($connect, $query);
	$i = 1;
	while($row = mysqli_fetch_assoc($result)){

		$query = '	SELECT 	COUNT(id)
					FROM operations
					WHERE id_doctor = '.$row['docid'];
        $op = mysqli_query($connect, $query);
        $o = mysqli_fetch_assoc($op);
        
        if($o['COUNT(id)'] >= $_POST['operations']){
			echo "<tr>";
			echo "<td>".($i++)."</td>";
			echo "<td>".$row['docsurname']."</td>";
			echo "<td>".$row['docname']."</td>";
			echo "<td>".$row['doclastname']."</td>";
			echo "<td>".$row['catname']."</td>";
			echo "<td>".$row['hospname']."</td>";
			echo "<td>".$o['COUNT(id)']."</td>";
			echo "</tr>";
		}
	}
	echo "</tbody>";
	echo "</table>";

}



/*
	Получить перечень и общее число врачей указанного профиля, стаж работы которых не менее заданного для конкретного медицинского учреждения,
	больницы, либо поликлиники, либо всех медицинских учреждений города.
*/
if($_GET['query'] == '4'){

	$query = "SELECT id, name FROM categories";
	$categories = mysqli_query($connect, $query);

	$query = "SELECT id, name FROM hospitals";
	$hospitals = mysqli_query($connect, $query);

	echo "
	<div class=\"row\">
		<div class=\"col-md-6\">
			<form action=\"queries.php?query=4\" method=\"POST\">
					
				<div class=\"form-group\">
					<label for=\"name\">Категория врача</label>
					<select name=\"id_category\" class=\"form-control\">";
						echo "<option value=\"0\">- нет -</option>";
						while($rowc = mysqli_fetch_assoc($categories)){
							echo "<option value=\"".$rowc['id']."\">".$rowc['name']."</option>";
						}
					echo "
					</select>
				</div>

				<div class=\"form-group\">
					<label for=\"name\">Структурное подразделение</label>
					<select name=\"id_hospital\" class=\"form-control\">";
						echo "<option value=\"0\">- нет -</option>";
						while($rowh = mysqli_fetch_assoc($hospitals)){
							echo "<option value=\"".$rowh['id']."\">".$rowh['name']."</option>";
						}
					echo "
					</select>
				</div>

				<div class=\"form-group\">
					<label for=\"operations\">Стаж (лет)</label>
					<input type=\"number\" step=\"1\" min=\"0\" name=\"experience\" class=\"form-control\">
				</div>
				
				<div class=\"form-group\">
					<input type=\"submit\" class=\"btn btn btn-special\" value=\"Построить запрос\">
				</div>
			</form>
		</div>
		<div class=\"col-md-5 col-md-push-1\">
			<div class=\"gtco-contact-info\">
				<h3>Запрос</h3>
				<p>
					Получить перечень и общее число врачей указанного профиля, стаж работы которых не менее заданного для конкретного медицинского учреждения,
					больницы, либо поликлиники, либо всех медицинских учреждений города.
				</p>
			</div>
		</div>
	</div><br>";

	$query = '	SELECT 	doctors.surname AS \'docsurname\',
						doctors.name AS \'docname\',
						doctors.lastname AS \'doclastname\',
						categories.name AS \'catname\',
						hospitals.name AS \'hospname\',
						doctors.id AS \'docid\'

				FROM doctors, categories, doctors_departments, departments, housings, hospitals

				WHERE (	doctors.id_category = categories.id AND
						doctors.id = doctors_departments.id_doctor AND
						doctors_departments.id_department = departments.id AND
						departments.id_housing = housings.id AND
						housings.id_hospital = hospitals.id
				';

	if($_POST['id_hospital'] == '0' && $_POST['id_category'] !== '0'){
		$query .= '	AND
							categories.id = '.$_POST['id_category'].'
				)';
	}else if($_POST['id_category'] == '0' && $_POST['id_hospital'] !== '0'){
		$query .= ' AND
							hospitals.id = '.$_POST['id_hospital'].'
					)';
	}else if($_POST['id_hospital'] !== '0' && $_POST['id_category'] !== '0' && isset($_POST['id_hospital']) && isset($_POST['id_category'])){
		$query .= ' AND
							hospitals.id = '.$_POST['id_hospital'].' AND
							categories.id = '.$_POST['id_category'].'
					)';	
	}else{
		$query .= ')';
	}

	echo "<table class=\"table table-striped\" style=\"margin-bottom: 50px;\">";
	echo "
	<thead>
	<tr>
	  <th>№</th>
	  <th>фамилия</th>
	  <th>имя</th>
	  <th>отчество</th>
	  <th>категория</th>
	  <th>структурное подразделение</th>
	  <th>стаж работы (лет)</th>
	</tr>
	</thead>
	<tbody>";

	$result = mysqli_query($connect, $query);
	$i = 1;
	while($row = mysqli_fetch_assoc($result)){

		$query = '	SELECT 	IF(MONTH(CURDATE())=MONTH(hiring_date) AND DAY(CURDATE())>=DAY(hiring_date), YEAR(CURDATE())-YEAR(hiring_date),  YEAR(CURDATE())-YEAR(hiring_date)-1 ) AS \'experience\'
					FROM doctors
					WHERE id = '.$row['docid'];
        $op = mysqli_query($connect, $query);
        $o = mysqli_fetch_assoc($op);
        
        if($o['experience'] >= $_POST['experience']){
			echo "<tr>";
			echo "<td>".($i++)."</td>";
			echo "<td>".$row['docsurname']."</td>";
			echo "<td>".$row['docname']."</td>";
			echo "<td>".$row['doclastname']."</td>";
			echo "<td>".$row['catname']."</td>";
			echo "<td>".$row['hospname']."</td>";
			if($o['experience'] < 1)
				echo "<td>0</td>";
			else
				echo "<td>".$o['experience']."</td>";
			echo "</tr>";
		}
	}
	echo "</tbody>";
	echo "</table>";

}



/*
	Получить перечень и общее число врачей указанного профиля со степенью кандидата или доктора медицинских наук, со званием доцента или профессора
	для конкретного медицинского учреждения,
	больницы, либо поликлиники, либо всех медицинских учреждений города.
*/
if($_GET['query'] == '5'){

	$query = "SELECT id, name FROM categories";
	$categories = mysqli_query($connect, $query);

	$query = "SELECT id, name FROM hospitals";
	$hospitals = mysqli_query($connect, $query);

	$query = "SELECT id, name FROM academic_degrees";
	$academic_degrees = mysqli_query($connect, $query);

	$query = "SELECT id, name FROM ranks";
	$ranks = mysqli_query($connect, $query);


	echo "
	<div class=\"row\">
		<div class=\"col-md-6\">
			<form action=\"queries.php?query=5\" method=\"POST\">
					
				<div class=\"form-group\">
					<label for=\"name\">Категория врача</label>
					<select name=\"id_category\" class=\"form-control\">";
						echo "<option value=\"0\">- нет -</option>";
						while($rowc = mysqli_fetch_assoc($categories)){
							echo "<option value=\"".$rowc['id']."\">".$rowc['name']."</option>";
						}
					echo "
					</select>
				</div>

				<div class=\"form-group\">
					<label for=\"name\">Структурное подразделение</label>
					<select name=\"id_hospital\" class=\"form-control\">";
						echo "<option value=\"0\">- нет -</option>";
						while($rowh = mysqli_fetch_assoc($hospitals)){
							echo "<option value=\"".$rowh['id']."\">".$rowh['name']."</option>";
						}
					echo "
					</select>
				</div>

				<div class=\"form-group\">
					<label for=\"name\">Учёная степень</label>
					<select name=\"id_degree\" class=\"form-control\">";
						echo "<option value=\"0\">- нет -</option>";
						while($rowh = mysqli_fetch_assoc($academic_degrees)){
							echo "<option value=\"".$rowh['id']."\">".$rowh['name']."</option>";
						}
					echo "
					</select>
				</div>

				<div class=\"form-group\">
					<label for=\"name\">Звание</label>
					<select name=\"id_rank\" class=\"form-control\">";
						echo "<option value=\"0\">- нет -</option>";
						while($rowh = mysqli_fetch_assoc($ranks)){
							echo "<option value=\"".$rowh['id']."\">".$rowh['name']."</option>";
						}
					echo "
					</select>
				</div>
				
				<div class=\"form-group\">
					<input type=\"submit\" class=\"btn btn btn-special\" value=\"Построить запрос\">
				</div>
			</form>
		</div>
		<div class=\"col-md-5 col-md-push-1\">
			<div class=\"gtco-contact-info\">
				<h3>Запрос</h3>
				<p>
					Получить перечень и общее число врачей указанного профиля со степенью кандидата или доктора медицинских наук, со званием доцента или профессора для
					конкретного медицинского учреждения, больницы, либо поликлиники, либо всех медицинских учреждений города.
				</p>
			</div>
		</div>
	</div><br>";

	$query = '	SELECT 	doctors.surname AS \'docsurname\',
						doctors.name AS \'docname\',
						doctors.lastname AS \'doclastname\',
						categories.name AS \'catname\',
						hospitals.name AS \'hospname\',
						doctors.id AS \'docid\',
						academic_degrees.name AS \'acdegree\',
						ranks.name AS \'rankname\',
						ranks.id AS \'rankid\',
						academic_degrees.id AS \'degreeid\'


				FROM doctors, categories, academic_degrees, ranks, doctors_departments, departments, housings, hospitals

				WHERE (	doctors.id_category = categories.id AND
						doctors.id_degree = academic_degrees.id AND
						doctors.id_rank = ranks.id AND
						doctors.id = doctors_departments.id_doctor AND
						doctors_departments.id_department = departments.id AND
						departments.id_housing = housings.id AND
						housings.id_hospital = hospitals.id
				';

	if($_POST['id_hospital'] == '0' && $_POST['id_category'] !== '0'){
		$query .= '	AND
							categories.id = '.$_POST['id_category'].'
				)';
	}else if($_POST['id_category'] == '0' && $_POST['id_hospital'] !== '0'){
		$query .= ' AND
							hospitals.id = '.$_POST['id_hospital'].'
					)';
	}else if($_POST['id_hospital'] !== '0' && $_POST['id_category'] !== '0' && isset($_POST['id_hospital']) && isset($_POST['id_category'])){
		$query .= ' AND
							hospitals.id = '.$_POST['id_hospital'].' AND
							categories.id = '.$_POST['id_category'].'
					)';	
	}else{
		$query .= ')';
	}

	echo "<table class=\"table table-striped\" style=\"margin-bottom: 50px;\">";
	echo "
	<thead>
	<tr>
	  <th>№</th>
	  <th>фамилия</th>
	  <th>имя</th>
	  <th>отчество</th>
	  <th>категория</th>
	  <th>учёная степень</th>
	  <th>звание</th>
	  <th>структурное подразделение</th>
	</tr>
	</thead>
	<tbody>";

	$result = mysqli_query($connect, $query);
	$i = 1;
	while($row = mysqli_fetch_assoc($result)){

		
		if($_POST['id_degree'] == '0' && $_POST['id_rank'] !== '0'){
			if($_POST['id_rank'] == $row['rankid']){
				echo "<tr>";
				echo "<td>".($i++)."</td>";
				echo "<td>".$row['docsurname']."</td>";
				echo "<td>".$row['docname']."</td>";
				echo "<td>".$row['doclastname']."</td>";
				echo "<td>".$row['catname']."</td>";
				echo "<td>".$row['acdegree']."</td>";
				echo "<td>".$row['rankname']."</td>";
				echo "<td>".$row['hospname']."</td>";
				echo "</tr>";
			}
		}else if($_POST['id_rank'] == '0' && $_POST['id_degree'] !== '0'){
			if($_POST['id_degree'] == $row['degreeid']){
				echo "<tr>";
				echo "<td>".($i++)."</td>";
				echo "<td>".$row['docsurname']."</td>";
				echo "<td>".$row['docname']."</td>";
				echo "<td>".$row['doclastname']."</td>";
				echo "<td>".$row['catname']."</td>";
				echo "<td>".$row['acdegree']."</td>";
				echo "<td>".$row['rankname']."</td>";
				echo "<td>".$row['hospname']."</td>";
				echo "</tr>";
			}
		}else if($_POST['id_rank'] !== '0' && $_POST['id_degree'] !== '0' && isset($_POST['id_rank']) && isset($_POST['id_degree'])){
			if($_POST['id_degree'] == $row['degreeid'] && $_POST['id_rank'] == $row['rankid']){
				echo "<tr>";
				echo "<td>".($i++)."</td>";
				echo "<td>".$row['docsurname']."</td>";
				echo "<td>".$row['docname']."</td>";
				echo "<td>".$row['doclastname']."</td>";
				echo "<td>".$row['catname']."</td>";
				echo "<td>".$row['acdegree']."</td>";
				echo "<td>".$row['rankname']."</td>";
				echo "<td>".$row['hospname']."</td>";
				echo "</tr>";
			}
		}else{
			echo "<tr>";
			echo "<td>".($i++)."</td>";
			echo "<td>".$row['docsurname']."</td>";
			echo "<td>".$row['docname']."</td>";
			echo "<td>".$row['doclastname']."</td>";
			echo "<td>".$row['catname']."</td>";
			echo "<td>".$row['acdegree']."</td>";
			echo "<td>".$row['rankname']."</td>";
			echo "<td>".$row['hospname']."</td>";
			echo "</tr>";
		}
	}
	echo "</tbody>";
	echo "</table>";

}



/*
	Получить перечень пациентов указанной больницы, отделения, либо конкретной палаты указанного отделения,
	с указанием даты поступления, диагноза, лечащего врача.
*/
if($_GET['query'] == '6'){


	$query = "SELECT id, name FROM hospitals";
	$hospitals = mysqli_query($connect, $query);

	$query = '	SELECT departments.id AS \'depid\', specializations.name AS \'specname\'
				FROM departments, specializations
				WHERE departments.id_specialization = specializations.id';
	$departments = mysqli_query($connect, $query);

	$query = '	SELECT chambers.id AS \'chamberid\', chambers.numb AS \'chambernumb\'
				FROM chambers, departments, housings, hospitals
				WHERE (
					chambers.id_department = departments.id AND
					departments.id_housing = housings.id AND
					housings.id_hospital = hospitals.id AND
					hospitals.hospital = 1
				)';
	$chambers = mysqli_query($connect, $query);


	echo "
	<div class=\"row\">
		<div class=\"col-md-6\">
			<form action=\"queries.php?query=6\" method=\"POST\">

				<div class=\"form-group\">
					<label for=\"name\">Структурное подразделение</label>
					<select name=\"id_hospital\" class=\"form-control\">";
						echo "<option value=\"0\">- нет -</option>";
						while($rowh = mysqli_fetch_assoc($hospitals)){
							echo "<option value=\"".$rowh['id']."\">".$rowh['name']."</option>";
						}
					echo "
					</select>
				</div>

				<div class=\"form-group\">
					<label for=\"name\">Отделение</label>
					<select name=\"id_department\" class=\"form-control\">";
						echo "<option value=\"0\">- нет -</option>";
						while($rowh = mysqli_fetch_assoc($departments)){
							echo "<option value=\"".$rowh['depid']."\">".$rowh['specname']."</option>";
						}
					echo "
					</select>
				</div>

				<div class=\"form-group\">
					<label for=\"name\">Палата</label>
					<select name=\"id_chamber\" class=\"form-control\">";
						echo "<option value=\"0\">- нет -</option>";
						while($rowh = mysqli_fetch_assoc($chambers)){
							echo "<option value=\"".$rowh['chamberid']."\">".$rowh['chambernumb']."</option>";
						}
					echo "
					</select>
				</div>
				
				<div class=\"form-group\">
					<input type=\"submit\" class=\"btn btn btn-special\" value=\"Построить запрос\">
				</div>
			</form>
		</div>
		<div class=\"col-md-5 col-md-push-1\">
			<div class=\"gtco-contact-info\">
				<h3>Запрос</h3>
				<p>
					Получить перечень пациентов указанной больницы, отделения, либо конкретной палаты указанного отделения,
					с указанием даты поступления, диагноза, лечащего врача.
				</p>
			</div>
		</div>
	</div><br>";

	$query = '	SELECT 	patients.surname AS \'pacsurname\',
						patients.name AS \'pacname\',
						patients.lastname AS \'paclastname\',
						patients.id AS \'pacid\',
						chambers.id AS \'chambid\',
						chambers.numb AS \'chnumb\',
						hospitals.name AS \'hospname\',
						specializations.name AS \'specname\',
						cots.occupied_from AS \'arrival\'

				FROM patients, cots, chambers, departments, specializations, housings, hospitals

				WHERE (	patients.id = cots.id_patient AND
						cots.id_chamber = chambers.id AND
						chambers.id_department = departments.id AND
						departments.id_specialization = specializations.id AND
						departments.id_housing = housings.id AND
						housings.id_hospital = hospitals.id AND
						cots.id_patient <> 1
				';

	if($_POST['id_hospital'] == '0' && $_POST['id_department'] !== '0'){
		$query .= '	AND
							departments.id = '.$_POST['id_department'].'
				)
				GROUP BY patients.id';
	}else if($_POST['id_department'] == '0' && $_POST['id_hospital'] !== '0'){
		$query .= ' AND
							hospitals.id = '.$_POST['id_hospital'].'
					)
					GROUP BY patients.id';
	}else if($_POST['id_hospital'] !== '0' && $_POST['id_department'] !== '0' && isset($_POST['id_hospital']) && isset($_POST['id_department'])){
		$query .= ' AND
							hospitals.id = '.$_POST['id_hospital'].' AND
							departments.id = '.$_POST['id_department'].'
					)
					GROUP BY patients.id';	
	}else{
		$query .= ')
					GROUP BY patients.id';
	}

	echo "<table class=\"table table-striped\" style=\"margin-bottom: 50px;\">";
	echo "
	<thead>
	<tr>
	  <th>№</th>
	  <th>фамилия</th>
	  <th>имя</th>
	  <th>отчество</th>
	  <th>диагноз</th>
	  <th>врач</th>
	  <th>дата поступления</th>
	  <th>палата</th>
	  <th>отделение</th>
	  <th>структурное подразделение</th>
	</tr>
	</thead>
	<tbody>";

	$result = mysqli_query($connect, $query);
	$i = 1;
	while($row = mysqli_fetch_assoc($result)){

		$query = '	SELECT 	diagnosis, id_doctor
					FROM histories
					WHERE id_pacient = '.$row['pacid'].'
					';
        $dia = mysqli_query($connect, $query);
        while($d = mysqli_fetch_assoc($dia)){
        	$diagnosis = $d['diagnosis'];
        	$id_doctor = $d['id_doctor'];
        }

        $query = '	SELECT 	surname, doctors.name AS \'docname\', lastname, categories.name AS \'catname\'
					FROM doctors, categories
					WHERE doctors.id_category = categories.id AND
					doctors.id = '.$id_doctor;
        $doc = mysqli_query($connect, $query);
        $d = mysqli_fetch_assoc($doc);
		
		if($_POST['id_chamber'] == '0' || !isset($_POST['id_chamber'])){
				echo "<tr>";
				echo "<td>".($i++)."</td>";
				echo "<td>".$row['pacsurname']."</td>";
				echo "<td>".$row['pacname']."</td>";
				echo "<td>".$row['paclastname']."</td>";
				echo "<td>".$diagnosis."</td>";
				echo "<td>".$d['surname']." ".$d['docname']." ".$d['lastname']." - ".$d['catname']."</td>";
				echo "<td>".$row['arrival']."</td>";
				echo "<td>".$row['chnumb']."</td>";
				echo "<td>".$row['specname']."</td>";
				echo "<td>".$row['hospname']."</td>";
				echo "</tr>";
		}else{
			if($_POST['id_chamber'] == $row['chambid']){
				echo "<tr>";
				echo "<td>".($i++)."</td>";
				echo "<td>".$row['pacsurname']."</td>";
				echo "<td>".$row['pacname']."</td>";
				echo "<td>".$row['paclastname']."</td>";
				echo "<td>".$diagnosis."</td>";
				echo "<td>".$d['surname']." ".$d['docname']." ".$d['lastname']." - ".$d['catname']."</td>";
				echo "<td>".$row['arrival']."</td>";
				echo "<td>".$row['chnumb']."</td>";
				echo "<td>".$row['specname']."</td>";
				echo "<td>".$row['hospname']."</td>";
				echo "</tr>";
			}
		}
	}
	echo "</tbody>";
	echo "</table>";

}



/*
	Получить перечень пациентов, прошедших стационарное лечение в указанной больнице, либо у конкретного врача за некоторый промежуток времени.
*/
if($_GET['query'] == '7'){


	$query = "SELECT id, name FROM hospitals";
	$hospitals = mysqli_query($connect, $query);

	$query = '	SELECT 	doctors.id AS \'docid\', surname, doctors.name AS \'docname\', lastname, categories.name AS \'catname\'
					FROM doctors, categories
					WHERE doctors.id_category = categories.id';
    $doctors = mysqli_query($connect, $query);


	echo "
	<div class=\"row\">
		<div class=\"col-md-6\">
			<form action=\"queries.php?query=7\" method=\"POST\">
				<input type=\"hidden\" name=\"flag\" value=\"1\">
				<div class=\"form-group\">
					<label for=\"name\">Структурное подразделение</label>
					<select name=\"id_hospital\" class=\"form-control\">";
						echo "<option value=\"0\">- нет -</option>";
						while($rowh = mysqli_fetch_assoc($hospitals)){
							echo "<option value=\"".$rowh['id']."\">".$rowh['name']."</option>";
						}
					echo "
					</select>
				</div>

				<div class=\"form-group\">
					<label for=\"name\">Врач</label>
					<select name=\"id_doctor\" class=\"form-control\">";
						echo "<option value=\"0\">- нет -</option>";
						while($rowh = mysqli_fetch_assoc($doctors)){
							echo "<option value=\"".$rowh['docid']."\">".$rowh['surname']." ".$rowh['docname']." ".$rowh['lastname']." - ".$rowh['catname']."</option>";
						}
					echo "
					</select>
				</div>

				<div class=\"form-group\">
					<label for=\"date_start\">Дата начала</label>
					<input type=\"date\" name =\"date_start\" class=\"form-control\" id=\"date_start\">
				</div>

				<div class=\"form-group\">
					<label for=\"date_end\">Дата окончания</label>
					<input type=\"date\" name =\"date_end\" class=\"form-control\" id=\"date_end\">
				</div>
				
				<div class=\"form-group\">
					<input type=\"submit\" class=\"btn btn btn-special\" value=\"Построить запрос\">
				</div>
			</form>
		</div>
		<div class=\"col-md-5 col-md-push-1\">
			<div class=\"gtco-contact-info\">
				<h3>Запрос</h3>
				<p>
					Получить перечень пациентов, прошедших стационарное лечение в указанной больнице, либо у конкретного врача за некоторый промежуток времени.
				</p>
			</div>
		</div>
	</div><br>";

	$query = '	SELECT 	patients.surname AS \'pacsurname\',
						patients.name AS \'pacname\',
						patients.lastname AS \'paclastname\',
						hospitals.name AS \'hospname\',
						histories.id_doctor AS \'docid\'

				FROM 	patients, departments, housings, hospitals, histories, doctors

				WHERE (	patients.id_department = departments.id AND
						departments.id_housing = housings.id AND
						housings.id_hospital = hospitals.id AND
						histories.id_pacient = patients.id AND
						histories.id_doctor = doctors.id AND
						hospitals.hospital = 1
				';
/*
	$query = '	SELECT 	patients.surname AS \'pacsurname\',
						patients.name AS \'pacname\',
						patients.lastname AS \'paclastname\',
						hospitals.name AS \'hospname\',
						histories.id_doctor AS \'docid\',
						doctors.surname AS \'docsurname\',
						doctors.name AS \'docname\',
						doctors.lastname AS \'doclastname\',
						date_in, date_out

				FROM histories, patients, departments, housings, hospitals, doctors

				WHERE (	patients.id_department = departments.id AND
						departments.id_housing = housings.id AND
						housings.id_hospital = hospitals.id AND
						histories.id_pacient = patients.id AND
						histories.id_doctor = doctors.id AND 
						hospitals.hospital = 1
				';
*/
	if($_POST['id_hospital'] == '0' && $_POST['id_doctor'] !== '0'){
		//echo "<h1>".$_POST['id_doctor']."</h1>";
		$query .= '	AND
							doctors.id = '.$_POST['id_doctor'].'
				)	';
	}else if($_POST['id_doctor'] == '0' && $_POST['id_hospital'] !== '0'){
		$query .= ' AND
							hospitals.id = '.$_POST['id_hospital'].'
					)';
	}else if($_POST['id_hospital'] !== '0' && $_POST['id_doctor'] !== '0' && isset($_POST['id_hospital']) && isset($_POST['id_doctor'])){
		$query .= ' AND
							hospitals.id = '.$_POST['id_hospital'].' AND
							doctors.id = '.$_POST['id_doctor'].'
					)';	
	}else{
		$query .= ')';
	}

//echo "<h1>".$query."</h1>";

	echo "<table class=\"table table-striped\" style=\"margin-bottom: 50px;\">";
	echo "
	<thead>
	<tr>
	  <th>№</th>
	  <th>фамилия</th>
	  <th>имя</th>
	  <th>отчество</th>
	  <th>дата постановки на учёт</th>
	  <th>дата снятия с учёта</th>
	  <th>врач</th>
	  <th>структурное подразделение</th>
	</tr>
	</thead>
	<tbody>";

	$result = mysqli_query($connect, $query);
	$i = 1;
	while($row = mysqli_fetch_assoc($result)){

		$query = '	SELECT 	surname, doctors.name AS \'docname\', lastname, categories.name AS \'catname\',
							date_in, date_out
					FROM doctors, categories, histories
					WHERE 	(doctors.id_category = categories.id AND
							histories.id_doctor = doctors.id AND
							doctors.id = '.$row['docid'].')';
        $doc = mysqli_query($connect, $query);
        $d = mysqli_fetch_assoc($doc);

		if($_POST['date_start'] !== "0000-00-00" && $_POST['date_end'] !== "0000-00-00" && !empty($_POST['date_start']) && !empty($_POST['date_end'])){

				$query = '	SELECT 	id, IF(\''.$_POST['date_start'].'\'<=DATE_FORMAT(\''.$d['date_in'].'\',\'%Y-%m-$d\') AND 
											DATE_FORMAT(\''.$d['date_out'].'\',\'%Y-%m-$d\')<=\''.$_POST['date_end'].'\', 1, 0) AS \'res\'
							FROM histories
							WHERE id = 5';
				//echo "<h1>".$query."</h1>";
		        $rez = mysqli_query($connect, $query);
		        $r = mysqli_fetch_assoc($rez);

		        if($r['res'] == '1'){
					echo "<tr>";
					echo "<td>".($i++)."</td>";
					echo "<td>".$row['pacsurname']."</td>";
					echo "<td>".$row['pacname']."</td>";
					echo "<td>".$row['paclastname']."</td>";
					echo "<td>".$d['date_in']."</td>";
					echo "<td>".$d['date_out']."</td>";
					echo "<td>".$d['surname']." ".$d['docname']." ".$d['lastname']." - ".$d['catname']."</td>";
					echo "<td>".$row['hospname']."</td>";
					echo "</tr>";
				}
		}else {
			echo "<tr>";
			echo "<td>".($i++)."</td>";
			echo "<td>".$row['pacsurname']."</td>";
			echo "<td>".$row['pacname']."</td>";
			echo "<td>".$row['paclastname']."</td>";
			echo "<td>".$d['date_in']."</td>";
			echo "<td>".$d['date_out']."</td>";
			echo "<td>".$d['surname']." ".$d['docname']." ".$d['lastname']." - ".$d['catname']."</td>";
			echo "<td>".$row['hospname']."</td>";
			echo "</tr>";
		}
	}
	echo "</tbody>";
	echo "</table>";

}




/*
	Получить перечень пациентов, наблюдающихся у врача указанного профиля в конкретной поликлинике.
*/
if($_GET['query'] == '8'){

	$query = "SELECT id, name FROM hospitals WHERE hospital=0";
	$hospitals = mysqli_query($connect, $query);

	$query = '	SELECT id, name FROM categories';
	$categories = mysqli_query($connect, $query);

	echo "
	<div class=\"row\">
		<div class=\"col-md-6\">
			<form action=\"queries.php?query=8\" method=\"POST\">

				<div class=\"form-group\">
					<label for=\"name\">Структурное подразделение</label>
					<select name=\"id_hospital\" class=\"form-control\">";
						echo "<option value=\"0\">- нет -</option>";
						while($rowh = mysqli_fetch_assoc($hospitals)){
							echo "<option value=\"".$rowh['id']."\">".$rowh['name']."</option>";
						}
					echo "
					</select>
				</div>

				<div class=\"form-group\">
					<label for=\"name\">Категория врача</label>
					<select name=\"id_category\" class=\"form-control\">";
						echo "<option value=\"0\">- нет -</option>";
						while($rowh = mysqli_fetch_assoc($categories)){
							echo "<option value=\"".$rowh['id']."\">".$rowh['name']."</option>";
						}
					echo "
					</select>
				</div>

				<div class=\"form-group\">
					<input type=\"submit\" class=\"btn btn btn-special\" value=\"Построить запрос\">
				</div>
			</form>
		</div>
		<div class=\"col-md-5 col-md-push-1\">
			<div class=\"gtco-contact-info\">
				<h3>Запрос</h3>
				<p>
					Получить перечень пациентов, наблюдающихся у врача указанного профиля в конкретной поликлинике.
				</p>
			</div>
		</div>
	</div><br>";

	$query = '	SELECT 	patients.surname AS \'pacsurname\',
						patients.name AS \'pacname\',
						patients.lastname AS \'paclastname\',
						hospitals.name AS \'hospname\',
						categories.name AS \'catname\',
						doctors.surname AS \'docsurname\',
						doctors.name AS \'docname\',
						doctors.lastname AS \'doclastname\'	

				FROM patients, departments, housings, hospitals, histories, doctors, categories

				WHERE (	patients.id_department = departments.id AND
						departments.id_housing = housings.id AND
						housings.id_hospital = hospitals.id AND
						histories.id_pacient = patients.id AND
						histories.id_doctor = doctors.id AND
						doctors.id_category = categories.id AND
						hospitals.hospital = 0
				';

	if($_POST['id_hospital'] == '0' && $_POST['id_category'] !== '0'){
		$query .= '	AND
							categories.id = '.$_POST['id_category'].'
				)
				GROUP BY patients.id';
	}else if($_POST['id_category'] == '0' && $_POST['id_hospital'] !== '0'){
		$query .= ' AND
							hospitals.id = '.$_POST['id_hospital'].'
					)
					GROUP BY patients.id';
	}else if($_POST['id_hospital'] !== '0' && $_POST['id_category'] !== '0' && isset($_POST['id_hospital']) && isset($_POST['id_category'])){
		$query .= ' AND
							hospitals.id = '.$_POST['id_hospital'].' AND
							categories.id = '.$_POST['id_category'].'
					)
					GROUP BY patients.id';	
	}else{
		$query .= ')
					GROUP BY patients.id';
	}

	echo "<table class=\"table table-striped\" style=\"margin-bottom: 50px;\">";
	echo "
	<thead>
	<tr>
	  <th>№</th>
	  <th>фамилия</th>
	  <th>имя</th>
	  <th>отчество</th>
	  <th>врач</th>
	  <th>структурное подразделение</th>
	</tr>
	</thead>
	<tbody>";

	$result = mysqli_query($connect, $query);
	$i = 1;
	while($row = mysqli_fetch_assoc($result)){
		echo "<tr>";
		echo "<td>".($i++)."</td>";
		echo "<td>".$row['pacsurname']."</td>";
		echo "<td>".$row['pacname']."</td>";
		echo "<td>".$row['paclastname']."</td>";
		echo "<td>".$row['docsurname']." ".$row['docname']." ".$row['doclastname']." - ".$row['catname']."</td>";
		echo "<td>".$row['hospname']."</td>";
		echo "</tr>";
	}
	echo "</tbody>";
	echo "</table>";

}




/*
	Получить общее число палат, коек указанной больницы в общем и по каждому отделению, а так же число свободных коек по каждому отделению.
*/
if($_GET['query'] == '9'){


	$query = "SELECT id, name FROM hospitals WHERE hospital=1";
	$hospitals = mysqli_query($connect, $query);

	echo "
	<div class=\"row\">
		<div class=\"col-md-6\">
			<form action=\"queries.php?query=9\" method=\"POST\">

				<div class=\"form-group\">
					<label for=\"name\">Структурное подразделение</label>
					<select name=\"id_hospital\" class=\"form-control\">";
						echo "<option value=\"0\">- нет -</option>";
						while($rowh = mysqli_fetch_assoc($hospitals)){
							echo "<option value=\"".$rowh['id']."\">".$rowh['name']."</option>";
						}
					echo "
					</select>
				</div>
				
				<div class=\"form-group\">
					<input type=\"submit\" class=\"btn btn btn-special\" value=\"Построить запрос\">
				</div>
			</form>
		</div>
		<div class=\"col-md-5 col-md-push-1\">
			<div class=\"gtco-contact-info\">
				<h3>Запрос</h3>
				<p>
					Получить общее число палат, коек указанной больницы в общем и по каждому отделению, а так же число свободных коек по каждому отделению.
				</p>
			</div>
		</div>
	</div><br>";

	$query = '	SELECT 	specializations.name AS \'specname\', specializations.id AS \'specid\', departments.id AS \'depid\'
				FROM  hospitals, departments, housings, specializations
				WHERE (	housings.id_hospital = hospitals.id AND
						departments.id_housing = housings.id AND
						departments.id_specialization = specializations.id AND
						hospitals.hospital = 1
				';

	if($_POST['id_hospital'] !== '0' && isset($_POST['id_hospital'])){
		$query .= ' AND
							hospitals.id = '.$_POST['id_hospital'].'
					)';
	}else{
		$query .= ')';
	}

	echo "<table class=\"table table-striped\" style=\"margin-bottom: 50px;\">";
	echo "
	<thead>
	<tr>
	  <th>№</th>
	  <th>Отделение</th>
	  <th>Число палат</th>
	  <th>Число коек</th>
	  <th>Свободных коек</th>
	</tr>
	</thead>
	<tbody>";

	$result = mysqli_query($connect, $query);
	$i = 1;
	while($row = mysqli_fetch_assoc($result)){

        $query = '	SELECT 	COUNT(chambers.id) AS \'countchambers\'
					FROM chambers, departments
					WHERE chambers.id_department = departments.id AND departments.id = '.$row['depid'];
        $countchambers = mysqli_query($connect, $query);
        $cch = mysqli_fetch_assoc($countchambers);

        $query = '	SELECT 	COUNT(cots.id) AS \'countcots\'
					FROM cots, chambers, departments
					WHERE cots.id_chamber = chambers.id AND chambers.id_department = departments.id AND departments.id = '.$row['depid'];
        $countcots = mysqli_query($connect, $query);
        $cco = mysqli_fetch_assoc($countcots);

        $query = '	SELECT 	COUNT(cots.id) AS \'countcots\'
					FROM cots, chambers, departments
					WHERE (CURDATE()>cots.occupied_to OR cots.occupied_to=\'0000-00-00\') AND cots.id_chamber = chambers.id AND chambers.id_department = departments.id AND departments.id = '.$row['depid'];
        $countcots = mysqli_query($connect, $query);
        $ccofree = mysqli_fetch_assoc($countcots);
		
		
		echo "<tr>";
		echo "<td>".($i++)."</td>";
		echo "<td>".$row['specname']."</td>";
		echo "<td>".$cch['countchambers']."</td>";
		
		echo "<td>".$cco['countcots']."</td>";
		echo "<td>".$ccofree['countcots']."</td>";
		echo "</tr>";
		
	}
	echo "</tbody>";
	echo "</table>";

}




/*
	Получить перечень и общее число кабинетов указанной поликлиники.
*/
if($_GET['query'] == '10'){


	$query = "SELECT id, name FROM hospitals WHERE hospital=0";
	$hospitals = mysqli_query($connect, $query);

	echo "
	<div class=\"row\">
		<div class=\"col-md-6\">
			<form action=\"queries.php?query=10\" method=\"POST\">

				<div class=\"form-group\">
					<label for=\"name\">Структурное подразделение</label>
					<select name=\"id_hospital\" class=\"form-control\">";
						echo "<option value=\"0\">- нет -</option>";
						while($rowh = mysqli_fetch_assoc($hospitals)){
							echo "<option value=\"".$rowh['id']."\">".$rowh['name']."</option>";
						}
					echo "
					</select>
				</div>
				
				<div class=\"form-group\">
					<input type=\"submit\" class=\"btn btn btn-special\" value=\"Построить запрос\">
				</div>
			</form>
		</div>
		<div class=\"col-md-5 col-md-push-1\">
			<div class=\"gtco-contact-info\">
				<h3>Запрос</h3>
				<p>
					Получить перечень и общее число кабинетов указанной поликлиники.
				</p>
			</div>
		</div>
	</div><br>";

	$query = '	SELECT 	specializations.name AS \'specname\', specializations.id AS \'specid\', departments.id AS \'depid\'
				FROM  hospitals, departments, housings, specializations
				WHERE (	housings.id_hospital = hospitals.id AND
						departments.id_housing = housings.id AND
						departments.id_specialization = specializations.id AND
						hospitals.hospital = 0
				';

	if($_POST['id_hospital'] !== '0' && isset($_POST['id_hospital'])){
		$query .= ' AND
							hospitals.id = '.$_POST['id_hospital'].'
					)';
	}else{
		$query .= ')';
	}

	echo "<table class=\"table table-striped\" style=\"margin-bottom: 50px;\">";
	echo "
	<thead>
	<tr>
	  <th>№</th>
	  <th>кабинет</th>
	  <th>отделение</th> 
	</tr>
	</thead>
	<tbody>";

	$result = mysqli_query($connect, $query);
	$i = 1;
	while($row = mysqli_fetch_assoc($result)){
		
		$query = '	SELECT numb
					FROM chambers, departments
					WHERE chambers.id_department = departments.id AND departments.id = '.$row['depid'];
        $numb = mysqli_query($connect, $query);
        $n = mysqli_fetch_assoc($numb);

		echo "<tr>";
		echo "<td>".($i++)."</td>";
		echo "<td>".$n['numb']."</td>";
		echo "<td>".$row['specname']."</td>";
		echo "</tr>";
		
	}
	echo "</tbody>";
	echo "</table>";

}




/*
	Получить данные о выработке (среднее число принятых пациентов в день) за указанный период для конкретного врача.
*/
if($_GET['query'] == '11'){

	$query = '	SELECT 	doctors.id AS \'docid\', surname, doctors.name AS \'docname\', lastname, categories.name AS \'catname\'
				FROM doctors, categories, departments, housings, hospitals, doctors_departments
				WHERE 	doctors.id_category = categories.id AND
						doctors_departments.id_department = departments.id AND
						doctors_departments.id_doctor = doctors.id AND
						departments.id_housing = housings.id AND
						housings.id_hospital = hospitals.id AND
						hospitals.hospital = 0';
    $doctors = mysqli_query($connect, $query);


	echo "
	<div class=\"row\">
		<div class=\"col-md-6\">
			<form action=\"queries.php?query=11\" method=\"POST\">
				<input type=\"hidden\" name=\"flag\" value=\"1\">

				<div class=\"form-group\">
					<label for=\"name\">Врач</label>
					<select name=\"id_doctor\" class=\"form-control\">";
						echo "<option value=\"0\">- нет -</option>";
						while($rowh = mysqli_fetch_assoc($doctors)){
							echo "<option value=\"".$rowh['docid']."\">".$rowh['surname']." ".$rowh['docname']." ".$rowh['lastname']." - ".$rowh['catname']."</option>";
						}
					echo "
					</select>
				</div>

				<div class=\"form-group\">
					<label for=\"date_start\">Дата начала</label>
					<input type=\"date\" name =\"date_start\" class=\"form-control\" id=\"date_start\">
				</div>

				<div class=\"form-group\">
					<label for=\"date_end\">Дата окончания</label>
					<input type=\"date\" name =\"date_end\" class=\"form-control\" id=\"date_end\">
				</div>
				
				<div class=\"form-group\">
					<input type=\"submit\" class=\"btn btn btn-special\" value=\"Построить запрос\">
				</div>
			</form>
		</div>
		<div class=\"col-md-5 col-md-push-1\">
			<div class=\"gtco-contact-info\">
				<h3>Запрос</h3>
				<p>
					Получить данные о выработке (среднее число принятых пациентов в день) за указанный период для конкретного врача поликлиники.
				</p>
			</div>
		</div>
	</div><br>";
/*
	$query = '	SELECT 	doctors.id AS \'docid\', doctors.surname AS \'docsurname\', doctors.name AS \'docname\', doctors.lastname AS \'doclastname\'

				FROM 	departments, housings, hospitals, doctors, doctors_departments

				WHERE (	doctors_departments.id_department = departments.id AND
						doctors_departments.id_doctor = doctors.id AND
						departments.id_housing = housings.id AND
						housings.id_hospital = hospitals.id AND
						hospitals.hospital = 0
				';
*/
	if($_POST['id_doctor'] !== '0' && isset($_POST['id_doctor'])){
		$querym = '	SELECT 	doctors.id AS \'docid\', doctors.surname AS \'docsurname\', doctors.name AS \'docname\', doctors.lastname AS \'doclastname\'

				FROM 	departments, housings, hospitals, doctors, doctors_departments

				WHERE (	doctors_departments.id_department = departments.id AND
						doctors_departments.id_doctor = doctors.id AND
						departments.id_housing = housings.id AND
						housings.id_hospital = hospitals.id AND
						hospitals.hospital = 0 AND
						doctors.id = '.$_POST['id_doctor'].'
					)';
	}

//echo "<h1>".$query."</h1>";

	if(isset($querym)){
		if($_POST['date_start'] !== "0000-00-00" && $_POST['date_end'] !== "0000-00-00" && !empty($_POST['date_start']) && !empty($_POST['date_end'])){
			echo "<table class=\"table table-striped\" style=\"margin-bottom: 50px;\">";
			echo "
			<thead>
			<tr>
			  <th>№</th>
			  <th>фамилия</th>
			  <th>имя</th>
			  <th>отчество</th>
			  <th>дней</th>
			  <th>принято</th>
			  <th>выработка</th>
			</tr>
			</thead>
			<tbody>";

			$result = mysqli_query($connect, $querym);
			$i = 1;
			while($row = mysqli_fetch_assoc($result)){

				$query = '	SELECT 	surname, doctors.name AS \'docname\', lastname, categories.name AS \'catname\',
									date_in, date_out
							FROM doctors, categories, histories
							WHERE 	(doctors.id_category = categories.id AND
									histories.id_doctor = doctors.id AND
									doctors.id = '.$row['docid'].')';
		        $doc = mysqli_query($connect, $query);
		        $d = mysqli_fetch_assoc($doc);

		        $query = '	SELECT 	(TO_DAYS(\''.$_POST['date_end'].'\') - TO_DAYS(\''.$_POST['date_start'].'\')) AS \'days\'
							FROM 	doctors
							WHERE 	id = '.$row['docid'];
		        $dayss = mysqli_query($connect, $query);
		        $days = mysqli_fetch_assoc($dayss);

				$query = '	SELECT 	SUM(IF(\''.$_POST['date_start'].'\'<=DATE_FORMAT(\''.$d['date_in'].'\',\'%Y-%m-$d\') AND 
											DATE_FORMAT(\''.$d['date_in'].'\',\'%Y-%m-$d\')<=\''.$_POST['date_end'].'\', 1, 0)) AS \'res\'
							FROM 	histories, doctors
							WHERE 	histories.id_doctor = doctors.id AND
									doctors.id = '.$row['docid'];
				//echo "<h1>".$query."</h1>";
		        $rez = mysqli_query($connect, $query);
		        $r = mysqli_fetch_assoc($rez);

				echo "<tr>";
				echo "<td>".($i++)."</td>";
				echo "<td>".$row['docsurname']."</td>";
				echo "<td>".$row['docname']."</td>";
				echo "<td>".$row['doclastname']."</td>";
				echo "<td>".$days['days']."</td>";
				echo "<td>".$r['res']."</td>";
				echo "<td>".($r['res']/$days['days'])."</td>";
				echo "</tr>";
			}
			echo "</tbody>";
			echo "</table>";
		} else{
			echo "<br><br><h1>Выберите диапазон дат</h1>";
		}
	} else{
		echo "<br><br><h1>Выберите врача</h1>";
	}
}



/*
	Получить данные о загрузке (число пациентов, у которых врач в настоящее время является лечащим врачом) для указанного врача.
*/
if($_GET['query'] == '12'){

	$query = '	SELECT 	doctors.id AS \'docid\', surname, doctors.name AS \'docname\', lastname, categories.name AS \'catname\'
				FROM doctors, categories, departments, housings, hospitals, doctors_departments
				WHERE 	doctors.id_category = categories.id AND
						doctors_departments.id_department = departments.id AND
						doctors_departments.id_doctor = doctors.id AND
						departments.id_housing = housings.id AND
						housings.id_hospital = hospitals.id AND
						hospitals.hospital = 1';
    $doctors = mysqli_query($connect, $query);


	echo "
	<div class=\"row\">
		<div class=\"col-md-6\">
			<form action=\"queries.php?query=12\" method=\"POST\">
				<input type=\"hidden\" name=\"flag\" value=\"1\">

				<div class=\"form-group\">
					<label for=\"name\">Врач</label>
					<select name=\"id_doctor\" class=\"form-control\">";
						echo "<option value=\"0\">- нет -</option>";
						while($rowh = mysqli_fetch_assoc($doctors)){
							echo "<option value=\"".$rowh['docid']."\">".$rowh['surname']." ".$rowh['docname']." ".$rowh['lastname']." - ".$rowh['catname']."</option>";
						}
					echo "
					</select>
				</div>
				
				<div class=\"form-group\">
					<input type=\"submit\" class=\"btn btn btn-special\" value=\"Построить запрос\">
				</div>
			</form>
		</div>
		<div class=\"col-md-5 col-md-push-1\">
			<div class=\"gtco-contact-info\">
				<h3>Запрос</h3>
				<p>
					Получить данные о загрузке (число пациентов, у которых врач в настоящее время является лечащим врачом) для указанного врача.
				</p>
			</div>
		</div>
	</div><br>";

	if($_POST['id_doctor'] !== '0' && isset($_POST['id_doctor'])){

		$querym = '	SELECT 	id, surname, name, lastname

					FROM 	doctors

					WHERE	id = '.$_POST['id_doctor'];
	}

	if(isset($querym)){
		echo "<table class=\"table table-striped\" style=\"margin-bottom: 50px;\">";
		echo "
		<thead>
		<tr>
		  <th>№</th>
		  <th>фамилия</th>
		  <th>имя</th>
		  <th>отчество</th>
		  <th>загрузка</th>
		</tr>
		</thead>
		<tbody>";

		$result = mysqli_query($connect, $querym);
		$i = 1;
		while($row = mysqli_fetch_assoc($result)){

			

			$query = '	SELECT 	IF(CURDATE()>=DATE_FORMAT(date_in,\'%Y-%m-$d\') AND 
										DATE_FORMAT(date_out,\'%Y-%m-$d\')>=CURDATE(), 1, 0) AS \'res\'
						FROM 	histories, doctors
						WHERE 	histories.id_doctor = doctors.id AND
								doctors.id = '.$row['id'];
			//echo "<h1>".$query."</h1>";
	        $rez = mysqli_query($connect, $query);
	        $rr = 0;
	        while($r = mysqli_fetch_assoc($rez)){
	        	if($r['res'] == 1)
	        		$rr++;
	        }
	        

			echo "<tr>";
			echo "<td>".($i++)."</td>";
			echo "<td>".$row['surname']."</td>";
			echo "<td>".$row['name']."</td>";
			echo "<td>".$row['lastname']."</td>";
			echo "<td>".$rr."</td>";
			echo "</tr>";
		}
		echo "</tbody>";
		echo "</table>";
	} else{
		echo "<br><br><h1>Выберите врача</h1>";
	}
}

/*
	Получить перечень пациентов, перенёсших операции у конкретного врача.
*/
if($_GET['query'] == '13'){

	$query = '	SELECT 	doctors.id AS \'docid\', surname, doctors.name AS \'docname\', lastname, categories.name AS \'catname\'
				FROM doctors, categories, departments, housings, hospitals, doctors_departments
				WHERE 	doctors.id_category = categories.id AND
						doctors_departments.id_department = departments.id AND
						doctors_departments.id_doctor = doctors.id AND
						departments.id_housing = housings.id AND
						housings.id_hospital = hospitals.id';
    $doctors = mysqli_query($connect, $query);


	echo "
	<div class=\"row\">
		<div class=\"col-md-6\">
			<form action=\"queries.php?query=13\" method=\"POST\">
				<input type=\"hidden\" name=\"flag\" value=\"1\">

				<div class=\"form-group\">
					<label for=\"name\">Врач</label>
					<select name=\"id_doctor\" class=\"form-control\">";
						echo "<option value=\"0\">- нет -</option>";
						while($rowh = mysqli_fetch_assoc($doctors)){
							echo "<option value=\"".$rowh['docid']."\">".$rowh['surname']." ".$rowh['docname']." ".$rowh['lastname']." - ".$rowh['catname']."</option>";
						}
					echo "
					</select>
				</div>
				
				<div class=\"form-group\">
					<input type=\"submit\" class=\"btn btn btn-special\" value=\"Построить запрос\">
				</div>
			</form>
		</div>
		<div class=\"col-md-5 col-md-push-1\">
			<div class=\"gtco-contact-info\">
				<h3>Запрос</h3>
				<p>
					Получить перечень пациентов, перенёсших операции у конкретного врача.
				</p>
			</div>
		</div>
	</div><br>";

	if($_POST['id_doctor'] !== '0' && isset($_POST['id_doctor'])){

		$querym = '	SELECT 	id, surname, name, lastname

					FROM 	operations

					WHERE	id_doctor = '.$_POST['id_doctor'];
	}

	if(isset($querym)){
		echo "<table class=\"table table-striped\" style=\"margin-bottom: 50px;\">";
		echo "
		<thead>
		<tr>
		  <th>№</th>
		  <th>фамилия</th>
		  <th>имя</th>
		  <th>отчество</th>
		</tr>
		</thead>
		<tbody>";

		$result = mysqli_query($connect, $querym);
		$i = 1;
		while($row = mysqli_fetch_assoc($result)){

			echo "<tr>";
			echo "<td>".($i++)."</td>";
			echo "<td>".$row['surname']."</td>";
			echo "<td>".$row['name']."</td>";
			echo "<td>".$row['lastname']."</td>";
			echo "</tr>";
		}
		echo "</tbody>";
		echo "</table>";
	} else{
		echo "<br><br><h1>Выберите врача</h1>";
	}
}


/*
	Получить данные о выработке лаборатории (среднее число проведённых исследований в день) за указанный период.
*/
if($_GET['query'] == '14'){

	$query = '	SELECT 	id, name
				FROM 	labs';
    $labs = mysqli_query($connect, $query);


	echo "
	<div class=\"row\">
		<div class=\"col-md-6\">
			<form action=\"queries.php?query=14\" method=\"POST\">
				<input type=\"hidden\" name=\"flag\" value=\"1\">

				<div class=\"form-group\">
					<label for=\"name\">Лаборатория</label>
					<select name=\"id_lab\" class=\"form-control\">";
						echo "<option value=\"0\">- нет -</option>";
						while($rowh = mysqli_fetch_assoc($labs)){
							echo "<option value=\"".$rowh['id']."\">".$rowh['name']."</option>";
						}
					echo "
					</select>
				</div>

				<div class=\"form-group\">
					<label for=\"date_start\">Дата начала</label>
					<input type=\"date\" name =\"date_start\" class=\"form-control\" id=\"date_start\">
				</div>

				<div class=\"form-group\">
					<label for=\"date_end\">Дата окончания</label>
					<input type=\"date\" name =\"date_end\" class=\"form-control\" id=\"date_end\">
				</div>
				
				<div class=\"form-group\">
					<input type=\"submit\" class=\"btn btn btn-special\" value=\"Построить запрос\">
				</div>
			</form>
		</div>
		<div class=\"col-md-5 col-md-push-1\">
			<div class=\"gtco-contact-info\">
				<h3>Запрос</h3>
				<p>
					Получить данные о выработке лаборатории (среднее число проведённых исследований в день) за указанный период.
				</p>
			</div>
		</div>
	</div><br>";
/*
	$query = '	SELECT 	doctors.id AS \'docid\', doctors.surname AS \'docsurname\', doctors.name AS \'docname\', doctors.lastname AS \'doclastname\'

				FROM 	departments, housings, hospitals, doctors, doctors_departments

				WHERE (	doctors_departments.id_department = departments.id AND
						doctors_departments.id_doctor = doctors.id AND
						departments.id_housing = housings.id AND
						housings.id_hospital = hospitals.id AND
						hospitals.hospital = 0
				';
*/
	if($_POST['id_lab'] !== '0' && isset($_POST['id_lab'])){
		$querym = '	SELECT 	labs.id AS \'labid\', labs.name AS \'labname\'
					FROM 	labs, surveys
					WHERE (	surveys.id_lab = labs.id AND
							labs.id = '.$_POST['id_lab'].'
						)';
	}

//echo "<h1>".$query."</h1>";

	if(isset($querym)){
		if($_POST['date_start'] !== "0000-00-00" && $_POST['date_end'] !== "0000-00-00" && !empty($_POST['date_start']) && !empty($_POST['date_end'])){
			echo "<table class=\"table table-striped\" style=\"margin-bottom: 50px;\">";
			echo "
			<thead>
			<tr>
			  <th>№</th>
			  <th>лаборатория</th>
			  <th>дней</th>
			  <th>исследований</th>
			  <th>выработка</th>
			</tr>
			</thead>
			<tbody>";

			$result = mysqli_query($connect, $querym);
			$i = 1;
			while($row = mysqli_fetch_assoc($result)){

		        $query = '	SELECT 	(TO_DAYS(\''.$_POST['date_end'].'\') - TO_DAYS(\''.$_POST['date_start'].'\')) AS \'days\'
							FROM 	labs
							WHERE 	id = '.$row['labid'];
		        $dayss = mysqli_query($connect, $query);
		        $days = mysqli_fetch_assoc($dayss);

				$query = '	SELECT 	SUM(IF(\''.$_POST['date_start'].'\'<=date_survey AND 
											date_survey<=\''.$_POST['date_end'].'\', 1, 0)) AS \'res\'
							FROM 	labs, surveys
							WHERE 	surveys.id_lab = labs.id AND
									labs.id = '.$row['labid'];
				//echo "<h1>".$query."</h1>";
		        $rez = mysqli_query($connect, $query);
		        $r = mysqli_fetch_assoc($rez);

				echo "<tr>";
				echo "<td>".($i++)."</td>";
				echo "<td>".$row['labname']."</td>";
				echo "<td>".$days['days']."</td>";
				echo "<td>".$r['res']."</td>";
				echo "<td>".($r['res']/$days['days'])."</td>";
				echo "</tr>";
			}
			echo "</tbody>";
			echo "</table>";
		} else{
			echo "<br><br><h1>Выберите диапазон дат</h1>";
		}
	} else{
		echo "<br><br><h1>Выберите лабораторию</h1>";
	}
}



include "footor.php";

?>