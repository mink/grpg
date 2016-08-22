<?
include 'header.php';

if (isset($_POST['submit'])) {

  $avatar = $_POST["avatar"];
  $quote = $_POST["quote"];
  //insert the values
  if (!isset($message)){
    $result= mysql_query("UPDATE `grpgusers` SET `avatar`='".$avatar."', `quote`='".$quote."' WHERE `id`='".$user_class->id."'");
    echo Message('Your preferences have been saved.');
    
	die();
  }
}
?>
<?
if (isset($message)) {
echo Message($message);
}
?>
<tr><td class="contenthead">
Account Preferences
</td></tr>
<tr><td class="contentcontent">
<form name='login' method='post'>
  <table width='50%' border='0' align='center' cellpadding='0' cellspacing='0'>
  	<tr>
      <td height='28'><font size='2' face='verdana'>Avatar Image Location&nbsp;&nbsp;&nbsp;</font></td>
      <td><font size='2' face='verdana'>
        <input type='text' name='avatar' value='<?= $user_class->avatar ?>'>
        </font></td>
    </tr>
    <tr>
    <tr>
      <td height='28' align="right"><font size='2' face='verdana'>Quote&nbsp;&nbsp;&nbsp;</font></td>
      <td><font size='2' face='verdana'>
        <input type='text' name='quote' value='<?= $user_class->quote ?>'>
        </font></td>
    </tr>
      <td>&nbsp;</td>
      <td><font size='2' face='verdana'>
        <input type='submit' name='submit' value='Save Preferences'>
        </font></td>
    </tr>
</table>
</form>
<?
include 'footer.php';
?>