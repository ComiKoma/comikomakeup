<?php
    require_once "../../config/konekcija.php";
    session_start();
    odjavioSe($_SESSION["korisnik"]->id);
    session_unset();

    header("Location: http://comikomakeup.ml/");
    
?>