<?php
    include ('connect.php');
    ini_set('max_execution_time', 600000);

    $limit = $_POST['limit'];
    $studentid = $_POST['student_id'];
    // echo '<li>'.$studentid.'</li>';
    $aysem = $_POST['aysem'];
    $counter_limit = $_SESSION['counter_limit'];

    // echo $counter_limit . "/" . $limit;
    // START

    if($counter_limit != $limit)
    {
        $query0 = "SELECT studentterms.studentid, name, yearlevel FROM studentterms join students on students.studentid = studentterms.studentid where aysem = 20172 and studentterms.studentid = '$studentid' limit 1";
        $result0 = mysqli_query($conn, $query0);
        $row0 = mysqli_fetch_row($result0);

        // check if nasa db na, if yes then exit
        $query = "SELECT * FROM graduating_students WHERE studentid='$studentid' and aysem='$aysem'";
        $result = mysqli_query($conn, $query);
        if(mysqli_num_rows($result)>0)
        {
            echo '<li>#'.($counter_limit+1).' | '.$row0[0].' | '.$row0[1].' | '.$row0[2].'</li>';
            $_SESSION['counter_limit'] = $_SESSION['counter_limit'] + 1;
        }
        else
        {
            $query = "SELECT name, aysem, programid, yearlevel, entryaysem, registrationcode FROM studentterms join students on students.studentid = studentterms.studentid WHERE studentterms.studentid='$studentid' order by aysem desc limit 1";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_row($result);
            $name = $row[0];
            $aysem = $row[1];
            $programid = $row[2];
            $yearlevel = $row[3];
            $entryaysem = $row[4];
            $registrationcode = $row[5];
            $enter = '<br>';
            $line = '<hr>';
            $not_okay_subjects = array();

            // CHECK IF THE STUDENT IS IRREGULAR, IF YES, PROCEED
            if($registrationcode == 'I')
            {
                // CHECK IF THERE'S EXISTING DATA IN THE DATABASE, DELETE IF THERE'S EXISTING DATA
                $query1 = "SELECT * FROM student_with_deficiency WHERE studentid = '$studentid' AND aysem = '$aysem'";
                $result1 = mysqli_query($conn, $query1);
                if(mysqli_num_rows($result1)>0)
                {
                    $query1 = "DELETE FROM student_with_deficiency WHERE studentid = '$studentid' AND aysem = '$aysem'";
                    $result1 = mysqli_query($conn, $query1);
                }

                // DISPLAY STUDENT'S INFORMATION        
                $query = "select curriculumid from curricula_entryaysem where entryaysem = '$entryaysem' and programid = '$programid' limit 1";
                $result = mysqli_query($conn, $query);
                $row = mysqli_fetch_row($result);
                $curriculumid = $row[0];



                $query = "select subjectid, clusterid1 from curricula1 where curriculumid = '$curriculumid' and curricula1.subjectid not in (select subjectid from grades where studentid = '$studentid' and gradestatus = 'P')
                and curricula1.subjectid not in (select subjectid from classes join classlists on classes.classid = classlists.classid where classlists.studentid = '$studentid' and classes.classid like '".$aysem."%')";
                $result = mysqli_query($conn, $query);
                
                while ($row = mysqli_fetch_row($result))
                {
                    $check = 1;
                    $cluster_subject = explode(', ', $row[1]);
                    
                    // INCOMPLETE AND FAILED
                    // FAILED KASI CHINECHECK NI SYSTEM LAHAT NG BAGSAK NIYA SA ACCREDITTED SUBJECTS AND HINAHANAP NIYA IF PASSED
                    for($i=1; $i<count($cluster_subject); $i++)
                    {
                        $query1 = "SELECT gradestatus, completiongrade FROM GRADES WHERE subjectid = '$cluster_subject[$i]' AND studentid = '$studentid' limit 1";
                        $result1 = mysqli_query($conn, $query1);
                        $row1 = mysqli_fetch_row($result1);
                        // GRADESTATUS
                        if(($row1[0] == 'I' && $row1[1] >= 1.00 && $row1[1] <= 3.00) || ($row1[0] == 'P'))
                        {
                            $check = 0;
                            break;
                        }
                    }

                    // CROSS-ENROLLED
                    if($check == 1)
                    {   
                        for($i=0; $i<count($cluster_subject); $i++) // Lahat ng subject sa cluster need dito
                        {
                            $query1 = "select subjectid from cross_enrolled_subjects where studentid = '$studentid' and subjectid='$cluster_subject[$i]' limit 1";
                            $result1 = mysqli_query($conn, $query1);
                            if(mysqli_num_rows($result1)>0)
                            {
                                $row1 = mysqli_fetch_row($result1);
                                if($row1[4] == 'P')
                                {
                                    $check = 0;
                                    break;
                                }
                                else if($row1[4] == 'I')
                                {
                                    // KULANG PA, DAPAT MAY ADD PA NG CHECKING IF PASADO BA YUNG COMPLETION GRADE NYA
                                    $check = 0;
                                    break;
                                }
                            }
                        }
                    }
                    
                    if ($check == 1)
                        array_push($not_okay_subjects, $row[0]);
                }
                
                // CHECK PE
                $pe = 0;
                $query1 = "select distinct(subject) from grades join subjects on subjects.subjectid = grades.subjectid where studentid = '$studentid' and grades.remarks = 'PASSED' and subject like 'PE%'";
                $result1 = mysqli_query($conn, $query1);
                if(mysqli_num_rows($result1)>=4)
                    $pe = 1;
                else
                    array_push($not_okay_subjects, 'PE');

                // CHECK NSTP
                $nstp = 0;
                $query1 = "select distinct(subject) from grades join subjects on subjects.subjectid = grades.subjectid where studentid = '$studentid' and grades.remarks = 'PASSED' and subject like 'NSTP%'";
                $result1 = mysqli_query($conn, $query1);
                if(mysqli_num_rows($result1)>=2)
                    $nstp = 1;
                else
                    array_push($not_okay_subjects, 'NSTP');
                    
                if((count($not_okay_subjects)>0) || $pe == 0 || $nstp == 0)
                {
                    // $_SESSION['graduating_status']='NON GRADUATING';
                    // echo 'NON GRADUATING <br>';
                    // echo '<li>'.$row0[0].' - '.$row0[1].'</li>';
                    
                    for($i=0; $i<count($not_okay_subjects); $i++)
                    {
                        // $query1 = "SELECT subject, subjecttitle from subjects where subjectid='$not_okay_subjects[$i]' limit 1";
                        // $result1 = mysqli_query($conn, $query1);
                        // $row1 = mysqli_fetch_row($result1);
                        $query2 = "INSERT INTO student_with_deficiency(studentid,aysem,deficiency) VALUES ('$studentid', '$aysem', '$not_okay_subjects[$i]')";
                        $result2 = mysqli_query($conn, $query2);
                    }
                }
                else
                {
                    // echo $row0[0].' - '.$row0[1].' - GRADUATING <br>';
                    $_SESSION['counter_limit'] = $_SESSION['counter_limit'] + 1;
                    echo '<li>#'.($counter_limit+1).' | '.$row0[0].' | '.$row0[1].' | '.$row0[2].'</li>';
                    // $_SESSION['graduating_status']='GRADUATING';

                    $query9 = "INSERT INTO graduating_students(studentid,aysem) VALUES ('$studentid','$aysem')";
                    $result9 = mysqli_query($conn, $query9);  
                }
            } // END OF, IF THE STUDENT IS IRREGULAR
            else if ($registrationcode == 'R')
            {
                $_SESSION['counter_limit'] = $_SESSION['counter_limit'] + 1;
                echo '<li>#'.($counter_limit + 1).' | '.$row0[0].' | '.$row0[1].' | '.$row0[2].'</li>';
                $query9 = "INSERT INTO graduating_students(studentid,aysem) VALUES ('$studentid','$aysem')";
                $result9 = mysqli_query($conn, $query9);  
            }
        } // END OF ELSE STATEMENT IN CHECKING SA DATABASE KUNG NASA LIST NA SIYA
    }
?>