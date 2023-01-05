<?php 
if(!isset($_POST['submit'])){
   include('../components/header.php');
}else{
  session_start();
}
?>
<style><?php include '../components/style.css'; ?></style>

<div class="login-body">
    <form action="" method="post" class="signup">
    <label for="name">Username</label>
    <input type="text" name="username" id="username" required> <p>
    <label for="password">Password</label>
    <input type="password" name="password" id="password" required> <p>
    <p>
    <input type="submit" name="submit" value="Log in">
    </form>
</div>

<?php
    require "../components/config.php";
    $connection = new PDO($dsn, $username, $password, $options);

    if(isset($_POST['submit'])){
        try {   
          // Get the login information from the form
          $username = $_POST['username'];
          $password = $_POST['password'];
      
          $sql = "SELECT * FROM admins WHERE Username = :username";
          $statement = $connection->prepare($sql);
          $statement->bindParam(':username', $username, PDO::PARAM_STR);
          $statement->execute();
      
          $admin = $statement->fetch(PDO::FETCH_ASSOC);
      
          if(isset($admin['Password'])) {
            if($password == $admin['Password']) {
                $_SESSION['logged_in'] = true;
                header('Location: http://82.147.181.75//exam');
                die();
            } else {
              echo '
              <p class="error">
              Invalid username or password
              </p>
              ';
            }
          } else {
            echo '
            <p class="error">
            Invalid username or password
            </p>
            ';
          }
        } catch(PDOException $error) {
          echo $sql . "<br>" . $error->getMessage();
        }
      }
    ?>