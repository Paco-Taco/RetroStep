<?php 
    $alert = '';
    session_start();

    if(!empty($_SESSION['active'])){
        header('location: main.php');

    }
    else{

        if(!empty($_POST)){
            if(empty($_POST['usuario']) || empty($_POST['clave'])){
                $alert = 'Insert your user and password';
            }
            else{
                require_once "connection.php";
                // Se añade la función de cifrado md5 para la contraseña
                $user = mysqli_real_escape_string($connection, $_POST['usuario']);
                $pass = md5(mysqli_real_escape_string($connection, $_POST['clave']));

                $query = mysqli_query($connection, "SELECT * FROM users WHERE username = '$user' AND password = '$pass' AND deleted_at IS NULL;");
                $result = mysqli_num_rows($query);

                if($result > 0){
                    $data = mysqli_fetch_array($query);
                    print_r($data);
                    $_SESSION['active'] = true;
                    $_SESSION['idUser'] = $data['id']; //Los campos deben de llamarse igual que en la BD
                    // $_SESSION['nombre'] = $data['nombre'];
                    $_SESSION['email'] = $data['email'];
                    $_SESSION['user'] = $data['username'];
                    $_SESSION['rol'] = $data['rol'];

                    if($data['rol'] == 1){
                        header('location: main.php');
                    }else if($data['rol'] == 2){
                        header('location: main_rol2.php');
                    }
                    
                }
                else{
                    $alert = "El usuario o la clave son incorrectos";
                    session_destroy();

                }
            }


        }

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
<script src="https://kit.fontawesome.com/c7fad14ccd.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/styleIndex.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/LogoRS.png"/>
    <title>RetroStep</title>
</head>
<body>
    <div id="Login">
        <header><strong>Hello there!</strong></header>
        
        <form id="LoginForm" action="" method="post">
        <div class="alert"><?php echo isset ($alert) ? $alert : '';  ?></div>

            <label for="Usuario" >User</label>
            <input type="text" name="usuario" >
            <label for="Password">Password</label>
            <input type="password" name="clave" >
            
            <div class="buttons">
                <button id = "Succes" type="submit" >Log in</button>
            </div>

            <div class="terminos">
                By logging-in you are accepting our <a href="Term.html" target="_blank">terms and conditions</a>.
            </div>

        </form>
    </div>

    <script src="app.js"></script>
</body>
</html>