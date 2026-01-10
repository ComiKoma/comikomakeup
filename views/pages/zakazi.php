<?php

if(isset($_POST['reg'])){
    
if(isset($_POST['name']) && !empty($_POST['name']) && isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['message']) && !empty($_POST['message']) && isset($_POST['subject']) && !empty($_POST['subject'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    $subject = $_POST['subject'];
    
        $primalac= "milicap1598@gmail.com";
         $naslov=$subject;
         $poruka= "Šalje $name, poruka: $message";
         $posiljalac= "From: comikomakeup.ml/";
         mail($primalac,  $poruka, $naslov, $posiljalac);

    if ($name === ''){
        echo "Morate uneti svoje ime.";
        //die();
        }
    if ($email === ''){
        echo "Morate uneti svoj email.";
        //die();
    } else {
        if (!preg_match("/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/", $email)){
        echo "Neispravan format email-a.";
        //die();
    }
    }
    if ($subject === ''){
        echo "Naslov je obavezno polje.";
        //die();
    }
    if ($message === ''){
        echo "Poruka je obavezno polje.";
        //die();
    }
    echo "Podaci su ispravno uneti. ";
    
    try{
         $primalac= "milica.pavlovic.73.17@ict.edu.rs";
         $poruka="Email posiljaoca $name je $email, poruka: $message";
         $naslov= "Šalje $name, tema: $subject";
         $posiljalac= "From: comikomakeup.ml/";
         mail($primalac, $naslov,  $poruka,  $posiljalac);
    }catch(Exception $ex){
         echo $ex->getMessage();
         upisGresakaUTxtFajl($ex->getMessage());
    }
    echo "Vaša poruka je poslata!";
    
}else{
    echo "Ne udje u if!";
}
}
?>

<div class="container">
    <section class="mb-4">
    <h2 class="h1-responsive text-center my-4">Zakažite termin šminkanja</h2>
    <p class="text-center w-responsive mx-auto mb-5"></p>
    <div class="container">
    <div class="row text-center justify-content-center">
        <div class="col-md-10 mb-md-0 mb-5">
            <form id="kontaktForma" name="contact-form" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST" onsubmit="return proveraKontaktForme();">

                <div class="row">
                    <div class="col-md-6">
                        <div class="md-form mb-0">
                            <input type="text" id="name" name="name" class="form-control" placeholder="Milica">
                            <label for="name" class="">Vaše ime</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="md-form mb-0">
                            <input type="text" id="email" name="email" class="form-control" placeholder="milica@gmail.com">
                            <label for="email" class="">Vaš mejl</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="md-form mb-0">
                            <input type="text" id="subject" name="subject" class="form-control" placeholder="Naslov">
                            <label for="subject" class="">Naslov poruke</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">

                        <div class="md-form">
                            <textarea type="text" id="message" name="message" rows="2" class="form-control md-textarea" placeholder="Poruka"></textarea>
                            <label for="message">Vaša poruka</label>
                        </div>

                    </div>
                </div>
                <div class="text-center text-md-left">
                    <input type="submit" name="reg" value="Pošalji" class="btn btn-outline-secondary"/>
                    
                </div>
            </form>
            <div class="status"></div>
        </div>

        <div class="col-md-3 text-center">
            <ul class="list-unstyled mb-0">
                <li><a href="https://www.instagram.com/comikomakeup/"><i class="fab fa-instagram mt-4 fa-4x"></i></a>
                </li>

                <li><a href="https://www.facebook.com"><i class="fab fa-facebook mt-4 fa-4x"></i></a>
                </li>

                <li><a href="https://www.tumblr.com"><i class="fab fa-tumblr mt-4 fa-4x"></i></a>
                </li>
            </ul>
        </div>
    </div>

    </section>
</div>