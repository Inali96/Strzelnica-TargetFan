<?php
if (isset($_POST['Email'])) {

    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "totkjaxd@gmail.com";
    $email_subject = "Wiadomość ze strony TargetFan";

    function problem($error)
    {
        echo "Wystąpiły problemy z wysyłaniem wiadomości. ";
        echo $error . "<br><br>";
        die();
    }

    // validation expected data exists
    if (
        !isset($_POST['Name']) ||
        !isset($_POST['Message'])
    ) {
        problem('Wystąpiły problemy z wysyłaniem wiadomości. ');
    }

    $name = $_POST['Name']; // required
    $email = $_POST['Email']; // required
    $message = $_POST['Message']; // required

    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

    if (!preg_match($email_exp, $email)) {
        $error_message .= 'Niepoprawny adres email<br>';
    }

    $string_exp = "/^[A-Za-z .'-]+$/";

    if (!preg_match($string_exp, $name)) {
        $error_message .= 'Niepoprawne dane<br>';
    }

    if (strlen($message) < 2) {
        $error_message .= 'Treść powinna zawierać conajmniej 2 znaki<br>';
    }

    if (strlen($error_message) > 0) {
        problem($error_message);
    }

    $email_message = "Szczegóły wiadomości poniżej:\n\n";

    function clean_string($string)
    {
        $bad = array("content-type", "bcc:", "to:", "cc:", "href");
        return str_replace($bad, "", $string);
    }

    $email_message .= "Imię: " . clean_string($name) . "\n";
    $email_message .= "Email: " . clean_string($email) . "\n";
    $email_message .= "Wiadomość: " . clean_string($message) . "\n";

    // create email headers
    $headers = 'From: ' . $email . "\r\n" .
        'Reply-To: ' . $email . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
    @mail($email_to, $email_subject, $email_message, $headers);
    ?>


    <?php
    header("Location: https://testing.targetfan.pl/", TRUE, 301);
    exit();
    ?>

    <?php
}
?>