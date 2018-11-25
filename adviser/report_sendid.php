<?php
    include ('connect.php');
    // session_start();
    $id = $_POST['id'];
    $_SESSION['studyplanid'] = $id;
    // echo $id;

    $query = "select name from studyplan_approval join students on studyplan_approval.studentid = students.studentid where studyplanid = '$id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_row($result);
    $name = $row[0];

    $output = '';
    $output .= '
    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" style="width: 100%">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">' . $name . '</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body" style="overflow: auto; height: 500px;">';
                
                // START
                $totalunits = 0;
                $query = "SELECT * FROM studyplan WHERE year = 1 AND sem = 1 AND studyplanid = '$id'";
                $result = mysqli_query($conn, $query);
                if(mysqli_num_rows($result)>0)
                {
                    $output .= '<h6>First Year, First Semester</h6>';
                    $output .= '<table class="table table-hover table-inverse">
                                    <thead style="background: #263238; color: #fff">
                                        <tr>
                                            <th width="15%">Course Code</th>
                                            <th width="75%">Course Title</th>
                                            <th width="10%">Units</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                    while($row = mysqli_fetch_row($result))
                    {
                        $output .= '<tr>';
                        $output .= '<td>' . $row[4] . '</td>';
                        $output .= '<td>' . $row[5] . '</td>';
                        $output .= '<td>' . $row[6] . '</td>';
                        $output .= '</tr>';
                        $totalunits += $row[6];
                    }
                    $output .= '</tbody></table><h6 style="text-align: center; color: #F44336;">Total Units: '.$totalunits.'</h6>';
                }

                // START
                $totalunits = 0;
                $query = "SELECT * FROM studyplan WHERE year = 1 AND sem = 2 AND studyplanid = '$id'";
                $result = mysqli_query($conn, $query);
                if(mysqli_num_rows($result)>0)
                {
                    $output .= '<h6>First Year, Second Semester</h6>';
                    $output .= '<table class="table table-hover table-inverse">
                                    <thead style="background: #263238; color: #fff">
                                        <tr>
                                            <th width="15%">Course Code</th>
                                            <th width="75%">Course Title</th>
                                            <th width="10%">Units</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                    while($row = mysqli_fetch_row($result))
                    {
                        $output .= '<tr>';
                        $output .= '<td>' . $row[4] . '</td>';
                        $output .= '<td>' . $row[5] . '</td>';
                        $output .= '<td>' . $row[6] . '</td>';
                        $output .= '</tr>';
                        $totalunits += $row[6];
                    }
                    $output .= '</tbody></table><h6 style="text-align: center; color: #F44336;">Total Units: '.$totalunits.'</h6>';
                }
                
                // START
                $totalunits = 0;
                $query = "SELECT * FROM studyplan WHERE year = 2 AND sem = 1 AND studyplanid = '$id'";
                $result = mysqli_query($conn, $query);
                if(mysqli_num_rows($result)>0)
                {
                    $output .= '<h6>Second Year, First Semester</h6>';
                    $output .= '<table class="table table-hover table-inverse">
                                    <thead style="background: #263238; color: #fff">
                                        <tr>
                                            <th width="15%">Course Code</th>
                                            <th width="75%">Course Title</th>
                                            <th width="10%">Units</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                    while($row = mysqli_fetch_row($result))
                    {
                        $output .= '<tr>';
                        $output .= '<td>' . $row[4] . '</td>';
                        $output .= '<td>' . $row[5] . '</td>';
                        $output .= '<td>' . $row[6] . '</td>';
                        $output .= '</tr>';
                        $totalunits += $row[6];
                    }
                    $output .= '</tbody></table><h6 style="text-align: center; color: #F44336;">Total Units: '.$totalunits.'</h6>';
                }
                
                // START
                $totalunits = 0;
                $query = "SELECT * FROM studyplan WHERE year = 2 AND sem = 2 AND studyplanid = '$id'";
                $result = mysqli_query($conn, $query);
                if(mysqli_num_rows($result)>0)
                {
                    $output .= '<h6>Second Year, Second Semester</h6>';
                    $output .= '<table class="table table-hover table-inverse">
                                    <thead style="background: #263238; color: #fff">
                                        <tr>
                                            <th width="15%">Course Code</th>
                                            <th width="75%">Course Title</th>
                                            <th width="10%">Units</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                    while($row = mysqli_fetch_row($result))
                    {
                        $output .= '<tr>';
                        $output .= '<td>' . $row[4] . '</td>';
                        $output .= '<td>' . $row[5] . '</td>';
                        $output .= '<td>' . $row[6] . '</td>';
                        $output .= '</tr>';
                        $totalunits += $row[6];
                    }
                    $output .= '</tbody></table><h6 style="text-align: center; color: #F44336;">Total Units: '.$totalunits.'</h6>';
                }

                // START
                $totalunits = 0;
                $query = "SELECT * FROM studyplan WHERE year = 3 AND sem = 1 AND studyplanid = '$id'";
                $result = mysqli_query($conn, $query);
                if(mysqli_num_rows($result)>0)
                {
                    $output .= '<h6>Third Year, First Semester</h6>';
                    $output .= '<table class="table table-hover table-inverse">
                                    <thead style="background: #263238; color: #fff">
                                        <tr>
                                            <th width="15%">Course Code</th>
                                            <th width="75%">Course Title</th>
                                            <th width="10%">Units</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                    while($row = mysqli_fetch_row($result))
                    {
                        $output .= '<tr>';
                        $output .= '<td>' . $row[4] . '</td>';
                        $output .= '<td>' . $row[5] . '</td>';
                        $output .= '<td>' . $row[6] . '</td>';
                        $output .= '</tr>';
                        $totalunits += $row[6];
                    }
                    $output .= '</tbody></table><h6 style="text-align: center; color: #F44336;">Total Units: '.$totalunits.'</h6>';
                }
                
                // START
                $totalunits = 0;
                $query = "SELECT * FROM studyplan WHERE year = 3 AND sem = 2 AND studyplanid = '$id'";
                $result = mysqli_query($conn, $query);
                if(mysqli_num_rows($result)>0)
                {
                    $output .= '<h6>Third Year, Second Semester</h6>';
                    $output .= '<table class="table table-hover table-inverse">
                                    <thead style="background: #263238; color: #fff">
                                        <tr>
                                            <th width="15%">Course Code</th>
                                            <th width="75%">Course Title</th>
                                            <th width="10%">Units</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                    while($row = mysqli_fetch_row($result))
                    {
                        $output .= '<tr>';
                        $output .= '<td>' . $row[4] . '</td>';
                        $output .= '<td>' . $row[5] . '</td>';
                        $output .= '<td>' . $row[6] . '</td>';
                        $output .= '</tr>';
                        $totalunits += $row[6];
                    }
                    $output .= '</tbody></table><h6 style="text-align: center; color: #F44336;">Total Units: '.$totalunits.'</h6>';
                }

                // START
                $totalunits = 0;
                $query = "SELECT * FROM studyplan WHERE year = 3 AND sem = 3 AND studyplanid = '$id'";
                $result = mysqli_query($conn, $query);
                if(mysqli_num_rows($result)>0)
                {
                    $output .= '<h6>Third Year, Summer</h6>';
                    $output .= '<table class="table table-hover table-inverse">
                                    <thead style="background: #263238; color: #fff">
                                        <tr>
                                            <th width="15%">Course Code</th>
                                            <th width="75%">Course Title</th>
                                            <th width="10%">Units</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                    while($row = mysqli_fetch_row($result))
                    {
                        $output .= '<tr>';
                        $output .= '<td>' . $row[4] . '</td>';
                        $output .= '<td>' . $row[5] . '</td>';
                        $output .= '<td>' . $row[6] . '</td>';
                        $output .= '</tr>';
                        $totalunits += $row[6];
                    }
                    $output .= '</tbody></table><h6 style="text-align: center; color: #F44336;">Total Units: '.$totalunits.'</h6>';
                }

                // START
                $totalunits = 0;
                $query = "SELECT * FROM studyplan WHERE year = 4 AND sem = 1 AND studyplanid = '$id'";
                $result = mysqli_query($conn, $query);
                if(mysqli_num_rows($result)>0)
                {
                    $output .= '<h6>Fourth Year, First Semester</h6>';
                    $output .= '<table class="table table-hover table-inverse">
                                    <thead style="background: #263238; color: #fff">
                                        <tr>
                                            <th width="15%">Course Code</th>
                                            <th width="75%">Course Title</th>
                                            <th width="10%">Units</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                    while($row = mysqli_fetch_row($result))
                    {
                        $output .= '<tr>';
                        $output .= '<td>' . $row[4] . '</td>';
                        $output .= '<td>' . $row[5] . '</td>';
                        $output .= '<td>' . $row[6] . '</td>';
                        $output .= '</tr>';
                        $totalunits += $row[6];
                    }
                    $output .= '</tbody></table><h6 style="text-align: center; color: #F44336;">Total Units: '.$totalunits.'</h6>';
                }

                // START
                $totalunits = 0;
                $query = "SELECT * FROM studyplan WHERE year = 4 AND sem = 2 AND studyplanid = '$id'";
                $result = mysqli_query($conn, $query);
                if(mysqli_num_rows($result)>0)
                {
                    $output .= '<h6>Fourth Year, Second Semester</h6>';
                    $output .= '<table class="table table-hover table-inverse">
                                    <thead style="background: #263238; color: #fff">
                                        <tr>
                                            <th width="15%">Course Code</th>
                                            <th width="75%">Course Title</th>
                                            <th width="10%">Units</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                    while($row = mysqli_fetch_row($result))
                    {
                        $output .= '<tr>';
                        $output .= '<td>' . $row[4] . '</td>';
                        $output .= '<td>' . $row[5] . '</td>';
                        $output .= '<td>' . $row[6] . '</td>';
                        $output .= '</tr>';
                        $totalunits += $row[6];
                    }
                    $output .= '</tbody></table><h6 style="text-align: center; color: #F44336;">Total Units: '.$totalunits.'</h6>';
                }

                // START
                $totalunits = 0;
                $query = "SELECT * FROM studyplan WHERE year = 5 AND sem = 1 AND studyplanid = '$id'";
                $result = mysqli_query($conn, $query);
                if(mysqli_num_rows($result)>0)
                {
                    $output .= '<h6>Fifth Year, Second Semester</h6>';
                    $output .= '<table class="table table-hover table-inverse">
                                    <thead style="background: #263238; color: #fff">
                                        <tr>
                                            <th width="15%">Course Code</th>
                                            <th width="75%">Course Title</th>
                                            <th width="10%">Units</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                    while($row = mysqli_fetch_row($result))
                    {
                        $output .= '<tr>';
                        $output .= '<td>' . $row[4] . '</td>';
                        $output .= '<td>' . $row[5] . '</td>';
                        $output .= '<td>' . $row[6] . '</td>';
                        $output .= '</tr>';
                        $totalunits += $row[6];
                    }
                    $output .= '</tbody></table><h6 style="text-align: center; color: #F44336;">Total Units: '.$totalunits.'</h6>';
                }

                // START
                $totalunits = 0;
                $query = "SELECT * FROM studyplan WHERE year = 5 AND sem = 2 AND studyplanid = '$id'";
                $result = mysqli_query($conn, $query);
                if(mysqli_num_rows($result)>0)
                {
                    $output .= '<h6>Fifth Year, Second Semester</h6>';
                    $output .= '<table class="table table-hover table-inverse">
                                    <thead style="background: #263238; color: #fff">
                                        <tr>
                                            <th width="15%">Course Code</th>
                                            <th width="75%">Course Title</th>
                                            <th width="10%">Units</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                    while($row = mysqli_fetch_row($result))
                    {
                        $output .= '<tr>';
                        $output .= '<td>' . $row[4] . '</td>';
                        $output .= '<td>' . $row[5] . '</td>';
                        $output .= '<td>' . $row[6] . '</td>';
                        $output .= '</tr>';
                        $totalunits += $row[6];
                    }
                    $output .= '</tbody></table><h6 style="text-align: center; color: #F44336;">Total Units: '.$totalunits.'</h6>';
                }

                // START
                $totalunits = 0;
                $query = "SELECT * FROM studyplan WHERE year = 6 AND sem = 1 AND studyplanid = '$id'";
                $result = mysqli_query($conn, $query);
                if(mysqli_num_rows($result)>0)
                {
                    $output .= '<h6>Sixth Year, First Semester</h6>';
                    $output .= '<table class="table table-hover table-inverse">
                                    <thead style="background: #263238; color: #fff">
                                        <tr>
                                            <th width="15%">Course Code</th>
                                            <th width="75%">Course Title</th>
                                            <th width="10%">Units</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                    while($row = mysqli_fetch_row($result))
                    {
                        $output .= '<tr>';
                        $output .= '<td>' . $row[4] . '</td>';
                        $output .= '<td>' . $row[5] . '</td>';
                        $output .= '<td>' . $row[6] . '</td>';
                        $output .= '</tr>';
                        $totalunits += $row[6];
                    }
                    $output .= '</tbody></table><h6 style="text-align: center; color: #F44336;">Total Units: '.$totalunits.'</h6>';
                }

                // START
                $totalunits = 0;
                $query = "SELECT * FROM studyplan WHERE year = 6 AND sem = 2 AND studyplanid = '$id'";
                $result = mysqli_query($conn, $query);
                if(mysqli_num_rows($result)>0)
                {
                    $output .= '<h6>Sixth Year, Second Semester</h6>';
                    $output .= '<table class="table table-hover table-inverse">
                                    <thead style="background: #263238; color: #fff">
                                        <tr>
                                            <th width="15%">Course Code</th>
                                            <th width="75%">Course Title</th>
                                            <th width="10%">Units</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                    while($row = mysqli_fetch_row($result))
                    {
                        $output .= '<tr>';
                        $output .= '<td>' . $row[4] . '</td>';
                        $output .= '<td>' . $row[5] . '</td>';
                        $output .= '<td>' . $row[6] . '</td>';
                        $output .= '</tr>';
                        $totalunits += $row[6];
                    }
                    $output .= '</tbody></table><h6 style="text-align: center; color: #F44336;">Total Units: '.$totalunits.'</h6>';
                }
                
    $output .= '
            </div>
                <div class="modal-footer">
                    <button type="button" id="approve_button" class="btn btn-secondary">Print</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    
    ';

    echo $output;
?>

<!-- <script src="lib/jquery-3.2.1.js"></script> -->
<!-- <script src="lib/semantic/semantic.min.js"></script> -->
<script>
    $('#exampleModalLong').modal('show'); 
</script>

<script>
    function print_studyplan(){
        location="print.php";
    }
</script>

<script>
    $('#approve_button').click(function(){
        print_studyplan();
    })
</script>