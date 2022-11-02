<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>e-books.com - add</title>
  <link rel='stylesheet' href='css/style.css'>
</head>
<body>
  <main>
    <?php
      function showLogInForm() {
        echo "
          <form class='break_line_form' action='add.php' method='post'>
            <label for='seller'>Seller:</label>
            <input type='text' name='seller' id='seller' required />

            <label for='password'>Password:</label>
            <input type='text' name='password' id='password' required />

            <button type='submit'>Submit</button>
          </form>
        ";
      }

      if (isset($_POST['seller']) && isset($_POST['password'])) {
        require_once '../env.php';
        require_once '../vendor/autoload.php';

        $connection = new Connection\Connection();

        $hash = $_POST['password'];

        for ($i = 0; $i < (int) getenv('rounds'); $i++) {
          $hash = hash('sha512', getenv('passphrase') . $hash);
        }

        $results = $connection->table('sellers')
          ->select()
          ->what('id')
          ->where(['=', 'name', $_POST['seller']], 'AND', ['=', 'password', $hash])
          ->run();

        if (isset($results[0])) {
          echo "
            <form class='break_line_form' action='add.php' method='post'>
              <input type='hidden' name='seller' value='{$_POST['seller']}' />
              <input type='hidden' name='password' value='{$_POST['password']}' />

              <label for='book_name'>Book name:</label>
              <input type='text' name='book_name' id='book_name' required />

              <label for='book_description'>Book description:</label>
              <textarea name='book_description' id='book_description' required></textarea>

              <label for='book_price'>Book price:</label>
              <input type='number' step='.01' name='book_price' id='book_price' required />

              <button type='submit'>Submit</button>
            </form>
          ";

          if (isset($_POST['book_name']) && isset($_POST['book_description']) && isset($_POST['book_price'])) {
            $connection->table('books')
              ->insert()
              ->what('name', 'description', 'price')
              ->values($_POST['book_name'], $_POST['book_description'], $_POST['book_price'])
              ->run();
          }
        }
        else {
          echo "
            <p>Wrong name/password</p>
          ";

          showLogInForm();
        }

        $connection->close();
      }
      else {
        showLogInForm();
      }
    ?>
  </main>
</body>
</html>