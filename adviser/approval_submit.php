      <?php
            include "smsGateway.php";
            include ('connect.php');
            $id = $_SESSION['studyplanid'];
            $number = '9058549984';
            $fname = $_SESSION['firstname'];
            $lname = $_SESSION['lastname'];
            $advisername = 'MS. ' . $fname . ' ' . $lname;
            $date = date("M d, Y");
            $datetime = date('Y-m-d H:i:s');  

            $query = "SELECT firstname, lastname from students join studyplan_approval on studyplan_approval.studentid = students.studentid where studyplanid = '$id'";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_row($result);
            $name = $row[0] . ' ' . $row[1];

            $smsGateway = new SmsGateway('jrsferrer2015@plm.edu.ph', 'celebi08');
            $deviceID = 77822;
            $number = '+63' . $number;
            $message = "HI ". $name . " YOUR STUDY PLAN WITH ID #" . $id . " HAS BEEN APPROVED BY " . $advisername ." ON " . $date . ". KINDLY CHECK IT AS SOON AS POSSIBLE. THANK YOU.";
            
            $result = $smsGateway->sendMessageToNumber($number, $message, $deviceID);

            $query = "update studyplan_approval set approve = 1, date_approved = now() where studyplanid = '$id'";
            $result = mysqli_query($conn, $query);
        ?>