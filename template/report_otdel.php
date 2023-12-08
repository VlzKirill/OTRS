<?php require 'template/header.php';
include 'function/whoami.php';
?>

<style>
	body {
		padding-top: 45px;
	}
</style>


<h1 class="page-header"><i class="fa fa-bar-chart-o"></i> Общая статистика</h1>

<div class="col-md-12">
	<div class="row">
		<div class="col-md-3">
			<div class="row">
				<div class="col-md-12">
					<div class="box box-info">
						<div class="box-header">
							<h3 class="box-title">
								За определённый период
							</h3>
						</div>
						<div class="box-body">


							<?php
							$date_start = isset($_POST["date_start"]) ? $_POST["date_start"] : null;
							$date_end   = isset($_POST["date_end"]) ? $_POST["date_end"] : null;
							?>

							<form action="" method="POST" class="form-horizontal" id="ReportOtdelForm" role="form">

								<div class="form-group">
									<div class="col-md-12">
										<!-- Элемент HTML с id равным datetimepicker1 -->

										<small>
											<label>Начало периода</label>
										</small>

										<div class="input-group date input-append" id="datetimepicker_start">
											<span class="input-group-addon">
												<i class="fa fa-calendar"></i>
											</span>
											<input type="text" name="date_start" class="form-control input-sm" required>
											</input>
											<span class="glyphicon form-control-feedback"></span>
										</div>
									</div>
								</div>
								<!-- Инициализация виджета "Bootstrap datetimepicker" -->
								<script type="text/javascript">
									$(function() {
										// Идентификатор элемента HTML (например: #datetimepicker1), 
										// datetimepicker для которого необходимо инициализировать 
										// виджет "Bootstrap datetimepicker"
										$('#datetimepicker_start').datetimepicker({
											pickTime: false,
											defaultDate: new Date(),
											format: 'DD-MM-YYYY'
											//$("#datetimepicker_star).datepicker("setDate", 
											//		$get('<%= hfData.ClientID %>').value);
										});
									});
								</script>


								<div class="form-group">
									<div class="col-md-12">

										<small>
											<label>Конец периода</label>
										</small>

										<div class="input-group date" id="datetimepicker_end">
											<span class="input-group-addon">
												<i class="fa fa-calendar"></i>
											</span>
											<input type="text" name="date_end" class="form-control input-sm" required>
											</input>
											<span class="glyphicon form-control-feedback"></span>
										</div>
									</div>
								</div>
								<script type="text/javascript">
									$(function() {
										$('#datetimepicker_end').datetimepicker({
											pickTime: false,
											defaultDate: new Date(),
											format: 'DD-MM-YYYY'
										});
									});
								</script>

								<div class="form-group">
									<div class="col-md-12">
										<button class="btn btn-info btn-block btn-sm" id="main_stat_make" type="submit">Сформировать
										</button>
									</div>
								</div>

								<input id="start_time" value="2016-09-15" type="hidden">
								<input id="stop_time" value="2016-09-15" type="hidden">

							</form>

							<?php
							$date_start = isset($_POST["date_start"]) ? $_POST["date_start"] : null;
							$date_end   = isset($_POST["date_end"]) ? $_POST["date_end"] : null;
							?>

							<!--<script src="js/report_otdel.js"></script>-->



						</div><!-- /.box-body -->
					</div>
				</div>


				<div class="col-md-12">
					<div class="callout">
						<small> <i class="fa fa-info-circle"></i>
							В данном разделе содержится статистика отдела и его пользователей.
						</small>
					</div>
				</div>
			</div>
		</div>




		<div class="col-md-9" id="ts_res">
			<div class="box box-solid">
				<?php
				if (($date_start && $date_end) != null) : ?>
					<div class="box-header">
						<h4 class="box-title">Общая статистика
							c <?= $date_start ?> по <?= $date_end ?>
						</h4>
					</div>
				<?php endif; ?>


				<?php
				/* С учётом тех заявок что находятся в архиве*/

				/* добавим к дате время так как на форме время выбрать нельзя,
 * а интервал лучше будет указать конкретно от полуночи до полуночи */
				$date_start = $date_start . " 00:00:00";
				$date_end   = $date_end . " 23:59:59";

				/* Выборка по дате. Запрос заноситься в переменную, и дальше 
 * используется только она */
				$query_tail = " tickets.date_create 
		BETWEEN STR_TO_DATE('$date_start', '%d-%m-%Y %H:%i:%s') 
		AND STR_TO_DATE('$date_end', '%d-%m-%Y %H:%i:%s')";

				$result = $mysqli->query("SELECT COUNT(tickets.id) AS count_all FROM tickets 
				WHERE " . $query_tail);
				if ($result)
					$row_all = $result->fetch_array();

				$count_all = $row_all['count_all'];


				$result = $mysqli->query("SELECT COUNT(tickets.id) AS count_in_job FROM tickets 
				WHERE status = 1 AND " . $query_tail);
				if ($result)
					$row_in_job = $result->fetch_array();


				$result = $mysqli->query("SELECT COUNT(tickets.id) AS count_done FROM tickets 
				WHERE status = 0 AND " . $query_tail);
				if ($result)
					$row_done = $result->fetch_array();


				$result = $mysqli->query("SELECT COUNT(tickets.id) AS count_not_job FROM tickets
				WHERE status = 2 AND " . $query_tail);
				if ($result)
					$row_not_job = $result->fetch_array();

				$count_not_job = $row_not_job["count_not_job"];
				$count_in_job = $row_in_job["count_in_job"];
				$count_done = $row_done["count_done"];
				?>

				<div class="box-body">

					<fieldset>
						<legend>Статистика подачи заявок</legend>
						<div style="position: relative; height:400px; width:100%">
							<canvas id="myChart"></canvas>
						</div>
					</fieldset>

					<fieldset>
						<legend>Статистика выполнения заявок</legend>
						<div style="position: relative; height:400px; width:100%">
							<canvas id="myChart2"></canvas>
						</div>
					</fieldset>

					<fieldset>
						<legend>Статистика заявок</legend>
						<div style="position: relative; height:400px; width:100%">
							<canvas id="myChart4"></canvas>
						</div>
					</fieldset>

					<h4>
						<center>Информация о заявках вашего отдела</center>
					</h4>
					<table class="table table-bordered">
						<tbody>
							<tr class="warning">
								<td style="width: 300px;"></td>
								<td style="">
									<strong>
										<small>
											<center>Создано заявок</center>
										</small>
									</strong>
								</td>
								<td style="">
									<strong>
										<small>
											<center>
												Не взятых заявок
											</center>
										</small>
									</strong>
								</td>
								<td style="">
									<strong>
										<small>
											<center>
												Заявок в работе
											</center>
										</small>
									</strong>
								</td>
								<td style="">
									<strong>
										<small>
											<center>
												Выполненных заявок
											</center>
										</small>
									</strong>
								</td>
							</tr>
							<tr>
								<td style=""><small> </small></td>
								<td style="">
									<small>
										<center>
											<?= $row_all["count_all"] ?>
										</center>
									</small>
								</td>
								<td style="">
									<small>
										<center>
											<?= $row_not_job["count_not_job"] ?>
										</center>
									</small>
								</td>
								<td style="">
									<small>
										<center>
											<?= $row_in_job["count_in_job"] ?>
										</center>
									</small>
								</td>
								<td style="">
									<small>
										<center>
											<?= $row_done["count_done"] ?>
										</center>
									</small>
								</td>
							</tr>
						</tbody>
					</table>
					<br>
					<h4>
						<center>
							Текущая информация о заявках пользователей вашего отдела
						</center>
					</h4>


					<?php
					$result = $mysqli->query("SELECT users.id AS id, users.fio AS fio FROM users 
				ORDER BY users.fio");

					if ($result) : ?>

						<table class="table table-bordered table-hover">
							<tbody>
								<tr class="warning">
									<td style="width: 200px;">
										<strong><small>
												<center>ФИО</center>
											</small></strong>
									</td>
									<td style="">
										<strong><small>
												<center>Создано</center>
											</small></strong>
									</td>
									<td style="">
										<strong><small>
												<center>Выполнено</center>
											</small></strong>
									</td>
									<td style="">
										<strong><small>
												<center>Ожидают</center>
											</small></strong>
									</td>
									<td style="">
										<strong><small>
												<center>Переадресовано</center>
											</small></strong>
									</td>
									<td style="">
										<strong><small>
												<center>В работе</center>
											</small></strong>
									</td>
								</tr>

								<?php
								while ($row = $result->fetch_assoc()) : ?>

									<?php
									/* все заявки созданные пользователем */
									$result2 = $mysqli->query("SELECT COUNT(tickets.id) AS tickets 
					FROM tickets 
					WHERE user_create_id = '$row[id]' 
					AND " . $query_tail);
									if ($result2)
										$row_all = $result2->fetch_array();


									/* выполненые заявки статус = 0 */
									$result2 = $mysqli->query("SELECT COUNT(tickets.id) AS tickets 
					FROM tickets 
					WHERE user_to_id = '$row[id]' 
					AND status = 0 AND " . $query_tail);
									if ($result2)
										$row_in_job = $result2->fetch_array();


									/* заявки находящиеся в ожидании взятия пользователем 
	 * выбираем все заявки которые пришли пользователю, 
	 * статус заявок = 2 (те что находяться в ожидании) 
	 * */
									$result2 = $mysqli->query("SELECT COUNT(tickets.id) AS tickets 
					FROM tickets 
					WHERE user_to_id = '$row[id]' 
					AND status = 2 AND " . $query_tail);
									if ($result2)
										$row_not_job = $result2->fetch_array();


									/* ПЕРЕАДРЕСОВАННЫЕ ЗАЯВКИ 
	 *
	 *
	 *
	 *
	 *
	 * */


									/* в работе, статус = 1 */
									$result2 = $mysqli->query("SELECT COUNT(tickets.id) AS tickets 
					FROM tickets 
					WHERE user_to_id = '$row[id]' 
					AND status = 1 AND " . $query_tail);
									if ($result2)
										$row_done = $result2->fetch_array();
									?>

									<tr>
										<td style="width: 200px;"><small><?= $row["fio"] ?></small></td>
										<td style="">
											<small class="text-danger">
												<center>
													<?= $row_all["tickets"] ?>
												</center>
											</small>
										</td>
										<td style="">
											<small class="text-danger">
												<center>
													<?= $row_in_job["tickets"] ?>
												</center>
											</small>
										</td>
										<td style="">
											<small class="text-danger">
												<center>
													<?= $row_not_job["tickets"] ?>
												</center>
											</small>
										</td>
										<td style="">
											<small class="text-danger">
												<center>
												</center>
											</small>
										</td>
										<td style="">
											<small class="text-danger">
												<center>
													<?= $row_done["tickets"] ?>
												</center>
											</small>
										</td>
									</tr>

								<?php endwhile; ?>

							</tbody>
						</table>

					<?php endif;

					$result->free();
					$mysqli->close();
					?>

				</div>
			</div>
		</div>
	</div>
	<?php require 'template/footer.php' ?>
	<script src="chart/node_modules/chart.js/dist/Chart.js"></script>

	<script type="text/javascript">
		$(document).ready(function() {

			function updateMyChart(start = "", end = "") {

				var count_all = <?php echo json_encode($count_all); ?>;
				var count_not_job = <?php echo json_encode($count_not_job); ?>;
				var count_in_job = <?php echo json_encode($count_in_job); ?>;
				var count_done = <?php echo json_encode($count_done); ?>;

				r = [{
						"login": "Создано заявок",
						"amnt": count_all
					},
					{
						"login": "Не взятых заявок",
						"amnt": count_not_job
					},
					{
						"login": "Заявок в работе",
						"amnt": count_in_job
					},
					{
						"login": "Выполненных заявок",
						"amnt": count_done
					}
				];

				r.forEach(element => {
					addData(myChart, element['login'], element['amnt']);
				});
			}

			function updateMyChart2() {
				var count_all = <?php echo json_encode($count_all); ?>;
				var count_done = <?php echo json_encode($count_done); ?>;
			}

			function addData(chart, label, element1, element2 = null) {

				chart.data.labels.push(label);
				chart.data.datasets[0].data.push(element1);
				if (element2 != null)
					chart.data.datasets[1].data.push(element2);
				chart.update();
			}

			var ctx = document.getElementById('myChart');
			var ctx2 = document.getElementById('myChart2');
			var ctx4 = document.getElementById('myChart4');

			let color = [];
			let labels = [];
			let data = [];

			var dynamicColors = function() {
				var r = Math.floor(Math.random() * 255);
				var g = Math.floor(Math.random() * 255);
				var b = Math.floor(Math.random() * 255);
				return "rgb(" + r + "," + g + "," + b + ")";
			}

			r = [{
					name: "Не печатает принтер",
					amnd: 21
				},
				{
					name: "Завис компьютер",
					amnt: 10
				},
				{
					name: "Не работает 1С",
					amnt: 5
				},
				{
					name: "Замена картриджа",
					amnt: 13
				},
				{
					name: "Установка ПО",
					amnt: 41
				}
			];

			r.forEach(element => {
				color.push(dynamicColors());
				labels.push(element['name']);
				data.push(element['amnt']);
			});

			let chartData = {
				labels: labels,
				datasets: [{
					data: data,
					backgroundColor: color
				}]
			}

			var myChart4 = new Chart(ctx4, {
				type: 'pie',
				data: chartData,
				options: {
					responsive: true,
					maintainAspectRatio: false
				}
			});

			var myChart = new Chart(ctx, {
				type: 'bar',
				data: {
					labels: [],
					datasets: [{
						label: 'Кол-во заявок',
						data: [],
						backgroundColor: [
							'rgba(14,107,199, 0.2)',
							'rgba(199,14,14, 0.2)',
							'rgba(124,252,200, 0.2)',
							'rgba(124,252,30, 0.2)',
							'rgba(24,52,145, 0.2)',
							'rgba(124,52,120, 0.2)',
						],
						borderColor: [
							'rgba(14,107,199, 0.2)',
							'rgba(199,14,14, 0.2)',
							'rgba(24,52,145, 0.2)',
							'rgba(124,252,200, 0.2)',
							'rgba(124,252,30, 0.2)',
							'rgba(124,52,120, 0.2)',
						],
						borderWidth: 1
					}]
				},
				options: {
					responsive: true,
					maintainAspectRatio: false,
					scales: {
						yAxes: [{
							ticks: {
								beginAtZero: true
							}
						}]
					}
				}
			});

			var myChart2 = new Chart(ctx2, {
				type: 'line',
				data: {
					labels: ['21.04.19', '21.04.21', '22.04.21', '23.04.21'],
					datasets: [{
							label: 'Число поданых заявок',
							data: [4, 7, 1, 3],
							backgroundColor: [
								'rgba(79, 141, 179, 0.2)',
							],
							borderColor: [
								'rgba(79, 141, 179, 1)'
							],
							borderWidth: 1
						},
						{
							label: 'Число отработанных заявок',
							data: [2, 5, 2, 4],
							backgroundColor: [
								'rgba(179, 141, 179, 0.2)',
							],
							borderColor: [
								'rgba(179, 141, 179, 1)'
							],
							borderWidth: 1
						}
					]
				},
				options: {
					responsive: true,
					maintainAspectRatio: false,
					scales: {
						yAxes: [{
							ticks: {
								beginAtZero: true
							}
						}]
					}
				}
			});

			updateMyChart();
			updateMyChart2();

		});
	</script>