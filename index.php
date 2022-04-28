<?php
    session_start();
    if(!isset($_SESSION['loged']))
    {
        header("Location: login.php");
    }
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/indexStyle.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
    <?php
        require_once("config/db.php");
        $usrId=$_SESSION['loged'];
        $sql="SELECT * FROM todo WHERE userID=:userId";
        $query=$db->prepare($sql);
        $query->bindValue($usrId , PDO::PARAM_INT);
        $query->execute();
        $allcount = $query->rowCount();

        echo'<table id="table">';
        for($todoNumber = $allcount; $todoNumber>0; $todoNumber--)
        {
            while($todoRow = $query->fetch()) 
            {
                echo'
                    <tr id='.$todoRow["ID"].'>
                        <td>
                            <div>
                                <input type="text" readonly value="'.$todoRow["title"].'" class="input'.$todoRow["ID"].'"></br>
                                <textarea class="input'.$todoRow["ID"].'" readonly>'.$todoRow["details"].'</textarea></br>
                                <div class="form-group">
                                    <button type="button" class="tableButton '.$todoRow["ID"].'" id="button'.$todoRow["ID"].'" name="submit" onclick=editTODO('.$todoRow["ID"].')>edytuj</button>
                                    <button type="button" class="tableButton" name="submit" onclick=RemoveTODO('.$todoRow["ID"].')>usuń</button>
                                </div>
                            </div>    
                        </td>
                    </tr>';
            }
        }
        echo'
            <tr id="place">
                <td>
                    <div>
                        <div class="form-group">
                            <button type="button" class="button" name="submit" onclick=createTODO('.$usrId.')>Nowe Zadanie</button>
                        </div>
                    </div>    
                </td>
            </tr>';
        echo'</table>';

    ?>
    


    <form action="scripts/logout.php" method="POST">                
        <div class="form-group">
            <button type="submit" class="button" name='submit'>wyloguj się</button>
        </div>
    </form>`
    <script src="crud/CRUDajax.js"></script>
</body>
</html>