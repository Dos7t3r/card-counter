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
    $settingsFile = __DIR__ . '/data/settings.json';
    
    // 如果文件不存在，返回默认设置
    if (!file_exists($settingsFile)) {
        $defaultConfig = [
            'paths' => [
                1 => [0, 1, 2], // 第一行
                2 => [3, 4, 5], // 第二行
                3 => [6, 7, 8], // 第三行
                4 => [0, 3, 6], // 第一列
                5 => [1, 4, 7], // 第二列
                6 => [2, 5, 8]  // 第三列
            ],
            'reward_ranges' => [
                ['min' => -30, 'max' => -20, 'reward' => 0],
                ['min' => -19, 'max' => -10, 'reward' => 5],
                ['min' => -9, 'max' => 0, 'reward' => 10],
                ['min' => 1, 'max' => 10, 'reward' => 15],
                ['min' => 11, 'max' => 20, 'reward' => 20],
                ['min' => 21, 'max' => 30, 'reward' => 25]
            ],
            'entry_fee' => 10,          // 入场费
            'animation_duration' => 1000 // 动画持续时间（毫秒）
        ];
        
        // 创建目录并保存默认设置
        $dataDir = dirname($settingsFile);
        if (!is_dir($dataDir)) {
            mkdir($dataDir, 0755, true);
        }
        file_put_contents($settingsFile, json_encode($defaultConfig, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        
        echo json_encode($defaultConfig);
        exit;
    }
    
    // 读取设置文件
    $data = file_get_contents($settingsFile);
    $settings = json_decode($data, true);
    
    if (!$settings) {
        throw new Exception('设置文件格式错误');
    }
    
    echo json_encode($settings);
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>
