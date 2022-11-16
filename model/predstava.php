<?php

class Predstava
{

    private $id;
    private $naziv;
    private $reditelj;
    private $komentar;
   


    public function __construct($id=null, $naziv=null, $reditelj=null, $komentar=null)
    {
        $this->id = $id;
        $this->naziv = $naziv;
        $this->reditelj = $reditelj;
        $this->komentar = $komentar;
        
    }

    public function add(mysqli $conn){
        $upit = "INSERT INTO predstave (naziv,reditelj,komentar) 
                 VALUES ('$this->naziv','$this->reditelj','$this->komentar');";
        return $conn->query($upit);
    }

    public function update(mysqli $conn){
        $upit = "UPDATE predstave set naziv = '$this->naziv',reditelj = '$this->reditelj',
                komentar = '$this->komentar'  WHERE id='$this->id'";
        return $conn->query($upit);
    }

    public function delete(mysqli $conn){
        $upit = "DELETE FROM predstave WHERE id='$this->id'";
        return $conn->query($upit);
    }

    public static function getAll(mysqli $conn)
    {
        $upit = "SELECT * FROM predstave";
        return $conn->query($upit);
    }


    public static function getPredstava($id, mysqli $conn){
        $upit = "SELECT * FROM predstave WHERE id='$id'";

        $predstava = array();
        if($obj = $conn->query($upit)){
            while($red = $obj->fetch_array(1)){
                $predstava[]= $red;
            }
        }

        return $predstava;
    }


}