<?php
    include ('connect.php');
    $unitid = $_POST['unitid'];
    $output = '';
    
    $output .= '<select class="mdb-select colorful-select dropdown-primary" id="all_course">';

    $query = "select programid, program, programtitle from programs where unitid = '$unitid'";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_row($result))
        $output .= '<option value="'.$row[0].'">'.$row[1].'</option>';

    $output .= '</select>';

    echo $output;
?>

<script>
    $(document).ready(function() {
        $('select').material_select();
    });
</script>

<script>
    $('#all_course').change(function(){
        course = ' and programs.programid = ' + this.value;
    });
</script>  