<?php
require_once "config/Database.php";
require_once "classes/Mahasiswa.php";

$database = new Database();
$db = $database->getConnection();

$mahasiswa = new Mahasiswa($db);
$mahasiswa->id = $_GET['id'];

if ($mahasiswa->delete()) {
    header("Location: index.php");
}
?>