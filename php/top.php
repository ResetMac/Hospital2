<?php
session_start();
?>


<!DOCTYPE HTML>

<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>hosp.pro</title>
	
  	<!-- Facebook and Twitter integration -->
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<link rel="shortcut icon" href="../favicon.ico" type="image/png">

	<link href="https://fonts.googleapis.com/css?family=Raleway:100,300,400,700" rel="stylesheet">
	
	<!-- Animate.css -->
	<link rel="stylesheet" href="../css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="../css/icomoon.css">
	<!-- Themify Icons-->
	<link rel="stylesheet" href="../css/themify-icons.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/bootstrap.css">

	<!-- Magnific Popup -->
	<link rel="stylesheet" href="../css/magnific-popup.css">

	<!-- Owl Carousel  -->
	<link rel="stylesheet" href="../css/owl.carousel.min.css">
	<link rel="stylesheet" href="../css/owl.theme.default.min.css">

	<!-- Theme style  -->
	<link rel="stylesheet" href="../css/style.css">

	<!-- Modernizr JS -->
	<script src="../js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->

	</head>
	<body>
		
	<div class="gtco-loader"></div>
	
	<div id="page">

		<nav class="gtco-nav" role="navigation">
			<div class="gtco-container">
				<div class="row">
					<div class="col-sm-2 col-xs-12">
						<div id="gtco-logo"><a href="../index.php"><img src="../images/logo.png" alt="logo"></a></div>
					</div>
					<div class="col-xs-10 text-right menu-1">
						<ul>
							<li><a href="../index.php">Главная</a></li>
							<li class="has-dropdown">
								<a href="#">Сотрудники</a>
								<ul class="dropdown">
									<li><a href="doctors.php">Врачи</a></li>
									<li><a href="operations.php">Операции врачей</a></li>
									<li><a href="staff.php">Персонал</a></li>
									<li><a href="academic_degrees.php">Учёные степени</a></li>
									<li><a href="ranks.php">Звания</a></li>
									<li><a href="categories.php">Категории врачей</a></li>
									<li><a href="features.php">Отличительные особенности категорий</a></li>
									<li><a href="features_of_categories.php">Особенности категорий</a></li>
									<li><a href="occupies.php">Должности</a></li>
									<li><a href="doctors_departments.php">Врачи-отделения</a></li>
								</ul>
							</li>
							<li class="has-dropdown">
								<a href="#">Пациенты</a>
								<ul class="dropdown">
									<li><a href="patients.php">Пациенты</a></li>
									<li><a href="histories.php">Истории болезней</a></li>
								</ul>
							</li>
							<li class="has-dropdown">
								<a href="#">Структурные подразделения</a>
								<ul class="dropdown">
									<li><a href="hospitals.php">Больницы / поликлиники</a></li>
									<li><a href="labs.php">Лаборатории</a></li>
									<li><a href="surveys.php">Обследования лабораторий</a></li>
									<li><a href="sections.php">Профили лабораторий</a></li>
									<li><a href="housings.php">Корпуса</a></li>
									<li><a href="departments.php">Отделения корпусов</a></li>
									<li><a href="specializations.php">Специализации отделений</a></li>
									<li><a href="chambers.php">Палаты/кабинеты отделений</a></li>
									<li><a href="cots.php">Койки палат</a></li>
								</ul>
							</li>
							<li><a href="queries.php">Запросы</a></li>

							<?php 
							if(isset($_SESSION['login'])){ 
								if(!isset($_GET['status'])){
									echo "<li><a href=\"..\index.php?status=out\">Выход (".$_SESSION['login'].")</a></li>";
								} else{
									echo "<li><a href=\"auth.php\">Вход</a></li>";
								}
							}else
								echo "<li><a href=\"auth.php\">Вход</a></li>";	
							?>

						</ul>
					</div>
				</div>
			</div>
		</nav>
		<!-- END #gtco-header -->