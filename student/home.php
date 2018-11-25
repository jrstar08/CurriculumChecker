<?php
    include('connect.php'); 
    include('custom_reset.php');
    include('custom_shared_functions.php');

    $_SESSION['curriculum_subjects'] = fetch_all_subjects($conn);

    $username = $_SESSION['username'];
    $password = $_SESSION['password'];
    $query = "SELECT studentid FROM users WHERE login='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_row($result);
    $studentid = $row[0];
    $_SESSION['studentid'] = $studentid;

    $query = "select students.lastname, students.firstname, students.middlename, gender, studenttype, registrationcode, label, yearlevel, programtitle, program, aysem, entryaysem, filename from studentterms join students on students.studentid = studentterms.studentid join programs on programs.programid = studentterms.programid join scholasticstatus on scholasticstatus.scholasticid = scholastic_status join profile_picture on profile_picture.accountid = studentterms.studentid WHERE studentterms.studentid = '$studentid' order by aysem desc limit 1";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_row($result);

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
    $semester = substr($aysem, -1);
    $_SESSION['aysem'] = $aysem;

    if((($yearlevel==4 and $semester>=2) || ($yearlevel>4)) && (isset($_SESSION['graduating_status']) == NULL))
    {
        header('location: tagging_loader.php');
        $graduating = $_SESSION['graduating_status']; // FROM TAGGING_CHECKING.php
    }
    else
        $graduating = 'NON GRADUATING';

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
    $_SESSION['entryaysem'] = $entryaysem;
    $_SESSION['filename'] = $filename;
    $_SESSION['active_custom'] = true;
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
        #studentinfo{
            font-family: 'roboto';
            padding: 0px 20px;
            text-transform: uppercase;
            line-height: 1.4;
        }
        #announcement a{
            color: white;
            line-height: 1.7;
            font-family: 'roboto';
        }
    </style>
    <style>
        /* ---- reset ---- */ body{ margin:0; font:normal 75% Arial, Helvetica, sans-serif; } canvas{ display: block; vertical-align: bottom; } /* ---- particles.js container ---- */ #particles-js{ position:absolute; width: 100%; height: 100%; background-color: #ffffff; background-image: url(""); background-repeat: no-repeat; background-size: cover; background-position: 50% 50%; } /* ---- stats.js ---- */ .count-particles{ background: #000022; position: absolute; top: 48px; left: 0; width: 80px; color: #13E8E9; font-size: .8em; text-align: left; text-indent: 4px; line-height: 14px; padding-bottom: 2px; font-family: Helvetica, Arial, sans-serif; font-weight: bold; } .js-count-particles{ font-size: 1.1em; } #stats, .count-particles{ -webkit-user-select: none; margin-top: 5px; margin-left: 5px; } #stats{ border-radius: 3px 3px 0 0; overflow: hidden; } .count-particles{ border-radius: 0 0 3px 3px; }
    </style>
</head>

<body class="fixed-sn light-blue-skin" onload="hello();">
    

    <div style="width:100%; height: 60px; background-color: rgb(138, 8, 8);"><center><img src="lib/plmlogo.png" width="50px" style="margin: 5px;"></center></div>
    <div id="particles-js" style="height: 90vh;"></div>     
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
                        <li><a href="curriculum.php" class="collapsible-header waves-effect arrow-r">Study Plan</a></li>
                        <li><a href="checklist.php" class="collapsible-header waves-effect arrow-r">Checklist</a></li>
                        <li><a href="prospectus.php" class="collapsible-header waves-effect arrow-r">Prospectus</a></li>                        
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
        <div class="container-fluid mt-5" style="margin-top: 0; padding-top: 0; top: 0; width: 200%; margin-left: 0;">
            <!-- START -->
            <div class="ui card" style="width: 270px; height: 455px; float: left; margin-right: 40px;">
                <div class="ui slide masked reveal image">
                    <img src="lib/student-avatar.png" class="visible content" style="width: 100%; height: 280px;">
                    <img src="lib/<?php echo $filename; ?>" class="hidden content" style="width: 100%; height: 280px;">
                </div>
                <div class="content">
                <!-- <p class="lead center bold" style="font-size: 12px;">IT STUDENT</p> -->
                    <p class="lead center bold" style="padding: 5px; font-weight: 540;"><?php echo $firstname . ' ' . $lastname; ?></p>
                    <!-- <p class="center" style="font-size: 12px;">STUDENT</p> -->
                    <hr>
                    <p class="center" style="font-size: 14px; padding: 5px; text-align: justify; text-justify: inter-word;">A student in Pamantasan ng Lungsod ng Maynila taking Bachelor of Science in Computer Studies - Major in Information Technology.</p>
                </div>
            </div>

            <div class="ui cards" style="top: 0; float: left; height: 500px; margin-right: 0px;">
                <div class="card" style="width: 500px; height: 255px; background: #E91E63;">
                    <div class="content" style="font-size: 115%; word-spacing: 1px; letter-spacing: 1px;">
                    <div class="header" style="color: white; padding: 10px 0;">Student's Information</div>
                        <!-- <hr style="color: white; background: white"> -->
                        <div class="description" style="color: white;">
                            <div id="studentinfo">
                                <table width="100%">
                                    <tbody>
                                        <tr>
                                            <td width="50%" style="text-align: right; padding-right: 10px;">Student ID</td>
                                            <td width="50%"><?php echo $studentid; ?></td>
                                        </tr>
                                        <tr>
                                            <td width="35%" style="text-align: right; padding-right: 10px;">Last Name</td>
                                            <td width="65%"><?php echo $lastname; ?></td>
                                        </tr>
                                        <tr>
                                            <td width="35%" style="text-align: right; padding-right: 10px;">First Name</td>
                                            <td width="65%"><?php echo $firstname; ?></td>
                                        </tr>
                                        <tr>
                                            <td width="35%" style="text-align: right; padding-right: 10px;">Middle Name</td>
                                            <td width="65%"><?php echo $middlename; ?></td>
                                        </tr>
                                        <tr>
                                            <td width="35%" style="text-align: right; padding-right: 10px;">Gender</td>
                                            <td width="65%"><?php echo $gender; ?></td>
                                        </tr>
                                        <tr>
                                            <td width="35%" style="text-align: right; padding-right: 10px;">Student Type</td>
                                            <td width="65%"><?php echo $studenttype; ?></td>
                                        </tr>
                                        <tr>
                                            <td width="35%" style="text-align: right; padding-right: 10px;">Registration Code</td>
                                            <td width="65%"><?php echo $registrationcode; ?></td>
                                        </tr>
                                        <tr>
                                            <td width="35%" style="text-align: right; padding-right: 10px;">Scholastic Status</td>
                                            <td width="65%"><?php echo $label; ?></td>
                                        </tr>
                                        <tr>
                                            <td width="35%" style="text-align: right; padding-right: 10px;">Graduating Status</td>
                                            <td width="65%"><?php echo $graduating; ?></td>
                                        </tr>
                                        <tr>
                                            <td width="35%" style="text-align: right; padding-right: 10px;">Course Code</td>
                                            <td width="65%"><?php echo 'BSCS-IT'; ?></td>
                                        </tr>
                                        <tr>
                                            <td width="35%" style="text-align: right; padding-right: 10px;">Year Level</td>
                                            <td width="65%"><?php echo $yearlevel; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card" style="width: 500px; height: 185px; background: #673AB7; position: absolute; top: 410px;">
                    <div class="content" style="font-size: 120%">
                    <div class="header" style="color: white; padding: 10px 0;">Announcements</div>
                        <!-- <hr style="color: white; background: white"> -->
                        <div class="description" id="announcement" style="color: white; overflow: auto; height: 135px;">
                        <!-- <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>aaaaaaaaaa<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br> -->
                            <center>
                                <a class="announcement" id="ENROLLMENT">ENROLLMENT</a><br>
                                <a class="announcement" id="ELECTION">ELECTION</a><br>
                                <a class="announcement" id="CET">CET WEEK</a><br>
                                <a class="announcement" id="CS">CS WEEK</a><br>
                                <a class="announcement" id="CHASS">CHASS WEEK</a><br>
                                <a class="announcement" id="CED">CED WEEK</a><br>
                                <a class="announcement" id="CN">CN WEEK</a><br>
                                <a class="announcement" id="CBGM">CBGM WEEK</a><br>
                                <br>
                            </center>
                        </div>
                    </div>
                </div>
            </div>



            <div class="ui card" style="margin: 0; top: 0px; padding: 0; float: left; left: 0; margin-right: 0px; height: 500px; width: 350px; box-shadow: none;">
                <div class="calendar" style="left: 0; margin: 0; padding: 0; height: 500px; clear: both"></div>
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
        function calendar_event(message, date){
            swal(
                date,
                message,
                'success'
              )
        }
        function announcement(title){
            swal(
                title,
                'Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae, ex maiores debitis nisi, dignissimos ipsa repudiandae architecto officiis voluptatibus exercitationem quas consequatur, rem et incidunt reiciendis at minima voluptatum tenetur.',
                ''
              )
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
                    EndOfClasses: '#2fabb7',
                    Valentines: '#E91E63',
                    DBMSChecking: '#ef8080',
                    AppDevDefense: '#009688',
                    FinalExaminations: '#4caf50',
                    EndOfChristmasVacation: '#9c27b0',
                    StartOfClasses: '#f44336',
                    StartOfClasses: '#c51162',
                    StartOfOJT: '#7c4dff',
                    HappyNewYear: '#9c98ff'
                }
            },
            schedules: [
                {
                    name: 'EndOfClasses',
                    date: '2018-03-24'
                }, {
                    name: 'Valentines',
                    date: '2018-02-14'
                }, {
                    name: 'AppDevDefense',
                    date: '2018-02-24'
                }, {
                    name: 'DBMSChecking',
                    date: '2018-02-23'
                }, {
                    name: 'FinalExaminations',
                    date: '2018-03-12'
                }, {
                    name: 'FinalExaminations',
                    date: '2018-03-13'
                }, {
                    name: 'FinalExaminations',
                    date: '2018-03-14'
                }, {
                    name: 'FinalExaminations',
                    date: '2018-03-15'
                }, {
                    name: 'FinalExaminations',
                    date: '2018-03-16'
                }, {
                    name: 'FinalExaminations',
                    date: '2018-03-17'
                }, {
                    name: 'StartOfOJT',
                    date: '2018-04-12'
                }, {
                    name: 'StartOfClasses',
                    date: '2018-03-03'
                }, {
                    name: 'EndOfChristmasVacation',
                    date: '2018-01-02'
                }, {
                    name: 'HappyNewYear',
                    date: '2018-01-01'
                }, {
                    name: 'DBMSChecking',
                    date: '2018-02-23'
                }
            ],
            select: function (date, context) {
                var date = date[0].format('MMMM DD, YYYY');
                var message = "Event(s) for this day: ";

                for (var idx in context.storage.schedules) {
                    var schedule = context.storage.schedules[idx];
                    var a = schedule.name;

                    if (typeof schedule !== 'object') {
                        continue;
                    }
                }

                // alert(message+a);
                if(a == undefined)
                    a = 'none';
                calendar_event(message+a, date);
            }
        });
// 
    });
    //]]>
</script>

<script>
    $('.announcement').click(function(){
        // alert(this.id);
        announcement(this.id);
    })
</script>

<script src="lib/particles.min.js"></script>
<script>
    particlesJS("particles-js", {"particles":{"number":{"value":80,"density":{"enable":true,"value_area":800}},"color":{"value":"#cd1e1e"},"shape":{"type":"star","stroke":{"width":0,"color":"#000000"},"polygon":{"nb_sides":5},"image":{"src":"img/github.svg","width":100,"height":100}},"opacity":{"value":0.5,"random":false,"anim":{"enable":false,"speed":1,"opacity_min":0.1,"sync":false}},"size":{"value":3,"random":true,"anim":{"enable":false,"speed":40,"size_min":0.1,"sync":false}},"line_linked":{"enable":true,"distance":150,"color":"#b71c1c","opacity":0.4,"width":1},"move":{"enable":true,"speed":6,"direction":"none","random":false,"straight":false,"out_mode":"out","bounce":false,"attract":{"enable":false,"rotateX":600,"rotateY":1200}}},"interactivity":{"detect_on":"canvas","events":{"onhover":{"enable":true,"mode":"repulse"},"onclick":{"enable":true,"mode":"push"},"resize":true},"modes":{"grab":{"distance":400,"line_linked":{"opacity":1}},"bubble":{"distance":400,"size":40,"duration":2,"opacity":8,"speed":3},"repulse":{"distance":200,"duration":0.4},"push":{"particles_nb":4},"remove":{"particles_nb":2}}},"retina_detect":true});var count_particles, stats, update; stats = new Stats; stats.setMode(0); stats.domElement.style.position = 'absolute'; stats.domElement.style.left = '0px'; stats.domElement.style.top = '0px'; document.body.appendChild(stats.domElement); count_particles = document.querySelector('.js-count-particles'); update = function() { stats.begin(); stats.end(); if (window.pJSDom[0].pJS.particles && window.pJSDom[0].pJS.particles.array) { count_particles.innerText = window.pJSDom[0].pJS.particles.array.length; } requestAnimationFrame(update); }; requestAnimationFrame(update);
</script>