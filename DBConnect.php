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
            return true;
    }

    public function selectAllData() {
        $sql = "SELECT * FROM comandas";
        $result = $this->conn->query($sql);

        if ($result && ($result->num_rows > 0)) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
            }
        } else {
            echo "0 results";
        }
    }
}
?>