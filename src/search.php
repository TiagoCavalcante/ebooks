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
			require_once '../vendor/autoload.php';

			$connection = new Connection\Connection();

			$name = isset($_GET['name']) ? $_GET['name'] : '';
			$results = $connection->select('books', ['id', 'name', 'price', 'SUBSTRING(description, 1, 75)'], [['LIKE', 'name', "%$name%"]]);
			if (count($results)) {
				foreach ($results as $result) {
					echo '<div class="product">';
					echo "<p><strong>{$result['name']}</strong></p>";
					echo '<p><strong>Price:</strong> ' . number_format($result['price'], 2, ',', '.') . '$</p>';
					# to the last word not be incomplete
					$word = explode(' ', $result['SUBSTRING(description, 1, 75)']);
					array_pop($word);
					echo '<p>' . implode(' ', $word) . ' ...</p>';
					echo "<a href='product.php?id={$result['id']}'>See more</a>";
					echo '</div>';
				}
			}
			else {
				echo "<h1>404</h1><p>Sorry any book was find \u{1F614}</p>";
			}

			$connection->close();
		?>
	</main>

	<?php require_once 'utils/footer.html'?>
</body>
</html>