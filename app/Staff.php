<?php
// header('Content-Type: application/json') ;
// if(!isset($_GET['query'])){
//   echo json_encode([]);
//   exit();
// }
//
// $db = new PDO('mysql:host=127.0.0.1;dbname=website', 'root', '');
//
// $staff = $db->prepare("
//       SELECT staff_name, staff_id
//       FROM staff
//       WHERE staff_name LIKE :query
//       ");
//
// $staff->execute([
//   'query' => "{$_GET['query']}% "
// ]);
//
// echo json_encode($staff->fetchAll());
namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
   protected $table= 'staff';
}
