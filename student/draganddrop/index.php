<?php include_once ('connect.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PLM-CRS: Curriculum Checker</title>
    <link rel="shortcut icon" href="lib/plmlogo.png" />
    <!-- <link rel="stylesheet" href="jquery-ui.min.css"> -->
    <link rel="stylesheet" href="lib/mdb-css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="lib/mdb-css/style.css"> -->
    <script src="lib/mdb-js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="draganddrop-style.css">

</head>
<body>
    <div class="container1" style="width: 100%; margin: 2%;">
        <div id="HEADER">
            <h5>TOTAL UNITS (Year, Semester)</h5>
            <h6 class="header_total_units">First, First: 20</h6>
            <h6 class="header_total_units">First, Second: 20</h6>
            <h6 class="header_total_units">Second, First: 20</h6>
            <h6 class="header_total_units">Second, Second: 20</h6>
            <h6 class="header_total_units">Third, First: 20</h6>
            <h6 class="header_total_units">Third, Second: 20</h6>
            <h6 class="header_total_units">Third, Third: 6</h6>
            <h6 class="header_total_units">Fourth, First: 20</h6>
            <h6 class="header_total_units">Fourth, Second: 20</h6>
            <br><br>
        </div>
        <div id="launchPad">    
            <h5>Subjects</h5>
            <?php
                $query = "select curricula2.subjectid, subject, subjecttitle, curricula2.credits, year, sem from curricula2 join subjects on subjects.subjectid = curricula2.subjectid order by year, sem, subject";
                $result = mysqli_query($conn, $query);
                if(mysqli_num_rows($result))
                {
                    while($row = mysqli_fetch_row($result))
                    {
                        echo '<div class="card" id="subject_'.$row[0].'">['.$row[1].'] '.$row[2].'</div>';
                    }
                }
            ?>
        </div>

        <div id="dropZone">
            <div class="stack">
                    <div class="stackHdr">
                    First Year, First Semester 
                    </div>
                <div class="stackDrop1">
                </div>
            </div>
            <div class="stack">
                    <div class="stackHdr">
                    First Year, Second Semester 
                    </div>
                <div class="stackDrop2">
                </div>
            </div>

            <div class="stack">
                    <div class="stackHdr">
                    Second Year, First Semester 
                    </div>
                <div class="stackDrop3">
                </div>
            </div>
            <div class="stack">
                    <div class="stackHdr">
                    Second Year, Second Semester 
                    </div>
                <div class="stackDrop4">
                </div>
            </div>         
            <div class="stack">
                    <div class="stackHdr">
                    Third Year, First Semester 
                    </div>
                <div class="stackDrop5">
                </div>
            </div>
            <div class="stack">
                    <div class="stackHdr">
                    Third Year, Second Semester 
                    </div>
                <div class="stackDrop6">
                </div>
            </div>  

            
            <div class="stack">
                    <div class="stackHdr">
                    Third Year, Summer 
                    </div>
                <div class="stackDrop7">
                </div>
            </div>         
            <div class="stack">
                    <div class="stackHdr">
                    Fourth Year, First Semester 
                    </div>
                <div class="stackDrop8">
                </div>
            </div>
            <div class="stack">
                    <div class="stackHdr">
                    Fourth Year, Second Semester 
                    </div>
                <div class="stackDrop9">
                </div>
            </div>  
            <div class="stack">
                    <div class="stackHdr">
                    Fifth Year, First Semester 
                    </div>
                <div class="stackDrop8">
                </div>
            </div>
            <div class="stack">
                    <div class="stackHdr">
                    Fifth Year, Second Semester 
                    </div>
                <div class="stackDrop9">
                </div>
            </div>  
            <div class="stack">
                    <div class="stackHdr">
                    Sixth Year, First Semester 
                    </div>
                <div class="stackDrop10">
                </div>
            </div>
            <div class="stack">
                    <div class="stackHdr">
                    Sixth Year, Second Semester 
                    </div>
                <div class="stackDrop11">
                </div>
            </div>  
            
            <div class="clear_both"></div>
            <br>
            <button id="submit">First First</button>
            <button id="submit1">First Second</button>
        </div>
    
        
    </div>
    
    <script>
        var a = new Array();
        var b = new Array();
        var length1, length2;
    </script>
    <script src="jquery-1.5.2.js"></script>
    <script src="jquery-ui.min.js"></script>
    <script src="draganddrop-function.js"></script>
    <script>
        $(document).ready(function(){
            $('#submit').click(function(){
                //var a = $('.stackDrop2').val();
                //var b = $(".stackDrop1")[0];
                alert(a);
            });
            $('#submit1').click(function(){
                alert(b);
            });
        });
    </script>
</body>
</html>