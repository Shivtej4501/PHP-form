<?php 
    $flag = false;

    if (key_exists("submitBtn", $_POST)) {  //this means we are executing the code after user click on submit button
        // connection to the MySql database
    
        $server = "localhost";
        $username = "root";
        $password = "";
    
        // establish connection using mysqli_connect function
        $con = mysqli_connect($server, $username, $password);
    
        // display error if connection gets failed 
        if (! $con) {
            die("connection failed due to ". mysqli_connect_error());
        }
    
        // getting the input from the html page
        @$name = $_POST['name'];
        @$age = $_POST['age'];
        @$gender = $_POST['gender'];
        @$email = $_POST['email'];
        @$phone = $_POST['phone'];
        @$desc = $_POST['desc'];
    
        // run sql query to insert values into the table
        $sql = "INSERT INTO `trip`.`ustrip` (`name`, `age`, `gender`, `email`, `phone`, `des`, `date`) 
            VALUES ('$name', '$age', '$gender', '$email', '$phone', '$desc', current_timestamp());";
    
        // execute the query
    
        if($con->query($sql) == true){
            $flag = true;
        }
        else{
            echo "Error : $sql <br> $con->error";
        }
        
        // close the connection
        $con->close();

    }
    // $flag = false;
    if(key_exists("anotherBtn", $_POST)){
        $flag = false;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>PHP</title>
</head>
<body>
    <img class="bg" src="bg.jpg" alt="Library">
    <div class="conatiner">
        <h1 class="heading">Welcome to US Trip Form</h1>
        <p>Enter Your Details and Submit the Form</p>
        <!-- when flag is true this paragraph will be visiable -->
        <?php
            if ($flag == true) {
                echo '<p class="submitMessage">Thanks for Submitting </p><br>';
                echo '<form method="POST" action="index.php">'; // Correct placement of method attribute
                echo '<button class="btn" name="anotherBtn" value="click">Submit Another form</button>';
                echo '</form>';
            }

            if($flag == false){
                echo '<form action="index.php" method="POST">
                    <input type="text" name="name" id="name" placeholder="Enter your name">
                    <input type="text" name="age" id="age" placeholder="Enter your age">
                    <input type="text" name="gender" id="gender" placeholder="Enter your gender">
                    <input type="email" name="email" id="email" placeholder="Enter your Email ">
                    <input type="phone" name="phone" id="phone" placeholder="Enter Your Phone No">
                    <textarea name="desc" id="desc" cols="30" rows="10" placeholder="Enter Any Other Information Here"></textarea>
                    <button class="btn" name="submitBtn" value="click">Submit</button>
                </form>';
            }
        ?>        
    </div>
</body>
</html>