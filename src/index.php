<?php

require_once('./noticias/infraestructura/controladores/obtenerController.php');
require_once('./usuario/infraestructura/controladores/RegistrarController.php');
require_once('./usuario/infraestructura/controladores/LoginController.php');
require_once('./filtro/infraestructura/controladores/FiltrarController.php');

$routesArray = explode("/", $_SERVER['REQUEST_URI']);
$routesArray = array_filter($routesArray);

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
        $noticias;
        $headers = getallheaders();
        $flag = false;
        if(isset($headers["id_usuario"])){
            $id_usuario = $headers["id_usuario"];
            $flag = true;
            $noticias = $controller->obtenerNoticias($rssurl, $flag, $id_usuario);
        }else{
            $noticias = $controller->obtenerNoticias($rssurl, $flag, null);
            
        }

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
                    'message' => 'Registro fallido',
                    'data' => $usuario
                );
                echo json_encode($json, http_response_code($json["status"]));
            } else {
                unset($usuario->contrasena);
                unset($usuario->token);
                unset($usuario->token_exp);
                unset($usuario->id);
                $json = array(
                    'status' => 200,
                    'message' => 'Registro exitoso',
                    'data' => $usuario
                );
                echo json_encode($json, http_response_code($json["status"]));
            }
            return;

        }

        if ($routesArray[1] == "login") {

            $contrasena = $_POST['contrasena'];
            $correo = $_POST['correo'];

            $loginController = new LoginController();
            $usuario = $loginController->iniciarSesion($contrasena, $correo);


            if (is_null($usuario)) {
                $json = array(
                    'status' => 400,
                    'message' => 'El usuario no se encuentra registrado',
                    'data' => $usuario
                );
                echo json_encode($json, http_response_code($json["status"]));
            } else {
                unset($usuario->contrasena);
                $json = array(
                    'status' => 200,
                    'message' => 'Inicio exitoso',
                    'data' => $usuario
                );
                echo json_encode($json, http_response_code($json["status"]));
            }
            return;

        }


        if ($routesArray[1] == "agregarurl") {
            $url = $_POST['url'];
            $headers = getallheaders();
            $token = $headers["Auth"];
            $correo = $headers["correo_usuario"];
            $agregarController = new AgregarController();
            $respuesta = $agregarController->agregar($url, $token, $correo);

            if (is_null($respuesta)) {
                $json = array(
                    'status' => 404,
                    'message' => 'No autorizado'
                );
                echo json_encode($json, http_response_code($json["status"]));
            } else {

                if ($respuesta == "Expirado") {
                    $json = array(
                        'status' => 303,
                        'message' => 'El token ha expirado'
                    );
                    echo json_encode($json, http_response_code($json["status"]));
                } else if ($respuesta == "Error al agregar URL") {
                    $json = array(
                        'status' => 403,
                        'message' => 'Error URL Invalido'
                    );
                    echo json_encode($json, http_response_code($json["status"]));
                } else {
                    $json = array(
                        'status' => 200,
                        'message' => 'Registro exitoso',
                        'data' => $respuesta
                    );
                    echo json_encode($json, http_response_code($json["status"]));
                }

            }
            return;
        }
    }
 
    if ($routesArray[1] == "eliminarurl") {
        $url = $_POST['url'];
        $headers = getallheaders();
        $token = $headers["Auth"];
        $correo = $headers["correo_usuario"];
        $eliminarController = new EliminarController();
        $respuesta = $eliminarController->eliminar($url, $token, $correo);

        if (is_null($respuesta)) {
            $json = array(
                'status' => 404,
                'message' => 'No autorizado'
            );
            echo json_encode($json, http_response_code($json["status"]));
        } else {

            if ($respuesta == "Expirado") {
                $json = array(
                    'status' => 303,
                    'message' => 'El token ha expirado'
                );
                echo json_encode($json, http_response_code($json["status"]));
            } else if ($respuesta == "Error al eliminar URL") {
                $json = array(
                    'status' => 403,
                    'message' => 'Error URL Invalido'
                );
                echo json_encode($json, http_response_code($json["status"]));
            } else {
                $json = array(
                    'status' => 200,
                    'message' => 'Registro eliminado con exito',
                    'data' => $respuesta
                );
                echo json_encode($json, http_response_code($json["status"]));
            }

        }
        return;
    }

    $routesArray[1] = explode("?", $routesArray[1]);
    if ($_SERVER["REQUEST_METHOD"] == "GET" && $routesArray[1][0] == "filtrar") {
        $categoria = $_GET['categoria'];
        $headers = getallheaders();
        $id_usuario = $headers["id_usuario"];

        $controller = new FiltrarController();
        $noticias = $controller->filtrar($categoria, $id_usuario);

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

?>