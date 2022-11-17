$('#formaRegistracija').submit(function (){
    event.preventDefault();
    const $form = $(this);
    const $input = $form.find('input');

    const data=$form.serialize();

    console.log(data);

    $input.prop('disabled',true);

    req=$.ajax({
            url: 'requestHandler/user/add.php',
            type:'post',
            data: data
    });


    $input.prop('disabled',false);
    req.done(function(res,textStatus,jqXHR){
        if(res=="Uspesno"){
            alert("Uspešno ste napravili nalog");
            location.href='index.php';
        }else{
            alert("Niste uspeli da napravite nalog")
            console.log(res);
        }
    });

    req.fail(function(jqXHR, textStatus, errorThrown){
        console.error('Greska '+textStatus, errorThrown)
    });

});	