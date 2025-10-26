<?php
class Mahasiswa {
    private $conn;
    private $table_name = "mahasiswa";

    public $id;
    public $nama;
    public $nim;
    public $jurusan;

    // Konstruktor untuk koneksi database
    public function __construct($db) {
        $this->conn = $db;
    }

    //CREATE
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " ( nama, nim, jurusan ) VALUES ( :nama, :nim, :jurusan )";

        $stmt = $this->conn->prepare($query);

        // bind values
        $stmt->bindParam(":nama", $this->nama);
        $stmt->bindParam(":nim", $this->nim);
        $stmt->bindParam(":jurusan", $this->jurusan);

        return $stmt->execute() ;
    }

    //READ
    public function readAll() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY id DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    //UPDATE
    public function update() {
        $query = "UPDATE " . $this->table_name . " SET nama = :nama, nim = :nim, jurusan = :jurusan WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        // bind values
        $stmt->bindParam(":nama", $this->nama);
        $stmt->bindParam(":nim", $this->nim);
        $stmt->bindParam(":jurusan", $this->jurusan);
        $stmt->bindParam(":id", $this->id);

        return $stmt->execute();
    }
    
    //DELETE
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        // bind id
        $stmt->bindParam(":id", $this->id);

        return $stmt->execute();
    }

    public function testBind() {
    $sql = "INSERT INTO user (nama) VALUES (:nama)";

    // gunakan $this->conn, bukan $db
    $stmt = $this->conn->prepare($sql);
    $nama = "John Doe";
    $stmt->bindParam(':nama', $nama);
    $nama = "Jane Smith"; 
    $stmt->execute();

    $stmt2 = $this->conn->prepare($sql);
    $nama2 = "Alice Johnson";
    $stmt2->bindValue(':nama', $nama2);
    $nama = "John Doe";
    $stmt2->execute();
}

}