<?php
    include('connect.php'); 

    if($_SESSION['active_custom'])
    {
        echo "<center><h4>INSTRUCTIONS!</h4>
        <h5>1. Click the red plus circle button to add a subject.</h5>
        <h5>2. Click the red plus circle button to add a subject.</h5>
        <h5>3. Click the red plus circle button to add a subject.</h5>
        <h5>4. Click the red plus circle button to add a subject.</h5>
        <h5>5. Click the red plus circle button to add a subject.</h5>
        <h5>6. Click the red plus circle button to add a subject.</h5>
        <h5>BY ERICKA GONZALES</h5>
        </center>";
    }
    

    $_SESSION['active_custom'] = false;


    $output = '';
    // FIRST YEAR, FIRST SEM
    $totalunits = 0;
    $query = 'select subjects.subjectid, subject, subjecttitle, studyplan_template.credits, year, sem, current_year, current_sem, prerequisites, studyplan_template.clusterid from studyplan_template join subjects on subjects.subjectid = studyplan_template.subjectid where curriculumid=200933 and current_year = 1 and current_sem = 1 order by year, sem, subject';
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result)>0)
    {
        $output .= '
                <h4>First Year, First Semester</h4>
                <table class="ui red table">
                <thead>
                    <tr>
                    <th width="10%">Subject Code</th>
                    <th width="65%">Subject Title</th>
                    <th width="10%">Units</th>
                    <th width="15%">Action</th>
                    </tr>
                </thead>
                <tbody>
                ';
        while($row = mysqli_fetch_row($result))
        {
            $output .= '
                    <tr>
                    <td>'.$row[1].'</td>
                    <td>'.$row[2].'</td>
                    <td>'.$row[3].'</td>
                    <td>
                        <button class="ui red button delete_button" id="delete_'.$row[0].'"><i class="material-icons">close</i></button>
                    </td>
                    </tr>
            ';
            $totalunits += $row[3];
        }
        $output .= '
                </tbody>
                </table>
                <h5>Total Units: '.$totalunits.'</h5>
        ';
    }

    // FIRST YEAR, SECOND SEM
    $totalunits = 0;
    $query = 'select subjects.subjectid, subject, subjecttitle, studyplan_template.credits, year, sem, current_year, current_sem, prerequisites, studyplan_template.clusterid from studyplan_template join subjects on subjects.subjectid = studyplan_template.subjectid where curriculumid=200933 and current_year = 1 and current_sem = 2 order by year, sem, subject';
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result)>0)
    {
        $output .= '
                <h4>First Year, Second Semester</h4>
                <table class="ui red table">
                <thead>
                    <tr>
                    <th width="10%">Subject Code</th>
                    <th width="65%">Subject Title</th>
                    <th width="10%">Units</th>
                    <th width="15%">Action</th>
                    </tr>
                </thead>
                <tbody>';
        while($row = mysqli_fetch_row($result))
        {
            $output .= '
                    <tr>
                    <td>'.$row[1].'</td>
                    <td>'.$row[2].'</td>
                    <td>'.$row[3].'</td>
                    <td>
                        <button class="ui red button delete_button" id="delete_'.$row[0].'"><i class="material-icons">close</i></button>
                    </td>
                    </tr>
            ';
            $totalunits += $row[3];
        }
        $output .= '
                </tbody>
                </table>
                <h5>Total Units: '.$totalunits.'</h5>
        ';
    }

    // SECOND YEAR, FIRST SEM
    $totalunits = 0;
    $query = 'select subjects.subjectid, subject, subjecttitle, studyplan_template.credits, year, sem, current_year, current_sem, prerequisites, studyplan_template.clusterid from studyplan_template join subjects on subjects.subjectid = studyplan_template.subjectid where curriculumid=200933 and current_year = 2 and current_sem = 1 order by year, sem, subject';
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result)>0)
    {
        $output .= '
                <h4>Second Year, First Semester</h4>
                <table class="ui red table">
                <thead>
                    <tr>
                    <th width="10%">Subject Code</th>
                    <th width="65%">Subject Title</th>
                    <th width="10%">Units</th>
                    <th width="15%">Action</th>
                    </tr>
                </thead>
                <tbody>';
        while($row = mysqli_fetch_row($result))
        {
            $output .= '
                    <tr>
                    <td>'.$row[1].'</td>
                    <td>'.$row[2].'</td>
                    <td>'.$row[3].'</td>
                    <td>
                        <button class="ui red button delete_button" id="delete_'.$row[0].'"><i class="material-icons">close</i></button>
                    </td>
                    </tr>
            ';
            $totalunits += $row[3];
        }
        $output .= '
                </tbody>
                </table>
                <h5>Total Units: '.$totalunits.'</h5>
        ';

    }
    
    // SECOND YEAR, SECOND SEM
    $totalunits = 0;
    $query = 'select subjects.subjectid, subject, subjecttitle, studyplan_template.credits, year, sem, current_year, current_sem, prerequisites, studyplan_template.clusterid from studyplan_template join subjects on subjects.subjectid = studyplan_template.subjectid where curriculumid=200933 and current_year = 2 and current_sem = 2 order by year, sem, subject';
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result)>0)
    {
        $output .= '
                <h4>Second Year, Second Semester</h4>
                <table class="ui red table">
                <thead>
                    <tr>
                    <th width="10%">Subject Code</th>
                    <th width="65%">Subject Title</th>
                    <th width="10%">Units</th>
                    <th width="15%">Action</th>
                    </tr>
                </thead>
                <tbody>';
        while($row = mysqli_fetch_row($result))
        {
            $output .= '
                    <tr>
                    <td>'.$row[1].'</td>
                    <td>'.$row[2].'</td>
                    <td>'.$row[3].'</td>
                    <td>
                        <button class="ui red button delete_button" id="delete_'.$row[0].'"><i class="material-icons">close</i></button>
                    </td>
                    </tr>
            ';
            $totalunits += $row[3];
        }
        $output .= '
                </tbody>
                </table>
                <h5>Total Units: '.$totalunits.'</h5>
        ';
    }

    // THIRD YEAR, FIRST SEM
    $totalunits = 0;
    $query = 'select subjects.subjectid, subject, subjecttitle, studyplan_template.credits, year, sem, current_year, current_sem, prerequisites, studyplan_template.clusterid from studyplan_template join subjects on subjects.subjectid = studyplan_template.subjectid where curriculumid=200933 and current_year = 3 and current_sem = 1 order by year, sem, subject';
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result)>0)
    {
        $output .= '
                <h4>Third Year, First Semester</h4>
                <table class="ui red table">
                <thead>
                    <tr>
                    <th width="10%">Subject Code</th>
                    <th width="65%">Subject Title</th>
                    <th width="10%">Units</th>
                    <th width="15%">Action</th>
                    </tr>
                </thead>
                <tbody>';
        while($row = mysqli_fetch_row($result))
        {
            $output .= '
                    <tr>
                    <td>'.$row[1].'</td>
                    <td>'.$row[2].'</td>
                    <td>'.$row[3].'</td>
                    <td>
                        <button class="ui red button delete_button" id="delete_'.$row[0].'"><i class="material-icons">close</i></button>
                    </td>
                    </tr>
            ';
            $totalunits += $row[3];
        }
        $output .= '
                </tbody>
                </table>
                <h5>Total Units: '.$totalunits.'</h5>
        ';
    }

    // THIRD YEAR, SECOND SEM
    $totalunits = 0;
    $query = 'select subjects.subjectid, subject, subjecttitle, studyplan_template.credits, year, sem, current_year, current_sem, prerequisites, studyplan_template.clusterid from studyplan_template join subjects on subjects.subjectid = studyplan_template.subjectid where curriculumid=200933 and current_year = 3 and current_sem = 2 order by year, sem, subject';
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result)>0)
    {
        $output .= '
                <h4>Third Year, Second Semester</h4>
                <table class="ui red table">
                <thead>
                    <tr>
                    <th width="10%">Subject Code</th>
                    <th width="65%">Subject Title</th>
                    <th width="10%">Units</th>
                    <th width="15%">Action</th>
                    </tr>
                </thead>
                <tbody>';
        while($row = mysqli_fetch_row($result))
        {
            $output .= '
                    <tr>
                    <td>'.$row[1].'</td>
                    <td>'.$row[2].'</td>
                    <td>'.$row[3].'</td>
                    <td>
                        <button class="ui red button delete_button" id="delete_'.$row[0].'"><i class="material-icons">close</i></button>
                    </td>
                    </tr>
            ';
            $totalunits += $row[3];
        }
        $output .= '
                </tbody>
                </table>
                <h5>Total Units: '.$totalunits.'</h5>
        ';
    }

    // THIRD YEAR, SUMMER
    $totalunits = 0;
    $query = 'select subjects.subjectid, subject, subjecttitle, studyplan_template.credits, year, sem, current_year, current_sem, prerequisites, studyplan_template.clusterid from studyplan_template join subjects on subjects.subjectid = studyplan_template.subjectid where curriculumid=200933 and current_year = 3 and current_sem = 3 order by year, sem, subject';
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result)>0)
    {
        $output .= '
                <h4>Third Year, Summer</h4>
                <table class="ui red table">
                <thead>
                    <tr>
                    <th width="10%">Subject Code</th>
                    <th width="65%">Subject Title</th>
                    <th width="10%">Units</th>
                    <th width="15%">Action</th>
                    </tr>
                </thead>
                <tbody>';
        while($row = mysqli_fetch_row($result))
        {
            $output .= '
                    <tr>
                    <td>'.$row[1].'</td>
                    <td>'.$row[2].'</td>
                    <td>'.$row[3].'</td>
                    <td>
                        <button class="ui red button delete_button" id="delete_'.$row[0].'"><i class="material-icons">close</i></button>
                    </td>
                    </tr>
            ';
            $totalunits += $row[3];
        }
        $output .= '
                </tbody>
                </table>
                <h5>Total Units: '.$totalunits.'</h5>
        ';
    }

    // FOURTH YEAR, FIRST SEM
    $totalunits = 0;
    $query = 'select subjects.subjectid, subject, subjecttitle, studyplan_template.credits, year, sem, current_year, current_sem, prerequisites, studyplan_template.clusterid from studyplan_template join subjects on subjects.subjectid = studyplan_template.subjectid where curriculumid=200933 and current_year = 4 and current_sem = 1 order by year, sem, subject';
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result)>0)
    {
        $output .= '
                <h4>Fourth Year, First Semester</h4>
                <table class="ui red table">
                <thead>
                    <tr>
                    <th width="10%">Subject Code</th>
                    <th width="65%">Subject Title</th>
                    <th width="10%">Units</th>
                    <th width="15%">Action</th>
                    </tr>
                </thead>
                <tbody>';
        while($row = mysqli_fetch_row($result))
        {
            $output .= '
                    <tr>
                    <td>'.$row[1].'</td>
                    <td>'.$row[2].'</td>
                    <td>'.$row[3].'</td>
                    <td>
                        <button class="ui red button delete_button" id="delete_'.$row[0].'"><i class="material-icons">close</i></button>
                    </td>
                    </tr>
            ';
            $totalunits += $row[3];
        }
        $output .= '
                </tbody>
                </table>
                <h5>Total Units: '.$totalunits.'</h5>
        ';
    }

    // FOURTH YEAR, SECOND SEM
    $totalunits = 0;
    $query = 'select subjects.subjectid, subject, subjecttitle, studyplan_template.credits, year, sem, current_year, current_sem, prerequisites, studyplan_template.clusterid from studyplan_template join subjects on subjects.subjectid = studyplan_template.subjectid where curriculumid=200933 and current_year = 4 and current_sem = 2 order by year, sem, subject';
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result)>0)
    {
        $output .= '
                <h4>Fourth Year, Second Semester</h4>
                <table class="ui red table">
                <thead>
                    <tr>
                    <th width="10%">Subject Code</th>
                    <th width="65%">Subject Title</th>
                    <th width="10%">Units</th>
                    <th width="15%">Action</th>
                    </tr>
                </thead>
                <tbody>';
        while($row = mysqli_fetch_row($result))
        {
            $output .= '
                    <tr>
                    <td>'.$row[1].'</td>
                    <td>'.$row[2].'</td>
                    <td>'.$row[3].'</td>
                    <td>
                        <button class="ui red button delete_button" id="delete_'.$row[0].'"><i class="material-icons">close</i></button>
                    </td>
                    </tr>
            ';
            $totalunits += $row[3];
        }
        $output .= '
                </tbody>
                </table>
                <h5>Total Units: '.$totalunits.'</h5>
        ';
    }
    
    // FIFTH YEAR, FIRST SEM
    $totalunits = 0;
    $query = 'select subjects.subjectid, subject, subjecttitle, studyplan_template.credits, year, sem, current_year, current_sem, prerequisites, studyplan_template.clusterid from studyplan_template join subjects on subjects.subjectid = studyplan_template.subjectid where curriculumid=200933 and current_year = 5 and current_sem = 1 order by year, sem, subject';
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result)>0)
    {
        $output .= '
                <h4>Fifth Year, First Semester</h4>
                <table class="ui red table">
                <thead>
                    <tr>
                    <th width="10%">Subject Code</th>
                    <th width="65%">Subject Title</th>
                    <th width="10%">Units</th>
                    <th width="15%">Action</th>
                    </tr>
                </thead>
                <tbody>';
        while($row = mysqli_fetch_row($result))
        {
            $output .= '
                    <tr>
                    <td>'.$row[1].'</td>
                    <td>'.$row[2].'</td>
                    <td>'.$row[3].'</td>
                    <td>
                        <button class="ui red button delete_button" id="delete_'.$row[0].'"><i class="material-icons">close</i></button>
                    </td>
                    </tr>
            ';
            $totalunits += $row[3];
        }
        $output .= '
                </tbody>
                </table>
                <h5>Total Units: '.$totalunits.'</h5>
        ';
    }

    // FIFTH YEAR, SECOND SEM
    $totalunits = 0;
    $query = 'select subjects.subjectid, subject, subjecttitle, studyplan_template.credits, year, sem, current_year, current_sem, prerequisites, studyplan_template.clusterid from studyplan_template join subjects on subjects.subjectid = studyplan_template.subjectid where curriculumid=200933 and current_year = 5 and current_sem = 2 order by year, sem, subject';
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result)>0)
    {
        $output .= '
                <h4>Fifth Year, Second Semester</h4>
                <table class="ui red table">
                <thead>
                    <tr>
                    <th width="10%">Subject Code</th>
                    <th width="65%">Subject Title</th>
                    <th width="10%">Units</th>
                    <th width="15%">Action</th>
                    </tr>
                </thead>
                <tbody>';
        while($row = mysqli_fetch_row($result))
        {
            $output .= '
                    <tr>
                    <td>'.$row[1].'</td>
                    <td>'.$row[2].'</td>
                    <td>'.$row[3].'</td>
                    <td>
                        <button class="ui red button delete_button" id="delete_'.$row[0].'"><i class="material-icons">close</i></button>
                    </td>
                    </tr>
            ';
            $totalunits += $row[3];
        }
        $output .= '
                </tbody>
                </table>
                <h5>Total Units: '.$totalunits.'</h5>
        ';
    }

    // SIXTH YEAR, FIRST SEM
    $totalunits = 0;
    $query = 'select subjects.subjectid, subject, subjecttitle, studyplan_template.credits, year, sem, current_year, current_sem, prerequisites, studyplan_template.clusterid from studyplan_template join subjects on subjects.subjectid = studyplan_template.subjectid where curriculumid=200933 and current_year = 6 and current_sem = 1 order by year, sem, subject';
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result)>0)
    {
        $output .= '
                <h4>Sixth Year, First Semester</h4>
                <table class="ui red table">
                <thead>
                    <tr>
                    <th width="10%">Subject Code</th>
                    <th width="65%">Subject Title</th>
                    <th width="10%">Units</th>
                    <th width="15%">Action</th>
                    </tr>
                </thead>
                <tbody>';
        while($row = mysqli_fetch_row($result))
        {
            $output .= '
                    <tr>
                    <td>'.$row[1].'</td>
                    <td>'.$row[2].'</td>
                    <td>'.$row[3].'</td>
                    <td>
                        <button class="ui red button delete_button" id="delete_'.$row[0].'"><i class="material-icons">close</i></button>
                    </td>
                    </tr>
            ';
            $totalunits += $row[3];
        }
        $output .= '
                </tbody>
                </table>
                <h5>Total Units: '.$totalunits.'</h5>
        ';
    }

    // SIXTH YEAR, SECOND SEM
    $totalunits = 0;
    $query = 'select subjects.subjectid, subject, subjecttitle, studyplan_template.credits, year, sem, current_year, current_sem, prerequisites, studyplan_template.clusterid from studyplan_template join subjects on subjects.subjectid = studyplan_template.subjectid where curriculumid=200933 and current_year = 6 and current_sem = 2 order by year, sem, subject';
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result)>0)
    {
        $output .= '
                <h4>Sixth Year, Second Semester</h4>
                <table class="ui red table">
                <thead>
                    <tr>
                    <th width="10%">Subject Code</th>
                    <th width="65%">Subject Title</th>
                    <th width="10%">Units</th>
                    <th width="15%">Action</th>
                    </tr>
                </thead>
                <tbody>';
        while($row = mysqli_fetch_row($result))
        {
            $output .= '
                    <tr>
                    <td>'.$row[1].'</td>
                    <td>'.$row[2].'</td>
                    <td>'.$row[3].'</td>
                    <td>
                        <button class="ui red button delete_button" id="delete_'.$row[0].'"><i class="material-icons">close</i></button>
                    </td>
                    </tr>
            ';
            $totalunits += $row[3];
        }
        $output .= '
                </tbody>
                </table>
                <h5>Total Units: '.$totalunits.'</h5>
        ';
    }

    echo $output;
?>

<script>
    $('.delete_button').click(function(){
        var id = this.id;
        id = id.split("_");
        error(id[1]);
    });
</script>

<script>
    $('.edit_button').click(function(){
        var id = this.id;
        id = id.split("_");
        edit(id[1]);
    });
</script>