<?php
include ('connect.php');
session_start();
$profExists=FALSE;
$query='SELECT DISTINCT P.prof_name
        FROM College C, Department D, Professor P
        WHERE ( P.college_id = C.college_id
                AND C.college_name=\''.strtoupper($_POST['profCollege']).'\' )
        AND   ( P.dept_id = D.dept_id
                AND D.dept_name=\''.strtoupper($_POST['profDepartment']).'\')
        AND   P.prof_id='.$_POST['profID'];

$result=mysqli_query($connect,$query);
$num_rows = mysqli_num_rows($result);

if ($num_rows>0)
{
    $_SESSION['profID'] = $_POST['profID'];
    $_SESSION['modType'] = $_POST['modType'];
    $_SESSION['tableType'] = $_POST['tableType'];
    header('Location: edit_or_delete.php'); die();
}

?>

<!DOCTYPE HTML>
<HTML>

<HEAD>
    <TITLE>ATTEMPTING TO CORRECT INCORRECT INFORMATION</TITLE>
</HEAD>

<BODY>

<H1>CORRECTING INFORMATION REQUIRES A PROFESSOR ID</H1>
<H2>ONLY PROFESSORS CAN EDIT/DELETE COLLEGE, DEPARTMENT, COURSE, OR PROFESSOR INFORMATION<BR></H2>
<H3>PROFESSOR MUST ENTER HIS/HER INFORMATION</H3>

<FORM METHOD="POST" NAME="#">
<B>ENTER COLLEGE: </B><BR>
<INPUT TYPE="TEXT" NAME="profCollege" REQUIRED>

<BR><BR><B>ENTER DEPARTMENT: </B><BR>
<INPUT TYPE="TEXT" NAME="profDepartment" REQUIRED>

<BR><BR><B>ENTER PROFESSOR ID: </B><BR>
<INPUT TYPE="NUMBER" NAME="profID" REQUIRED>

<BR><BR><B>SELECT WHETHER TO EDIT OR DELETE</B><BR>
<SELECT NAME="modType">
    <OPTION VALUE="Edit">Edit</OPTION>
    <OPTION VALUE="Delete">Delete</OPTION>
</SELECT>

<BR><BR><B>SELECT INFORMATION TO EDIT/DELETE</B><BR>
<INPUT TYPE="RADIO" NAME="tableType" VALUE="College" REQUIRED> College
<INPUT TYPE="RADIO" NAME="tableType" VALUE="Department"> Department
<INPUT TYPE="RADIO" NAME="tableType" VALUE="Course"> Course
<INPUT TYPE="RADIO" NAME="tableType" VALUE="Professor"> Professor
<BR><BR><INPUT TYPE="SUBMIT" VALUE="SUBMIT">
</FORM>

</BODY>

</HTML>
