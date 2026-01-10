<div class="container">
    <div class="row justify-content-center my-3">
                    <?php
                        include "models/autor/autor.php";
                        $autor = dohvatiSveOAutoru();

                        foreach($autor as $a):
                    ?>
                      <div class="col-md-4">
                        <img src="<?=$a->slika?>" class="card-img" alt="<?=$a->naslov?>">
                      </div>
                      <div class="col-md-8">
                        <div class="card-body my-3">
                                <h5 class="card-title"><?=$a->naslov?></h5>
                                <p>
                                 <?=$a->opis?>
                                </p>
                                <div class="row text-center padding">
                                <div class="col-md-4 social padding"><a href="https://www.instagram.com/comikomakeup/"><i class="fa fa-instagram"></i></a></div>
                                <div class="col-md-4 social padding"><a href="https://www.facebook.com"><i class="fab fa-facebook"></i></a></div>
                                <div class="col-md-4 social padding"><a href="https://www.tumblr.com"><i class="fab fa-tumblr"></i></a></div>
                                </div>
                          <a href="models/autor/autorExportWord.php" class="btn btn-outline-secondary" style="width:100%"><i class="fa fa-download"></i> Preuzmite portfolio</a>
                            <span class="ispisObavestenja"></span>

                        </div>
                      </div>
                    <?php
                        endforeach;
                    ?>
    </div>
</div>