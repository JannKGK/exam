<head>
    <title>Exam</title>
    <link rel="icon" type="image/x-icon" href="http://82.147.185.212/exam/assets/favicon.png">
</head>

<?php 
    session_start();

    if(!isset($_SESSION['logged_in'])){
        $_SESSION['logged_in'] = false;
    }

    if(isset($_POST['logout-submit'])){
        $_SESSION['logged_in'] = false;
        header('Location: http://82.147.181.75/exam');
        die();
    }
?>

<div class="header">
    <h1>Exam</h1>
    <form action="" method="post">
                <p><input id="logout-submit" type="submit" name="logout-submit" style="display: none"></p>
            </form>
    <nav>     
        <?php
        
        if(basename($_SERVER['PHP_SELF']) == 'index.php'){
            echo '
            <p><a href="">Home</a></p>
            <p><a href="pages/signup.php">Sign up</a></p>
            ';
            if($_SESSION['logged_in']){
                echo '
                <p><a href="pages/signees.php">Signees</a></p>
                <p><a href="pages/examtimes.php">Exam times</a></p>
                <p class="login"><a href="#" onclick="document.getElementById(\'logout-submit\').click();">Log out</a></p>
                ';
            }else{
                echo '
                <p class="login"><a href="pages/login.php">Login</a></p>
                ';
            }
        }else{
            echo '
            <p><a href="../">Home</a></p>
            <p><a href="signup.php">Sign up</a></p>
            ';
            if($_SESSION['logged_in']){
                echo '
                <p><a href="signees.php">Signees</a></p>
                <p><a href="examtimes.php">Exam times</a></p>
                <p class="login"><a href="#" onclick="document.getElementById(\'logout-submit\').click();">Log out</a></p>
                ';
            }else{
                echo '
                <p class="login"><a href="login.php">Login</a></p>
                ';
            }
        }

        ?>
    </nav>
</div>
<p></p>