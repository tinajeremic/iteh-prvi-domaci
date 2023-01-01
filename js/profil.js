// izmena korisnika
$('#formaRegistracija').submit(function (){

    event.preventDefault();

    const $form = $(this);
    const $input = $form.find('input');

    const data=$form.serialize();

    console.log(data);

    $input.prop('disabled',true);

    req=$.ajax({
        url: 'requestHandler/user/update.php',
        type:'post',
        data: data
    });


    $input.prop('disabled',false);
    req.done(function(res,textStatus,jqXHR){
        if(res=="Izmenjeno"){
            alert("Uspešno ste izmenili korisnika");
            location.href="odjava.php";
        }else{
            alert("Greska pri izmeni korisnika")

        }
    });

    req.fail(function(jqXHR, textStatus, errorThrown){
        console.error('Greska '+textStatus, errorThrown)
    });

});

// brisanje korisnika
$('#obrisiNalogBtn').click(function (){

    let id=document.getElementsByName('id')[0].value;
    console.log(id);

    req=$.ajax({
        url: 'requestHandler/user/delete.php',
        type:'post',
        data: {'id':id}
    });

    req.done(function(res,textStatus,jqXHR){
        if(res=="Obrisano"){
            alert("Uspešno ste obrisali korisnika");
            location.href="odjava.php";
        }else{
            alert("Greska pri brisanju korisnika!")
            console.log(res)
        }
    });

    req.fail(function(jqXHR, textStatus, errorThrown){
        console.error('Greska '+textStatus, errorThrown)
    });

});