<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>Job search</title>
  </head>
  <body>    
  <h2>Обновление сайта</h2>
 <?php
include_once 'connection.php';
#print("<p>");
#print_r($_POST);
#print("<p>");
$id  = strip_tags(htmlentities($_POST['id'])); 
$site_name = strip_tags(htmlentities($_POST['site_name']));
if(isset($_POST['archived'])) 
  {$archived = trim($_POST['archived']);}
else {$archived = 0;};
$query = "update job_sites set ".
         "site_name = :site_name, archived = :archived, updated = NOW() ".
         "where id = :id ";
try
{
    $database = new Connection();
    $db = $database->openConnection();
    $stm = $db->prepare($query) ;
    $stm->execute(
        array(':id' => $id , 
        ':site_name' => $site_name , 
        ':archived' => $archived
    ));
    echo "Задание по сайту выполнено";
}
catch (PDOException $e)
{
    echo "There is some problem in connection: " . $e->getMessage();
}
?>

<form action="job_sites.php" method="post">
<tr>    
<td align="left"><input type="submit" value="На главную"></td>
</tr>
</form>

</body>
</html>
