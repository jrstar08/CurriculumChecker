<?php include ('connect.php'); $studentid=201502586; $firstname = $_SESSION['firstname']; $lastname = $_SESSION['lastname']; ?>
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
    <script src="lib/jquery-3.2.1.js"></script>
</head>

<body class="fixed-sn light-blue-skin" onload="hello();">
    <div style="width:100%; height: 60px; background-color: #263238;"><center><img src="lib/plmlogo.png" width="50px" style="margin: 5px;"></center></div>
        
    <!--Double navigation-->
    <header>
        <!-- Sidebar navigation -->
        <div id="slide-out" class="side-nav sn-bg-4 fixed mdb-sidenav" style="transform: translateX(-100%); background: none; background-color: #37474F;">
            <ul class="custom-scrollbar list-unstyled" style="max-height:100vh;">
                <!-- NAVIGATION -->
                <h2 style="margin: 15% 20px;"><img src="lib/adviser.png" style="width: 50px; margin-right: 15px;"><?php echo 'Adviser';?></h2>
                <!-- Side navigation links -->
                <li>
                    <ul class="collapsible collapsible-accordion">
                        <li><a href="home.php" class="collapsible-header waves-effect arrow-r">Home</a></li>
                        <li><a href="approval.php" class="collapsible-header waves-effect arrow-r">Approval of Study Plan</a></li>
                        <li><a href="summary.php" class="collapsible-header waves-effect arrow-r">Reports</a></li>
                        <li><a href="logout.php" class="collapsible-header waves-effect arrow-r"><b>Logout</b></a></li>
                    </ul>
                </li>
                <!--/. Side navigation links -->
            </ul>
        </div>
        <!--/. Sidebar navigation -->
        <!-- Navbar -->
        <nav class="navbar navbar-toggleable-md navbar-expand-lg scrolling-navbar double-nav" style="background: #37474F;">
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
            <?php
                $query = "select studyplanid, filename, studyplan_approval.studentid, name, yearlevel, program, date_approved from studyplan_approval join profile_picture on profile_picture.accountid = studyplan_approval.studentid join students on students.studentid = studyplan_approval.studentid join studentterms on students.studentid = studentterms.studentid join programs on programs.programid = studentterms.programid where studentterms.aysem = 20172 and approve = 1 order by studyplanid desc";
                $result = mysqli_query($conn, $query);
                if(mysqli_num_rows($result)>0)
                {
                    $no_record = false;
            ?>
            <h3>STUDY PLANS IN 20172</h3>
            <table class="table table-hover table-inverse">
                <thead style="background: #37474F; color: #fff">
                    <tr>
                    <th wdith="5%"></th>
                    <th wdith="15%">Student ID</th>
                    <th wdith="35%">Student Name</th>
                    <th wdith="10%">Year</th>
                    <th wdith="15%">Course</th>
                    <th wdith="10%">Date Approved</th>
                    <th wdith="10%">Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                        while($row = mysqli_fetch_row($result))
                        {
                            $studyplanid = $row[0];
                            $filename = $row[1];
                            $studentid = $row[2];
                            $name = $row[3];
                            $yearlevel = $row[4];
                            $program = $row[5];
                            $date_approved = $row[6];

                            $output = '';
                            $output .= '
                                        <tr>
                                            <td><img src="lib/'.$filename.'" width="30px" style="margin: 0; padding: 0;"></td>
                                            <td>'.$studentid.'</td>
                                            <td>'.$name.'</td>
                                            <td>'.$yearlevel.'</td>
                                            <td>'.$program.'</td>
                                            <td>'.$date_approved.'</td>
                                            <td><input class="btn btn-success view_button" type="submit" id="view_'.$studyplanid.'" value="View" style="margin: 0;" data-toggle="modal" data-target="#exampleModalLonga"></td>
                                        </tr>
                            ';
                            
                            echo $output;
                        }  
                    }
                    else
                        $no_record = true;
                ?>        
            </table>
            <center>
                <button type="button" id="approve_button" class="btn btn-primary" onclick="print()">PRINT</button>
            </center>

            <!-- END -->
            <input type="text" id="studyplanid_ctr" hidden>
            <input type="text" id="studyplanid_ctr1" hidden>
            <div id="output3"></div>
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
        function no_records(){
            swal(
                'No records found',
                '',
                'error'
            ).then((result) => {
                location = "home.php";
            })
        }
    </script>
    <script>
        function hello(){
            $.bootstrapGrowl("Summary of Study Plan", {
            ele: 'body', // which element to append to
            type: 'success', // (null, 'info', 'danger', 'success')
            offset: {from: 'top', amount: 20}, // 'top', or 'bottom'
            align: 'right', // ('left', 'right', or 'center')
            width: 260, // (integer, or 'auto')
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
                width: 200, // (integer, or 'auto')
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

<script>
    $(document).ready(function() { 
        $('.view_button').click(function(){
            var id = this.id;
            id = id.split("_");
            id = id[1];
            $.ajax({  
                url:"report_sendid.php",  
                method:"POST",  
                data: {id:id},
                success:function(data){
                    $("#output3").html(data);
                }  
            });
            // $('#studyplanid_ctr').val(id);
            // alert(id);  
        });

        var a = $('#checker').val();
        
        // alert(a);

        // if(a == 0)
        if(<?php echo $no_record; ?> == true)
            no_records();
    });
</script>