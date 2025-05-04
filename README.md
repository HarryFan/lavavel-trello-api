# Laravel Trello API 專案說明

## 專案主旨

本專案以 Laravel 12 為基礎，實作一套現代化、模組化、可擴充的 Trello 任務管理 API 後端，支援多用戶、看板、清單、卡片、通知等功能。設計重點為：
- 統一風格（Airbnb JavaScript Style Guide）
- 乾淨結構、易維護
- RESTful API 與 Token 認證
- 適合團隊協作與二次開發

## 專案初始化與資料庫遷移

### 安裝相依套件
```bash
composer install
```

### 複製 .env 設定檔並編輯資料庫資訊
```bash
cp .env.example .env
# 編輯 .env 內 DB_* 參數
```

### 產生專案金鑰
```bash
php artisan key:generate
```

### 執行資料庫遷移（建立所有表）
```bash
php artisan migrate
```

### Laravel Sanctum 安裝指令（如需重裝）
```bash
composer require laravel/sanctum
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
```

---

## 常用指令
- 啟動本地伺服器
```bash
php artisan serve
```

- 清除快取
```bash
php artisan config:clear
php artisan cache:clear
```

---

## 主要 API 路由
- 註冊：POST /api/register
- 登入：POST /api/login
- 登出：POST /api/logout
- 看板 CRUD：/api/boards
- 清單 CRUD：/api/lists
- 卡片 CRUD：/api/cards
- 通知設定 CRUD：/api/notification-settings

---

## 風格與規範
- 命名、註解、結構皆依 Airbnb JavaScript Style Guide
- 控制器/模型均採用 JSDoc 註解
- RESTful API 設計
- 統一繁體中文註解

---

如需協助，請聯絡 HarryFan。
