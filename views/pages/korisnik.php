<?php

if(!isset($_SESSION["korisnik"])) {
    header("Location: ?page=404.php");
}

//header("Content-Type: multipart/form-data");
//header("Content-type: application/octet-stream");

require_once "models/user/user.php";
require_once "models/user/izmenaKorisnika.php";


?>

<?php
    if(isset($_SESSION['id'])){
            $user = dohvatiKorisnikaPoId($_SESSION['id']);


    if(isset($_POST['promenaProfilne']) && isset($_FILES['novaProfilna']) && !empty($_FILES['novaProfilna'])){

        
        if($_FILES['novaProfilna']['error'] === UPLOAD_ERR_OK){
            //echo "Nema greske";

            $target_dir = "assets/img/user/";
            $target_name = $_FILES["novaProfilna"]["name"];
            $target_file = $target_dir . basename($_FILES["novaProfilna"]["name"]);
            $tmp_dir = $_FILES["novaProfilna"]["tmp_name"];
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            //ini_set("memory_limit", "1024M");
            $check = getimagesize($_FILES["novaProfilna"]["tmp_name"]);

            $img_Width = intval($check[0]);
            $img_Height = intval($check[1]);
            $img_Type = $check['mime'];
            //echo($img_Type); //image/jpeg
    
            if($check !== false) {
                
                $uploadOk = 1;
            } else {
                echo "Datoteka nije slika.";
                $uploadOk = 0;
            }
            
            if (file_exists($target_file)) {
                echo "Nažalost slika sa ovim imenom već postoji.";
                $uploadOk = 0;
            }
    
            if ($_FILES["novaProfilna"]["size"] > 500000) {
                echo "Odabrana fotografija je prevelika.";
                $uploadOk = 0;
            }
    
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
                echo "Formati profilne slike mogu biti samo JPG, JPEG, PNG i GIF.";
                $uploadOk = 0;
            }
    
            if ($uploadOk == 0) {
                echo "Nažalost, Vaša slika nije izmenjena.";
    
            } else {
    
                $old = null;
    
                switch($img_Type){
                    case image_type_to_mime_type(IMAGETYPE_JPEG):
                        $old = imagecreatefromjpeg($tmp_dir);
                    break;
                    case image_type_to_mime_type(IMAGETYPE_PNG):
                        $old = imagecreatefrompng($tmp_dir);
                        break;
                    case image_type_to_mime_type(IMAGETYPE_GIF):
                        $old = imagecreatefromgif($tmp_dir);
                        break;
                }
    
                $width = 300;
                $height = ($width/$img_Width)*$img_Height;
    
                $thumb = imagecreatetruecolor($width, $height);
                imagecopyresampled($thumb, $old, 0, 0, 0, 0, $width, $height, $img_Width, $img_Height);
    
                $noviName = time().$target_name;
                $target_novi = $target_dir."novi_".$noviName;
               
    
                switch($img_Type){
                    case image_type_to_mime_type(IMAGETYPE_PNG):
                        imagepng($thumb,$target_novi);
                        break;
                    case image_type_to_mime_type(IMAGETYPE_JPEG):
                        imagejpeg($thumb,$target_novi);
                        break;
                    case image_type_to_mime_type(IMAGETYPE_GIF):
                        imagegif($thumb,$target_novi);
                        break;
                }
    
                $target_old = $target_dir.time().$target_name;
                echo $target_novi;
                echo $target_old;
                if (move_uploaded_file($_FILES["novaProfilna"]["tmp_name"], $target_old)) {
                       
                    echo "Slika ". basename( $_FILES["novaProfilna"]["name"]). " je dodata.";
    
                    try{
                        $dodato = promenaProfilne($target_old, $target_novi, $_SESSION['id']);
                        
                        if($dodato){
                            echo "Slika ". basename( $_FILES["novaProfilna"]["name"]). " je dodata u bazu.";
    
                            http_response_code(200);
                            header("Location: http://comikomakeup.ml/?page=korisnik.php");
                        }
                    }catch(PDOException $ex){
                        echo $ex->getMessage();
                    }
    
                    imagedestroy($old);
                    imagedestroy($thumb);
                } else {
                    echo "Nažalost, došlo je dogreške pri dodavanju slike.";
                }
            }
        }else{
            echo "Morate odabrati sliku.";
        };


    }


        if(isset($_POST['promenaKorIme'])){
            $novoKorIme = $_POST['novoKorIme'];
            $staroKorIme = $user->username;
            $greska = false;

            if($novoKorIme == $staroKorIme){
                $greska = true;
                echo "Nema šta da se izmeni";
            }else if(!validate_username($novoKorIme)){
                $greska = true;
                echo "Loš format";
            }

            if(!$greska){
                try{
                    promenaKorImena($novoKorIme, $_SESSION['id']);
                    echo "Korisničko ime promenjeno!";
                    header("Location: http://comikomakeup.ml/?page=korisnik.php");
                }catch(PDOException $ex){
                    upisGresakaUTxtFajl($ex->getMessage());
                }

            }
        }

        if(isset($_POST['promenaLozinke'])){
            $novaLozinka = $_POST['novaLozinka'];
            $staraLozinka = $user->pass;
            $greska = false;

            if($novaLozinka == $staraLozinka){
                $greska = true;
                echo "Nema šta da se izmeni";
            }else if(!validate_pass($novaLozinka)){
                $greska = true;
                echo "Los format";
            }

            if(!$greska){
                try{
                    promenaLozinke(md5($novaLozinka), $_SESSION['id']);
                    echo "Lozinka promenjena!";
                    header("Location: http://comikomakeup.ml/?page=korisnik.php");
                }catch(PDOException $ex){
                    upisGresakaUTxtFajl($ex->getMessage());
                }
            }
        }

}
 ?>

<h2 class="h1-responsive text-center my-4">Dobrodošao/la <?= $user->username?></h2>
<p class="text-center w-responsive mx-auto mb-3">Ovde možeš izmeniti svoje lične podatke</p>
<div class="container">
<div class="row justify-content-center">
    <div class="col-md-10 mb-md-0 mb-5">

        <form action="#" method="POST" enctype="multipart/form-data">
        <div class="mb-4">
        <img class="mx-auto d-block img-thumbnail my-3" src="<?= $user->manjaProfilna ?>" alt="profilna">
        <div class="">
        
            <label for="korisnickaSlika" class="col-sm-2 col-form-label">Profilna slika</label>
            <div class="col-md-8 col-sm-8">
            <input name="novaProfilna" type="file" class="form-control-file" id="korisnickaSlika">
            </div>
            <input name="promenaProfilne" type="hidden"/>
            <div class="col-md-2 col-sm-8"><button type="submit" class="btn btn-outline-secondary">Sačuvaj</button></div>
        </div>
        </div>
        </form>

        <form action="#" method="POST">
            
          <div class="mb-4">
              <div class="col-md-12">
            <label for="korisnickoIme" class="col-form-label">Korisničko ime</label>
            <div class="">
              <input name="novoKorIme" type="text" class="form-control" id="korisnickoIme" placeholder="<?= $user->username ?>">
            </div>
            <small id="passwordHelpBlock" class="form-text text-muted">Username mora imati bar 4 slova</small>
            <input name="promenaKorIme" type="hidden"/>
            <div class=""><button type="submit" class="btn btn-outline-secondary">Sačuvaj</button></div>
          </div>
          </div>
        </form>
        

        
        
        <form action="#" method="POST">
            
          <div class="mb-4">
            <div class="col-md-12">
            <label data-error="wrong" data-success="right" for="modalLRInput13">Tvoja nova lozinka</label>
            <div class="">
              <input type="password" name="novaLozinka" id="modalLRInput13" data-id="novaSifra" class="form-control validate" placeholder="Unesi novu lozinku"/>
            </div>
            <small id="passwordHelpBlock" class="form-text text-muted">Lozinka mora imati bar 4 slova i broj</small>
            <input name="promenaLozinke" type="hidden"/>
            <div class=""><button type="submit" class="btn btn-outline-secondary">Sačuvaj</button></div>
          </div>
          </div>
        </form>
        </div>
</div>
</div>

