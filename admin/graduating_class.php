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

<body class="fixed-sn light-blue-skin" onload="">
    <div style="width:100%; height: 60px; background-color: #01579B;"><center><img src="lib/plmlogo.png" width="50px" style="margin: 5px;"></center></div>
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
                    <h2 style="text-align: center">Sort By:</h2><br>
                    <!-- FIRST FILTER -->
                    <div class="btn-group" data-toggle="buttons" style="width: 100%" id="filter1">
                        <label class="btn btn-blue form-check-label" style="width: 50%">
                            <input class="form-check-input" type="radio" autocomplete="off" value="all" name="filter1"> ALL STUDENT
                        </label>
                        <label class="btn btn-blue form-check-label" style="width: 50%">
                            <input class="form-check-input" type="radio" autocomplete="off" value="per_student" name="filter1"> PER COLLEGE
                        </label>
                    </div>
                    <!-- SECOND FILTER -->
                    <div id="filter2">
                        <!--Blue select-->
                        <select class="mdb-select colorful-select dropdown-primary" id="per_college">
                        <?php
                            include ('connect.php');
                            $query = "select units.unitid, units.unit from studentterms join units on units.unitid = studentterms.unitid group by unitid";
                            $result = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_row($result))
                                echo '<option value="'.$row[0].'">'.$row[1].'</option>';
                        ?>
                        </select>
                        <!--/Blue select-->
                    </div>
                    <!-- THIRD FILTER -->
                    <div class="btn-group" data-toggle="buttons" style="width: 100%;" id="filter3">
                        <label class="btn btn-blue form-check-label" style="width: 50%" id="all_college">
                            <input class="form-check-input" type="radio" autocomplete="off" name="filter3" value="all_college">ALL
                        </label>
                        <label class="btn btn-blue form-check-label" style="width: 50%">
                            <input class="form-check-input" type="radio" autocomplete="off" name="filter3" value="per_course"> PER COURSE
                        </label>
                    </div>
                    <!-- FOURTH FILTER -->
                    <div id="filter4"></div>

                    <!-- SUBMIT -->
                    <center><br><button class="btn btn-blue" id="submitt">SUBMIT</button></center>
                    
                    <div id="output"></div>
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
    <script>$(".button-collapse").sideNav();</script>
    <script>
        $(document).ready(function() {
            $('select').material_select();
        });
    </script>
    <!-- <script>alert('he1');</script> -->
    <script>
        var query = 'SELECT graduating_students.studentid, name, program, units.unit, graduating_students.aysem FROM graduating_students join students on graduating_students.studentid=students.studentid join studentterms on studentterms.studentid = graduating_students.studentid join programs on programs.programid = studentterms.programid join units on units.unitid = studentterms.unitid';
        var college = '';
        var course = '';

        $('#filter2').hide();
        $('#filter3').hide();
        $('#filter4').hide();

        $('input[type=radio][name=filter1]').change(function(){
            if(this.value == 'all'){
                college = "";
                course = "";
                $('#filter2').hide();
                $('#filter3').hide();
                $('#filter4').hide();
            }
            else{
                college = "";
                course = "";
                $('#filter2').show();
                $('#filter3').hide();
                $('#filter4').hide();
            }
        });

        $('#per_college').change(function(){
            $.ajax({
                url:"filter_ajax.php",
                method:"POST",
                data:{
                    unitid: $('#per_college').val()
                },
                success:function(data){
                    $("#filter4").html(data);
                }
            });
            $('#filter2').show();
            $('#filter3').show();
            $('#filter4').hide();
            college = ' where units.unitid = '+this.value;
            course = "";
            
            $('input[type=radio][name=filter3]').change(function(){
                if(this.value == 'all_college'){
                    course = "";         
                    $('#filter2').show();
                    $('#filter3').show();
                    $('#filter4').hide();
                }
                else{
                    course = "";
                    $('#filter2').show();
                    $('#filter3').show();
                    $('#filter4').show();
                }
            });
        });
    </script>
    <script>
        $('#submitt').click(function(){
            location="graduating_class_filtered.php?query="+query+college+course;
        });
    </script>
    <div class="drag-target" style="left: 0px; touch-action: pan-y; user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></div>

<div class="hiddendiv common"></div></body></html>