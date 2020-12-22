<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Student details</title>
<style>
    /* CSS Styling */
	body{
		text-align:center;
        padding:50px;
		border-radius:20px;
        margin:auto;
	}
    .error {
        color: #cc0000;
    }
    .talign{
        width: 130%;
        align-items: center;
        display: inline-block;
        border-bottom-style: none;
    }
    form{
        background-color:rgb(177, 201, 201);
        padding: 30px;
        border-radius:20px;
    }
    .talign td input{
        max-width:132px;
    }
    .disable:after{
        bottom: 0;
        content: '';
        left: 0;
        position: absolute;
        right: 0;
        top: 0;
    }
</style>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<body>
<?php

    require './dbConnect.php';

    // Declaration
    $fname_error=$lname_error=$gender_error=$dob_error=$branch_error=$regno_error=$mark1_error=$mark2_error=$semCredErr=$semMaxCredErr=false;
    $pfname=$plname=$pgender=$pdob=$pbranch=$pregno=$pmark1=$pmark2='';
    $pfnameValid=$plnameValid=$pgenderValid=$pdobValid=$prollValid=$pbranchValid=$pmark1Valid=$pmark2Valid=false;
    $cgpa_valid=false;
    $cgpa_error = false;

    // Error value declaration
    $semCred1=$semCred2=$semCred3=$semCred4=$semCred5=$semCred6=$semCred7=0;
    $semMaxCred1=$semMaxCred2=$semMaxCred3=$semMaxCred4=$semMaxCred5=$semMaxCred6=$semMaxCred7=0;
    $gpa1=$gpa2=$gpa3=$gpa4=$gpa5=$gpa6=$gpa7=0.0;
    $cgpa1=$cgpa2=$cgpa3=$cgpa4=$cgpa5=$cgpa6=$cgpa7=0.0;

    $semCredValid=false;

    $Disable="";
    $Submit="preview";
    $Clear = "clear";

    if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST['clear'])) {

        // Validate first name
        $pfname=trim($_POST["pfname"]);
        if(empty($_POST['pfname'])){
            $fname_error = "First Name is required";
            $pfnameValid = false;
        }
        else if(!preg_match("/^[a-zA-Z]*$/",$pfname)) {
            $fname_error = "Only letters are allowed";
            $pfnameValid = false;
        }
        else{
            $pfname = test_input($_POST["pfname"]);
            $pfnameValid = true;
        }

        // Validate last name
        $plname=trim($_POST["plname"]);
        if(empty($_POST['plname'])){
            $lname_error = "Last Name is required.";
            $plnameValid = false;
        }
        else if(!preg_match("/^([a-zA-Z])*([\s]{1})?([a-zA-Z]{1,3})?$/",$plname)) {
            $lname_error = "Only letters and white space allowed";
            $plnameValid = false;
        }
        else{
            $plname = test_input($_POST["plname"]);
            $plnameValid = true;
        }
        // Validate gender
        if(empty($_POST["pgender"])){
            $gender_error="Gender is required";
            $pgenderValid = false;
        }
        else{
            $pgender = test_input($_POST["pgender"]);
            $pgenderValid = true;
        }
        //  Validate dob
        if(empty($_POST['pdob'])){
            $dob_error = "DOB is required";
            $pdobValid = false;
        }
        else {
            $pdob = test_input($_POST["pdob"]);
            $pdobValid = true;
        }
        //validate branch
        /*if(empty($_POST["pbranch"])){
            $branch_error = "branch is required";
            $pbranchValid = false;
        }
        else if(!validBranch($_POST["pbranch"])){
            $branch_error="Invalid branch";
            $pbranchValid = false;
        }
        else{
            $pbranch = test_input($_POST["pbranch"]);
            $pbranchValid = true;
        }*/

        //validate reg.no
        $pregno=trim($_POST["pregno"]);
        if(empty($_POST["pregno"])){
            $regno_error = "Reg.no is required";
            $prollValid = false;
        }
        else if(!validate_roll($_POST["pregno"])){
            $regno_error = "Invalid Reg.no";
            $prollValid = false;
        }
        else if(isRollPresent($_POST["pregno"])){
            $regno_error = "Reg.no is inserted already";
            $prollValid = false;
        }
        else{
            $pregno = test_input($_POST["pregno"]);
            $prollValid = true;
        }

        //validate 10thmark
        /*$pmark1=trim($_POST["pmark1"]);
        if(empty($_POST["pmark1"])){
            $mark1_error = "SSLC mark is required";
            $pmark1Valid = false;
        }
        else if((int)$pmark1 > 500||(int)$pmark1 < 250){
            $mark1_error = "SSLC mark should between 250 and 500";
            $pmark1Valid = false;
        }
        else{
            $pmark1 = test_input($_POST["pmark1"]);
            $pmark1Valid = true;
        }*/

        //Validate 12th mark
        /*$pmark2=trim($_POST["pmark2"]);
        if(empty($_POST["pmark2"])){
            $mark2_error = "HSC mark is required";
            $pmark2Valid = false;
        }
        else if((int)$pmark2 > 1200||(int)$pmark2 < 500){
            $mark2_error = "HSC mark should between 500 and 1200";
            $pmark2Valid = false;
        }
        else{
            $pmark2 = test_input($_POST["pmark2"]);
            $pmark2Valid = true;
        }*/

            //Declaration for gpa and cgpa
         /*   $semCred1=$_POST['semCred1'];
            $semCred2=$_POST['semCred2'];
            $semCred3=$_POST['semCred3'];
            $semCred4=$_POST['semCred4'];
            $semCred5=$_POST['semCred5'];
            $semCred6=$_POST['semCred6'];
            $semCred7=$_POST['semCred7'];

            $semMaxCred1=$_POST['semMaxCred1'];
            $semMaxCred2=$_POST['semMaxCred2'];
            $semMaxCred3=$_POST['semMaxCred3'];
            $semMaxCred4=$_POST['semMaxCred4'];
            $semMaxCred5=$_POST['semMaxCred5'];
            $semMaxCred6=$_POST['semMaxCred6'];
            $semMaxCred7=$_POST['semMaxCred7'];

            if(empty($semCred1) || empty($semCred2) || empty($semCred3) || empty($semCred4) ||
               empty($semCred5) || empty($semCred6) || empty($semCred7)){
                $semCredErr="SEM credit is required";
                $semCredValid = false;
            }else if(empty($semMaxCred1) || empty($semMaxCred2) || empty($semMaxCred3) || empty($semMaxCred4) || empty($semMaxCred5) || empty($semMaxCred6) || empty($semMaxCred7) ){
                $semMaxCredErr="SEM max credit is required";
                $semCredValid = false;
            }
            else{
                if( gettype((int)$semCred1) != "integer" || gettype((int)$semCred2) != "integer" || gettype((int)$semCred3) != "integer" ||
                    gettype((int)$semCred4) != "integer" || gettype((int)$semCred5) != "integer" || gettype((int)$semCred6) != "integer" || gettype((int)$semCred7) != "integer"){
                    echo  gettype((int)$semCred1).gettype((int)$semCred2).gettype((int)$semCred3).gettype((int)$semCred4).gettype((int)$semCred5).gettype((int)$semCred6).gettype((int)$semCred7);
                    $semCredErr="SEM credit is not a number";
                    $semCredValid = false;
                }
                else if( gettype((int)$semMaxCred1) != "integer" || gettype((int)$semMaxCred2) != "integer" || gettype((int)$semMaxCred3) != "integer" ||
                          gettype((int)$semMaxCred4) != "integer" || gettype((int)$semMaxCred5) != "integer" || gettype((int)$semMaxCred6) != "integer" || gettype((int)$semMaxCred7) != "integer"){
                    $semMaxCredErr="SEM max credit is not a number";
                    $semCredValid = false;
                }
                else if( (int)$semCred1 > 320 || (int)$semCred2 > 320 || (int)$semCred3 > 320 || (int)$semCred4 > 320 || (int)$semCred5 > 320 ||
                         (int)$semCred6 > 320 || (int)$semCred7 > 320 || (int)$semCred1 < 0 || (int)$semCred2 < 0 || (int)$semCred3 < 0 || (int)$semCred4 < 0 || (int)$semCred5 < 0 ||
                         (int)$semCred6 < 0 || (int)$semCred7 < 0){
                    $semCredErr="SEM credit sholud lies between 0 and 320";
                    $semCredValid =  false;
                }
                else if( (int)$semMaxCred1 > 32 || (int)$semMaxCred2 > 32 || (int)$semMaxCred3 > 32 || (int)$semMaxCred4 > 32 || (int)$semMaxCred5 > 32 ||
                          (int)$semMaxCred6 > 32 || (int)$semMaxCred7 > 32 || (int)$semMaxCred1 < 0 || (int)$semMaxCred2 < 0 || (int)$semMaxCred3 < 0 ||
                          (int)$semMaxCred4 < 0 || (int)$semMaxCred5 < 0 || (int)$semMaxCred6 < 0 || (int)$semMaxCred7 < 0 ){
                    $semMaxCredErr="SEM max credit sholud lies between 0 and 32";
                    $semCredValid = false;
                }else{
                    $semMaxCredErr = "";
                    $semCredValid = true;

                    // sem credits
                    $semCred1=(int)$semCred1;
                    $semCred2=(int)$semCred2;
                    $semCred3=(int)$semCred3;
                    $semCred4=(int)$semCred4;
                    $semCred5=(int)$semCred5;
                    $semCred6=(int)$semCred6;
                    $semCred7=(int)$semCred7;

                    //sem maximum credits
                    $semMaxCred1=(int)$semMaxCred1;
                    $semMaxCred2=(int)$semMaxCred2;
                    $semMaxCred3=(int)$semMaxCred3;
                    $semMaxCred4=(int)$semMaxCred4;
                    $semMaxCred5=(int)$semMaxCred5;
                    $semMaxCred6=(int)$semMaxCred6;
                    $semMaxCred7=(int)$semMaxCred7;

                    //calculations for gpa
                    $gpa1=$semCred1/$semMaxCred1;
                    $gpa2=$semCred2/$semMaxCred2;
                    $gpa3=$semCred3/$semMaxCred3;
                    $gpa4=$semCred4/$semMaxCred4;
                    $gpa5=$semCred5/$semMaxCred5;
                    $gpa6=$semCred6/$semMaxCred6;
                    $gpa7=$semCred7/$semMaxCred7;

                    //calculation for cgpa
                    $cgpa1=$semCred1/$semMaxCred1;
                    $cgpa2=($semCred1+$semCred2)/($semMaxCred1+$semMaxCred2);
                    $cgpa3=($semCred1+$semCred2+$semCred3)/($semMaxCred1+$semMaxCred2+$semMaxCred3);
                    $cgpa4=($semCred1+$semCred2+$semCred3+$semCred4)/($semMaxCred1+$semMaxCred2+$semMaxCred3+$semMaxCred4);
                    $cgpa5=($semCred1+$semCred2+$semCred3+$semCred4+$semCred5)/($semMaxCred1+$semMaxCred2+$semMaxCred3+$semMaxCred4+$semMaxCred5);
                    $cgpa6=($semCred1+$semCred2+$semCred3+$semCred4+$semCred5+$semCred6)/($semMaxCred1+$semMaxCred2+$semMaxCred3+$semMaxCred4+$semMaxCred5+$semMaxCred6);
                    $cgpa7=($semCred1+$semCred2+$semCred3+$semCred4+$semCred5+$semCred6+$semCred7)/($semMaxCred1+$semMaxCred2+$semMaxCred3+$semMaxCred4+$semMaxCred5+$semMaxCred6+$semMaxCred7);

                    if($gpa1>10 || $gpa2>10 || $gpa3>10 || $gpa4>10 || $gpa5>10 || $gpa6>10 || $gpa7>10 || $cgpa1>10 || $cgpa2>10 || $cgpa3>10 || $cgpa4>10 || $cgpa5>10 || $cgpa6>10 || $cgpa7>10)
                    {
                        $cgpa_error = "Please put correct credits earned and max credit";
                        $cgpa_valid = false;
                    }
                    else{
                        $cgpa_valid = true;
                    }

                }
            }
        }*/

            function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }

            //function for validate roll no
        function validate_roll($pregno){
            require './dbConnect.php';
            $sql = "SELECT count(*) FROM student_details WHERE rollno = $pregno";
            $result = $conn->query($sql);
            $row = $result->fetch();
            if($row[0]=='1'){
                return true;
            }else{
                return false;
            }
        }
            //function for roll.no is present in database
        function isRollPresent($pregno){
            require './dbConnect.php';
            $sql = "SELECT count(*) FROM details WHERE rollno = $pregno";
            $result = $conn->query($sql);
            $row = $result->fetch();
            if($row[0]!='0'){
                return true;
            }else{
                return false;
            }
        }
            //validate branch
        function validBranch($pbranch){
            require './dbConnect.php';
            $sql = "SELECT count(*) FROM branch WHERE branch_code = $pbranch";
            $result = $conn->query($sql);
            $row = $result->fetch();
            if($row[0]=='1'){
                return true;
            }else{
                return false;
            }
        }
        //change form into disable manner
        if(isset($_POST['preview']) && $pfnameValid && $plnameValid && $cgpa_valid && $pgenderValid && $pdobValid && $prollValid && $pbranchValid && $pmark1Valid && $pmark2Valid && $semCredValid){
            $Disable = "disable";
            $Clear = "Edit";
            $Submit = "submit";

            echo '<style>
                    .error{
                        display:none;
                    }
                </style>';
        }
        //change form into undisable manner
        else if(isset($_POST['Edit']))
        {
            $Disable = "";
            $Clear = "clear";
            $Submit = "preview";


        }
        else if(isset($_POST['submit'])){

            //storing all values to the database
            if($pfnameValid && $plnameValid && $pgenderValid && $pdobValid && $prollValid && $pbranchValid && $pmark1Valid && $pmark2Valid && $semCredValid){
                require './dbConnect.php';
                $pmark1 = $pmark1/5;
                $pmark2 = $pmark2/12;
                $data=[$pfname,$plname,$pgender,$pdob,$pregno,$pbranch,$pmark1,$pmark2,
                        $gpa1,$cgpa1,
                        $gpa2,$cgpa2,
                        $gpa3,$cgpa3,
                        $gpa4,$cgpa4,
                        $gpa5,$cgpa5,
                        $gpa6,$cgpa6,
                        $gpa7,$cgpa7];

                try{
                    $insert_details =$conn->prepare("INSERT INTO details(first_name,last_name,gender,dob,rollno,branch,10th_mark,12th_mark,sem1_gpa,sem1_cgpa,sem2_gpa,sem2_cgpa,sem3_gpa,sem3_cgpa,sem4_gpa,sem4_cgpa,se,,5_gpa,sem5_cgpa,sem6_gpa,sem6_cgpa,sem7_gpa,sem7_cgpa) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

                    $insert_details->execute($data);

                }catch(PDOException $e) {
                    echo "Error occurs in inserting data : ".$e->getMessage();
                }

                $fname_error=$lname_error=$gender_error=$dob_error=$branch_error=$regno_error=$mark1_error=$mark2_error=$semCredErr=$semMaxCredErr=false;
                $pfname=$plname=$pgender=$pdob=$pbranch=$pregno=$pmark1=$pmark2='';
                $pfnameValid=$plnameValid=$pgenderValid=$pdobValid=$prollValid=$pbranchValid=$pmark1Valid=$pmark2Valid=false;

                $semCred1=$semCred2=$semCred3=$semCred4=$semCred5=$semCred6=$semCred7=0;
                $semMaxCred1=$semMaxCred2=$semMaxCred3=$semMaxCred4=$semMaxCred5=$semMaxCred6=$semMaxCred7=0;
                $gpa1=$gpa2=$gpa3=$gpa4=$gpa5=$gpa6=$gpa7=0.0;
                $cgpa1=$cgpa2=$cgpa3=$cgpa4=$cgpa5=$cgpa6=$cgpa7=0.0;

                $semCredValid=false;

                $Disable = "";
                $Clear="clear";
                $Submit="preview";
                }
                else{
                    $Disable = "";
                    $Clear="clear";
                    $Submit="preview";

                    echo '<style>
                            .error{
                                display:block;
                            }
                        </style>';
                }
            }


        ?>
    <div class="container">
        <div class="row">
            <div class="col-6">
                <div class="jumbotron" style="background-color: #ccccff;">
                        <h3 style="font-weight:800;color:Black">Student Registration</h3>
                </div>
                    <div class="input__container">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                            <div class="form-group row error">
                                <label class="col-8 ">*Required Details</label>
                            </div>
                            <!-- create firstname input type -->
                            <div class="form-group row">
                                <label class="col-sm-3"></label>
                                <label class="col-sm-3" align="left">First Name:<span class="error">*</span></label>
                                <div class="col-sm-3 <?php echo $Disable;?>">
                                    <input type="text" class="form-control" name="pfname" placeholder="First Name" value = "<?php echo $pfname;?>">
                                </div>
                                <div class="col-sm-2 error">
                                        <?php
                                            if($fname_error != ""){
                                                echo $fname_error;
                                            }
                                        ?>
                                </div>
                            </div>
                            <!-- create lastname input type -->
                            <div class="form-group row">
                                <label class="col-sm-3"></label>
                                <label class="col-sm-3" align="left">last Name:<span class="error">*</span></label>
                                <div class="col-sm-3 <?php echo $Disable;?>">
                                    <input type="text" class="form-control" name="plname" placeholder="last Name" value="<?php echo $plname;?>">
                                </div>
                                <div class="col-sm-2 error">
                                        <?php
                                            if($lname_error != ""){
                                                echo $lname_error;
                                            }
                                        ?>
                                </div>
                            </div>
                            <!-- create gender -->
                            <div class="form-group row">
                                <label class="col-sm-3"></label>
                                <label class="col-sm-3" align="left">Gender:<span class="error">*</span></label>
                                <div class="col-sm-3 <?php echo $Disable;?>">
                                    <div class="radio-inline">
                                        <label><input type="radio" name="pgender" value="1" <?php if($pgender==1) echo "checked"; ?>>Male</label>
                                    </div>
                                    <div class="radio-inline">
                                        <label><input type="radio" name="pgender" value="2" <?php if($pgender==2) echo "checked"; ?>>Female</label>
                                    </div>
                                    <div class="radio-inline">
                                        <label><input type="radio" name="pgender" value="3" <?php if($pgender==3) echo "checked"; ?>>Other</label>
                                    </div>
                                </div>
                                <div class="error col-sm-2">
                                        <?php
                                            if($gender_error != ""){
                                                echo $gender_error;
                                            }
                                        ?>
                                </div>
                            </div>
                            <!-- Create DOB -->
                            <div class="form-group row">
                                <label class="col-sm-3"></label>
                                <label class="col-sm-3" align="left">DOB:<span class="error">*</span></label>
                                <div class="col-sm-3 <?php echo $Disable;?>">
                                    <input type="date" class="form-control" name="pdob" onkeydown="return false" min="1990-01-01" max="2000-01-01" pattern="dd-mm-yyyy" value="<?php if($pdob!="") echo $pdob; ?>">
                                </div>
                                <div class="error col-sm-2">
                                        <?php
                                            if($dob_error != ""){
                                                echo $dob_error;
                                            }
                                        ?>
                                </div>
                            </div>
                            <!-- Create reg.no input type -->
                            <div class="form-group row">
                                <label class="col-sm-3"></label>
                                <label class="col-sm-3" align="left">Reg.no:<span class="error">*</span></label>
                                <div class="col-sm-3 <?php echo $Disable;?>">
                                    <input type="number" class="form-control" name="pregno" pattern="[0-9]{10}" placeholder="Reg.no" value="<?php echo $pregno; ?>">
                                </div>
                                <div class="error col-sm-2">
                                        <?php
                                            if($regno_error != ""){
                                                echo $regno_error;
                                            }
                                        ?>
                                </div>
                            </div>
                            <!-- Create branch type -->
                            <div class="form-group row">
                                <label class="col-sm-3"></label>
                                <label class="col-sm-3" align="left">Branch:<span class="error">*</span></label>
                                <div class="col-sm-3 <?php echo $Disable;?>">
                                    <select id="Department" name="pbranch" class="form-control" <?php  echo $pbranch; ?>>
                                    <option <?php if($pbranch=="") echo "selected"; ?> disabled>Select a Branch</option>
                                        <?php
                                        $sql = "SELECT branch,branch_code FROM branch";
                                        $result = $conn->query($sql);
                                        while($row = $result->fetch(PDO::FETCH_ASSOC) )
                                        {
                                            if($branch==$row['branch_code']){
                                                echo "<option value='".$row['branch_code']."' selected>".$row['branch']."</option>";
                                            }else{
                                                echo "<option value='".$row['branch_code']."'>".$row['branch']."</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="error col-sm-2">
                                        <?php
                                            if($branch_error != ""){
                                                echo $branch_error;
                                            }
                                        ?>
                                </div>
                            </div>
                            <!-- Create SSLC input type -->
                            <div class="form-group row">
                                <label class="col-sm-3"></label>
                                <label class="col-sm-3" align="left">SSLC mark:<span class="error">*</span></label>
                                <div class="col-sm-3 <?php echo $Disable;?>">
                                    <input type="number" class="form-control" name="pmark1" placeholder="SSLC mark" value="<?php echo $pmark1 ?>">
                                </div>
                                <div class="error col-sm-2">
                                        <?php
                                            if($mark1_error != ""){
                                                echo $mark1_error;
                                            }
                                        ?>
                                </div>
                            </div>
                            <!-- Create HSC input type -->
                           <div class="form-group row">
                                <label class="col-sm-3"></label>
                                <label class="col-sm-3" align="left">HSC mark:<span class="error">*</span></label>
                                <div class="col-sm-3 <?php echo $Disable;?>">
                                    <input type="number" class="form-control" name="pmark2" placeholder="HSC mark" value="<?php echo $pmark2?>">
                                </div>
                                <div class="error col-sm-2">
                                        <?php
                                            if($mark2_error != ""){
                                                echo $mark2_error;
                                            }
                                        ?>
                                </div>
                           </div>
                           <div class="form-group row col-8">
                                <div class="error">
                                    <?php
                                            if($semCredErr != ""){
                                                echo $semCredErr;
                                            }
                                            else if($semMaxCredErr !=""){
                                                echo $semMaxCredErr;
                                            }
                                            else if($cgpa_error != ""){
                                                echo $cgpa_error;
                                            }
                                    ?>
                                </div>
                           </div>
                           <!-- Create cgpa and gpa table -->
                            <div class="form-group row" style="width:60%;
                            align-items: center;
                            display: inline-block;">
                                <div class="col-sm-4 table">
                                    <table class="table talign" style="background-color:rgb(177, 201, 201)">
                                        <thead>
                                          <tr>
                                            <th scope="col" style="text-align:center;">Semester<span class="error">*</span></th>
                                            <th scope="col" style="text-align:center;">Credits Earned<span class="error">*</span></th>
                                            <th scope="col" style="text-align:center;">Max Credits<span class="error">*</span></th>
                                            <th scope="col" style="text-align:center;">GPA</th>
                                            <th scope="col" style="text-align:center;">CGPA</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr class="<?php echo $Disable;?>">
                                            <th scope="row" style="text-align:center;">1</th>
                                            <td><input type="number" name="semCred1" placeholder="1st sem Credits" value="<?php echo $semCred1?>"></td>
                                            <td><input type="number" name="semMaxCred1" placeholder="Max Credits" value="<?php echo $semMaxCred1?>"></td>
                                            <td><input type="number" name="gpa1" readonly placeholder="GPA" value = "<?php echo(round($gpa1,2))?>"></td>
                                            <td><input type="number" name="cgpa1" readonly placeholder="CGPA" value = "<?php echo(round($cgpa1,2))?>"></td>
                                          </tr>
                                          <tr class="<?php echo $Disable;?>">
                                            <th scope="row" style="text-align:center;">2</th>
                                            <td><input type="number" name="semCred2" placeholder="2st sem Credits" value="<?php echo $semCred2?>"></td>
                                            <td><input type="number" name="semMaxCred2" placeholder="Max Credits"value="<?php echo $semMaxCred2?>"></td>
                                            <td><input type="number" name="gpa2" readonly placeholder="GPA" value="<?php echo(round($gpa2,2))?>"></td>
                                            <td><input type="number" name="cgpa2" readonly placeholder="CGPA" value="<?php echo(round($cgpa2,2))?>"></td>
                                          </tr >
                                          <tr class="<?php echo $Disable;?>">
                                            <th scope="row" style="text-align:center;">3</th>
                                            <td><input type="number" name="semCred3" placeholder="3st sem Credits" value="<?php echo $semCred3?>"></td>
                                            <td><input type="number" name="semMaxCred3" placeholder="Max Credits" value="<?php echo $semMaxCred3?>"></td>
                                            <td><input type="number" name="gpa3" readonly placeholder="GPA" value="<?php echo(round($gpa3,2))?>"></td>
                                            <td><input type="number" name="cgpa3" readonly placeholder="CGPA" value="<?php echo(round($cgpa3,2))?>"></td>
                                          </tr>
                                          <tr class="<?php echo $Disable;?>">
                                            <th scope="row" style="text-align:center;">4</th>
                                            <td><input type="number" name="semCred4" placeholder="4st sem Credits" value="<?php echo $semCred4?>"></td>
                                            <td><input type="number" name="semMaxCred4" placeholder="Max Credits" value="<?php echo $semMaxCred4?>"></td>
                                            <td><input type="number" name="gpa4" readonly placeholder="GPA" value="<?php echo(round($gpa4,2))?>"></td>
                                            <td><input type="number" name="cgpa4" readonly placeholder="CGPA" value="<?php echo(round($cgpa4,2))?>"></td>
                                          </tr>
                                          <tr class="<?php echo $Disable;?>">
                                            <th scope="row" style="text-align:center;">5</th>
                                            <td><input type="number" name="semCred5" placeholder="5st sem Credits" value="<?php echo $semCred5?>"></td>
                                            <td><input type="number" name="semMaxCred5" placeholder="Max Credits" value="<?php echo $semMaxCred5?>"></td>
                                            <td><input type="number" name="gpa5" readonly placeholder="GPA" value="<?php echo(round($gpa5,2))?>"></td>
                                            <td><input type="number" name="cgpa5" readonly placeholder="CGPA" value="<?php echo(round($cgpa5,2))?>"></td>
                                          </tr>
                                          <tr class="<?php echo $Disable;?>">
                                            <th scope="row" style="text-align:center;">6</th>
                                            <td><input type="number" name="semCred6" placeholder="6st sem Credits" value="<?php echo $semCred6?>"></td>
                                            <td><input type="number" name="semMaxCred6" placeholder="Max Credits" value="<?php echo $semMaxCred6?>"></td>
                                            <td><input type="number" name="gpa6" readonly placeholder="GPA" value="<?php echo(round($gpa6,2))?>"></td>
                                            <td><input type="number" name="cgpa6" readonly placeholder="CGPA" value="<?php echo(round($cgpa6,2))?>"></td>
                                          </tr>
                                          <tr class="<?php echo $Disable;?>">
                                            <th scope="row" style="text-align:center;">7</th>
                                            <td><input type="number" name="semCred7" placeholder="7st sem Credits" value="<?php echo $semCred7?>"></td>
                                            <td><input type="number" name="semMaxCred7" placeholder="Max Credits" value="<?php echo $semMaxCred7?>"></td>
                                            <td><input type="number" name="gpa7" readonly placeholder="GPA" value="<?php echo(round($gpa7,2))?>"></td>
                                            <td><input type="number" name="cgpa7" readonly placeholder="CGPA" value="<?php echo(round($cgpa7,2))?>"></td>
                                          </tr>
                                        </tbody>
                                      </table>
                                </div>
                            </div>-->
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <input type="submit" class="btn btn-primary submit-btn" value="<?php echo $Clear;?>" name="<?php echo $Clear;?>"<?php echo $Clear;?>>
                                </div>
                                <div class="col-sm-6">
                                    <input type="submit" class="btn btn-primary submit-btn" value="<?php echo $Submit;?>" name="<?php echo $Submit;?>"<?php echo $Submit;?>>
                                </div>
                            </div>


                        </form>
                    </div>

                </div>
            </div>
        </div>
    </body>
</html>