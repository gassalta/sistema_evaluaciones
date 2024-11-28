<?php

error_reporting(-1);
ini_set('display_errors', -1);
error_reporting(E_ALL | E_ERROR | E_WARNING | E_PARSE | E_NOTICE);

class Login
{
    private $db, $twig;
    public function __construct(Database $db, \Twig\Environment $twig)
    {
        $this->db = $db;
        $this->twig = $twig;
    }

    public function login_form($message = "")
    {
        // Renderiza la plantilla Twig y pasa las variables
        return $this->twig->render('login.html.twig', [
            'AppTitle' => traducir_cadena("AppTitle"),
            'AdminModule' => traducir_cadena("AdminModule"),
            'Institute' => traducir_cadena("Institute"),
            'WelcomeAdmin' => traducir_cadena("WelcomeAdmin"),
            'message' => traducir_cadena($message),
            'user' => traducir_cadena("user"),
            'password' => traducir_cadena("password"),
        ]);
    }


    public function login()
    {
        if (isset($_POST["user"]) && isset($_POST["password"])) {

            $usuario = $_POST['user'];
            $clave = md5($_POST["password"]);
            $sqllogin = "SELECT idusuario, nombre FROM tusuarios 
						 WHERE nombre = '{$usuario}' 
                         AND passwd = '{$clave}'
                         LIMIT 1; ";
            $consulta = $this->db->getPDO()->prepare($sqllogin);
            $consulta->execute();

            if ($fila = $consulta->fetch()) {
                $session_id = rand();
                session_start();
                $_SESSION['logged'] = $session_id;
                $_SESSION['idusuario'] = $fila->idusuario;
                $_SESSION['admin'] = 'registered';
                header("Location: index.php");
            } else {
                return $this->login_form(traducir_cadena(LOGIN_ERROR));
            }
        } else {
            return $this->login_form(traducir_cadena(LOGIN_ERROR));
        }
    }

    public function logout()
    {
        session_start();
        $_SESSION['logged'] = 0;
        $_SESSION['idusuario'] = '';
        $_SESSION['admin'] = '';
        session_destroy();
        header("Location: login.php");
    }
}
