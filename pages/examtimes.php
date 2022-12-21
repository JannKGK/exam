<?php include('../components/header.php')  ?>
<style><?php include '../components/style.css'; ?></style>

<?php 
    //check if user is logged in
    if(!$_SESSION['logged_in']){
        header('Location: http://82.147.185.212/exam');
        die();
    }
?>

<div class="examtimes-body">
<div class="add-examtime">
        <form action="#" method="post">
            <input type="datetime-local" name="date" id="date"> <p>
            <input type="submit" name="submit" value="Add date">
        </form>
        <?php
            require "../components/config.php";
            $connection = new PDO($dsn, $username, $password, $options);
            
            if (isset($_POST['submit']) && validateDate($_POST['date'], $connection)) {
                try {
                    $date = $_POST['date'];
                    
                    //add the date to the database
                    $sql = "INSERT INTO exam_times (Time) VALUES (:date)";
                    $statement = $connection->prepare($sql);
                    $statement->bindParam(':date', $date, PDO::PARAM_STR);
                    $statement->execute();
                    
                    echo"
                    <p class='success'>Date added succesfully!</p>
                    ";
                } catch(PDOException $error) {
                    echo $sql . "<br>" . $error->getMessage();
                }
            }
        
            function validateDate($date, $connection) {
                $inputDate = new DateTime($date);
                $currentDate = new DateTime();

                //check if the date has passed
                if($inputDate <= $currentDate){
                    echo "
                    <p class='error'> This date has already passed.</p>
                    ";
                    return false;
                }

                
                //check if the date is already in the database
                $sql = "SELECT * FROM exam_times WHERE Time = :date";
                $statement = $connection->prepare($sql);
                $statement->bindParam(':date', $date, PDO::PARAM_STR);
                $statement->execute();
                $result = $statement->fetchAll();
              
                if (count($result) > 0) {
                    echo "
                    <p class='error'> This date is already in the database.</p>
                    ";    
                    return false;
                }

                return true;
            }
        ?>
    </div>
    <div class="examtimes">
    <?php
        try {
            require "../components/config.php";
            $connection = new PDO($dsn, $username, $password, $options);


            //get the exam dates from the database
            $sql = "SELECT * 
            FROM exam_times";
            
            $statement = $connection->prepare($sql);
            $statement->execute();

            $result = $statement->fetchAll();

        } catch(PDOException $error) {
            echo $sql . "<br>" . $error->getMessage();
        }
        ?>

        <?php 
        if ($result && $statement->rowCount() > 0) { ?>
        
        <table id="examtimes" class="examtimes">
            <thead>
                <tr>
                    <th onclick="sortTableByDate(0,'examtimes')">Exam times</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($result as $row) { ?>
                <tr class="examtime-row">
                    <td>
                        <?php
                        $examtime = $row["Time"];
                        
                        //format the date to be more readable
                        $date = date_create(date("Y-m-d H:i:s", strtotime($examtime)));
                        $formatted_date = date_format($date, "j. F Y, H:i");

                        echo $formatted_date;
                        ?>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>

        <?php } else { ?>
            <p class="error">No exam times found.</p>
        <?php }
        ?>
    </div>

    <script src="../scripts/sort.js"></script>
</div>