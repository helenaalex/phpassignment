<?php
    session_start();
    require_once __DIR__.'/bootstrap.php';
    require_once __DIR__.'/functions.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $_SESSION['subjectErr'] = $_SESSION['nameErr'] = $_SESSION['telErr'] = $_SESSION['emailErr'] = "";
        $subject = $name = $tel = $email = $mes = "";
        $_SESSION['valid'] = true;
        $subject = $savedvalues['subject'] = valsubject($_POST["subject"]);
        $name = $savedvalues['name'] = valname($_POST["name"]);
        $tel = $savedvalues['tel'] = valtel($_POST["tel"]);
        $email = $savedvalues['email'] = valemail($_POST["email"]);
        $mes = $savedvalues['mes'] = valmes($_POST["message"]);

        //send message or capture errors if validation fails
        if ($_SESSION['valid']) {
            $errors = [];
            $to = 'triomalta20@gmail.com';
            $header = "Reply-To: $name <$email> \r \n";
            $mail = "From: $name <$email> \n \n Phone number: $tel \n \n Message: $mes";
            $sent = mail($to, $subject, $mail, $header);
            if (!$sent) {
                $errors['error'] = "Error! Your message has not been sent. Please, try again later";
            } else {
                $savedvalues = [];
                $savedvalues['success'] = "We received your message and will contact you soon. Thank you for your interest.";
            }

        } else {
            $errors = $_SESSION;
            $errors['error'] = "There is an issue with the form. Please, check if it is correctly filled.";
        }

            echo $twig->render('contact.html', [
                    'savedvalues' => $savedvalues,
                    'errors' => $errors ]);
    } else {
        echo $twig->render('contact.html');
    }
