$('#formaUloga').submit(function (){
    event.preventDefault();
    const $form = $(this);
    const $input = $form.find('input','textarea','select');

    const data=$form.serialize();

    console.log(data);

    $input.prop('disabled',true);
    if($('input[name="id"]').val()==""){
        req=$.ajax({
            url: 'requestHandler/uloge/add.php',
            type:'post',
            data: data
        });
    }else{
        req=$.ajax({
            url: 'requestHandler/uloge/update.php',
            type:'post',
            data: data
        });
    }

    $input.prop('disabled',false);

    req.done(function(res,textStatus,jqXHR){
        if(res=="Uspesno"){
            alert("Uspešno sačuvana uloga");
            location.reload();
        }else{
            alert("Greska pri čuvanju uloge")
            console.log(res);
        }
    });

    req.fail(function(jqXHR, textStatus, errorThrown){
        console.error('Greska '+textStatus, errorThrown)
    });

});

function popuniFormu(idT){
    let id=idT;

    req=$.ajax({
        url: 'requestHandler/uloge/get.php',
        type:'post',
        data: {'id':id}
    });

    req.done(function(res,textStatus,jqXHR){

        let uloga = $.parseJSON(res)[0];

        $('input[name="id"]').val(uloga.id);
        $('input[name="user_id"]').val(uloga.user_id);
        $('input[name="glumac"]').val(uloga.glumac);
        $('select[name="predstava_id"]').val(uloga.predstava_id);
        $('select[name="naziv"]').val(uloga.naziv);
        
    });

    req.fail(function(jqXHR, textStatus, errorThrown){
        console.error('Greska '+textStatus, errorThrown)
    });
}

$('input[name="ulogaCheck"]').click(function (){
    popuniFormu($('input[name="ulogaCheck"]:checked').val());
});

$('#resetUloga').click(function (){
    $('input[name="id"]').val("");
});



$('#obrisiUlogu').click(function(){
    let id = $('input[name="id"]').val();

    if(id==""){
        alert("Niste izabrali Ulogu");
        return;
    }

    req=$.ajax({
        url: 'requestHandler/uloge/delete.php',
        type:'post',
        data: {'id':id}
    });

    req.done(function(res,textStatus,jqXHR){
        if(res=="Uspesno"){
            alert("Uspešno obrisana uloga");
            location.reload();
        }else{
            alert("Neuspešno obrisana uloga")
            console.log(res);
        }
    });

    req.fail(function(jqXHR, textStatus, errorThrown){
        console.error('Greska '+textStatus, errorThrown)
    });
});