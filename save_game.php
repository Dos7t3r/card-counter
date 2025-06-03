<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => '只允许POST请求']);
    exit;
}

try {
    // 获取POST数据
    $input = file_get_contents('php://input');
    $requestData = json_decode($input, true);

    if (!$requestData) {
        throw new Exception('无效的请求数据');
    }

    // 检查是否是更新历史记录的请求
    if (isset($requestData['action']) && $requestData['action'] === 'update_history') {
        $gameHistory = $requestData['history'];
    
        // 确保data目录存在
        $dataDir = __DIR__ . '/data';
        if (!is_dir($dataDir)) {
            mkdir($dataDir, 0755, true);
        }
    
        $dataFile = $dataDir . '/data.json';
    
        // 保存更新后的历史记录
        $result = file_put_contents($dataFile, json_encode($gameHistory, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    
        if ($result === false) {
            throw new Exception('更新历史记录失败');
        }
    
        echo json_encode([
            'success' => true,
            'message' => '历史记录已更新',
            'total_records' => count($gameHistory)
        ]);
        exit;
    }

    // 原有的保存游戏数据逻辑
    $gameData = $requestData;
    
    if (!$gameData) {
        throw new Exception('无效的游戏数据');
    }
    
    // 确保data目录存在
    $dataDir = __DIR__ . '/data';
    if (!is_dir($dataDir)) {
        mkdir($dataDir, 0755, true);
    }
    
    $dataFile = $dataDir . '/data.json';
    
    // 读取现有数据
    $gameHistory = [];
    if (file_exists($dataFile)) {
        $existingData = file_get_contents($dataFile);
        $gameHistory = json_decode($existingData, true);
        if (!is_array($gameHistory)) {
            $gameHistory = [];
        }
    }
    
    // 添加新游戏数据到开头
    array_unshift($gameHistory, $gameData);
    
    // 只保留最近50条记录
    if (count($gameHistory) > 50) {
        $gameHistory = array_slice($gameHistory, 0, 50);
    }
    
    // 保存更新后的数据
    $result = file_put_contents($dataFile, json_encode($gameHistory, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    
    if ($result === false) {
        throw new Exception('保存文件失败');
    }
    
    echo json_encode([
        'success' => true,
        'message' => '游戏数据已保存',
        'total_records' => count($gameHistory)
    ]);
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>
