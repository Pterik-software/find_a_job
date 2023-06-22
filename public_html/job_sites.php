<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>Job sites</title>
  </head>
  <body>    
<h2>Список сайтов работы</h2>
<table rules="all">
  <thead>
    <tr>
      <th>Сайт</th>
      <th>Резюме обновлено</th>
      <th>Архив</th>
      <th>Создано</th>
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
    if (isset($_GET['site_search']) and (trim($_GET['site_search'])!="") )
      {$search_value = ' and lower(ifnull(site_name,"")) like lower("%'.htmlentities(trim(($_GET['site_search']))).'%") ';
       print_r("Строка поиска '".$_GET['site_search']."'");
      };
    //echo (" search case=".$search_value);
    $sql = "SELECT id, site_name, created, updated, archived,".
    " DATEDIFF(NOW(),created) when_created, DATEDIFF(NOW(),updated) when_updated,  ".
    "     case when archived then 'Да' when not archived then 'Нет' else '' end archived_text ".
    "     FROM job_sites s order by created desc";
    foreach ($db->query($sql) as $row) {
      if (empty($row['site_link'])) {
        echo '<td> <a href="update_job_sites.php/?id='.$row['id'].'">'.$row['site_name'];
        echo '</td>';
      }
      else {
        echo '<td> <a href="update_job_sites.php/?id='.$row['id'].'">'.$row['site_name'];
        echo '<a href="'.$row['site_link'].'" rel="external"> <img src="images/new_window.png"></a>'.'</td>';
      };
    if ($row['when_updated']==0) {
        echo '<td>Сегодня</td>'."\n";
            }
      else {
        echo "<td>".$row['when_updated'] . " дней</td>";
        };
    echo "<td>".$row['archived_text'] . "</td>"."\n";
    if ($row['when_created']==0) {
      echo '<td>Сегодня</td>'."\n";
          }
    else {
      echo "<td>".$row['when_created'] . " дней</td>";
      };
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