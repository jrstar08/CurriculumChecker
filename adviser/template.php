<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Required meta tags always come first -->
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Material Design Bootstrap Template</title>
    <link rel="stylesheet" href="lib/semantic/semantic.min.css">
    <!-- Bootstrap core CSS -->
    <link href="lib/compiled.min.css" rel="stylesheet">
    
    <script src="lib/sweetalert2/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="lib/sweetalert2/sweetalert2.min.css">
    <script src="lib/jquery-3.2.1.js"></script>
</head>

<body class="fixed-sn light-blue-skin" onload="hello(); howsyourday(); dontworry(); cheerup();">
    <div style="width:100%; height: 60px; background-color: #263238;"><center><img src="lib/plmlogo.png" width="50px" style="margin: 5px;"></center></div>
        
    <!--Double navigation-->
    <header>
        <!-- Sidebar navigation -->
        <div id="slide-out" class="side-nav sn-bg-4 fixed mdb-sidenav" style="transform: translateX(-100%); background: none; background-color: #37474F;">
            <ul class="custom-scrollbar list-unstyled" style="max-height:100vh;">
                <!-- NAVIGATION -->
                <h2 style="margin: 15% 10%;">Navigation</h2>
                <!-- Side navigation links -->
                <li>
                    <ul class="collapsible collapsible-accordion">
                        <li><a href="home.php" class="collapsible-header waves-effect arrow-r">Home</a></li>
                        <li><a href="approval.php" class="collapsible-header waves-effect arrow-r">Approval of Study Plan</a></li>
                        <li><a href="summary.php" class="collapsible-header waves-effect arrow-r">Summary/Report</a></li>
                        <li><a class="collapsible-header waves-effect arrow-r"><b>JOHN ROBERT FERRER</b></a>
                            <div class="collapsible-body">
                                    <ul>
                                        <li><a href="logout.php" class="waves-effect">Logout</a>
                                        </li>
                                    </ul>
                                </div>
                        </li>
                    </ul>
                </li>
                <!--/. Side navigation links -->
            </ul>
        </div>
        <!--/. Sidebar navigation -->
        <!-- Navbar -->
        <nav class="navbar navbar-toggleable-md navbar-expand-lg scrolling-navbar double-nav" style="background: #37474F;">
            <!-- SideNav slide-out button -->
            <div class="float-left">
                <a href="#" data-activates="slide-out" class="button-collapse"><img src="lib/burger.png" width="25px" style="padding: 0; margin: 0;"></a>
            </div>
            <!-- Breadcrumb-->
            <div class="breadcrumb-dn mr-auto" style="float: left; padding: 0; margin: 0;">
                <p>PLM-CRS: Curriculum Checker</p>
            </div>
            <ul class="nav navbar-nav nav-flex-icons ml-auto">
                <li class="nav-item dropdown">
                    <img src="lib/person2.png" width="35px" style="float: left; padding: 0; margin: 0;">
                    <a class="nav-link dropdown-toggle waves-effect waves-light" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Adviser
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                        <h6 style="margin: 10% 5%">John Robert Ferrer</h6>
                        <a class="dropdown-item waves-effect waves-light" href="logout.php">Logout</a>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.Navbar -->
    </header>
    <!--/.Double navigation-->
    <!--Main Layout-->
    <main style="margin-top: 0; padding-top: 0; top: 0;">
        <div class="container-fluid mt-5" style="margin-top: 0; padding-top: 0; top: 0; width: 250%; margin-left: 0;">
            <!-- START -->
            
            <!-- END -->
        </div> 
    </main>
    <!--Main Layout-->
    
    <!-- SCRIPTS -->
    <!-- JQuery -->
    <script src="lib/jquery-3.2.1.js"></script>
    <script src="lib/semantic/semantic.min.js"></script>
    <script type="text/javascript" src="lib/compiled.min.js"></script>
    <script src="lib/jquery.bootstrap-growl.js"></script>
    <script src="lib/sweetalert2/sweetalert2.all.js"></script>
    <script>
        function show_profile_picture(){
            swal({
                title: 'Wanna change your profile picture?',
                imageUrl: 'lib/adviser.jpg',
                imageWidth: 400,
                imageHeight: 400,
                imageAlt: 'Custom image',
                animation: true,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, I want to change!'
              }).then((result) => {
                if (result.value) {
                    swal(
                    'Sorry...',
                    'Currently under maintenance, HAHAHA',
                    'warning'
                    ) 
                }
              })
        }
    </script>
    <script>
        function hello(){
            $.bootstrapGrowl("Hello, John!", {
            ele: 'body', // which element to append to
            type: 'info', // (null, 'info', 'danger', 'success')
            offset: {from: 'top', amount: 20}, // 'top', or 'bottom'
            align: 'right', // ('left', 'right', or 'center')
            width: 150, // (integer, or 'auto')
            delay: 5000, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
            allow_dismiss: true, // If true then will display a cross to close the popup.
            stackup_spacing: 10 // spacing between consecutively stacked growls.
            });
        }
        function howsyourday(){
            setTimeout(function() {
                $.bootstrapGrowl("How's your day?", {
                ele: 'body', // which element to append to
                type: 'success', // (null, 'info', 'danger', 'success')
                offset: {from: 'top', amount: 20}, // 'top', or 'bottom'
                align: 'right', // ('left', 'right', or 'center')
                width: 200, // (integer, or 'auto')
                delay: 4000, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
                allow_dismiss: true, // If true then will display a cross to close the popup.
                stackup_spacing: 10 // spacing between consecutively stacked growls.
                });
            }, 2000);
        }
        function dontworry(){
            setTimeout(function() {
                $.bootstrapGrowl("Don't worry, It's okay!", {
                ele: 'body', // which element to append to
                type: 'info', // (null, 'info', 'danger', 'success')
                offset: {from: 'top', amount: 20}, // 'top', or 'bottom'
                align: 'right', // ('left', 'right', or 'center')
                width: 200, // (integer, or 'auto')
                delay: 4000, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
                allow_dismiss: true, // If true then will display a cross to close the popup.
                stackup_spacing: 10 // spacing between consecutively stacked growls.
                });
                }, 7000);
            }
        function cheerup(){
            setTimeout(function() {
                $.bootstrapGrowl("Cheer Up! :))", {
                ele: 'body', // which element to append to
                type: 'success', // (null, 'info', 'danger', 'success')
                offset: {from: 'top', amount: 20}, // 'top', or 'bottom'
                align: 'right', // ('left', 'right', or 'center')
                width: 200, // (integer, or 'auto')
                delay: 4000, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
                allow_dismiss: true, // If true then will display a cross to close the popup.
                stackup_spacing: 10 // spacing between consecutively stacked growls.
                });
            }, 8500);
        }
    </script>
    <script>
        
        // SideNav Initialization
        $(".button-collapse").sideNav();

    </script><div class="drag-target" style="left: 0px; touch-action: pan-y; user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></div>

<div class="hiddendiv common"></div></body></html>