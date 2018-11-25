<?php 
    include('connect.php');     
    $entryaysem = $_SESSION['entryaysem']; 
    $aysem = $_SESSION['aysem']; 
    $studyplanid = $_SESSION['studyplanid'];
    $yearlevel = $_SESSION['yearlevel'];
    $sem = substr($aysem, -1);
    $ys = $yearlevel.$sem;
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="lib/sweetalert2/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="lib/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" href="lib/material.indigo-red.min.css">
    <link rel="stylesheet" href="material-icons.css">
    <script defer src="lib/material.min.js"></script>
    <link rel="stylesheet" type="text/css" href="lib/semantic.min.css">
    <script src="lib/jquery-3.1.1.min.js"></script>
    <script>
        function error(id){
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
              }).then((result) => {
                if (result) {
                    console.log(id);
                  swal(
                    'Deleted!',
                    'Selected subject has been deleted.',
                    'success'
                  ).then((result) => {
                    if (result) {
                        $.ajax({  
                            url:"edit_delete.php",  
                            method:"POST",  
                            data: {id:id},
                            success:function(data){}  
                        });
                        location = 'edit_studyplan.php';
                    }
                  })
                }
              })
        }
        function edit(id){
            alert('edit button');
            $("#edit_"+id).click(function(){
                // $(".add").modal('setting', 'transition', 'horizontal flip').modal('show');
                alert('hehe');
            });
            $(".add").modal({
                closable: true
            });

            $.ajax({  
                url:"edit_edit.php",  
                method:"POST",  
                data: {id:id},
                success:function(data){}  
            });
        }
        function tanong(){
            swal({
                title: 'Are you sure?',
                text: "",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!'
              }).then((result) => {
                if (result) {
                  swal(
                    'Submitted!',
                    'Please wait for the approval.',
                    'success'
                  ).then((result) => {
                    if (result) {
                        $.ajax({  
                            url:"edit_submit.php",  
                            method:"POST",  
                            data: {},
                            success:function(data){
                                // alert(data);
                                reset();
                            }  
                        });
                        location = 'home.php';
                    }
                  })
                }
              })
        }
    </script>
</head>
<body style="margin: 0; padding: 0;">
    <div style="width:100%; height: 60px; background-color: rgba(138, 8, 8, 1);"><center><img src="lib/plmlogo.png" width="50px" style="margin: 5px;" /></center></div>
    <div style="background-color: #B71C1C; height: 60px; box-shadow: 0px 0px 1px #000; padding: 20px; margin-bottom: 20px;">
        <div style="float: left">
            <a href="home.php" style="color: white">
            <i class="material-icons">home</i>
        </div>
        <div style="float: left; padding: 0; margin: 0; color: white; font-family: segoe ui; margin-left: 10px; margin-top: 3px;">
            HOME
        </div>
        </a>
        <div style="color: white; text-align: right; margin-top: 3px; font-weight: bold; font-size: 105%;">STUDY PLAN - EDIT PAGE</div>
    </div>

    <div class="ui container">
        <div style="margin-left: 39.15%; top: 85vh; position:fixed;">
            <button id="add_subject" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
                <i class="material-icons">add</i>
            </button>
        </div>
        <div id="output"></div>
        <div id="output1"></div>
        <br><br>
        <center>
            <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" id="submit_studyplanbutton">
            SUBMIT STUDY PLAN
            </button>
        </center>
        <br><br><br><br><br><br><br>
        <input type="text" id="check_prerequisite_error" hidden>
        <input type="text" id="check_overload_error" hidden>
    </div>

<script src="lib/jquery-3.2.1.js"></script>
<script src="lib/semantic.min.js"></script>

<!-- ADD SUBJECT -->
<div class="ui longer modal add">
  <i class="close"><i class="material-icons">close</i></i>
  <div class="header">
    ADD SUBJECT
  </div>
  <div class="image content">
    <div class="ui medium image" style="width: 20%">
      <img src="lib/subject.png">
    </div>
    <div class="description" style="width: 80%;">
      <div class="ui header">SELECT SEMESTER AND SUBJECT(S)</div>
      <!-- Semester -->
      <div class="ui sub header">Single</div>
      <select name="skills" class="ui fluid search dropdown" id="semester">
        <?php
                echo '<option value="">Select semester..</option>';
            if($ys < 11)
                echo '<option value="11">First Year, First Semester</option>';
            if($ys < 12)
                echo '<option value="12">First Year, Second Semester</option>';
            // <!-- <option value="13">First Year, Summer</option> -->
            if($ys < 21)
                echo '<option value="21">Second Year, First Semester</option>';
            if($ys < 22)
                echo '<option value="22">Second Year, Second Semester</option>';
            // <!-- <option value="23">Second Year, Summer</option> -->
            if($ys < 31)
                echo '<option value="31">Third Year, First Semester</option>';
            if($ys < 32)
                echo '<option value="32">Third Year, Second Semester</option>';
            if($ys < 33)
                echo '<option value="33">Third Year, Summer</option>';
            if($ys < 41)
                echo '<option value="41">Fourth Year, First Semester</option>';
            if($ys < 42)
                echo '<option value="42">Fourth Year, Second Semester</option>';
            // <!-- <option value="43">Fourth Year, Summer</option> -->
            if($ys < 51)
                echo '<option value="51">Fifth Year, First Semester</option>';
            if($ys < 52)
                echo '<option value="52">Fifth Year, Second Semester</option>';
            // <!-- <option value="53">Fifth Year, Summer</option> -->
            if($ys < 61)
                echo '<option value="61">Sixth Year, First Semester</option>';
            if($ys < 62)
                echo '<option value="62">Sixth Year, Second Semester</option>';
            // <!-- <option value="63">Sixth Year, Summer</option> -->
        ?>
      </select>

      <!-- Subject -->
      <div class="ui form" style="margin-top: 10px">
        <div class="field">
            <label>Subject</label>
            <select multiple="" class="ui dropdown" id="subjects">
            <option value="">Select subject(s)..</option>
            <?php
                $query = 'select subjects.subjectid, subject, subjecttitle, studyplan_template.credits, year, sem, current_year, current_sem, prerequisites, studyplan_template.clusterid from studyplan_template join subjects on subjects.subjectid = studyplan_template.subjectid where curriculumid=200933 and current_year = 0 and current_sem = 0 and enrolled = 0 order by year, sem';
                $result = mysqli_query($conn, $query);
                $output .= '';  
                while($row = mysqli_fetch_row($result))
                {
                    $output .= '<option value="'.$row[0].'">'.$row[2] . '</option>';
                }
                echo $output;
            ?>
            </select>
        </div>
     </div>
      
    </div>
  </div>
  <div class="actions">
    <button class="ui black deny button">
      Cancel
    </button>
    <button class="ui positive right button" id="submit">
      Submit
    </button>
  </div>
</div>

<script>
    $('.ui.dropdown').dropdown();
</script>

<script>
    $(document).ready(function(){
        $("#add_subject").click(function(){
            $(".add").modal('setting', 'transition', 'horizontal flip').modal('show');
        });
        $(".add").modal({
            closable: true
        });
    });
</script>

<script>
    $("#submit_studyplanbutton").click(function(){
        tanong();
    });
</script>

<script>
    function reset(){
        $.ajax({  
            url:"edit_reset.php",  
            method:"POST",  
            data: {},
            success:function(data){}  
        });  
    }
    function fetch(){
        $.ajax({  
            url:"edit_fetch.php",  
            method:"POST",  
            data: {},
            success:function(data){  
                $("#output").html(data);
            }  
        });  
    }
    function foo(name)
    {
        error = name.split(" | ");
        subject = error[0];
        prerequisite = error[1];
        swal(
            subject,
            'PREREQUISITE(S): ' + prerequisite,
            'error'
        ).then((result) => {
            // alert('heh');
            location="edit_studyplan.php";
        });
    }
    function foo1(name)
    {
        swal(
            'Overload..',
            'Sorry, the maximum load for this semester is ' + name + ' units only..',
            'error'
        ).then((result) => {
            // alert('heh');
            location="edit_studyplan.php";
        });
    }
    function insert(){
        var subjects = $('#subjects').val();
        var semester = $('#semester').val();

        $.ajax({  
            url:"edit_error.php",  
            method:"POST",  
            data: {
                subjects:subjects,
                semester:semester
            },
            success:function(data){
                $('#check_prerequisite_error').val(data);

                var check_error = $('#check_prerequisite_error').val();
                if(check_error != '')
                    foo(check_error);
                else
                {
                    $.ajax({  
                        url:"edit_insert.php",  
                        method:"POST",  
                        data: {
                            subjects:subjects,
                            semester:semester
                        },
                        success:function(data){
                            // alert(data);
                            $('#check_overload_error').val(data);

                            var check_overload = $('#check_overload_error').val();
                        
                            if(check_overload != '')
                                // alert(check_overload);
                                foo1(check_overload);
                            else

                            location="edit_studyplan.php";
                        }  
                    });
                }
            }  
        });

        // To clear the selected subjects in dropdown or select
        // location="sidenav.php";
    }
</script>
<script>
    $(document).ready(function() {
        fetch();
        // $("#add").click(function(){
        //     insert();
        // });
        $('#submit').click(function(){
        // CHECKING PREREQUISITES OR ERRORS
            // may lalabas na sweetalert kapag may error
            // error();

            // INSERTING IN DATABASE
            insert();
        });

    });
</script>
</body>
</html>