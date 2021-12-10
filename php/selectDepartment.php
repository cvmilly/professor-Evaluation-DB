<!DOCTYPE HTML>
<HTML>

<HEAD>
    <?php
    include ('connect.php');
    echo $_POST['revType'];
    echo $_POST['view'];
    echo '<TITLE>DEPARTMENT FOR ' . strtoupper($_POST['revType']) . ' REVIEW FORM</TITLE>';
    ?>
</HEAD>

<BODY>
<?php
echo '<H2>DEPARTMENT</H2>';
echo '<B>Select Department of ' . $_POST['revType'] . ':</B>';

$result = mysqli_query($connect,'SELECT dept_id, dept_name FROM Department WHERE college_id = ' .
    $_POST["collegeOption"]);
$num_rows = mysqli_num_rows($result);

if (strcmp(''.$_POST['view'].'','TRUE')==0) {
    echo 'just viewing reviews';
    $pageType = 'view';
}

else {
    echo 'about to write a review';
    $pageType = 'select';
}

echo '<FORM METHOD="POST" ACTION="' . $pageType . $_POST['revType'] . '.php">';
echo '<INPUT TYPE="HIDDEN" NAME="collegeOption" VALUE=' . $_POST["collegeOption"] . '>';
echo '<INPUT TYPE="HIDDEN" NAME="revType" VALUE=' . $_POST['revType'] . '>';
//echo '<INPUT TYPE="HIDDEN" NAME="view" VALUE=' . $_POST['view'] . '>';
echo '<SELECT NAME="departmentOption">';
if ( $num_rows > 0 ) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<OPTION VALUE='.$row['dept_id'].'>'.$row['dept_name'].' ('.$row['dept_id'].')</OPTION>';
    }
}

echo '</SELECT>';
echo '<INPUT TYPE="SUBMIT" VALUE="submit">';
echo '</FORM>';
?>
</BODY>

</HTML>
