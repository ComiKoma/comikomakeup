<div class="content container">
    <div class="row">
    <?php
        include "models/look/lookFunctions.php";

        $look = dohvatiLookJedan($_GET['id']);
        if($look == null)
        {
            echo("Ne moze da dohvati id looka");

        }
    ?>
        <div class="col-12">
            <div class="card my-3">
                <div class="row no-gutters">
                    <div class="col-md-6">
                    <div class="card-body">
                        <h5 class="card-title"><?=@$look->nazivLooka?></h5>
                        <p class="card-text"><?=@$look->opis?></p>
                    </div>
                    </div>
                    <div class="col-md-6">
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <?php
                            $slike = dohvatiSveSlikeZaLook($_GET['id']);
                            if($slike == null)
                            {
                                echo("Slike za look su null");
                            }
                            foreach($slike as $s):
                        ?>

                            <div class="carousel-item">
                            <img src="assets/img/look/<?= $s->src?>" class="d-block w-100" alt="<?= $s->src?>">
                            </div>

                        <?php
                            endforeach;
                        ?>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>