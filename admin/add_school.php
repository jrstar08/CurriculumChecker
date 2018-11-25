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
        /* Extra small devices (phones, 600px and down) */
        @media only screen and (max-width: 600px) {
            #school_table {
                text-align: center;
            }
        } 
        /* Small devices (portrait tablets and large phones, 600px and up) */
        @media only screen and (min-width: 600px) {
            #school_table {
                text-align: center;
            }
        } 
        /* Medium devices (landscape tablets, 768px and up) */
        @media only screen and (min-width: 768px) {
            #school_table {
                text-align: center;
            }
        } 
        /* Large devices (laptops/desktops, 992px and up) */
        @media only screen and (min-width: 992px) {
            #school_table {
                text-align: center;
            }
        } 
        /* Extra large devices (large laptops and desktops, 1200px and up) */
        @media only screen and (min-width: 1200px) {
            #school_table {
                text-align: center;
            }
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
                <div class="ui container">
                    <h3 style="text-align: center;">List of Schools</h3>
                    <div id="output" style="margin: 15px;">
                        <table class="ui striped table" id="school_table">
                            <thead>
                                <tr>
                                    <th>School ID</th>
                                    <th>School Name</th>
                                    <th>School Code</th>
                                    <th>School Address</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $query = "select * from schools";
                                    $result = mysqli_query($conn, $query);
                                    while($row = mysqli_fetch_array($result))
                                    {
                                        echo '<tr>';
                                            echo '<td>'.$row["school_id"].'</td>';
                                            echo '<td>'.$row["school_name"].'</td>';
                                            echo '<td>'.$row["school_code"].'</td>';
                                            echo '<td>'.$row["address"].'</td>';
                                            echo '<td>';
                                                echo '<button class="ui blue button edit" id="edit_'.$row["school_id"].'"><img src="lib/edit.png" style="width: 15px;"></button>';
                                                echo '<button class="ui red button delete" id="delete_'.$row["school_id"].'"><img src="lib/delete.png" style="width: 15px;"></button>';
                                            echo '</td>';
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- Colored FAB button with ripple -->
                    <button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored" id="add_button" style="position: absolute; bottom: 60px; left: 47.5vw; background: #212121; position: fixed;">
                        <i class="material-icons">add</i>
                    </button>
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
    });
</script>
<script>
    function add_buttonn(){
        var school_name = $('#add_school_name').val();
        var school_code = $('#add_school_code').val();
        var school_address = $('#add_school_address').val();

        if(school_name == '' || school_code == '' || school_address == '')
            swal('Please complete all the details','','warning');
        else
        {
            $.ajax({
                url:"add_school_add.php",
                method:"POST",
                data:{
                    school_name:school_name,
                    school_code:school_code,
                    school_address:school_address
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
    }
    function edit_buttonn(school_id){
        var school_name = $('#edit_school_name').val();
        var school_code = $('#edit_school_code').val();
        var school_address = $('#edit_school_address').val();

        if(school_name == '' || school_code == '' || school_address == '')
            swal('Please complete all the details','','warning');
        else
        {
            $.ajax({
                url:"add_school_edit.php",
                method:"POST",
                data:{
                    type:"UPDATE_DATAS",
                    school_name:school_name,
                    school_code:school_code,
                    school_address:school_address,
                    school_id:school_id
                },
                success:function(data){  
                    if(data == 'SUCCESS!')
                        swal('Successfully Changed!','','success').then((result) => {
                            if (result.value)
                                location.reload();
                        })
                    else
                        swal('Database: Inserting Error','','error');
                }
            });
        }
    }
    function delete_buttonn(school_id){
        $.ajax({
            url:"add_school_delete.php",
            method:"POST",
            data:{
                type:"DELETE_DATAS",
                school_id:school_id
            },
            success:function(data){  
                if(data == 'SUCCESS!')
                    swal('Successfully Deleted!','','success').then((result) => {
                        if (result.value)
                            location.reload();
                    })
                else
                    swal('Database: Deleting Error','','error');
            }
        });
    }
</script>
<script>
    $('#add_button').click(function(){
        var output = '';
        // Breadcrumbs
        output += '<nav aria-label="breadcrumb"><ol class="breadcrumb"><li class="breadcrumb-item"><a href="add_school.php">School Table</a></li><li class="breadcrumb-item active" aria-current="page">Add School</li></ol></nav>';
        // Text Fields
        output += '<h5 style="margin-top: 15px">School name:</h5><input id="add_school_name" type="text">';
        output += '<h5 style="margin-top: 15px">School code:</h5><input id="add_school_code" type="text">';
        output += '<h5 style="margin-top: 15px">School address:</h5><input id="add_school_address" type="text">';
        output += '<center><button class="ui blue button" id="add_buttonn" onclick="add_buttonn()" style="margin-top: 15px;">Add</button></center>';
        $('#output').html(output);
    });
    $('.edit').click(function(){
        var output = '';
        var id = this.id.split('_');
        school_id = id[1];
        // Breadcrumbs
        output += '<nav aria-label="breadcrumb"><ol class="breadcrumb"><li class="breadcrumb-item"><a href="add_school.php">School Table</a></li><li class="breadcrumb-item active" aria-current="page">Edit School</li></ol></nav>';
        // AJAX FOR REQUESTING THE EDIT DATAS
        $.ajax({
            url:"add_school_edit.php",
            method:"POST",
            data:{
                type: "INITIAL_VALUE",
                school_id: school_id
            },
            success:function(data){
                var school = data.split('|');
                // Text Fields
                output += '<h5 style="margin-top: 15px">School name:</h5><input id="edit_school_name" type="text" value="' + school[0] + '">';
                output += '<h5 style="margin-top: 15px">School code:</h5><input id="edit_school_code" type="text" value="' + school[1] + '">';
                output += '<h5 style="margin-top: 15px">School address:</h5><input id="edit_school_address" type="text" value="' + school[2] + '">';;
                output += '<center><button class="ui blue button" id="edit_button" style="margin-top: 15px;" onclick="edit_buttonn(school_id)">Edit</button></center>';
                $('#output').html(output);
            }
        });
    });
    $('.delete').click(function(){
        var output = '';
        var id = this.id.split('_');
        school_id = id[1];
        // Breadcrumbs
        output += '<nav aria-label="breadcrumb"><ol class="breadcrumb"><li class="breadcrumb-item"><a href="add_school.php">School Table</a></li><li class="breadcrumb-item active" aria-current="page">Delete School</li></ol></nav>';
        // AJAX FOR REQUESTING THE EDIT DATAS
        $.ajax({
            url:"add_school_delete.php",
            method:"POST",
            data:{
                type: "INITIAL_VALUE",
                school_id: school_id
            },
            success:function(data){
                var school = data.split('|');
                console.log(school);
                // CARD
                output += '<div class="ui cards centered"><div class="card"><div class="content"><div class="right floated mini ui image" style="font-size: 110%;">#' + school_id + '</div><div class="header">' + school[0] + '</div><div class="meta">' + school[1] + '</div><div class="description" style="margin-bottom: 0;">' + school[2] + '</div></div><div class="extra content"><div class="ui two buttons"><div class="ui red button" onclick="delete_buttonn(school_id)">Delete</div></div></div></div></div>';
                $('#output').html(output);
            }
        });
    });
</script>