<?php 
class DBConnect {
    function __construct() {
        $this->conn = null;
    }

    public function initDBConnection() {
        $this->conn = new mysqli("localhost:3306", "root", "");

        // Check connection
        if ($this->conn->connect_error) {
            throw $this->conn->connect_error;
            return false;
        }
            $sql = "USE COMANDAS;";
            $result = $this->conn->query($sql);
            return true;
    }

    public function selectAllData() {
        $sql = "SELECT * FROM USUARIOS;";
        $result = $this->conn->query($sql);

        if ($result && ($result->num_rows > 1)) {
            $data = $result->fetch_all();
            foreach($data as $row) {
                echo "ID: " . $data[0] . "NOME: " . $data[1] . "\n";
            }die;
        } else if ($result && ($result->num_rows > 0)) {
            $data = $result->fetch_assoc();
            echo "ID: " . $data[0] . "NOME: " . $data[1] . "\n";
        } else {
            echo "0 results";
        }
    }

    public function cadastrarUsuario($user, $pass) {
        $sqlQuant = "SELECT * FROM USUARIOS;";
        $resultQuant = $this->conn->query($sqlQuant);

        $pass = "SYSCONTROL_" . $pass;
        $passEncoded = base64_encode($pass);

        $sql = "INSERT INTO USUARIOS VALUES (" . $resultQuant->num_rows++ . ", 'BLA', '" . $user . "', '" . $passEncoded . "');";
        $result = $this->conn->query($sql);
        var_dump($result);die;
        if($result) {

        }
    }

    public function loginUsuario($user, $pass) {
        $pass = "SYSCONTROL_" . $pass;
        $passEncoded = base64_encode($pass);

        $sql = "SELECT * FROM USUARIOS
        WHERE USERMANE = " . $user . "
        AND SENHA = " . $passEncoded . ";";
        $result = $this->conn->query($sql);

        if ($result && ($result->num_rows > 0)) {
            return true;
        } else {
            return false;
        }
    }
}
?>