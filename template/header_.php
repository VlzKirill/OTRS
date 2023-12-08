<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../assets/ico/favicon.ico">

    <title>Система заявок</title>

    <!-- Bootstrap core CSS -->
    <link href="AdminLTE/bower_components/bootstrap/dist/css/bootstrap.css" rel="stylesheet">
    <link href="bootstrap/css/dashboard.css" rel="stylesheet">
    <link href="bootstrap/css/bootstrap-select.css" rel="stylesheet">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="AdminLTE/dist/css/AdminLTE.css">
    <link rel="stylesheet" href="AdminLTE/dist/css/skins/_all_skins.min.css">
    <link rel="stylesheet" href="css/bootstrap-datetimepicker.min.css">

    <!-- <style>
        body {
            padding-top: 20px;
            margin-left: -10px;
        }

        .vniz {
            padding-top: 10px;
        }

        .sidebar {
            overflow: hidden;
            /*display: block;*/
            top: 0;
            left: 0;
            padding-top: 50px;
            padding-left: 0px;
            min-height: 100%;
            width: 230px;
            z-index: 810;
            -webkit-transition: -webkit-transform 0.3s cubic-bezier(0.32, 1.25, 0.375, 1.15);
            -moz-transition: -moz-transform 0.3s cubic-bezier(0.32, 1.25, 0.375, 1.15);
            -o-transition: -o-transform 0.3s cubic-bezier(0.32, 1.25, 0.375, 1.15);
            transition: transform 0.3s cubic-bezier(0.32, 1.25, 0.375, 1.15);

            background: #222d32;
        }

        .skin-green .navbar .nav>li>a {
            color: #ffffff;
        }

        /*цвет ссылок в навигации*/
        .skin-green .navbar .nav>li>a:hover,
        /*без наведения - по умолчанию*/
        .skin-green .navbar .nav>li>a:focus {
            color: #222d32;
        }

        ;
        /*при наведении*/

        .skin-green .navbar-header .logo {
            background-color: #367fa9;
            color: #ffffff;
            border-bottom: 0px solid transparent;
        }

        .navbar-header .logo {
            display: block;
            float: left;
            height: 50px;
            font-size: 20px;
            line-height: 50px;
            text-align: left;
            width: 230px;
            /*font-family: Helvetica, Arial, sans-serif;*/
            padding: 0px;
            font-weight: 300;
        }

        .skin-green .navbar .navbar-header>a {
            color: #ffffff;
        }

        /*цвет ссылок в навигации*/
        .skin-green .navbar .navbar-header>a:hover,
        /*без наведения - по умолчанию*/
        .skin-green .navbar .navbar-header>a:focus {
            color: #222d32;
        }

        ;
        /*при наведении*/
    </style> -->


    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

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

<body class="hold-transition skin-blue layout-top-nav">

    <!-- close in footer -->
    <div class="wrapper">

        <header class="main-header">
            <nav class="navbar navbar-static-top">
                <div class="container">
                    <div class="navbar-header">
                        <a href="index.php" class="navbar-brand"><img src="img/logo_small_white.png"></img> Система заявок</a>
                    </div>
                </div>
            </nav>
        </header>

        <div class="navbar bg-green navbar-fixed-top" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a href="index.php" class="logo">
                        <!-- ЛОГОТИП -->
                        <img src="img/logo_small_white.png"></img> Система заявок
                    </a>

                    <!--<a class="navbar-brand" href="index.php">Система заявок</a>-->

                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">



                        <?php
                        /**
                         * Если переменная сессии определена, то выводим 
                         * информацию о пользователе и кнопку выхода
                         */
                        if (isset($_SESSION['login'])) : ?>
                            <li>
                                <a href="?act=lk">
                                    <span class="glyphicon glyphicon-user  aria-hidden=" true">
                                    </span>
                                    <?php echo " " . $_SESSION['login'] ?>
                                </a>
                            </li>
                            <li>
                                <a href="?act=logout">
                                    <span class="glyphicon glyphicon-log-out" aria-hidden="true">
                                    </span> Выйти
                                </a>
                            </li>
                        <?php endif; ?>

                        <?php
                        /**
                         * Если переменная сессии не определена, то выводим
                         * сылку для регистрации и сылку для входа
                         */
                        if (!isset($_SESSION['login'])) : ?>
                            <li>
                                <a href="?act=registry">
                                    <span class="fa fa-address-card-o aria-hidden=" true">
                                    </span> Регистрация
                                </a>
                            </li>
                            <li>
                                <a href="?act=login">
                                    <span class="glyphicon glyphicon-log-in" aria-hidden="true">
                                    </span> Войти
                                </a>
                            </li>
                        <?php endif; ?>



                    </ul>
                </div>
                <!--/.nav-collapse -->
            </div>
        </div>

        <div class="content-wrapper">


            <div class="sidebar">

                <br>
                <ul class="sidebar-menu">
                    <li class="active">
                        <a href="?act=lk">
                            <i class="fa fa-user"></i> <span>
                                Личный кабинет</span>
                        </a>
                    </li>
                    <li>
                        <a href="?act=ticket_add"><i class="fa fa-tag"></i> Создать заявку</a>
                    </li>
                    <?php
                    $result = $mysqli->query("SELECT COUNT(*) as count FROM tickets WHERE user_to_id = '" . $_SESSION["id_user"] . "' AND status = 2");
                    if ($result)
                        $row_vhod = $result->fetch_array();
                    ?>
                    <li>
                        <a href="?act=ticket_list"><i class="fa fa-list-alt"></i> Список заявок
                            <small id="tt_label">
                                <?php
                                if ($row_vhod["count"] != 0) : ?>
                                    <small class="badge pull-right bg-red"><?= $row_vhod["count"] ?></small>
                                <?php endif ?>
                            </small></a>
                    </li>
                    <li>
                        <a href="?act=news"><i class="fa fa-bullhorn"></i> Новости</a>
                    </li>
                    <li>
                        <a href="?act=client"><i class="fa fa-street-view "></i> Клиенты</a>
                    </li>
                    <li>
                        <a href="?act=smena_pw"><i class="fa fa-refresh"></i> Смена пароля</a>
                    </li>
                    <li>
                        <a href="?act=user"><i class="fa fa-users"></i> Пользователи системы</a>
                    </li>
                    <li class="treeview ">
                        <a href="#">
                            <i class="fa fa-book"></i><span> Справочники</span><i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <a href="?act=otdel"><i class="fa fa-sitemap"></i> Отделы клиентов</a>
                            </li>
                            <li>
                                <a href="?act=doljn"><i class="fa fa-male"></i> Должности клиентов</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href='?act=report_otdel'><i class="fa fa-line-chart"></i> Общая статистика</a>
                    </li>

                </ul>

            </div> sidebar


            <div class="row">



                <div class="main">