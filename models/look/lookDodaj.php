<?php
header('Content-Type: application/json');

if(isset($_POST['naziv']) && !empty($_POST['naziv']) && isset($_POST['opis']) && !empty($_POST['opis']) && isset($_POST['idKat']) && !empty($_POST['idKat'])){
    require_once '../../config/konekcija.php';

    $naziv = $_POST['naziv'];
    $opis = $_POST['opis'];
    $idKat = $_POST['idKat'];
    $rezultat = $conn->prepare("INSERT INTO look VALUES (NULL, ?, ?, ?, now(), 0)");

    try {
        
        $rezultat->execute( [ $naziv, $opis, $idKat ] );

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