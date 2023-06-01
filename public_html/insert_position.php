<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>Job search</title>
  </head>
  <body>    
<h2>Добавление нового контакта (лида)</h2>

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
-->
<form action="do_insert_position.php" method="post">
<table>
  <tr>
    <td><label for="comment">Комментарий</label></td>
    <td><input type="text" id = "comment" name="comment" value=""></td>
  </tr>
  <tr>
    <td><label for="company_name">Компания</label></td>
    <td><input type="text" id = "company_name" name="company_name" value=""></td>
  </tr>
  <tr>
    <td><label for="contact_person">Контакное лицо</label></td>
    <td><input type="text" id = "contact_person" name="contact_person" value=""></td>
  </tr>
  <tr>
    <td>  <label for="email">Email</label></td>
    <td><input type="email" id = "email" name="email" value=""></td>
  </tr>
  <tr>
    <td><label for="phone">Phone</label></td>
    <td><input type="tel" id = "phone" name="phone" value=""></td>
  </tr>
  <tr>
    <td><label for="position_source">Источник вакансии</label><br></td>
    <td>	
      <input type="radio" name="position_source" id="position_source" value="linkedin">
      <label>Linkedin</label><br>
      <input type="radio" name="position_source" id="position_source" value="indeed">
      <label>Indeed</label><br>
      <input type="radio" name="position_source" id="position_source" value="glassdoor">
      <label>Glasdoor</label><br>
      <input type="radio" name="position_source" id="position_source" value="dice.com">
      <label>Dice</label><br>
      <input type="radio" name="position_source" id="position_source" value="other">
      <label>Другое</label><br>
    </td>
  </tr>
  <tr>
    <td>Другой источник</td><td><input type="text" id = "position_other_source" name="position_other_source" value=""></td>
  </tr>
  <tr>
    <td><label for="position_link">Линк вакансии</label></td>
    <td><input type="text" id = "position_link" name="position_link" value=""></td>
  </tr>
  <tr>
    <td><label for="position_name">Вакансия кратко</label></td>
    <td><input required type="text" id = "position_name" name="position_name" value=""></td>
  </tr>
  <tr>
    <td><label for="position_description">Вакансия текстом</label></td>
    <td><textarea name="position_description" id = "position_description" cols="80" rows="3"></textarea></td>          
    <td>
    </td>  
  </tr>
  <tr>
    <td align="left"><input type="reset" value="Очистить"></td>
    <td align="right"><input type="submit" value="Отправить"></td>
  </tr>
</table>
</form>
</body>
</html>
