<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta name="author" content="NoS1gnal"/>
            <link rel="stylesheet" type="text/css" media="screen" href="../style.css" />
            <link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" rel="stylesheet" />
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
            <title>Connexion</title>
        </head>
        <body>
        
        <div class="login-form"><!-- les erreurs de connexions -->
             <?php 
                if(isset($_GET['login_err']))
                {
                    $err = htmlspecialchars($_GET['login_err']);

                    switch($err)
                    {
                        case 'password':
                        ?>
                            <div c>
                                <strong>Erreur</strong> mot de passe incorrect
                            </div>
                        <?php
                        break;

                        case 'email':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> email incorrect
                            </div>
                        <?php
                        break;

                        case 'already':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> compte non existant
                            </div>
                        <?php
                        break;
                    }
                }
                ?> 
             
            
            <form action="connexion.php" method="post">
                <h2 class="text-center"> Connexion </h2>       
                <div class="form-group">
                    <input type="email" name="email" autocomplete="on" placeholder="Email" required autocomplete="email"  > <!-- champs du formulaire en required-->
                </div>
                <div >
                    <input type="password" name="password" placeholder="Mot de passe" required autocomplete="password"> <!-- champs du formulaire en required-->
                </div>
                <div >
                    <button type="submit" >Connexion</button>
                </div>  
                <div class="container">
                <button type="button" class="cancelbtn">Annuler</button>
                <span class="psw"><a href="forgot_password.php">Mot de passe oublié ?</a></span>
      </div> 
            </form>
            
        </div>
        <p class="text-center"><a href="inscription.php">Inscription</a></p>
        </body>
</html>
