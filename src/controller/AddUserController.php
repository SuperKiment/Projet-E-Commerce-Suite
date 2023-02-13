<?php

use PHPMailer\PHPMailer\PHPMailer;

function addUserController($twig, $db)
{
    include_once '../src/model/UserModel.php';

    $form = [];
    if (isset($_POST['submitRegister'])) {
        if (
            isset($_POST['firstname'])
            && isset($_POST['lastname'])
            && isset($_POST['email'])
            && isset($_POST['password'])
            && isset($_POST['passwordVerif'])

            && $_POST['firstname'] != ""
            && $_POST['lastname'] != ""
            && $_POST['email'] != ""
            && $_POST['password'] != ""
        ) {
            if (strlen($_POST['password']) >= 3) {
                $email = $_POST['email'];
                $password = $_POST['password'];
                $passwordConfirm = $_POST['passwordVerif'];
                $lastname = $_POST['lastname'];
                $firstname = $_POST['firstname'];
                if (!getOneUserCredentials($db, $email)) {
                    if ($password === $passwordConfirm) {
                        
                        saveUser(
                            $db,
                            $email,
                            password_hash($password, PASSWORD_DEFAULT),
                            $lastname,
                            $firstname,
                            1
                        );


                        include_once '../config/confMail.php';

                        $mail = new PHPMailer();
                        $mail->isSMTP(); // Paramétrer le Mailer pour utiliser SMTP 
                        $mail->Host = 'smtp.office365.com'; // Spécifier le serveur SMTP
                        $mail->SMTPAuth = true; // Activer authentication SMTP
                        $mail->Username = $conf['email'];
                        $mail->Password = $conf['mdp']; // Le mot de passe de cette adresse email
                        $mail->SMTPSecure = 'tls'; // Accepter SSL
                        $mail->Port = 587;
                        $mail->setFrom($conf['email'], 'Site E-Commerce'); // Personnaliser l'envoyeur
                        $mail->addAddress($email, $firstname . ' ' . $lastname);
                        $mail->isHTML(true); // Paramétrer le format des emails en HTML ou non
                        $mail->Subject = 'Inscription à Shop';
                        $mail->Body = $twig->render('mail/register_message.html.twig', [
                            'email' => $email
                        ]);

                        if (!$mail->send()) {
                            $form['message'] = "Message non-envoyé !";
                        }

                        $form['message'] = '';

                        $form = [
                            'state' => 'success',
                            'message' => $form['message'] . " Cette personne est maintenant inscrite !"
                        ];
                    } else {
                        $form = [
                            'state' => 'danger',
                            'message' => "Les deux mots de passe ne correspondent pas !"
                        ];
                    }
                } else {
                    $form = [
                        'state' => 'danger',
                        'message' => "Un compte avec cette adresse mail existe déjà !"
                    ];
                }
            } else {
                $form = [
                    'state' => 'danger',
                    'message' => "Le mot de passe doit faire au moins 3 caractères !"
                ];
            }
        } else {
            $form = [
                'state' => 'danger',
                'message' => "Veuillez remplir tous les champs !"
            ];
        }
    }
    echo $twig->render('addUser.html.twig', [
        'form' => $form
    ]);
}
