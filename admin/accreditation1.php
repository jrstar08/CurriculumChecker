<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="lib/semantic/semantic.min.css">
</head>
<body>
    <div class="ui container">
        <div class="ui secondary  menu">
            <a class="item" href="cross-enrolled.php">
            Cross-Enrolled
            </a>
            <a class="active item" href="accreditation.php">
            Accreditation
            </a>
            <a class="item" href="generate_graduating_students.php">
            Generate Graduating Students
            </a>
            <a class="item" href="graduating_students.php">
            Graduating Students
            </a>
            <a class="item" href="students_curriculum.php">
            Student's Curriculum
            </a>
            <div class="right menu">
                <a class="ui item" href="logout.php">
                    Logout
                </a>
            </div>
        </div>
    </div>

    <div class="ui container" style="margin-top: 20px;">
        <select class="ui search dropdown" id="curriculumid">
            <option value="">Search curriculum id</option>
            <?php
                include ('connect.php');
                $query = "select curriculumid, program, curriculum from curricula1 join programs on programs.programid = curricula1.programid group by curriculumid";
                $result = mysqli_query($conn, $query);
                while($row = mysqli_fetch_row($result))
                {
                    echo '<option value="'.$row[0].'">'.$row[1].' ['.$row[2].']</option>';
                }
            ?>
        </select>
        <button class="ui teal button" id="curriculum_submit">Submit</button>
        <div id="output" style="height: 560px; overflow: auto; margin-top: 15px;"></div>
    </div>
    
    <script src="lib/jquery-3.2.1.js"></script>
    <script src="lib/semantic/semantic.min.js"></script>
    <script>
        $('.ui.dropdown')
        .dropdown()
        ;
    </script>
    <script>
        $("#curriculum_submit").click(function() {
            var curriculumid = $("#curriculumid").val();
            // alert(curriculumid);
            if(curriculumid != '')
            {
                $.ajax({
                    url:"accreditation_display_subjects.php",
                    method:"POST",
                    data:{
                        curriculumid:curriculumid
                    },
                    success:function(data){  
                        $("#output").html(data);
                    }
                });
            }
            else
                alert('Select curriculum id');
        });
    </script>
</body>
</html>