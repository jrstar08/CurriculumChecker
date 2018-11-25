<?php
   //fetch.php
   $connect = mysqli_connect("localhost", "root", "", "plmcrsdb");
   $columns = array('studentid', 'subjectid', 'finalgrade', 'status', 'completiongrade', 'subjectcode', 'aysem', 'schoolid');
   
   $query = "SELECT * FROM cross_enrolled_subjects WHERE active = 1 ";
   
   if(isset($_POST["search"]["value"]))
   {
    $query .= '
    AND (studentid LIKE "%'.$_POST["search"]["value"].'%" 
    OR subjectid LIKE "%'.$_POST["search"]["value"].'%" 
    OR finalgrade LIKE "%'.$_POST["search"]["value"].'%" 
    OR status LIKE "%'.$_POST["search"]["value"].'%" 
    OR completiongrade LIKE "%'.$_POST["search"]["value"].'%" 
    OR subjectcode LIKE "%'.$_POST["search"]["value"].'%" 
    OR aysem LIKE "%'.$_POST["search"]["value"].'%" 
    OR schoolid LIKE "%'.$_POST["search"]["value"].'%" )
    ';
   }
   
   if(isset($_POST["order"]))
   {
    $query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' 
    ';
   }
   else
   {
    $query .= 'ORDER BY id DESC ';
   }
   
   $query1 = '';
   
   if($_POST["length"] != -1)
   {
    $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
   }
   
   $number_filter_row = mysqli_num_rows(mysqli_query($connect, $query));
   
   $result = mysqli_query($connect, $query . $query1);
   
   $data = array();
   
   while($row = mysqli_fetch_array($result))
   {
    $sub_array = array();
    $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="studentid">' . $row["studentid"] . '</div>';
    $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="subjectid">' . $row["subjectid"] . '</div>';
    $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="finalgrade">' . $row["finalgrade"] . '</div>';
    $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="status">' . $row["status"] . '</div>';
    $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="completiongrade">' . $row["completiongrade"] . '</div>';
    $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="subjectcode">' . $row["subjectcode"] . '</div>';
    $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="aysem">' . $row["aysem"] . '</div>';
    $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="schoolid">' . $row["schoolid"] . '</div>';
   
    $sub_array[] = '<button type="button" name="delete" class="btn btn-danger btn-xs delete" id="'.$row["id"].'">Delete</button>';
    $data[] = $sub_array;
   }
   
   function get_all_data($connect)
   {
    $query = "SELECT * FROM cross_enrolled_subjects where active = 1";
    $result = mysqli_query($connect, $query);
    return mysqli_num_rows($result);
   }
   
   $output = array(
    "draw"    => intval($_POST["draw"]),
    "recordsTotal"  =>  get_all_data($connect),
    "recordsFiltered" => $number_filter_row,
    "data"    => $data
   );
   
   echo json_encode($output);
   
?>