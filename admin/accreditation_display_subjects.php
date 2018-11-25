<?php 
    include ('connect.php');
    $curriculumid = $_POST['curriculumid'];
    $_SESSION['curriculumid'] = $curriculumid;
    $output = '';
    $output .= '<table class="ui selectable celled table" id="accreditation_table">
    <thead>
      <tr>
        <th>Subjectid</th>
        <th>Subject Code</th>
        <th>Subject Title</th>
        <th>Cluster Subjects</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>';

    $query = "SELECT curricula1.subjectid, subject, subjecttitle, clusterid1 from curricula1 join subjects on subjects.subjectid = curricula1.subjectid where curriculumid='$curriculumid'";
    $result = mysqli_query($conn, $query);
    
    while($row = mysqli_fetch_row($result))
    {
        $subjectid = $row[0];
        $subject = $row[1];
        $subjecttitle = $row[2];
        $cluster = $row[3];
        $clusterid = explode(', ', $cluster);
        $cluster_subjects = '';

        for($i=0; $i<count($clusterid); $i++)
        {
            $query1 = "SELECT subject from subjects where subjectid = '$clusterid[$i]'";
            $result1 = mysqli_query($conn, $query1);
            $row1 = mysqli_fetch_row($result1);
            $cluster_subjects .= $row1[0] . ', ';
        }

        $output .= '<tr>
                        <td>'.$subjectid.'</td>
                        <td>'.$subject.'</td>
                        <td>'.$subjecttitle.'</td>
                        <td>'.$cluster_subjects.'</td>
                        <td>
                            <button class="ui blue button add_button" id="add_'.$subjectid.'">
                                <img src="lib/edit.png" style="width: 20px;">
                            </button>
                            <button class="ui red button delete_button" id="delete_'.$subjectid.'">
                            <img src="lib/delete.png" style="width: 20px;">
                        </button>
                        </td>
                    </tr>';
    }
    
    $output .= '</tbody>
  </table>';
  echo $output;
?>

<script>
    $('.delete_button').click(function() {
        var id = this.id;
        id = id.split('_');
        $(".edit").modal('show');
        $(".edit").modal({
            closable: true
        });
        $.ajax({
            url:"accreditation_sending_session.php",
            method:"POST",
            data:{
                id:id[1],
            },
            success:function(data){
                var data = data.split('|');
                $(".modal-title").html(data[0]);
                $(".modal-body").html(data[1]);
            }
        });
    });

    $('.add_button').click(function() {
        var id = this.id;
        id = id.split('_');
        location = "accreditation_add_cluster_subjects.php?id=" + id[1];
    });
</script>