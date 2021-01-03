<?
	require_once 'api.php';

	$conn = new Connection('localhost', 'root', '', 'bookstore');
	$id = (isset($_GET['id'])) ? $conn->prevent($_GET['id']) : null;
	
	$result = $conn->select("books", "name, price, description", "id = '$id'");
	$dataResult = $conn->nextResult($result);
	if (gettype($dataResult) != "boolean") {
		$name = $dataResult['name'];
	}
	else {
		$name = '404';
	}
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
			if ($id != null && $dataResult != false) {
				echo "<h1><strong>$name</strong></h1>";
				echo "<p><strong>Price:</strong> " . number_format($dataResult['price'], 2, ',', '.') . "$</p>";
				echo "<p>" . $dataResult['description'] . "</p>";
				echo "</div>";
			}
			else {
				echo "<h1>404</h1><p>Sorry we didn't find this page \u{1F614}</p>";
			}
			$conn->close();
		?>
	</main>

	<?php require_once 'utils/footer.html'?>
</body>
</html>
