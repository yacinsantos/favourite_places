<?php
    ob_start();
    session_start();
    if(!isset($_SESSION['username'])){
        header('location: login.php');
    }

    include 'includes/header.php';
    include 'includes/connection.php';

    
?>


</head>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="index.php">Home</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-right">
        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="username">
          <?php echo $_SESSION['username']; ?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="logout.php">LOGOUT</a>
        </div>
        </li>
    </ul> 
  </div>
</nav>

<body>

<div class="container" style="margin: 30px">
    <div class="row">
        <div class="col-md map-container">
            <h3>Your favourite locations</h3>
            <div id='map' style='width: 500px; height: 400px;'></div>
            <div id='menu'>
            <input id='streets-v11' type='radio' name='rtoggle' value='streets' checked='checked'>
            <label for='streets'>streets</label>
            <input id='light-v10' type='radio' name='rtoggle' value='light'>
            <label for='light'>light</label>
            <input id='dark-v10' type='radio' name='rtoggle' value='dark'>
            <label for='dark'>dark</label>
            <input id='outdoors-v11' type='radio' name='rtoggle' value='outdoors'>
            <label for='outdoors'>outdoors</label>
            <input id='satellite-v9' type='radio' name='rtoggle' value='satellite'>
            <label for='satellite'>satellite</label>
            </div>
        </div>

        <div class="col-md">
            <div class="form-group">
                <label for="Name">Name</label>
                <input type="text" class="form-control" id="name" placeholder="Name" required>
            </div>
            <div class="form-group">
                <label for="Description">Description</label>
                <textarea name="Description" id="description" placeholder="description" class="form-control" cols="30" rows="10" required></textarea>
            </div>
            <button class="btn btn-info" id="add">ADD</button> 
        </div>
    </div><br>

    <?php
    
    $username = $_SESSION['username'];

    $statement = $conn->prepare("SELECT * FROM positions where username = ?");
    $statement->execute(array($username));
    $rslt = $statement->fetchAll();
    
    ?>

    <div class="row">
        <table class="table table-stripped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rslt as $value) { ?>
                <tr>
                    <td><?php echo $value['id'] ?></td>
                    <td><?php echo $value['name'] ?></td>
                    <td><?php echo $value['description'] ?></td>
                    <td><a href="delete_position.php?action=delete&&id=<?php echo $value['id']; ?>">
                                    <button class="btn btn-danger">Supprimer</button>
                        </a>
                    </td>
                </tr>
             <?php } ?>
            </tbody>
        </table>
    </div>
</div>



<script src="js/app.js"></script>
</body>
</html>