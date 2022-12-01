<?php

require_once('./noticias/infraestructura/controladores/obtenerController.php');
require_once('./usuario/infraestructura/controladores/RegistrarController.php');

$routesArray = explode("/", $_SERVER['REQUEST_URI']);
$routesArray = array_filter($routesArray);

// Cuando no se hace ninguna petición a la API
if (empty($routesArray)) {
    $json = array(
        'status' => 404,
        'resultado' => 'success'
    );

    echo json_encode($json, http_response_code($json["status"]));
    return;
}

if (count($routesArray) > 1 && isset($_SERVER['REQUEST_METHOD'])) {
    $routesArray[1] = explode("?", $routesArray[1]);
    if ($_SERVER["REQUEST_METHOD"] == "GET" && $routesArray[1][0] === "news") {

        $rssurl = $_GET['url'];

        $controller = new ObtenerController();
        $noticias = $controller->obtenerNoticias($rssurl, false);

        if (is_null($noticias)) {
            $json = array(
                'status' => 400,
                'message' => "error"
            );
            
            echo json_encode($json, http_response_code($json["status"]));

        } else {
            $json = array(
                'status' => 200,
                'message' => "successful",
                "data" => $noticias
            );
            
            echo json_encode($json, http_response_code($json["status"]));
        }
        return;
    }
}

if (count($routesArray) == 1 && isset($_SERVER['REQUEST_METHOD'])) {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if ($routesArray[1] == "registrar") {

            $nombre = $_POST['nombre'];
            $contrasena = $_POST['contrasena'];
            $correo = $_POST['correo'];

            $registrarController = new RegistrarController();
            $usuario = $registrarController->registrar($nombre, $contrasena, $correo);
            
            
            if (is_null($usuario)) {
                $json = array(
                    'status' => 400,
                    'message' => 'El registro no fue exitoso',
                    'data' => $usuario
                );
                echo json_encode($json, http_response_code($json["status"]));
            } else {
                $json = array(
                    'status' => 200,
                    'message' => 'El registro fue exitoso',
                    'data' => $usuario
                );
                echo json_encode($json, http_response_code($json["status"]));
            }
            return;

        }
    }
}

if (count($routesArray) == 1 && isset($_SERVER['REQUEST_METHOD'])) {
    
    if ($_SERVER["REQUEST_METHOD"] == "PUT") {
        $json = array(
            'status' => 200,
            'resultado' => 'Solicitud PUT'
        );

        echo json_encode($json, http_response_code($json["status"]));
        return;
    }
}

if (count($routesArray) == 1 && isset($_SERVER['REQUEST_METHOD'])) {
    // Peticiones GET
    if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
        $json = array(
            'status' => 200,
            'resultado' => 'Solicitud DELETE'
        );

        echo json_encode($json, http_response_code($json["status"]));
        return;
    }
}

?>