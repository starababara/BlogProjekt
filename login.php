<?php
    session_start();
    if(isset($_SESSION['loged']))
    {
        header("Location: index.php");
    }
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/loginStyle.css">
<head>
<body>
    <div class="form">
        <div class="form-toggle"></div>
            <div class="form-panel one">
                <div class="form-header">
                    <h1>Logowanie</h1>
                </div>
                <div class="form-content">
                    <form action="scripts/login.php" method="POST">
                        <div class="form-group">
                            <label for="username">nazwa użytkownika</label>
                            <input id="username" type="text" name="username"/>
                        </div>
                        <div class="form-group">
                            <label for="password">hasło</label>
                            <input id="password" type="password" name="password" />
                            <?php
                                if(isset($_SESSION['badPass']))
                                {
                                    echo "nie poprawne dane logowania";
                                    unset($_SESSION['badPass']);
                                }
                            ?>
                        </div>
                        <div class="form-group">
                            <button type="submit" name='submit'>Zaloguj się</button>
                            <p>Nie masz konta? <a href="register.php">Zarejestruj się!</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>