<?php
header('Content-Type: application/json');

if(isset($_POST['id']) && isset($_POST['naziv']) && isset($_POST['cena'])){
    require_once '../../config/konekcija.php';

    $id = $_POST['id'];
    $naziv = $_POST['naziv'];
    $cena = $_POST['cena'];

    $rezultat = $conn->prepare("UPDATE cenovnik SET nazivUsluge = ?, cena =? WHERE id = ?");
 

    try {
        $rezultat->execute([$naziv, $cena, $id]);
        http_response_code(204);
    }
    catch(PDOException $ex){
        echo json_encode(['poruka'=> 'Problem sa bazom: ' . $ex->getMessage()]);
        http_response_code(500);
    }
} else {
    http_response_code(400);
}