<?php

error_reporting(-1);
ini_set('display_errors', -1);
error_reporting(E_ALL);
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);

class moduloadmin
{
    private $db;
    function __construct()
    {
        $this->db = mysqli_connect('localhost', 'root', '', 'seldb');
    }
    public function login_form($message = "")
    {
        $tpl = new template("templates/");
        $tpl->load("login.html");
        $tpl->set_block("form");
        $tpl->set_variable("AppTitle", traducir_cadena("AppTitle"));
        $tpl->set_variable("AdminModule", traducir_cadena("AdminModule"));
        $tpl->set_variable("Institute", traducir_cadena("Institute"));
        $tpl->set_variable("WelcomeAdmin", traducir_cadena("WelcomeAdmin"));
        $tpl->set_variable("message", traducir_cadena($message));
        $tpl->set_variable("user", traducir_cadena("user"));
        $tpl->set_variable("password", traducir_cadena("password"));
        $tpl->parse_block("form");
        return $tpl->get();
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
            $consulta = mysqli_query($this->db, $sqllogin);

            if ($fila = mysqli_fetch_object($consulta)) {
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
