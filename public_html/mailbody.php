<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>Почтовое сообщение</title>
  </head>
  <body>    
<h1>Почтовое сообщение</h1>
<?php

imap_fetchbody(
    IMAP\Connection $imap,
    int $message_num,
    string $section,
    int $flags = 0
): string|false

$i = 1;
$header = imap_headerinfo($imap, $i);
$fromInfo = $header->from[0];
$replyInfo = $header->reply_to[0];

$details = array(
     "fromAddr" => (isset($fromInfo->mailbox) && isset($fromInfo->host))
         ? $fromInfo->mailbox . "@" . $fromInfo->host : "",
     "fromName" => (isset($fromInfo->personal))
         ? $fromInfo->personal : "",
     "replyAddr" => (isset($replyInfo->mailbox) && isset($replyInfo->host))
         ? $replyInfo->mailbox . "@" . $replyInfo->host : "",
     "replyName" => (isset($replyTo->personal))
         ? $replyto->personal : "",
     "subject" => (isset($header->subject))
         ? $header->subject : "",
     "udate" => (isset($header->udate))
         ? $header->udate : ""
 );
 $uid = imap_uid($imap, $i);

 echo "<ul>";
 echo "<li><strong>From:</strong>" . $details["fromName"];
 echo " " . $details["fromAddr"] . "</li>";
 echo "<li><strong>Subject:</strong> " . $details["subject"] . "</li>";
 echo '<li><a href="mailbody.php?folder=' . $folder . '&uid=' . $uid . '&func=read">Read</a>';
 echo " | ";
 echo '<a href="mailbody.php?folder=' . $folder . '&uid=' . $uid . '&func=delete">Delete</a></li>';
 echo "</ul>";

?>

</body>
</html>

