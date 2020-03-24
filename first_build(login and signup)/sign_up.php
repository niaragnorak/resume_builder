<html>
    <head>
            <title >Signup PAGE</title>
            <link rel="stylesheet" href="style.css">
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css">
    </head>
        <?php
                    $servername = "localhost";
                    $username = "root";  
                    $password = "";  
                    $databasename = "resume_builder"; 
                    $conn =mysqli_connect($servername,$username,$password,$databasename);
                    function test_input($data) {
                        $data = trim($data);
                        $data = stripslashes($data);
                        $data = htmlspecialchars($data);
                        return $data;
                    }
                    $search=$_POST["usr"];
                    $query1="SELECT username FROM `signup` WHERE `username`='$search'";
                    $link_address1='Signup.html';
                    $result1=mysqli_query($conn,$query1);
                        if(empty($_POST["usr"])){
                            echo "Username field is required<br>Please sign up with valid credentials<br>";
                            echo "<a href='".$link_address1."'>Sign up</a>";
                        }elseif(empty($_POST["email"])){
                            echo "Email field is required<br>Please sign up with valid credentials<br>";
                            echo "<a href='".$link_address1."'>Sign up</a>";
                        }elseif(empty($_POST["password"])){
                            echo "Password field is required<br>Please sign up with valid credentials<br>";
                            echo "<a href='".$link_address1."'>Sign up</a>";
                        }elseif(empty($_POST["retypepassword"])){
                            echo "Authenticate by re-entering the password<br>Please sign up with valid credentials<br>";
                            echo "<a href='".$link_address1."'>Sign up</a>";
                        }elseif(!preg_match('/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,5}$/',$_POST['email'])){
                            echo "Email format is incorrect<br>Please sign up with valid credentials<br>";
                            echo "<a href='".$link_address1."'>Sign up</a>";
                        }elseif($_POST["password"]!=$_POST["retypepassword"]){
                            echo "Passwords do not match<br>Please sign up with valid credentials<br>";
                            echo "<a href='".$link_address1."'>Sign up</a>";
                        }elseif(mysqli_num_rows($result1)!=0){
                            echo "Username already exists<br>Please sign up with unique username<br>";
                            echo "<a href='".$link_address1."'>Sign up</a>";
                        }
                        else{
                            $username1=test_input($_POST["usr"]);
                            $email=test_input($_POST["email"]);
                            $pass=test_input($_POST["password"]);
                            $pass1=test_input($_POST["retypepassword"]);
                            $query="INSERT INTO `signup` VALUES('$username1','$email','$pass')";
                            if($result=mysqli_query($conn,$query)){
                                $to=$email;
                                $subject="Welcome to Resume Builder 2020";
                                $message0="".$username1." , welcome to Resume Builder 2020. This is a WEB application to create you own resume<br>";
                                $message1=" Here are your credentials:<br>";
                                $message2="USERNAME: ".$username1."<br> PASSWORD: ".$pass."<br>Thank you";
                                $message=$message0.$message1.$message2;
                                $headers="From: resumebuilder2020edition@gmail.com";
                                if(mail($to,$subject,$message)){
                                    $link_address='index.html';
                                    echo "Sign up successful. Please Sign in to Resume Builder<br>";
                                    echo "<a href='".$link_address."'>Sign in</a>";
                                }
                                
                            }
                            else{
                                $link_address='index.html';
                                echo "Something went wrong. Please go back to Sign in page<br>";
                                echo "<a href='".$link_address."'>Go Back</a>";
                            }
                        }
        ?>
</html>
