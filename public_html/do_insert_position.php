<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>Position search</title>
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
$rate = htmlentities($_POST['rate'],ENT_HTML5);
$manual_rank = htmlentities($_POST['manual_rank'],ENT_HTML5);
$automatic_rank = 0;
$company_city = htmlentities($_POST['company_city'],ENT_HTML5);

$query = 'INSERT INTO positions (comment, company_name, contact_person, email, phone, manual_rank, automatic_rank, rate, company_city, '.
' position_link, position_name, position_description, position_source, answered, answer_text) '.
'VALUES ( :comment, :company_name, :contact_person, :email, :phone, :manual_rank, :automatic_rank, :rate, :company_city,'.
':position_link, :position_name, REPLACE( :position_description, CONCAT(CHAR(13),char(10),CHAR(13),CHAR(10)), CONCAT(CHAR(13),char(10))), :position_source, false, "")';
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
        ':automatic_rank' => $automatic_rank,
        ':manual_rank' => $manual_rank,
        ':rate' => $rate,
        ':company_city' => $company_city,
        ':position_link' => $position_link,
        ':position_name' => $position_name,
        ':position_description' => $position_description,
        ':position_source' => $position_source
    ));
    echo "Position успешно добавлен";
}
catch (PDOException $e)
{
    echo "There is some problem in connection: " . $e->getMessage();
}
?>
<form action="/index.php" method="post">
<tr>    
<td align="left"><input type="submit" value="На главную"></td>
</tr>
</form>

</body>
</html>
