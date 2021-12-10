<?php
session_start();
echo 'now we can delete!!<BR>';
echo $_SESSION['prof_id'] . '<BR>';
echo $_SESSION['college_id'] . '<BR>';
echo $_SESSION['dept_id'] . '<BR>';
echo $_SESSION['revType'] . '<BR>';
echo $_SESSION['delete'] . '<BR>';
include ('connect.php');

if ($_SESSION['delete']==1) {
    $query = 'DELETE FROM Prof_Rev WHERE prev_num = ' . (int)$_POST['reviewOption'] .
    ' AND prof_id = ' . (int)$_SESSION['prof_id'];
    if (mysqli_query($connect,$query)) {
        echo 'success';
    }
    else echo 'not success';
}

else if ($_SESSION['delete']==2) {
    echo $_POST['reviewOption'].'<BR>';
    echo $_SESSION['course_id'].'<BR>';
    $query = 'DELETE FROM Course_Rev WHERE crev_num = ' . (int)$_POST['reviewOption'] .
    ' AND course_id = ' . '\'' . $_SESSION['course_id'] . '\'';
    if (mysqli_query($connect,$query)) {
        echo 'success';
    }
    else echo 'not success';
}

echo '<BR>hope it works<BR>';

if ( strcmp("" . $_SESSION['revType'] . "","Professor")==0 ) {
    $query = 'SELECT * FROM Prof_Rev WHERE prof_id = ' . (int)$_SESSION['prof_id'];
    $result = mysqli_query($connect,$query);
    $num_rows = mysqli_num_rows($result);
    echo 'Select Review to Delete';
    echo '<FORM METHOD="POST" ACTION="#">';
    echo '<SELECT NAME="reviewOption">';
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<OPTION VALUE=' . $row['prev_num'] . '>' . $row['prev_num'] . '</OPTION>';
    }
    $_SESSION['delete']=1;
    echo '<INPUT TYPE="SUBMIT" VALUE="DELETE">';
    echo '</FORM>';
}
else if ( strcmp("" . $_SESSION['revType'] . "","Course")==0 ) {
    echo 'about to delete from course: ' . $_SESSION['course_id'];
    $query = 'SELECT * FROM Course_Rev WHERE course_id =' . '\'' . $_SESSION['course_id'] . '\'';
    $result = mysqli_query($connect,$query);
    echo 'Select Review to Delete';
    echo '<FORM METHOD="POST" ACTION="#">';
    echo '<SELECT NAME="reviewOption">';
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<OPTION VALUE=' . $row['crev_num'] . '>' . $row['crev_num'] . '</OPTION>';
    }
    $_SESSION['delete'] = 2;
    echo '<INPUT TYPE="SUBMIT" VALUE="DELETE">';
    echo '</FORM>';
}
echo '<FORM METHOD="POST" ACTION="index.php">';
echo '<INPUT TYPE="SUBMIT" VALUE="HOME">';
echo '</FORM>';
?>
