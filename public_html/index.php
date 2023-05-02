<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>Job search</title>
  </head>
  <body>    
<h1>Список лидов</h1>
<?php 
//print_r($_GET);
?>
<table>
  <tr>  
  <td>
  <button><img src="images/insert.png" style="vertical-align: middle" > <a href="insert_contact.php">Добавить лид</a></button>
  </td>
  <form action="/index.php" method="get">
  <td><label for="search">Поиск</label></td>
  <?php
  echo '<td><input type="text" id = "search" name="search" value="'.$_GET['search'].'"></td>';
  ?>
  <td align="right"><input type="submit" value="Искать"></td>
  <td>
  <a href="index.php?archived=-1">все</a><p>
  <a href="index.php?archived=1">архив - </a><p>
  <a href="index.php?archived=0">архив +</a>  
  </td>
</form>
</tr>
<!--select 
id 
contact_name,
company_name,
contact_person,
email,
phone,
position_name,
position_description,	
position_source
from contacts
where archived is false
-->
<table rules="all">
  <thead>
    <tr>
      <th>id</th>
      <th>Компания</th>
      <th>Контакт</th>
      <th>Мой комментарий</th>
      <th>email</th>
      <th>phone</th>
      <th>Источник</th>
      <th>Вакансия кратко</th>
      <th>Линк вакансии</th>
      <th>Ответили</th>
      <th>Текст ответа</th>
      <th>Создано</th>
      <th>Обновлено</th>
      <th>В архиве</th>
      <th>Текст вакансии</th>
    </tr>
  </thead>  
  <tr>

<?php
include_once 'connection.php';
try
{
    $database = new Connection();
    $db = $database->openConnection();
    if (!isset($_GET['archived']))
      { $archived_value = " where 1=1 ";}  
    elseif ($_GET['archived'] == '1')  
      { $archived_value = " where archived = TRUE";}
    elseif ($_GET['archived'] == '0')  
      { $archived_value = " where archived = FALSE";}
    $search_value = '';
    if (isset($_GET['search']) and (trim($_GET['search'])!="") )
      {$search_value = 'and (lower(concat(ifnull(company_name,""),ifnull(contact_name,""), ifnull(contact_person,""),ifnull(email,""),ifnull(phone,""),ifnull(position_link,""),ifnull(position_name,"") )) like lower("%'.htmlentities(trim(($_GET['search']))).'%"))';
       //print_r("Строка поиска '".$_GET['search']."'");
      };
    //echo (" search case=".$search_value);
    $sql = "SELECT c.*, DATEDIFF(NOW(),created) when_created, DATEDIFF(NOW(),updated) when_updated,  ".
    " case when archived then 'Да' when not archived then 'Нет' else '' end archived_text, ".
    " case when answered then 'Да' when not answered then 'Нет' else '' end sanswered ".
    " FROM contacts c ".$archived_value.$search_value. ' order by created desc';
    foreach ($db->query($sql) as $row) {
    echo '<td> <a href="update_contact.php/?id='.$row['id'].'">'.$row['id'].'</td>';
    echo "<td>".$row['company_name'] . "</td>";
    echo "<td>".$row['contact_person'] . "</td>";
    echo "<td>".$row['comment'] . "</td>";
    echo "<td>".substr($row['email'],0,20)."<br>".substr($row['email'],20,40)."</td>";
    echo "<td>".$row['phone'] . "</td>";
    echo "<td>".$row['position_source'] . "</td>";
    echo "<td>".$row['position_name']. "</td>";
    if (empty($row['position_link'])) {
    echo '<td>---</td>'."\n";
        }
    else {
        echo '<td><a href = "'.$row['position_link'].'" target="_blank">'.substr($row['position_link'],0,40).'<br>'.substr($row['position_link'],40,40).'</td>';
        };
    echo "<td>".$row['sanswered'] . "</td>"."\n";
    if (empty($row['answer_text'])) 
       {
       echo '<td>---</td>'."\n";
       }
    else 
      {
        echo '<td>'.substr($row['answer_text'],0,40).'<br>'.substr($row['answer_text'],40,40).'</td>';
      };
    if ($row['when_created']==0) {
      echo '<td>Сегодня</td>'."\n";
          }
    else {
      echo "<td>".$row['when_created'] . " дней</td>";
      };
    if ($row['when_updated']==0) {
        echo '<td></td>'."\n";
            }
      else {
        echo "<td>".$row['when_updated'] . " дней</td>";
        };
    echo "<td>".$row['archived_text'] . "</td>"."\n";
    echo "<td>".substr($row['position_description'],0,100) . "</td>"."\n";
    echo "</tr>";
}
echo "</table>";

$database->closeConnection();
}

catch (PDOException $e)
{
    echo "There is some problem in connection: " . $e->getMessage();
}
?>
</body>
</html>
