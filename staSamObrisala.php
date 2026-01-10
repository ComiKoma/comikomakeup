env:
DBNAME=shane_comikomakeup
SERVER=localhost
USERNAME=shane_comikomakeup
PASSWORD=comikomakeup

config:
<?php
//echo $_SERVER["DOCUMENT_ROOT"];

// Osnovna podesavanja
define("ABSOLUTE_PATH", $_SERVER["DOCUMENT_ROOT"]);

//echo ABSOLUTE_PATH;

// Ostala podesavanja
define("ENV_FAJL", ABSOLUTE_PATH."/config/.env");
define("LOG_FAJL", ABSOLUTE_PATH."/data/log.txt");

// Podesavanja za bazu
define("SERVER", env("SERVER"));
define("DATABASE", env("DBNAME"));
define("USERNAME", env("USERNAME"));
define("PASSWORD", env("PASSWORD"));

function env($naziv){
    $podaci = file(ENV_FAJL);
    $vrednost = "";
    foreach($podaci as $key=>$value){
        $konfig = explode("=", $value);
        if($konfig[0]==$naziv){
            $vrednost = trim($konfig[1]); // trim() zbog \n
        }
    }
    return $vrednost;
}


konekcija:
<?php

require_once "config.php";

// zabeleziPristupStranici();

try {
    $conn = new PDO("mysql:host=".SERVER.";dbname=".DATABASE.";charset=utf8", USERNAME, PASSWORD);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $ex){
    echo $ex->getMessage();
}

function executeQuery($query){
    global $conn;
    return $conn->query($query)->fetchAll();
}

function executeQueryOneRow($query){
    global $conn;
    return $conn->query($query)->fetch();
}

// function zabeleziPristupStranici(){
//     $open = fopen(LOG_FAJL, "a");
//     if($open){
//         $date = date('d-m-Y H:i:s');
//         fwrite($open, "{$_SERVER['PHP_SELF']}\t{$date}\t{$_SERVER['REMOTE_ADDR']}\t\n");
//         fclose($open);
//     }
// }









<!--------------------------------DODAVANJE NASLOVNE SLIKE NOVOG LOOKA NA FOOTER.PHP NA VRHU STRANE---------------------------------------->

<?php

require_once "models/look/lookfunctions.php";


if(isset($_POST['fileNaslovna'])){
  
  $target_dir = "assets/img/look/novi/";
    $target_file = $target_dir . basename($_FILES["novaNaslovna"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


    $check = getimagesize($_FILES["novaNaslovna"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        echo "Pokušavate da uploadujete nešto što nije slika.";
        $uploadOk = 0;
    }
    
    if (file_exists($target_file)) {
        echo "Ova fotografija već postoji.";
        $uploadOk = 0;
    }

    if ($_FILES["novaNaslovna"]["size"] > 500000) {
        echo "Slika je suviše velika.";
        $uploadOk = 0;
    }

    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Možete uploadovati samo JPG, JPEG, PNG i GIF formate.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "Nažalost, nismo uspeli da uploadujemo sliku.";
    } else {
        if (move_uploaded_file($_FILES["novaNaslovna"]["tmp_name"], $target_file)) {
            dodavanjeNaslovne($target_file, $_SESSION['id']);
            echo "Fotografija ". basename( $_FILES["novaNaslovna"]["name"]). " je uploadovana.";
        } else {
            echo "Nažalost, došlo je do greške pri uploadu.";
        }
    }
}

?>



<!--------------------------------DUGME ZA DODAVANJE LOOKA NA ADMINLOOK.PHP IZMEDJU CONTAINER I TABLE---------------------------------------->


<div class="form-group">
    <a href="#" class="btn btn-outline-secondary" data-toggle="modal" data-target="#modalDLForm">Dodaj look</a>
</div>

<!---------------------------------------MODAL ZA DODAVANJE LOOKA NA KRAJU FOOTERA------------------------------------------------------------>

<div class="modal fade" id="modalDLForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog cascading-modal" role="document">
        <div class="modal-content">
              <div class="modal-c-tabs">
                <ul class="nav nav-tabs md-tabs tabs-2" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#panel7" role="tab"><i class="fas fa-user mr-1"></i>
                      Dodaj look</a>
                  </li>
                </ul>
                <div class="tab-content">

                <!--------------------------------------- DODAVANJE LOOKA PANEL ----------------------------------------->
                  <div class="tab-pane fade in show active" id="panel7" role="tabpanel">

                  <!--------------------------------------- DODAVANJE LOOKA FORMA ----------------------------------------->
                      <form id="formLookIzmena" action="" method="POST" onsubmit="">
                        <div class="modal-body mb-1">

                          <div class="md-form form-sm mb-4">
                            <i class="fas fa-envelope prefix"></i>
                            <input  type="text" id="nazivNovogLooka" name="nazivNovogLooka" class="nazivNovogLooka form-control form-control-sm validate">
                            <label data-error="wrong" data-success="right" for="nazivNovogLooka">Naziv looka</label>
                          </div>
            
                          <div class="md-form form-sm mb-4">
                            <i class="fas fa-lock prefix"></i>
                            <textarea id="opisNovogLooka" name="opisNovogLooka" class="opisNovogLooka form-control form-control-sm validate" form="formLookIzmena"></textarea>
                            <label data-error="wrong" data-success="right" for="opisNovogLooka">Opis looka</label>
                          </div>

                          <div class="md-form form-sm mb-4">
                            <select id="kategorijaNovogLooka" class="kategorijaNovogLooka form-control form-control-sm selectpicker show-tick">
                                <?php

                                  $kat = dohvatiKategorije();
                                  foreach($kat as $k):
                                ?>
                                <option class="dodavanjeKategorije" value="<?= $k->idK?>"><?= $k->imeKat?></option>
                                <?php
                                  endforeach;
                                ?>
                            </select>
                          </div>

                          <div class="form-group">
                              <label for="fileNaslovna">Dodaj naslovnu sliku</label>
                              <input type="file" name="file" id="fileNaslovna" class="inputfile" accept="image/*">
                          </div>

                          <div class="form-group">
                              <label for="fileSlajder">Dodaj sliku za slajder</label>
                              <input type="file" name="file" id="fileSlajder" class="inputfile" accept="image/*">
                          </div>

                          <div class="text-center form-sm mt-2">
                            <input type="hidden" id="dodajLook" name="dodajLook">
                            <a href="#" data-id="" class="btn btn-outline-secondary lookDodavanje">Dodaj look</a>
                          </div>

                        </div>
                      </form>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Zatvori</button>
                    </div>
                  </div>
                  <!--------------------------------------- DODAVANJE LOOKA KRAJ PANELA ----------------------------------------->
                </div>
            </div>
        </div>
    </div>
</div>