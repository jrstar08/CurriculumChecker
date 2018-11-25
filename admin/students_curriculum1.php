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
    <div class="ui container" id="navbar">
        <div class="ui secondary  menu">
            <a class="item" href="cross-enrolled.php">
            Cross-Enrolled
            </a>
            <a class="item" href="accreditation.php">
            Accreditation
            </a>
            <a class="item" href="generate_graduating_students.php">
            Generate Graduating Students
            </a>
            <a class="item" href="graduating_students.php">
            Graduating Students
            </a>
            <a class="active item" href="students_curriculum.php">
            Student's Curriculum
            </a>
            <div class="right menu">
                <a class="ui item" href="logout.php">
                    Logout
                </a>
            </div>
        </div>
    </div>
    <br>
    <div class="ui container" id="search">
        <div class="ui fluid action input">
                <input type="text" id="studentid" placeholder="Enter studentid..">
                <button class="ui button" id="search_student">Search</button>
        </div>
    </div>
    <div class="ui container" id="output"></div>
    <div style="width: 100%; margin: 40px auto;"><center><img id="loader" src="lib/loader.svg"></center></div>

    <script src="lib/semantic/semantic.min.js"></script>
    <script src="lib/jquery-3.2.1.js"></script>
    <script>
        $('#loader').hide();

        $('#search_student').click(function(){
            $('#loader').show();
            var studentid = $('#studentid').val();
            $.ajax({
                url:"students_curriculum_details.php",
                method:"POST",
                data:{
                    studentid:studentid
                },
                success:function(data){  
                    $('#loader').hide();
                    $("#output").html(data);
                }
            });
        });
    </script>
</body>
</html>