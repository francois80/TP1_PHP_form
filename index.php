<?php
include "pays.php";
$affichebloc1 = true;
$affichebloc2 = true;
$alertNom= "";
$alertPrenom = "";
$alertDate = "";
$alertAdresse = "";
$alertCP = "";

$regexName = "/^[A-Za-zéÉ][A-Za-záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœ]+((-| )[A-Za-záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœ]+)?$/";
$regexDate = "/^((?:19|20)[0-9]{2})-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])$/";
$regexZipCode = "/^((2[AB])|([0-9]{5}))$/";
$regexAdress = "/\w/";
$regexTel = "/^0[67](-[0-9]{2}){4}$/";
$regexPoleEmploi = "/^[0-9]{7}[A-Za-z]$/";

if(isset($_POST['firstname']) && empty($_POST['firstname'])){
    $alertNom = "Veuillez renseigner votre nom";
}

if( !empty($_POST['firstname'])) {
    $nom = trim( $_POST['firstname'] );
    if(! preg_match($regexName, $nom ) ) {
        $alert =  '<p>Votre nom ne peut pas contenir de caractères spéciaux !</p>';
    }
} 

if(isset($_POST['lastname']) && empty($_POST['lastname'])){
    $alertPrenom = "Veuillez renseigner votre prénom";
}

if( !empty( $_POST['lastname'] ) ) {
    $prenom = trim( $_POST['lastname'] );
    if(! preg_match($regexName, $prenom ) ) {
        $alertNom =  '<p>Votre prénom ne peut pas contenir de caractères spéciaux !</p>';
    }
} 

if(isset($_POST['dateborn']) && empty($_POST['dateborn'])){
    $alertDate = "Veuillez renseigner votre date de naissance";
}

if( !empty( $_POST['dateborn'] ) ) {
    $dateNais = trim( $_POST['dateborn'] );
    if(! preg_match($regexDate, $dateNais ) ) {
        $alertDate =  '<p>Votre date de naissance n\'est pas valide !</p>';
    }
} 

if(isset($_POST['address']) && empty($_POST['address'])){
    $alertAdresse = "Veuillez renseigner votre adresse";
}

if( !empty( $_POST['address'] ) ) {
    $address = trim( $_POST['address'] );
    if(! preg_match($regexAdress, $address ) ) {
        $alertAdresse =  '<p>Votre adresse n\'est pas valide !</p>';
    }
} 

if(isset($_POST['cp']) && empty($_POST['cp'])){
    $alertCP = "Veuillez renseigner votre code postal";
}

if( !empty( $_POST['cp'] ) ) {
    $codeP = trim( $_POST['cp'] );
    if(! preg_match($regexZipCode,$codeP)) {
        $alertCP =  '<p>Votre code postal n\'est pas valide !</p>';
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
                                    <?php 
                                    if ($alertNom != ""){
                                        echo '<span style="color:red">'. $alertNom. '</span>';
                                    }?>
                                </div>
                                <div class="form-group">
                                    <label for="lastname">Prénom : </label>
                                    <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Pierre" value="<?php if(! empty($_POST['lastname'])){echo $_POST['lastname'];} ?>">
                                    <?php  if($alertPrenom != ""){echo '<span style="color:red">'. $alertPrenom. '</span>';}?>
                                </div>
                                <div class="form-group">
                                    <label for="dateborn">Date de naissance : </label>
                                    <input type="date" class="form-control" name="dateborn" id="dateborn" value="2018-07-22" min="1900-01-01" max="2020-01-01">
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
                                    <label for="cp">Code Postal : </label>
                                    <input type="text" name="cp" id="cp" placeholder="80000" size="5 ">
                                    <label for="town">Ville : </label>
                                    <input type="text"  name="town" id="town" placeholder="Amiens" size="40 ">
                                    <?php  if($alertCP != ""){echo '<span style="color:red">'. $alertCP. '</span>';}?>
                                </div>
                            </fieldset>
                        </div><!-- fin bloc 1 -->
                        <?php
                        if ($affichebloc2) {
                            ?>
                            <div name="bloc2">        
                                <div class="form-group">
                                    <label for="address">Email : </label>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="pierre.kiroul@lamanu.fr">
                                </div>
                                <div class="form-group">
                                    <label for="phone">Téléphone : </label>
                                    <input type="tel" class="form-control" name="phone" id="phone" placeholder="0322950102">
                                </div>
                                <div class="form-group">
                                    <label for="diploma">Diplôme : </label>
                                    <select name="diploma">
                                        <option value="">-- Choisissez --</option>
                                        <option value="sans">Sans</option>
                                        <option value="bac">Bac</option>
                                        <option value="bac+2">Bac +2</option>
                                        <option value="bac+3 ou supérieur">Bac +3 ou supérieur</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="idpoleemploi">Identifiant pôle-emploi : </label>
                                    <input type="text" class="form-control" name="idpoleemploi" id="idpoleemploi" placeholder="0224710M">
                                </div>
                                <div class="form-group">
                                    <label for="badgenumber">Nombre de badge : </label>
                                    <input type="number" class="form-control" name="badgenumber" id="badgenumber" min="0" max="10">
                                </div>
                                <div class="form-group">
                                    <a class="text-white-50 font-weight-bold" href="https://www.codecademy.com/">https://www.codecademy.com/</a>
                                </div>
                                <div class="form-group">
                                    <label for="whoyouwanttobe">Si vous étiez un super héros/une super héroïne, qui seriez-vous et pourquoi ? </label>
                                    <textarea class="form-control" name="whoyouwanttobe" id="whoyouwanttobe" cols="45" row="8" placeholder="Saisissez votre choix ici"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="tellus">Racontez-nous un de vos "hacks" (pas forcément technique ou informatique) </label>
                                    <textarea class="form-control" name="tellus" id="tellus" cols="45" row="8" placeholder="Racontez nous ici"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="radioexperience">Avez vous déjà eu une expérience avec la programmation et/ou l'informatique avant de remplir ce formulaire ? </label><br>
                                    <input type="radio" name="radioexperience" id="radioexperience" value="oui" /> oui <br>
                                    <input type="radio" name="radioexperience" id="radioexperience" value="non" /> non <br>
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