<?php
$login = trim(filter_var($_POST['login'], FILTER_SANITIZE_STRING));
$pass = trim(filter_var($_POST['pass'], FILTER_SANITIZE_STRING));

$error='';
if (strlen($login) <= 3)
$error='Введите логин';
else if (strlen($pass) <= 3)
$error='Введите пароль';

if ($error !=''){
  echo $error;
exit();
}

$hash = "sdsfdlfkdghf44ddsgkfdkfe";
$pass = md5($pass . $hash);

require_once '../mysql_connect.php';


$id = 8;
$sql = 'SELECT `login` ,`id` FROM `levels` WHERE `id` = ?';
$query = $pdo->prepare($sql ) ;
$query->execute([$id]);
$users = $query->fetchAll(PDO::FETCH_OBJ);

foreach ($users as $user) {
  if( $user->login != $login )
    echo 'Попробуйте еще раз';
    else{
      $sql = 'SELECT `levelSQL1` FROM `users` WHERE `login`= :login';
      $query = $pdo->prepare($sql);
      $query->execute(['login' =>$_COOKIE['login']]);
      $user = $query->fetch(PDO::FETCH_OBJ);
      if($user->levelSQL1 == 0)
      {
    $sql = 'SELECT * FROM `users` WHERE `login`= :login';
    $query = $pdo->prepare($sql);
    $query->execute(['login' =>$_COOKIE['login']]);
    $user = $query->fetch(PDO::FETCH_OBJ);
    $user->points=$user->points+70;
    $points=  $user->points;
    $sql = 'UPDATE `users` SET `points` = :points  WHERE `login` =:login';
    $query = $pdo->prepare($sql);
    $query->execute(['points'=>$points , 'login'=>$_COOKIE['login']]);


      $levelSQL1= '1';
      $sql = 'UPDATE `users` SET `levelSQL1` = :levelSQL1  WHERE `login` =:login';
      $query = $pdo->prepare($sql);
      $query->execute(['levelSQL1'=>$levelSQL1 , 'login'=>$_COOKIE['login']]);

    }
          echo 'Готово';
        }
}


?>