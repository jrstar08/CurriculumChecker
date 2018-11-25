<?php 
    // include ('connect.php');

    function get_the_array_index($subject_array, $subj_id)
    {
        for($i=0; $i<count($subject_array); $i++)
        {
            if($subject_array[$i]["id"] == $subj_id)
                break;
        }
        return $i;
    }

    function fetch_all_subjects($conn)
    {
        $subject_array = array();             
        
        $query = "select * from curricula1 join subjects on curricula1.subjectid = subjects.subjectid where curriculumid = 200933";
        $result = mysqli_query($conn, $query);
        $ctr = 0;
        while($row = mysqli_fetch_array($result))
        {
            $check = 1;
            $subject_id = $row["subjectid"];
            $subject_title = $row["subjecttitle"];
            $year = $row["year"];
            $sem = $row ["sem"];
            $units = $row["credits"];
            $prerequisites = $row["prerequisites"];
            $corequisites = $row["required_subjects"];
            $curriculum_id = $row["curriculumid"];
            $curriculum = $row["curriculum"];
            $unit_id = $row["unitid"];
            $program_id = $row["programid"];
            $cluster_id = $row["clusterid1"];
                     
            $subject_array[$ctr]["subject_id"] = $subject_id;
            $subject_array[$ctr]["subject_title"] = $subject_title;
            $subject_array[$ctr]["year"] = $year;
            $subject_array[$ctr]["sem"] = $sem;
            $subject_array[$ctr]["units"] = $units;
            $subject_array[$ctr]["prerequisites"] = $prerequisites;
            $subject_array[$ctr]["corequisites"] = $corequisites;
            $subject_array[$ctr]["curriculum_id"] = $curriculum_id;
            $subject_array[$ctr]["curriculum"] = $curriculum;
            $subject_array[$ctr]["unit_id"] = $unit_id;
            $subject_array[$ctr]["program_id"] = $program_id;
            $subject_array[$ctr]["cluster_id"] = $cluster_id;
            $subject_array[$ctr]["subject_taken"] = 0;
            $subject_array[$ctr]["availability"] = 1;

            $ctr++; // NEXT ARRAY SUNOD OR INCREMENT
        }    

        return $subject_array;
    }

    function get_taken_subjects($p_year, $p_sem, &$curriculum_subjects, $conn, $studentid) // p_ means parameter; p_year = parameter year
    {
        $ctr = 0;
        $subject_array = array();

        for($i=0; $i<count($curriculum_subjects); $i++)
        {
            $check = 1;

            if($curriculum_subjects[$i]["year"] == $p_year && $curriculum_subjects[$i]["sem"] == $p_sem)
            {              
                $subject_id = $curriculum_subjects[$i]["subject_id"];
                $subject_title = $curriculum_subjects[$i]["subject_title"];
                $units = $curriculum_subjects[$i]["units"];

                // CHECK IF SUBJECT HAS GRADE IN GRADES TABLE
                $query1 = "select * from grades where studentid = '$studentid' and subjectid = '$subject_id' and remarks = 'PASSED'";
                $result1 = mysqli_query($conn, $query1);
                if(mysqli_num_rows($result1) <= 0)
                    $check = 0;

                // ACCREDITATION

                // CROSS-ENROLLED

                if($check == 1)
                {
                    $curriculum_subjects[$i]["subject_taken"] = 1;
                    $curriculum_subjects[$i]["availability"] = 0;

                    $subject_array[$ctr]["id"] = $subject_id;
                    $subject_array[$ctr]["title"] = $subject_title;
                    $subject_array[$ctr]["units"] = $units;
                    $subject_array[$ctr]["subject_taken"] = 1;

                    $ctr++; // INCREMENT THE ARRAY INDEX
                }

            }
        }

        $_SESSION['curriculum_subjects'] = $curriculum_subjects;
        return $subject_array;
    }

    function get_sub_total_units($p_year, $p_sem, $conn, $studentid) // p_ means parameter; p_year = parameter year
    {
        $curriculum_subjects_in_function = $_SESSION['curriculum_subjects'];
        $total_units = 0;

        for($i=0; $i<count($curriculum_subjects_in_function); $i++)
        {
            if($curriculum_subjects_in_function[$i]["year"] == $p_year && $curriculum_subjects_in_function[$i]["sem"] == $p_sem && $curriculum_subjects_in_function[$i]["availability"] == 0)
                $total_units += $curriculum_subjects_in_function[$i]["units"];     
        }

        return $total_units;
    }

    function get_remaining_subjects()
    {
        $curriculum_subjects_in_function = $_SESSION['curriculum_subjects'];
        $remaining_subjects = 0; 

        for($i=0; $i<count($curriculum_subjects_in_function); $i++)
        {
            if($curriculum_subjects_in_function[$i]["availability"] == 1)
                $remaining_subjects++;
        }

        return $remaining_subjects;
    }

    function get_total_units_enrolled($conn,$studentid)
    {
        $curriculum_subjects_in_function = $_SESSION['curriculum_subjects'];
        $total = 0;
        $total += get_sub_total_units(1,1,$conn,$studentid);   
        $total += get_sub_total_units(1,2,$conn,$studentid);
        $total += get_sub_total_units(1,3,$conn,$studentid);     
        $total += get_sub_total_units(2,1,$conn,$studentid);
        $total += get_sub_total_units(2,2,$conn,$studentid);
        $total += get_sub_total_units(2,3,$conn,$studentid);
        $total += get_sub_total_units(3,1,$conn,$studentid);
        $total += get_sub_total_units(3,2,$conn,$studentid);
        $total += get_sub_total_units(3,3,$conn,$studentid);
        $total += get_sub_total_units(4,1,$conn,$studentid);
        $total += get_sub_total_units(4,2,$conn,$studentid);
        $total += get_sub_total_units(4,3,$conn,$studentid);
        $total += get_sub_total_units(5,1,$conn,$studentid);
        $total += get_sub_total_units(5,2,$conn,$studentid);
        $total += get_sub_total_units(5,3,$conn,$studentid);
        $total += get_sub_total_units(6,1,$conn,$studentid);
        $total += get_sub_total_units(6,2,$conn,$studentid);
        $total += get_sub_total_units(6,3,$conn,$studentid);
        $total += get_sub_total_units(7,1,$conn,$studentid);
        $total += get_sub_total_units(7,2,$conn,$studentid);
        $total += get_sub_total_units(7,3,$conn,$studentid);

        $total_units_enrolled = 0;
        for($i=0; $i<count($curriculum_subjects_in_function); $i++)
        {
            $total_units_enrolled += $curriculum_subjects_in_function[$i]["units"];
        }

        return $total."/".$total_units_enrolled;
    }

    function get_all_remaining_subjects($conn,$studentid)
    {
        $curriculum_subjects_in_function = $_SESSION['curriculum_subjects'];
        $remaining_subjects = array();
        $ctr = 0;

        for($i=0; $i<count($curriculum_subjects_in_function); $i++)
        {
            if($curriculum_subjects_in_function[$i]["availability"] == 1)
            {
                $remaining_subjects[$ctr]["subject_id"] = $curriculum_subjects_in_function[$i]["subject_id"];
                $remaining_subjects[$ctr]["subject_title"] = $curriculum_subjects_in_function[$i]["subject_title"];
                $remaining_subjects[$ctr]["units"] = $curriculum_subjects_in_function[$i]["units"];
                $ctr++;
            }
        }

        return $remaining_subjects;
    }
?>