<?php
    require __DIR__.'/vendor/autoload.php';
    use PHPMailer\PHPMailer\PHPMailer;

    $mailer = new PHPMailer();
    echo get_class($mailer);

?>