<?php 
    require 'DB.php';
    
    $message = '';

    if (!empty($_POST['email']) && !empty($_POST['password'])){
      $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
      $stmt = $conn->prepare($sql);
      $stmt->bindParam(':email',$_POST['email']);
      $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
      $stmt->bindParam(':password', $password);

      if ($stmt->execute()){
        $message = 'Usuario creado satisfactoriamente';
      }
      else {
        $message = 'Perdon, se han tenido problemas al intentar crear su cuenta';
      }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet"><meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="iconCUTPG.png" type="image/x-icon">
    <link rel="stylesheet" href="assets/styles.css">
    <title>Registro</title>
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
    <?php if(!empty($message)): ?>
        <p> <?= $message ?> </p>
    <?php endif; ?>
    <h1>Registrese</h1>
    <nav class="message"><span>O <a href="Login.php">Inicia Sesión</a></span></nav>
    <form action="registro.php" method="POST">
    <input type="text" name="email" placeholder="Introduzca su email">
    <input type="password" name="password" placeholder="Introduzca su contraseña">
    <input type="password" name="Confirmar_password" placeholder="Introduzca de nuevo su contraseña">
    <input type="submit" value="Registrarse">
  </form>
</body>
</html>