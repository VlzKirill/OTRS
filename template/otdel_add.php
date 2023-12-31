<?php
include 'function/whoami.php';
if (!IS_KOORD)
	header('Location: ?act=lk');
require 'template/header.php';
?>

<section class="content">
	<div class="col-sm-5 col-sm-offset-3">
		<!-- Контейнер, содержащий форму обратной связи -->
		<div class="panel panel-primary">
			<!-- Заголовок контейнера -->
			<div class="panel-heading panel-title">
				<h1 class="panel-title">Новый отдел</h1>
			</div>
			<!-- Содержимое контейнера -->
			<div class="panel-body">

				<div class="alert alert-success hidden" id="success-alert">
					<strong>Успешно!</strong> Запись добавлена
				</div>
				<div class="alert alert-danger hidden" id="danger-alert">
					<strong>Неудача!</strong> Что то пошло не так
				</div>
				<div class="hidden" id="success-alert-btn">
					<a class="btn btn-sm btn-info" href="?act=otdel_add" role="button">
						<span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span> Назад</a>
				</div>

				<form role="form" id="OtdelAddForm">

					<div class="form-group has-feedback">
						<label for="inputText">Название</label>
						<input type="text" id="otdel" name="otdel" class="form-control" placeholder="Название" required autofocus>
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
<script src="js/otdel_add.js"></script>

<?php require 'template/footer.php' ?>