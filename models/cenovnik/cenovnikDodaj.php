<?php
header('Content-Type: application/json');

if(isset($_POST['naziv']) && !empty($_POST['naziv']) && isset($_POST['cena']) && !empty($_POST['cena'])){
    require_once '../../config/konekcija.php';

    $naziv = $_POST['naziv'];
    $cena = $_POST['cena'];
    $rezultat = $conn->prepare("INSERT INTO cenovnik VALUES (NULL, ?, ?)");

    try {
        
        $rezultat->execute( [$naziv, $cena] );

        http_response_code(201);

        echo json_encode(["uspeh"=> "Uspesno kreirana kategorija!"]);
    }
    catch(PDOException $ex){
        echo json_encode(['greska'=> 'Problem sa bazom: ' . $ex->getMessage()]);
        http_response_code(500);
    }
} else {
    http_response_code(400);
}