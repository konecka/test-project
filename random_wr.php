<?php

header('Content-Type: text/plain; charset=utf-8');

// Функция для получения случайного элемента из массива


function get_random($array)
{
    return $array[rand(0, count($array) - 1)];
}

// список ID торговых представителей
$salesmen = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];

// список ID товаров, здесь задан интервал с 1 по 30
$products = range(1, 30);

// дата начала журнала
$start_date = strtotime('2018-09-05');

// дата конца журнала
$end_date = strtotime('2018-12-25');



// Подготовка данныx

$date = $start_date;

$dbname   = 'accounting_system';
$username = 'root';
$password = '';

$dbo = new PDO("mysql:host=localhost;dbname=".$dbname, $username, $password);
$dbo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

while ($date < $end_date)
{
  $need_count = rand(10, 80); // кол-во продаж за дату 
  $sales = [];

  while(--$need_count)
  {
    $sales[] = [
      'date'        => date('Y-m-d', $date),
      'salesmen_id' => get_random($salesmen),
      'product_id'  => get_random($products),
      'product_count'       => rand(1, 20), // случайное количество проданного товара
    ];

  }

  $rows = [];

  foreach ($sales as $row)
  {
    
    $row["date"] = $row["date"];
    $stmt = $dbo->prepare('INSERT INTO `sales` (`'    . implode('`, `', array_keys($sales[0])) . '`)  VALUES  (:date, :salesmen_id, :product_id, :product_count)');
    $stmt->execute($row);
  }

  $date = strtotime('+1 day', $date);
}



