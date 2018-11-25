<?php
    include ('connect.php'); 

    $output = "";
    $college = $_SESSION['college'];
    $program = $_SESSION['program'];

    $query = "SELECT students.studentid, name, yearlevel FROM studentterms JOIN students ON studentterms.studentid = students.studentid WHERE aysem = 20172";
    
    if($college != '')
        $query .= " AND unitid = " . $college;
    if($program != '')
        $query .= " AND programid = " . $program;
    
    $output .= '<h3>LIST OF ENROLLED STUDENTS IN 20172</h3><table class="w3-table-all w3-hoverable">
                    <thead>
                    <tr class="w3-light-grey">
                        <th>Student ID</th>
                        <th>Name</th>
                        <th>Year Standing</th>
                    </tr>
                    </thead>';

    $result = mysqli_query($conn, $query);
    
    while($row = mysqli_fetch_row($result))
        $output .= '<tr><td>' . $row[0] . '</td><td>' . $row[1] . '</td><td>' . $row[2] . '</td></tr>';
    
    $output .= '</table>';
    
    echo $output;
?>