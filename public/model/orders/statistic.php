<?php
use Carbon\Carbon;
use Carbon\CarbonInterval;
include_once '../../../bootstrap.php';
require '../../Carbon/autoload.php';

if (isset($_POST['time'])) {
    $time = $_POST['time'];
} else {
    $time = '';
    $subday = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();
}

if ($time == '7ngay') {
    $subday = Carbon::now('Asia/Ho_Chi_Minh')->subdays(7)->toDateString();
} elseif ($time == '30ngay') {
    $subday = Carbon::now('Asia/Ho_Chi_Minh')->subdays(30)->toDateString();
} elseif ($time == '90ngay') {
    $subday = Carbon::now('Asia/Ho_Chi_Minh')->subdays(90)->toDateString();
} elseif ($time == '365ngay') {
    $subday = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();
}

$now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

$sql = "SELECT * FROM tbl_thongke WHERE ngaydat BETWEEN ? AND ? ORDER BY ngaydat ASC";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    $subday,
    $now
]);

while ($row = $stmt->fetch()) {
    $char_data[] = array(
        'date' => $row['ngaydat'],
        'order' => $row['donhang'],
        'sales' => $row['doanhthu'],
        'quantity' => $row['soluongban']
    );
}
echo $data = json_encode($char_data);
?>