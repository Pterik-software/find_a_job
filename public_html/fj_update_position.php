<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <title>Job search</title>
  </head>
  <body>    
<h2>Редактирование контакта</h2>
<form action="/fj_do_update_position.php" method="post">
<table>
<?php
print_r($_GET);
include_once 'fj_connection.php';
$id  = strip_tags(htmlentities($_GET['id'])); 
try
{
    $database = new Connection();
    $db = $database->openConnection();
    $query = "SELECT c.*, DATEDIFF(NOW(),created) when_created, DATEDIFF(NOW(),updated) when_updated FROM positions c where id = ".$id;
    //отрисовать все элементы формы через echo  и добавить внутри value значения переменных
    foreach ($db->query($query) as $row) {
      echo "<tr>";
      echo '<td><label for="position_name">Вакансия кратко </label></td>';
      echo '<td><input type="text" id = "position_name" name="position_name" value="'.$row['position_name'].'"></td>';
      echo "</tr>"."\n";

      echo "<tr>";
      echo '<td><label for="manual_rank">Моя оценка</label></td>';
      echo '<td><input type="integer" id = "manual_rank" name="manual_rank" value="'.$row['manual_rank'] .'"></td>';
      echo "</tr>"."\n";

      echo "<tr>";
      echo '<td><label for="automatic_rank">Вычисляемая оценка</label></td>';
      echo '<td><input type="integer" id = "automatic_rank" name="automatic_rank" readonly value="'.$row['automatic_rank'] .'"></td>';
      echo "</tr>"."\n";

      echo "<tr>";
      echo '<td><label for="id">ID</label></td>';
      echo '<td><input type="text" id = "id" name="id" readonly value="'.$row['id'] .'"></td>';
      echo "</tr>"."\n";

      echo "<tr>";
      echo '<td>Состояние</td>';
      if ($row['archived']==1) {
        echo '<td><input type="radio" cheched = "true" value="1" checked name="archived"/>Архивная';
        echo ' <br><input type="radio" value="0" name="archived"/>Активная</td>';
      }
      else {
        echo '<td><input type="radio" value="1" checked name="archived"/>Отправить в архив';
        echo ' <p><input type="radio" value="0" checked name="archived"/>В активе</p></td>';
      }
      echo "</tr>"."\n";

      echo "<tr>";
      echo '<td><label for="comment">Комментарий</label></td>';
      echo '<td><input type="text" id = "comment" name="comment" value="'.$row['comment'] .'"></td>';
      echo "</tr>"."\n";
    
      echo "<tr>";
      echo '<td><label for="company_name">Компания</label></td>';
      echo '<td><input type="text" id = "company_name" name="company_name" value="'.$row['company_name'] .'"></td>';
      echo "</tr>"."\n";

      echo "<tr>";
      echo '<td><label for="company_city">Город</label></td>';
      echo '<td><input type="text" id = "company_city" name="company_city" value="'.$row['company_city'] .'"></td>';
      echo "</tr>"."\n";

      echo "<tr>";
      echo '<td><label for="contact_person">Контакное лицо</label></td>';
      echo '<td><input type="text" id = "contact_person" name="contact_person" value="'.$row['contact_person'].'"></td>';
      echo "</tr>"."\n";

      echo "<tr>";
      echo '<td><label for="email">Email</label></td>';
      echo '<td><input type="email" id = "email" name="email" value="'.$row['email'].'"></td>';
      echo "</tr>"."\n";

      echo "<tr>";
      echo '<td><label for="phone">phone</label></td>';
      echo '<td><input type="phone" id = "phone" name="phone" value="'.$row['phone'].'"></td>';
      echo "</tr>"."\n";
      echo "<tr>";
      echo '<td><label for="position_link">Линк вакансии</label></td>';
      if (!empty($row['position_link'])) 
        {
        echo '<td><input type="text" name="position_link" id="position_link" value="'.$row['position_link'].'"><a href = "'.$row['position_link'].'"></td>';
        }
      else 
        {
        echo '<td><input type="text" name="position_link" id="position_link" value=""></td>';
        };
      echo "</tr>"."\n";
 
      echo "<tr>";
      echo '<td><label for="position_source">Источник вакансии</label></td>';
      echo '<td><input type="text" name="position_source" id="position_source" value="'.$row['position_source'].'"></td>';
      echo "</tr>"."\n";

      echo "<tr>";
      echo '<td><label for="rate">Почасовая<br>оплата</label></td>';
      echo '<td><input type="text" id = "rate" name="rate" value="'.$row['rate'] .'"></td>';
      echo "</tr>"."\n";


      echo "<tr>";
      echo '<td><label for="position_description">Вакансия текстом</label></td>';
      echo '<td><textarea name="position_description" id = "position_description" cols="160" rows="8">'.$row['position_description'].'</textarea></td>';
      echo "</tr>"."\n";

      echo "<tr>";
      echo '<td><label for="answered">Ответили</label>';
      if ($row['answered'])
        {
        echo '  <input type="checkbox" checked id="answered" name="answered" align = "middle" value="1" />';
        }
      else 
        {
        echo "<td>";
        echo '  <input type="checkbox" id="answered" name="answered" align = "middle" value="0" />';
        }
      echo "</td>";
      echo "</tr>"."\n";
      echo "<tr>";
      echo '<td><label for="answer_text">Текст ответа</label></td>';
      echo '<td><textarea name="answer_text" id = "position_description" cols="80" rows="3">'.$row['answer_text'].'</textarea></td>';
      echo "</tr>"."\n";
      echo "<tr>";
      if ($row['when_created']==0) {
        echo '<td><label for="created">Создано</label></td><td>Сегодня</td>';
        }
      else {
        echo '<td><label for="created">Создано</label><td>'.$row['when_created'] . ' дней</td>';
        };
      echo "</tr>"."\n";
      echo "<tr>";
        if ($row['when_updated']==0) {
        echo '<td><label for="updated">Обновлено</label></td><td>Сегодня</td>';
              }
        else {
          echo '<td><label for="updated">Обновлено</label></td><td>'.$row['when_updated'].' дней</td>';
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
    <td align="left"><input type="button" onclick="window.location.href = '/fj_select.php';" value="Назад"></td>
    <td align="left"><input type="button" onclick="window.location.href = '/fj_do_delete_position.php/?id=<?php echo ($id) ?>';" value="Удалить"></td>
    <td align="right"><input type="submit" value="Сохранить"></td>
  </tr>
</table>
</form>

</body>
</html>
