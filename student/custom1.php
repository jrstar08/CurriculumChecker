<?php
    include ('connect.php');
    include ('custom_reset.php');
    
    $studentid=$_SESSION['studentid']; $registrationcode = $_SESSION['registrationcode']; $firstname = $_SESSION['firstname']; $lastname = $_SESSION['lastname']; $entryaysem = $_SESSION['entryaysem']; $aysem = $_SESSION['aysem'];
    $query8 = "select aysem from studentterms where studentid='$studentid' order by aysem desc limit 1";
    $result8 = mysqli_query($conn, $query8);
    $aysem = mysqli_fetch_row($result8);
    $aysem = $aysem[0];

    $query8 = "SELECT count(*), studyplanid FROM studyplan_approval where studentid = '$studentid' and aysem = '$aysem' and active = 1";
    $result8 = mysqli_query($conn, $query8);
    $row8 = mysqli_fetch_row($result8);
    $is_there_a_studyplan = $row8[0];
    $_SESSION['studyplanid'] = $row8[1];
?>

<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Required meta tags always come first -->
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>PLM-CRS: Curriculum Checker</title>
    <link rel="shortcut icon" href="lib/plmlogo.png" />
    <link rel="stylesheet" href="lib/semantic/semantic.min.css">
    <!-- Bootstrap core CSS -->
    <link href="lib/compiled.min.css" rel="stylesheet">
    <script src="lib/sweetalert2/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="lib/sweetalert2/sweetalert2.min.css">
</head>

<body class="fixed-sn light-blue-skin" onload="notification(); custom();">
    <div style="width:100%; height: 60px; background-color: rgb(138, 8, 8);"><center><img src="lib/plmlogo.png" width="50px" style="margin: 5px;"></center></div>
        
    <!--Double navigation-->
    <header>
        <!-- Sidebar navigation -->
        <div id="slide-out" class="side-nav sn-bg-4 fixed mdb-sidenav" style="transform: translateX(-100%); background: none; background-color: #B71C1C;">
            <ul class="custom-scrollbar list-unstyled" style="max-height:100vh;">
                <!-- NAVIGATION -->
                <h2 style="margin: 15% 20px;"><img src="lib/student.png" style="width: 50px; margin-right: 15px;"><?php echo 'Student';?></h2>                <!-- Side navigation links -->
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
        <div class="container-fluid mt-5" style="margin-top: 0; padding-top: 0; top: 0; width: 100%; margin-left: 0;">
            <!-- START -->
            <h2>Select subject:</h2>
            <table id="example1" class="ui table">
                <thead>
                    <tr>
                    <th name="name" data-notnull="true">Name</th>
                    <th name="registrationDate">Registration Date</th>
                    <th name="email">E-mail address</th>
                    <th name="plan" data-notnull="true">Premium Plan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr id="1">
                    <td>John Lilki</td>
                    <td data-type="<a href="https://www.jqueryscript.net/time-clock/">date</a>">2013-09-14</td>
                    <td data-type="email">jhlilk22@yahoo.com</td>
                    <td data-type="checkbox" data-checked="Yes" data-unchecked="No">No</td>
                    </tr>
                    <tr id="2">
                    <td>Jamie Harington</td>
                    <td data-type="date">2014-01-11</td>
                    <td data-type="email">jamieharingonton@yahoo.com</td>
                    <td data-type="checkbox" data-checked="Yes" data-unchecked="No">Yes</td>
                    </tr>
                    <tr id="3">
                    <td>Jill Lewis</td>
                    <td data-type="date">2014-11-03</td>
                    <td data-type="email">jilsewris22@yahoo.com</td>
                    <td data-type="checkbox" data-checked="Yes" data-unchecked="No">Yes</td>
                    </tr>
                </tbody>
            </table>
            <!-- END -->
        </div> 
    </main>
    <!--Main Layout-->
    
    <!-- SCRIPTS -->
    <!-- JQuery -->
    <script src="lib/jquery-3.2.1.js"></script>
    <script src="lib/sweetalert2/sweetalert2.all.js"></script>
    <script src="lib/semantic/semantic.min.js"></script>
    <script src="lib/jquery.editableRecord.js"></script>
    <script type="text/javascript" src="lib/compiled.min.js"></script>
    <script src="lib/jquery.bootstrap-growl.js"></script>
    <script>
        $(function(){
            $('#example1').editableRecord({
                idName: 'Id',
                saveUrl:'./example.json',
                deleteUrl: './example.json',
                detailButtonClicked: function(){
                    alert("clicked");
                }
            });
        });
    </script>
    <script>
        function success(){
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#2196F3',
                cancelButtonColor: '#F44336',
                confirmButtonText: 'Yes!'
            }).then((result) => {
                if (result.value) {
                    swal(
                        'Submitted!',
                        'Please wait for the approval',
                        'success'
                    ).then((result) => {
                        setTimeout(function() {
                            location="home.php";
                        }, 300);
                    })

                    $.ajax({  
                        url:"preferred_insert.php",  
                        method:"POST",  
                        data: {},
                        success:function(data){}  
                    });
                }
            })
        }
    </script>
    <script>
        function regular(){
            swal({
                title: 'Oops ...',
                text: "Only irregular students have access to this page",
                type: 'warning'
            }).then((result) => {
                        setTimeout(function() {
                            location="home.php";
                        }, 300);
            })
        }
    </script>
    <script>
        function notification(){
            $.bootstrapGrowl("You chose custom study plan", {
            ele: 'body', // which element to append to
            type: 'success', // (null, 'info', 'danger', 'success')
            offset: {from: 'top', amount: 20}, // 'top', or 'bottom'
            align: 'right', // ('left', 'right', or 'center')
            width: 270, // (integer, or 'auto')
            delay: 6500, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
            allow_dismiss: true, // If true then will display a cross to close the popup.
            stackup_spacing: 10 // spacing between consecutively stacked growls.
            });
        }
        function custom(){
            setTimeout(function() {
                $.bootstrapGrowl("Custom is a custom study plan", {
                ele: 'body', // which element to append to
                type: 'info', // (null, 'info', 'danger', 'success')
                offset: {from: 'top', amount: 20}, // 'top', or 'bottom'
                align: 'right', // ('left', 'right', or 'center')
                width: 320, // (integer, or 'auto')
                delay: 7000, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
                allow_dismiss: true, // If true then will display a cross to close the popup.
                stackup_spacing: 10 // spacing between consecutively stacked growls.
                });
            }, 2000);
        }
    </script>

    <script>
        
        // SideNav Initialization
        $(".button-collapse").sideNav();
        
    </script><div class="drag-target" style="left: 0px; touch-action: pan-y; user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></div>

<div class="hiddendiv common"></div></body></html>

<!-- ERROR TRAPPING -->
<script>
    function is_there_a_studyplan(){
        swal({
            title: "Already created a Study Plan",
            text: "Would you like to edit your study plan or return to home page?",
            type: 'error',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, edit my study plan!',
            cancelButtonText: 'Return to home!',
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: false,
            reverseButtons: false
            }).then((result) => {
            if (result.value) {
                swal(
                'Edit Study Plan',
                '',
                'success'
                ).then((result) => {
                    location = 'edit_page.php';
                });
            } else {
                swal(
                'Returning to Home Page',
                '',
                'success'
                ).then((result) => {
                    location = 'home.php';
                });
            }
        })
    }    
</script>

<script>
    var counter = <?php echo $is_there_a_studyplan; ?>;
    
    if(counter > 0)
        is_there_a_studyplan();
</script>