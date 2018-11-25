<?php 
    include ('connect.php');
    ini_set('max_execution_time', 0);
    $studentid='201502586';

    $query = "SELECT name, aysem, programid, yearlevel, studenttype, registrationcode, entryaysem FROM studentterms join students on students.studentid = studentterms.studentid WHERE studentterms.studentid='$studentid' order by aysem desc limit 1";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_row($result);
    $name = $row[0];
    $aysem = $row[1];
    $programid = $row[2];
    $yearlevel = $row[3];
    $studenttype = $row[4];
    $registrationcode = $row[5];
    $semester = substr($aysem, -1);
    $entryaysem = $row[6];
    $enter = '<br>';
    $line = '<hr>';
    $not_okay_subjects = array();

    // DISPLAY STUDENT'S INFORMATION
    echo $enter.'<center><b>STUDENT INFORMATION</b>'.$line.$line;
    echo 'STUDENTID: '.$studentid.$enter.'NAME: '.$name.$enter.'AYSEM: '.$aysem.$enter.$programid.$enter.$yearlevel.$enter.$studenttype.$enter.$registrationcode.$enter.$semester.$enter.$entryaysem.$enter;
    
    $query = "select curriculumid from curricula_entryaysem where entryaysem = '$entryaysem' and programid = '$programid'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_row($result);
    $curriculumid = $row[0];

    // DISPLAY CURRICULUMID
    echo $curriculumid.$enter.$line;
    echo '<b>SUBJECT DETAILS</b>'.$line.$line;

    $query = "select curricula1.subjectid, year, sem, clusterid1, subject, subjecttitle from curricula1 join subjects on subjects.subjectid = curricula1.subjectid where curriculumid = '$curriculumid' order by year, sem";
    $result = mysqli_query($conn, $query);
    
    while($row = mysqli_fetch_row($result))
    {
        $active = 1; // Mag 0 siya pag tapos na 
        $curriculum_subjectid = $row[0];
        $curriculum_subject = $row[4];
        $curriculum_subjecttitle = $row[5];
        echo 'Subject ID: '.$curriculum_subjectid.$enter;
        echo 'Subject: '.$curriculum_subject.$enter;
        echo 'Subject Title: '.$curriculum_subjecttitle.$enter;

        for($i=0;$i<1;$i++)
        {
            // CHECK GRADES
            $query1 = "select * from grades where subjectid = '$curriculum_subjectid' and studentid = '$studentid' and remarks = 'PASSED'";
            $result1 = mysqli_query($conn, $query1);
            
            if(mysqli_num_rows($result1)>0)
            {
                $row1 = mysqli_fetch_row($result1);
                $grades = $row1[4];
                echo 'Grade: '.$grades.$enter;
                $active = 0;
                break;
            }

            // CHECK CLUSTER SUBJECTS
            if($active == 1){
                $query1 = "select clusterid1 from curricula1 where subjectid = '$curriculum_subjectid' and curriculumid = '$curriculumid'";
                $result1 = mysqli_query($conn, $query1);
                $row1 = mysqli_fetch_row($result1); 
                $cluster_subjects = $row1[0];
                echo 'Cluster Subjects: '.$cluster_subjects.$enter;
                
                $cluster_subject = explode(', ', $cluster_subjects);
                for($i=1; $i<count($cluster_subject); $i++) // Naka 1 siya dahil hindi na isasama si index 0 which is yung same ng subject niya, bale yung ka-cluster subject niya lang yung ichecheck.
                {
                    $query1 = "select * from grades where subjectid = '$cluster_subject[$i]' and studentid = '$studentid' and remarks = 'PASSED'";
                    $result1 = mysqli_query($conn, $query1);
    
                    if(mysqli_num_rows($result1)>0)
                    {
                        $row1 = mysqli_fetch_row($result1);
                        $grades = $row1[4];
                        echo 'Cluster Grade ['.$cluster_subject[$i].']: '.$grades.$enter;
                        $active = 0;
                        break;
                    }
                }
            }

            // CHECK INCOMPLETE SUBJECT BUT HAS A COMPLETION GRADE
            if($active == 1)
            {
                $query1 = "select completiongrade from grades where subjectid = '$curriculum_subjectid' and studentid = '$studentid' and finalgrade = 'INC'";
                $result1 = mysqli_query($conn, $query1);
                if(mysqli_num_rows($result1)>0)
                {
                    echo 'Incomplete: Yes'.$enter;
                    $row1 = mysqli_fetch_row($result1);
                    $inc_grade = $row1[0];
                    echo 'Completion Grade: '.$inc_grade.$enter;
                    if($inc_grade > 0)
                    {
                        $active = 0;
                        break;
                    }
                }
            }

            // FAILED SUBJECT
            if($active == 1)
            {
                $query1 = "select * from grades where gradestatus = 'F' and studentid = '$studentid' and subjectid = '$curriculum_subjectid'";
                $result1 = mysqli_query($conn, $query1);
                if(mysqli_num_rows($result1)>0)
                {
                    echo 'Failed: Yes'.$enter;
                    $query2 = "select clusterid1 from curricula1 where subjectid='$curriculum_subjectid' and curriculumid = '$curriculumid'";
                    $result2 = mysqli_query($conn, $query2);
                    $row2 = mysqli_fetch_row($result2);  
                    $cluster_subjects2 = $row2[0];
                    echo 'Cluster Subject of Failed Subject: '.$cluster_subjects2.$enter;
                    
                    $cluster_subject2 = explode(', ', $cluster_subjects2);
                    for($i=1; $i<count($cluster_subject2); $i++) // Naka 1 siya dahil hindi na isasama si index 0 which is yung same ng subject niya, bale yung ka-cluster subject niya lang yung ichecheck.
                    {
                        $query3 = "select * from grades where subjectid = '$cluster_subject2[$i]' and studentid = '$studentid' and remarks = 'PASSED'";
                        $result3 = mysqli_query($conn, $query3);
                        
                        if(mysqli_num_rows($result3)>0)
                        {
                            $row3 = mysqli_fetch_row($result3);
                            $grades = $row3[4];
                            echo 'Cluster Grade ['.$cluster_subject2[$i].']: '.$grades.$enter;
                            $active = 0;
                            break;
                        }
                    }
                }
            }

            // CROSS ENROLLED
            if($active == 1)
            {
                // GETTING FIRST THE CLUSTER SUBJECTS
                $query1 = "select clusterid1 from curricula1 where subjectid='$curriculum_subjectid' and curriculumid = '$curriculumid'";
                $result1 = mysqli_query($conn, $query1);
                $row1 = mysqli_fetch_row($result1);  
                $cluster_subjects1 = $row1[0];
                $cluster_subject1 = explode(', ', $cluster_subjects1);
                
                for($i=0; $i<count($cluster_subject1); $i++) // Lahat ng subject sa cluster need dito
                {
                    $query1 = "select * from cross_enrolled_subjects where studentid = '$studentid' and subjectid='$cluster_subject1[$i]'";
                    $result1 = mysqli_query($conn, $query1);
                    if(mysqli_num_rows($result1)>0)
                    {
                        $row1 = mysqli_fetch_row($result1);
                        if($row1[4] == 'P')
                        {
                            echo 'Grade of Subject in Cross Enrolled: '.$row1[3].$enter;
                            $active = 0;
                            break;
                        }
                        else if($row1[4] == 'I')
                        {
                            echo 'Completion Grade of Subject in Cross Enrolled: '.$row1[5].$enter;
                            $active = 0;
                            break;
                        }
                    }
                }
            }
            
            // CURRENTLY ENROLLED
            if($active == 1)
            {
                $query1 = "select studentid, classlists.classid, class from classlists join classes on classes.classid = classlists.classid where studentid = '$studentid' and subjectid = '$curriculum_subjectid' and classlists.classid like '$aysem%' limit 1";
                $result1 = mysqli_query($conn, $query1);
                if(mysqli_num_rows($result1)>0)
                {
                    echo 'CURRENTLY ENROLLED'.$enter;
                    $active = 0;
                    break;
                }            
            }            
            
            if($active == 1)
                array_push($not_okay_subjects, $curriculum_subjectid);

        } // END OF FOR LOOP

        if($active == 0)
            echo '<div style="color: red">RESULT: OKAY</div>'.$enter;
        else
            echo 'RESULT: NOT OKAY'.$enter;


        // END LINE
        echo $line.$enter;
    }

    echo '<b>PE</b>'.$enter.$enter;
    $query1 = "select subjects.subjectid, subject, subjecttitle, finalgrade from grades join subjects on subjects.subjectid = grades.subjectid where studentid = '$studentid' and grades.remarks = 'PASSED' and subject like 'PE%'";
    $result1 = mysqli_query($conn, $query1);
    if(mysqli_num_rows($result1)>0)
    {
        while($row1 = mysqli_fetch_row($result1))
            echo $row1[0].' - '.$row1[1].' - '.$row1[2].' - '.$row1[3].$enter;
    }
    echo $enter.$line.$enter;

    echo '<b>NSTP</b>'.$enter.$enter;
    $query1 = "select subjects.subjectid, subject, subjecttitle, finalgrade from grades join subjects on subjects.subjectid = grades.subjectid where studentid = '$studentid' and grades.remarks = 'PASSED' and subject like 'NSTP%'";
    $result1 = mysqli_query($conn, $query1);
    if(mysqli_num_rows($result1)>0)
    {
        while($row1 = mysqli_fetch_row($result1))
            echo $row1[0].' - '.$row1[1].' - '.$row1[2].' - '.$row1[3].$enter;
    }

    echo $enter.$line.$enter;

    echo '<b>SUMMARY</b>'.$enter.$enter;
    if(count($not_okay_subjects)>0)
        echo 'ACADEMIC: NOT OKAY'.$enter;
    else
        echo 'ACADEMIC: OKAY'.$enter;


    // CHECK PE
    $query1 = "select subjects.subjectid, subject, subjecttitle from grades join subjects on subjects.subjectid = grades.subjectid where studentid = '$studentid' and grades.remarks = 'PASSED' and subject like 'PE%'";
    $result1 = mysqli_query($conn, $query1);
    if(mysqli_num_rows($result1)>=4)
        echo 'PE: OKAY'.$enter;
    else
        echo 'PE: NOT OKAY'.$enter;

    // CHECK NSTP
    $query1 = "select subjects.subjectid, subject, subjecttitle from grades join subjects on subjects.subjectid = grades.subjectid where studentid = '$studentid' and grades.remarks = 'PASSED' and subject like 'NSTP%'";
    $result1 = mysqli_query($conn, $query1);
    if(mysqli_num_rows($result1)>=2)
        echo 'NSTP: OKAY'.$enter;
    else
        echo 'NSTP: NOT OKAY'.$enter;
        
    echo $enter.$line.$enter;

    if(count($not_okay_subjects)>0)
    {
        echo '<b><div style="color: red">STATUS: NON GRADUATING</div></b>'.$enter.$enter;

        echo '<b>INCOMPLETE SUBJECTS: '.count($not_okay_subjects).'</b>'.$enter.$enter;
        for($i=0; $i<count($not_okay_subjects); $i++)
        {
            $query1 = "SELECT subject, subjecttitle from subjects where subjectid='$not_okay_subjects[$i]'";
            $result1 = mysqli_query($conn, $query1);
            $row1 = mysqli_fetch_row($result1);

            echo $not_okay_subjects[$i].' - '.$row1[0].' - '.$row1[1].$enter;
        }
    }
    else
    {
        echo '<b><div style="color: red">STATUS: GRADUATING</div></b>';        
    }

    echo $enter.$line.$enter;

?>