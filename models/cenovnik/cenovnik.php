<?php
function dohvatiCenovnik(){
    try{
        return executeQuery("SELECT * FROM cenovnik");

    }catch(PDOException $ex){

        return null;
    }
}