<?php
  session_start();

    require 'DB.php';

  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT id, email, password FROM users WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {
      $user = $results;
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/styles.css">
    <title>Coffee's UTP</title>
</head>
<body>
    <header>
        <nav class="menu">
            <a href="index.php"><img class="logo" src="iconCUTPG.png" alt="logo"></a>
            <ul class="listaMenu">
                <li class="itemMenu"><a class="linkMenu" href="Login.php">Iniciar sesión</a></li>
                <li class="itemMenu"><a class="linkMenu" href="registro.php">Registrarse</a></li>
            </ul>
        </nav>
    </header>

<?php if(!empty($user)): ?>
  <br> Bienvenido. <?= $user['email']; ?>
  <br>Estas dentro del sistema
  <a href="logout.php">
    Logout
  </a>
<?php else: ?>
  <h1>Porfavor Inicie sesión o Registrese</h1>

  <nav class="message"><a href="Login.php">Iniciar Sesión</a> o
  <a href="registro.php">Registrese</a>
  </nav>
<?php endif; ?>
</body>
</html>