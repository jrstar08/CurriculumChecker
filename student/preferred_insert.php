<?php
    include ('connect.php');
    $studentid = $_SESSION['studentid'];
    $entryaysem = $_SESSION['entryaysem'];
    $year = 20172;
    
    $year1 = substr($entryaysem, 0, 4);
    $year2 = substr($year, 0, 4);
    $year3 = ($year2 - $year1) + 1;
    $sem3 = substr($year, -1);
    $_SESSION['year3'] = $year3;
    $_SESSION['sem3'] = $sem3;
    $_SESSION['yearsem3'] = $year3.$sem3;
    $yearsem3 = $year3."".$sem3;

    $query = "INSERT INTO studyplan_approval(studentid, approve, aysem) VALUES ('$studentid', '0', '$year')";
    $result = mysqli_query($conn, $query);

    $query = "SELECT studyplanid from studyplan_approval where studentid = '$studentid' and aysem = '$year' order by studyplanid desc limit 1";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_row($result);
    $studyplanid = $row[0];

    // tentative yung 62, 6th yr 2nd sem
    for($i=$yearsem3+1; $i<62; $i++)
    {
        $x = substr($i,0,1);
        $y = substr($i,1,1);

        $query1 = "select subjects.subjectid, subject, subjecttitle, curricula2.credits, year, sem from curricula2 join subjects on subjects.subjectid = curricula2.subjectid where year = '$x' and sem = '$y' order by year, sem, subject";
        $result1 = mysqli_query($conn, $query1);
        
        while($row = mysqli_fetch_row($result1))
        {
            $query2 = "INSERT INTO studyplan(studyplanid, studentid, subjectid, subject, subjecttitle, credits, year, sem) values ('$studyplanid', '$studentid', '$row[0]', '$row[1]', '$row[2]', '$row[3]', '$row[4]', '$row[5]')";
            $result2 = mysqli_query($conn, $query2);
        }
    }
?>