<?php
    include ('connect.php');
    ini_set('max_execution_time', 0);
    $aysem = $_POST['aysem'];
    $programid = $_POST['programid'];
    $_SESSION['counter_limit'] = 0; // TO REINITIALIZE THE VALUE OF SESSION
    $students_id = array();
    
    if($programid == 999999)
    {
        $query = "select programid from curricula1 group by curriculumid";
        $result = mysqli_query($conn, $query);
        while($row = mysqli_fetch_row($result))
        {
            $programid = $row[0];
            $query0 = "SELECT studentterms.studentid FROM studentterms join students on students.studentid = studentterms.studentid join programs on programs.programid = studentterms.programid where aysem = '20172' and studentterms.programid = '$programid' and yearlevel >= programs.numyears group by studentterms.studentid order by students.name asc";
            $result0 = mysqli_query($conn, $query0);
        
            while($row0 = mysqli_fetch_row($result0))
                array_push($students_id, $row0[0]);
        }
       

        // print_r($students_id);
        print json_encode($students_id);
    }

    else
    {
        $query0 = "SELECT studentterms.studentid FROM studentterms join students on students.studentid = studentterms.studentid join programs on programs.programid = studentterms.programid where aysem = '20172' and studentterms.programid = '$programid' and yearlevel >= programs.numyears group by studentterms.studentid order by students.name asc";
        $result0 = mysqli_query($conn, $query0);
    
        while($row0 = mysqli_fetch_row($result0))
            array_push($students_id, $row0[0]);
        
        print json_encode($students_id);
        // print_r($students_id);
    }  

    
?>