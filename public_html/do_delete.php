<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>Job search</title>
  </head>
  <body>    
  <h2>Удаление лида</h2>
 <?php
include_once 'connection.php';
$id  = strip_tags(htmlentities($_GET['id'])); 
$query = "delete from contacts where id = :id";
try
{
    $database = new Connection();
    $db = $database->openConnection();
    $stm = $db->prepare($query) ;
    $stm->execute(
        array(':id' => $id 
    ));
    echo "Контакт с id=".$id." успешно удалён";
}
catch (PDOException $e)
{
    echo "There is some problem in connection: " . $e->getMessage();
}
?>

<form action="/index.php" method="post">
<tr>    
<td align="left"><input type="submit" value="Home"></td>
</tr>
</form>

</body>
</html>