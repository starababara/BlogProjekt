<?php
    //$out="";
    if(isset($_POST["id"]))
    {
        require_once('../config/db.php');
        
        $id=$_POST["id"];

        $sql="DELETE FROM todo WHERE ID=:id";
        $query=$db->prepare($sql);
        $query->bindValue(':id', $id);

        if($query->execute())
        {
            $out = "usunięto";
        }
        else
        {
            $out="wystąpił błąd";
        }
    }
    echo $out;
?>