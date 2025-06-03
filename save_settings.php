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
    $settings = json_decode($input, true);
    
    if (!$settings) {
        throw new Exception('无效的设置数据');
    }
    
    // 添加时间戳
    $settings['last_updated'] = date('c');
    
    // 确保data目录存在
    $dataDir = __DIR__ . '/data';
    if (!is_dir($dataDir)) {
        mkdir($dataDir, 0755, true);
    }
    
    $settingsFile = $dataDir . '/settings.json';
    
    // 保存设置
    $result = file_put_contents($settingsFile, json_encode($settings, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    
    if ($result === false) {
        throw new Exception('保存设置文件失败');
    }
    
    echo json_encode([
        'success' => true,
        'message' => '设置已保存'
    ]);
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>
