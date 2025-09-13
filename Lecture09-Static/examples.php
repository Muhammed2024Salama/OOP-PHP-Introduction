<?php
/**
 * المحاضرة التاسعة: أمثلة على الخصائص والطرق الثابتة
 * 
 * هذا الملف يحتوي على أمثلة متنوعة لشرح مفهوم Static Properties and Methods
 */

echo "<h1>المحاضرة التاسعة: الخصائص والطرق الثابتة (Static)</h1>\n";

// ==========================================
// مثال 1: نظام إدارة المستخدمين مع Static
// ==========================================
echo "<h2>مثال 1: نظام إدارة المستخدمين</h2>\n";

class UserManager {
    private static $users = [];
    private static $nextId = 1;
    private static $totalUsers = 0;
    private static $activeUsers = 0;
    private static $createdAt;
    
    public static function initialize() {
        self::$createdAt = date('Y-m-d H:i:s');
        echo "🏗️ <strong>تم تهيئة نظام إدارة المستخدمين</strong><br>";
    }
    
    public static function createUser($name, $email) {
        $user = [
            'id' => self::$nextId++,
            'name' => $name,
            'email' => $email,
            'isActive' => true,
            'createdAt' => date('Y-m-d H:i:s')
        ];
        
        self::$users[] = $user;
        self::$totalUsers++;
        self::$activeUsers++;
        
        echo "✅ <strong>تم إنشاء مستخدم جديد:</strong> " . $name . " (ID: " . $user['id'] . ")<br>";
        return $user['id'];
    }
    
    public static function getUser($id) {
        foreach (self::$users as $user) {
            if ($user['id'] == $id) {
                return $user;
            }
        }
        return null;
    }
    
    public static function updateUser($id, $name, $email) {
        foreach (self::$users as &$user) {
            if ($user['id'] == $id) {
                $user['name'] = $name;
                $user['email'] = $email;
                $user['updatedAt'] = date('Y-m-d H:i:s');
                echo "✅ <strong>تم تحديث المستخدم:</strong> " . $name . "<br>";
                return true;
            }
        }
        return false;
    }
    
    public static function deactivateUser($id) {
        foreach (self::$users as &$user) {
            if ($user['id'] == $id && $user['isActive']) {
                $user['isActive'] = false;
                $user['deactivatedAt'] = date('Y-m-d H:i:s');
                self::$activeUsers--;
                echo "✅ <strong>تم إلغاء تفعيل المستخدم:</strong> " . $user['name'] . "<br>";
                return true;
            }
        }
        return false;
    }
    
    public static function activateUser($id) {
        foreach (self::$users as &$user) {
            if ($user['id'] == $id && !$user['isActive']) {
                $user['isActive'] = true;
                $user['activatedAt'] = date('Y-m-d H:i:s');
                self::$activeUsers++;
                echo "✅ <strong>تم تفعيل المستخدم:</strong> " . $user['name'] . "<br>";
                return true;
            }
        }
        return false;
    }
    
    public static function getAllUsers() {
        return self::$users;
    }
    
    public static function getActiveUsers() {
        return array_filter(self::$users, function($user) {
            return $user['isActive'];
        });
    }
    
    public static function getInactiveUsers() {
        return array_filter(self::$users, function($user) {
            return !$user['isActive'];
        });
    }
    
    public static function getTotalUsers() {
        return self::$totalUsers;
    }
    
    public static function getActiveUsersCount() {
        return self::$activeUsers;
    }
    
    public static function getInactiveUsersCount() {
        return self::$totalUsers - self::$activeUsers;
    }
    
    public static function getStatistics() {
        return [
            'totalUsers' => self::$totalUsers,
            'activeUsers' => self::$activeUsers,
            'inactiveUsers' => self::$totalUsers - self::$activeUsers,
            'systemCreatedAt' => self::$createdAt,
            'nextId' => self::$nextId
        ];
    }
    
    public static function clearAllUsers() {
        self::$users = [];
        self::$nextId = 1;
        self::$totalUsers = 0;
        self::$activeUsers = 0;
        echo "🗑️ <strong>تم مسح جميع المستخدمين</strong><br>";
    }
    
    public static function exportUsers() {
        return json_encode(self::$users, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }
    
    public static function importUsers($jsonData) {
        $users = json_decode($jsonData, true);
        if ($users) {
            self::$users = $users;
            self::$totalUsers = count($users);
            self::$activeUsers = count(array_filter($users, function($user) {
                return $user['isActive'];
            }));
            self::$nextId = max(array_column($users, 'id')) + 1;
            echo "📥 <strong>تم استيراد المستخدمين بنجاح</strong><br>";
            return true;
        }
        return false;
    }
}

// استخدام نظام إدارة المستخدمين
echo "<h3>استخدام نظام إدارة المستخدمين:</h3>\n";

UserManager::initialize();

$userId1 = UserManager::createUser("أحمد محمد", "ahmed@example.com");
$userId2 = UserManager::createUser("فاطمة علي", "fatima@example.com");
$userId3 = UserManager::createUser("محمد أحمد", "mohammed@example.com");

echo "<h4>إحصائيات المستخدمين:</h4>\n";
echo "إجمالي المستخدمين: " . UserManager::getTotalUsers() . "<br>";
echo "المستخدمين النشطين: " . UserManager::getActiveUsersCount() . "<br>";
echo "المستخدمين غير النشطين: " . UserManager::getInactiveUsersCount() . "<br>";

$user = UserManager::getUser($userId1);
echo "<h4>معلومات المستخدم الأول:</h4>\n";
echo "الاسم: " . $user['name'] . "<br>";
echo "الإيميل: " . $user['email'] . "<br>";
echo "الحالة: " . ($user['isActive'] ? "نشط" : "غير نشط") . "<br>";

UserManager::deactivateUser($userId1);
echo "المستخدمين النشطين: " . UserManager::getActiveUsersCount() . "<br>";

UserManager::activateUser($userId1);
echo "المستخدمين النشطين: " . UserManager::getActiveUsersCount() . "<br>";

$stats = UserManager::getStatistics();
echo "<h4>إحصائيات النظام:</h4>\n";
echo "إجمالي المستخدمين: " . $stats['totalUsers'] . "<br>";
echo "المستخدمين النشطين: " . $stats['activeUsers'] . "<br>";
echo "المستخدمين غير النشطين: " . $stats['inactiveUsers'] . "<br>";
echo "تاريخ إنشاء النظام: " . $stats['systemCreatedAt'] . "<br>";
echo "المعرف التالي: " . $stats['nextId'] . "<br><br>";

// ==========================================
// مثال 2: نظام التخزين المؤقت مع Static
// ==========================================
echo "<h2>مثال 2: نظام التخزين المؤقت</h2>\n";

class Cache {
    private static $cache = [];
    private static $maxSize = 100;
    private static $hits = 0;
    private static $misses = 0;
    private static $createdAt;
    private static $lastCleanup;
    
    public static function initialize() {
        self::$createdAt = date('Y-m-d H:i:s');
        self::$lastCleanup = date('Y-m-d H:i:s');
        echo "🏗️ <strong>تم تهيئة نظام التخزين المؤقت</strong><br>";
    }
    
    public static function set($key, $value, $ttl = 3600) {
        // إزالة العناصر المنتهية الصلاحية
        self::cleanExpired();
        
        // التحقق من حجم التخزين المؤقت
        if (count(self::$cache) >= self::$maxSize) {
            self::removeOldest();
        }
        
        self::$cache[$key] = [
            'value' => $value,
            'expires' => time() + $ttl,
            'created' => time(),
            'accessCount' => 0
        ];
        
        echo "✅ <strong>تم حفظ العنصر في التخزين المؤقت:</strong> " . $key . "<br>";
    }
    
    public static function get($key) {
        if (isset(self::$cache[$key])) {
            $item = self::$cache[$key];
            
            // التحقق من انتهاء الصلاحية
            if (time() < $item['expires']) {
                self::$cache[$key]['accessCount']++;
                self::$hits++;
                echo "✅ <strong>تم العثور على العنصر في التخزين المؤقت:</strong> " . $key . "<br>";
                return $item['value'];
            } else {
                // إزالة العنصر المنتهي الصلاحية
                unset(self::$cache[$key]);
            }
        }
        
        self::$misses++;
        echo "❌ <strong>لم يتم العثور على العنصر في التخزين المؤقت:</strong> " . $key . "<br>";
        return null;
    }
    
    public static function has($key) {
        return self::get($key) !== null;
    }
    
    public static function delete($key) {
        if (isset(self::$cache[$key])) {
            unset(self::$cache[$key]);
            echo "🗑️ <strong>تم حذف العنصر من التخزين المؤقت:</strong> " . $key . "<br>";
            return true;
        }
        return false;
    }
    
    public static function clear() {
        self::$cache = [];
        self::$hits = 0;
        self::$misses = 0;
        echo "🗑️ <strong>تم مسح التخزين المؤقت</strong><br>";
    }
    
    public static function getSize() {
        return count(self::$cache);
    }
    
    public static function getMaxSize() {
        return self::$maxSize;
    }
    
    public static function setMaxSize($size) {
        self::$maxSize = $size;
        echo "⚙️ <strong>تم تحديث الحد الأقصى للحجم إلى:</strong> " . $size . "<br>";
    }
    
    public static function getStatistics() {
        $total = self::$hits + self::$misses;
        $hitRate = $total > 0 ? (self::$hits / $total) * 100 : 0;
        
        return [
            'hits' => self::$hits,
            'misses' => self::$misses,
            'hitRate' => round($hitRate, 2) . '%',
            'size' => self::getSize(),
            'maxSize' => self::getMaxSize(),
            'createdAt' => self::$createdAt,
            'lastCleanup' => self::$lastCleanup
        ];
    }
    
    public static function getAllKeys() {
        return array_keys(self::$cache);
    }
    
    public static function getMostAccessed() {
        $items = self::$cache;
        uasort($items, function($a, $b) {
            return $b['accessCount'] - $a['accessCount'];
        });
        return array_slice($items, 0, 5, true);
    }
    
    public static function exportCache() {
        return json_encode(self::$cache, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }
    
    private static function cleanExpired() {
        $now = time();
        $cleaned = 0;
        foreach (self::$cache as $key => $item) {
            if ($now >= $item['expires']) {
                unset(self::$cache[$key]);
                $cleaned++;
            }
        }
        if ($cleaned > 0) {
            self::$lastCleanup = date('Y-m-d H:i:s');
            echo "🧹 <strong>تم تنظيف العناصر المنتهية الصلاحية:</strong> " . $cleaned . " عنصر<br>";
        }
    }
    
    private static function removeOldest() {
        if (empty(self::$cache)) {
            return;
        }
        
        $oldestKey = null;
        $oldestTime = time();
        
        foreach (self::$cache as $key => $item) {
            if ($item['created'] < $oldestTime) {
                $oldestTime = $item['created'];
                $oldestKey = $key;
            }
        }
        
        if ($oldestKey !== null) {
            unset(self::$cache[$oldestKey]);
            echo "🗑️ <strong>تم إزالة أقدم عنصر:</strong> " . $oldestKey . "<br>";
        }
    }
}

// استخدام نظام التخزين المؤقت
echo "<h3>استخدام نظام التخزين المؤقت:</h3>\n";

Cache::initialize();

Cache::set("user:1", ["name" => "أحمد", "email" => "ahmed@example.com"], 300);
Cache::set("user:2", ["name" => "فاطمة", "email" => "fatima@example.com"], 300);
Cache::set("config:app", ["version" => "1.0", "debug" => true], 3600);
Cache::set("data:products", ["product1", "product2", "product3"], 600);

echo "<h4>حجم التخزين المؤقت:</h4>\n";
echo "الحجم الحالي: " . Cache::getSize() . "<br>";
echo "الحد الأقصى: " . Cache::getMaxSize() . "<br>";

$user = Cache::get("user:1");
if ($user) {
    echo "<h4>المستخدم من التخزين المؤقت:</h4>\n";
    echo "الاسم: " . $user['name'] . "<br>";
    echo "الإيميل: " . $user['email'] . "<br>";
}

$config = Cache::get("config:app");
if ($config) {
    echo "<h4>إعدادات التطبيق:</h4>\n";
    echo "الإصدار: " . $config['version'] . "<br>";
    echo "وضع التطوير: " . ($config['debug'] ? "مفعل" : "معطل") . "<br>";
}

$stats = Cache::getStatistics();
echo "<h4>إحصائيات التخزين المؤقت:</h4>\n";
echo "النجاحات: " . $stats['hits'] . "<br>";
echo "الفشل: " . $stats['misses'] . "<br>";
echo "معدل النجاح: " . $stats['hitRate'] . "<br>";
echo "الحجم: " . $stats['size'] . "<br>";
echo "الحد الأقصى: " . $stats['maxSize'] . "<br>";
echo "تاريخ الإنشاء: " . $stats['createdAt'] . "<br>";
echo "آخر تنظيف: " . $stats['lastCleanup'] . "<br><br>";

// ==========================================
// مثال 3: نظام التسجيل (Logger) مع Static
// ==========================================
echo "<h2>مثال 3: نظام التسجيل</h2>\n";

class Logger {
    private static $logFile = "app.log";
    private static $logLevel = "INFO";
    private static $logCount = 0;
    private static $levels = [
        'DEBUG' => 0,
        'INFO' => 1,
        'WARNING' => 2,
        'ERROR' => 3,
        'CRITICAL' => 4
    ];
    private static $createdAt;
    private static $lastLog;
    
    public static function initialize() {
        self::$createdAt = date('Y-m-d H:i:s');
        echo "🏗️ <strong>تم تهيئة نظام التسجيل</strong><br>";
    }
    
    public static function setLogFile($filename) {
        self::$logFile = $filename;
        echo "📁 <strong>تم تعيين ملف السجل إلى:</strong> " . $filename . "<br>";
    }
    
    public static function setLogLevel($level) {
        if (isset(self::$levels[$level])) {
            self::$logLevel = $level;
            echo "📊 <strong>تم تعيين مستوى السجل إلى:</strong> " . $level . "<br>";
        }
    }
    
    public static function debug($message) {
        self::log('DEBUG', $message);
    }
    
    public static function info($message) {
        self::log('INFO', $message);
    }
    
    public static function warning($message) {
        self::log('WARNING', $message);
    }
    
    public static function error($message) {
        self::log('ERROR', $message);
    }
    
    public static function critical($message) {
        self::log('CRITICAL', $message);
    }
    
    private static function log($level, $message) {
        if (self::$levels[$level] < self::$levels[self::$logLevel]) {
            return; // تجاهل الرسائل ذات المستوى الأدنى
        }
        
        $timestamp = date('Y-m-d H:i:s');
        $logEntry = "[$timestamp] [$level] $message\n";
        
        file_put_contents(self::$logFile, $logEntry, FILE_APPEND | LOCK_EX);
        self::$logCount++;
        self::$lastLog = $timestamp;
        
        echo "📝 <strong>تم تسجيل:</strong> [$level] $message<br>";
    }
    
    public static function getLogCount() {
        return self::$logCount;
    }
    
    public static function getLogFile() {
        return self::$logFile;
    }
    
    public static function getLogLevel() {
        return self::$logLevel;
    }
    
    public static function getCreatedAt() {
        return self::$createdAt;
    }
    
    public static function getLastLog() {
        return self::$lastLog;
    }
    
    public static function clearLog() {
        file_put_contents(self::$logFile, "");
        self::$logCount = 0;
        self::info("تم مسح السجل");
        echo "🗑️ <strong>تم مسح السجل</strong><br>";
    }
    
    public static function getLogContent() {
        if (file_exists(self::$logFile)) {
            return file_get_contents(self::$logFile);
        }
        return "";
    }
    
    public static function getStatistics() {
        $content = self::getLogContent();
        $lines = explode("\n", $content);
        $stats = [
            'totalLogs' => self::$logCount,
            'totalLines' => count($lines) - 1, // -1 للخط الفارغ الأخير
            'logFile' => self::$logFile,
            'logLevel' => self::$logLevel,
            'createdAt' => self::$createdAt,
            'lastLog' => self::$lastLog
        ];
        
        // إحصائيات حسب المستوى
        foreach (self::$levels as $level => $value) {
            $count = 0;
            foreach ($lines as $line) {
                if (strpos($line, "[$level]") !== false) {
                    $count++;
                }
            }
            $stats[$level] = $count;
        }
        
        return $stats;
    }
    
    public static function exportLogs() {
        return self::getLogContent();
    }
    
    public static function getLogLevels() {
        return self::$levels;
    }
}

// استخدام نظام التسجيل
echo "<h3>استخدام نظام التسجيل:</h3>\n";

Logger::initialize();
Logger::setLogLevel('DEBUG');
Logger::setLogFile('myapp.log');

Logger::debug("بدء تشغيل التطبيق");
Logger::info("تم تسجيل دخول المستخدم");
Logger::warning("ذاكرة منخفضة");
Logger::error("فشل في الاتصال بقاعدة البيانات");
Logger::critical("خطأ حرج في النظام");

echo "<h4>إحصائيات التسجيل:</h4>\n";
echo "عدد السجلات: " . Logger::getLogCount() . "<br>";
echo "ملف السجل: " . Logger::getLogFile() . "<br>";
echo "مستوى السجل: " . Logger::getLogLevel() . "<br>";
echo "تاريخ الإنشاء: " . Logger::getCreatedAt() . "<br>";
echo "آخر سجل: " . Logger::getLastLog() . "<br>";

$stats = Logger::getStatistics();
echo "<h4>إحصائيات مفصلة:</h4>\n";
echo "إجمالي السجلات: " . $stats['totalLogs'] . "<br>";
echo "إجمالي الأسطر: " . $stats['totalLines'] . "<br>";
echo "DEBUG: " . $stats['DEBUG'] . "<br>";
echo "INFO: " . $stats['INFO'] . "<br>";
echo "WARNING: " . $stats['WARNING'] . "<br>";
echo "ERROR: " . $stats['ERROR'] . "<br>";
echo "CRITICAL: " . $stats['CRITICAL'] . "<br><br>";

// ==========================================
// مثال 4: نظام إدارة المنتجات مع Static
// ==========================================
echo "<h2>مثال 4: نظام إدارة المنتجات</h2>\n";

class ProductManager {
    private static $products = [];
    private static $nextId = 1;
    private static $totalProducts = 0;
    private static $totalValue = 0;
    private static $categories = [];
    private static $createdAt;
    
    public static function initialize() {
        self::$createdAt = date('Y-m-d H:i:s');
        echo "🏗️ <strong>تم تهيئة نظام إدارة المنتجات</strong><br>";
    }
    
    public static function createProduct($name, $price, $category, $quantity = 0) {
        $product = [
            'id' => self::$nextId++,
            'name' => $name,
            'price' => $price,
            'category' => $category,
            'quantity' => $quantity,
            'totalValue' => $price * $quantity,
            'createdAt' => date('Y-m-d H:i:s'),
            'updatedAt' => date('Y-m-d H:i:s')
        ];
        
        self::$products[] = $product;
        self::$totalProducts++;
        self::$totalValue += $product['totalValue'];
        
        if (!in_array($category, self::$categories)) {
            self::$categories[] = $category;
        }
        
        echo "✅ <strong>تم إنشاء منتج جديد:</strong> " . $name . " (ID: " . $product['id'] . ")<br>";
        return $product['id'];
    }
    
    public static function getProduct($id) {
        foreach (self::$products as $product) {
            if ($product['id'] == $id) {
                return $product;
            }
        }
        return null;
    }
    
    public static function updateProduct($id, $name, $price, $category, $quantity) {
        foreach (self::$products as &$product) {
            if ($product['id'] == $id) {
                $oldValue = $product['totalValue'];
                $product['name'] = $name;
                $product['price'] = $price;
                $product['category'] = $category;
                $product['quantity'] = $quantity;
                $product['totalValue'] = $price * $quantity;
                $product['updatedAt'] = date('Y-m-d H:i:s');
                
                self::$totalValue = self::$totalValue - $oldValue + $product['totalValue'];
                
                if (!in_array($category, self::$categories)) {
                    self::$categories[] = $category;
                }
                
                echo "✅ <strong>تم تحديث المنتج:</strong> " . $name . "<br>";
                return true;
            }
        }
        return false;
    }
    
    public static function deleteProduct($id) {
        foreach (self::$products as $key => $product) {
            if ($product['id'] == $id) {
                self::$totalValue -= $product['totalValue'];
                unset(self::$products[$key]);
                self::$products = array_values(self::$products);
                self::$totalProducts--;
                echo "🗑️ <strong>تم حذف المنتج:</strong> " . $product['name'] . "<br>";
                return true;
            }
        }
        return false;
    }
    
    public static function getAllProducts() {
        return self::$products;
    }
    
    public static function getProductsByCategory($category) {
        return array_filter(self::$products, function($product) use ($category) {
            return $product['category'] === $category;
        });
    }
    
    public static function getTotalProducts() {
        return self::$totalProducts;
    }
    
    public static function getTotalValue() {
        return self::$totalValue;
    }
    
    public static function getCategories() {
        return self::$categories;
    }
    
    public static function getStatistics() {
        $categoryStats = [];
        foreach (self::$categories as $category) {
            $categoryProducts = self::getProductsByCategory($category);
            $categoryValue = array_sum(array_column($categoryProducts, 'totalValue'));
            $categoryStats[$category] = [
                'count' => count($categoryProducts),
                'value' => $categoryValue
            ];
        }
        
        return [
            'totalProducts' => self::$totalProducts,
            'totalValue' => self::$totalValue,
            'categories' => self::$categories,
            'categoryStats' => $categoryStats,
            'createdAt' => self::$createdAt,
            'nextId' => self::$nextId
        ];
    }
    
    public static function clearAllProducts() {
        self::$products = [];
        self::$nextId = 1;
        self::$totalProducts = 0;
        self::$totalValue = 0;
        self::$categories = [];
        echo "🗑️ <strong>تم مسح جميع المنتجات</strong><br>";
    }
    
    public static function exportProducts() {
        return json_encode(self::$products, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }
    
    public static function importProducts($jsonData) {
        $products = json_decode($jsonData, true);
        if ($products) {
            self::$products = $products;
            self::$totalProducts = count($products);
            self::$totalValue = array_sum(array_column($products, 'totalValue'));
            self::$nextId = max(array_column($products, 'id')) + 1;
            self::$categories = array_unique(array_column($products, 'category'));
            echo "📥 <strong>تم استيراد المنتجات بنجاح</strong><br>";
            return true;
        }
        return false;
    }
}

// استخدام نظام إدارة المنتجات
echo "<h3>استخدام نظام إدارة المنتجات:</h3>\n";

ProductManager::initialize();

$productId1 = ProductManager::createProduct("لابتوب ديل", 5000, "إلكترونيات", 10);
$productId2 = ProductManager::createProduct("آيفون", 3000, "إلكترونيات", 25);
$productId3 = ProductManager::createProduct("كتاب البرمجة", 50, "كتب", 100);
$productId4 = ProductManager::createProduct("قميص", 100, "ملابس", 50);

echo "<h4>إحصائيات المنتجات:</h4>\n";
echo "إجمالي المنتجات: " . ProductManager::getTotalProducts() . "<br>";
echo "القيمة الإجمالية: " . ProductManager::getTotalValue() . " ريال<br>";
echo "الفئات: " . implode(", ", ProductManager::getCategories()) . "<br>";

$product = ProductManager::getProduct($productId1);
echo "<h4>معلومات المنتج الأول:</h4>\n";
echo "الاسم: " . $product['name'] . "<br>";
echo "السعر: " . $product['price'] . " ريال<br>";
echo "الفئة: " . $product['category'] . "<br>";
echo "الكمية: " . $product['quantity'] . "<br>";
echo "القيمة الإجمالية: " . $product['totalValue'] . " ريال<br>";

$electronics = ProductManager::getProductsByCategory("إلكترونيات");
echo "<h4>منتجات الإلكترونيات:</h4>\n";
foreach ($electronics as $product) {
    echo "- " . $product['name'] . " (" . $product['quantity'] . " قطعة)<br>";
}

$stats = ProductManager::getStatistics();
echo "<h4>إحصائيات مفصلة:</h4>\n";
echo "إجمالي المنتجات: " . $stats['totalProducts'] . "<br>";
echo "القيمة الإجمالية: " . $stats['totalValue'] . " ريال<br>";
echo "تاريخ الإنشاء: " . $stats['createdAt'] . "<br>";
echo "المعرف التالي: " . $stats['nextId'] . "<br>";

echo "<h4>إحصائيات الفئات:</h4>\n";
foreach ($stats['categoryStats'] as $category => $data) {
    echo $category . ": " . $data['count'] . " منتج - " . $data['value'] . " ريال<br>";
}

// ==========================================
// خلاصة المحاضرة
// ==========================================
echo "<hr>";
echo "<h2>🎯 خلاصة المحاضرة</h2>";
echo "<div style='background-color: #f0f8ff; padding: 20px; border-radius: 10px;'>";
echo "<h3>ما تعلمناه:</h3>";
echo "<ul>";
echo "<li><strong>Static Properties:</strong> تنتمي للكلاس وليس للكائنات</li>";
echo "<li><strong>Static Methods:</strong> يمكن استدعاؤها بدون إنشاء كائن</li>";
echo "<li><strong>self keyword:</strong> للوصول إلى Static members من داخل الكلاس</li>";
echo "<li><strong>مشتركة:</strong> بين جميع الكائنات</li>";
echo "<li><strong>ذاكرة واحدة:</strong> بغض النظر عن عدد الكائنات</li>";
echo "<li><strong>وظائف مساعدة:</strong> للعدادات والإحصائيات</li>";
echo "</ul>";

echo "<h3>أفضل الممارسات:</h3>";
echo "<ul>";
echo "<li>استخدم Static للوظائف المساعدة</li>";
echo "<li>استخدم Static للعدادات</li>";
echo "<li>تجنب Static المفرط</li>";
echo "<li>استخدم Static للواجهات</li>";
echo "<li>استخدم أسماء وصفية</li>";
echo "<li>وثق الطرق الثابتة</li>";
echo "</ul>";
echo "</div>";
?>


