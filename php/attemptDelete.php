<?php
session_start();
$_SESSION['tableType'] = $_POST['tableType'];

if ($_POST) {
    header('Location: addInformation.php');
    die();
}
?>

<!DOCTYPE HTML>
<HTML>

<HEAD>
    <TITLE>ADD MISSING INFORMATION</TITLE>
</HEAD>

<BODY>

<H1>Add Missing Information (to Colleges, Departments, Professors, or Courses)</H1>
<BR>
<B>SELECT MISSING INFO: </B>
<FORM METHOD="POST" ACTION="#">
    <INPUT TYPE="RADIO" NAME="tableType" VALUE="College" REQUIRED> College
    <INPUT TYPE="RADIO" NAME="tableType" VALUE="Department"> Department
    <INPUT TYPE="RADIO" NAME="tableType" VALUE="Course"> Course
    <INPUT TYPE="RADIO" NAME="tableType" VALUE="Professor"> Professor
    <BR><BR><INPUT TYPE="SUBMIT" VALUE="SUBMIT">
</FORM>
<BR>

<H3>*NOTE: For tables that are dependent on others, the tables it depends on must exist FIRST</H3>




</BODY>

</HTML>
