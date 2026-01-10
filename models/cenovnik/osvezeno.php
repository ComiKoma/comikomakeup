<?php

header('Content-Type: application/json');

require_once '../../config/konekcija.php';
require_once 'cenovnik.php';


try {

    $c = dohvatiCenovnik();
    echo json_encode($c);

}
catch(PDOException $ex){
    echo json_encode(['poruka'=> 'Problem sa bazom: ' . $ex->getMessage()]);
    http_response_code(500);
}

