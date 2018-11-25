<?php 
    include ('connect.php'); 
?>
<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Required meta tags always come first -->    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>PLM Curriculum Checker</title>
    <link rel="shortcut icon" href="lib/plmlogo.png" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="lib/material.cyan-blue.min.css" /> 
    <script defer src="lib/material.min.js"></script>
    <link rel="stylesheet" href="lib/semantic/semantic.min.css">
    <!-- Bootstrap core CSS -->
    <link href="lib/compiled.min.css" rel="stylesheet">
    <script src="lib/sweetalert2/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="lib/sweetalert2/sweetalert2.min.css">
    <script src="lib/jquery-3.2.1.js"></script>
</head>

<body class="fixed-sn light-blue-skin" onload="hello();">
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
        <div class="container-fluid mt-4" style="margin-top: 0; padding-top: 0; top: 0; width: 100%; margin-left: 0;">
            <!-- START -->
                <div class="ui container">
                    <h2 class="text-center" style="margin-bottom: 10px">Generate Tentative Students</h2>
                    <div class="col-lg-8 float-left">
                        <select id="programid">
                            <option value="">Search program</option>
                            <option value="999999">All</option>
                            <?php
                                $query = "select curricula1.programid, program, programtitle from curricula1 join programs on programs.programid = curricula1.programid group by curricula1.programid";
                                $result = mysqli_query($conn, $query);
                                
                                while($row = mysqli_fetch_row($result))
                                    echo '<option value="'.$row[0].'">'.$row[1].' ['.$row[2].']</option>';
                            ?>
                        </select>
                    </div>
                    <div class="col-lg-2 float-left">
                        <select id="aysem">
                            <option value="">Search AYSEM</option>
                            <option value="20172">20172</option>
                            <option value="20171">20171</option>
                            <option value="20163">20163</option>
                            <option value="20162">20162</option>
                            <option value="20161">20161</option>
                        </select>
                    </div>
                    <!-- <div class="col-lg-2 float-left">
                        <select id="limit">
                            <option value="">Select Limit</option>
                            <option value="1">1 Student</option>
                            <option value="2">2 Students</option>
                            <option value="3">3 Students</option>
                            <option value="4">4 Students</option>
                            <option value="5">5 Students</option>
                            <option value="10">10 Students</option>
                            <option value="20">20 Students</option>
                            <option value="30">30 Students</option>
                            <option value="99999">All Students</option>
                        </select>
                    </div> -->
                    <div class="col-sm-12 col-lg-2 float-left" style="margin-top: 10px;">
                        <center><button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" id="program_submit">Submit</button></center>
                    </div>
            
                    <div style="clear: both"></div>
            
                    <div id="p2" class="mdl-progress mdl-js-progress mdl-progress__indeterminate" style="width: 46%; float: left; margin-top: 15px"></div>
                    <div id="loading_value" style="width: 8%; margin-top: 5px; float: left; font-weight: 550; text-align: center; font-size: 120%;">0%</div>
                    <div id="p3" class="mdl-progress mdl-js-progress mdl-progress__indeterminate" style="width: 46%; float: left; margin-top: 15px"></div>
                    
                    <div id="output" style="width: 100%; overflow: auto; margin-top: 15px; font-size: 90%; height: 65vh;"></div>
                </div>        
            <!-- END -->
        </div> 
    </main>
    <!--Main Layout-->
    
    <!-- SCRIPTS -->
    <!-- JQuery -->
    <script src="lib/jquery-3.2.1.js"></script>
    <script>
        $('#p2').hide();
        $('#loading_value').hide();
        $('#p3').hide();
    </script>
    <script src="lib/semantic/semantic.min.js"></script>
    <script type="text/javascript" src="lib/compiled.min.js"></script>
    <script src="lib/jquery.bootstrap-growl.js"></script>
    <script src="lib/sweetalert2/sweetalert2.all.js"></script>
    <script>
        function hello(){
            $.bootstrapGrowl("Select program, aysem, limit ..", {
            ele: 'body', // which element to append to
            type: 'info', // (null, 'info', 'danger', 'success')
            offset: {from: 'top', amount: 20}, // 'top', or 'bottom'
            align: 'right', // ('left', 'right', or 'center')
            width: 240, // (integer, or 'auto')
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
    $("#program_submit").click(function() {
        var programid = $("#programid").val();
        console.log(programid);
        var aysem = $("#aysem").val();
        var limit = 999999;
        if(programid != '' && aysem != '' && limit != '')
        {
            $('#output').html('');
            $('#p2').show();
            $('#loading_value').show();
            $('#p3').show();
            $.ajax({
                url:"generate-getallstudents.php",
                type:"POST",
                data:{
                    programid:programid,
                    aysem:aysem
                },
                dataType:"json",
                success:function(data){
                    var students_id = data;
                    console.log(programid);
                    var counter = 0;
                    for(var i=0; i<students_id.length; i++)
                    {
                        $.ajax({
                            url:"generate.php",
                            type:"POST",
                            async: true,
                            data: {
                                student_id:students_id[i],
                                limit:limit,
                                aysem:aysem
                            },
                            success:function(data){
                                var div = document.getElementById('output');
                                div.innerHTML += data;
                                div.scrollTop = div.scrollHeight;
                                
                                // console.log(counter++);
                                $('#loading_value').html((( ( ++counter / students_id.length ) * 100).toFixed(2) + '%'));
                            }
                        });

                        // $('#loading_value').html((( ( i / students_id.length ) * 100) + '%').toFixed(2));
                    }
                }
            });
            
            $(document).ajaxStop(function() {
                $('#p2').hide();
                $('#loading_value').hide();
                $('#p3').hide();
            });
        }
        else if(programid == '')
            alert('Select program id');
        else if(aysem == '')
            alert('Select aysem');
        else
            alert('Select limit');
    });
</script>
<script>
    $(document).ready(function() {
        $('select').material_select();
    });
</script>