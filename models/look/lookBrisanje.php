<?php
header('Content-Type: application/json');

if(isset($_GET['id'])){
    require_once '../../config/konekcija.php';

    $id = $_GET['id'];
    $rezultat = $conn->prepare("UPDATE look SET idNaslovneSlike = NULL WHERE idL = ?");
    $rezultat->bindValue(1, $id);

    try {
        $rezultat->execute();
        http_response_code(204);
    }
    catch(PDOException $ex){
        echo json_encode(['greska'=> 'Baza vraca gresku: ' . $ex->getMessage()]);
        http_response_code(500);
    }
} else {
    http_response_code(400);
}