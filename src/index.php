<!DOCTYPE html>
<html lang='en'>
<head>
	<meta charset='UTF-8'>
	<meta name='viewport' content='width=device-width, initial-scale=1.0'>
	<title>e-books.com</title>
	<link href='https://fonts.googleapis.com/icon?family=Material+Icons' rel='stylesheet'>
	<link rel='stylesheet' href='css/style.css'>
</head>
<body>
	<?php require_once 'utils/header.html'?>

	<main calss='main-content'>
		<?php
			require_once '../env.php';
			require_once '../vendor/autoload.php';

			$connection = new Connection\Connection();

			$results = $connection->table('books')
				->select()
				->what('id', 'name', 'price', 'SUBSTRING(description, 1, 75)')->run();

			foreach ($results as $result) {
				echo '<div class="product">';
				echo "<p><strong>{$result['name']}</strong></p>";
				echo '<p><strong>Price:</strong> $ ' . number_format($result['price'], 2, ',', '.') . '</p>';
				$word = explode(' ', $result['SUBSTRING(description, 1, 75)']);
				array_pop($word);
				echo '<p>' . implode(' ', $word) . ' ...</p>';
				echo "<a href='product.php?id={$result['id']}'>See more</a>";
				echo '</div>';
			}

			$connection->close();
		?>
	</main>

	<?php require_once 'utils/footer.html'?>
</body>
</html>
