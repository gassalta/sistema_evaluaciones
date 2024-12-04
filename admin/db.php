<?php

error_reporting(-1);
ini_set('display_errors', -1);
error_reporting(E_ALL | E_ERROR | E_WARNING | E_PARSE | E_NOTICE);

class Database
{
    private static $instance = null;
    private $pdo;

    private function __construct()
    {
        global $servidor, $usuario, $password, $basedatos;  
        
        $error_messages = [
            '1049' => 'La base de datos especificada no existe.',
            '1045' => 'Usuario o contraseña incorrectos.',
            // ... otros códigos de error
        ];

        try {
            $dsn = "mysql:host=$servidor;dbname=$basedatos";
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Devuelve resultados como arrays asociativos
            ];
            $this->pdo = new PDO($dsn, $usuario, $password, $options);
        } catch (PDOException $e) {
            $error_code = $e->getCode();
            echo isset($error_messages[$error_code]) ? $error_messages[$error_code] : 'Ha ocurrido un error inesperado.';

            die();
           // die("Error de conexion: " . $e->getMessage());
        }
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getPDO()
    {
        return $this->pdo;
    }
}
