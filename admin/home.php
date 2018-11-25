<?php 
    include ('connect.php');
    $query = "select studentid from studentterms where registrationcode = 'R' and AYSEM = '20172' GROUP BY studentid";
    $result = mysqli_query($conn, $query);
    $regular = mysqli_num_rows($result);
    $query = "select studentid from studentterms where registrationcode = 'I' and AYSEM = '20172' GROUP BY studentid";
    $result = mysqli_query($conn, $query);
    $irregular = mysqli_num_rows($result);
    $query = "select employeeid from employees where rank >= 1 and rank <= 41";
    $result = mysqli_query($conn, $query);
    $faculty = mysqli_num_rows($result);
    $query = "select studentid from studentterms where scholastic_status = 1 and aysem = 20172 group by studentid";
    $result = mysqli_query($conn, $query);
    $nonpaying = mysqli_num_rows($result);
    $query = "select studentid from studentterms where scholastic_status = 2 and aysem = 20172 group by studentid";
    $result = mysqli_query($conn, $query);
    $paying = mysqli_num_rows($result);
    $query = "select studentid from studentterms where scholastic_status = 3 and aysem = 20172 group by studentid";
    $result = mysqli_query($conn, $query);
    $nonpaying_paying = mysqli_num_rows($result);
?>
<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Required meta tags always come first -->
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>PLM Curriculum Checker</title>
    <link rel="shortcut icon" href="lib/plmlogo.png" />
    <link href="lib/compiled.min.css" rel="stylesheet">
    <link rel="stylesheet" href="lib/semantic/semantic.min.css">
    <!-- Bootstrap core CSS -->
    <script src="lib/sweetalert2/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="lib/sweetalert2/sweetalert2.min.css">
    <script src="lib/jquery-3.2.1.js"></script>
    <style>
        /* Extra small devices (phones, 600px and down) */
        @media only screen and (max-width: 600px) {
            .chart-container { 
                width:93vw;
            }
        } 

        /* Small devices (portrait tablets and large phones, 600px and up) */
        @media only screen and (min-width: 600px) {
            .chart-container { 
                width:93vw;
            }
        } 

        /* Medium devices (landscape tablets, 768px and up) */
        @media only screen and (min-width: 768px) {
            .chart-container { 
                width:93vw;
            }
        } 

        /* Large devices (laptops/desktops, 992px and up) */
        @media only screen and (min-width: 992px) {
            .chart-container { 
                width:40vw; margin-left: 1vw; float: left;
            }
            .chart-container1 { 
                width:90vw;
            }
        } 

        /* Extra large devices (large laptops and desktops, 1200px and up) */
        @media only screen and (min-width: 1200px) {
            .chart-container { 
                width:40vw; margin-left: 1vw; float: left;
            }
            .chart-container1 { 
                width:90vw;
            }
        }
        /* Extra large devices (large laptops and desktops, 1200px and up) */
        @media only screen and (min-width: 1440px) {
            .chart-container { 
                width:33.5vw; margin-left: 1vw; float: left;
            }
            .chart-container1 { 
                width:90vw;
            }
        }
    </style>
</head>

<body class="fixed-sn light-blue-skin" onload="hello();">
    <div style="width:100%; height: 60px; background-color: #01579B;"><center><img src="lib/plmlogo.png" width="50px" style="margin: 5px;"></center></div>
    <!-- <div id="particles-js" style="height: 91vh;"></div> -->
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
        <div class="container-fluid mt-4">
            <!-- START -->
            <h3>Dashboard</h3>
            <div class="chart-container">
                <canvas id="canvas1" style="margin-bottom: 15px;"></canvas>
            </div>
            <div class="chart-container">
                <canvas id="canvas2" style="margin-bottom: 15px;"></canvas>
            </div>
            <div class="chart-container">
                <canvas id="barChart1" style="margin-bottom: 15px;"></canvas>
            </div>
            <div class="chart-container">
                <canvas id="barChart2" style="margin-bottom: 15px;"></canvas>
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
    <script src="lib/js/Chart.min.js"></script>
    <script>
        // CHART 1
        var canvas = document.getElementById("barChart1");
        var ctx = canvas.getContext('2d');

        // Data with datasets options
        var data = {
            labels: ["Graduating", "Non Graduating"],
            datasets: [
                {
                    label: "Graduating Students",
                    backgroundColor: [
                        '#C51162',
                        '#E65100'],
                    data: [1000, 650]
                }
            ]
        };

        // Notice how nested the beginAtZero is
        var options = {
                title: {
                        display: true,
                        text: 'Students',
                        position: 'top'
                    },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
        };

        // Chart declaration:
        var myBarChart = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: options
        });

        // CHART 2
        var canvas = document.getElementById("barChart2");
        var ctx = canvas.getContext('2d');

        // Global Options:
        Chart.defaults.global.defaultFontColor = 'dodgerblue';
        Chart.defaults.global.defaultFontSize = 16;


        // Data with datasets options
        var data = {
            labels: ["Approved", "Submitted", "Rejected"],
            datasets: [
                {
                    label: "Approved",
                    fill: true,
                    backgroundColor: [
                        '#00C853',
                        '#006064',
                        '#F50057'],
                    data: [28, 69, 35]
                }
            ]
        };

        // Notice how nested the beginAtZero is
        var options = {
                title: {
                        display: true,
                        text: 'Study Plan',
                        position: 'top'
                    },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
        };

        // Chart declaration:
        var myBarChart = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: options
        });

        // DOUGHNUT DIAGRAM 1
        var options = {
            // legend: false,
            responsive: false
        };
        new Chart($("#canvas1"), {
            type: 'doughnut',
            tooltipFillColor: "rgba(51, 51, 51, 0.55)",
            data: {
            labels: [
                "Regular",
                "Irregular",
                "Faculty"
            ],
            datasets: [{
            data: [<?php echo $regular . ',' . $irregular . ',' . $faculty; ?>],
            backgroundColor: [
                "#3498DB",
                "#9B59B6",
                "#E74C3C"
            ],
            hoverBackgroundColor: [
                "#49A9EA",
                "#B370CF",
                "#E95E4F"
            ]
            }]
        },
            options: {}
        });
               
        // DOUGHNUT DIAGRAM 2
        var options = {
            // legend: false,
            responsive: false
        };
        new Chart($("#canvas2"), {
            type: 'doughnut',
            tooltipFillColor: "rgba(51, 51, 51, 0.55)",
            data: {
            labels: [
                "Non-Paying",
                "Non-Paying Paying",
                "Paying"
            ],
            datasets: [{
            data: [<?php echo $nonpaying . ',' . $nonpaying_paying . ',' . $paying; ?>],
            backgroundColor: [
                "#33691E",
                "#0D47A1",
                "#4E342E"
            ],
            hoverBackgroundColor: [
                "#33691E",
                "#0D47A1",
                "#4E342E"
            ]
            }]
        },
            options: {}
        });           
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