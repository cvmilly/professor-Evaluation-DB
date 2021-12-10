<!DOCTYPE HTML>
<HTML>

<HEAD>
    <?php
    include ('connect.php');
    echo $_POST['revType'];
    echo $_POST['view'];
    echo '<TITLE>COLLEGE FOR ' . strtoupper($_POST['revType']) . ' REVIEW FORM</TITLE>';
    ?>
</HEAD>

<BODY>
<?php
echo '<H2>COLLEGE</H2>';
echo '<B>Select College of ' . $_POST['revType'] . ': </B>';

$result = mysqli_query($connect,'SELECT * FROM College');
$num_rows = mysqli_num_rows($result);
echo '<FORM METHOD="POST" ACTION="selectDepartment.php">';
echo '<INPUT TYPE="HIDDEN" NAME="revType" VALUE=' . $_POST['revType'] . '>';
echo '<INPUT TYPE="HIDDEN" NAME="view" VALUE=' . $_POST['view'] . '>';
echo '<SELECT NAME="collegeOption">';
if ( $num_rows > 0 ) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<OPTION VALUE='.$row['college_id'].'>'.$row['college_name'].' ('.$row['college_id'].')</OPTION>';
    }
}
echo '</SELECT>';
echo '<INPUT TYPE="SUBMIT" VALUE="submit"/>';
echo '</FORM>';
?>
</BODY>

</HTML>
