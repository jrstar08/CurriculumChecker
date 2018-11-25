<?php
include('connect.php'); 

$query8 = "update studyplan_template set current_year = 0, current_sem = 0 where curriculumid = 200933";
$result8 = mysqli_query($conn, $query8);

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
<link rel="stylesheet" type="text/css" href="lib/calendar/demo/css/semantic.ui.min.css">
<link rel="stylesheet" type="text/css" href="lib/calendar/demo/css/prism.css"/>
<link rel="stylesheet" type="text/css" href="lib/calendar/demo/css/calendar-style.css"/>
<link rel="stylesheet" type="text/css" href="lib/calendar/demo/css/style.css"/>
<link rel="stylesheet" type="text/css" href="lib/calendar/dist/css/pignose.calendar.min.css"/>
<link rel="stylesheet" href="lib/semantic/semantic.min.css">
<!-- Bootstrap core CSS -->
<link href="lib/compiled.min.css" rel="stylesheet">

<script src="lib/sweetalert2/sweetalert2.min.js"></script>
<link rel="stylesheet" href="lib/sweetalert2/sweetalert2.min.css">
<script src="lib/jquery-3.2.1.js"></script>
<style>
    /* ---- reset ---- */ body{ margin:0; font:normal 75% Arial, Helvetica, sans-serif; } canvas{ display: block; vertical-align: bottom; } /* ---- particles.js container ---- */ #particles-js{ position:absolute; width: 100%; height: 100%; background-color: #ffffff; background-image: url(""); background-repeat: no-repeat; background-size: cover; background-position: 50% 50%; } /* ---- stats.js ---- */ .count-particles{ background: #000022; position: absolute; top: 48px; left: 0; width: 80px; color: #13E8E9; font-size: .8em; text-align: left; text-indent: 4px; line-height: 14px; padding-bottom: 2px; font-family: Helvetica, Arial, sans-serif; font-weight: bold; } .js-count-particles{ font-size: 1.1em; } #stats, .count-particles{ -webkit-user-select: none; margin-top: 5px; margin-left: 5px; } #stats{ border-radius: 3px 3px 0 0; overflow: hidden; } .count-particles{ border-radius: 0 0 3px 3px; }
</style>
</head>

<body class="fixed-sn light-blue-skin" onload="hello();">


<div style="width:100%; height: 60px; background-color: rgb(138, 8, 8);"><center><img src="lib/plmlogo.png" width="50px" style="margin: 5px;"></center></div>
<div id="particles-js"></div>     
<!--Double navigation-->
<header>
    <!-- Sidebar navigation -->
    <div id="slide-out" class="side-nav sn-bg-4 fixed mdb-sidenav" style="transform: translateX(-100%); background: none; background-color: #B71C1C;">
        <ul class="custom-scrollbar list-unstyled" style="max-height:100vh;">
            <!-- NAVIGATION -->
            <h2 style="margin: 15% 20px;"><img src="lib/student.png" style="width: 50px; margin-right: 15px;"><?php echo 'Student';?></h2>
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
        <!-- START -->
        <div class="ui link cards" style="margin-top: 0; padding-top: 0; top: 0; float: left; margin-right: 60px; margin-bottom: 20px; width: 264px" onclick="show_profile_picture();">
                <div class="card" style="width: 100%">
                  <div class="image">
                    <img src="lib/<?php echo $filename; ?>" style="width: 250px; height: 220px">
                  </div>
                  <div class="content">
                    <div class="header"><?php echo $firstname . ' ' . $lastname; ?></div>
                    <div class="meta">
                      <a><center>Student</center></a>
                    </div>
                    <div class="description"><br>
                      <?php echo $firstname; ?> is a student in Pamantasan ng Lungsod ng Maynila.
                    </div>
                  </div>
                  <div class="extra content">
                    <span class="right floated">
                      Joined in <?php echo $entryaysem; ?>
                    </span>
                    <span>
                        <?php echo $course; ?>
                    </span>
                  </div>
                </div>               
              </div>

                <div class="ui card" style="margin: 0; top: 10px; padding: 0; width: 280px; height: 495px; float: left; margin-right: 5px; margin-bottom: 20px;">
                    <div class="content" style="padding: 25px 20px;">
                        <div class="header" style="color: #B71C1C">Student's Information</div>
                    </div>
                    <div class="content">
                        <div class="ui small feed">
                            <div class="event">
                                <div class="content">
                                <div class="summary">
                                    Student ID: <?php echo $studentid; ?>
                                </div>
                                </div>
                            </div>
                            <div class="event">
                                <div class="content">
                                <div class="summary">
                                    Last Name: <?php echo $lastname; ?>
                                </div>
                                </div>
                            </div>
                            <div class="event">
                                <div class="content">
                                <div class="summary">
                                    First Name: <?php echo $firstname; ?>
                                </div>
                                </div>
                            </div>
                            <div class="event">
                                <div class="content">
                                <div class="summary">
                                    Middle Name: <?php echo $middlename; ?>
                                </div>
                                </div>
                            </div>
                            <div class="event">
                                <div class="content">
                                <div class="summary">
                                    Gender: <?php echo $gender; ?>
                                </div>
                                </div>
                            </div>
                            <div class="event">
                                <div class="content">
                                <div class="summary">
                                    Student Type: <?php echo $studenttype; ?>
                                </div>
                                </div>
                            </div>
                            <div class="event">
                                <div class="content">
                                <div class="summary">
                                    Registration Code: <?php echo $registrationcode; ?>
                                </div>
                                </div>
                            </div>
                            <div class="event">
                                <div class="content">
                                <div class="summary">
                                    Scholastic Status: <?php echo $label; ?>
                                </div>
                                </div>
                            </div>
                            <div class="event">
                                <div class="content">
                                <div class="summary">
                                    Graduating: <?php echo $graduating; ?>
                                </div>
                                </div>
                            </div>
                            <div class="event">
                                <div class="content">
                                <div class="summary">
                                    Year Level: <?php echo $yearlevel; ?>
                                </div>
                                </div>
                            </div>
                        
                            <div class="event">
                                <div class="content">
                                <div class="summary">
                                    Degree Course: Bachelor of Science in Computer Studies - Major in Information Technology
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="ui card" style="margin: 0; top: 10px; padding: 0; float: left; left: 0; margin-right: 0px; margin-bottom: 20px; height: 400px; width: 550px; box-shadow: none;">
                    <div class="calendar" style="left: 0; margin: 0; height: 400px; clear: both"></div>
                    <div role="tabpanel" class="ui tab segment" data-tab="javascript-basic">
                        <pre><code class="language-js">$(function() {
                            $('.calendar').pignoseCalendar();
                            });
                        </code></pre>
                    </div>
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
            title: '<?php echo $firstname . ' ' . $lastname; ?>',
            text: 'Student',
            imageUrl: 'lib/<?php echo $filename; ?>',
            imageWidth: 400,
            imageHeight: 400,
            imageAlt: 'Custom image',
            animation: true
          })
    }
    function show_profile_picture1(){
        swal({
            title: 'Wanna change your profile picture?',
            imageUrl: 'lib/john.jpg',
            imageWidth: 400,
            imageHeight: 400,
            imageAlt: 'Custom image',
            animation: true,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, I want to change!',
            input: 'file',
            inputAttributes: {
                'accept': 'image/*',
                'aria-label': 'Upload your profile picture'
            }
            }).then((result) => {
                var reader = new FileReader
                reader
                            
          })
    }
</script>
<script>
    function hello(){
        $.bootstrapGrowl("HELLO <?php echo $firstname; ?>!", {
        ele: 'body', // which element to append to
        type: 'info', // (null, 'info', 'danger', 'success')
        offset: {from: 'top', amount: 20}, // 'top', or 'bottom'
        align: 'right', // ('left', 'right', or 'center')
        width: 220, // (integer, or 'auto')
        delay: 5000, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
        allow_dismiss: true, // If true then will display a cross to close the popup.
        stackup_spacing: 10 // spacing between consecutively stacked growls.
        });
    }
    function howsyourday(){
        setTimeout(function() {
            $.bootstrapGrowl("How's your day?", {
            ele: 'body', // which element to append to
            type: 'success', // (null, 'info', 'danger', 'success')
            offset: {from: 'top', amount: 20}, // 'top', or 'bottom'
            align: 'right', // ('left', 'right', or 'center')
            width: 180, // (integer, or 'auto')
            delay: 4000, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
            allow_dismiss: true, // If true then will display a cross to close the popup.
            stackup_spacing: 10 // spacing between consecutively stacked growls.
            });
        }, 2000);
    }
    function dontworry(){
        setTimeout(function() {
            $.bootstrapGrowl("Don't worry, It's okay!", {
            ele: 'body', // which element to append to
            type: 'info', // (null, 'info', 'danger', 'success')
            offset: {from: 'top', amount: 20}, // 'top', or 'bottom'
            align: 'right', // ('left', 'right', or 'center')
            width: 200, // (integer, or 'auto')
            delay: 4000, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
            allow_dismiss: true, // If true then will display a cross to close the popup.
            stackup_spacing: 10 // spacing between consecutively stacked growls.
            });
            }, 7000);
        }
    function cheerup(){
        setTimeout(function() {
            $.bootstrapGrowl("Cheer Up! :))", {
            ele: 'body', // which element to append to
            type: 'success', // (null, 'info', 'danger', 'success')
            offset: {from: 'top', amount: 20}, // 'top', or 'bottom'
            align: 'right', // ('left', 'right', or 'center')
            width: 200, // (integer, or 'auto')
            delay: 4000, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
            allow_dismiss: true, // If true then will display a cross to close the popup.
            stackup_spacing: 10 // spacing between consecutively stacked growls.
            });
        }, 8500);
    }
</script>
<script>
    
    // SideNav Initialization
    $(".button-collapse").sideNav();

</script><div class="drag-target" style="left: 0px; touch-action: pan-y; user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></div>

<div class="hiddendiv common"></div></body></html>

<script type="text/javascript" src="lib/calendar/demo/js/jquery.latest.min.js"></script>
<script type="text/javascript" src="lib/calendar/demo/js/semantic.ui.min.js"></script>
<script type="text/javascript" src="lib/calendar/demo/js/prism.min.js"></script>
<script type="text/javascript" src="lib/calendar/dist/js/pignose.calendar.full.min.js"></script>
<script type="text/javascript">
//<![CDATA[
$(function () {
    $('#wrapper .version strong').text('v' + $.fn.pignoseCalendar.version);

    function onSelectHandler(date, context) {
        /**
         * @date is an array which be included dates(clicked date at first index)
         * @context is an object which stored calendar interal data.
         * @context.calendar is a root element reference.
         * @context.calendar is a calendar element reference.
         * @context.storage.activeDates is all toggled data, If you use toggle type calendar.
         * @context.storage.events is all events associated to this date
         */

        var $element = context.element;
        var $calendar = context.calendar;
        var $box = $element.siblings('.box').show();
        var text = 'You selected date ';

        if (date[0] !== null) {
            text += date[0].format('YYYY-MM-DD');
        }

        if (date[0] !== null && date[1] !== null) {
            text += ' ~ ';
        }
        else if (date[0] === null && date[1] == null) {
            text += 'nothing';
        }

        if (date[1] !== null) {
            text += date[1].format('YYYY-MM-DD');
        }

        $box.text(text);
    }

    function onApplyHandler(date, context) {
        /**
         * @date is an array which be included dates(clicked date at first index)
         * @context is an object which stored calendar interal data.
         * @context.calendar is a root element reference.
         * @context.calendar is a calendar element reference.
         * @context.storage.activeDates is all toggled data, If you use toggle type calendar.
         * @context.storage.events is all events associated to this date
         */

        var $element = context.element;
        var $calendar = context.calendar;
        var $box = $element.siblings('.box').show();
        var text = 'You applied date ';

        if (date[0] !== null) {
            text += date[0].format('YYYY-MM-DD');
        }

        if (date[0] !== null && date[1] !== null) {
            text += ' ~ ';
        }
        else if (date[0] === null && date[1] == null) {
            text += 'nothing';
        }

        if (date[1] !== null) {
            text += date[1].format('YYYY-MM-DD');
        }

        $box.text(text);
    }

    // Schedule Calendar
    $('.calendar').pignoseCalendar({
        theme: 'blue',
        scheduleOptions: {
            colors: {
                Mema: '#2fabb7',
                Valentines: '#E91E63',
                DBMSChecking: '#ef8080',
                AppDevDefense: '#009688'
            }
        },
        schedules: [{
            name: 'Mema',
            date: '2018-02-02'
        }, {
            name: 'Valentines',
            date: '2018-02-14'
        }, {
            name: 'AppDevDefense',
            date: '2018-02-24'
        }
        , {
            name: 'DBMSChecking',
            date: '2018-02-23'
        }],
        select: function (date, context) {
            var date = date[0].format('MMMM DD, YYYY');
            var message = "[" + date + "] Event(s) for this day: ";

            for (var idx in context.storage.schedules) {
                var schedule = context.storage.schedules[idx];
                var a = schedule.name;

                if (typeof schedule !== 'object') {
                    continue;
                }
            }

            alert(message+a);
        }
    });
// 
});
//]]>
</script>
<script src="http://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
<script>
particlesJS("particles-js", {"particles":{"number":{"value":80,"density":{"enable":true,"value_area":800}},"color":{"value":"#cd1e1e"},"shape":{"type":"star","stroke":{"width":0,"color":"#000000"},"polygon":{"nb_sides":5},"image":{"src":"img/github.svg","width":100,"height":100}},"opacity":{"value":0.5,"random":false,"anim":{"enable":false,"speed":1,"opacity_min":0.1,"sync":false}},"size":{"value":3,"random":true,"anim":{"enable":false,"speed":40,"size_min":0.1,"sync":false}},"line_linked":{"enable":true,"distance":150,"color":"#b71c1c","opacity":0.4,"width":1},"move":{"enable":true,"speed":6,"direction":"none","random":false,"straight":false,"out_mode":"out","bounce":false,"attract":{"enable":false,"rotateX":600,"rotateY":1200}}},"interactivity":{"detect_on":"canvas","events":{"onhover":{"enable":true,"mode":"repulse"},"onclick":{"enable":true,"mode":"push"},"resize":true},"modes":{"grab":{"distance":400,"line_linked":{"opacity":1}},"bubble":{"distance":400,"size":40,"duration":2,"opacity":8,"speed":3},"repulse":{"distance":200,"duration":0.4},"push":{"particles_nb":4},"remove":{"particles_nb":2}}},"retina_detect":true});var count_particles, stats, update; stats = new Stats; stats.setMode(0); stats.domElement.style.position = 'absolute'; stats.domElement.style.left = '0px'; stats.domElement.style.top = '0px'; document.body.appendChild(stats.domElement); count_particles = document.querySelector('.js-count-particles'); update = function() { stats.begin(); stats.end(); if (window.pJSDom[0].pJS.particles && window.pJSDom[0].pJS.particles.array) { count_particles.innerText = window.pJSDom[0].pJS.particles.array.length; } requestAnimationFrame(update); }; requestAnimationFrame(update);
</script>