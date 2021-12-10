<?php
session_start();
include ('connect.php');
echo $_POST['collegeID'] . '<BR>';
echo $_POST['collegeName'] . '<BR>';

// 1st search to see if not already in database
$already_in_db=FALSE;

if (strcmp("".$_SESSION['tableType']."","College")==0) {
    if ($_POST['collegeID'] == 0) $already_in_db = TRUE;
    $query = 'SELECT college_id FROM College WHERE college_id=' . $_POST['collegeID'];
    $result = mysqli_query($connect, $query);
    $num_rows = mysqli_num_rows($result);
    if ($num_rows > 0) $already_in_db = TRUE;
    $query = 'SELECT college_name FROM College';
    $result = mysqli_query($connect, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        if (strcmp(strtoupper($row['college_name']), strtoupper($_POST['collegeName'])) == 0) $already_in_db = TRUE;
    }

// insert if not
    if (!$already_in_db) {
        echo 'this college is not in db';
        $query = 'INSERT INTO College(college_id,college_name) 
              VALUES (' . (int)$_POST['collegeID'] . ',\'' . $_POST['collegeName'] . '\')';
        if (mysqli_query($connect, $query)) echo 'College Added!';
    }
}
else if (strcmp("".$_SESSION['tableType']."","Department")==0) {
    // make sure college exists in database
    $college_exists=FALSE;
    $query = 'SELECT college_id FROM College WHERE college_id=' . $_POST['collegeID'];
    $result = mysqli_query($connect,$query);
    $num_rows = mysqli_num_rows($result);
    if ($num_rows==1) $college_exists=TRUE;
    // make sure department not already in db
    $query = 'SELECT dept_id FROM Department WHERE dept_id=' . $_POST['departmentID']
    . ' AND college_id=' . $_POST['collegeID'];
    $result = mysqli_query($connect,$query);
    $num_rows = mysqli_num_rows($result);
    if ($num_rows > 0) $already_in_db = TRUE;
    $query = 'SELECT dept_name FROM Department';
    $result = mysqli_query($connect,$query);
    while ($row = mysqli_fetch_assoc($result)) {
        if (strcmp(strtoupper($row['dept_name']), strtoupper($_POST['departmentName'])) == 0) $already_in_db = TRUE;
    }
    if (!$already_in_db AND $college_exists) {
        $query = 'INSERT INTO Department(college_id,dept_id,dept_name)
               VALUES (' .$_POST['collegeID']. ',' .$_POST['departmentID']. ',\'' .$_POST['departmentName'].'\')';
        if (mysqli_query($connect,$query)) echo 'Department Added!';
    }
    else echo 'cant enter in db';
}

else if (strcmp("".$_SESSION['tableType']."","Course")==0) {
    // make sure college and dept exist in db
    $dept_exists=FALSE;
    $query = 'SELECT dept_id FROM Department WHERE college_id='.(int)$_POST['collegeID']
        .' AND dept_id='.(int)$_POST['departmentID'];
    $result = mysqli_query($connect,$query);
    $num_rows = mysqli_num_rows($result);
    if ($num_rows==1) {
        echo 'dept exists!<BR>';
        $dept_exists = TRUE;
    }
    // make sure course not already in db
    $query = 'SELECT course_id FROM Course WHERE course_id=\''.strtoupper($_POST['courseID']).'\'';
    $result = mysqli_query($connect,$query);
    $num_rows = mysqli_num_rows($result);
    if ($num_rows>0) {
        echo 'course in db!<BR>';
        $already_in_db=TRUE;
    }
    else echo 'courseID not in db!<BR>';
    $query = 'SELECT course_name FROM Course';
    $result = mysqli_query($connect,$query);
    while ($row = mysqli_fetch_assoc($result)) {
        if (strcmp(strtoupper($row['course_name']),strtoupper($_POST['courseName']))==0) $already_in_db=TRUE;
    }
    if (!$already_in_db AND $dept_exists) {
        $query = 'INSERT INTO Course (course_id,course_name,credits,dist_learning,college_id,dept_id)
                  VALUES (\''.strtoupper($_POST['courseID']).'\',\''.$_POST['courseName'].'\','.(int)$_POST['courseCredits'].','
                            .(int)$_POST['courseDL'].','.(int)$_POST['collegeID'].','.(int)$_POST['departmentID'].')';
        if (mysqli_query($connect,$query)) echo 'Course Added<BR>';
        else echo 'cant enter in db';
    }
    else echo 'cant enter in db';
}
else if (strcmp("".$_SESSION['tableType']."","Professor")==0) {
    // make sure college and dept exist in db
    $dept_exists=FALSE;
    $query = 'SELECT dept_id FROM Department WHERE college_id='.(int)$_POST['collegeID']
        .' AND dept_id='.(int)$_POST['departmentID'];
    $result = mysqli_query($connect,$query);
    $num_rows = mysqli_num_rows($result);
    if ($num_rows==1) {
        echo 'dept exists!<BR>';
        $dept_exists = TRUE;
    }
    else echo 'dept not exists!';
    // make sure professor not already in db
    $query = 'SELECT prof_id FROM Professor WHERE prof_id='.(int)$_POST['professorID'];
    $result = mysqli_query($connect,$query);
    $num_rows = mysqli_num_rows($result);
    if ($num_rows>0) {
        //echo 'prof in db!<BR>';
        $already_in_db=TRUE;
    }
    //else echo 'prof not in db<BR>';
    $query = 'SELECT prof_name FROM Professor';
    $result = mysqli_query($connect,$query);
    while ($row = mysqli_fetch_assoc($result)) {
        if (strcmp(strtoupper($row['prof_name']),strtoupper($_POST['professorNameName']))==0) {
            //echo 'found prof name in db<BR>';
            $already_in_db=TRUE;
        }
        //else echo 'name not found<BR>';
    }
    if (!$already_in_db AND $dept_exists) {
        $query = 'INSERT INTO Professor (prof_id,prof_name,credentials,college_id,dept_id)
                  VALUES ('.(int)$_POST['professorID'].',\''.strtoupper($_POST['professorName']).'\',\''
            .strtoupper($_POST['professorCredentials']).'\','.(int)$_POST['collegeID'].','.(int)$_POST['departmentID'].')';
        if (mysqli_query($connect,$query)) echo 'Professor Added!<BR>';
        else echo 'cant enter in db';
    }
    else echo 'cant enter in db';
}
?>

<!DOCTYPE HTML>
<HTML>

<HEAD>
    <TITLE>ADD INFORMATION</TITLE>
</HEAD>

<BODY>
<?php
echo '<H3>Add ' . $_SESSION['tableType'] . ' Information</H3><BR>';

echo '<FORM METHOD="POST" ACTION="#">';
echo '<BR><B>Enter College ID: </B><BR>';
echo '<INPUT TYPE="NUMBER" NAME="collegeID" REQUIRED>';

if (strcmp("".$_SESSION['tableType']."","College")==0) {
   echo '<BR><BR><B>Enter College Name: </B><BR>';
   echo '<INPUT TYPE="TEXT" NAME="collegeName" REQUIRED>';
}

else if (strcmp("".$_SESSION['tableType']."","Department")==0) {
    echo '<BR><BR><B>Enter Department ID: </B><BR>';
    echo '<INPUT TYPE="NUMBER" NAME="departmentID" REQUIRED>';
    echo '<BR><BR><B>Enter Department Name: </B><BR>';
    echo '<INPUT TYPE="TEXT" NAME="departmentName" REQUIRED>';
}

else if (strcmp("".$_SESSION['tableType']."","Course")==0) {
    echo '<BR><BR><B>Enter Department ID: </B><BR>';
    echo '<INPUT TYPE="NUMBER" NAME="departmentID" REQUIRED>';
    echo '<BR><BR><B>Course ID: </B><BR>';
    echo '<INPUT TYPE="TEXT" NAME="courseID" REQUIRED>';
    echo '<BR><BR><B>Course Name: </B><BR>';
    echo '<INPUT TYPE="TEXT" NAME="courseName" REQUIRED>';
    echo '<BR><BR><B>Course Credits: </B><BR>';
    echo '<INPUT TYPE="NUMBER" NAME="courseCredits" REQUIRED>';
    echo '<BR><BR><B>Does Course Offer Distance Learning? </B><BR>';
    echo '<INPUT TYPE="RADIO" NAME="courseDL" VALUE=TRUE REQUIRED> YES ';
    echo '<INPUT TYPE="RADIO" NAME="courseDL" VALUE=FALSE> NO ';
}

else if (strcmp("".$_SESSION['tableType']."","Professor")==0) {
    echo '<BR><BR><B>Enter Department ID: </B><BR>';
    echo '<INPUT TYPE="NUMBER" NAME="departmentID" REQUIRED>';
    echo '<BR><BR><B>Professor ID: </B><BR>';
    echo '<INPUT TYPE="NUMBER" NAME="professorID" REQUIRED>';
    echo '<BR><BR><B>Professor Name: </B><BR>';
    echo '<INPUT TYPE="TEXT" NAME="professorName" REQUIRED>';
    echo '<BR><BR><B>Professor\'s Highest Degree/Credentials: </B><BR>';
    echo '<INPUT TYPE="TEXT" NAME="professorCredentials">';
}


echo '<BR><BR><INPUT TYPE="SUBMIT" VALUE="SUBMIT">';
echo '</FORM>';
?>
<B>Return Home</B>
<FORM METHOD="POST" ACTION="index.php">
    <INPUT TYPE="SUBMIT" VALUE="return">
</FORM>
</BODY>

</HTML>
