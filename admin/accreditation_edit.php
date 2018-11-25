<style>
    table{
        font-family: segoe ui;
        text-align: left;
        width: 100%;
    }
    a{
        color: black;
        text-decoration: none;
        transition: 0.5s;
    }
    a:hover{
        font-size: 120%;
        font-weight: bold;
    }
</style>

<?php
    include ('connect.php');
    $subjectid = $_SESSION['edit-id'];
    $curriculumid = $_SESSION['curriculumid'];
    
    $query = "SELECT curricula1.subjectid, subject, subjecttitle, clusterid1 FROM curricula1 JOIN subjects on subjects.subjectid = curricula1.subjectid where curricula1.subjectid = '$subjectid' and curriculumid = '$curriculumid'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_row($result);

    echo '<br><a href="accreditation.php"><b>< BACK </b></a><br><br>';
    echo 'SUBJECTID: ' . $row[0]. '<br>';
    echo 'SUBJECT CODE: ' . $row[1]. '<br>';
    echo 'SUBJECT TITLE: ' . $row[2]. '<br>';
    echo '<br><hr><br><center><b>CLUSTER SUBJECTS</b></center><br><hr><br>';
    $cluster = $row[3];
    $clusterid = explode(', ', $cluster);
    echo '<input type="text" value="'.$cluster.'" hidden>';

    $output = '';
    $output .= '<center><button>ADD</button></center><br>';
    $output .= '<table><tr><th>Subject ID</th><th>Subject Code</th><th>Subject Title</th><th>Units</th><th>Action</th></tr>';
    
    for($i=0; $i<count($clusterid); $i++)
    {
        $query = "SELECT subjectid, subject, subjecttitle, credits from subjects where subjectid = '$clusterid[$i]'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_row($result);
        $cluster_subjectid = $row[0];
        $cluster_subject = $row[1];
        $cluster_subjecttitle = $row[2];
        $cluster_credits = $row[3];

        $output .= '<tr><td>'.$cluster_subjectid.'</td><td>'.$cluster_subject.'</td><td>'.$cluster_subjecttitle.'</td><td>'.$cluster_credits.'</td><td><button class="remove_button" id="remove_'.$cluster_subjectid.'">Remove</button></td></tr>';
    }

    $output .= '</table>';

    echo $output;
?>

<script src="lib/jquery-3.2.1.js"></script>
<script>
    $('.remove_button').click(function() {
        var id = this.id;
        id = id.split('_');
        alert(id[1]);

        // $.ajax({
        //     url:"accreditation_sending_session.php",
        //     method:"POST",
        //     data:{
        //         id:id[1],
        //     },
        //     success:function(data){  
        //         location="accreditation_edit.php";
        //     }
        // });
    });
</script>
