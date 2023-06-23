<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <title>Job statistics</title>
  </head>
<body>    
<h1>Статистика по дням</h1>
<?php 
//print_r($_GET);
?>
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
<table cellspacing="2" border="1" cellpadding="5" width="300" stats="all">
  <thead>
    <tr>
      <th>Дата</th>
      <th>Обновлено<br>вакансий</th>
    </tr>
  </thead>  

<?php
include_once 'fj_connection.php';
try
{
    $database = new Connection();
    $db = $database->openConnection();
    $sql = ' SELECT count(*) as cntr, date(updated) as trunc_updated FROM positions c WHERE datediff(now(), created)<60 GROUP BY trunc_updated ORDER BY trunc_updated DESC ';

    $query = $db->query($sql);
    //if ($result != null) {
    while ($row = $query->fetch()) {
        echo "<tr>";
        echo "<td align = 'right'>".$row['trunc_updated'] . "</td>";
        echo "<td align = 'right'>".$row['cntr'] . "</td>";
        echo "</tr>";
    }
echo "</table>";
echo '<form action="/fj_select.php" method="post">';
echo '  <input type="submit" value="На главную">';
echo '</form>';
$database->closeConnection();
}

catch (PDOException $e)
{
    echo "There is some problem in connection: " . $e->getMessage();
}
?>
</body>
</html>
