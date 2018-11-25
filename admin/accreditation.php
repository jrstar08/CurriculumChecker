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
            #accreditation_table {
                text-align: center;
            }
        } 
        /* Small devices (portrait tablets and large phones, 600px and up) */
        @media only screen and (min-width: 600px) {
            #accreditation_table {
                text-align: center;
            }
        } 
        /* Medium devices (landscape tablets, 768px and up) */
        @media only screen and (min-width: 768px) {
            #accreditation_table {
                text-align: center;
            }
        } 
        /* Large devices (laptops/desktops, 992px and up) */
        @media only screen and (min-width: 992px) {
            #accreditation_table {
                text-align: center;
            }
        } 
        /* Extra large devices (large laptops and desktops, 1200px and up) */
        @media only screen and (min-width: 1200px) {
            #accreditation_table {
                text-align: center;
            }
        }
        .modal-dialog {
            min-height: calc(100vh - 60px);
            display: flex;
            flex-direction: column;
            justify-content: center;
            overflow: auto;
        }
        @media(max-width: 768px) {
            .modal-dialog {
                min-height: calc(100vh - 20px);
            }
        }    
        .cdk-overlay-container {
            z-index:1127;
        }
        .md-select-menu-container {
  z-index: 101;
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
        <div class="container-fluid mt-4" style="margin-top: 0; padding-top: 0; top: 0; width: 100%; margin-left: 0;">
            <!-- START -->
                <div class="ui container">
                    <h3>Accreditation</h3>
                    <select id="curriculumid">
                        <option value="">Search curriculum</option>
                        <?php
                            include ('connect.php');
                            $query = "select curriculumid, program, curriculum from curricula1 join programs on programs.programid = curricula1.programid group by curriculumid";
                            $result = mysqli_query($conn, $query);
                            while($row = mysqli_fetch_row($result))
                                echo '<option value="'.$row[0].'">'.$row[1].' ['.$row[2].']</option>';
                        ?>
                    </select>
                    <div id="output" style="height: 69.5vh; overflow: auto;"></div>
                </div>        
            <!-- END -->
        </div> 
    </main>
    <!--Main Layout-->
    
    <div class="modal edit fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        </div>
        <div class="modal-footer">
          <!-- <button type="button" class="btn btn-secondary" id="save">Save</button> -->
          <!-- <button type="button" class="btn btn-success" id="add_cluster_subject">Add Cluster Subject</button> -->
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
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
    $("#curriculumid").change(function() {
        var curriculumid = $("#curriculumid").val();
        if(curriculumid != '')
        {
            $.ajax({
                url:"accreditation_display_subjects.php",
                method:"POST",
                data:{
                    curriculumid:curriculumid
                },
                success:function(data){  
                    $("#output").html(data);
                }
            });
        }
        else
            alert('Select curriculum id');
    });
</script>
<script>
    $(document).ready(function() {
        $('select').material_select();
    });
</script>