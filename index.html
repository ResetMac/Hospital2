<?php

session_start();

if(isset($_POST['login'])){
	if(!isset($_SESSION['login'])){
		include "php/db-connect.php";

		$query = "SELECT id, login, password, email FROM users";
		$result = mysqli_query($connect, $query);
		$row = mysqli_fetch_assoc($result);

		if($row['login'] == $_POST['login'] && $row['password'] == $_POST['password']){
			$_SESSION['login'] = $_POST['login'];
		} else{
			header('Location: ../auth.php?autherror=true');
			exit;
		}
	}
}

if(isset($_GET['status'])){
	session_destroy();
}


?>


<!DOCTYPE HTML>

<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>hosp.pro</title>
	<!--
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Free HTML5 Website Template by FreeHTML5.co" />
	<meta name="keywords" content="free website templates, free html5, free template, free bootstrap, free website template, html5, css3, mobile first, responsive" />
	<meta name="author" content="FreeHTML5.co" />
	-->
	
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

	<link rel="shortcut icon" href="favicon.ico" type="image/png">

	<link href="https://fonts.googleapis.com/css?family=Raleway:100,300,400,700" rel="stylesheet">
	
	<!-- Animate.css -->
	<link rel="stylesheet" href="css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="css/icomoon.css">
	<!-- Themify Icons-->
	<link rel="stylesheet" href="css/themify-icons.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="css/bootstrap.css">

	<!-- Magnific Popup -->
	<link rel="stylesheet" href="css/magnific-popup.css">

	<!-- Owl Carousel  -->
	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/owl.theme.default.min.css">

	<!-- Theme style  -->
	<link rel="stylesheet" href="css/style.css">

	<!-- Modernizr JS -->
	<script src="js/modernizr-2.6.2.min.js"></script>
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
						<div id="gtco-logo"><a href="index.php"><img src="images/logo.png" alt="logo"></a></div>
					</div>
					<div class="col-xs-10 text-right menu-1">
						<ul>
							<li><a href="index.php">Главная</a></li>
							<!--<li><a href="about.html">About</a></li>-->
							<li class="has-dropdown">
								<a href="#">Сотрудники</a>
								<ul class="dropdown">
									<li><a href="php/doctors.php">Врачи</a></li>
									<li><a href="php/operations.php">Операции врачей</a></li>
									<li><a href="php/staff.php">Персонал</a></li>
									<li><a href="php/academic_degrees.php">Учёные степени</a></li>
									<li><a href="php/ranks.php">Звания</a></li>
									<li><a href="php/categories.php">Категории врачей</a></li>
									<li><a href="php/features.php">Отличительные особенности категорий</a></li>
									<li><a href="php/features_of_categories.php">Особенности категорий</a></li>
									<li><a href="php/occupies.php">Должности</a></li>
									<li><a href="php/doctors_departments.php">Врачи-отделения</a></li>
								</ul>
							</li>
							<li class="has-dropdown">
								<a href="#">Пациенты</a>
								<ul class="dropdown">
									<li><a href="php/patients.php">Пациенты</a></li>
									<li><a href="php/histories.php">Истории болезней</a></li>
								</ul>
							</li>
							<li class="has-dropdown">
								<a href="#">Структурные подразделения</a>
								<ul class="dropdown">
									<li><a href="php/hospitals.php">Больницы / поликлиники</a></li>
									<li><a href="php/labs.php">Лаборатории</a></li>
									<li><a href="php/surveys.php">Обследования лабораторий</a></li>
									<li><a href="php/sections.php">Профили лабораторий</a></li>
									<li><a href="php/housings.php">Корпуса</a></li>
									<li><a href="php/departments.php">Отделения корпусов</a></li>
									<li><a href="php/specializations.php">Специализации отделений</a></li>
									<li><a href="php/chambers.php">Палаты/кабинеты отделений</a></li>
									<li><a href="php/cots.php">Койки палат</a></li>
								</ul>
							</li>
							<li><a href="php/queries.php">Запросы</a></li>
							<?php 
							if(isset($_SESSION['login'])){ 
								if(!isset($_GET['status'])){
									echo "<li><a href=\"index.php?status=out\">Выход (".$_SESSION['login'].")</a></li>";
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

		<header id="gtco-header" class="gtco-cover" role="banner">
			<div class="gtco-container">
				<div class="row">
					<div class="col-md-12 col-md-offset-0 text-left">
						<div class="display-t">
							<div class="display-tc">
								<div class="row">
									<div class="col-md-5 text-center header-img animate-box">
										<img src="images/cube.png" alt="Free HTML5 Website Template by FreeHTML5.co">
									</div>
									<div class="col-md-7 copy animate-box">
										<h1>Упростите работу с базой</h1>
										<p>Данная система позволяет вести учёт сотрудников, отделений, лабораторий, а так же пациентов медицинских учреждений города.</p>
										
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</header>
		<!-- END #gtco-header -->

		<div class="gtco-services gtco-section">
			<div class="gtco-container">
				<div class="row row-pb-sm">
					<div class="col-md-8 col-md-offset-2 gtco-heading text-center">
						<h2>Краткое руководство</h2>
						<p>Здесь описаны краткие пояснения по работе с информационной системой.</p>
						
					</div>
				</div>
				<div class="row row-pb-md">
					<div class="col-md-4 col-sm-4 service-wrap">
						<div class="service">
							<h3><i class="ti-pie-chart"></i> Авторизация</h3>
							<p>Для предотвращения несанкционированного доступа к данным информационной системы, была ввеена обязательная авторизация. Поэтому для получения доступа к разделам системы необходимо пройти авторизацию.</p>
						</div>
					</div>
					<div class="col-md-4 col-sm-4 service-wrap">
						<div class="service animate-change">
							<h3><i class="ti-ruler-pencil"></i> Функционал</h3>
							<p>Данная информационная система позволяет пользователю вести работу по учёту множества объектов, перечень которых можно найти в навигационном меню. Возможны следующие операции с элементами объектов базы данных: добавление нового элемента, редактирование, а так же удаление существующих элементов.</p>
						</div>
					</div>
					<div class="col-md-4 col-sm-4 service-wrap">
						<div class="service">
							<h3><i class="ti-settings"></i> Запросы</h3>
							<p>Отдельной частью информационной системы является организация динамичных пользовательских запросов к таблицам базы данных медицинских учреждений города. Для получения более подробной информации, перейдите непосредственно к указанному разделу.</p>
						</div>
					</div>

					<div class="clearfix visible-md-block visible-sm-block"></div>

				</div>
			</div>
		</div>
		<!-- END .gtco-services -->

		<footer id="gtco-footer" class="gtco-section" role="contentinfo">
			<div class="gtco-copyright">
				<div class="gtco-container">
					<div class="row">
						<div class="col-md-6 text-left">
							<p><small>&copy; 2018 </small></p>
						</div>
						<div class="col-md-6 text-right">
							<p><small>Designed by <a href="http://freehtml5.co/" target="_blank">...</a> Demo Images: <a href="http://pixeden.com/" target="_blank">Pixeden</a> &amp; <a href="http://unsplash.com" target="_blank">Unsplash</a></small> </p>
						</div>
					</div>
				</div>
			</div>
		</footer>

	</div>

	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
	</div>
	
	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="js/jquery.waypoints.min.js"></script>
	<!-- Carousel -->
	<script src="js/owl.carousel.min.js"></script>
	<!-- Magnific Popup -->
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/magnific-popup-options.js"></script>
	<!-- Main -->
	<script src="js/main.js"></script>

	</body>
</html>