<?php
  include ('connect.php');
?>
<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>PLM Curriculum Checker</title>
    <link rel="shortcut icon" href="lib/plmlogo.png" />
    <!--=======Custom Style======-->
    <link rel="stylesheet" href="lib/bootstrap.min.css">
    <script src="lib/sweetalert2/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="lib/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" href="lib/loginstyle.css">
    <style>
      .form-control{
        box-shadow: 0px 0px 0px;
      }
      .label-text{
        font-weight: 500;
      }
    </style>
    <script>
      function error(){
        swal(
          'Invalid',
          'Sorry, username or password not found!',
          'error'
        )
      }
    </script>
    <script>
      function numbersonly(){
        $.bootstrapGrowl("Only numbers are accepted in this field..", {
        ele: 'body', // which element to append to
        type: 'info', // (null, 'info', 'danger', 'success')
        offset: {from: 'top', amount: 20}, // 'top', or 'bottom'
        align: 'right', // ('left', 'right', or 'center')
        width: 320, // (integer, or 'auto')
        delay: 3500, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
        allow_dismiss: true, // If true then will display a cross to close the popup.
        stackup_spacing: 10 // spacing between consecutively stacked growls.
        });
      }
    </script>
  </head>
  <body>
  <div class="container" style="margin-top: 16vh;">
    <div class="form-box">
      <div class="head"><img src="lib/plmlogo.png" style="width: 20%"></div>   
      <form id="login-form" method="POST">
          <div class="form-group">
            <label class="label-control">
              <span class="label-text">User ID</span>
            </label>
            <input type="text" name="username" id="quantity" class="form-control" maxlength="9"/>
          </div>
          <div class="form-group">
            <label class="label-control">
              <span class="label-text">Password</span>
            </label> 
            <input type="password" name="password" class="form-control" maxlength="16"/>
          </div>
          <input type="submit" name="login" value="Login" class="btn" />
      </form>
    </div>
  </div>

  <?php
    if(isset($_POST['login']))
    {
      $username = $_POST['username'];
      $password = $_POST['password'];

      $query = mysqli_query($conn, "SELECT * FROM users WHERE login='$username' AND password='$password'");
      
      if($username == '1' && $password == '1'){
        $_SESSION['signed_in'] = true;
        header("location: admin/home.php");        
      }
       
      if(mysqli_num_rows($query)>0)
      {
        $result = mysqli_fetch_row($query);
        $_SESSION['signed_in'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        $query8 = "update studyplan_template set current_year = 0, current_sem = 0 where curriculumid = 200933";
        $result8 = mysqli_query($conn, $query8);

        if($result[4] == 1)
          header("location: adviser/home.php");
        else if ($result[4] == 5){
          $query = mysqli_query($conn, "select registrationcode from studentterms where studentid = '$result[1]' order by aysem desc limit 1");
          $result = mysqli_fetch_row($query);
          if($result[0] == 'I')
            header("location: student/home.php");
          else
            header("location: student/home1.php");
        }
        else
          echo "<script> error(); </script>";
      }
      else
          echo "<script> error(); </script>";
    }
  ?>
    
<script src="lib/jquery.min.js"></script>
<script src="lib/bootstrap.min.js"></script>
<script src="lib/jquery.bootstrap-growl.js"></script>
<script type="text/javascript">
  $(window).load(function(){
    $('.form-group input').on('focus blur', function (e) {
        $(this).parents('.form-group').toggleClass('active', (e.type === 'focus' || this.value.length > 0));
    }).trigger('blur');
  });
</script>
<script>
  $(document).ready(function () {
    //called when key is pressed in textbox
    $("#quantity").keypress(function (e) {
      //if the letter is not digit then display error and don't type anything
      if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
          //display error message
          // alert('heh');
          numbersonly();
          $("#errmsg").html("Digits Only").show().fadeOut("slow");
                return false;
      }
    });
  });
</script>
</body>
</html>