<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode(['error' => '只允许GET请求']);
    exit;
}

try {
    $dataFile = __DIR__ . '/data/data.json';
    
    // 如果文件不存在，返回空数组
    if (!file_exists($dataFile)) {
        echo json_encode([]);
        exit;
    }
    
    // 读取文件内容
    $data = file_get_contents($dataFile);
    $gameHistory = json_decode($data, true);
    
    // 确保返回数组
    if (!is_array($gameHistory)) {
        $gameHistory = [];
    }
    
    echo json_encode($gameHistory);
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>
