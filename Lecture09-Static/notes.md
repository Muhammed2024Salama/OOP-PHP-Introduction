# المحاضرة التاسعة: الخصائص والطرق الثابتة (Static Properties and Methods)

## 📚 جدول المحتويات
1. [ما هي الخصائص والطرق الثابتة؟](#ما-هي-الخصائص-والطرق-الثابتة)
2. [الخصائص الثابتة](#الخصائص-الثابتة)
3. [الطرق الثابتة](#الطرق-الثابتة)
4. [كلمة self](#كلمة-self)
5. [أمثلة عملية](#أمثلة-عملية)
6. [أفضل الممارسات](#أفضل-الممارسات)

---

## ما هي الخصائص والطرق الثابتة؟

**الخصائص والطرق الثابتة (Static Properties and Methods)** هي خصائص وطرق تنتمي للكلاس نفسه وليس للكائنات المنفردة. يمكن تشبيهها بـ:
- 🏢 **المبنى**: الطوابق تنتمي للمبنى ككل وليس للشقق
- 🏫 **المدرسة**: عدد الطلاب ينتمي للمدرسة وليس للطالب الواحد
- 🏭 **المصنع**: إنتاجية المصنع تنتمي للمصنع وليس للعامل

### 🎯 خصائص Static:
- **تنتمي للكلاس**: وليس للكائنات المنفردة
- **مشتركة**: بين جميع الكائنات
- **يمكن الوصول إليها**: بدون إنشاء كائن
- **تستهلك ذاكرة واحدة**: بغض النظر عن عدد الكائنات

---

## الخصائص الثابتة

### 📝 **البناء الأساسي:**
```php
<?php
class Counter {
    public static $count = 0; // خاصية ثابتة
    
    public function __construct() {
        self::$count++; // زيادة العداد عند إنشاء كائن
    }
}

// استخدام الخصائص الثابتة
echo Counter::$count; // 0

$obj1 = new Counter();
echo Counter::$count; // 1

$obj2 = new Counter();
echo Counter::$count; // 2
```

### 🔍 **مثال متقدم:**
```php
<?php
class User {
    public static $totalUsers = 0;
    public static $activeUsers = 0;
    private $name;
    private $isActive;
    
    public function __construct($name) {
        $this->name = $name;
        $this->isActive = true;
        
        // زيادة العداد عند إنشاء مستخدم جديد
        self::$totalUsers++;
        self::$activeUsers++;
    }
    
    public function deactivate() {
        if ($this->isActive) {
            $this->isActive = false;
            self::$activeUsers--;
        }
    }
    
    public function activate() {
        if (!$this->isActive) {
            $this->isActive = true;
            self::$activeUsers++;
        }
    }
    
    public static function getTotalUsers() {
        return self::$totalUsers;
    }
    
    public static function getActiveUsers() {
        return self::$activeUsers;
    }
}

// استخدام الكلاس
$user1 = new User("أحمد");
$user2 = new User("فاطمة");
$user3 = new User("محمد");

echo "إجمالي المستخدمين: " . User::$totalUsers . "\n"; // 3
echo "المستخدمين النشطين: " . User::$activeUsers . "\n"; // 3

$user1->deactivate();
echo "المستخدمين النشطين: " . User::$activeUsers . "\n"; // 2
```

---

## الطرق الثابتة

### 📝 **البناء الأساسي:**
```php
<?php
class Math {
    public static function add($a, $b) {
        return $a + $b;
    }
    
    public static function multiply($a, $b) {
        return $a * $b;
    }
    
    public static function power($base, $exponent) {
        return pow($base, $exponent);
    }
}

// استخدام الطرق الثابتة
echo Math::add(5, 3); // 8
echo Math::multiply(4, 6); // 24
echo Math::power(2, 3); // 8
```

### 🔍 **مثال متقدم:**
```php
<?php
class Database {
    private static $connection = null;
    private static $host = "localhost";
    private static $username = "root";
    private static $password = "password";
    private static $database = "myapp";
    
    public static function connect() {
        if (self::$connection === null) {
            // محاكاة الاتصال بقاعدة البيانات
            self::$connection = "database_connection_" . uniqid();
            echo "تم إنشاء اتصال جديد بقاعدة البيانات\n";
        }
        return self::$connection;
    }
    
    public static function disconnect() {
        if (self::$connection !== null) {
            self::$connection = null;
            echo "تم قطع الاتصال بقاعدة البيانات\n";
        }
    }
    
    public static function query($sql) {
        $connection = self::connect();
        return "تم تنفيذ الاستعلام: " . $sql;
    }
    
    public static function getConnectionInfo() {
        return "المضيف: " . self::$host . " - قاعدة البيانات: " . self::$database;
    }
}

// استخدام الطرق الثابتة
echo Database::query("SELECT * FROM users") . "\n";
echo Database::query("INSERT INTO users (name) VALUES ('أحمد')") . "\n";
echo Database::getConnectionInfo() . "\n";
Database::disconnect();
```

---

## كلمة self

**`self`** هي الكلمة المفتاحية المستخدمة للوصول إلى الخصائص والطرق الثابتة من داخل الكلاس.

### 📝 **الاستخدامات:**

#### 1. **الوصول إلى الخصائص الثابتة**
```php
<?php
class Counter {
    public static $count = 0;
    
    public function increment() {
        self::$count++; // استخدام self للوصول للخاصية الثابتة
    }
    
    public function getCount() {
        return self::$count; // استخدام self للوصول للخاصية الثابتة
    }
}
```

#### 2. **الوصول إلى الطرق الثابتة**
```php
<?php
class Logger {
    private static $logFile = "app.log";
    
    public static function log($message) {
        $timestamp = date('Y-m-d H:i:s');
        $logEntry = "[$timestamp] $message\n";
        file_put_contents(self::$logFile, $logEntry, FILE_APPEND);
    }
    
    public static function clearLog() {
        file_put_contents(self::$logFile, "");
        self::log("تم مسح السجل"); // استخدام self لاستدعاء طريقة ثابتة
    }
    
    public static function getLogFile() {
        return self::$logFile; // استخدام self للوصول للخاصية الثابتة
    }
}
```

---

## أمثلة عملية

### مثال 1: نظام إدارة المستخدمين
```php
<?php
class UserManager {
    private static $users = [];
    private static $nextId = 1;
    private static $totalUsers = 0;
    private static $activeUsers = 0;
    
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
                return true;
            }
        }
        return false;
    }
    
    public static function deactivateUser($id) {
        foreach (self::$users as &$user) {
            if ($user['id'] == $id && $user['isActive']) {
                $user['isActive'] = false;
                self::$activeUsers--;
                return true;
            }
        }
        return false;
    }
    
    public static function activateUser($id) {
        foreach (self::$users as &$user) {
            if ($user['id'] == $id && !$user['isActive']) {
                $user['isActive'] = true;
                self::$activeUsers++;
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
    
    public static function getTotalUsers() {
        return self::$totalUsers;
    }
    
    public static function getActiveUsersCount() {
        return self::$activeUsers;
    }
    
    public static function getStatistics() {
        return [
            'totalUsers' => self::$totalUsers,
            'activeUsers' => self::$activeUsers,
            'inactiveUsers' => self::$totalUsers - self::$activeUsers
        ];
    }
}

// استخدام نظام إدارة المستخدمين
$userId1 = UserManager::createUser("أحمد محمد", "ahmed@example.com");
$userId2 = UserManager::createUser("فاطمة علي", "fatima@example.com");
$userId3 = UserManager::createUser("محمد أحمد", "mohammed@example.com");

echo "إجمالي المستخدمين: " . UserManager::getTotalUsers() . "\n";
echo "المستخدمين النشطين: " . UserManager::getActiveUsersCount() . "\n";

$user = UserManager::getUser($userId1);
echo "المستخدم: " . $user['name'] . " - الإيميل: " . $user['email'] . "\n";

UserManager::deactivateUser($userId1);
echo "المستخدمين النشطين: " . UserManager::getActiveUsersCount() . "\n";

$stats = UserManager::getStatistics();
echo "الإحصائيات: " . json_encode($stats, JSON_UNESCAPED_UNICODE) . "\n";
```

### مثال 2: نظام التخزين المؤقت
```php
<?php
class Cache {
    private static $cache = [];
    private static $maxSize = 100;
    private static $hits = 0;
    private static $misses = 0;
    
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
            'created' => time()
        ];
    }
    
    public static function get($key) {
        if (isset(self::$cache[$key])) {
            $item = self::$cache[$key];
            
            // التحقق من انتهاء الصلاحية
            if (time() < $item['expires']) {
                self::$hits++;
                return $item['value'];
            } else {
                // إزالة العنصر المنتهي الصلاحية
                unset(self::$cache[$key]);
            }
        }
        
        self::$misses++;
        return null;
    }
    
    public static function has($key) {
        return self::get($key) !== null;
    }
    
    public static function delete($key) {
        if (isset(self::$cache[$key])) {
            unset(self::$cache[$key]);
            return true;
        }
        return false;
    }
    
    public static function clear() {
        self::$cache = [];
        self::$hits = 0;
        self::$misses = 0;
    }
    
    public static function getSize() {
        return count(self::$cache);
    }
    
    public static function getMaxSize() {
        return self::$maxSize;
    }
    
    public static function setMaxSize($size) {
        self::$maxSize = $size;
    }
    
    public static function getStatistics() {
        $total = self::$hits + self::$misses;
        $hitRate = $total > 0 ? (self::$hits / $total) * 100 : 0;
        
        return [
            'hits' => self::$hits,
            'misses' => self::$misses,
            'hitRate' => round($hitRate, 2) . '%',
            'size' => self::getSize(),
            'maxSize' => self::getMaxSize()
        ];
    }
    
    public static function getAllKeys() {
        return array_keys(self::$cache);
    }
    
    private static function cleanExpired() {
        $now = time();
        foreach (self::$cache as $key => $item) {
            if ($now >= $item['expires']) {
                unset(self::$cache[$key]);
            }
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
        }
    }
}

// استخدام نظام التخزين المؤقت
Cache::set("user:1", ["name" => "أحمد", "email" => "ahmed@example.com"], 300);
Cache::set("user:2", ["name" => "فاطمة", "email" => "fatima@example.com"], 300);
Cache::set("config:app", ["version" => "1.0", "debug" => true], 3600);

echo "حجم التخزين المؤقت: " . Cache::getSize() . "\n";

$user = Cache::get("user:1");
if ($user) {
    echo "المستخدم: " . $user['name'] . " - الإيميل: " . $user['email'] . "\n";
}

$config = Cache::get("config:app");
if ($config) {
    echo "إصدار التطبيق: " . $config['version'] . "\n";
}

$stats = Cache::getStatistics();
echo "إحصائيات التخزين المؤقت: " . json_encode($stats, JSON_UNESCAPED_UNICODE) . "\n";
```

### مثال 3: نظام التسجيل (Logger)
```php
<?php
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
    
    public static function setLogFile($filename) {
        self::$logFile = $filename;
    }
    
    public static function setLogLevel($level) {
        if (isset(self::$levels[$level])) {
            self::$logLevel = $level;
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
    
    public static function clearLog() {
        file_put_contents(self::$logFile, "");
        self::$logCount = 0;
        self::info("تم مسح السجل");
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
            'logLevel' => self::$logLevel
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
}

// استخدام نظام التسجيل
Logger::setLogLevel('DEBUG');
Logger::setLogFile('myapp.log');

Logger::debug("بدء تشغيل التطبيق");
Logger::info("تم تسجيل دخول المستخدم");
Logger::warning("ذاكرة منخفضة");
Logger::error("فشل في الاتصال بقاعدة البيانات");
Logger::critical("خطأ حرج في النظام");

echo "عدد السجلات: " . Logger::getLogCount() . "\n";
echo "ملف السجل: " . Logger::getLogFile() . "\n";
echo "مستوى السجل: " . Logger::getLogLevel() . "\n";

$stats = Logger::getStatistics();
echo "إحصائيات السجل: " . json_encode($stats, JSON_UNESCAPED_UNICODE) . "\n";
```

---

## أفضل الممارسات

### ✅ **1. استخدام Static للوظائف المساعدة**
```php
<?php
class StringHelper {
    public static function capitalize($string) {
        return ucfirst(strtolower($string));
    }
    
    public static function slug($string) {
        return strtolower(str_replace(' ', '-', $string));
    }
}
```

### ✅ **2. استخدام Static للعدادات**
```php
<?php
class Counter {
    private static $count = 0;
    
    public static function increment() {
        self::$count++;
    }
    
    public static function getCount() {
        return self::$count;
    }
}
```

### ✅ **3. تجنب Static المفرط**
```php
<?php
// ❌ خطأ - استخدام static مفرط
class User {
    public static $name;
    public static $email;
    public static $age;
}

// ✅ صحيح - استخدام static للعدادات فقط
class User {
    public static $totalUsers = 0;
    private $name;
    private $email;
    private $age;
}
```

### ✅ **4. استخدام Static للواجهات**
```php
<?php
class Database {
    private static $connection = null;
    
    public static function getConnection() {
        if (self::$connection === null) {
            self::$connection = new PDO(...);
        }
        return self::$connection;
    }
}
```

---

## 🎯 خلاصة المحاضرة

1. **Static Properties** تنتمي للكلاس وليس للكائنات
2. **Static Methods** يمكن استدعاؤها بدون إنشاء كائن
3. **self** للوصول إلى Static members من داخل الكلاس
4. **استخدم Static** للوظائف المساعدة والعدادات
5. **تجنب Static المفرط** لسهولة الاختبار
6. **Static مشترك** بين جميع الكائنات

---

## 📝 التمرين العملي

أنشئ نظام إدارة المنتجات مع Static:
- Static properties: `$totalProducts`, `$nextId`
- Static methods: `createProduct()`, `getTotalProducts()`, `getStatistics()`
- Regular methods: `getName()`, `getPrice()`, `updatePrice()`

---

## 📚 المراجع والموارد
- [PHP Static Properties](https://www.php.net/manual/en/language.oop5.static.php)
- [PHP Static Methods](https://www.php.net/manual/en/language.oop5.static.php)
- [PHP self Keyword](https://www.php.net/manual/en/language.oop5.paamayim-nekudotayim.php)


