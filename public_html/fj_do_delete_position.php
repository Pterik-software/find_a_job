<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <title>Удаление предложения работы</title>
  </head>
  <body>    
  <h2>Удаление предложения работы</h2>
 <?php
include_once 'connection.php';
$id  = strip_tags(htmlentities($_GET['id'])); 
$query = "delete from positions where id = :id";
try
{
    $database = new Connection();
    $db = $database->openConnection();
    $stm = $db->prepare($query) ;
    $stm->execute(
        array(':id' => $id 
    ));
    echo "position id=".$id." успешно удалён";
}
catch (PDOException $e)
{
    echo "There is some problem in connection: " . $e->getMessage();
}
?>

<form action="/select.php" method="post">
<tr>    
<td align="left"><input type="submit" value="Home"></td>
</tr>
</form>

</body>
</html>
