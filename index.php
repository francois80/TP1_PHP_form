<?php
//include contenant le tableau des diplômes, des pays, et des nationalités
include "pays.php";
//include de validation du formulaire
include 'form_validation.php';
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
                <div class="col-md-8 alert alert-secondary">
                    <?php
                    //si post du formulaire complété sans erreurs, affichage du résultat
                    if ($isSubmitted && count($errors) == 0) {
                        ?>
                    <p>Nom : <mark><?= $firstname ?></mark></p>
                        <p>Prénom : <mark><?= $lastname ?></mark></p>
                        <p>Date de naissance : <mark><?= $birthdate ?></mark> (avant conversion)</p>
                        <p>Date de naissance : <mark><?= strftime('%d-%m-%Y',strtotime($birthdate)) ?></mark> (après conversion)</p>
                        <p>Pays : <mark><?= $countries[$country] ?></mark></p>
                        <p>Nationalité : <mark><?= $nationalites[$nationality] ?></mark></p>
                        <p>Adresse : <mark><?= $address ?></mark></p>
                        <p>Code postal : <mark><?= $zipcode ?></mark></p>
                        <p>Ville : <mark><?= $city ?></mark></p>
                        <p>Email : <mark><?= $mail ?></mark></p>
                        <p>Téléphone : <mark><?= $phone ?></mark></p>
                        <p>Diplôme : <mark><?= $graduationOption[$graduation] ?></mark></p>
                        <p>Identifiant pôle-emploi : <mark><?= $poleemploi ?></mark></p>
                        <p>Nombre de badge : <mark><?= $badge ?></mark></p>
                        <p>Lien codecademy : <mark><?= $codecademylink ?></mark></p>
                        <p>Super héro : <mark><?= $hero ?></mark></p>
                        <p>Hack : <mark><?= $hack ?></mark></p>
                        <p>Expérience : <mark><?= ($experience == 1) ? 'oui' : 'non' ?></mark></p>
                        <?php
                    }
                    else{
                    //affichage du formulare ou réaffichage si erreurs dans les saisies
                    ?>
                    <form method="post" action="#" novalidate>
                        <div name="bloc1">
                            <fieldset>
                                <legend>Vos coordonnées</legend>
                                <div class="form-group">
                                    <label for="firstname">Nom : </label>
                                    <input type="text" class="form-control" name="firstname" id="firstname" placeholder="KIROUL" value="<?= $firstname ?>">
                                    <span class="text-danger"><?= ($errors['firstname']) ?? '' ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="lastname">Prénom : </label>
                                    <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Pierre" value="<?= $lastname ?>">
                                    <span class="text-danger"><?= ($errors['lastname']) ?? '' ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="birthdate">Date de naissance : </label>
                                    <input type="date" class="form-control" name="birthdate" id="birthdate" min="1900-01-01" max="2020-01-01" value="<?= $birthdate ?>">
                                    <span class="text-danger"><?= ($errors['birthdate']) ?? '' ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="country">Pays de naissance : </label>
                                    <select name="country">
                                        <option value="">Sélectionnez</option>
                                        <?php
                                        foreach ($countries as $countryId => $countryName) {
                                            ?>
                                            <option value="<?= $countryId ?>"
                                            <?= ($country == $countryId) ? 'selected' : '' ?>
                                                    >
                                                        <?= $countryName ?>
                                            </option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                    <span class="text-danger"><?= ($errors['country']) ?? '' ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="nationality">Nationalité : </label>
                                    <select name="nationality">
                                        <option value="">Sélectionnez</option>
                                        <?php foreach ($nationalites as $nationalityId => $nationalityName) { ?>
                                            <option value="<?= $nationalityId ?>" 
                                            <?= ($nationality == $nationalityId) ? 'selected' : '' ?>
                                                    >
                                                        <?= $nationalityName ?>
                                            </option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                    <span class="text-danger"><?= ($errors['nationality']) ?? '' ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="address">Adresse : </label>
                                    <input type="text" class="form-control" name="address" id="address" placeholder="2 rue du moulin" value="<?= $address ?>"">
                                    <span class="text-danger"><?= ($errors['address']) ?? '' ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="zipcode">Code Postal : </label>
                                    <input type="text" name="zipcode" id="zipcode" placeholder="80000" size="5 " value="<?= $zipcode ?>">
                                    <label for="city">Ville : </label>
                                    <input type="text"  name="city" id="city" placeholder="Amiens" size="40 " value="<?= $city ?>">
                                    <span class="text-danger"><?= ($errors['zipcode']) ?? '' ?></span>
                                </div>
                            </fieldset>
                        </div>
                        <div name="bloc2">        
                            <div class="form-group">
                                <label for="mail">Email : </label>
                                <input type="email" class="form-control" name="mail" id="mail" placeholder="pierre.kiroul@lamanu.fr" value="<?= $mail ?>">
                                <span class="text-danger"><?= ($errors['mail']) ?? '' ?></span>
                            </div>
                            <div class="form-group">
                                <label for="phone">Téléphone : </label>
                                <input type="tel" class="form-control" name="phone" id="phone" placeholder="06.22.95.01.02" value="<?= $phone ?>">
                                <span class="text-danger"><?= ($errors['phone']) ?? '' ?></span>
                            </div>
                            <div class="form-group">
                                <label for="graduation">Diplôme : </label>
                                <select name="graduation">
                                    <option value="0">-- Choisissez --</option>
                                    <?php foreach ($graduationOption as $graduationOptionid => $graduationOptionName) { ?>
                                            <option value="<?= $graduationOptionid ?>" 
                                            <?= ($graduation == $graduationOptionid) ? 'selected' : '' ?>
                                                    >
                                                        <?= $graduationOptionName ?>
                                            </option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                <span class="text-danger"><?= ($errors['graduation']) ?? '' ?></span>
                            </div>
                            <div class="form-group">
                                <label for="poleemploi">Identifiant pôle-emploi : </label>
                                <input type="text" class="form-control" name="poleemploi" id="poleemploi" placeholder="0224710M" value="<?= $poleemploi ?>">
                                <span class="text-danger"><?= ($errors['poleemploi']) ?? '' ?></span>
                            </div>
                            <div class="form-group">
                                <label for="badge">Nombre de badge : </label>
                                <input type="number" class="form-control" name="badge" id="badge" min="0" max="10" value="<?= $badge ?>">
                                <span class="text-danger"><?= ($errors['badge']) ?? '' ?></span> <!-- ?? = null coalescing operator voir doc -->
                            </div>
                            <div class="form-group">
                                <label for="codecademylink">Lien codecademy : </label>
                                <input type="text" class="form-control" name="codecademylink" id="codecademylink" placeholder="lien codecademy" value="<?= $codecademylink ?>">
                                <span class="text-danger"><?= ($errors['codecademylink']) ?? '' ?></span>
                            </div>
                            <div class="form-group">
                                <label for="hero">Si vous étiez un super héros/une super héroïne, qui seriez-vous et pourquoi ? </label>
                                <textarea class="form-control" name="hero" id="hero" cols="45" row="8"><?= $hero ?></textarea>
                                <span class="text-danger"><?= ($errors['hero']) ?? '' ?></span>
                            </div>
                            <div class="form-group">
                                <label for="hack">Racontez-nous un de vos "hacks" (pas forcément technique ou informatique) </label>
                                <textarea class="form-control" name="hack" id="hack" cols="45" row="8" ><?= $hack ?></textarea>
                                <span class="text-danger"><?= ($errors['hack']) ?? '' ?></span>
                            </div>
                            <div class="form-group">
                                <p>Avez vous déjà eu une expérience avec la programmation et/ou l'informatique avant de remplir ce formulaire ?</p>
                                <label for="experienceoui">oui</label>
                                <input type="radio" name="experience" id="experienceoui" value="1" <?= ($experience == 1) ? 'checked' : '' ?>/>
                                <label for="experiencenon">non</label>
                                <input type="radio" name="experience" id="experiencenon" value="2"  <?= ($experience == 2) ? 'checked' : '' ?>/>
                                <span class="text-danger"><?= ($errors['experience']) ?? '' ?></span>
                            </div>
                        </div>
                        <input type="submit"  name="submit" value="Envoyez" />
                        <input type="reset"  name="reset" value="Effacez" />
                    </form>

                </div>
            </div>
        </div>
<?php }?>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
    </body>
</html>