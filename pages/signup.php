<?php include('../components/header.php')  ?>
<style><?php include '../components/style.css'; ?></style>

<div class="signup-body">
    <form method="post" action="" class="signup">
        <label for="name">Full name</label>
        <input type="text" name="name" id="name" required> <p>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" required> <p>
        <label for="examtime">Exam Time</label>
        <select name="examtime" id="examtime" required>
            <option value="">- Choose a time -</option>
            <?php 

            require "../components/config.php";
            $connection = new PDO($dsn, $username, $password, $options);
            //get examtimes from the db
            $sql = 'SELECT Time FROM exam_times';
            $statement = $connection->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll();

            foreach($result as $row) {
            $examtime = $row['Time'];

            //format the date to be more readable
            $date = date_create(date("Y-m-d H:i:s", strtotime($examtime)));
            $formatted_date = date_format($date, "j. F Y, H:i");
            
            //add examtimes to the select field
            echo "<option value='$examtime'>$formatted_date</option>";
            }
            ?>
        </select>
        <p>
        <input type="submit" name="submit" value="Submit">
    </form>

    <?php

require "../components/config.php";
$connection = new PDO($dsn, $username, $password, $options);

if(isset($_POST['submit'])
&& validateString($_POST['name'],50)
&& validateEmail($_POST['email'])){
    try {   
        //add the form data to the database
        $name = $_POST['name'];
        $email = $_POST['email'];
        $examtime = $_POST['examtime'];
    
        $sql = "INSERT INTO signees (name, email, exam_time) VALUES (:name, :email, :examtime)";
        $statement = $connection->prepare($sql);
        $statement->bindParam(":name", $name, PDO::PARAM_STR);
        $statement->bindParam(":email", $email, PDO::PARAM_STR);
        $statement->bindParam(":examtime", $examtime, PDO::PARAM_STR);
        $statement->execute();
        
        echo"
        <p class='success'>signed up succesfully!</p>
        ";
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

//check if the string is shorter than {len}
function validateString($name, $len){
    if(strlen($name) <= $len){
        return true;
    }
    echo"
    <p class='error'>$name has to be shorter than $len characters!</p>
    ";
    return false;
}

//check if the email has already signed up
function validateEmail($value){
    require "../components/config.php";

    $sql = "SELECT COUNT(*) FROM signees WHERE email = :value";
    $connection = new PDO($dsn, $username, $password, $options);
    $statement = $connection->prepare($sql);
    $statement->bindParam(":value", $value, PDO::PARAM_STR);
    $statement->execute();
    $count = $statement->fetchColumn();

    if($count == 0){
        return true;
    }else{
        echo"
        <p class='error'>You've already signed up!</p>
        ";
        return false;
    }
}
?>
</div>

