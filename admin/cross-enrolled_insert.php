<?php
    include ('connect.php');
    
    $student_id = $_POST['student_id'];
    $subject_id = $_POST['subject_id'];
    $grade_status = $_POST['grade_status'];
    $subject_code = $_POST['subject_code'];
    $aysem = $_POST['aysem'];
    $school = $_POST['school'];
    $final_grade = $_POST['final_grade'];
    $completion_grade = $_POST['completion_grade'];

    $query = "SELECT subjectid FROM subjects WHERE subject = '$subject_id'";
    $result = mysqli_query($conn,$query);
    $subject_id = mysqli_fetch_row($result);
    $subject_id = $subject_id[0];

    if($grade_status == 'P')
    {
        $query = "INSERT INTO cross_enrolled_subjects(studentid, subjectid, finalgrade, status, subjectcode, aysem, schoolid) VALUES ('$student_id', '$subject_id', '$final_grade', '$grade_status', '$subject_code', '$aysem', '$school')";
        $result = mysqli_query($conn, $query);
        if($result)
            echo 'SUCCESS!';
    }
    else if($grade_status == 'I')
    {
        $query = "INSERT INTO cross_enrolled_subjects(studentid, subjectid, completiongrade, status, subjectcode, aysem, schoolid) VALUES ('$student_id', '$subject_id', '$completion_grade', '$grade_status', '$subject_code', '$aysem', '$school')";
        $result = mysqli_query($conn, $query);
        if($result)
            echo 'SUCCESS!';
    }
?>