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
							<li class="active"><a href="index.php">Главная</a></li>
							<!--<li><a href="about.html">About</a></li>-->
							<li class="has-dropdown">
								<a href="#">Сотрудники</a>
								<ul class="dropdown">
									<li><a href="#">Врачи</a></li>
									<li><a href="#">Персонал</a></li>
									<li><a href="php/academic_degrees.php">Учёные степени</a></li>
									<li><a href="#">Звания</a></li>
									<li><a href="#">Категории врачей</a></li>
									<li><a href="#">Отличительные особенности категорий</a></li>
									<li><a href="#">Особенности категорий</a></li>
									<li><a href="#">Должности</a></li>
									<li><a href="#">Врачи-отделения</a></li>
								</ul>
							</li>
							<li class="has-dropdown">
								<a href="#">Пациенты</a>
								<ul class="dropdown">
									<li><a href="#">Пациенты</a></li>
									<li><a href="#">Истории болезней</a></li>
								</ul>
							</li>
							<li class="has-dropdown">
								<a href="#">Структурные подразделения</a>
								<ul class="dropdown">
									<li><a href="#">Больницы / поликлиники</a></li>
									<li><a href="#">Лаборатории</a></li>
									<li><a href="#">Профили лабораторий</a></li>
									<li><a href="#">Корпуса</a></li>
									<li><a href="#">Отделения корпусов</a></li>
									<li><a href="#">Специализации отделений</a></li>
									<li><a href="#">Палаты отделений</a></li>
									<li><a href="#">Койки палат</a></li>
								</ul>
							</li>
							<!--<li><a href="portfolio.html">Portfolio</a></li>-->
							<li><a href="auth.php">Вход</a></li>
						</ul>
					</div>
				</div>
			</div>
		</nav>
		<header id="gtco-header" class="gtco-cover gtco-cover-xs gtco-inner" role="banner">
			<div class="gtco-container">
				<div class="row">
					<div class="col-md-12 col-md-offset-0 text-left">
						<div class="display-t">
							<div class="display-tc">
								<div class="row">
									<div class="col-md-8 animate-box">
										<h1 class="no-margin">Авторизация</h1>
										<p>Для предотвращения несанкционированного доступа к данным информационной системы, была ввеена обязательная авторизация.</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</header>
		<!-- END #gtco-header -->

		<div class="gtco-section">
			<div class="gtco-container">

				<?php
				if($_GET['autherror'] == true)
				{

					?>
					<div class="row">
						<div class="col-md-8 col-md-offset-2 gtco-heading text-center">
							<h2 style="color: red;">Ошибка авторизации</h2>
							<p style="color: red;">Неверно указаны пользовательские данные.</p>
						</div>
					</div>
					<?php

				}
				?>


				<div class="row">
					<div class="col-md-6">
						<form action="index.php" method="POST">
							<div class="form-group">
								<label for="name">Логин</label>
								<input type="text" name ="login" class="form-control" id="name" required>
							</div>
							<div class="form-group">
								<label for="name">Email</label>
								<input type="email" name ="email" class="form-control" id="email" pattern="/^([a-z0-9_\-\.])+\@([a-z0-9_\-\.])+\.([a-z]{2,4})$/i" required>
							</div>
							<div class="form-group">
								<label for="password">Пароль</label>
								<input type="password" name ="password" class="form-control" id="password" required>
							</div>
							<div class="form-group">
								<input type="submit" class="btn btn btn-special" value="Войти">
							</div>
						</form>
					</div>
					<div class="col-md-5 col-md-push-1">
						<div class="gtco-contact-info">
							<h3>Контакты</h3>
							<p>Для получения учётной записи свяжитесь с нами</p>
							<ul >
								<li class="address">198 West 21th Street, Suite 721 New York NY 10016</li>
								<li class="phone"><a href="#">+7 (918) 236 55 98</a></li>
								<li class="email"><a href="#">info@site.com</a></li>
								<li class="url"><a href="#">www.somesite.com</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- END .gtco-services -->

<!--		
		<div id="map"></div>
-->		

		<footer id="gtco-footer" class="gtco-section" role="contentinfo">				
			<div class="gtco-copyright">
				<div class="gtco-container">
					<div class="row">
						<div class="col-md-6 text-left">
							<p><small>&copy; 2018 </small></p>
						</div>
						<div class="col-md-6 text-right">
							<p><small>Designed by <a href="http://freehtml5.co/" target="_blank">FreeHTML5.co</a> Demo Images: <a href="http://pixeden.com/" target="_blank">Pixeden</a> &amp; <a href="http://unsplash.com" target="_blank">Unsplash</a></small> </p>
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

	<!-- Google Map -->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCefOgb1ZWqYtj7raVSmN4PL2WkTrc-KyA&sensor=false"></script>
	<script src="js/google_map.js"></script>
	
	<!-- Main -->
	<script src="js/main.js"></script>

	</body>
</html>

