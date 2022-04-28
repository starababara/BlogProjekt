<?php
    $out="";
    if(isset($_POST["id"]))
    {
        require_once('../config/db.php');
        
        $id=$_POST["id"];
        $details = $_POST['details'];
        $title = $_POST['title'];

        $sql="UPDATE todo SET title=:title, details=:details WHERE ID=:id";
        $query=$db->prepare($sql);
        $query->bindValue(':title', $title);
        $query->bindValue(':id', $id);
        $query->bindValue(':details', $details);
        if($query->execute())
        {
            $out = "zapisano";
        }
        else
        {
            $out="wystąpił błąd";
        }
    }
    echo $out;
?>