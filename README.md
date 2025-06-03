# 抽卡游戏记录系统

一个基于 Web 的抽卡游戏记录系统，支持游戏数据记录、统计分析和可视化展示。
<img width="1298" alt="WechatIMG880" src="https://github.com/user-attachments/assets/d3c88d7c-3cad-4242-ad8d-801f3ae80e8e" />
<img width="1307" alt="WechatIMG881" src="https://github.com/user-attachments/assets/b6ebb116-6e1e-4ddf-a2fd-c0006d964ab3" />
<img width="978" alt="WechatIMG883" src="https://github.com/user-attachments/assets/beebe8fc-9f07-47ac-89fd-37d6e54911f5" />
<img width="901" alt="WechatIMG884" src="https://github.com/user-attachments/assets/81c413e4-f4bd-46e2-8abb-6a11619f0daa" />
<img width="1203" alt="WechatIMG885" src="https://github.com/user-attachments/assets/9caa71cb-ca13-4806-b76f-0a2fcadb896b" />




## 功能特点

### 游戏功能
- 骰子点数路径配置：支持自定义不同点数对应的卡牌路径
- 计分规则配置：可自定义入场费和奖金规则
- 实时游戏记录：记录每局游戏的得分、奖金和盈亏情况
- 动画效果：流畅的动画展示，提升游戏体验

### 数据统计
- 实时数据统计：总游戏次数、平均得分、盈利次数、总盈亏等
- 多维度图表展示：
  - 盈亏比例饼图
  - 盈亏趋势折线图
  - 骰子点数分布图
  - 得分分布条形图
- 历史记录管理：
  - 支持按玩家筛选
  - 支持按盈亏筛选
  - 支持多种排序方式
  - 支持导出 Excel

### 设置管理
- 入场费配置：可自定义游戏入场费
- 奖金规则配置：支持设置不同得分区间的奖金
- 路径配置：可视化配置骰子点数对应的卡牌路径
- 配置导入导出：支持保存和加载自定义配置

## 技术栈

- 前端：HTML5, CSS3, JavaScript
- 图表：Chart.js
- Excel导出：SheetJS
- 后端：PHP
- 数据存储：JSON文件

## 安装说明

1. 环境要求：
   - PHP 7.0 或更高版本
   - Web服务器（Apache/Nginx）
   - 现代浏览器（Chrome/Firefox/Safari/Edge）

2. 安装步骤：
   ```bash
   # 1. 克隆或下载项目到Web服务器目录
   git clone [项目地址]

   # 2. 确保data目录可写
   chmod 777 data

   # 3. 配置Web服务器
   # Apache配置示例：
   <VirtualHost *:80>
       ServerName your-domain.com
       DocumentRoot /path/to/project
       <Directory /path/to/project>
           Options Indexes FollowSymLinks
           AllowOverride All
           Require all granted
       </Directory>
   </VirtualHost>
   ```

3. 访问系统：
   - 打开浏览器访问 `http://your-domain.com`
   - 默认进入游戏主页面

## 使用说明

### 游戏流程
1. 进入游戏页面
2. 支付入场费开始游戏
3. 投掷骰子确定路径
4. 根据路径计算得分
5. 获得相应奖金
6. 查看盈亏结果

### 数据统计
1. 点击"数据统计"进入统计页面
2. 查看总体统计数据
3. 使用筛选功能查看特定数据
4. 导出数据为Excel文件

### 设置管理
1. 点击"设置"进入设置页面
2. 配置入场费和奖金规则
3. 设置骰子点数路径
4. 保存或导出配置

## 文件结构
```
├── index.html          # 游戏主页面
├── statistics.html     # 数据统计页面
├── settings.html       # 设置页面
├── save_game.php      # 保存游戏数据
├── save_settings.php   # 保存设置
├── load_history.php    # 加载历史记录
├── load_settings.php   # 加载设置
├── data/              # 数据存储目录
│   ├── data.json      # 游戏数据
│   └── settings.json  # 设置数据
└── styles/            # 样式文件目录
```

## 配置说明

### 奖金规则
- 0-10分：无奖金
- 11-20分：$5
- 21-40分：$20
- 41-50分：$50
- 51-70分：$100
- 71分以上：$200

### 入场费
- 默认：$20
- 可在设置中修改

## 注意事项

1. 数据安全
   - 定期备份 data 目录下的数据文件
   - 确保 data 目录的写入权限
   - 建议配置服务器访问限制

2. 性能优化
   - 定期清理历史记录
   - 避免过大的数据文件
   - 建议使用缓存机制

3. 浏览器兼容
   - 推荐使用最新版本的现代浏览器
   - 支持响应式设计，适配移动设备

## 更新日志

### v1.0.0 (2024-03-xx)
- 初始版本发布
- 实现基本游戏功能
- 添加数据统计功能
- 支持设置管理

## 贡献指南

1. Fork 项目
2. 创建特性分支
3. 提交更改
4. 推送到分支
5. 创建 Pull Request

## 许可证

MIT License

## 联系方式

如有问题或建议，请提交 Issue 或联系开发者。
