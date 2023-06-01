<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>Job search</title>
  </head>
  <body>    
<h2>Редактирование сайта</h2>
<form action="/do_update_job_sites.php" method="post">
<table>
<?php
//print_r($_GET);
include_once 'connection.php';
$id  = strip_tags(htmlentities($_GET['id'])); 
try
{
    $database = new Connection();
    $db = $database->openConnection();
    $query = "SELECT s.*, DATEDIFF(NOW(),created) when_created, DATEDIFF(NOW(),updated) when_updated FROM job_sites s where id = ".$id;
    //отрисовать все элементы формы через echo  и добавить внутри value значения переменных
    foreach ($db->query($query) as $row) {
        echo "<tr>";
        echo '<td><label for="id">id</label></td>';
        echo '<td><input type="text" id = "id" name="id" readonly value="'.$row['id'] .'"></td>';
        echo "</tr>"."\n";

        echo "<tr>";
        echo '<td>Состояние</td>';
        if ($row['archived']==1) {
          echo '<td><input type="radio" cheched = "true" value="1" checked name="archived"/>В архиве';
          echo ' <p><input type="radio" value="0" name="archived"/>Активный</p></td>';
        }
        else {
          echo '<td><input type="radio" value="1" checked name="archived"/>В архиве';
          echo ' <p><input type="radio" value="0" checked name="archived"/>Активный</p></td>';
        }
        echo "</tr>"."\n";

        echo "<tr>";
        echo '<td><label for="site_name">Сайт</label></td>';
        echo '<td><input type="text" id = "site_name" name="site_name" value="'.$row['site_name'] .'"></td>';
        echo "</tr>"."\n";
        echo "<tr>";
          if ($row['when_updated']==0) {
          echo '<td><label for="updated">Обновлено</label></td><td>Сегодня</td>';
                }
          else {
            echo '<td><label for="updated">Обновлено</label></td><td>'.$row['when_updated'].' дней</td>';
            };
          echo "</tr>"."\n";
          echo "<tr>";
          if ($row['when_created']==0) {
            echo '<td><label for="created">Создано</label></td><td>Сегодня</td>';
                }
          else {
            echo '<td><label for="created">Создано</label><td>'.$row['when_created'] . ' дней</td>';
            };
          echo "</tr>"."\n";
            echo "<tr><td></td><td></td></tr>"."\n";
          }
}
catch (PDOException $e)
{
    echo "There is some problem in connection: " . $e->getMessage();
}

$database->closeConnection();
?>
  <tr>
    <td align="left"><input type="button" onclick="window.location.href = '/job_sites.php';" value="Назад"></td>
    <td align="left"><input type="submit" onclick="window.location.href = '/do_update_job_sites.php/?id=<?php echo ($id) ?>';" value="Обновить"></td>
  </tr>
</table>
</form>

</body>
</html>
