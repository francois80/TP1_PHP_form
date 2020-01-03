<?php
//tableau contenant le nom des pays
include "pays.php";
$affichebloc1 = true;
$affichebloc2 = true;
//variables msg d'alerte champs mal saisis
$firstname = $lastname = $birthdate = $country = $nationality = $address = $zipcode = $city = $mail = $phone = $graduation =
$poleemploi = $badge = $codecademylink = $hero = $hack = $experience = '';

//regex pour les contrôle du formulaire
$regexName = "/^[A-Za-zéÉ][A-Za-záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœ]+((-| )[A-Za-záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœ]+)?$/";
$regexDate = "/^((?:19|20)[0-9]{2})-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])$/";
$regexZipCode = "/^((2[AB])|([0-9]{5}))$/";
$regexAddress = "/\w/";
$regexTel = "/^0[67](-[0-9]{2}){4}$/";
$regexPoleEmploi = "/^[0-9]{7}[A-Za-z]$/";
//tableau d'erreurs
$errors = [];

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $firstname = trim(htmlspecialchars($_POST['firstname']));
    if(empty($firstname)) {
        $errors['firstname'] = 'Veuillez renseigner le prénom';
   }
   elseif(! preg_match($regexName, $firstname ) ) {
        $errors['firstname'] =  'Votre prénom contient des caractères non autorisés !';
    }
    
    $lastname = trim(htmlspecialchars($_POST['lastname']));
    if(empty($lastname)) {
        $errors['lastname'] = 'Veuillez renseigner le nom';
   }
   elseif(! preg_match($regexName, $lastname ) ) {
        $errors['lastname'] =  'Votre nom contient des caractères non autorisés !';
    }
    
     $birthdate = trim(htmlspecialchars($_POST['birthdate']));
    if(empty($birthdate)) {
        $errors['birthdate'] = 'Veuillez renseigner votre date de naissance';
   }
   elseif(! preg_match($regexDate, $birthdate ) ) {
        $errors['birthdate'] =  'Le format valide est aaaa-mm-jj !';
    }
    
     $address = trim(htmlspecialchars($_POST['address']));
    if(empty($address)) {
        $errors['address'] = 'Veuillez renseigner votre adresse';
   }
   elseif(! preg_match($regexAddress, $address ) ) {
        $errors['address'] =  'Le format de l\'adresse n\'est pas valide!';
   }
     $zipcode = trim(htmlspecialchars($_POST['zipcode']));
    if(empty($zipcode)) {
        $errors['zipcode'] = 'Veuillez renseigner votre code postal';
   }
   elseif(! preg_match($regexZipCode, $zipcode ) ) {
        $errors['zipcode'] =  'Le format du code postal n\'est pas valide!';
   }
    
    $phone = trim(htmlspecialchars($_POST['phone']));
    if(empty($phone)) {
        $errors['phone'] = 'Veuillez renseigner votre téléphone';
   }
   elseif(! preg_match($regexTel, $phone ) ) {
        $errors['phone'] =  'Le format du téléphone n\'est pas valide!';
   }
   
   $poleemploi = trim(htmlspecialchars($_POST['poleemploi']));
    if(empty($poleemploi)) {
        $errors['poleemploi'] = 'Veuillez renseigner votre identifiant pole-emploi';
   }
   elseif(! preg_match($regexPoleEmploi, $poleemploi ) ) {
        $errors['poleemploi'] =  'L\' identifiant pole-emploi n\'est pas valide!';
   }
   
   $mail = trim(htmlspecialchars($_POST['mail']));
    if(empty($mail)) {
        $errors['mail'] = 'Veuillez renseigner votre email';
   }
   elseif(!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        $errors['mail'] =  'L\' email  n\'est pas valide!';
   }
} 
    
?>
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>TP1 PHP - Formulaire</title>

        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 bg-success">
                    <form method="post" action="#">
                        <div name="bloc1">
                            <fieldset>
                                <legend>Vos coordonnées</legend>
                                <div class="form-group">
                                    <label for="firstname">Nom : </label>
                                    <input type="text" class="form-control" name="firstname" id="firstname" placeholder="KIROUL" value="<?php if(! empty($_POST['firstname'])){echo $_POST['firstname'];} ?>">
                                    <span class="<?= ! empty($alertNom) ? 'text-danger' : '' ?>"><?= ! empty($alertNom) ?  $alertNom : 'Veuillez renseigner comme dans l\'exemple ci-dessus' ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="lastname">Prénom : </label>
                                    <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Pierre" value="<?php if(! empty($_POST['lastname'])){echo $_POST['lastname'];} ?>">
                                    <?php  if($alertPrenom != ""){echo '<span style="color:red">'. $alertPrenom. '</span>';}?>
                                </div>
                                <div class="form-group">
                                    <label for="birthdate">Date de naissance : </label>
                                    <input type="date" class="form-control" name="birthdate" id="birthdate" min="1900-01-01" max="2020-01-01">
                                    <?php  if($alertDate != ""){echo '<span style="color:red">'. $alertDate. '</span>';}?>
                                </div>
                                 <div class="form-group">
                                    <label for="country">Pays de naissance : </label>
                                    <select name="country">
                                        <option value="">Sélectionnez</option>
                                    <?php
                                        foreach ($countries  as $countryId => $pays) {
                                     ?>
                                            <option value="<?php echo $countryId; ?>"><?php echo $pays; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                 <div class="form-group">
                                    <label for="nationality">Nationalité : </label>
                                    <input type="text" class="form-control" name="nationality" id="nationality" placeholder="française">
                                </div>
                                <div class="form-group">
                                    <label for="address">Adresse : </label>
                                    <input type="text" class="form-control" name="address" id="address" placeholder="2 rue du moulin">
                                    <?php  if($alertAdresse != ""){echo '<span style="color:red">'. $alertAdresse. '</span>';}?>
                                </div>
                                <div class="form-group">
                                    <label for="zipcode">Code Postal : </label>
                                    <input type="text" name="zipcode" id="zipcode" placeholder="80000" size="5 ">
                                    <label for="city">Ville : </label>
                                    <input type="text"  name="city" id="city" placeholder="Amiens" size="40 ">
                                    <?php  if($alertCP != ""){echo '<span style="color:red">'. $alertCP. '</span>';}?>
                                </div>
                            </fieldset>
                        </div><!-- fin bloc 1 -->
                        <?php
                        if ($affichebloc2) {
                            ?>
                            <div name="bloc2">        
                                <div class="form-group">
                                    <label for="mail">Email : </label>
                                    <input type="email" class="form-control" name="mail" id="mail" placeholder="pierre.kiroul@lamanu.fr">
                                </div>
                                <div class="form-group">
                                    <label for="phone">Téléphone : </label>
                                    <input type="tel" class="form-control" name="phone" id="phone" placeholder="0322950102">
                                </div>
                                <div class="form-group">
                                    <label for="graduation">Diplôme : </label>
                                    <select name="graduation">
                                        <option value="">-- Choisissez --</option>
                                        <option value="sans">Sans</option>
                                        <option value="bac">Bac</option>
                                        <option value="bac+2">Bac +2</option>
                                        <option value="bac+3 ou supérieur">Bac +3 ou supérieur</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="poleemploi">Identifiant pôle-emploi : </label>
                                    <input type="text" class="form-control" name="poleemploi" id="poleemploi" placeholder="0224710M">
                                </div>
                                <div class="form-group">
                                    <label for="badge">Nombre de badge : </label>
                                    <input type="number" class="form-control" name="badge" id="badge" min="0" max="10">
                                </div>
                                <div class="form-group">
                                    <a class="text-white-50 font-weight-bold" href="https://www.codecademy.com/">https://www.codecademy.com/</a>
                                </div>
                                <div class="form-group">
                                    <label for="hero">Si vous étiez un super héros/une super héroïne, qui seriez-vous et pourquoi ? </label>
                                    <textarea class="form-control" name="hero" id="hero" cols="45" row="8" placeholder="Saisissez votre choix ici"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="hack">Racontez-nous un de vos "hacks" (pas forcément technique ou informatique) </label>
                                    <textarea class="form-control" name="hack" id="hack" cols="45" row="8" placeholder="Racontez nous ici"></textarea>
                                </div>
                                <div class="form-group">
                                    <p>Avez vous déjà eu une expérience avec la programmation et/ou l'informatique avant de remplir ce formulaire ?</p>
                                    <label for="experienceoui">oui</label>
                                    <input type="radio" name="experience" id="experienceoui" value="oui" />
                                    <label for="experiencenon">non</label>
                                    <input type="radio" name="experience" id="experiencenon" value="non" />
                                </div>
                            </div><!-- fin bloc 2 -->
                            <?php
                        }
                        ?>
                        <input type="submit"  name="submit" value="Envoyez" />
                        <input type="reset"  name="reset" value="Effacez" />
                    </form>
                </div>
            </div>
        </div>

        
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
    </body>
</html>