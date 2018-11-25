<?php
    include ('connect.php');
    ini_set('max_execution_time', 0);
    $_SESSION['url_destination'] = "graduating_class.php";
    $GOT_QUERY = $_GET['query'];
?>
<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Required meta tags always come first -->    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>PLM Curriculum Checker</title>
    <link rel="shortcut icon" href="lib/plmlogo.png" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="lib/material.indigo-blue.min.css">
    <script defer src="lib/material.min.js"></script>
    <link rel="stylesheet" href="lib/semantic/semantic.min.css">
    <!-- Bootstrap core CSS -->
    <link href="lib/compiled.min.css" rel="stylesheet">
    <script src="lib/sweetalert2/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="lib/sweetalert2/sweetalert2.min.css">
    <script src="lib/jquery-3.2.1.js"></script>
</head>

<body class="fixed-sn light-blue-skin" onload="hello();">
    <div style="width:100%; height: 60px; background-color: #01579B;" id="logo"><center><img src="lib/plmlogo.png" width="50px" style="margin: 5px;"></center></div>
    <!--Double navigation-->
    <header>
        <!-- Sidebar navigation -->
        <div id="slide-out" class="side-nav sn-bg-4 fixed mdb-sidenav" style="transform: translateX(-100%); background: none; background-color: #01579B;">
            <ul class="custom-scrollbar list-unstyled" style="max-height:100vh;">
                <!-- NAVIGATION -->
                <h2 style="margin: 15% 20px;"><img src="lib/admin2.png" style="width: 50px; margin-right: 15px;"><?php echo 'Admin';?></h2>
                <!-- Side navigation links -->
                <li>
                    <ul class="collapsible collapsible-accordion">
                        <li><a href="home.php" class="collapsible-header waves-effect arrow-r">Home</a></li>
                        <li><a href="accreditation.php" class="collapsible-header waves-effect arrow-r">Accreditation</a></li> 
                        <li><a href="cross-enrolled.php" class="collapsible-header waves-effect arrow-r">Cross-Enrolled</a></li>
                        <li><a href="generate_graduating_students.php" class="collapsible-header waves-effect arrow-r">Generate Tentative Students</a></li>
                        <li><a href="graduating_class.php" class="collapsible-header waves-effect arrow-r">Tentative Class</a></li>
                        <li><a href="students_curriculum.php" class="collapsible-header waves-effect arrow-r">Student Details</a></li>
                        <li><a href="students_deficiency.php" class="collapsible-header waves-effect arrow-r">Students with Deficiency</a></li>
                        <li><a class="collapsible-header waves-effect arrow-r">Utilities</a>
                            <div class="collapsible-body">
                                    <ul>
                                        <li><a href="add_news.php" class="waves-effect">Add News</a></li>
                                        <li><a href="add_calender.php" class="waves-effect">Add Calendar</a></li>
                                        <li><a href="add_school.php" class="waves-effect">Add School</a></li>
                                    </ul>
                                </div>
                        </li>
                        <li><a href="logs.php" class="collapsible-header waves-effect arrow-r">Logs</a></li>
                        <li><a href="logout.php" class="collapsible-header waves-effect arrow-r">Logout</a></li>
                    </ul>
                </li>
                <!--/. Side navigation links -->
            </ul>
        </div>
        <!--/. Sidebar navigation -->
        <!-- Navbar -->
        <nav class="navbar navbar-toggleable-md navbar-expand-lg scrolling-navbar double-nav" style="background: #0277BD;">
            <!-- SideNav slide-out button -->
            <div class="float-left">
                <a href="#" data-activates="slide-out" class="button-collapse"><img src="lib/burger.png" width="25px" style="padding: 0; margin: 0;"></a>
            </div>
            <!-- Breadcrumb-->
            <div class="breadcrumb-dn mr-auto" style="float: left; padding: 0; margin: 0;">
                <p>PLM-CRS: Curriculum Checker</p>
            </div>
        </nav>
        <!-- /.Navbar -->
    </header>
    <!--/.Double navigation-->
    <!--Main Layout-->
    <main style="margin-top: 0; padding-top: 0; top: 0;">
        <div class="container-fluid mt-5" style="margin-top: 0; padding-top: 0; top: 0; width: 100%; margin-left: 0;">
            <!-- START -->
                <div class="ui container" style="margin-top: 0; width: 100%;">
                    <h3>  List of Tentative Students </h3>
                    <div style="overflow: auto; height: 380px; margin-top: 15px; margin-bottom: 20px;">
                        <table class="ui unstackable table">
                            <thead>
                                <tr>
                                <th>Student ID</th>
                                <th>Name</th>
                                <th>Course</th>
                                <th>College</th>
                                <th>AYSEM</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $query = $GOT_QUERY." AND studentterms.aysem = '20172' order by units.unit, programs.program, name";
                                    
                                    $result = mysqli_query($conn,$query);
                                    if(mysqli_num_rows($result)>0)
                                    {
                                        while($row=mysqli_fetch_row($result))
                                        {
                                            echo '<tr>';
                                            echo '<td>'.$row[0].'</td><td>'.$row[1].'</td><td>'.$row[2].'</td><td>'.$row[3].'</td><td>'.$row[4];
                                            echo '</tr>';
                                        }
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>      
                    <center>
                        <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" id="print">PRINT</button>
                    </center>  
                </div>
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
    </script>
    <script>
        // SideNav Initialization
        $(".button-collapse").sideNav();
    </script><div class="drag-target" style="left: 0px; touch-action: pan-y; user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></div>

<div class="hiddendiv common"></div></body></html>

<script>
    $(document).ready(function() {
        $('select').material_select();
    });
</script>
<script>
    $('#print').click(function(){
        location="print_graduating_students.php?query=<?php echo $GOT_QUERY ?>";
    });
</script>

<script>
    function filter(){
        // inputOptions can be an object or Promise
        var inputOptions = new Promise(function(resolve) {
            resolve({
            '#ff0000': 'Red',
            '#00ff00': 'Green',
            '#0000ff': 'Blue'
            });
        });

        swal({
        title: 'Select color',
        input: 'radio',
        inputOptions: inputOptions,
        inputValidator: function(result) {
            return new Promise(function(resolve, reject) {
            if (result) {
                resolve();
            } else {
                reject('You need to select something!');
            }
            });
        }
        }).then(function(result) {
        swal({
            type: 'success',
            html: 'You selected: ' + result.value
        });
        })

        $(document).on("click",".swal2-container input[name='swal2-radio']", function() {
            var id = $('input[name=swal2-radio]:checked').val();
            console.log('id: ' + id);
        });
    }
</script>