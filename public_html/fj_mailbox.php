<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <title>Job search</title>
  </head>
  <body>    
<h1>Почтовые сообщения</h1>

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$func = (!empty($_GET["func"])) ? $_GET["func"] : "view";
$folder = (!empty($_GET["folder"])) ? $_GET["folder"] : "INBOX";
$uid = (!empty($_GET["uid"])) ? $_GET["uid"] : 0;
print("Parameters:"."\n");
print("func =".$func."\n");
print("folder =".$folder."\n");
print("uid=".$uid."\n");
# Gmail {imap.gmail.com:993/imap/ssl}INBOX
# Yahoo {imap.mail.yahoo.com:993/imap/ssl}INBOX
# AOL {imap.aol.com:993/imap/ssl}INBOX

# Сервер SMTP, POP3, IMAP:	mail.adm.tools
# Порт SMTP-сервера:	465 (SSL), 25 или 2525
# Порт POP3-сервера:	995 (SSL) или 110
# Порт IMAP-сервера:	993 (SSL) или 143
# Настройка домена:	@ MX 0 mx.ukraine.com.ua
# $mailbox = "{localhost:993/imap/ssl/novalidate-cert}INBOX";
# $imap = imap_open("{localhost:993/imap/ssl/novalidate-cert}", "username", "password");
$mailbox = "{mail.adm.tools:993/imap/ssl/novalidate-cert}INBOX";
$username = "admin@data-migration.club";
$password = "Skira1wroclaw";
$imap = imap_open($mailbox, $username, $password) or die('Cannot connect to email: ' . imap_last_error());
print("\n"."<br>");
if($imap){
  print("Connection established....");
} else {
  print("Connection failed");
}

$folders = imap_list($imap, "{mail.adm.tools:993/imap/ssl}", "*");
echo "<ul>";
foreach ($folders as $folder) {
    $folder = str_replace("{mail.adm.tools:993/imap/ssl}", "", imap_utf7_decode($folder));
    echo '<li><a href="mailbody.php?folder=' . $folder . '&func=view">' . $folder . '</a></li>';
}
echo "</ul>";

$numMessages = imap_num_msg($imap);
for ($i = $numMessages; ($i > ($numMessages - 20)) && ($i>0) ; $i--) {
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
  }
#$emailData = imap_search($inbox, '');
#if (! empty($emailData)) {  
#   foreach ($emailData as $msg) {
#      $msg = imap_fetchbody($inbox, $msg, "1");
#      print(quoted_printable_decode($msg)."<br>");                
#   }    
#} 

switch ($func) {
  case "delete":
      deleteMail($imap, $folder, $uid);
      //imap_delete($imax, 1);
      break;

  case "read":
      //readMail($imap, $folder, $uid);
      if( $num >0 ) {
        //read that mail recently arrived
        //http://jobsearch.local/mailbody.php?folder=INBOX.Drafts&uid=12&func=read        
        echo imap_qprint(imap_body($imap,$num));
      }
      break;

  case "view":
  default:
      viewMail($imap, $folder);
      break;
}

//Closing the connection
imap_close($inbox);   
#$mailbox = "{mail.adm.tools:993/imap/ssl}INBOX";
#$inbox = imap_open($mailbox, $username, $password) or die('Cannot connect to email: ' . imap_last_error());

?>
Well done
</body>
</html>
