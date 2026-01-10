<?php

function dohvatiFooter(){
    try{
        return executeQuery("SELECT * FROM meniLink WHERE meniId=3 OR hrefLinka='index.php'");
    }catch(PDOException $ex){
        return null;
    }
}