<?php 
    // DATABASE CONNECTION
    include ('connect.php'); 

    // INITIALIZATION OF SESSION VARIABLES
    $_SESSION['college'] = '';
    $_SESSION['program'] = '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="w3.css">
</head>
<body>
    <div style="float: left; padding: 10px;">
        <input class="w3-radio" type="radio" name="option1" value="all" style="padding: 10px;">
        <label>ALL</label>

        <input class="w3-radio" type="radio" name="option1" value="college" style="padding: 10px;">
        <label>COLLEGE</label>
    </div>  
    <div id="select-college" style="width: 80%; float: left; padding: 10px; display: none;">
        <select class="w3-select" name="option2" id="college" style="width: 40%; margin: 0 10px; float: left;">
            <option value="" disabled selected>Select College</option>
            <?php
                $query = "SELECT unitid, unit, unitname FROM units";
                $result = mysqli_query($conn, $query);
                while($row = mysqli_fetch_row($result)){
                    echo '<option value="' . $row[0] . '">' . $row[1] . " | " . $row[2] . '</option>';
                }
            ?>
        </select>
        <div id="select-program" style="display: none"></div>
        
    </div>
    <br><br><br>
    <div id="result"></div>
        
    <script src="jquery-3.2.1.js"></script>

    <script>
        $(document).ready(function() {
            $('input[type=radio][name=option1]').change(function(){
                if(this.value == 'all'){
                    $("#select-college").css("display", "none");
                    $.ajax({  
                        url:"ajax_get_students.php",  
                        method:"POST",  
                        data:{},
                        success:function(data){  
                            $("#result").html(data);
                        }  
                    });
                }
                else if(this.value == 'college'){
                    $("#select-college").css("display", "inline-block");
                    
                    $("#college").change(function(){
                        var college = $(this).val();

                        $.ajax({  
                            url:"ajax_program.php",  
                            method:"POST",  
                            data:{
                                college: college
                            },
                            success:function(data){  
                                $("#select-program").css("display", "inline-block");
                                $("#select-program").html(data);
                                $.ajax({  
                                    url:"ajax_get_students.php",  
                                    method:"POST",  
                                    data:{},
                                    success:function(data){  
                                        $("#result").html(data);
                                    }  
                                });
                            }  
                        });
                    });
                }
            });           
        });
    </script>
</body>
</html>