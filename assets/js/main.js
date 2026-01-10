window.onload=function(){
    console.log("usao u main.js");

    url=window.location.href+"?page=";

    $('.nav li a[href="'+url+'"]').addClass('active');

    if(url.indexOf("getone")!= -1){
        console.log("usao u getone");
    
        $(".carousel-item:first").addClass("active");

    }
    if(url.indexOf("look")!= -1){
        console.log("usao u Look");
    }
    
    if(url.indexOf("cenovnik")!= -1 || url.indexOf("autor")!= -1){
        console.log("javi gresku za export");
        $(".kliknuto").click(obavestenje);
    }
    

    if(url.indexOf("makeup")!= -1){
        console.log("usao u makeup");

        $("body").on("click", ".post-pagination", paginacijaDohvatanjePodataka);

        document.getElementById("ddlFilter").addEventListener("change", filtrirajKategorije);
        document.getElementById("ddlSort").addEventListener("change", sortiraj);

    }


}

function obavestenje(e){
    e.preventDefault();
    $(".ispisObavestenja").html("</br>Klasa COM koja omogućava export podataka nije omogućena na serveru. Pogledajte kod za izvršavanje exporta u dokumentaciji.");
}

function prikazLookova(lookovi){
    let html = "";
    function ispisDatum(datum){
        d = new Date(datum);
        var dat = d.getDate();
        var mes = d.getMonth() + 1;
        var god = d.getFullYear();
        var dateStr = dat + "." + mes + "." + god+".";
        return dateStr;
      }
    
    for(let l of lookovi){
        html+=`
        <div class="card px-0 m-1 col-md-3 col-sm-4">
            <a href="?page=getone&id=${l.idL}">
            <img class="card-img-top" src="assets/img/look/${l.src}" alt="${l.alt}">
            <div class="card-body">
                <p class="card-text">${l.nazivLooka}</p></a>
                <p class="card-text"><small class="text-muted">`+ispisDatum(`${l.datumKacenja}`)+`</small></p>
            </div>
        </div>
        `;
    }
    $("#makeup").html(html);
}

function printPagination(brojLookova){

    let html = "";
    for(i = 1; i <= brojLookova; i++){
        html += `<li class="page-item">
        <a class="page-link post-pagination" href="#" data-page="${i}">${i}</a>
      </li>`;
    }
    $("#pagination").html(html);
}

function paginacijaDohvatanjePodataka(e){
    
    e.preventDefault();
    //console.log("usao");

    let page = $(this).data("page");
    let izabranaKat = $("#ddlFilter").val();
    let sort = $("#ddlSort").val();
    
    console.log("KatId:"+izabranaKat);
    console.log("Sort:"+sort);
    $.ajax({
        url: "models/filter,sort,paginacija/dohvatiPaginaciju.php",
        method: "POST",
        dataType: "json",
        data: {
            strana: page-1,
            id: izabranaKat,
            sort: sort
        },
        success: function(data){
            prikazLookova(data.lookovi);
            printPagination(data.brojLookova);
        },
        error: function(error){
            console.log(error);
        }
    })
    
}


function filtrirajKategorije(){

    let izabranaKat = $(this).val();

    $.ajax({
        url: "models/filter,sort,paginacija/filterPoKategoriji.php",
        method: "GET",
        dataType: "json",
        data:{
            id : izabranaKat
        },
        success: function(data){
            prikazLookova(data.lookovi);
            printPagination(data.brojLookova);
        },
        error: function(error){
            console.log(error);
        }
    });
    
}

function sortiraj(){

    let nacinSortiranja = $(this).val();

    $.ajax({
        url: "models/filter,sort,paginacija/sortiranje.php",
        method: "GET",
        dataType: "json",
        data:{
            sort : nacinSortiranja,
        },
        success: function(data){
            prikazLookova(data.lookovi);
            printPagination(data.brojLookova);
        },
        error: function(error){
            console.log(error);
        }
    });
}


function proveraKontaktForme(){
    console.log("usao u proveru");
    var name =  document.getElementById('name').value;
    var email =  document.getElementById('email').value;
    var subject =  document.getElementById('subject').value;
    var message =  document.getElementById('message').value;


    var isOk = [];

    if(name == "" && email == "" && subject == "" && message == ""){
        document.querySelector('.status').innerHTML = "Morate popuniti sva polja.";
        return false;
    }else{
        if (name == "") {
            document.querySelector('.status').innerHTML = "Ime ne sme da bude prazno.";
            return false;
        }
        if (email == "") {
            document.querySelector('.status').innerHTML = "Morate upisati mejl.";
            return false;
        } else {
            var re = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            if(!re.test(email)){
                document.querySelector('.status').innerHTML = "Pogrešan format za mejl.";
                return false;
            }
        }
        if (subject == "") {
            document.querySelector('.status').innerHTML = "Morate upisati naslov.";
            return false;
        }
        if (message == "") {
            document.querySelector('.status').innerHTML = "Poruka ne sme biti prazna.";
            return false;
        }
        
        document.querySelector('.status').innerHTML = "Šalje se...";
        console.log("proverena");

        return true;



    }
}


function proveraReg(){
console.log("usao u proveru registrovanja");

var mail =  document.getElementById('mailRegistracija').value;
var pass =  document.getElementById('passRegistracija').value;
var user =  document.getElementById('userRegistracija').value;

    if(user == "" && mail == "" && pass == ""){
        document.querySelector('.greska').innerHTML = "Morate popuniti sva polja.";
        return false;
    }else{

    if (mail == "") {
        document.querySelector('#greskaMail').innerHTML = "Morate upisati mejl.";
        return false;
    } else {
        var re = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        if(!re.test(mail)){
            document.querySelector('#greskaMail').innerHTML = "Pogrešan format za mejl.";
            return false;
        }
    }

    if (pass == "") {
        document.querySelector('#greskaPass').innerHTML = "Obavezno je uneti password";
        return false;
    } else {
        var re = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{4,}$/;
        if(!re.test(pass)){
            document.querySelector('#greskaPass').innerHTML = "Pogrešan format za password.";
            return false;
        }
    }

    if (mail == "") {
        document.querySelector('#greskaUsr').innerHTML = "Morate upisati mejl.";
        return false;
    } else {
        var re = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        if(!re.test(mail)){
            document.querySelector('#greskaUsr').innerHTML = "Pogrešan format za mejl.";
            return false;
        }
    }
        

    console.log("proverena");
    return true;
    }
}


/**************************************** CENOVNIK ***********************************/

/*********************************** Izmena cenovnik *************************************/


$(document).on('click', '.uslugaIzmena', function(e){
    e.preventDefault();

    let id = $(this).data('id');
    let naziv = document.querySelectorAll("[data-id='"+id+"']")[1].value;
    let cena = document.querySelectorAll("[data-id='"+id+"']")[2].value;

    console.log(naziv);
    console.log(cena);


    $.ajax({
        url: 'models/cenovnik/cenovnikIzmena.php',
        method: 'POST',
        data: {
            id: id,
            naziv: naziv,
            cena: cena
        },
        dataType: 'json',
        success: function(){
            osveziPrikazC();
            $("#obavestenje").html("Podaci izmenjeni.");

        }, 
        error: function(error){
            console.error('Greska pri izmeni usluge:'+error);
            $("#obavestenje").html("Neispravan format podatka.");

        }
    }) 
});


/********************************** Brisanje cenovnik ****************************************/
$(document).on('click', '.uslugaBrisanje', function(e){
    e.preventDefault();

    let id = $(this).data('id');

    $.ajax({
        url: 'models/cenovnik/cenovnikBrisanje.php',
        method: 'GET',
        data: {
            id: id
        },
        dataType: 'json',
        success: function(){
            osveziPrikazC();
        }, 
        error: function(error){
            console.error('Greska pri izmeni usluge:'+error);
            
        }
    }) 
});

/*********************************** Dodavanje cenovnik *************************************/

$(document).on('click', '.uslugaDodavanje', function(e){
    e.preventDefault();


    let naziv= $("#nazivNoveUsluge").val();
    let cena= $("#novaCena").val();

    $.ajax({
        url: 'models/cenovnik/cenovnikDodaj.php',
        method: 'POST',
        data: {
            naziv: naziv,
            cena: cena
        },
        dataType: 'json',
        success: function(data){
            console.warn('USPESNO SACUVANO');
            if(data.status == 201){
                
                console.log('cenovnikDodaj: ' + podaci.uspeh);
            }
            osveziPrikazC();
        }, 
        error: function(error){
            console.error('Greska pri dodavanju usluge:'+error);
        }
    }) 
});


function osveziPrikazC(){
    $.ajax({
        url: 'models/cenovnik/osvezeno.php',
        method: 'GET',
        dataType: 'json',
        success: function(podaci, status, data){
            if(data.status == 201){
                console.log('cenovnikOsvezeno: ' + podaci.uspeh);
            }
            prikazIzmenjenogCenovnika(podaci);
        }, 
        error: function(error){
            console.error('Greska osvezavanja izmena:'+error);
        }
    })
}

function prikazIzmenjenogCenovnika(usluge){
    console.log(usluge);
    let html = "";

    for(let u of usluge){
        html+=`
        <tr>
      <th data-id="${u.id}" scope="row">${u.id}</th>
      <td><input type="text" data-id="${u.id}" name="izmenaNameU" class="izmenaNameU form-control" value="${u.nazivUsluge}"></td>
      <td><input type="text" data-id="${u.id}" name="izmenaCenaU" class="izmenaCenaU form-control" value="${u.cena}"></td>
      <td>
        <div class="text-center form-sm mt-2">
        <input type="hidden" name="">
        <a href="#" data-id="${u.id}" class="btn btn-outline-secondary uslugaIzmena">Sačuvaj izmene</a>
        </div>
    </td>
    <td>
        <div class="text-center form-sm mt-2">
        <input type="hidden" name="">
        <a href="#" data-id="${u.id}" class="btn btn-outline-secondary uslugaBrisanje">Obriši</a>
        </div>
    </td> 
    </tr>`;

        $("#izmenaCenovnika").html(html);

}
}


/*************************************** IZMENA I BRISANJE LOOK ******************************************/

/*********************************** Izmena look *************************************/
$(document).on('click', '.lookIzmena', function(e){
    e.preventDefault();

    let id = $(this).data('id');

    let naziv= document.getElementsByClassName("izmenaNameLooka")[id-1].value;
    let opis= document.getElementsByClassName("izmenaOpisa")[id-1].value;
    let idN= document.getElementsByClassName("izmenaNaslovne")[id-1].value;

    $.ajax({
        url: 'models/look/lookIzmena.php',
        method: 'POST',
        data: {
            id: id,
            naziv: naziv,
            opis: opis,
            idN: idN
        },
        dataType: 'json',
        success: function(){
            osveziPrikazLook();
            $("#obavestenje").html("Podaci izmenjeni.");

        }, 
        error: function(greska){
            console.error('Greska pri izmeni looka:'+greska);
            $("#obavestenje").html("Neispravan format podataka.");

        }
    }) 
});


/*********************************** Dodavanje look *************************************/

$(document).on('click', '.lookDodavanje', function(e){
    
    e.preventDefault();


    let naziv= $("#nazivNovogLooka").val();
    let opis= $("#opisNovogLooka").val();
    let idKat= $(".dodavanjeKategorije").val();

    $.ajax({
        url: 'models/look/lookDodaj.php',
        method: 'POST',
        data: {
            naziv: naziv,
            opis: opis,
            idKat: idKat
        },
        dataType: 'json',
        success: function(ceoZahtev){
            console.warn('USPESNO SACUVANO');
            if(ceoZahtev.status == 201){
                
                console.log('Poruka iz JSON: ' + podaci.uspeh);
            }
            osveziPrikazLook();
        }, 
        error: function(greska){
            console.error('Greska pri dodavanju looka:'+greska);
        }
    }) 
});




/********************************** Brisanje look ****************************************/
$(document).on('click', '.lookBrisanje', function(e){
    e.preventDefault();

    let id = $(this).data('id');

    $.ajax({
        url: 'models/look/lookBrisanje.php',
        method: 'GET',
        data: {
            id: id
        },
        dataType: 'json',
        success: function(){
            osveziPrikazLook();
        }, 
        error: function(greska){
            console.error('Greska pri brisanju looka:'+greska);
        }
    }) 
});



function osveziPrikazLook(){
    $.ajax({
        url: 'models/look/izmenjeno.php',
        method: 'GET',
        dataType: 'json',
        success: function(podaci, status, ceoZahtev){
            prikazIzmenjenogLooka(podaci.sve, podaci.nisuNaslovna);
        }, 
        error: function(greska){
            console.error('Greska osvezavanja izmena:'+greska);
        }
    })
}

function prikazIzmenjenogLooka(lookovi, nisuNaslovna){
    let html = "";
    
    function ispisDatum(datum){
        d = new Date(datum);
        var dat = d.getDate();
        var mes = d.getMonth() + 1;
        var god = d.getFullYear();
        var dateStr = dat + "." + mes + "." + god+".";
        return dateStr;
    }


    for(let l of lookovi){
        html+=`
        <tr>
        <th data-id="${l.idL}" scope="row">${l.idL}</th>
        <td><input data-id="${l.idL}" type="text" name="izmenaNameLooka" class="izmenaNameLooka form-control" value="${l.nazivLooka}"></td>
        <td><textarea data-id="${l.idL}" name="izmenaOpisa" class="izmenaOpisa" form="formLook">${l.opis}</textarea></td>
        <td>${l.imeKat}</td>
        <td>`+ispisDatum(`${l.datumKacenja}`);
        html+=`</td>

        <td>        
            <div class="naslovnaSlika">
            <div class="dropdown bootstrap-select show-tick odabirNaslovne form-control form-control-sm">

                <select data-id="${l.idL}" class="odabirNaslovne form-control form-control-sm selectpicker show-tick" tabindex="-98">
                
                    <option value="0">assets/img/look/${l.src}</option>`;
                    for(let s of nisuNaslovna){
                        if(s.idLook == l.idL){
                            html+=`<option class="izmenaNaslovne" value="${s.id}">assets/img/look/${s.src}</option>`;
                        }
                    }
                   

                html+=`</select>

                <button type="button" class="btn dropdown-toggle btn-light" data-toggle="dropdown" role="combobox" aria-owns="bs-select-1" aria-haspopup="listbox" aria-expanded="false" title="assets/img/look/${l.src}">
                    <div class="filter-option">
                        <div class="filter-option-inner">
                            <div class="filter-option-inner-inner">assets/img/look/${l.src}
                            </div>
                        </div> 
                    </div>
                </button>

                <div class="dropdown-menu" x-placement="bottom-start" style="max-height: 443.809px; overflow: hidden; min-height: 0px; position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                    <div class="inner show" role="listbox" id="bs-select-1" tabindex="-1" aria-activedescendant="bs-select-1-0" style="max-height: 423.809px; overflow-y: auto; min-height: 0px;">
                        <ul class="dropdown-menu inner show" role="presentation" style="margin-top: 0px; margin-bottom: 0px;">

                            <li class="selected active">
                                <a role="option" class="dropdown-item active selected" id="bs-select-1-0" tabindex="0" aria-setsize="2" aria-posinset="1" aria-selected="true">
                                    <span class=" bs-ok-default check-mark"></span>
                                    <span class="text">assets/img/look/${l.src}</span>
                                </a>
                            </li>`;

                            for(let o of nisuNaslovna){
                                if(o.idLook == l.idL){
                                    html+=`<li>
                                    <a role="option" class="dropdown-item "id="bs-select-1-1" tabindex="0" aria-setsize="2" aria-posinset="2">
                                        <span class=" bs-ok-default check-mark"></span>
                                        <span class="text">assets/img/look/${o.src}</span>
                                    </a>
                                </li>`;
                                }
                            }
                            html+=`

                        </ul>
                    </div>
                </div>
            </div>
        </div>
        </td>

        <td>
            <div class="form-group">
                <label for="file">Dodaj slike</label>
                <input type="file" class="inputfile" accept="image/*">
            </div>
        </td>
        <td>
            <div class="text-center form-sm mt-2">
            <input type="hidden" name="registrovanje">
            <a href="#" data-id="${l.idL}" class="btn btn-outline-secondary lookIzmena">Sačuvaj izmene</a>
            </div>
        </td>
        <td>
            <div class="text-center form-sm mt-2">
            <input type="hidden" name="registrovanje">
            <a href="#" data-id="${l.idL}" class="btn btn-outline-secondary lookBrisanje">Obriši</a>
            </div>
        </td>
        
        </tr>
            `;
    }
    $("#izmenaLooka").html(html);
}









/***
 * <div class="naslovnaSlika">
        <div class="dropdown bootstrap-select show-tick odabirNaslovne form-control form-control-sm">

            <select data-id="${l.idL}" class="odabirNaslovne form-control form-control-sm selectpicker show-tick" tabindex="-98">
            
                <option value="0">assets/img/look/${l.src}</option>
                <option class="izmenaNaslovne" value="2">assets/img/look/smokey/1.jpg</option>

            </select>

            <button type="button" class="btn dropdown-toggle btn-light" data-toggle="dropdown" role="combobox" aria-owns="bs-select-1" aria-haspopup="listbox" aria-expanded="false" title="assets/img/look/${l.src}">
                <div class="filter-option">
                    <div class="filter-option-inner">
                        <div class="filter-option-inner-inner">assets/img/look/${l.src}
                        </div>
                    </div> 
                </div>
            </button>

            <div class="dropdown-menu" x-placement="bottom-start" style="max-height: 443.809px; overflow: hidden; min-height: 0px; position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                <div class="inner show" role="listbox" id="bs-select-1" tabindex="-1" aria-activedescendant="bs-select-1-0" style="max-height: 423.809px; overflow-y: auto; min-height: 0px;">
                    <ul class="dropdown-menu inner show" role="presentation" style="margin-top: 0px; margin-bottom: 0px;">

                        <li class="selected active">
                            <a role="option" class="dropdown-item active selected" id="bs-select-1-0" tabindex="0" aria-setsize="2" aria-posinset="1" aria-selected="true">
                                <span class=" bs-ok-default check-mark"></span>
                                <span class="text">assets/img/look/${l.src}</span>
                            </a>
                        </li>

                        <li>
                            <a role="option" class="dropdown-item izmenaNaslovne" id="bs-select-1-1" tabindex="0" aria-setsize="2" aria-posinset="2">
                                <span class=" bs-ok-default check-mark"></span>
                                <span class="text">assets/img/look/smokey/1.jpg</span>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
 */


/***************************ONO MOJE AL NE RADI 
             <div class="naslovnaSlika">
            <div class="dropdown bootstrap-select show-tick odabirNaslovne form-control form-control-sm">

            <select data-id="${l.idL}" class="odabirNaslovne form-control form-control-sm selectpicker show-tick" tabindex="-98">
                <option value="0">assets/img/look/${l.src}</option>`
                for(let s of nisuNaslovna){
                    if(s.idLook == l.idL){
                        html+=`<option class="izmenaNaslovne" value="s.id">assets/img/look/${s.src}</option>`;
                    }
                }

            html+=`</select>
            <button type="button" class="btn dropdown-toggle btn-light" data-toggle="dropdown" role="combobox" aria-owns="bs-select-1" aria-haspopup="listbox" aria-expanded="false" title="assets/img/look/${l.src}">
                <div class="filter-option">
                    <div class="filter-option-inner">
                        <div class="filter-option-inner-inner">assets/img/look/${l.src}
                        </div>
                    </div>
                </div>
            </button>
            <div class="dropdown-menu ">
                <div class="inner show" role="listbox" id="bs-select-1" tabindex="-1">
                    <ul class="dropdown-menu inner show" role="presentation">
                    <ul class="dropdown-menu inner show" role="presentation" style="margin-top: 0px; margin-bottom: 0px;">
                    <li class="selected active">
                    <a role="option" class="dropdown-item active selected" id="bs-select-1-0" tabindex="0" aria-setsize="2" aria-posinset="1" aria-selected="true">
                    <span class=" bs-ok-default check-mark"></span><span class="text">assets/img/look/${l.src}</span>
                    </a>
                    </li>`;
                    for(let s of nisuNaslovna){
                        if(s.idLook == l.idL){
                            html+=`<li>
                            <a role="option" class="dropdown-item izmenaNaslovne" id="bs-select-1-1" tabindex="0" aria-setsize="2" aria-posinset="2">
                            <span class=" bs-ok-default check-mark"></span>
                            <span class="text">assets/img/look/${l.src}</span>
                            </a>
                            </li>`;
                        }
                    }
                    
                    html+=`</ul>
                    </ul>
                </div>
            </div>
            </div>
 */




/***
 * <div class="naslovnaSlika">
        <div class="dropdown bootstrap-select show-tick odabirNaslovne form-control form-control-sm">

            <select data-id="1" class="odabirNaslovne form-control form-control-sm selectpicker show-tick" tabindex="-98">
            
                <option value="0">assets/img/look/smokey/naslovna.jpg</option>
                <option class="izmenaNaslovne" value="2">assets/img/look/smokey/1.jpg</option>

            </select>

            <button type="button" class="btn dropdown-toggle btn-light" data-toggle="dropdown" role="combobox" aria-owns="bs-select-1" aria-haspopup="listbox" aria-expanded="false" title="assets/img/look/smokey/naslovna.jpg">
                <div class="filter-option">
                    <div class="filter-option-inner">
                        <div class="filter-option-inner-inner">assets/img/look/smokey/naslovna.jpg
                        </div>
                    </div> 
                </div>
            </button>

            <div class="dropdown-menu" x-placement="bottom-start" style="max-height: 443.809px; overflow: hidden; min-height: 0px; position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                <div class="inner show" role="listbox" id="bs-select-1" tabindex="-1" aria-activedescendant="bs-select-1-0" style="max-height: 423.809px; overflow-y: auto; min-height: 0px;">
                    <ul class="dropdown-menu inner show" role="presentation" style="margin-top: 0px; margin-bottom: 0px;">
                        <li class="selected active">
                            <a role="option" class="dropdown-item active selected" id="bs-select-1-0" tabindex="0" aria-setsize="2" aria-posinset="1" aria-selected="true">
                                <span class=" bs-ok-default check-mark"></span>
                                <span class="text">assets/img/look/smokey/naslovna.jpg</span>
                            </a>
                        </li>
                        <li>
                            <a role="option" class="dropdown-item izmenaNaslovne" id="bs-select-1-1" tabindex="0" aria-setsize="2" aria-posinset="2">
                                <span class=" bs-ok-default check-mark"></span>
                                <span class="text">assets/img/look/smokey/1.jpg</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
 */
