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
?>
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

<div class="pocetnaStranaSadrzaj">

    <div class="d-flex p-1 justify-content-center align-items-center">
        <div>
            <h3>Dodeljene uloge</h3>
        </div>
        <div class="w-50 p-3">
            <input class="form-control" type="text" placeholder="pretraga" id="pretraga">
        </div>
        <div>
            <input class="form-control" type="button" id="sortBtn" value="sortiraj">
        </div>
    </div>

    <div class="row row-cols-1 row-cols-sm-2 g-3 justify-content-center">
        <?php
        $uloge=Uloga::getAll($konekcija);
        while (($uloga=$uloge->fetch_assoc())!=null){?>

                <form method="post" action="uloga.php" class="col">
                    <div class="card" style="background: radial-gradient(circle, rgba(122,20,65,1) 0%, rgba(19,44,74,1) 100%); width: 35vw; margin-left: auto; margin-right: auto;border-radius:25px">
                        <div class="card-body">
                            <input type="hidden" name="id_uloge" value="<?=$uloga['id']?>" >
                            <h5 class="card-title"><?=$uloga['naziv']?></h5>
                            <?php $predstava=Predstava::getPredstava($uloga['predstava_id'],$konekcija)[0]?>
                            <p class="card-text">Predstava: <?=$predstava['naziv']." ".$predstava['reditelj']?></p>                                     
                            <p class="card-text">Glumac: <?=$uloga['glumac']?></p>                                                 
                            <?php $userU=User::getUser($uloga['user_id'],$konekcija)[0]?>
                            <p class="card-text">User dodao: <?=$userU['username']?></p>
                            <button type="submit" class="btn btn-primary" style="background-color: rgb(11, 218, 81); border: none">Pogledaj</button>
                        </div>
                    </div>
                </form>


        <?php }
        ?>
    </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="js/searchsort.js"></script>

</body>
</html>