<?php
include 'function/whoami.php';
if (!IS_KOORD)
	header('Location: ?act=lk');
require 'template/header.php';
?>
<style>
	textarea {
		resize: none;
		/* Запрещаем изменять размер */
	}
</style>

<section class="content">
	<div class="col-sm-5 col-sm-offset-3">
		<!-- Контейнер, содержащий форму обратной связи -->
		<div class="panel panel-primary">
			<!-- Заголовок контейнера -->
			<div class="panel-heading panel-title">
				<h1 class="panel-title">Новая новость</h1>
			</div>
			<!-- Содержимое контейнера -->
			<div class="panel-body">

				<div class="alert alert-success hidden" id="success-alert">
					<strong>Успешно!</strong> Запись добавлена
				</div>
				<div class="alert alert-danger hidden" id="danger-alert">
					<strong>Неудача!</strong> Что то пошло не так
				</div>
				<div class="alert alert-danger hidden" id="client-not-select-alert">
					Клиент не выбран!
				</div>
				<div class="hidden" id="success-alert-btn">
					<a class="btn btn-sm btn-info" href="?act=news_add" role="button">
						<span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span> Назад</a>
				</div>

				<form role="form" id="NewsAddForm">

					<div class="form-group has-feedback">
						<label>Тема</label>
						<input type="text" name="theme" class="form-control" placeholder="Тема" required autofocus>
						<span class="glyphicon form-control-feedback"></span>
					</div>

					<div class="form-group has-feedback">
						<label>Сообщение</label>
						<textarea name="msg" rows="5" class="form-control" placeholder="Новость" required></textarea>
						<span class="glyphicon form-control-feedback"></span>
					</div>

					<div class="form-group">
						<button id="btn_add" class="btn btn-lg btn-success" type="submit">
							<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Добавить</button>
					</div>

				</form>

			</div>
		</div>
	</div>
</section>

<script src="js/news_add.js"></script>

<?php require 'template/footer.php' ?>