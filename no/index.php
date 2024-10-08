<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LOGIN</title>
    <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        a {
            text-align: center;
        }
    </style>
</head>

<body>
    <div id="wrapper">
        <form action="php/login.php" method="POST" accept-charset="UTF-8" class="form-signin">
            <h2 class="text-center form-signin-heading">
                INGRESO A CAJA
            </h2>
            <input type="text" class="form-control" name="username" placeholder="Usuario ó E-mail" required>
            <br>
            <input type="password" class="form-control" name="password" placeholder="contraseña" required>
            <br>
            <button type="submit" class="btn btn-lg btn-primary btn-block">Login</button>
            <!-- No borrar la linea siguiente es para salir a menu principal desde el serv de porte -->
            <br>
            <a href="../menu.php" class="btn btn-lg btn-info btn-block">SALIR</a>
        </form>
    </div>

    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

</body>

</html>