<?php
    session_start();
    
    // Definir los valores correctos de usuario y contraseña
    include 'php/connect_db.php';

    // Verificar si el usuario ya inició sesión
    if (isset($_SESSION['usuario'])) {
        $user = $_SESSION['usuario'];
?>
<!DOCTYPE html>
<html>
    <head>
        <title>
            Inici
        </title>
        <link rel="stylesheet" href="css/style.css" />
    </head>
    <body>
        <header>
            <h1>
                Inici
            </h1>
            <ul>
                <li>
                    <a href="index.php">
                        Inici
                    </a>
                </li>
                <li>
                    <a href="php/logout.php">
                        logout
                    </a>
                </li>
            </ul>
        </header>
        <main>
            <h2>
                title 1
            </h2>
            <form>
                <label for="browser">Cerca: </label><br>
                <input type="text" id="browser"><br><br>
                <input type="submit" value="Cercar">
            </form>
        </main>
        <footer>
            <ul>
                <li>
                    <a href="index.php">
                        Inici
                    </a>
                </li>
                <li>
                    <a href="php/logout.php">
                        logout
                    </a>
                </li>
            </ul>
        </footer>
    </body>
</html>
<?php
        // Detener la ejecución del script
        exit;
    }

    // Verificar si se han enviado datos del formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtener los datos del formulario
        $user = $_POST["usuario"];
        $passwd = $_POST["contraseña"];

        try {
            $stmt = $conn->prepare("SELECT * FROM Usuarios");
            $stmt->execute();
            $conn=null;
        }
    
        catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
        }
        $arrayValues = $stmt->fetchAll(PDO::FETCH_ASSOC); 
        // display data
        $usu = array();
        $contr = array();
        foreach ($arrayValues as $row){
            foreach ($row as $key => $val){
                if ($key == "nombre"){
                    array_push($usu, $val);
                } elseif ($key == "passwd"){
                    array_push($contr, $val);
                }
            }
        }

        // Verificar si el usuario existe y la contraseña es correcta
        foreach($usu as $usuari){
            foreach($contr as $contrasenia){
                if ($usuari == $user) {
                    if ($contrasenia == $passwd){
                        // Iniciar sesión
                        $_SESSION['usuario'] = $user;
                        // Redirigir a la página de bienvenida
                        echo "<p>esto funciona</p>";
                        echo "<a href='index.php'>Accede clicando aqui</a>";
                        exit;
                    } else {
                        echo "<p>Contraseña incorrecta</p>";
                    }
                } else {
                    // Mostrar un mensaje de error si el usuario o la contraseña son incorrectos
                    echo "<p>Usuario o contrasña incorrectos. Por favor, inténtelo de nuevo.</p>";
                }
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="es" class="prova">
<head>
    <meta charset="UTF-8">
    <title>Inicio de sesión</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>Iniciar sesión</h1>
    </header>
    <main>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="usuario">Usuario:</label><br>
            <input type="text" id="usuario" name="usuario" value="<?php echo $user; ?>"><br>
            <label for="contraseña">Contraseña:</label><br>
            <input type="password" id="contraseña" name="contraseña" value="<?php echo $passwd; ?>"><br><br>
            <input type="submit" value="Iniciar sesión">
        </form>
    </main>
</body>
</html>
