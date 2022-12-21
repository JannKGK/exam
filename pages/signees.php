<?php include('../components/header.php')  ?>
<style><?php include '../components/style.css'; ?></style>

<head>
<script src="../scripts/signees.js"></script>
</head>

<?php 
    //check if user is logged in
    if(!$_SESSION['logged_in']){
        header('Location: http://82.147.185.212/exam');
        die();
    }
?>

<div class="signees-body">
    <div class="time-search">
    <select name="examtime" id="examtime" onchange="filterSignees()">
        <option value="all">Display all</option>
        <?php 

        require "../components/config.php";
        $connection = new PDO($dsn, $username, $password, $options);
        $sql = 'SELECT Time FROM exam_times';
        $statement = $connection->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll();

        //add the exam dates to the table
        foreach($result as $row) {
        $examtime = $row['Time'];

        //format the date to be more readable
        $date = date_create(date("Y-m-d H:i:s", strtotime($examtime)));
        $formatted_date = date_format($date, "j. F Y, H:i");

        echo "<option value='$examtime'>$formatted_date</option>";
        }
        ?>
    </select>
    </div>
    <?php
    try {
        require "../components/config.php";
        $connection = new PDO($dsn, $username, $password, $options);

        $sql = "SELECT * 
        FROM signees";

        $statement = $connection->prepare($sql);
        $statement->execute();

        $result = $statement->fetchAll();
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
    ?>

    <?php 
    if ($result && $statement->rowCount() > 0) { ?>
    
    <table id="signees" class="signees">
        <thead>
            <tr>
                <th onclick="sortTable(0,'signees')">Name</th>
                <th onclick="sortTable(1,'signees')">Email</th>
                <th onclick="sortTableByDate(2,'signees')">Exam time</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($result as $row) { ?>
            <tr class="signee-row">
            <td><?php echo $row["Name"]; ?></td>
            <td><?php echo $row["Email"]; ?></td>
            <td class="exam-time-cell"><?php echo $row["exam_time"]; ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

    <?php } else { ?>
        <p class="error">No signees found.</p>
    <?php }
    ?>
</div>



<script src="../scripts/sort.js"></script>
