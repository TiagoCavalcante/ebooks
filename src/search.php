<!DOCTYPE html>
<html lang='en'>

<head>
  <meta charset='UTF-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
  <title>e-books.com - Search</title>
  <link href='https://fonts.googleapis.com/icon?family=Material+Icons' rel='stylesheet'>
  <link rel='stylesheet' href='css/style.css'>
</head>

<body>
  <?php require_once 'utils/header.html'?>

  <main>
    <?php
      require_once '../env.php';
      require_once '../vendor/autoload.php';

      $connection = new Connection\Connection();

      $name = $_GET['s'] ?? '';
      $results = $connection->table('books')
        ->select()
        ->what('id', 'name', 'price', 'SUBSTRING(description, 1, 75)')
        ->where(['LIKE', 'name', "%$name%"])
        ->run();

      if (count($results)) {
        foreach ($results as $result) {
          $price = number_format($result['price'], 2, ',', '.');
          # to the last word not be incomplete
          $phrase = explode(' ', $result['SUBSTRING(description, 1, 75)']);
          array_pop($phrase);
          $phrase = implode(' ', $phrase);

          echo "
            <div class='product'>
              <p><strong>{$result['name']}</strong></p>
              <p><strong>Price:</strong> $ $price</p>
              <p>$phrase...</p>
              <p>
                <a href='product.php?id={$result['id']}'>
                  See more
                </a>
              </p>
            </div>
          ";
        }
      }
      else {
        echo "
          <div>
            <h1>404</h1>
            <p>Sorry any book was find \u{1F614}</p>
          </div>
        ";
      }

      $connection->close();
    ?>
  </main>

  <?php require_once 'utils/footer.html'?>
</body>

</html>