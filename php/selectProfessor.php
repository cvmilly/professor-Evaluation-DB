<!DOCTYPE HTML>
<HTML>

<HEAD>
    <?php
    include ('connect.php');
    ?>
    <TITLE>PROFESSOR REVIEW FORM</TITLE>
</HEAD>

<BODY>
<?php

echo '<H2>Select Professor and Fill Form</H2>';
echo '<B>Select Professor : </B>';
$result = mysqli_query($connect,
    'SELECT * FROM Professor WHERE college_id = ' . $_POST['collegeOption']
    . ' AND dept_id = ' . $_POST['departmentOption'] );
$num_rows = mysqli_num_rows($result);

echo '<FORM METHOD="POST" ACTION="submitSuccess.php">';
echo '<INPUT TYPE="HIDDEN" NAME="revType" VALUE=' . $_POST['revType'] . '>';
echo '<SELECT NAME="professorOption">';
if ( $num_rows > 0 ) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<OPTION VALUE=' . $row['prof_id'] . '>' . $row['prof_name'] . '</OPTION>';
    }
}
echo '</SELECT><BR>';

echo '<BR><B>Professor\'s Availability: </B>';
echo '<INPUT TYPE="RADIO" NAME="availableRating" VALUE=1 REQUIRED> 1 ';
echo '<INPUT TYPE="RADIO" NAME="availableRating" VALUE=2> 2 ';
echo '<INPUT TYPE="RADIO" NAME="availableRating" VALUE=3> 3 ';
echo '<INPUT TYPE="RADIO" NAME="availableRating" VALUE=4> 4 ';
echo '<INPUT TYPE="RADIO" NAME="availableRating" VALUE=5> 5 ';

echo '<BR><BR><B>Professor\'s Oral Communication Skills: </B>';
echo '<INPUT TYPE="RADIO" NAME="oralRating" VALUE=1 REQUIRED> 1 ';
echo '<INPUT TYPE="RADIO" NAME="oralRating" VALUE=2> 2 ';
echo '<INPUT TYPE="RADIO" NAME="oralRating" VALUE=3> 3 ';
echo '<INPUT TYPE="RADIO" NAME="oralRating" VALUE=4> 4 ';
echo '<INPUT TYPE="RADIO" NAME="oralRating" VALUE=5> 5 ';

echo '<BR><BR><B>Professor\'s Visual Communication Skills: </B>';
echo '<INPUT TYPE="RADIO" NAME="visualRating" VALUE=1 REQUIRED> 1 ';
echo '<INPUT TYPE="RADIO" NAME="visualRating" VALUE=2> 2 ';
echo '<INPUT TYPE="RADIO" NAME="visualRating" VALUE=3> 3 ';
echo '<INPUT TYPE="RADIO" NAME="visualRating" VALUE=4> 4 ';
echo '<INPUT TYPE="RADIO" NAME="visualRating" VALUE=5> 5 ';

echo '<BR><BR><B>Professor\'s Attentiveness/Helpfulness: </B>';
echo '<INPUT TYPE="RADIO" NAME="helpfulnessRating" VALUE=1 REQUIRED> 1 ';
echo '<INPUT TYPE="RADIO" NAME="helpfulnessRating" VALUE=2> 2 ';
echo '<INPUT TYPE="RADIO" NAME="helpfulnessRating" VALUE=3> 3 ';
echo '<INPUT TYPE="RADIO" NAME="helpfulnessRating" VALUE=4> 4 ';
echo '<INPUT TYPE="RADIO" NAME="helpfulnessRating" VALUE=5> 5 ';

echo '<BR><BR><B>Would You Recommend Professor? </B>';
echo '<INPUT TYPE="RADIO" NAME="recommend" VALUE=FALSE REQUIRED> NO ';
echo '<INPUT TYPE="RADIO" NAME="recommend" VALUE=TRUE> YES ';

echo '<BR><BR><B>Term: </B>';
echo '<U><B>F</B></U>ALL S<U><B>P</B></U>RING <U><B>S</B></U>UMMER ';
echo '<INPUT TYPE="TEXT" NAME="Term" SIZE="3" MAXLENGTH="1" PATTERN="[FfPpSs]" REQUIRED>';

echo '<BR><BR><B>Year: </B>';
echo '<SELECT NAME="Year">';
for ( $i = 2018; $i >= 1980; $i-- ) {
    echo '<OPTION VALUE=' . $i . '>' . $i . '</OPTION>';
}
echo '</SELECT><BR><BR>';
echo '<INPUT TYPE="SUBMIT" VALUE="submit">';
echo '</FORM>';

?>
</BODY>

</HTML>
