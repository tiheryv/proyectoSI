<?php
// hash 1 $2y$10$L5nZK98ZbuEze4ErhP6bZ.0wrG5b0yrji4OO.ELZJTE7obwkiky8u
$msg = "";

if (isset($_POST['submit'])) {
    $con = new mysqli('localhost', 'root', '', 'password');

    $correo = $con->real_escape_string($_POST['correo']);
    $contrasenia = $con->real_escape_string($_POST['contrasenia']);

    $sql = $con->query("SELECT id, contrasenia FROM usuarios WHERE correo = '$correo'");
    if ($sql->num_rows > 0) {
        $data = $sql->fetch_array();
        if(password_verify($contrasenia, $data['contrasenia'])) {
            $msg ="Login exitoso";
        }else
            $msg = "Por favor verifica la contraseña";
    }else
        $msg = "Por favor verifica el usuario o la contraseña";

}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maxium-scale=1.0, minimo-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie-edge">
    <title>Log In</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
<div class="container" style="background: #3D315B; margin-top: 100px;">
    <div class="row justify-content-center">
        <div class="col-md-6 col-md-offset-3" align="center">
            <img src="images/LoginImage.png"><br><br>

            <?php if($msg != "") echo $msg . "<br><br>"; ?>

            <form method="post" action="login.php">
                <label>Email</label>
                <input class="form-control form-control-lg" name="correo" placeholder="Inserte Email"><br>
                <label>Password</label>
                <input class="form-control form-control-lg" minlength="5" name="contrasenia" type="password" placeholder="Inserte su password"><br>
                <input class="btn btn-success" name="submit" type="submit" value="Entrar..."><br>

            </form>
</body>
</html>