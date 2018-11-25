<?php include('connect.php'); $studentid=$_SESSION['studentid']; $registrationcode = $_SESSION['registrationcode']; ?>
<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Required meta tags always come first -->
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>PLM-CRS: Curriculum Checker</title>
    <link rel="shortcut icon" href="lib/plmlogo.png" />
    <link rel="stylesheet" href="lib/semantic/semantic.min.css">
    <script src="lib/sweetalert2/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="lib/sweetalert2/sweetalert2.min.css">
    <!-- Bootstrap core CSS -->
    <link href="lib/compiled.min.css" rel="stylesheet">
    <link rel="stylesheet" href="lib/custom/draganddrop-style.css">
    <link rel="stylesheet" href="lib/custom/lib/mdb-css/bootstrap.min.css">
    <link rel="stylesheet" href="lib/custom/lib/mdb-css/style.css">
    <script src="lib/custom/lib/mdb-js/bootstrap.min.js"></script>  
</head>

<body class="fixed-sn light-blue-skin" onload="notification(); custom();">
    <div style="width:100%; height: 60px; background-color: rgb(138, 8, 8);"><center><img src="lib/plmlogo.png" width="50px" style="margin: 5px;"></center></div>
        
    <!--Double navigation-->
    <header>
        <!-- Sidebar navigation -->
        <div id="slide-out" class="side-nav sn-bg-4 fixed mdb-sidenav" style="transform: translateX(-100%); background: none; background-color: #B71C1C;">
            <ul class="custom-scrollbar list-unstyled" style="max-height:100vh;">
                <!-- NAVIGATION -->
                <h2 style="margin: 15% 10%;">Navigation</h2>
                <!-- Side navigation links -->
                <li>
                    <ul class="collapsible collapsible-accordion">
                        <li><a href="home.php" class="collapsible-header waves-effect arrow-r">Home</a></li>
                        <li><a class="collapsible-header waves-effect arrow-r">Creation of Study Plan <img src="lib/down.png" style="margin-left: 20%" width="15px"></a>
                            <div class="collapsible-body">
                                <ul>
                                    <li><a href="preferred.php" class="waves-effect">Preferred</a>
                                    </li>
                                    <li><a href="custom.php" class="waves-effect">Custom</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li><a href="curriculum.php" class="collapsible-header waves-effect arrow-r">Curriculum</a></li>
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
        <nav class="navbar navbar-toggleable-md navbar-expand-lg scrolling-navbar double-nav" style="background: rgb(172, 21, 21);">
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
                        Student
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                        <h6 style="margin: 10% 5%"></h6>
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
            <input type="text" value="<?php echo $registrationcode; ?>" id="regular" hidden>
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

    <!-- 1.5.2 gagana si drag and drop but si growl not functioning -->
    <!-- <script src="lib/custom/jquery-1.5.2.js"></script> -->
    <!-- <script src="lib/custom/jquery-ui.min.js"></script> -->
    <script src="lib/custom/draganddrop-function.js"></script>
    <script>
        function notification(){
            $.bootstrapGrowl("You chose custom study plan", {
            ele: 'body', // which element to append to
            type: 'success', // (null, 'info', 'danger', 'success')
            offset: {from: 'top', amount: 20}, // 'top', or 'bottom'
            align: 'right', // ('left', 'right', or 'center')
            width: 270, // (integer, or 'auto')
            delay: 6500, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
            allow_dismiss: true, // If true then will display a cross to close the popup.
            stackup_spacing: 10 // spacing between consecutively stacked growls.
            });
        }
        function custom(){
            setTimeout(function() {
                $.bootstrapGrowl("In this type of study plan, you can add, edit, or delete subject(s) to your study plan", {
                ele: 'body', // which element to append to
                type: 'info', // (null, 'info', 'danger', 'success')
                offset: {from: 'top', amount: 20}, // 'top', or 'bottom'
                align: 'right', // ('left', 'right', or 'center')
                width: 320, // (integer, or 'auto')
                delay: 7500, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
                allow_dismiss: true, // If true then will display a cross to close the popup.
                stackup_spacing: 10 // spacing between consecutively stacked growls.
                });
            }, 2000);
        }
    </script>
    <script>
        function regular(){
            swal({
                title: 'Oops ...',
                text: "Only irregular students have access to this page",
                type: 'warning'
            }).then((result) => {
                setTimeout(function() {
                    location="home.php";
                }, 300);
            })
        }
    </script>
    <script>
        if($("#regular").val() == 'REGULAR')
        {
            regular();
        }
        else
        {

        }
    </script>
    <script>
        
        // SideNav Initialization
        $(".button-collapse").sideNav();

    </script><div class="drag-target" style="left: 0px; touch-action: pan-y; user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></div>

<div class="hiddendiv common"></div></body></html>