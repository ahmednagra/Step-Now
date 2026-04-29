<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Newsletter-Anmeldung bestätigen</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px;">

    <h2 style="color: #222;">Hallo,</h2>

    <p>vielen Dank für Ihr Interesse am Newsletter von <strong>StepNow Rides &amp; Movers e.K.</strong></p>

    <p>Bitte bestätigen Sie Ihre Anmeldung über den folgenden Link, damit wir Sie in den Verteiler aufnehmen dürfen:</p>

    <p style="text-align: center; margin: 30px 0;">
        <a href="{{ $confirmUrl }}"
           style="background-color: #007bff; color: #ffffff; padding: 12px 28px;
                  text-decoration: none; border-radius: 4px; display: inline-block;">
            Anmeldung bestätigen
        </a>
    </p>

    <p style="font-size: 0.9rem; color: #666;">
        Falls der Button nicht funktioniert, kopieren Sie bitte den folgenden Link in Ihren Browser:<br>
        <a href="{{ $confirmUrl }}">{{ $confirmUrl }}</a>
    </p>

    <p style="font-size: 0.85rem; color: #666; margin-top: 40px;">
        Sie haben diese E-Mail erhalten, weil Ihre E-Mail-Adresse auf
        <a href="https://step-now.de">step-now.de</a> für unseren Newsletter eingetragen wurde.
        Falls Sie diese Anmeldung nicht selbst vorgenommen haben, ignorieren Sie diese E-Mail einfach –
        ohne Ihre Bestätigung wird Ihre Adresse nicht in den Verteiler aufgenommen.
    </p>

    <hr style="border: none; border-top: 1px solid #eee; margin: 30px 0;">

    <p style="font-size: 0.8rem; color: #999;">
        StepNow Rides &amp; Movers e.K. · Inhaber: Naeem Ahmad<br>
        Blumenstraße 8, 73779 Deizisau · Deutschland<br>
        Telefon: +49 159 01228856 · E-Mail: info@step-now.de
    </p>

</body>
</html>
