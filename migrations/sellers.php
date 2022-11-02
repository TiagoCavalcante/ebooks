<?
  require_once 'env.php';
  require_once 'vendor/autoload.php';

  $connection = new Connection\Connection();
  
  $connection->table('sellers')
    ->create()
    ->columns([
      'id' => 'INT PRIMARY',
      'name' => 'VARCHAR(32)',
      'password' => 'CHAR(128)'
    ])
    ->run();

  if (isset($argv[1])) {
    $hash = $argv[2];

    for ($i = 0; $i < (int) getenv('rounds'); $i++) {
      $hash = hash('sha512', getenv('passphrase') . $hash);
    }

    $connection->table('sellers')
      ->insert()
      ->what('name', 'password')
      ->values($argv[1], $hash)
      ->run();
  }

  $connection->close();
?>