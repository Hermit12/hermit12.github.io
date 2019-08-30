<?php
// mailscript.php
// Version vom 04.09.2017

// Empfänger
// An diese E-Mail-Adresse wird die Nachricht gesendet. Bitte einen Namen und eMail eintragen:
$empfaengerName = "Brigitte Swoboda"; // Name des Empfängers
$empfaengerEmail = "brigitte-swoboda@gmx.at"; // E-Mail des Empfängers
$dankeSeite = "danke.html"; // Danke - Seite, die Mail wurde erfolgreich versandt. Eventuell anpassen.
$fehlerSeite = "fehler.html"; // Fehler - Seite, falls die Mail nicht versandt werden konnte. Eventuell anpassen.

// Betreff
// Jede E-Mail benötigt einen Betreff, da jedoch im Formular kein
// entsprechendes Feld gesetzt wurde, wird ein fester Betreff hinzugefügt.
$betreffEmail = "Kontaktformular Homepage";


// Wurden POST-Daten gesendet?
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Zeitzone und das aktuelle Datum setzen
  date_default_timezone_set("Europe/Berlin");
  $datum = date("d.m.Y H:i");

  // HTML-Tags entfernen
  $_POST = array_map('strip_tags', $_POST);

  // Inhalt der E-Mail setzen
  $inhaltEmail = "Gesendet am: $datum Uhr
   Name: " . $_POST["name"] . "
   E-Mail: " . $_POST["email"] . "
   Phone: " . $_POST["phone"] . "

   Nachricht: " . $_POST["message"] . "
  ";

  // PHPMailer einbinden
  // Skripte sind im Download vorhanden, bitte diese verwenden oder das
  // Download: https://github.com/PHPMailer/PHPMailer/tree/5.2-stable
  // dann aber das Verzeichnis "examples" vor dem Upload löschen.
  require "PHPMailer-5.2-stable/PHPMailerAutoload.php";

  // Instanz und Zeichenkodierung setzen
  $mail = new PHPMailer();
  $mail->CharSet = "UTF-8";

  // Absender und Empfänger setzen
  $mail->setFrom($_POST["email"], $_POST["name"]);
  $mail->addAddress($empfaengerEmail, $empfaengerName);

  // Betreff und Body setzen
  $mail->Subject = $betreffEmail;
  $mail->Body = $inhaltEmail;

 // E-Mail versenden
 if ($mail->Send()) {
  header("Location: " . $dankeSeite);
 }
 else {
  header("Location: " . $fehlerSeite);
 }
}
?>