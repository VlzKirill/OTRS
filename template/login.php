<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="shortcut icon" href="img/logo_small_white.png">

	<title>Вход в систему</title>

	<link href="bootstrap/css/bootstrap.css" rel="stylesheet">
	<link href="bootstrap/css/signin.css" rel="stylesheet">

	<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="AdminLTE/dist/css/AdminLTE.min.css">
	<link rel="stylesheet" href="css/skin-blue.css">

	<script src="bootstrap/js/jquery-1.12.3.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>

</head>

<body class="hold-transition login-page">
	<div class="login-box">
		<div class="login-logo">
			<a href="#"><b>Система заявок</b></a>
		</div>
		<div class="login-box-body">
			<p class="login-box-msg">Вход в систему заявок</p>
			<form class="form-signin" role="form" id="LoginForm">

				<div class="alert alert-danger skleit_alert hidden" id="login-alert">
					<p>Неверный логин или пароль</p>
				</div>
				<div class="alert alert-danger skleit_alert hidden" id="danger-alert">
					<p>Что то пошло не так</p>
				</div>
				<div class="alert alert-success skleit_alert hidden" id="success-alert">
					<p>Вход выполнен</p>
				</div>
				<div class="alert alert-danger skleit_alert hidden" id="status_off-alert">
					<p>Пользователь отключён</p>
				</div>

				<div class="form-group sk2 has-feedback">
					<input type="text" name="login" class="form-control" placeholder="Логин" required autofocus>
					<span class="glyphicon glyph form-control-feedback" aria-hidden="true"></span>
				</div>

				<div class="form-group skleit has-feedback">
					<input type="password" name="password" class="form-control" placeholder="Пароль" required>
					<span class="glyphicon glyph form-control-feedback"></span>
				</div>

				<div class="form-group">
					<a href="index.php?act=recover_login">Восстановить пароль</a>
					<br>
					<a href="index.php?act=registry">Зарегистрироваться</a>
				</div>

				<button id="btn_login" class="btn btn-lg btn-primary btn-block" type="submit">Войти</button>

			</form>
		</div>
	</div>
	<script src="js/login.js"></script>
</body>

</html>