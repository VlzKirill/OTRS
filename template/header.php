<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Система заявок</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="AdminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="AdminLTE/bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="AdminLTE/bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="AdminLTE/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="AdminLTE/dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="css/bootstrap-datetimepicker.min.css">
    <link href="bootstrap/css/dashboard.css" rel="stylesheet">
    <link href="bootstrap/css/bootstrap-select.css" rel="stylesheet">
    <link rel="shortcut icon" href="img/logo_small_white.png">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>


<script src="bootstrap/js/jquery-2.2.3.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="bootstrap/js/bootstrap-select.min.js"></script>
<script src="bootstrap/js/i18n/defaults-ru_RU.min.js"></script>
<script src="js/app.js"></script>
<script src="bootstrap/js/bootstrap-paginator.js"></script>
<script src="js/moment-with-locales.min.js"></script>
<script src="js/bootstrap-datetimepicker.min.js"></script>

<?php
switch ($_SESSION['priv']) {
        /* админ */
    case 0:
        $role = "Администратор";
        break;

        /* координатор */
    case 1:
        $role = "Координатор";
        break;

        /* исполнитель */
    case 2:
        $role = "Исполнитель";
        break;

    default:
        $role = "";
        break;
}
?>

<body class="hold-transition skin-black layout-top-nav" style="padding-top: 0px !important;">
    <div class="wrapper">
        <?php if (isset($_SESSION['priv'])) : ?>
            <header class="main-header">
                <nav class="navbar navbar-static-top">
                    <div class="container">
                        <div class="navbar-header">
                            <a href="index.php" class="navbar-brand"> Система заявок</a>
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                                <i class="fa fa-bars"></i>
                            </button>
                        </div>
                        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                            <ul class="nav navbar-nav">
                                <li class="active"><a href="?act=lk">Личный кабинет <span class="sr-only">(current)</span></a></li>
                                <li><a href="?act=ticket_add">Создать заявку</a></li>
                                <li><a href="?act=news">Новости</a></li>
                                <li><a href="?act=client">Клиенты</a></li>
                                <li><a href="?act=smena_pw">Смена пароля</a></li>
                                <li><a href="?act=user">Пользователи</a></li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Справочники <span class="caret"></span></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="?act=otdel"> Отделы клиентов</a></li>
                                        <li><a href="?act=doljn">Должности клиентов</a></li>
                                    </ul>
                                </li>
                                <li><a href="?act=report_otdel">Отчеты</a></li>
                            </ul>
                        </div>
                        <div class="navbar-custom-menu">
                            <ul class="nav navbar-nav">
                                <li class="dropdown user user-menu">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <?php
                                        if (isset($_SESSION['login'])) : ?>
                                            <span class="glyphicon glyphicon-user" aria-hidden=" true">
                                            </span>
                                            <span class="hidden-xs">
                                                <?php echo " " . $_SESSION['login'] ?>
                                            </span>


                                        <?php endif; ?>

                                        <?php
                                        if (!isset($_SESSION['login'])) : ?>

                                            <a href="?act=registry">
                                                <span class="fa fa-address-card-o aria-hidden=" true">
                                                </span> Регистрация
                                            </a>
                                            <span class="hidden-xs">
                                                <a href="?act=login">
                                                    <span class="glyphicon glyphicon-log-in" aria-hidden="true">
                                                    </span> Войти
                                                </a>
                                            </span>
                                        <?php endif; ?>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li class="user-footer">
                                            <div class="pull-left">
                                                <a href="?act=lk" class="btn btn-default btn-flat">Личный кабинет</a>
                                            </div>
                                            <div class="pull-right">
                                                <a href="?act=logout" class="btn btn-default btn-flat">Выход</a>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </header>
        <?php endif; ?>

        <div class="content-wrapper">
            <div class="container">