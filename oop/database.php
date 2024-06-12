<?php
class Database {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "nama_database"; // Ganti dengan nama database Anda

    protected $connection;

    public function __construct() {
        if (!isset($this->connection)) {
            $this->connection = new mysqli($this->host, $this->username, $this->password, $this->database);

            if (!$this->connection) {
                echo "Koneksi gagal: " . mysqli_connect_error();
                exit;
            }
        }

        return $this->connection;
    }
}

class Mahasiswa extends Database {
    public function __construct() {
        parent::__construct();
    }

    public function tambahMahasiswa($npm, $nama, $alamat, $prodi_id) {
        $query = "INSERT INTO mahasiswa (npm, nama, alamat, prodi_id) VALUES ('$npm', '$nama', '$alamat', '$prodi_id')";
        $result = $this->connection->query($query);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function getMahasiswa() {
        $query = "SELECT * FROM mahasiswa";
        $result = $this->connection->query($query);

        if ($result->num_rows > 0) {
            return $result;
        } else {
            return false;
        }
    }

    public function editMahasiswa($npm, $nama, $alamat, $prodi_id) {
        $query = "UPDATE mahasiswa SET nama='$nama', alamat='$alamat', prodi_id='$prodi_id' WHERE npm='$npm'";
        $result = $this->connection->query($query);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function hapusMahasiswa($npm) {
        $query = "DELETE FROM mahasiswa WHERE npm='$npm'";
        $result = $this->connection->query($query);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}
?>
