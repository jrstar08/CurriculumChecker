 <?php include ('connect.php'); $firstname = $_SESSION['firstname']; $lastname = $_SESSION['lastname']; ?>
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
                        $query = "select filename, students.studentid, name, studyplan_approval.aysem, studyplanid, date_submitted from studyplan_approval join students on studyplan_approval.studentid = students.studentid join profile_picture on profile_picture.accountid = students.studentid where approve = 0 and active = 1 and advice = 0 order by date_submitted desc";
                        $result = mysqli_query($conn, $query);

                        if(mysqli_num_rows($result)>0)
                        {
                            echo '<input type="text" id="checker" value="1" hidden>';
                            echo '
                            <h3>APPROVAL OF STUDY PLAN</h3>
                            <table class="table table-hover table-inverse">
                                <thead style="background: #37474F; color: #fff">
                                    <tr>
                                    <th width="5%"></th>
                                    <th width="10%">Student ID</th>
                                    <th width="40%">Student Name</th>
                                    <th width="10%">Year</th>
                                    <th width="10%">AYSEM</th>
                                    <th width="15%">Submitted On</th>
                                    <th wdidh="10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                            ';
                            while($row = mysqli_fetch_row($result))
                            {
                                $query1 = "select yearlevel from studentterms where studentid='$row[1]' order by yearlevel desc limit 1";
                                $result1 = mysqli_query($conn, $query1);
                                $row1 = mysqli_fetch_row($result1);
                                echo '  <tr>
                                            <td><img src="lib/'.$row[0].'" width="30px" style="margin: 0; padding: 0;"></td>
                                            <td>'.$row[1].'</td>
                                            <td>'.$row[2].'</td>
                                            <td>'.$row1[0].'</td>
                                            <td>'.$row[3].'</td>
                                            <td>'.$row[5].'</td>
                                            <td><input class="btn view_button" type="submit" id="view_'.$row[4].'" value="View" style="background: #4CAF50; margin: 0; margin-right: 5px;" data-toggle="modal" data-target="#examplsseModalLong"></td>
                                        </tr>';
                            }
                        }
                        else
                        {
                            echo '<input type="text" id="checker" value="0" hidden>';
                        }

                    ?>
            </table>
            <!-- END -->
            <input type="text" id="studyplanid_ctr" hidden>
            <div id="output3"></div>
            <div id="output4"></div>
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
                title: 'Wanna change your profile picture?',
                imageUrl: 'lib/adviser.jpg',
                imageWidth: 400,
                imageHeight: 400,
                imageAlt: 'Custom image',
                animation: true,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, I want to change!'
              }).then((result) => {
                if (result.value) {
                    swal(
                    'Sorry...',
                    'Currently under maintenance, HAHAHA',
                    'warning'
                    ) 
                }
              })
        }
    </script>
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
        function approve_with_sms(){
            swal(
            'Approve',
            'An sms will be sent immediately',
            'success'
            ).then((result) => {
                setTimeout(function() {
                    location="home.php";
                }, 100);
            })
            $.ajax({  
                url:"approval_submit.php",  
                method:"POST",  
                data: {},
                success:function(data){}  
            });
        }
    </script>
    <script>
        function hello(){
            $.bootstrapGrowl("Approval of Study Plan", {
            ele: 'body', // which element to append to
            type: 'success', // (null, 'info', 'danger', 'success')
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
        $(document).ready(function() { 
            $('.view_button').click(function(){
                var id = this.id;
                id = id.split("_");
                id = id[1];
                $.ajax({  
                    url:"approval_sendid.php",  
                    method:"POST",  
                    data: {id:id},
                    success:function(data){
                        $("#output3").html(data);
                    }  
                });
                $('#studyplanid_ctr').val(id);
            });

            var a = $('#checker').val();

            if(a == 0)
                no_records();

            $('.delete_button').click(function(){
                var id = this.id;
                id = id.split("_");
                id = id[1];

                swal({
                    title: 'Do you want to delete?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        console.log(id);

                        swal(
                            'Deleted!',
                            'Selected study plan has been deleted.',
                            'success'
                        ).then((result) => {
                            if (result) {
                                $.ajax({  
                                    url:"approval_delete.php",  
                                    method:"POST",  
                                    data: {id:id},
                                    success:function(data){
                                        $("#output4").html(data);
                                        location="approval.php";
                                    }  
                                });
                            }
                        })
                    }
                })
            });
        });
    </script>
    <script>
        
        // SideNav Initialization
        $(".button-collapse").sideNav();

    </script><div class="drag-target" style="left: 0px; touch-action: pan-y; user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></div>

<div class="hiddendiv common"></div></body></html>