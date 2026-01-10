<?php
  session_start();
  ob_start(); // Da bi se dozvolio header_location u sredini strane
  require_once "config/konekcija.php";
  
  include "views/fixed/header.php";

  if(isset($_GET['page'])){
    switch($_GET['page'])
    {
      case 'home.php':
        include "views/pages/home.php";
        break;
      case 'makeup.php':
        include "views/pages/makeup.php";
        break;
      case 'autor.php':
        include "views/pages/autor.php";
        break;
      case 'cenovnik.php':
        include "views/pages/cenovnik.php";
        break;
      case 'kontakt.php':
        include "views/pages/kontakt.php";
        break;
      case 'korisnik.php':
        include "views/pages/korisnik.php";
        break;
      case 'zakazi.php':
        include "views/pages/zakazi.php";
        break;
      case 'admin.php':
        include "views/pages/admin.php";
        break;
      case 'adminLook.php':
        include "views/pages/adminLook.php";
        break;
      case 'adminStatistika.php':
        include "views/pages/adminStatistika.php";
        break;
        case 'adminCenovnik.php':
        include "views/pages/adminCenovnik.php";
        break;
      case 'getone':
        include "views/partials/getone.php";
        break;
      case 'izmena.php':
        include "views/pages/izmena.php";
        break;
      case '500':
        include "views/pages/500.php";
        break;
      case '404':
        include "views/pages/404.php";
        break;
      case '403':
        include "views/pages/403.php";
        break;
      default:
        include "views/pages/404.php";
        break;
    }
  } else {
    include "views/pages/home.php";
  }

  include "views/fixed/footer.php";
?>