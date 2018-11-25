<?php
    include('connect.php');
    $subjectid = $_POST['id'];
    $_SESSION['edit-id'] = $subjectid;
    $curriculumid = $_SESSION['curriculumid'];
    $output = '';

    $query0 = "SELECT subject, subjecttitle, clusterid1 FROM curricula1 JOIN subjects on subjects.subjectid = curricula1.subjectid where curricula1.subjectid = '$subjectid' and curriculumid = '$curriculumid' limit 1";
    $result0 = mysqli_query($conn, $query0);
    $row0 = mysqli_fetch_row($result0);
    $cluster = $row0[2];
    $clusterid = explode(', ', $cluster);

    $output .= '<table class="ui selectable celled table" id="accreditation_table">
                    <thead>
                        <tr>
                            <th>Subjectid</th>
                            <th>Subject Code</th>
                            <th>Subject Title</th>
                            <th>Units</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                    <tbody>';

    for($i=0; $i<count($clusterid); $i++)
    {
        $query = "SELECT subjectid, subject, subjecttitle, credits from subjects where subjectid = '$clusterid[$i]'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_row($result);
        $cluster_subjectid = $row[0];
        $cluster_subject = $row[1];
        $cluster_subjecttitle = $row[2];
        $cluster_credits = $row[3];

        $output .= '<tr><td>'.$cluster_subjectid.'</td><td>'.$cluster_subject.'</td><td>'.$cluster_subjecttitle.'</td><td>'.$cluster_credits.'</td><td>';
        if($subjectid != $cluster_subjectid)
            $output .= '<button class="ui red button remove_button" id="remove_'.$cluster_subjectid.'"><img src="lib/delete.png" style="width: 16px;"></button>';
        $output .= '</td></tr>';
    }

    $output .= '</tbody></table>';
                
    echo $row0[1] . '|' . $output;
?>

<script>
    $('.remove_button').click(function() {
        var id = this.id;
        id = id.split('_');
        $.ajax({
            url:"accreditation_remove_cluster_subject.php",
            method:"POST",
            data:{
                id:id[1],
                subjectid:<?php echo $subjectid; ?>
            },
            success:function(data){
                if(data == 'success')
                    location.reload();
                else
                    alert('error');
            }
        });
    });
</script>