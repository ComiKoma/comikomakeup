<?php
header('Content-Type: application/json');

if(isset($_POST['id']) && isset($_POST['naziv']) && isset($_POST['opis'])&& isset($_POST['idN'])){
    require_once '../../config/konekcija.php';

    $id = $_POST['id'];
    $naziv = $_POST['naziv'];
    $opis = $_POST['opis'];
    $idN = $_POST['idN'];
    $rezultat = $conn->prepare("UPDATE look SET nazivLooka = ?, opis =?, idNaslovneSlike = ? WHERE idL = ?");

    $rezultat->bindValue(1, $naziv);
    $rezultat->bindValue(2, $opis);
    $rezultat->bindValue(3, $idN);
    $rezultat->bindValue(4, $id);

    try {
        $rezultat->execute();
        http_response_code(204);
    }
    catch(PDOException $ex){
        echo json_encode(['poruka'=> 'Problem sa bazom: ' . $ex->getMessage()]);
        http_response_code(500);
    }
} else {
    http_response_code(400);
}