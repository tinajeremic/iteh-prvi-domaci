$('#formaPredstava').submit(function (){
    event.preventDefault();
    const $form = $(this);
    const $input = $form.find('input','textarea');

    const data=$form.serialize();

    console.log(data);

    $input.prop('disabled',true);
    if($('input[name="id"]').val()==""){
        req=$.ajax({
            url: 'requestHandler/predstava/add.php',
            type:'post',
            data: data
        });
    }else{
        req=$.ajax({
            url: 'requestHandler/predstava/update.php',
            type:'post',
            data: data
        });
    }

    $input.prop('disabled',false);

    req.done(function(res,textStatus,jqXHR){
        if(res=="Uspesno"){
            alert("Uspešno sačuvana predstava");
            location.reload();
        }else{
            alert("Neuspešno sačuvana predstava")
            console.log(res);
        }
    });

    req.fail(function(jqXHR, textStatus, errorThrown){
        console.error('Greska '+textStatus, errorThrown)
    });

});

$('input[name="predstavaCheck"]').click(function (){

    let id=$('input[name="predstavaCheck"]:checked').val();

    req=$.ajax({
        url: 'requestHandler/predstava/get.php',
        type:'post',
        data: {'id':id}
    });

    req.done(function(res,textStatus,jqXHR){

        let predstava = $.parseJSON(res)[0];

        $('input[name="id"]').val(predstava.id);
        $('input[name="naziv"]').val(predstava.naziv);
        $('input[name="reditelj"]').val(predstava.reditelj);
        $('input[name="komentar"]').val(predstava.komentar);



    });

    req.fail(function(jqXHR, textStatus, errorThrown){
        console.error('Greska '+textStatus, errorThrown)
    });

});

$('#resetPredstava').click(function (){
    $('input[name="id"]').val("");
});

$('#obrisiPredstavu').click(function(){
    let id = $('input[name="id"]').val();

    if(id==""){
        alert("Predstava nije odabrana");
        return;
    }

    req=$.ajax({
        url: 'requestHandler/predstava/delete.php',
        type:'post',
        data: {'id':id}
    });

    req.done(function(res,textStatus,jqXHR){
        if(res=="Uspesno"){
            alert("Uspešno obrisana predstava");
            location.reload();
        }else{
            alert("Neuspešno obrisana predstava")
            console.log(res);
        }
    });

    req.fail(function(jqXHR, textStatus, errorThrown){
        console.error('Greska '+textStatus, errorThrown)
    });
});