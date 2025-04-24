<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zenoft</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
        }
        header {
            background-color: #4CAF50;
            color: white;
            padding: 1rem;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 1rem;
            position: fixed;
            bottom: 0;
            width: 100%;
            box-shadow: 0 -2px 4px rgba(0, 0, 0, 0.1);
        }
        main {
            padding: 2rem;
            margin-bottom: 3rem;
        }
        h1 {
            margin: 0;
            font-size: 2rem;
        }
        h2 {
            color: #4CAF50;
            margin-bottom: 1rem;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        ul#lista-de-juegos li {
            background: #fff;
            margin: 0.5rem 0;
            padding: 0.5rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        ul#lista-de-juegos li button {
            margin-left: 0.5rem;
            padding: 0.3rem 0.6rem;
            border: 1px solid #ccc;
            border-radius: 3px;
            cursor: pointer;
        }
        ul#lista-de-juegos li button:hover {
            background-color: #eee;
        }
    </style>
</head>
<body>
    <header>
        <h1>Bienvenido a Zenoft</h1>
    </header>
    <main>
        <h2>Lista de Juegos</h2>
        <ul id="lista-de-juegos">
	
            <?php
	    ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
            $host = 'db-avance.cpueoq6omon5.us-east-1.rds.amazonaws.com'; // Replace with your database host
            $user = 'zenoft';     // Replace with your database username
            $password = 'Charizard'; // Replace with your database password
            $database = 'paginajuego'; // Replace with your database name
            $port = '3306';     // Replace with your database port (usually 3306)

            $conn = new mysqli($host, $user, $password, $database, $port);

            if ($conn->connect_error) {
                die("Error al conectar a la base de datos: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM juegos";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($juego = $result->fetch_assoc()) {
                    echo '<li id="juego-' . $juego['id'] . '">';
                    echo $juego['nombre'] . ' - Unidades: <span id="unidades-' . $juego['id'] . '">' . $juego['unidades'] . '</span> ';
                    echo '<form method="post" style="display:inline;">';
                    echo '<input type="hidden" name="action" value="restar">';
                    echo '<input type="hidden" name="id" value="' . $juego['id'] . '">';
                    echo '<button type="submit">Restar Unidad</button>';
                    echo '</form>';
                    echo '<form method="post" style="display:inline;">';
                    echo '<input type="hidden" name="action" value="incrementar">';
                    echo '<input type="hidden" name="id" value="' . $juego['id'] . '">';
                    echo '<button type="submit">Incrementar Unidad</button>';
                    echo '</form>';
                    echo '</li>';
                }
            } else {
                echo '<li>No hay juegos disponibles.</li>';
            }

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $action = $_POST['action'] ?? '';
                $id = $_POST['id'] ?? '';

                if ($action === 'restar' && is_numeric($id)) {
                    $updateSql = "UPDATE juegos SET unidades = unidades - 1 WHERE id = ? AND unidades > 0";
                    $stmt = $conn->prepare($updateSql);
                    $stmt->bind_param("i", $id);
                    $stmt->execute();
                    $stmt->close();
                    header("Location: " . $_SERVER['PHP_SELF']); // Refresh the page
                    exit();
                } elseif ($action === 'incrementar' && is_numeric($id)) {
                    $updateSql = "UPDATE juegos SET unidades = unidades + 1 WHERE id = ?";
                    $stmt = $conn->prepare($updateSql);
                    $stmt->bind_param("i", $id);
                    $stmt->execute();
                    $stmt->close();
                    header("Location: " . $_SERVER['PHP_SELF']); // Refresh the page
                    exit();
                }
            }

            $conn->close();
            ?>
        </ul>
    </main>
    <footer>
        <p>&copy; 2025 Zenoft</p>
    </footer>
</body>
</html>
