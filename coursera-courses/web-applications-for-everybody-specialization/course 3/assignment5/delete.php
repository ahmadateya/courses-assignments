<?php
require_once "pdo.php";
require_once "bootstrap.php";
session_start();

if ( isset($_POST['delete']) && isset($_POST['autos_id']) ) {
    $sql = "DELETE FROM autos2 WHERE autos_id = :zip";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':zip' => $_POST['autos_id']));
    $_SESSION['success'] = 'Record deleted';
    header( 'Location: index.php' ) ;
    return;
}

      // Guardian: Make sure that autos_id is present
      if ( ! isset($_GET['autos_id']) ) {
        $_SESSION['error'] = "Missing autos_id";
        header('Location: index.php');
        return;
      }
      $autos_id = $_GET['autos_id'];

      $stmt = $pdo->prepare("SELECT * FROM autos2 where autos_id = :xyz");
      $stmt->execute(array(":xyz" => $autos_id));
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      if ( $row === false ) {
          $_SESSION['error'] = 'Bad value for autos_id';
          header( 'Location: index.php' ) ;
          return;
      }

?>
<!DOCTYPE html>
<html>
<head>
    <title>Ahmad Muhammad Ateya 6f46dd17</title>
</head>
<body>
  <div class="container">
    <p>Confirm: Deleting <?= htmlentities($row['model']) ?></p>

    <form method="post">
        <input type="hidden" name="autos_id" value="<?= $autos_id ?>">
        <input type="submit" value="Delete" name="delete">
        <a href="index.php">Cancel</a>
    </form>
  </div>
</body>
</html>
