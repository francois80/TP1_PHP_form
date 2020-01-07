<?php
$isSubmitted = false;

//variables msg d'alerte champs mal saisis
$firstname = $lastname = $birthdate = $country = $nationality = $address = $zipcode = $city = $mail = $phone = $graduation = $poleemploi = $badge = $codecademylink = $hero = $hack = $experience = '';

//regex pour les contrôle du formulaire
$regexName = "/^[A-Za-zéÉ][A-Za-záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœ]+((-| )[A-Za-záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœ]+)?$/";
$regexDate = "/^((?:19|20)[0-9]{2})-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])$/";
$regexZipCode = "/^((2[AB])|([0-9]{5}))$/";
$regexAddress = "/\w/";
$regexTel = "/^0[67](\.[0-9]{2}){4}$/";
$regexPoleEmploi = "/^[0-9]{7}[A-Za-z]$/";
//tableau d'erreurs
$errors = [];

//contrôle du formulaire après envoi
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $isSubmitted = true;
    //contôle du nom
    $firstname = trim(filter_input(INPUT_POST,'firstname',FILTER_SANITIZE_STRING));
    if (empty($firstname)) {
        $errors['firstname'] = 'Veuillez renseigner le prénom';
    } elseif (!preg_match($regexName, $firstname)) {
        $errors['firstname'] = 'Votre prénom contient des caractères non autorisés !';
    }
    //contôle du prénom
    $lastname = trim(filter_input(INPUT_POST,'lastname',FILTER_SANITIZE_STRING));
    if (empty($lastname)) {
        $errors['lastname'] = 'Veuillez renseigner le nom';
    } elseif (!preg_match($regexName, $lastname)) {
        $errors['lastname'] = 'Votre nom contient des caractères non autorisés !';
    }
    //contôle de la date d'anniversaire
    $birthdate = trim(htmlspecialchars($_POST['birthdate']));
    if (empty($birthdate)) {
        $errors['birthdate'] = 'Veuillez renseigner votre date de naissance';
    } elseif (!preg_match($regexDate, $birthdate)) {
        $errors['birthdate'] = 'Le format valide est aaaa-mm-jj !';
    }
    //contôle du pays
    $country = trim(filter_input(INPUT_POST,'country',FILTER_SANITIZE_NUMBER_INT));
    if (empty($country)) {
        $errors['country'] = 'Veuillez choisir votre pays';
    } elseif (!filter_input(INPUT_POST, 'country', FILTER_VALIDATE_INT)) {
        $errors['country'] = 'Votre pays n\'est pas bon !';
    }
     //contôle de la nationalité
     $nationality = trim(filter_input(INPUT_POST,'nationality',FILTER_SANITIZE_NUMBER_INT));
    if (empty($nationality)) {
        $errors['nationality'] = 'Veuillez renseigner votre nationalité';
    } elseif (!filter_input(INPUT_POST, 'nationality', FILTER_VALIDATE_INT)) {
        $errors['nationality'] = 'Votre nationalité contient des caractères non autorisés !';
    }
     //contôle du badge
     $badge = trim(filter_input(INPUT_POST,'badge',FILTER_SANITIZE_NUMBER_INT));
    if (empty($badge)) {
        $errors['badge'] = 'Veuillez renseigner le nombre de badge';
    } elseif (!filter_input(INPUT_POST, 'badge', FILTER_VALIDATE_INT)) {
        $errors['badge'] = 'Le nombre de badge n\'est pas correct !';
    }
     //contôle du diplôme
     $graduation = trim(filter_input(INPUT_POST,'graduation',FILTER_SANITIZE_NUMBER_INT));
    if (empty($graduation)) {
        $errors['graduation'] = 'Veuillez choisir le diplôme';
    } elseif (!filter_input(INPUT_POST, 'graduation', FILTER_VALIDATE_INT)) {
        $errors['graduation'] = 'Le choix du diplôme n\'est pas correct !';
    }
     //contôle de l'adresse
    $address =  trim(filter_input(INPUT_POST,'address',FILTER_SANITIZE_STRING));
    if (empty($address)) {
        $errors['address'] = 'Veuillez renseigner votre adresse';
    } elseif (!preg_match($regexAddress, $address)) {
        $errors['address'] = 'Le format de l\'adresse n\'est pas valide!';
    }
     //contôle du code postal
    $zipcode =  trim(filter_input(INPUT_POST,'zipcode',FILTER_SANITIZE_STRING));
    if (empty($zipcode)) {
        $errors['zipcode'] = 'Veuillez renseigner votre code postal';
    } elseif (!preg_match($regexZipCode, $zipcode)) {
        $errors['zipcode'] = 'Le format du code postal n\'est pas valide!';
    }
     //contôle de la ville
    $city =  trim(filter_input(INPUT_POST,'city',FILTER_SANITIZE_STRING));
    if (empty($city)) {
        $errors['city'] = 'Veuillez renseigner votre ville';
    } elseif (!preg_match($regexName, $city)) {
        $errors['city'] = 'Le format de la ville n\'est pas valide!';
    }
     //contôle de l'email
     $mail = trim(htmlspecialchars($_POST['mail']));
    if (empty($mail)) {
        $errors['mail'] = 'Veuillez renseigner votre email';
    } elseif (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        $errors['mail'] = 'L\' email  n\'est pas valide!';
    }
     //contôle du téléphone
    $phone = trim(htmlspecialchars($_POST['phone']));
    if (empty($phone)) {
        $errors['phone'] = 'Veuillez renseigner votre téléphone';
    } elseif (!preg_match($regexTel, $phone)) {
        $errors['phone'] = 'Le format du téléphone n\'est pas valide!';
    }
     //contôle de l'identifiant pôle emploi
    $poleemploi = trim(htmlspecialchars($_POST['poleemploi']));
    if (empty($poleemploi)) {
        $errors['poleemploi'] = 'Veuillez renseigner votre identifiant pole-emploi';
    } elseif (!preg_match($regexPoleEmploi, $poleemploi)) {
        $errors['poleemploi'] = 'L\' identifiant pole-emploi n\'est pas valide!';
    }
     //contôle de l'url codecademy
    $codecademylink = trim(htmlspecialchars($_POST['codecademylink']));
    if (empty($codecademylink)) {
        $errors['codecademylink'] = 'Veuillez renseigner le lien codecademy';
    } elseif (!filter_var($codecademylink, FILTER_VALIDATE_URL)) {
        $errors['codecademylink'] = 'L\' url codecademy  n\'est pas valide!';
    }
     //contôle du textarea "si vous étiez un héro..."
    $hero = trim(filter_input(INPUT_POST,'hero',FILTER_SANITIZE_STRING));
    if (empty($hero)) {
        $errors['hero'] = 'Veuillez nous racontez quel super héros vous souhaiteriez être';
    } 
    //contôle du textarea "racontez un hack..."
    $hack = trim(filter_input(INPUT_POST,'hack',FILTER_SANITIZE_STRING));
    if (empty($hack)) {
        $errors['hack'] = 'Veuillez nous racontez un de vos "hacks"';
    } 
    //contôle des radios boutons sur l'expérience
    $experience =trim(filter_input(INPUT_POST,'experience',FILTER_SANITIZE_NUMBER_INT));
    //contrôle des radio ou des checkbox avec isset et non empty
    if(!isset($_POST['experience'])){
        $errors['experience'] = 'Veuillez renseigner votre experience ';
    }
  //fin des contôles après envoi du formulaire
 }
 