<?php   
    session_start();
    if(isset($_POST['name']))
    {
        $validation=true;
        $nickname = $_POST['name'];
        $paswd1= $_POST['password'];
        $paswd2= $_POST['password2'];

        require_once("config/db.php");
        $sql="SELECT id FROM users WHERE user=:name";
        $query = $db->prepare($sql);
        $query->bindValue(':name', $nickname, PDO::PARAM_STR);
        $query->execute();
        $query->fetch();
        
        $NameExist=$query->rowCount();
        if($NameExist>0)
        {
            $validation = false;
            $_SESSION['NameErr']='Ten nick jest już zarezerwowany';
        }

        if($paswd1!=$paswd2)
        {
            $validation = false;
            $_SESSION['badPass']='Ten nick jest już zarezerwowany';
        }

        if($validation)
        {
            $paswdHash = password_hash($paswd1, PASSWORD_DEFAULT);

            $sql= "INSERT INTO users VALUES(NULL, '$nickname', '$paswdHash')";
            $query = $db->prepare($sql);
            $query->execute(); 

            $sql="SELECT id FROM users WHERE user=:name";
            $query = $db->prepare($sql);
            $query->bindValue(':name', $nickname, PDO::PARAM_STR);
            $query->execute();
            $result=$query->fetch();
            $_SESSION['loged'] = $result['id'];

            echo $_SESSION['loged'];
            header("Location: index.php");
            exit();
        }
    }

?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/registerStyle.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
    <body>
    <div class="form">
        <div class="form-toggle"></div>
            <div class="form-panel one">
                <div class="form-header">
                    <h1>Rejestracja</h1>
                </div>
                <div class="form-content">
                    <form action="register.php" method="POST">
                        <div class="form-group">
                            <label for="username">nazwa użytkownika</label>
                            <input id="username" type="text" name="name"/>
                            <?php
                                if(isset($_SESSION['NameErr']))
                                {
                                    echo "<div class='error'>".$_SESSION['NameErr']."</div>";
                                    unset($_SESSION['NameErr']);
                                }
                            ?>
                        </div>
                        <div class="form-group">
                            <label for="password">hasło</label>
                            <input id="password" type="password" name="password" />
                            <?php
                            ?>
                        </div>
                        <div class="form-group">
                            <label for="password2">powtórz hasło</label>
                            <input id="password2" type="password" name="password2" />
                            <?php
                                if(isset($_SESSION['badPass']))
                                {
                                    echo "hasła nie są takie same";
                                    unset($_SESSION['badPass']);
                                }
                            ?>
                        </div>
                        <div class="form-group">
                            <button type="submit" name='submit'>Zarejestruj się</button>
                            <p>Masz konto? <a href="login.php">Zaloguj się!</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </body>
</html>