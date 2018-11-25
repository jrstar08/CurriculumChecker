<?php
    include ('connect.php');
    $subjects = $_POST['subjects'];
    $semester = $_POST['semester'];
    $studentid = $_SESSION['studentid'];

    $output = '';
    $error_subject = array();
    $error_prerequisite = array();
    for($i = 0; $i<count($subjects); $i++)
    {
        // CHECK PREREQUISITE(S)
        $query = "SELECT prerequisites from curricula2 where subjectid = '$subjects[$i]'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_row($result);
        $prerequisites = $row[0];
        $prerequisite = explode(', ', $prerequisites);

        $prerequisiteee = '';

        for($j=0; $j<count($prerequisite); $j++)
        {
            if($prerequisite[$j] != 'none' && $prerequisite[$j] != '3rd year standing' && $prerequisite[$j] != '4th year standing' && $prerequisite[$j] != 'incoming 4th year')
            {
                $query1 = "SELECT subjectid from studyplan_template where subjectid = '$prerequisite[$j]' and ((current_year = 0 and current_sem = 0) AND (enrolled = 0))";
                $result1 = mysqli_query($conn, $query1);
                if(mysqli_num_rows($result1)>0)
                {
                    $row = mysqli_fetch_row($result1);
                    $subject = $subjects[$i];
                    $prerequisiteee .= $row[0].', ';
                    array_push($error_subject, $subject); 
                    array_push($error_prerequisite, $prerequisiteee);
                }
            }
            else if($prerequisite[$j] != 'none' && $prerequisite[$j] == '3rd year standing')
            {
                // 31 kasi si 3rd yr, 1st sem
                if($semester < 31)
                {
                    $subject = $subjects[$i];
                    $prerequisiteee .= '3RD YEAR STANDING';
                    array_push($error_subject, $subject); 
                    array_push($error_prerequisite, $prerequisiteee);
                }
            }
            else if($prerequisite[$j] != 'none' && $prerequisite[$j] == '4th year standing')
            {
                // 41 kasi si 4TH yr, 1st sem
                if($semester < 41)
                {
                    $subject = $subjects[$i];
                    $prerequisiteee .= '4TH YEAR STANDING';
                    array_push($error_subject, $subject); 
                    array_push($error_prerequisite, $prerequisiteee);
                }
            }
            else if($prerequisite[$j] != 'none' && $prerequisite[$j] == 'incoming 4th year')
            {
                // 41 kasi si 4TH yr, 1st sem
                if($semester < 33)
                {
                    $subject = $subjects[$i];
                    $prerequisiteee .= 'INCOMING 4TH YEAR';
                    array_push($error_subject, $subject); 
                    array_push($error_prerequisite, $prerequisiteee);
                }
            }
        }
    }

    $array_error = array();

    for($i=0; $i<count($error_subject); $i++)
    {
        $subject1 = '';
        $prerequisite1 = '';

        $query = "SELECT subjecttitle from subjects where subjectid = '$error_subject[$i]'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_row($result);

        // if($i == 0)
        // echo "SORRY BUT YOU CAN'T ENLIST " . $row[0] . " BECAUSE YOU HAVE THE FOLLOWING PREREQUISITES: ";    
        // echo $row[0]. ' | ';
        $subject1 = $row[0];
        if($error_prerequisite[$i] != '3RD YEAR STANDING' && $error_prerequisite[$i] != '4TH YEAR STANDING' && $error_prerequisite[$i] != 'INCOMING 4TH YEAR')
        {
            $error_prerequisite_explode = explode(', ', $error_prerequisite[$i]);
            
            for($j=0; $j<count($error_prerequisite_explode)-1; $j++)
            {
                $query1 = "SELECT subjecttitle from subjects where subjectid = '$error_prerequisite_explode[$j]'";
                $result1 = mysqli_query($conn, $query1);
                $row1 = mysqli_fetch_row($result1);
                
                // echo $row1[0] . ', ';
                $prerequisite1 .= $row1[0] . ', ';
            }
            
            // echo '                                                                                                ';
        }
        else
        {
            $error_prerequisite_explode = explode(', ', $error_prerequisite[$i]);
            // echo $error_prerequisite_explode[0];
            $prerequisite1 .= $error_prerequisite_explode[0];
        }
        
        // echo '[' .$i . '] ' . $subject1 . ' ' . $prerequisite1 . ' '; 

        // if($i<count($error_subject))
        // {
            // if($i == (count($error_subject) - 1))
            //     $error_subject[($i)+1] = '';
            // if($error_subject[$i] != $error_subject[($i)+1])
                // echo "SUBJECT: " . $subject1 . " | " . $prerequisite1 . " || ";
                $a = $subject1 . ' | ' . $prerequisite1;
                array_push($array_error, $a);
        // }    
    }

    
    // WAIT LANG
        
    // for($i = count($array_error); $i>=0; $i--)
    // {
    //     if((substr($array_error[$i],0,5)) != (substr($array_error[$i-1],0,5)))
    //     {
    //         // $abc = $array_error[$i];
    //         continue;
    //     }
    //     else
    //     {
    //         echo $array_error[$i];
    //     }
    //     // }
    // }
    if(count($array_error)>0)
        echo $array_error[count($array_error)-1];
    else 
        echo '';
    


    // echo $array_error[0];
    // echo (substr($array_error[$i],0,5));
    // echo $abc;
    // echo "SUBJECT: " . $subject1 . " | " . $prerequisite1 . " || ";
    

?>