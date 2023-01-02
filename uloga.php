<?php
session_start();

if (!isset($_SESSION['current_user'])) {
    header('Location: index.php');
    exit();
}

require "dbBroker.php";
require "model/User.php";
require "model/predstava.php";
require "model/uloga.php";

$user = User::getUserUsername($_SESSION['current_user'],$konekcija)[0];
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Napravi svoju predstavu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet">
    <link rel = "shortcut icon" type = "image/x-icon" href = "logo2.png"/>
</head>
<body>

<div class="header">
    <div class="naslov">
    <img src ="logo2.png"></img> 
        <h1>Napravi svoju predstavu</h1>
    </div>

    <div class="navigacija d-flex justify-content-between">
        <ul class="nav" id="navigacija-lista" >
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="pocetna.php">Naslovna</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="predstave.php">Predstave</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="uloga.php">Uloge</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="profil.php">Profil</a>
            </li>            
        </ul>
        <div>
            <a class="btn btn-danger" href="odjava.php">Log out</a>
        </div>
    </div>
</div>

<div class="content">
    <div class="naslov">
        <h2>Dodeli uloge</h2>
    </div>

    <div class="forma" style = "border-radius:25px">
        <form method="post" id="formaUloga">
            <input type="hidden" name="id" value="">
            <input type="hidden" name="user_id" value="<?=$user['id']?>">

            
            <div class="input-group mb-3 container">
                <span class="input-group-text">Predstava</span>
                <select class="form-control" type="text" name="predstava_id" placeholder="Predstava" value="">
                    <option value="0">Odaberite predstavu</option>
                    <?php
                    $predstave=Predstava::getAll($konekcija);
                    while(($predstava=$predstave->fetch_assoc())!=null){?>
                        <option value="<?=$predstava['id']?>"><?=$predstava['naziv']." ".$predstava['reditelj']?></option>
                    <?php } ?>
                </select>
            </div>
            

            <div class="input-group mb-3 container">
                <span class="input-group-text">Glumac/-ica</span>
                <input class="form-control" type="text" name="glumac" value="">
            </div>
            <div class="input-group mb-3 container">
                <span class="input-group-text">Naziv uloge</span>
                <input class="form-control" type="text" name="naziv" value="">
            </div>
            

            <div class="d-grid gap-2 d-md-block">
                <button type="submit"  class="btn btn-success" style="background-color: rgb(255, 122, 127, .8); border: none">Sačuvaj ulogu</button>
                <button type="reset" id="resetUloga" class="btn btn-primary" style="background-color: rgb(255, 122, 127, .8); border: none">Resetuj ulogu</button>
                <button type="button" id="obrisiUlogu" class="btn btn-danger" style="background-color: rgb(255, 122, 127, .8); border: none" >Izbriši ulogu</button>
            </div>

        </form>
    </div>


    <div class="prikazPodataka" style = "padding: 20px; border-radius:25px; background: transparent;" >
        <div class="d-flex p-1 justify-content-center align-items-center">
            <div>
                <h3>Glumci i Uloge</h3>
            </div>
            <div class="w-50 p-3">
                <input class="form-control" type="text" placeholder="pretraga uloga" id="pretraga">
            </div>
            <div>
                <input class="form-control" type="button" id="sortBtn" value="Sortiraj po glumcima" style = "margin-right: 5px">
            </div>
            <div>
                <input class="form-control" type="button" id="sortOBtn" value="Sortiraj po nazivu uloga"style = "margin-left: 5px">
            </div>
        </div>

        <div class="row row-cols-1 row-cols-sm-2 g-3">
            <?php
            $uloge=Uloga::getAll($konekcija);
            while (($uloga=$uloge->fetch_assoc())!=null){?>

                <div class="col">
                    <div class="card" style="background: radial-gradient(circle, rgba(122,20,65,1) 0%, rgba(74,19,27,1) 100%);border-radius:25px">
                        <div class="card-body">
                            <h5 class="card-title"><?=$uloga['glumac']?></h5>
                            <?php $predstava=Predstava::getPredstava($uloga['predstava_id'],$konekcija)[0]?>
                            <p class="card-text">Predstava: <?=$predstava['naziv']." u režiji: ".$predstava['reditelj']?></p>
                            <p class="card-text karticaNazivUloge">Uloga: <?=$uloga['naziv']?></p>  
                            <?php $userU=User::getUser($uloga['user_id'],$konekcija)[0]?>
                            <p class="card-text">User dodao: <?=$userU['username']?></p>
                            <input type="radio" name="ulogaCheck" value="<?=$uloga['id']?>">
                        </div>
                    </div>
                </div>

            <?php } 
            ?>
        </div>


    </div>

</div>



<br>
<br>
<br>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="js/uloga.js"></script>

<?php
if(isset($_POST['id'])){
    echo '<script type="text/javascript">
            popuniFormu('.$_POST["id"].');
        </script>'
    ;

}
?>

</body>
</html>