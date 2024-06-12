<?php
require_once 'config/Database.php';
require_once 'classes/Mahasiswa.php';

$database = new Database();
$db = $database->getConnection();

$mahasiswa = new Mahasiswa($db);

$page = isset($_GET['page']) ? $_GET['page'] : 'list';
switch($page) {
    case 'create':
        include 'views/create.php';
        break;
    case 'edit':
        include 'views/edit.php';
        break;
    case 'delete':
        if(isset($_GET['npm'])) {
            $mahasiswa->npm = $_GET['npm'];
            if($mahasiswa->delete()) {
                header("Location: index.php");
            }
        }
        break;
    case 'list':
    default:
        include 'views/list.php';
        break;
}
?>
