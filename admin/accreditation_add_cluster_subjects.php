<?php include('connect.php'); ?>
<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Required meta tags always come first -->    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Material Design Bootstrap Template</title>
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
<body class="fixed-sn light-blue-skin">
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
                        <li><a href="generate_graduating_students.php" class="collapsible-header waves-effect arrow-r">Generate Graduating Students</a></li>
                        <li><a href="graduating_class.php" class="collapsible-header waves-effect arrow-r">Graduating Class</a></li>
                        <li><a href="students_curriculum.php" class="collapsible-header waves-effect arrow-r">Student Details</a></li>
                        <li><a href="students_deficiency.php" class="collapsible-header waves-effect arrow-r">Students with Deficiency</a></li>
                        <li><a class="collapsible-header waves-effect arrow-r">Utilities</a>
                            <div class="collapsible-body">
                                    <ul>
                                        <li><a href="add_news.php" class="waves-effect">Add News</a></li>
                                        <li><a href="add_calender.php" class="waves-effect">Add Calendar</a></li>
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
        <div class="container-fluid mt-4" style="margin-top: 0; padding-top: 0; top: 0; width: 100%; margin-left: 0;">
            <!-- START -->
                <div class="ui container">
                    <?php
                        $subjectid = $_GET['id'];
                        $_SESSION['accreditation_subjectid'] = $subjectid;
                        $curriculumid = $_SESSION['curriculumid'];
                        $query = "select clusterid1, curriculumid, curricula1.subjectid, subject, subjecttitle, curricula1.credits from curricula1 join subjects on subjects.subjectid = curricula1.subjectid where curricula1.subjectid = '$subjectid' and curriculumid = '$curriculumid' LIMIT 1";
                        $result = mysqli_query($conn, $query);
                        $row = mysqli_fetch_array($result);

                        echo '  <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="accreditation.php">Accreditation</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">'.$row['curriculumid'].' - '.$row['subject'].'</li>
                                    </ol>
                                </nav>';
                        echo '<h3 style="color: #2962FF; margin-top: 25px;">'.$row['subjecttitle'];
                        echo '<h5 style="margin: 20px 0;">Cluster Subject(s):</h5>';
                        echo '  <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">ID</th>
                                            <th scope="col">Code</th>
                                            <th scope="col">Title</th>
                                            <th scope="col">Units</th>
                                        </tr>
                                    </thead>
                                    <tbody>';

                        $cluster_subject = explode(', ', $row['clusterid1']);
                        
                        for($i=0; $i<count($cluster_subject); $i++)
                        {
                            $query = "SELECT * FROM subjects WHERE subjectid = '$cluster_subject[$i]'";
                            $result = mysqli_query($conn, $query);
                            $row = mysqli_fetch_array($result);
                            echo'<tr>
                                    <th scope="row">'.($i + 1).'</th>
                                    <td>'.$row['subjectid'].'</td>
                                    <td>'.$row['subject'].'</td>
                                    <td>'.$row['subjecttitle'].'</td>
                                    <td>'.$row['credits'].'</td>
                                </tr>';
                        }

                        echo '</tbody></table>';
                        echo '<h5 style="margin: 10px 0;">Subject Code: </h5>';
                        echo '<input type="text" id="subject_code" placeholder="Enter the subject code..">';
                        echo '<center><button class="ui blue button" id="submit_button" style="margin-top: 15px;">Submit</button></center>';
                        echo '<div id="output"></div>';
                        echo '<center><button class="ui pink button add_cluster_button" id="add_cluster_subject" style="margin-bottom: 20px;">Add Cluster Subject</button></center>';
                    ?>
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
        // SideNav Initialization
        $(".button-collapse").sideNav();
    </script><div class="drag-target" style="left: 0px; touch-action: pan-y; user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></div>
<div class="hiddendiv common"></div></body></html>
    <script>
        function error(title, type){
            $.bootstrapGrowl(title, {
            ele: 'body', // which element to append to
            type: type, // (null, 'info', 'danger', 'success')
            offset: {from: 'top', amount: 20}, // 'top', or 'bottom'
            align: 'right', // ('left', 'right', or 'center')
            width: 190, // (integer, or 'auto')
            delay: 5000, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
            allow_dismiss: true, // If true then will display a cross to close the popup.
            stackup_spacing: 10 // spacing between consecutively stacked growls.
            });
        }
    </script>
<script>
    $(document).ready(function() {
        $('select').material_select();
    });
</script>
<script>
    $('#add_cluster_subject').hide();
    $("#subject_code").keyup(function(event) {
        if (event.keyCode === 13)
            $("#submit_button").click();
    });
    $('.button').click(function(){
        var subjectcode = $('#subject_code').val();
        $.ajax({
            url:"accreditation_add_cluster_subjects_ajax.php",
            type:"POST",
            data:{
                subject_code:subjectcode
            },
            dataType:"json",
            success:function(data){  
                console.log(data);
                if(data == 'error')
                    error('Invalid subject code..','danger');
                else
                {
                    var output = '<table class="table table-striped" style="margin-top: 5px;"><thead><tr><th scope="col">ID</th><th scope="col">Code</th><th scope="col">Title</th><th scope="col">Units</th></tr></thead><tbody>';
                    output += '<tr><td>' + data[0] + '</td><td>' + data[1] + '</td><td>' + data[2] + '</td><td>' + data[3] + '</td></tr></tbody></table>';
                    $('#output').html(output);
                    $('#add_cluster_subject').show();
                }
            }
        });
    });
    $('#add_cluster_subject').click(function(){
        $.ajax({
            url:"accreditation_add_cluster_subjects_addtodatabase.php",
            method:"POST",
            data:{},
            success:function(data){  
                location.reload();
            }
        });
    });
</script>