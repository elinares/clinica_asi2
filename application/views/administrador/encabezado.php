<?php
if(!$this->session->userdata('user_info')){
    redirect('/');
}else{
    $user_info = $this->session->userdata('user_info');    
}
?>
<!doctype html>
<html lang="en"><head>
    <meta charset="utf-8">
    <title><?=$titulo?></title>
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="stylesheet" href="<?=base_url()?>css/css.css">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>js/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="<?=base_url()?>js/font-awesome/css/font-awesome.css">

    <script src="<?=base_url()?>js/jquery-1.11.1.min.js" type="text/javascript"></script>
    <script src="<?=base_url()?>js/livevalidation_standalone.compressed.js" type="text/javascript"></script>

        <script src="<?=base_url()?>js/jQuery-Knob/js/jquery.knob.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(function() {
            $(".knob").knob();
        });
    </script>


    <link rel="stylesheet" type="text/css" href="<?=base_url()?>css/theme.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>css/premium.css">

</head>
<body class=" theme-blue">

    <!-- Demo page code -->

    <script type="text/javascript">
        $(function() {
            var match = document.cookie.match(new RegExp('color=([^;]+)'));
            if(match) var color = match[1];
            if(color) {
                $('body').removeClass(function (index, css) {
                    return (css.match (/\btheme-\S+/g) || []).join(' ')
                })
                $('body').addClass('theme-' + color);
            }

            $('[data-popover="true"]').popover({html: true});
            
        });
    </script>
    <style type="text/css">
        #line-chart {
            height:300px;
            width:800px;
            margin: 0px auto;
            margin-top: 1em;
        }
        .navbar-default .navbar-brand, .navbar-default .navbar-brand:hover { 
            color: #fff;
        }
    </style>

    <script type="text/javascript">
        $(function() {
            var uls = $('.sidebar-nav > ul > *').clone();
            uls.addClass('visible-xs');
            $('#main-menu').append(uls.clone());
        });
    </script>

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="../assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
  

  <!--[if lt IE 7 ]> <body class="ie ie6"> <![endif]-->
  <!--[if IE 7 ]> <body class="ie ie7 "> <![endif]-->
  <!--[if IE 8 ]> <body class="ie ie8 "> <![endif]-->
  <!--[if IE 9 ]> <body class="ie ie9 "> <![endif]-->
  <!--[if (gt IE 9)|!(IE)]><!--> 
   
  <!--<![endif]-->

    <div class="navbar navbar-default" role="navigation">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="" href="<?=base_url()?>inicio"><img class="logo" src="<?=base_url()?>img/logo.jpg"></a></div>

        <div class="navbar-collapse collapse" style="height: 1px;">
          <ul id="main-menu" class="nav navbar-nav navbar-right">
            <li class="dropdown hidden-xs">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <span class="glyphicon glyphicon-user padding-right-small" style="position:relative;top: 3px;"></span> <?=$user_info['nombre']?>
                    <i class="fa fa-caret-down"></i>
                </a>

              <ul class="dropdown-menu">
                <li><a href="#">Mi Cuenta</a></li>
                <li class="divider"></li>
                <li><a tabindex="-1" href="<?=base_url()?>logout">Salir</a></li>
              </ul>
            </li>
          </ul>

        </div>
      </div>
    </div>
    

    <div class="sidebar-nav">
    <ul>

        <li>
            <a href="<?=base_url()?>inicio" class="nav-header"><i class="fa fa-fw fa-dashboard"></i> Inicio</a>
        </li>    

    <!--MANTENIMIENTOS-->

        <li>
            <a href="#" data-target=".mantenimientos-menu" class="nav-header collapsed" data-toggle="collapse"><i class="fa fa-fw fa-legal"></i> Mantenimientos<i class="fa fa-collapse"></i></a>
        </li>        
        <li>
            <ul class="mantenimientos-menu nav nav-list collapse">
            	<li><a href="<?=base_url()?>citas"><span class="fa fa-caret-right"></span>Citas</a></li>
                <li ><a href="<?=base_url()?>cargos"><span class="fa fa-caret-right"></span> Cargos</a></li>
                <li><a href="<?base_url()?>empleados"><span class="fa fa-caret-right"></span>Empleados</a></li>
                <li ><a href="<?=base_url()?>clinicas"><span class="fa fa-caret-right"></span> Clínicas</a></li>
                <li ><a href="<?=base_url()?>consultorios"><span class="fa fa-caret-right"></span> Consultorios</a></li>
                <li ><a href="<?=base_url()?>departamentos"><span class="fa fa-caret-right"></span> Departamentos</a></li>
                <li ><a href="<?=base_url()?>especialidades"><span class="fa fa-caret-right"></span> Especialidades</a></li>
                <li ><a href="<?=base_url()?>municipios"><span class="fa fa-caret-right"></span> Municipios</a></li>
                <li ><a href="<?=base_url()?>perfiles"><span class="fa fa-caret-right"></span> Perfiles</a></li>
                <li ><a href="<?=base_url()?>usuarios"><span class="fa fa-caret-right"></span> Usuarios</a></li>
               <li ><a href="<?=base_url()?>persona"><span class="fa fa-caret-right"></span>persona</a></li>
            </ul>
        </li>

    </ul>
    </div>    