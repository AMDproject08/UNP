<?php
class Mahasiswa {
    private $conn;
    private $table_name = "mahasiswa";

    public $npm;
    public $nama;
    public $alamat;
    public $prodi_id;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        $query = "SELECT m.npm, m.nama, m.alamat, p.nama as prodi
                  FROM " . $this->table_name . " m 
                  LEFT JOIN prodi p ON m.prodi_id = p.id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function readOne() {
        $query = "SELECT m.npm, m.nama, m.alamat, m.prodi_id, p.nama as prodi
                  FROM " . $this->table_name . " m 
                  LEFT JOIN prodi p ON m.prodi_id = p.id 
                  WHERE m.npm = ? 
                  LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->npm);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $this->nama = $row['nama'];
            $this->alamat = $row['alamat'];
            $this->prodi_id = $row['prodi_id'];
        }
    }

    
    public function create() {
    $query = "INSERT INTO " . $this->table_name . " SET
              npm=:npm, nama=:nama, alamat=:alamat, prodi_id=:prodi_id";
    $stmt = $this->conn->prepare($query);

    $this->npm=htmlspecialchars(strip_tags($this->npm));
    $this->nama=htmlspecialchars(strip_tags($this->nama));
    $this->alamat=htmlspecialchars(strip_tags($this->alamat));
    $this->prodi_id=htmlspecialchars(strip_tags($this->prodi_id));

    $stmt->bindParam(":npm", $this->npm);
    $stmt->bindParam(":nama", $this->nama);
    $stmt->bindParam(":alamat", $this->alamat);
    $stmt->bindParam(":prodi_id", $this->prodi_id);

    if ($stmt->execute()) {
        return true;
    }
    return false;
}


    public function update() {
        $query = "UPDATE " . $this->table_name . " SET
                  nama = :nama,
                  alamat = :alamat,
                  prodi_id = :prodi_id
                  WHERE npm = :npm";
        $stmt = $this->conn->prepare($query);

        $this->nama=htmlspecialchars(strip_tags($this->nama));
        $this->alamat=htmlspecialchars(strip_tags($this->alamat));
        $this->prodi_id=htmlspecialchars(strip_tags($this->prodi_id));
        $this->npm=htmlspecialchars(strip_tags($this->npm));

        $stmt->bindParam(":nama", $this->nama);
        $stmt->bindParam(":alamat", $this->alamat);
        $stmt->bindParam(":prodi_id", $this->prodi_id);
        $stmt->bindParam(":npm", $this->npm);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE npm = ?";
        $stmt = $this->conn->prepare($query);

        $this->npm=htmlspecialchars(strip_tags($this->npm));
        $stmt->bindParam(1, $this->npm);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function getProdiList() {
    $query = "SELECT id, nama FROM prodi";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt;
}



}
?>
