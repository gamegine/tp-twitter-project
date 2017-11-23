<?php 
session_start();
include("asset/bdd.php");
include("asset/session.php");
?>
<!doctype html>
<html lang="fr">
  <?php include("./asset/head.php"); ?>
<body>
  <?php include("./asset/header.php"); ?>
  <main>
    <?php echo (!empty($_SESSION['msg']))? "<div>". $_SESSION['msg']."</div>":''; ?>
    <form>
      <legend>login</legend>
      <label for="uname">user name:</label><br>
      <input type="text" name="uname" <?php echo (!empty($_SESSION['formname']))? 'value="'.$_SESSION['formname'].'"':''; ?>>
      <br>
      <label for="uname">password:</label><br>
      <input type="password" name="passw">
      <input type="hidden" name="a" value="l">
      <input type="submit" value="Submit">
    </form>
    <form>
      <legend>register</legend>
      <label for="uname">user name:</label><br>
      <input type="text" name="uname" <?php echo (!empty($_SESSION['formname']))? 'value="'.$_SESSION['formname'].'"':''; ?>>
      <br>
      <label for="uname">password:</label><br>
      <input type="password" name="passw">
      <input type="hidden" name="a" value="r">
      <input type="submit" value="Submit">
    </form>
  </main>
  <?php include("./asset/footer.php"); ?>
</body>
</html>
