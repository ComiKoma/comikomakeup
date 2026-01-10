<?php

header('Content-Type: application/json');

require_once '../../config/konekcija.php';
require_once 'lookFunctions.php';


try {
    $sve = dohvatiLookSaKat();
    $nn = dohvatiLookSaKatSveSlikeKojeNisuNaslovna();

    echo json_encode([
        "sve" => $sve,
        "nisuNaslovna" => $nn
    ]);
    http_response_code(204);
}
catch(PDOException $ex){
    echo json_encode(['poruka'=> 'Problem sa bazom: ' . $ex->getMessage()]);
    http_response_code(500);
}

