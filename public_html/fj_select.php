<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <title>Job search</title>
  </head>
<script type="text/javascript">
  /* <![CDATA[ */
   function externalLinks() {
    links = document.getElementsByTagName("a");
    for (i=0; i<links.length; i++) {
      link = links[i];
      if (link.getAttribute("href") && link.getAttribute("rel") == "external")
      link.target = "_blank";
    }
   }
   window.onload = externalLinks;
  /* ]]> */ 
 </script>  <body>    
<h1>Список вакансий</h1>
<?php 
//print_r($_GET);
?>
<table>
  <tr>  
  <td>
  <button><img src="fj_images/insert.png" style="vertical-align: middle" > <a href="fj_insert_position.php">Добавить вакансию</a></button>
  </td>
  <form action="/fj_select.php" method="get">
  <td><label for="search">Поиск</label></td>
  <?php
  if (!isset($_GET['search'])) {
      echo '<td><input type="text" id = "search" name="search" value=""></td>';
    }
  else {
      echo '<td><input type="text" id = "search" name="search" value="'.$_GET['search'].'"></td>';
  }
  
  ?>
  <td align="right"><input type="submit" value="Искать"></td>
  <td>
  <a href="/fj_select.php?archived=-1">все</a><p>
  <a href="/fj_select.php?archived=1">архив - </a><p>
  <a href="/fj_select.php?archived=0">архив +</a>  
  </td>
</form>
  <td>
  <button><a href="/fj_job_sites.php">Резюме на <br>сайты работы</a><img src="fj_images/kaska.png" style="vertical-align: middle" ></button>
  </td>
  <td>
  <button><a href="/fj_freelance_sites.php">Сайты фриланса</a><img src="fj_images/freelancehunt.svg" style="vertical-align: middle"></button>
  </td>
  <td>
  <button><a href="/fj_stats.php">Статистика</a><img src="fj_images/stats.png" style="vertical-align: middle" width="40" height="40" ></button>
  </td>
</tr>
<!--select 
id 
comment,
company_name,
contact_person,
email,
phone,
position_name,
position_description,	
position_source
from positions
where archived is false
-->
<table rules="all">
  <thead>
    <tr>
      <th>Вакансия</th>
      <th>Компания</th>
      <th>Ручная<br>оценка</th>
      <th>Расчётная<br>оценка </th>
      <th>Оплата<br>ставка</th>
      <th>Контакт</th>
      <th>Мой комментарий</th>
      <th>email</th>
      <th>phone</th>
      <th>Город</th>
      <th>Источник<br>вакансии</th>
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
include_once 'fj_connection.php';
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
    else {$archived_value = "";}  
    $search_value = '';
    if (isset($_GET['search']) and (trim($_GET['search'])!="") )
      {$search_value = 'and (lower(concat(ifnull(company_name,""),ifnull(comment,""), ifnull(contact_person,""),ifnull(email,""),ifnull(phone,""),ifnull(position_link,""),ifnull(position_name,"") )) like lower("%'.htmlentities(trim(($_GET['search']))).'%"))';
       //print_r("Строка поиска '".$_GET['search']."'");
      };
    //echo (" search case=".$search_value);
    $sql = "SELECT c.*, DATEDIFF(NOW(),created) when_created, DATEDIFF(NOW(),updated) when_updated,  ".
    " case when archived then 'Да' when not archived then 'Нет' else '' end archived_text, ".
    " case when answered then 'Да' when not answered then 'Нет' else '' end sanswered ".
    " FROM positions c ".$archived_value.$search_value. ' order by created desc';
    $query = $db->query($sql);
    //if ($result != null) {
    while ($row = $query->fetch()) {
      echo '<td> <a href="fj_update_position.php/?id='.$row['id'].'">'.$row['position_name'];
      if (!empty($row['position_link'])) {
      echo '<a href="'.$row['position_link'].'" rel="external"> <img src="fj_images/new_window.png"></a>'.'</td>';
      };
    //}
      echo '</td>';
    
    echo "<td>".$row['company_name'] . "</td>";
    echo "<td>".$row['manual_rank'] . "</td>";
    echo "<td>".$row['automatic_rank'] . "</td>";
    echo "<td>".$row['rate'] . "</td>";
    echo "<td>".$row['contact_person'] . "</td>";
    echo "<td>".$row['comment'] . "</td>";
    echo "<td>".substr($row['email'],0,20)."<br>".substr($row['email'],20,40)."</td>";
    if (strlen($row['phone'])==0)
      {echo "<td></td>";}
    elseif (is_numeric($row['phone']))
      {
      echo "<td>#".$row['phone'] . "</td>";
      }
    else {
      echo "<td><a href=".$row['phone'].' target="_blank" rel="external">'.substr($row['phone'],0,16).' </a>'.'</td>';
    };  
    echo "<td>".$row['company_city'] . "</td>";
    echo "<td>".$row['position_source'] . "</td>";
    echo "<td>".$row['sanswered'] . "</td>"."\n";
    if (empty($row['answer_text'])) 
       {
       echo '<td></td>'."\n";
       }
    else 
      {
        echo '<td>'.substr($row['answer_text'],0,40).'</td>';
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
