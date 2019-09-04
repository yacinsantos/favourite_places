<?php
    ob_start();
    session_start();
    
    include 'includes/header.php';
    include 'includes/connection.php';

    if(isset($_POST['submit']))
    {
      $username = $_POST['username'];
      $password = $_POST['pswd'];
      $error = "";

      $stmt = $conn->prepare("SELECT * FROM users where username = ?");
      $stmt->execute(array($username));

      if($stmt->rowCount() > 0)
      {
        $result = $stmt->fetchAll();
        if($password == $result[0]['password'])
        {
          $_SESSION['username'] = $username;
          header('location: index.php');
        
        } else {
            $error = "password not correct!";
        }
      
      
      } else {
        $error = "user not exist!";
      }


    }
?>

<div class="container login-form">
<div class="form-group">
  <div style="text-align:center">
    <h2>LOGIN</h2>
  </div>
</div>
  <form action="" method="POST">
    <div class="form-group">
      <label for="username">Email:</label>
      <input type="username" class="form-control" id="username" placeholder="Enter username" name="username">
    </div>
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pswd">
    </div>
    <label class="alert-danger"><?php if(isset($error)) echo $error; ?></label><br>
    <button type="submit" class="btn btn-primary" name="submit">Submit</button><br>

  </form>
</div>

</body>
</html>
