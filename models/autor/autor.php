<?php
function dohvatiSveOAutoru(){
    try{
        return executeQuery("SELECT * FROM autor");
    }catch(PDOException $ex){
        return null;
    }
}