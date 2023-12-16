<?php
session_start();
header('Content-type: text/html; charset=utf-8');
function execPostRequest($url, $data)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data))
    );
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

$partnerCode = 'MOMOBKUN20180529';
$accessKey = 'klm05TvNBzhg7h7j';
$secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
$orderId = time() . "";
$orderInfo = "Thanh toán đơn hàng cho shop mifgois";
$amount = $_SESSION['order_info']['totalPrice'];
$redirectUrl = "http://localhost/migoiweb/handler/xac-nhan-dat-hang.php";
$ipnUrl = "http://localhost/migoiweb/handler/xac-nhan-dat-hang.php";
$extraData = "mifgois";


$requestId = time() . "";
$requestType = "payWithATM";
$extraData = "mifgois";


$rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
$signature = hash_hmac("sha256", $rawHash, $secretKey);


$data = array(
    'partnerCode' => $partnerCode,
    'partnerName' => "Test",
    "storeId" => "MomoTestStore",
    'requestId' => $requestId,
    'amount' => $amount,
    'orderId' => $orderId,
    'orderInfo' => $orderInfo,
    'redirectUrl' => $redirectUrl,
    'ipnUrl' => $ipnUrl,
    'lang' => 'vi',
    'extraData' => $extraData,
    'requestType' => $requestType,
    'signature' => $signature
);

$result = execPostRequest("https://test-payment.momo.vn/v2/gateway/api/create", json_encode($data));

if ($result === false) {
    echo "Lỗi khi gửi yêu cầu POST đến MoMo API.";
} else {
    $jsonResult = json_decode($result, true);

    if (isset($jsonResult['payUrl'])) {
        header('Location: ' . $jsonResult['payUrl']);
    } else {
        echo "Lỗi: Không có payUrl trong kết quả từ MoMo API.";
    }
}


header('Location: ' . $jsonResult['payUrl']);
?>