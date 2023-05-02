<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>Job search</title>
  </head>
  <body>    

 <?php
include_once 'connection.php';
$comment  = strip_tags(htmlentities($_POST['comment'])); 
$phone = strip_tags(htmlentities($_POST['phone'])); 
$company_name = strip_tags(htmlentities($_POST['company_name']));
$contact_person = strip_tags(htmlentities($_POST['contact_person']));
$email = strip_tags(htmlentities($_POST['email']));
$position_source = strip_tags(htmlentities($_POST['position_source']));
$position_other_source = strip_tags(htmlentities($_POST['position_other_source']));
if (!empty($position_other_source)) 
  {
    $position_source = $position_other_source;
  }
$position_name = strip_tags(htmlentities($_POST['position_name']));
$position_link = htmlentities($_POST['position_link'],ENT_HTML5);
$position_description = strip_tags(htmlentities($_POST['position_description']));

//echo('Обрабатываем '.'<br>'); 
//echo('comment='.$comment .'<br>'); 
//echo('phone='.$phone .'<br>'); 
//echo('company_name='.$company_name .'<br>'); 
//echo('contact_person='.$contact_person .'<br>'); 
echo('position_source='.$position_source .'<br>'); 
//echo('position_link='.strip_tags($position_link .'<br>')); 
//echo('position_name='.$position_name .'<br>'); 
//echo('position_description='.$position_description .'<br>'); 

$query = 'INSERT INTO contacts (comment, company_name, contact_person, email, phone, position_link, position_name, '.
'position_description, position_source, answered, answer_text) '.
'VALUES ( :comment, :company_name, :contact_person, :email, :phone, :position_link, :position_name, '.
'REPLACE( :position_description, CONCAT(CHAR(13),char(10),CHAR(13),CHAR(10)), CONCAT(CHAR(13),char(10))), :position_source, false, "")';
try
{
    $database = new Connection();
    $db = $database->openConnection();
    $stm = $db->prepare($query) ;
    $stm->execute(
        array(':comment' => $comment , 
        ':company_name' => $company_name , 
        ':contact_person' => $contact_person , 
        ':email' => $email,
        ':phone' => $phone,
        ':position_link' => $position_link,
        ':position_name' => $position_name,
        ':position_description' => $position_description,
        ':position_source' => $position_source
    ));
    echo "Контакт успешно добавлен";
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