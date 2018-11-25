<?php
    include ('connect.php');
    $college = $_POST['college'];
    $output = '';
    $output .= '<select class="w3-select" id="programs" name="option" style="float:left; width: 600px;">
                    <option value="" disabled selected>Select program</option>';
    
    $query = "SELECT programid, program, programtitle FROM programs WHERE unitid='".$college."'";
    $result = mysqli_query($conn, $query);
    while($row = mysqli_fetch_row($result))
    {
        $output .= '<option value="'.$row[0].'">' . $row[1] . ' | ' . $row[2] . '</option>';
    }

    $_SESSION['college'] = $college;

    $output .='</select>';
    echo $output;
?>

<script>
    $(document).ready(function() {
        $("#programs").change(function(){
            var program = $(this).val();
            
            $.ajax({  
                url:"ajax_program1.php",  
                method:"POST",  
                data:{
                    program: program
                },
                success:function(data){
                    $.ajax({  
                        url:"ajax_get_students.php",  
                        method:"POST",  
                        data:{
                        },
                        success:function(data){  
                            $("#result").html(data);
                        }  
                    });
                }  
            });
        });
    });
</script>