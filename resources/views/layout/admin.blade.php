<?php
	$comments = $data['comments'];
	$unreadCount = 0;
	foreach($comments as $message) {
		if($message['read'] == false) {
			$unreadCount++;
		}
	}
?>
<!DOCTYPE html>
<html>
    <head>
      <meta charset="UTF-8">
      <title>Admin | Dashboard</title>
      <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
      <!-- bootstrap 3.0.2 -->
      <link href="{{url('style/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
      <!-- font Awesome -->
      <link href="{{url('style/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
      <!-- Ionicons -->
      <link href="{{url('style/ionicons.min.css')}}" rel="stylesheet" type="text/css" />
      <!-- Theme style -->
      <link href="{{url('style/AdminLTE.css')}}" rel="stylesheet" type="text/css" />
      <!-- jQuery 2.0.2 -->
      <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
      <!-- Bootstrap -->
      <script src="{{url('javascript/bootstrap.min.js')}}" type="text/javascript"></script>
      <!-- AdminLTE App -->
      <script src="{{url('javascript/AdminLTE/app.js')}}" type="text/javascript"></script>
      <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
      <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
      <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
      <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
      <![endif]-->
  </head>

<body class="skin-black">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="{{url('/admin')}}" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                AdminKrida
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
                        <li class="messages-menu">
                            <a href="{{url('admin/message')}}">
                                <i class="fa fa-envelope"></i>
                                @if ($unreadCount > 0) 
                                <span class="label label-success">{{ $unreadCount }}</span> 
                                @endif
                            </a>
                            
                        </li>
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span>Admin <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image
                                <li class="user-header bg-light-blue">
                                    <img src="../../img/avatar3.png" class="img-circle" alt="User Image" />
                                    <p>
                                        Jane Doe - Web Developer
                                        <small>Member since Nov. 2012</small>
                                    </p>
                                </li>
                                Menu Body -->
                                <!--<li class="user-body">
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Followers</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Sales</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Friends</a>
                                    </div>
                                </li>
                                Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="{{ url('admin/changepassword') }}" class="btn btn-default btn-flat">Change Password</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="{{ url('admin/logout') }}" class="btn btn-default btn-flat">Log Out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- search form
                    <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Search..."/>
                            <span class="input-group-btn">
                                <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li>
                            <a href="{{url('/admin/dashboard')}}">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-th"></i>
                                <span onclick="">Home</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="{{url('admin/slider')}}"><i class="fa fa-angle-double-right"></i> Slider</a></li>
                                <li><a href="{{url('admin/testimonial')}}"><i class="fa fa-angle-double-right"></i> Testimonial Box</a></li>
                                <li><a href="{{url('admin/about')}}"><i class="fa fa-angle-double-right"></i> About Us</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{ url('admin/achievements') }}">
                                <i class="fa fa-star"></i> <span>Achievements</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('admin/peoples') }}">
                                <i class="glyphicon glyphicon-user"></i> <span>People</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('admin/newsmanager') }}">
                                <i class="fa fa-file-text"></i> <span>News</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('admin/eventmanager') }}">
                                <i class="fa fa-calendar"></i> <span>Events</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('admin/galleries') }}">
                                <i class="fa fa-picture-o" aria-hidden="true"></i> <span>Galleries</span>
                            </a>
                        </li>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>
            <aside class="right-side">
              @yield('content')
            </aside>
        </div><!-- ./wrapper -->

    </body>
  <!--<body>
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">Admin KridaBudaya</a>
        </div>
        <ul class="nav navbar-nav">
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Home
            <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="{{ url('admin/slider') }}">Slider</a></li>
              <li><a href="{{ url('admin/testimonial') }}">Testimonial Box</a></li>
              <li><a href="{{ url('admin/about') }}"> About us </a> </li>
            </ul>
          </li>

          <li><a href="{{ url('admin/achievements') }}">Achievement</a></li>
          <li><a href="{{ url('admin/peoples') }}">People</a></li>
          <li><a href="{{ url('admin/newsmanager') }}">News</a></li>
          <li><a href="{{ url('admin/eventmanager') }}">Events</a></li>
          <li><a href="{{ url('admin/galleries') }}">Gallery</a></li>
          <li><a href="{{ url('admin/logout') }}"> Logout</a> </li>
          <li><a href="{{ url('admin/changepassword') }}"> Change password </a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="{{url('admin/message')}}"> Comments <span class="badge"> {{ $unreadCount }}</span> </a></li>
        </ul>
      </div>
    </nav> 

    <div class="container-fluid">
      @yield('content')
    </div>
  </body>-->
</html>