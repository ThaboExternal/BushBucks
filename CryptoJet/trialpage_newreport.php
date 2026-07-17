<!DOCTYPE html>
<html>
<body>

<h2>New Report </h2>

<form>
<table>
    <tr>
      <td align="right">Type:</td>
      <td align="left"><select name="type" id="type">
    <option value="Transaction History">Transaction History</option>
    <option value="Merchant Order History">Merchant Order History</option>
   </select></td>
    </tr>
    <tr>
      <td align="right">Time Range:</td>
      <td align="left"><select name="time" id="time">
    <option value="Past 7 days">Past 7 days</option>
    <option value="Past 30 days">Past 30 days</option>
    </select></td>
    </tr>
    <tr>
      <td align="right">Email:</td>
      <td align="left"><input type="text" name="email" /></td>
    </tr>
    <tr>
      <td align="right">Repeat:</td>
      <td align="left"> <select name="repeat" id="repeat">
    <option value="Weekly">Weekly</option>
    <option value="Monthly">Monthly</option>
    <option value="Yearly">Yearly</option>
   </select></td>
    </tr>
      <tr>
      <td align="right">Starting:</td><br>
      <td align="left"> <input type="radio" id="Now" name="fav_language" value="Now">
  <label for="Now">Now</label><br>
<input type="radio" id="time" name="fav_language" value="time">
    <input type="date" id="date" name="date">
    <input type="time" id="time" name="time"
       min="09:00" max="18:00" required></td>
    </tr>
   
  </table>
</form>

  
  <input type="submit" value="Create">


  
 

  

</body>
</html>