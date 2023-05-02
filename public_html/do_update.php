<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>Job search</title>
  </head>
  <body>    
  <h2>Исправление лида - сохранение</h2>
 <?php
include_once 'connection.php';
print("<p>");
print_r($_POST);
print("<p>");
$id  = strip_tags(htmlentities($_POST['id'])); 
$comment  = strip_tags(htmlentities($_POST['comment'])); 
$phone = strip_tags(htmlentities($_POST['phone'])); 
$company_name = strip_tags(htmlentities($_POST['company_name']));
$contact_person = strip_tags(htmlentities($_POST['contact_person']));
$email = strip_tags(htmlentities($_POST['email']));
$position_link = htmlentities($_POST['position_link'],ENT_HTML5);
$position_source = strip_tags(htmlentities($_POST['position_source']));
$position_name = strip_tags(htmlentities($_POST['position_name']));
$position_description = strip_tags(htmlentities($_POST['position_description']));
if(isset($_POST['archived'])) 
  {$archived = trim($_POST['archived']);}
else {$archived = 0;};
$answered = strip_tags(htmlentities($_POST['answered']));
if (trim($answered) == '') $answered=0;
$answer_text = strip_tags(htmlentities($_POST['answer_text']));
if (strpos($answer_text, "\r\n\r\n")>0)
  {$answer_text= str_replace("\r\n\r\n","\r\n",$answer_text);};
$query = "update contacts set ".
         "comment = :comment, company_name = :company_name, ".
         "contact_person = :contact_person, email = :email, phone = :phone, ".
         "position_link = :position_link, position_name = :position_name, ".
         "position_description = REPLACE( :position_description, CONCAT(CHAR(13),char(10),CHAR(13),CHAR(10)), CONCAT(CHAR(13),char(10))),".
         " position_source = :position_source, ".
         "archived = :archived, updated = NOW(), answered = :answered, answer_text = :answer_text ".
         "where id = :id ";
try
{
    $database = new Connection();
    $db = $database->openConnection();
    $stm = $db->prepare($query) ;
    $stm->execute(
        array(':id' => $id , 
        ':comment' => $comment , 
        ':company_name' => $company_name , 
        ':contact_person' => $contact_person , 
        ':email' => $email,
        ':phone' => $phone,
        ':position_link' => $position_link,
        ':position_source' => $position_source,
        ':position_name' => $position_name,
        ':position_description' => $position_description,
        ':archived' => $archived,
        ':answered' => $answered,
        ':answer_text' => $answer_text
    ));
    echo "Контакт успешно обновлён";
}
catch (PDOException $e)
{
    echo "There is some problem in connection: " . $e->getMessage();
}
?>

<form action="index.php" method="post">
<tr>    
<td align="left"><input type="submit" value="На главную"></td>
</tr>
</form>

</body>
</html>