<?php 
    include ('connect.php');
    ini_set('max_execution_time', 0);
    $studentid=$_POST['studentid'];
    // $studentid='201402046';

    $query = "SELECT name, aysem, studentterms.programid, yearlevel, studenttype, registrationcode, entryaysem, program, unit FROM studentterms join students on students.studentid = studentterms.studentid join programs on programs.programid = studentterms.programid join units on units.unitid = studentterms.unitid WHERE studentterms.studentid='$studentid' order by aysem desc limit 1";
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
    $program = $row[7];
    $unit = $row[8];
    $enter = '<br>';
    $line = '<hr>';
    $not_okay_subjects = array();

    if($studenttype == 'O')
        $studenttype = 'OLD';
    else if($studenttype == 'N')
        $studenttype = 'NEW';
    else if($studenttype == 'T')
        $studenttype = 'TRANSFEREE';
    
    if($registrationcode == 'R')
        $registrationcode = 'REGULAR';
    else if($registrationcode == 'I')
        $registrationcode = 'IRREGULAR';

    // DISPLAY STUDENT'S INFORMATION
    echo '<center><b><h3>STUDENT INFORMATION</h3></b></center>';
    echo '<table class="ui celled table"><thead style="text-transform: uppercase;"><tr><b><th>Student ID</th><th>Name</th><th>Year</th><th>Student Type</th><th>Registration Code</th><th>Entry AYSEM</th><th>Course</th><th>College</th></b></tr></thead<tbody><tr><td>'.$studentid.'</td><td>'.$name.'</td><td>'.$yearlevel.'</td><td>'.$studenttype.'</td><td>'.$registrationcode.'</td><td>'.$entryaysem.'</td><td>'.$program.'</td><td>'.$unit.'</td></tr></tbody></table>';
    // echo 'STUDENTID: '.$studentid.$enter.'NAME: '.$name.$enter.'AYSEM: '.$aysem.$enter.'COURSE: '.$programid.$enter.'YEAR LEVEL: '.$yearlevel.$enter.'STUDENT TYPE: '.$studenttype.$enter.'REGISTRATION CODE: '.$registrationcode.$enter.'ENTRYAYSEM: '.$entryaysem.$enter;
    
    echo $enter."<center><b><h3>STUDENT GRADES</h3></center></b>";

    $query = "select curriculumid from curricula_entryaysem where entryaysem = '$entryaysem' and programid = '$programid'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_row($result);
    $curriculumid = $row[0];

    echo '<br><b><h5 style="margin-bottom: 0; text-align: center">ACADEMIC</h5></b>';
    echo '<table class="ui celled table">
            <thead>
                <tr>
                <th>Subjectid</th>
                <th>Subject Code</th>
                <th>Subject Title</th>
                <th>Grade</th>
                <th>Currently Enrolled</th>
                <th>Result</th>
                </tr>
            </thead>
            <tbody>';  

    $query = "select curricula1.subjectid, year, sem, clusterid1, subject, subjecttitle from curricula1 join subjects on subjects.subjectid = curricula1.subjectid where curriculumid = '$curriculumid' order by year, sem";
    $result = mysqli_query($conn, $query);
    
    while($row = mysqli_fetch_row($result))
    {
        $active = 1; // Mag 0 siya pag tapos na 
        $curriculum_subjectid = $row[0];
        $curriculum_subject = $row[4];
        $curriculum_subjecttitle = $row[5];
        $year = $row[1];
        $sem = $row[2];
        echo '<tr>';
        echo '<td>'.$curriculum_subjectid.'</td>';
        echo '<td>'.$curriculum_subject.'</td>';
        echo '<td>'.$curriculum_subjecttitle.'</td>';

        for($i=0;$i<1;$i++)
        {
            // CHECK GRADES
            $query1 = "select * from grades where subjectid = '$curriculum_subjectid' and studentid = '$studentid' and remarks = 'PASSED'";
            $result1 = mysqli_query($conn, $query1);
            
            if(mysqli_num_rows($result1)>0)
            {
                $row1 = mysqli_fetch_row($result1);
                $grades = $row1[4];
                echo '<td>'.$grades.'</td>';
                // FOR ADJUSTING THE RESULT
                echo '<td></td>';
                $active = 0;
                break;
            }

            // CHECK CLUSTER SUBJECTS
            if($active == 1){
                $query1 = "select clusterid1 from curricula1 where subjectid = '$curriculum_subjectid' and curriculumid = '$curriculumid'";
                $result1 = mysqli_query($conn, $query1);
                $row1 = mysqli_fetch_row($result1); 
                $cluster_subjects = $row1[0];
                echo '<td>'.$cluster_subjects.'</td>';
                
                $cluster_subject = explode(', ', $cluster_subjects);
                for($i=1; $i<count($cluster_subject); $i++) // Naka 1 siya dahil hindi na isasama si index 0 which is yung same ng subject niya, bale yung ka-cluster subject niya lang yung ichecheck.
                {
                    $query1 = "select * from grades where subjectid = '$cluster_subject[$i]' and studentid = '$studentid' and remarks = 'PASSED'";
                    $result1 = mysqli_query($conn, $query1);
    
                    if(mysqli_num_rows($result1)>0)
                    {
                        $row1 = mysqli_fetch_row($result1);
                        $grades = $row1[4];
                        // echo 'Cluster Grade ['.$cluster_subject[$i].']: '.$grades.$enter;
                        echo '<td>'.$grades.'</td>';
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
                    // echo 'Incomplete: Yes'.$enter;
                    $row1 = mysqli_fetch_row($result1);
                    $inc_grade = $row1[0];
                    // echo 'Completion Grade: '.$inc_grade.$enter;
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
                    // echo 'Failed: Yes'.$enter;
                    $query2 = "select clusterid1 from curricula1 where subjectid='$curriculum_subjectid' and curriculumid = '$curriculumid'";
                    $result2 = mysqli_query($conn, $query2);
                    $row2 = mysqli_fetch_row($result2);  
                    $cluster_subjects2 = $row2[0];
                    // echo 'Cluster Subject of Failed Subject: '.$cluster_subjects2.$enter;
                    
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
                            echo '<td>Grade of Subject in Cross Enrolled: '.$row1[3].'</td>';
                            $active = 0;
                            break;
                        }
                        else if($row1[4] == 'I')
                        {
                            echo '<td>Completion Grade of Subject in Cross Enrolled: '.$row1[5].'</td>';
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
                    echo '<td>YES</td>';
                    $active = 0;
                    break;
                }      
                else
                    echo '<td>NO</td>';      
            }            
            
            if($active == 1)
                array_push($not_okay_subjects, $curriculum_subjectid);

        } // END OF FOR LOOP

        if($active == 0)
            echo '<td>PASSED</td>';
        else
            echo '<td style="color: red">FAILED</td>';


        // END LINE
        echo '</tr>';
    }

    echo '</tbody></table>';

    echo '<br><b><h5 style="margin-bottom: 0; text-align: center">PE</h5></b>';
    echo '<table class="ui celled table">
            <thead>
                <tr>
                <th>Subjectid</th>
                <th>Subject Code</th>
                <th>Subject Title</th>
                <th>Grade</th>
                <th>Result</th>
                </tr>
            </thead>
            <tbody>'; 

    $query1 = "select subjects.subjectid, subject, subjecttitle, finalgrade from grades join subjects on subjects.subjectid = grades.subjectid where studentid = '$studentid' and grades.remarks = 'PASSED' and subject like 'PE%'";
    $result1 = mysqli_query($conn, $query1);
    if(mysqli_num_rows($result1)>0)
    {
        while($row1 = mysqli_fetch_row($result1))
            echo '<tr><td>'.$row1[0].'</td><td>'.$row1[1].'</td><td>'.$row1[2].'</td><td>'.$row1[3].'</td><td>PASSED</td></tr>';
    }
    echo '</tbody></table>';

    echo '<br><b><h5 style="margin-bottom: 0; text-align: center">NSTP</h5></b>';
    echo '<table class="ui celled table">
            <thead>
                <tr>
                <th>Subjectid</th>
                <th>Subject Code</th>
                <th>Subject Title</th>
                <th>Grade</th>
                <th>Result</th>
                </tr>
            </thead>
            <tbody>';
    $query1 = "select subjects.subjectid, subject, subjecttitle, finalgrade from grades join subjects on subjects.subjectid = grades.subjectid where studentid = '$studentid' and grades.remarks = 'PASSED' and subject like 'NSTP%'";
    $result1 = mysqli_query($conn, $query1);
    
    if(mysqli_num_rows($result1)>0)
    {
        while($row1 = mysqli_fetch_row($result1))
            echo '<tr><td>'.$row1[0].'</td><td>'.$row1[1].'</td><td>'.$row1[2].'</td><td>'.$row1[3].'</td><td>PASSED</td></tr>';
    }

    echo '</tbody></table><br>';

    echo '<b><h4 style="margin-bottom: 0; text-align: center; color: #2962FF;">SUMMARY</h4></b>';
    echo '<table class="ui celled table">
            <thead>
                <tr>
                <th>ACADEMIC</th>
                <th>PE</th>
                <th>NSTP</th>
                </tr>
            </thead>
            <tbody>';
            
    if(count($not_okay_subjects)>0)
        echo '<td>FAILED</td>';
    else
        echo '<td>PASSED</td>';


    // CHECK PE
    $query1 = "select subjects.subjectid, subject, subjecttitle from grades join subjects on subjects.subjectid = grades.subjectid where studentid = '$studentid' and grades.remarks = 'PASSED' and subject like 'PE%'";
    $result1 = mysqli_query($conn, $query1);
    if(mysqli_num_rows($result1)>=4)
        echo '<td>PASSED</td>';
    else
    {
        echo '<td>FAILED</td>';
        array_push($not_okay_subjects, 'PE');
    }

    // CHECK NSTP
    $query1 = "select subjects.subjectid, subject, subjecttitle from grades join subjects on subjects.subjectid = grades.subjectid where studentid = '$studentid' and grades.remarks = 'PASSED' and subject like 'NSTP%'";
    $result1 = mysqli_query($conn, $query1);
    if(mysqli_num_rows($result1)>=2)
        echo '<td>PASSED</td>';
    else
    {
        echo '<td>FAILED</td>';
        array_push($not_okay_subjects, 'NSTP');
    }
        
    echo '</tbody></table>' . $enter;

    if(count($not_okay_subjects)>0)
    {
        echo '<b><h4 style="margin-bottom: 0; text-align: center">SUBJECT DEFICIENCIES</h4></b>';
        echo '<table class="ui celled table">
                <thead>
                    <tr>
                    <th>ID</th>
                    <th>Subject ID</th>
                    <th>Subject Code</th>
                    <th>Subject Title</th>
                    <th>Units</th>
                    </tr>
                </thead>
                <tbody>';  

        for($i=0; $i<count($not_okay_subjects); $i++)
        {
            if($not_okay_subjects == 'PE') 
            {
                echo '<tr>';
                echo '<td>'.($i+1).'</td><td>111</td><td>PE 11</td><td>PHYSICAL EDUCATION</td><td>(3.0)</td>';
                echo '</tr>';
            }
            else if($not_okay_subjects == 'NSTP')
            {
                echo '<tr>';
                echo '<td>'.($i+1).'</td><td>111</td><td>PE 11</td><td>PHYSICAL EDUCATION</td><td>(3.0)</td>';
                echo '</tr>';
            }
            else
            {
                $query1 = "SELECT subject, subjecttitle, credits from subjects where subjectid='$not_okay_subjects[$i]'";
                $result1 = mysqli_query($conn, $query1);
                $row1 = mysqli_fetch_row($result1);
                echo '<tr>';
                echo '<td>'.($i+1).'</td><td>'.$not_okay_subjects[$i].'</td><td>'.$row1[0].'</td><td>'.$row1[1].'</td><td>'.$row1[2].'</td>';
                echo '</tr>';
            }
        }

        echo '</tbody></table>';
    }

    if(count($not_okay_subjects)>0)
        echo '<br><br><b><div style="color: #2962FF; font-size: 24px; text-align: center">STATUS: NON GRADUATING</div></b><br>'.$enter;
    else
        echo '<br><br><b><div style="color: #2962FF; font-size: 24px; text-align: center">STATUS: GRADUATING</div></b><br>'.$enter;

    echo '<center><button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" style="width: 100px;" id="print" onclick="print_button();">print</button></center><br><br>';

?>
<script>
    function print_button(){
        $('#print').hide();
        print();
        $('#print').show();
    }
</script>