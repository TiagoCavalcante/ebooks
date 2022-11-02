<?
  require_once 'env.php';
  require_once 'vendor/autoload.php';

  $connection = new Connection\Connection();
  
  $connection->table('books')
    ->create()
    ->columns([
      'id' => 'INT PRIMARY',
      'name' => 'VARCHAR(255)',
      'description' => 'TEXT',
      'price' => 'DECIMAL (5,2)'
    ])
    ->run();

  $connection->close();
?>