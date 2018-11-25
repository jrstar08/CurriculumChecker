<?php
include('connect.php'); 

$username = $_SESSION['username'];
$password = $_SESSION['password'];
$query = "SELECT studentid FROM users WHERE login='$username' AND password='$password'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_row($result);
$studentid = $row[0];

$query = "select students.lastname, students.firstname, students.middlename, gender, studenttype, registrationcode, label, yearlevel, programtitle, program, aysem, entryaysem, filename from studentterms join students on students.studentid = studentterms.studentid join programs on programs.programid = studentterms.programid join scholasticstatus on scholasticstatus.scholasticid = scholastic_status join profile_picture on profile_picture.accountid = studentterms.studentid WHERE studentterms.studentid = '$studentid' order by aysem desc limit 1";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_row($result);

$query = "select * from graduating_students where studentid = '$studentid'";
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result)>0)
    $graduating = 'YES';
else
    $graduating = 'NO';

$lastname = $row[0];
$firstname = $row[1];
$middlename = $row[2];
$gender = $row[3];
$studenttype= $row[4];
$registrationcode = $row[5];
$label = $row[6];
$yearlevel = $row[7];
$programtitle = $row[8];
$course = $row[9];
$aysem = $row[10];
$entryaysem = $row[11];
$filename = $row[12];

if($gender == 'M')
    $gender = 'MALE';
else 
    $gender = 'FEMALE';

if($registrationcode == 'R')
    $registrationcode = "REGULAR";
else
    $registrationcode = "IRREGULAR";

if($studenttype == 'O')
    $studenttype = "OLD";
else if($studenttype == 'N')
    $studenttype = 'NEW';
else
    $studenttype = "TRANSFEREE";

$_SESSION['studentid'] = $studentid;
$_SESSION['lastname'] = $lastname;
$_SESSION['firstname'] = $firstname;
$_SESSION['middlename'] = $middlename;
$_SESSION['gender'] = $gender;
$_SESSION['studenttype'] = $studenttype;
$_SESSION['registrationcode'] = $registrationcode;
$_SESSION['label'] = $label;
$_SESSION['yearlevel'] = $yearlevel;
$_SESSION['programtitle'] = $programtitle;
$_SESSION['course'] = $course;
$_SESSION['aysem'] = $aysem;
$_SESSION['entryaysem'] = $entryaysem;
$_SESSION['filename'] = $filename;

?>
<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<!-- Required meta tags always come first -->

<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<title>PLM-CRS: Curriculum Checker</title>
<link rel="shortcut icon" href="lib/plmlogo.png" />
<link rel="stylesheet" href="lib/material.indigo-pink.min.css">
<script defer src="lib/material.min.js"></script>
<link rel="stylesheet" href="lib/semantic/semantic.min.css">
<!-- Bootstrap core CSS -->
<link rel="stylesheet" href="lib/mdb.css">
<link href="lib/compiled.min.css" rel="stylesheet">
<script src="lib/sweetalert2/sweetalert2.min.js"></script>
<link rel="stylesheet" href="lib/sweetalert2/sweetalert2.min.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<script src="lib/jquery-3.2.1.js"></script>
</head>

<body class="fixed-sn light-blue-skin">
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
                    <li><a href="logout.php" class="collapsible-header waves-effect arrow-r"><b>Logout</b></a></li>
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
    </nav>
    <!-- /.Navbar -->
</header>
<!--/.Double navigation-->
<!--Main Layout-->
<main style="margin-top: 0; padding-top: 0; top: 0;">
    <div class="container-fluid mt-5" style="margin-top: 0; padding-top: 0; top: 0; width: 100%; margin-left: 0;">
        <!-- START-->
        <h2>asd</h2>
        <select id="thedropdown">
    <option value="1">one</option>
    <option value="2">two</option>
  </select>
        <div style="margin-left: 40.7%; top: 85vh; position:fixed;">
            <button id="add" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
                <i class="material-icons">+</i>
            </button>
        </div>

        <div id="output"></div>
        <div id="output1"></div>


        <!-- END -->
    </div> 
</main>
<!--Main Layout-->

<!-- SCRIPTS -->
<!-- JQuery -->
<script src="lib/jquery-3.2.1.js"></script>
<script src="lib/semantic/semantic.min.js"></script>
<script src="lib/jquery.bootstrap-growl.js"></script>
<script src="lib/sweetalert2/sweetalert2.all.js"></script>
<script type="text/javascript" src="lib/compiled.min.js"></script>
<script src="lib/mdb.js"></script>
<script>
    function fetch(){
        $.ajax({  
            url:"custom_fetch.php",  
            method:"POST",  
            data: {
            },
            success:function(data){  
                $("#output").html(data);
            }  
        });  
    }
    function insert(){
        $.ajax({  
            url:"custom_insert.php",  
            method:"POST",  
            data: {
            },
            success:function(data){
                $("#output1").html(data);
            }  
        }); 
    }
</script>
<script>
    $(document).ready(function() {
        fetch();
        $("#add").click(function(){
            insert();
        });
    });
</script>
<script>
    
    // SideNav Initialization
    $(".button-collapse").sideNav();

</script><div class="drag-target" style="left: 0px; touch-action: pan-y; user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></div>

<div class="hiddendiv common"></div></body></html>