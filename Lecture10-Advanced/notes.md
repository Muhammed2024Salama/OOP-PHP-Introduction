# المحاضرة العاشرة: مفاهيم متقدمة في OOP

## 📚 جدول المحتويات
1. [Namespaces](#namespaces)
2. [Autoloading](#autoloading)
3. [Traits](#traits)
4. [Magic Methods](#magic-methods)
5. [أمثلة عملية](#أمثلة-عملية)
6. [أفضل الممارسات](#أفضل-الممارسات)

---

## Namespaces

**Namespaces** هي طريقة لتنظيم الكود وتجنب تضارب الأسماء. يمكن تشبيهها بـ:
- 🏢 **المباني**: كل مبنى له عنوان فريد
- 📁 **المجلدات**: كل مجلد يحتوي على ملفات مختلفة
- 🏫 **المدارس**: كل مدرسة لها طلاب بأسماء مختلفة

### 📝 **البناء الأساسي:**
```php
<?php
namespace MyApp\Models;

class User {
    private $name;
    private $email;
    
    public function __construct($name, $email) {
        $this->name = $name;
        $this->email = $email;
    }
    
    public function getName() {
        return $this->name;
    }
}

// استخدام الكلاس
$user = new User("أحمد", "ahmed@example.com");
// أو
$user = new \MyApp\Models\User("أحمد", "ahmed@example.com");
```

### 🔍 **مثال متقدم:**
```php
<?php
namespace MyApp\Controllers;

use MyApp\Models\User;
use MyApp\Services\EmailService;

class UserController {
    private $emailService;
    
    public function __construct() {
        $this->emailService = new EmailService();
    }
    
    public function createUser($name, $email) {
        $user = new User($name, $email);
        $this->emailService->sendWelcomeEmail($user);
        return $user;
    }
}
```

---

## Autoloading

**Autoloading** هو آلية لتحميل الكلاسات تلقائياً عند الحاجة إليها.

### 📝 **البناء الأساسي:**
```php
<?php
spl_autoload_register(function ($class) {
    // تحويل namespace إلى مسار ملف
    $file = str_replace('\\', '/', $class) . '.php';
    
    if (file_exists($file)) {
        require_once $file;
    }
});

// الآن يمكن استخدام الكلاسات بدون require
$user = new MyApp\Models\User("أحمد", "ahmed@example.com");
```

### 🔍 **مثال مع PSR-4:**
```php
<?php
// composer.json
{
    "autoload": {
        "psr-4": {
            "MyApp\\": "src/"
        }
    }
}

// استخدام
require_once 'vendor/autoload.php';

$user = new MyApp\Models\User("أحمد", "ahmed@example.com");
```

---

## Traits

**Traits** هي آلية لإعادة استخدام الكود في PHP. يمكن تشبيهها بـ:
- 🧩 **القطع**: قطع يمكن إضافتها لأي كلاس
- 🔧 **الأدوات**: أدوات يمكن استخدامها في أي مكان
- 📚 **المكتبة**: مكتبة من الوظائف المشتركة

### 📝 **البناء الأساسي:**
```php
<?php
trait Loggable {
    public function log($message) {
        echo "[" . date('Y-m-d H:i:s') . "] " . $message . "\n";
    }
}

trait Timestampable {
    public function getTimestamp() {
        return date('Y-m-d H:i:s');
    }
}

class User {
    use Loggable, Timestampable;
    
    private $name;
    
    public function __construct($name) {
        $this->name = $name;
        $this->log("تم إنشاء مستخدم: " . $name);
    }
    
    public function getName() {
        return $this->name;
    }
}

$user = new User("أحمد");
$user->log("تم تسجيل دخول المستخدم");
echo "الوقت: " . $user->getTimestamp() . "\n";
```

---

## Magic Methods

**Magic Methods** هي طرق خاصة يتم استدعاؤها تلقائياً في مواقف معينة.

### 📝 **أهم Magic Methods:**

#### 1. **__toString()**
```php
<?php
class User {
    private $name;
    private $email;
    
    public function __construct($name, $email) {
        $this->name = $name;
        $this->email = $email;
    }
    
    public function __toString() {
        return "المستخدم: " . $this->name . " - الإيميل: " . $this->email;
    }
}

$user = new User("أحمد", "ahmed@example.com");
echo $user; // سيتم استدعاء __toString() تلقائياً
```

#### 2. **__get() و __set()**
```php
<?php
class User {
    private $data = [];
    
    public function __get($name) {
        if (isset($this->data[$name])) {
            return $this->data[$name];
        }
        return null;
    }
    
    public function __set($name, $value) {
        $this->data[$name] = $value;
    }
}

$user = new User();
$user->name = "أحمد"; // سيتم استدعاء __set()
$user->email = "ahmed@example.com"; // سيتم استدعاء __set()

echo $user->name; // سيتم استدعاء __get()
echo $user->email; // سيتم استدعاء __get()
```

#### 3. **__call() و __callStatic()**
```php
<?php
class User {
    private $data = [];
    
    public function __call($name, $arguments) {
        if (strpos($name, 'get') === 0) {
            $property = strtolower(substr($name, 3));
            return isset($this->data[$property]) ? $this->data[$property] : null;
        }
        
        if (strpos($name, 'set') === 0) {
            $property = strtolower(substr($name, 3));
            $this->data[$property] = $arguments[0];
            return $this;
        }
    }
    
    public static function __callStatic($name, $arguments) {
        return "تم استدعاء الطريقة الثابتة: " . $name;
    }
}

$user = new User();
$user->setName("أحمد");
$user->setEmail("ahmed@example.com");

echo $user->getName() . "\n";
echo $user->getEmail() . "\n";
echo User::someStaticMethod() . "\n";
```

---

## أمثلة عملية

### مثال 1: نظام إدارة المحتوى مع Namespaces
```php
<?php
// src/Models/User.php
namespace MyApp\Models;

class User {
    private $id;
    private $name;
    private $email;
    private $createdAt;
    
    public function __construct($name, $email) {
        $this->id = uniqid();
        $this->name = $name;
        $this->email = $email;
        $this->createdAt = date('Y-m-d H:i:s');
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function getEmail() {
        return $this->email;
    }
    
    public function getCreatedAt() {
        return $this->createdAt;
    }
    
    public function __toString() {
        return "المستخدم: " . $this->name . " - الإيميل: " . $this->email;
    }
}

// src/Models/Post.php
namespace MyApp\Models;

class Post {
    private $id;
    private $title;
    private $content;
    private $author;
    private $createdAt;
    
    public function __construct($title, $content, User $author) {
        $this->id = uniqid();
        $this->title = $title;
        $this->content = $content;
        $this->author = $author;
        $this->createdAt = date('Y-m-d H:i:s');
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function getTitle() {
        return $this->title;
    }
    
    public function getContent() {
        return $this->content;
    }
    
    public function getAuthor() {
        return $this->author;
    }
    
    public function getCreatedAt() {
        return $this->createdAt;
    }
    
    public function __toString() {
        return "المنشور: " . $this->title . " - المؤلف: " . $this->author->getName();
    }
}

// src/Services/EmailService.php
namespace MyApp\Services;

use MyApp\Models\User;

class EmailService {
    public function sendWelcomeEmail(User $user) {
        echo "تم إرسال إيميل ترحيبي إلى: " . $user->getEmail() . "\n";
    }
    
    public function sendNotificationEmail(User $user, $message) {
        echo "تم إرسال إشعار إلى: " . $user->getEmail() . " - الرسالة: " . $message . "\n";
    }
}

// src/Controllers/UserController.php
namespace MyApp\Controllers;

use MyApp\Models\User;
use MyApp\Services\EmailService;

class UserController {
    private $emailService;
    
    public function __construct() {
        $this->emailService = new EmailService();
    }
    
    public function createUser($name, $email) {
        $user = new User($name, $email);
        $this->emailService->sendWelcomeEmail($user);
        return $user;
    }
    
    public function notifyUser(User $user, $message) {
        $this->emailService->sendNotificationEmail($user, $message);
    }
}

// src/Controllers/PostController.php
namespace MyApp\Controllers;

use MyApp\Models\Post;
use MyApp\Models\User;
use MyApp\Services\EmailService;

class PostController {
    private $emailService;
    
    public function __construct() {
        $this->emailService = new EmailService();
    }
    
    public function createPost($title, $content, User $author) {
        $post = new Post($title, $content, $author);
        $this->emailService->sendNotificationEmail($author, "تم إنشاء منشور جديد: " . $title);
        return $post;
    }
}

// استخدام النظام
$userController = new \MyApp\Controllers\UserController();
$postController = new \MyApp\Controllers\PostController();

$user = $userController->createUser("أحمد محمد", "ahmed@example.com");
$post = $postController->createPost("عنوان المنشور", "محتوى المنشور", $user);

echo $user . "\n";
echo $post . "\n";
```

### مثال 2: نظام مع Traits
```php
<?php
trait Loggable {
    public function log($message) {
        echo "[" . date('Y-m-d H:i:s') . "] " . $message . "\n";
    }
}

trait Timestampable {
    public function getCreatedAt() {
        return $this->createdAt ?? date('Y-m-d H:i:s');
    }
    
    public function getUpdatedAt() {
        return $this->updatedAt ?? date('Y-m-d H:i:s');
    }
    
    public function touch() {
        $this->updatedAt = date('Y-m-d H:i:s');
    }
}

trait Cacheable {
    private static $cache = [];
    
    public static function getFromCache($key) {
        return self::$cache[$key] ?? null;
    }
    
    public static function setCache($key, $value) {
        self::$cache[$key] = $value;
    }
    
    public static function clearCache() {
        self::$cache = [];
    }
}

class User {
    use Loggable, Timestampable, Cacheable;
    
    private $id;
    private $name;
    private $email;
    private $createdAt;
    private $updatedAt;
    
    public function __construct($name, $email) {
        $this->id = uniqid();
        $this->name = $name;
        $this->email = $email;
        $this->createdAt = date('Y-m-d H:i:s');
        $this->updatedAt = date('Y-m-d H:i:s');
        
        $this->log("تم إنشاء مستخدم جديد: " . $name);
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function getEmail() {
        return $this->email;
    }
    
    public function setName($name) {
        $this->name = $name;
        $this->touch();
        $this->log("تم تحديث اسم المستخدم إلى: " . $name);
    }
    
    public function setEmail($email) {
        $this->email = $email;
        $this->touch();
        $this->log("تم تحديث إيميل المستخدم إلى: " . $email);
    }
    
    public static function findById($id) {
        // البحث في التخزين المؤقت أولاً
        $user = self::getFromCache($id);
        if ($user) {
            return $user;
        }
        
        // محاكاة البحث في قاعدة البيانات
        $user = new self("مستخدم من قاعدة البيانات", "user@example.com");
        self::setCache($id, $user);
        
        return $user;
    }
    
    public function __toString() {
        return "المستخدم: " . $this->name . " - الإيميل: " . $this->email;
    }
}

class Post {
    use Loggable, Timestampable, Cacheable;
    
    private $id;
    private $title;
    private $content;
    private $author;
    private $createdAt;
    private $updatedAt;
    
    public function __construct($title, $content, User $author) {
        $this->id = uniqid();
        $this->title = $title;
        $this->content = $content;
        $this->author = $author;
        $this->createdAt = date('Y-m-d H:i:s');
        $this->updatedAt = date('Y-m-d H:i:s');
        
        $this->log("تم إنشاء منشور جديد: " . $title);
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function getTitle() {
        return $this->title;
    }
    
    public function getContent() {
        return $this->content;
    }
    
    public function getAuthor() {
        return $this->author;
    }
    
    public function setTitle($title) {
        $this->title = $title;
        $this->touch();
        $this->log("تم تحديث عنوان المنشور إلى: " . $title);
    }
    
    public function setContent($content) {
        $this->content = $content;
        $this->touch();
        $this->log("تم تحديث محتوى المنشور");
    }
    
    public static function findById($id) {
        // البحث في التخزين المؤقت أولاً
        $post = self::getFromCache($id);
        if ($post) {
            return $post;
        }
        
        // محاكاة البحث في قاعدة البيانات
        $author = new User("مؤلف من قاعدة البيانات", "author@example.com");
        $post = new self("منشور من قاعدة البيانات", "محتوى المنشور", $author);
        self::setCache($id, $post);
        
        return $post;
    }
    
    public function __toString() {
        return "المنشور: " . $this->title . " - المؤلف: " . $this->author->getName();
    }
}

// استخدام النظام
$user = new User("أحمد محمد", "ahmed@example.com");
$user->setName("أحمد السعد");
$user->setEmail("ahmed.saad@example.com");

$post = new Post("عنوان المنشور", "محتوى المنشور", $user);
$post->setTitle("عنوان محدث");
$post->setContent("محتوى محدث");

echo "تاريخ إنشاء المستخدم: " . $user->getCreatedAt() . "\n";
echo "تاريخ آخر تحديث: " . $user->getUpdatedAt() . "\n";

echo "تاريخ إنشاء المنشور: " . $post->getCreatedAt() . "\n";
echo "تاريخ آخر تحديث: " . $post->getUpdatedAt() . "\n";

// اختبار التخزين المؤقت
$cachedUser = User::findById("test-id");
echo "المستخدم من التخزين المؤقت: " . $cachedUser . "\n";

// مسح التخزين المؤقت
User::clearCache();
Post::clearCache();
```

### مثال 3: نظام مع Magic Methods
```php
<?php
class DynamicUser {
    private $data = [];
    private $callbacks = [];
    
    public function __construct($name, $email) {
        $this->data['name'] = $name;
        $this->data['email'] = $email;
        $this->data['createdAt'] = date('Y-m-d H:i:s');
        $this->data['updatedAt'] = date('Y-m-d H:i:s');
    }
    
    public function __get($name) {
        if (isset($this->data[$name])) {
            return $this->data[$name];
        }
        return null;
    }
    
    public function __set($name, $value) {
        $oldValue = $this->data[$name] ?? null;
        $this->data[$name] = $value;
        $this->data['updatedAt'] = date('Y-m-d H:i:s');
        
        // استدعاء callback إذا كان موجود
        if (isset($this->callbacks[$name])) {
            $this->callbacks[$name]($name, $value, $oldValue);
        }
    }
    
    public function __isset($name) {
        return isset($this->data[$name]);
    }
    
    public function __unset($name) {
        unset($this->data[$name]);
        $this->data['updatedAt'] = date('Y-m-d H:i:s');
    }
    
    public function __call($name, $arguments) {
        if (strpos($name, 'get') === 0) {
            $property = strtolower(substr($name, 3));
            return $this->$property;
        }
        
        if (strpos($name, 'set') === 0) {
            $property = strtolower(substr($name, 3));
            $this->$property = $arguments[0];
            return $this;
        }
        
        if (strpos($name, 'has') === 0) {
            $property = strtolower(substr($name, 3));
            return isset($this->$property);
        }
        
        throw new BadMethodCallException("الطريقة غير موجودة: " . $name);
    }
    
    public function __toString() {
        return "المستخدم: " . $this->name . " - الإيميل: " . $this->email;
    }
    
    public function __invoke($method, ...$arguments) {
        return $this->$method(...$arguments);
    }
    
    public function __debugInfo() {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt,
            'totalProperties' => count($this->data)
        ];
    }
    
    public function onPropertyChange($property, $callback) {
        $this->callbacks[$property] = $callback;
    }
    
    public function getAllData() {
        return $this->data;
    }
    
    public function setData(array $data) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }
}

// استخدام النظام
$user = new DynamicUser("أحمد محمد", "ahmed@example.com");

// استخدام __get و __set
echo "الاسم: " . $user->name . "\n";
echo "الإيميل: " . $user->email . "\n";

$user->name = "أحمد السعد";
$user->email = "ahmed.saad@example.com";

// استخدام __call
echo "الاسم: " . $user->getName() . "\n";
echo "الإيميل: " . $user->getEmail() . "\n";

$user->setName("محمد أحمد");
$user->setEmail("mohammed@example.com");

// استخدام __isset و __unset
if (isset($user->name)) {
    echo "الاسم موجود\n";
}

unset($user->name);
if (!isset($user->name)) {
    echo "الاسم تم حذفه\n";
}

// استخدام __invoke
$user->setName("فاطمة علي");
echo "الاسم: " . $user->getName() . "\n";

// استخدام callback
$user->onPropertyChange('email', function($property, $newValue, $oldValue) {
    echo "تم تغيير $property من '$oldValue' إلى '$newValue'\n";
});

$user->email = "fatima@example.com";

// استخدام __toString
echo $user . "\n";

// استخدام __debugInfo
var_dump($user);
```

---

## أفضل الممارسات

### ✅ **1. استخدام Namespaces لتنظيم الكود**
```php
<?php
namespace MyApp\Models;
namespace MyApp\Controllers;
namespace MyApp\Services;
```

### ✅ **2. استخدام Autoloading لتجنب require**
```php
<?php
spl_autoload_register(function ($class) {
    $file = str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});
```

### ✅ **3. استخدام Traits للوظائف المشتركة**
```php
<?php
trait Loggable {
    public function log($message) {
        // تنفيذ التسجيل
    }
}
```

### ✅ **4. استخدام Magic Methods بحذر**
```php
<?php
class User {
    public function __toString() {
        return $this->name;
    }
}
```

---

## 🎯 خلاصة المحاضرة

1. **Namespaces** تنظم الكود وتجنب تضارب الأسماء
2. **Autoloading** يحمل الكلاسات تلقائياً
3. **Traits** تسمح بإعادة استخدام الكود
4. **Magic Methods** تتحكم في السلوك الخاص
5. **استخدم هذه المفاهيم** لبناء تطبيقات متقدمة
6. **اتبع أفضل الممارسات** لسهولة الصيانة

---

## 📝 التمرين العملي

أنشئ نظام إدارة المكتبة مع:
- Namespaces: `Library\Models`, `Library\Controllers`
- Traits: `Loggable`, `Timestampable`
- Magic Methods: `__toString()`, `__get()`, `__set()`
- Autoloading للكلاسات

---

## 📚 المراجع والموارد
- [PHP Namespaces](https://www.php.net/manual/en/language.namespaces.php)
- [PHP Autoloading](https://www.php.net/manual/en/language.oop5.autoload.php)
- [PHP Traits](https://www.php.net/manual/en/language.oop5.traits.php)
- [PHP Magic Methods](https://www.php.net/manual/en/language.oop5.magic.php)

