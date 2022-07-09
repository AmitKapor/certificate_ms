<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/student.css">
    <title>Certificate</title>
</head>
<body>
    <?php
        include("init.php");

        if(!isset($_GET['class']))
            $class=null;
        else
            $class=$_GET['class'];
        $rn=$_GET['rn'];

        // validation
        if (empty($class) or empty($rn) or preg_match("/[a-z]/i",$rn)) {
            if(empty($class))
                echo '<p class="error">Please select your class</p>';
            if(empty($rn))
                echo '<p class="error">Please enter your roll number</p>';
            if(preg_match("/[a-z]/i",$rn))
                echo '<p class="error">Please enter valid roll number</p>';
            exit();
        }

        $name_sql=mysqli_query($conn,"SELECT `name` FROM `students` WHERE `rno`='$rn' and `class_name`='$class'");
        while($row = mysqli_fetch_assoc($name_sql))
        {
        $name = $row['name'];
        }

        $result_sql=mysqli_query($conn,"SELECT `Cname`, `Cid`, `issueby`, `issueon`, `valid` FROM `result` WHERE `rno`='$rn' and `class`='$class'");
        while($row = mysqli_fetch_assoc($result_sql))
        {
            $Cname = $row['Cname'];
            $Cid = $row['Cid'];
            $issueby = $row['issueby'];
            $issueon = $row['issueon'];
            $valid = $row['valid'];
            //$mark = $row['marks'];
            //$percentage = $row['percentage'];
        }
        if(mysqli_num_rows($result_sql)==0){
            echo "no certificate";
            exit();
        }
    ?>

    <div class="container">
        <div class="details">
            <span>Name:</span> <?php echo $name ?> <br>
            <span>Class:</span> <?php echo $class; ?> <br>
            <span>Roll No:</span> <?php echo $rn; ?> <br>
        </div>

        <div class="main">
            <div class="s1">
                <p>Certificate</p>
                <p>Certificate Name</p>
                <p>Certificate ID</p>
                <p>Issued by</p>
                <p>Issued On</p>
                <p>Valid Till</p>
            </div>
            <div class="s2">
                <p>Details</p>
                <?php echo '<p>'.$Cname.'</p>';?>
                <?php echo '<p>'.$Cid.'</p>';?>
                <?php echo '<p>'.$issueby.'</p>';?>
                <?php echo '<p>'.$issueon.'</p>';?>
                <?php echo '<p>'.$valid.'</p>';?>
            </div>
        </div>

        <div class="button">
            <button onclick="window.print()">Print Certificate</button>
        </div>
    </div>
</body>
</html>