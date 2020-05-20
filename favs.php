<?php
    session_start();
    require_once __DIR__.'/bootstrap.php';
    require_once __DIR__.'/functions.php';
    $info = $savedvalues = $errors = [];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        //add dish name to an array containing user favourites
        if (isset($_POST['fav'])) {
            //check if array already exists
            if (!isset($_SESSION['list'])) {
                $_SESSION['list'] = [];
            }
            //check if the passed value is not already in the array
            if (($index = array_search($_POST['fav'], $_SESSION['list'])) === false) {
                $_SESSION['list'][] = $_POST['fav'];
            } else {
                $info['error'] = "Error! This dish has already been added to the list";

            }
        }

        //delete dish name from an array containing user favourites
        if (isset($_POST['del'])) {
            if (($index = array_search($_POST['del'], $_SESSION['list'])) !== false) {
                unset($_SESSION['list'][$index]);
            } else {
                $info['error'] = "Error! There is no such entry.";
            }
        }

        //send email only if the favourites list is not empty
        if (isset($_POST['email']) && !empty($_SESSION['list'])) {
            //server-side validation of email field
            $_SESSION['emailErr'] = "";
            $email = "";
            $_SESSION['valid'] = true;
            $email = $savedvalues['email'] = valemail($_POST["email"]);
            //send message or redirect back if email is not valid
            if ($_SESSION['valid']) {
                $to = $email;
                $mail = "
                    <html>
                    <head>
                    <title>List of Favourites</title>
                    </head>
                    <body>
                    <p>This e-mail is sent from Triomalta. It contains a list of favourite dishes.</p>
                    ";
                $xml=simplexml_load_file("menu.xml") or die("Error: Cannot create object");
                foreach ($_SESSION['list'] as $key) {
                    foreach($xml->children() as $menu) {
                        foreach($menu->children() as $dish){
                            if ($key == $dish->title){
                                $mail .= "
                                    <table>
                                        <tr> 
                                            <td>
                                            $dish->title <br>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                            $dish->ingredients <br>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                            $dish->comments <br>
                                            </td>
                                        </tr>
                                    </table><br>
                                    ";
                            }
                        }
                    }
                }
                $mail .= "
                    <p>Please, visit us at <a href='http://triomalta.com'>triomalta.com</a></p>
                    </body>
                    </html>
                    ";
                $header = "MIME-Version: 1.0" . "\r\n";
                $header .= "Content-type:text/html; charset=UTF-8" . "\r\n";
                $header .= "From: Triomalta Restaurant \r \n";
                $subject = "Your Favourite Dishes";
                $sent = mail($to, $subject, $mail, $header);
                if (!$sent) {
                    $errors['error'] = "Error! Your message has not been sent. Please, try again later.";
                } else {
                    $savedvalues = [];
                    $savedvalues['success'] = "Your message has been successfully sent.";
                }

            } else {
                $errors = $_SESSION;
                $errors['error'] = "Please, check if your E-mail is correct.";
            }
        }
    }

    if (!empty($_SESSION['list'])) {
        $favs = $_SESSION['list'];
    } else {
        $favs = [];
        $savedvalues['favs'] = "There are no favourites in your list!";
    }

    echo $twig->render('favs.html', [
        'savedvalues' => $savedvalues,
        'favs' => $favs,
        'info' => $info,
        'errors' => $errors ]);
