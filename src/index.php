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
			require_once 'api.php';

			$conn = new Connection('localhost', 'root', '', 'bookstore');
			$result = $conn->select("books", "id, name, price, SUBSTRING(description, 1, 75)");
			while ($res = $result->fetch_assoc()) {
				echo "<div class='product'>";
				echo "<p><strong>" . $res['name'] . "</strong></p>";
				echo "<p><strong>Price:</strong> $ " . number_format($res['price'], 2, ',', '.') . "</p>";
				$word = explode(" ", $res['SUBSTRING(description, 1, 75)']);
				array_pop($word);
				echo "<p>" . implode(" ", $word) . " ..." . "</p>";
				echo "<a href='product.php?id=" . $res['id'] . "'>See more</a>";
				echo "</div>";
			}
			$conn->close();
		?>
	</main>

	<?php require_once 'utils/footer.html'?>
</body>
</html>
