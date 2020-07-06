<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>e-books.com - Search</title>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<?php require_once 'utils/header.html'?>

	<main>
		<?php
			require_once 'api.php';

			$conn = new Connection('localhost', 'root', '', 'bookstore');
			$name = (isset($_GET['name'])) ? $conn->prevent($_GET['name']) : "";
			$result = $conn->select("books", "id, name, price, SUBSTRING(description, 1, 75)", "name LIKE '%$name%'");
			if ($conn->numRows($result)) {
				while ($dataResult = $conn->nextResult($result)) {
					echo "<div class='product'>";
					echo "<p><strong>" . $dataResult['name'] . "</strong></p>";
					echo "<p><strong>Price:</strong> $ " . number_format($dataResult['price'], 2, ',', '.') . "</p>";
					# to the last word not be incomplete
					$word = explode(" ", $dataResult['SUBSTRING(description, 1, 75)']);
					array_pop($word);
					echo "<p>" . implode(" ", $word) . " ..." . "</p>";
					echo "<a href='product.php?id=" . $dataResult['id'] . "'>See more</a>";
					echo "</div>";
				}
			}
			else {
				echo "<h1>404</h1><p>Desculpe nenhum livro foi encontrado \u{1F614}</p>";
			}
			$conn->close();
		?>
	</main>

	<?php require_once 'utils/footer.html'?>
</body>
</html>