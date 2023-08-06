<?php 

  session_start();

  if (isset($_SESSION['user_id'])){
    header('Location: /Coffee-s-UTP/index.php');
  }

  require 'DB.php';

  if (!empty($_POST['email']) && !empty($_POST['password'])){
    $records = $conn->prepare('SELECT id, email, password FROM users WHERE email=:email');
    $records->bindParam(':email', $_POST['email']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $message = '';

    if (count($results) > 0 && password_verify($_POST['password'], $results['password'])){
      $_SESSION['user_id'] = $results['id'];
      header("Location: /Coffee-s-UTP/index.php");
    } else {
      $message = "Perdon, estas credenciales no coinciden";
    }
  }

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  
  <link rel="icon" href="iconCUTPG.png" type="image/x-icon">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
  <link rel="shortcut icon" href="iconCUTPG.png" type="image/x-icon">
  <link rel="stylesheet" href="assets/styles.css">

</head>
<body>
  <header>
    <nav class="menu">
      <a href="index.php"><img class="logo" src="iconCUTPG.png" alt="logo"></a>
      <ul class="listaMenu">
            <li class="itemMenu"><a class="linkMenu" href="index.php">Inicio</a></li>
        </ul>
    </nav>
</header>
  <?php if (!empty($message)) : ?>
    <p> <?= $message ?> </p>
  <?php endif ?>
  <h1>Iniciar Sesión </h1>
  <nav class="message"><span>O <a href="registro.php">Inicia Registrese</a></span></nav>
  
  <nav class="box--of_login">
  <form action="Login.php" method="POST">
    <input type="text" name="email" placeholder="Introduzca su email">
    <input type="password" name="password" placeholder="Introduzca su contraseña">
    <input type="submit" value="Iniciar sesión">
  </form>
  </nav>
</body>
</html>
