<!DOCTYPE HTML>
<HTML>

<HEAD>
    <?php
    include ('connect.php');

    if ( strcmp("" . $_POST['revType'] . "","Professor") == 0 ) {
        echo 'reviewing professor';
        $result = mysqli_query($connect, 'SELECT * FROM Prof_Rev');
        $num_reviews = mysqli_num_rows($result);
        $prev_num = $num_reviews + 1;

        $result = mysqli_query($connect, 'SELECT prev_num FROM Prof_Rev
              WHERE prev_num=' . (int)$prev_num);
        $same_prev_num = mysqli_num_rows($result);
        while ($same_prev_num > 0) {
            $prev_num = $prev_num+10;
            $result = mysqli_query($connect, 'SELECT prev_num FROM Prof_Rev
              WHERE prev_num=' . (int)$prev_num);
            $same_prev_num = mysqli_num_rows($result);
        }


        $num = $prev_num;
        $sql = 'INSERT INTO Prof_Rev(prev_num,prof_id,availability,oral_rev,visual_rev,
            helpfulness,recommend,term,year)
          VALUES(' . (int)$prev_num . ',' . (int)$_POST['professorOption'] . ','
            . (int)$_POST['availableRating'] . ',' . $_POST['oralRating'] . ','
            . $_POST['visualRating'] . ',' . $_POST['helpfulnessRating'] . ','
            . $_POST['recommend'] . ', \'' . $_POST['Term'] . '\',' . $_POST['Year'] . ')';
    }

    else if ( strcmp("" . $_POST['revType'] . "","Course") == 0 ) {
        echo 'reviewing course';
        $result = mysqli_query($connect,'SELECT * FROM Course_Rev');
        $num_reviews = mysqli_num_rows($result);
        $crev_num = $num_reviews + 1;


        $result = mysqli_query($connect, 'SELECT crev_num FROM Course_Rev
              WHERE crev_num=' . (int)$crev_num);
        $same_crev_num = mysqli_num_rows($result);
        while ($same_crev_num > 0) {
            $crev_num = $crev_num+10;
            $result = mysqli_query($connect, 'SELECT crev_num FROM Course_Rev
              WHERE crev_num=' . (int)$crev_num);
            $same_crev_num = mysqli_num_rows($result);
        }


        $num = $crev_num;
        echo '<BR>' . $crev_num;
        $sql = 'INSERT INTO Course_Rev(crev_num,course_id,difficulty,assignment_based,
              test_based,workload,course_reception,required,term,year)
           VALUES(' . (int)$crev_num . ', \'' . $_POST['courseOption'] . '\','
            . $_POST['difficultyRating'] . ',' . $_POST['assignmentRating'] . ','
            . $_POST['testRating'] . ',' . $_POST['workloadRating'] . ','
            . $_POST['receptionRating'] . ',' . $_POST['required'] . ', \''
            . $_POST['Term'] . '\',' . $_POST['Year'] . ')';
    }
    else echo 'error!';
    if (mysqli_query($connect,$sql) == TRUE) {
        echo 'works?';
    }

    ?>
    <TITLE>REVIEW SUBMITTED</TITLE>
</HEAD>

<BODY>
<H1>Review Submitted Successfully!</H1>
<?php
echo '<P>Review number ' . $num .
        '<BR>For Selected ' . $_POST['revType'] . '</P>';
?>
<B>Return Home</B>
<FORM METHOD="POST" ACTION="index.php">
    <INPUT TYPE="SUBMIT" VALUE="return">
</FORM>
</BODY>

</HTML>
