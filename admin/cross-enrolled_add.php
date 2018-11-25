<?php include ('connect.php'); ?>
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
    <style>
        img {
            pointer-events: none;
        }
    </style>
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
                        <li><a href="generate_graduating_students.php" class="collapsible-header waves-effect arrow-r">Generate Graduating Students</a></li>
                        <li><a href="graduating_class.php" class="collapsible-header waves-effect arrow-r">Graduating Class</a></li>
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
                <div class="ui container">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="cross-enrolled.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">ADD COMPLETION GRADE</li>
                        </ol>
                    </nav>
                        
                    <h5 style="margin-top: 15px">Student ID:</h5>
                    <input id="student_id" type="text" placeholder="Please enter the Student No..">
                    
                    <h5 style="margin-top: 15px">Equivalent Subject:</h5>
                    <input id="subject_id" type="text" placeholder="Please enter the Subject Code..">
                    
                    <h5 style="margin-top: 15px">Grade Status:</h5>
                    <select id="grade_status">
                        <option value="" selected disabled>Please select the Status of Grade</option>
                        <option value="P">Passed</option>
                        <option value="I">Incomplete</option>
                    </select>

                    <div class="final_grade">
                        <h5 style="margin-top: 15px">Final Grade:</h5>
                        <select id="final_grade">
                            <option value="" selected disabled>Please select the Grade</option>
                            <option value="1.00">1.00</option>
                            <option value="1.25">1.25</option>
                            <option value="1.50">1.50</option>
                            <option value="1.75">1.75</option>
                            <option value="2.00">2.00</option>
                            <option value="2.25">2.25</option>
                            <option value="2.50">2.50</option>
                            <option value="2.75">2.75</option>
                            <option value="3.00">3.00</option>
                        </select>
                    </div>

                    <div class="completion_grade">
                        <h5 style="margin-top: 15px">Completion Grade:</h5>
                        <select id="completion_grade">
                            <option value="" selected disabled>Please select the Grade</option>
                            <option value="1.00">1.00</option>
                            <option value="1.25">1.25</option>
                            <option value="1.50">1.50</option>
                            <option value="1.75">1.75</option>
                            <option value="2.00">2.00</option>
                            <option value="2.25">2.25</option>
                            <option value="2.50">2.50</option>
                            <option value="2.75">2.75</option>
                            <option value="3.00">3.00</option>
                        </select>
                    </div>

                    <h5 style="margin-top: 15px">Subject Code (From other School)</h5>
                    <input id="subject_code" type="text" placeholder="Please enter the Subject Code">
                    
                    <h5 style="margin-top: 15px">AYSEM:</h5>
                    <select id="aysem">
                        <option value="" selected disabled>Please select the AYSEM</option>
                        <option value="20181">20181</option>
                        <option value="20173">20173</option>
                        <option value="20172">20172</option>
                        <option value="20171">20171</option>
                        <option value="20163">20163</option>
                        <option value="20162">20162</option>
                        <option value="20161">20161</option>
                        <option value="20153">20153</option>
                        <option value="20152">20152</option>
                        <option value="20151">20151</option>
                    </select>
                    
                    <h5 style="margin-top: 15px">School:</h5>
                    <select id="school">
                        <option value="" selected disabled>Please select the School</option>
                        <?php
                            $query = "SELECT school_id, school_name from schools";
                            $result = mysqli_query($conn, $query);
                            while($row = mysqli_fetch_row($result))
                                echo '<option value="'.$row[0].'">'.$row[1].'</option>';
                        ?>
                    </select>
                    
                    <center>
                        <button class="ui blue button" id="add_button" style="margin-top: 10px;">Add</button>
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
        $('.final_grade').hide();
        $('.completion_grade').hide();
    });
</script>
<script>
    $('#grade_status').change(function(){
        if(this.value == 'P'){
            $('.completion_grade').hide();
            $('.final_grade').show();
        }
        else{
            $('.final_grade').hide();
            $('.completion_grade').show();
        }
    });
</script>
<script>
    $('#add_button').click(function(){
        var student_id = $('#student_id').val();
        var subject_id = $('#subject_id').val();
        var grade_status = $('#grade_status').val();
        var final_grade = $('#final_grade').val();
        var completion_grade = $('#completion_grade').val();
        var subject_code = $('#subject_code').val();
        var aysem = $('#aysem').val();
        var school = $('#school').val();

        if(student_id == '' || subject_id == '' || grade_status == null || subject_code == '' || aysem == null || school == null || (final_grade == null && completion_grade == null))
            swal('Please complete all the details','','warning');
        else
        {
            $.ajax({
                url:"cross-enrolled_insert.php",
                method:"POST",
                data:{
                    student_id:student_id,
                    subject_id:subject_id,
                    grade_status:grade_status,
                    subject_code:subject_code,
                    aysem:aysem,
                    school:school,
                    final_grade:final_grade,
                    completion_grade:completion_grade
                },
                success:function(data){  
                    if(data == 'SUCCESS!')
                    {
                        swal('Successfully Added!','','success').then((result) => {
                            if (result.value)
                                location.reload();
                        })
                    }
                    else
                        swal('Database: Inserting Error','','error');
                }
            });
        }
    });
</script>