<?php

class Database{
    private $host = "localhost";
    private $dataBase = "consultorio";
    private $user = "root";
    private $password = "";
    private $charset = "utf8";

    /**
     * Se conecta a la base de datos y devuelve un objeto PDO.
     * 
     * @return La conexión a la base de datos.
     */
    function conectar(){
        try{
            $conexion = "mysql:host=" . $this->host . ";dbname=" . $this->dataBase . ";charset=" . $this->charset;
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];

            $pdo = new PDO($conexion, $this->user, $this->password, $options);

            return $pdo;
        }
        catch (PDOException $e) {
            echo 'Error conexion: ' . $e->getMessage();
            exit;
        }
    }
}

?>