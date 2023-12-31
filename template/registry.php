<?php
require 'template/header.php';
?>
<style>
	body {
		padding-top: 75px;
	}

	.left_krai {
		padding-left: 90px;
	}
</style>

<div style="margin-top: 10%;" class="col-md-5 col-md-offset-3 left_krai">
	<!-- Контейнер, содержащий форму обратной связи -->
	<div class="box box-primary ">
		<!-- Заголовок контейнера -->
		<div class="box-header with-border">
			<h3 class="box-title">Регистрация</h3>
		</div>
		<!-- Содержимое контейнера -->
		<div class="box-body">

			<div class="alert alert-success hidden" id="success-alert">
				<strong>Успешно!</strong> Запись добавлена
			</div>
			<div class="alert alert-danger hidden" id="danger-alert">
				<strong>Неудача!</strong> Что то пошло не так
			</div>
			<div class="alert alert-danger hidden" id="login-alert">
				<p>Этот логин уже занят</p>
			</div>
			<div class="hidden" id="success-alert-btn">
				<a class="btn btn-sm btn-info" href="?act=registry" role="button">
					<span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span> Назад</a>
			</div>

			<form role="form" id="UserAddForm">

				<div class="form-group has-feedback">
					<label for="inputText">ФИО</label>
					<input type="text" id="fio" name="fio" class="form-control" placeholder="ФИО" required autofocus>
					<!-- <p class="help-block">Пример строки с подсказкой</p> -->
					<span class="glyphicon form-control-feedback"></span>
				</div>

				<div class="form-group has-feedback">
					<label for="inputText">Логин</label>
					<input type="text" name="login" class="form-control" placeholder="Логин" required>
					<span class="glyphicon form-control-feedback"></span>
				</div>

				<div class="form-group has-feedback">
					<label for="inputPassword">Пароль</label>
					<input type="password" id="password" name="password" class="form-control" placeholder="Пароль" required>
					<span class="glyphicon form-control-feedback"></span>
				</div>

				<div class="form-group has-feedback">
					<label for="inputPassword">Пароль ещё раз</label>
					<input type="password" id="password2" name="password2" class="form-control" placeholder="Пароль ещё раз" required>
					<span class="glyphicon form-control-feedback"></span>
				</div>

				<div class="form-group has-feedback">
					<label for="inputEmail">Email</label>
					<input type="email" name="email" class="form-control" placeholder="Email" required>
					<span class="glyphicon form-control-feedback"></span>
				</div>

				<div class="form-group has-feedback">
					<label for="inputTel">Телефон</label>
					<input type="tel" name="tel" class="form-control" placeholder="Телефон" required>
					<span class="glyphicon form-control-feedback"></span>
				</div>

				<!-- Два скрытых поля, так как на форме регистрации нет 
					выбора роли пользователя, и нет галочки вкоючения ползователя.
					А скрипт обрабатывающий и добавляющий пользователя используется 
					один и тот же как на панели администратора так и при регистрации, 
					нужно передвать значения по умолчанию что бы скрипт обрабатывал 
					верно. Привелегия = 2 - обычный пользователь. 
					Статус = 1 -пользователь влкючён -->
				<input type="hidden" name="priv" value="2">
				<input type="hidden" name="status" value="1">

				<div class="form-group">
					<button id="btn_add" class="btn btn-md btn-success" type="submit">
						<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Добавить пользователя</button>
				</div>

			</form>

		</div>
	</div>
</div>

<script src="js/user_add.js"></script>

<?php require 'template/footer.php' ?>