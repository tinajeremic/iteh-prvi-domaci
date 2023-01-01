

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