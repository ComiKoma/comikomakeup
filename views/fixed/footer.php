<?php
require "models/meni/footerFunctions.php";


/******************* LOGOVANJE *********************/
if(isset($_POST['prijavljen'])) {
    $mail = $_POST['mail'];
    $pass = $_POST['pass'];

      //echo $mail;
      //echo $pass;
    $korisnik = dohvatiKorisnikaPoMailu($mail);
    if($korisnik) {
        if(md5($pass) == $korisnik->pass){
            $_SESSION['id'] = $korisnik->id;
            $_SESSION["korisnik"] = $korisnik;
            trenutnoAktivni($korisnik->id);
            header("Location: http://comikomakeup.ml/");
            exit();
        }else{
          echo "<script>alert('Netačna lozinka!')</script>";
          slanjeMaila($mail);
        }
    } else {
      echo "<script>alert('Netačni email i lozinka!')</script>";
    }
}

/******************* REGISTRACIJA *********************/
 if(isset($_POST['registrovanje'])){
  $regUsername = $_POST['regUsername'];
  $regMail = $_POST['regMail'];
  $regPass = $_POST['regPass'];
  $regPass1 = $_POST['regPass1'];

  $greske = array();
  $ok = true;
  if(isset($regUsername) && isset($regMail) && isset($regPass) && isset($regPass1)){
      if(!validate_username($regUsername)){
          $ok = false;
          array_push($greske, 'Username u neispravnom formatu');
      }
      if(!validate_email($regMail)){
          $ok = false;
          array_push($greske, 'Mail u neispravnom formatu');
      }
      if(!validate_pass($regPass)){
          $ok = false;
          array_push($greske, 'Lozinka u neispravnom formatu');
      }
      if($regPass1 != $regPass){
          $ok = false;
          array_push($greske,'Niste uneli identicnu lozinku');
      }

      if(dohvatiKorisnikaPoId($regUsername) || dohvatiKorisnikaPoMailu($regMail)) {
          $ok = false;
          array_push($greske,'Vec postoji korisnik sa tim mejlom/usernameom');
      }
      foreach($greske as $g){
        //echo "<script>confirm('$g')</script>";
      }

  } else {
    echo "<script>alert('Morate uneti sve podatke')</script>";
  }

  if($ok) {

      dodajKorisnika($regUsername, $regMail, $regPass);
      $korisnik = dohvatiKorisnikaPoMailu($regMail);
      echo "Ok je.";
      $_SESSION['id'] = $korisnik->id;
      $_SESSION["korisnik"] = $korisnik;

      header("Location: http://comikomakeup.ml/");
  }
}
?>
<div id="footer" class="page-footer font-small">
          <div class="container">
            <div class="row text-center d-flex justify-content-center pt-4 mb-3">

              <?php
                  $q = dohvatiFooter();
                  foreach($q as $f):
              ?>

                <div class="col-md-3 mb-3">
                  <h6 class="text-uppercase font-weight-bold">
                    <?php if($f->nazivLinka != "Dokumentacija" && $f->nazivLinka != "Sitemap"):?>
                    <a href="?page=<?=$f->hrefLinka?>" class="navbar-brand"><?=$f->nazivLinka?></a>
                    <?php else: ?>
                      <a href="<?=$f->hrefLinka?>" class="navbar-brand"><?=$f->nazivLinka?></a>
                    <?php endif; ?>
                  </h6>
                </div>

              <?php endforeach; ?>
            </div>
            <hr class="rgba-white-light" style="margin: 0 15%;">
            <div class="row d-flex text-center justify-content-center mb-md-0 mb-4">
              <div class="col-md-8 col-12 mt-5">
                <p style="line-height: 1.7rem">Mlada profesionalna šminkerka koja se uporedo bavi programiranjem rešila je da 
                  napravi sajt kako bi svojim klijentkinjama koje ne koriste društvene mreže obezbedila
                  mogućnost da prate njen rad, informišu se i zakazuju svoja šminkanja kod nje.</p>
              </div>
            </div>
            <hr class="clearfix d-md-none rgba-white-light" style="margin: 10% 15% 5%;">

          </div>
          <div class="footer-copyright text-center py-3">© 2020 Copyright:
            <a href="#" class="navbar-brand"> COMIKOMAKEUP</a> <!--Link ka mom portfoliu-->
          </div>
          <div id="footerSlika"></div>
      </div>
            
</div>


<div class="modal fade" id="modalLRForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog cascading-modal" role="document">
        <div class="modal-content">
              <div class="modal-c-tabs">
                <ul class="nav nav-tabs md-tabs tabs-2" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#panel7" role="tab"><i class="fas fa-user mr-1"></i>
                      Prijava</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#panel8" role="tab"><i class="fas fa-user-plus mr-1"></i>
                      Registracija</a>
                  </li>
                </ul>
                <div class="tab-content">

                <!--------------------------------------- LOG IN PANEL ----------------------------------------->
                  <div class="tab-pane fade in show active" id="panel7" role="tabpanel">

                  <!--------------------------------------- LOG IN FORMA ----------------------------------------->
                      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" onsubmit="return proveraLogin();">
                        <div class="modal-body mb-1">
                          <div class="md-form form-sm mb-4">
                            <i class="fas fa-envelope prefix"></i>
                            <input name="mail" type="email" id="modalLRInput10" class="form-control form-control-sm validate">
                            <label data-error="wrong" data-success="right" for="modalLRInput10">Tvoj email</label>
                          </div>
            
                          <div class="md-form form-sm mb-4">
                            <i class="fas fa-lock prefix"></i>
                            <input name="pass" type="password" id="modalLRInput11" class="form-control form-control-sm validate">
                            <label data-error="wrong" data-success="right" for="modalLRInput11">Tvoja lozinka</label>
                          </div>
                          <div class="text-center mt-2">
                            <input type="hidden" name="prijavljen">
                            <button class="btn btn-outline-secondary">Prijavi se</button>
                          </div>
                        </div>
                      </form>
                    <div class="modal-footer">
                      <div class="options text-center text-md-right mt-1">
                        
                      </div>
                      <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Zatvori</button>
                    </div>
                  </div>

                  <!--------------------------------------- REGISTRACIJA PANEL ----------------------------------------->
                  <div class="tab-pane fade" id="panel8" role="tabpanel">

                  <!--------------------------------------- REGISTRACIJA FORMA ----------------------------------------->
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" onsubmit="return proveraReg();">
                    <div class="modal-body">
                      <div class="md-form form-sm mb-4">
                        <i class="fas fa-envelope prefix"></i>
                        <label data-error="wrong" data-success="right" for="modalLRInput12">Tvoj email</label>
                        <input name="regMail" type="email" id="mailRegistracija modalLRInput12" class="form-control form-control-sm validate">
                        <small id="greskaMail" class="greska form-text"></small>
                      </div>
        
                      <div class="md-form form-sm mb-4">
                        <i class="fas fa-lock prefix"></i>
                        <label data-error="wrong" data-success="right" for="modalLRInput13">Tvoja lozinka</label>
                        <input name="regPass" type="password" id="passRegistracija modalLRInput13" class="form-control form-control-sm validate">
                        <small id="passwordHelpBlock" class="form-text text-muted">Lozinka mora imati bar 4 karaktera i broj.</small>
                        <small id="greskaPass" class="greska form-text"></small>
                      </div>
        
                      <div class="md-form form-sm mb-4">
                        <i class="fas fa-lock prefix"></i>
                        <label data-error="wrong" data-success="right" for="modalLRInput14">Ponovi lozinku</label>
                        <input name="regPass1" type="password" id="modalLRInput14" class="form-control form-control-sm validate">
                        <small id="greskaPass1" class="greska form-text"></small>
                      </div>

                      <div class="md-form form-sm mb-4">
                        <i class="fas fa-lock prefix"></i>
                        <label data-error="wrong" data-success="right" for="modalLRInput14">Tvoje korisničko ime</label>
                        <input name="regUsername" type="text" id="userRegistracija modalLRInput14" class="form-control form-control-sm validate">
                        <small id="greskaUsr" class="greska form-text"></small>
                      </div>
        
                      <div class="text-center form-sm mt-2">
                        <input type="hidden" name="registrovanje">
                        <input type="submit" class="btn btn-outline-secondary" value="Registruj se">
                      </div>
        
                    </div>
                  </form>

                    <div class="modal-footer">
                      <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Zatvori</button>
                    </div>
                  </div>
                  <!--------------------------------------- REGISTRACIJA KRAJ PANELA ----------------------------------------->
                </div>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="modalCenovnikIzmena" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog cascading-modal" role="document">
        <div class="modal-content">
              <div class="modal-c-tabs">
                <ul class="nav nav-tabs md-tabs tabs-2" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#panel7" role="tab"><i class="fas fa-user mr-1"></i>
                      Dodaj uslugu</a>
                  </li>
                </ul>
                <div class="tab-content">

                <!--------------------------------------- DODAVANJE LOOKA PANEL ----------------------------------------->
                  <div class="tab-pane fade in show active" id="panel7" role="tabpanel">

                  <!--------------------------------------- DODAVANJE LOOKA FORMA ----------------------------------------->
                      <form id="formCenovnikIzmena" action="" method="POST" onsubmit="">
                        <div class="modal-body mb-1">

                          <div class="md-form form-sm mb-4">
                            <i class="fas fa-envelope prefix"></i>
                            <input type="text" id="nazivNoveUsluge" name="nazivNoveUsluge" class="nazivNoveUsluge form-control form-control-sm validate">
                            <label data-error="wrong" data-success="right" for="nazivNoveUsluge">Naziv usluge</label>
                          </div>

                          <div class="md-form form-sm mb-4">
                            <i class="fas fa-envelope prefix"></i>
                            <input type="text" id="novaCena" name="novaCena" class="novaCena form-control form-control-sm validate">
                            <label data-error="wrong" data-success="right" for="novaCena">Cena</label>
                          </div>
                          
                          <div class="text-center form-sm mt-2">

                            <input type="hidden" id="dodajLook" name="dodajLook">
                            <a href="#" data-id="" class="btn btn-outline-secondary uslugaDodavanje">Dodaj</a>
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



    <script src="https://code.jquery.com/jquery-3.1.1.min.js">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <script type="text/javascript" src="assets/js/main.js"></script>
    

    </body>
</html>