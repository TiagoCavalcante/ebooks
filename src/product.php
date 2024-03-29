<?
  require_once '../env.php';
  require_once '../vendor/autoload.php';

  $connection = new Connection\Connection();
  $id = isset($_GET['id']) ? intval($_GET['id']) : -1;
  
  $result = $connection->table('books')
    ->select()
    ->what('name', 'price', 'description')
    ->where(['=', 'id', $id])
    ->run();

  $result = count($result) ? $result[0] : null;
  $name = ($result == null) ? '404' : $result['name'];

  $connection->close();
?>

<!DOCTYPE html>
<html lang='en'>

<head>
  <meta charset='UTF-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
  <title>e-books.com - <?=$name?></title>
  <link href='https://fonts.googleapis.com/icon?family=Material+Icons' rel='stylesheet'>
  <link rel='stylesheet' href='css/style.css'>
</head>

<body>
  <?php require_once 'utils/header.html'?>

  <main>
    <?php
      if ($id != -1 && $result != null) {
        $price = number_format($result['price'], 2, ',', '.');
        echo "
          <div>
            <h1><strong>$name</strong></h1>
            <p><strong>Price:</strong> $ $price
            <p>{$result['description']}</p>
          '</div>
        ";
      }
      else {
        echo "
          <div>
            <h1>404</h1>
            <p>Sorry we didn't find this page \u{1F614}</p>
          </div>
        ";
      }
    ?>
  </main>

  <?php require_once 'utils/footer.html'?>
</body>

</html>