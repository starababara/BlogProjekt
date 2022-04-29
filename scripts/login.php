<?php
    session_start();
    if(isset($_POST['submit']))
    {
        require_once('../config/db.php');
        $login = filter_input(INPUT_POST, 'username');
        $pass = filter_input(INPUT_POST, 'password');
        $sql="SELECT id, pass FROM users WHERE user=:login";
        $query=$db->prepare($sql);
        $query->bindValue(':login', $login, PDO::PARAM_STR);
        $query->execute();
        $user= $query->fetch();

        $NameExist=$query->rowCount();
        if($NameExist>0)
        {
            if(password_verify($pass, $user['pass']))
            {
                $_SESSION['loged'] = $user['id'];
                unset( $_SESSION['badPass']);
                header("Location:../login.php");
            }
            else
            {
                $_SESSION['badPass'] = true;
                header("Location:../login.php");
                exit();
            }
        }
    }
    else
    {
        header("Location: ../login.php");
    }
?>