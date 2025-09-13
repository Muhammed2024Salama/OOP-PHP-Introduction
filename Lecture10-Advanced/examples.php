<?php
/**
 * المحاضرة العاشرة: أمثلة على المفاهيم المتقدمة في OOP
 * 
 * هذا الملف يحتوي على أمثلة متنوعة لشرح Namespaces, Autoloading, Traits, Magic Methods
 */

echo "<h1>المحاضرة العاشرة: المفاهيم المتقدمة في OOP</h1>\n";

// ==========================================
// مثال 1: نظام إدارة المحتوى مع Namespaces
// ==========================================
echo "<h2>مثال 1: نظام إدارة المحتوى مع Namespaces</h2>\n";

// محاكاة Namespaces
class MyApp_Models_User {
    private $id;
    private $name;
    private $email;
    private $createdAt;
    
    public function __construct($name, $email) {
        echo "🏗️ <strong>تم إنشاء مستخدم جديد:</strong> " . $name . "<br>";
        
        $this->id = uniqid();
        $this->name = $name;
        $this->email = $email;
        $this->createdAt = date('Y-m-d H:i:s');
        
        echo "✅ <strong>تم تهيئة المستخدم بنجاح</strong><br>";
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

class MyApp_Models_Post {
    private $id;
    private $title;
    private $content;
    private $author;
    private $createdAt;
    
    public function __construct($title, $content, MyApp_Models_User $author) {
        echo "🏗️ <strong>تم إنشاء منشور جديد:</strong> " . $title . "<br>";
        
        $this->id = uniqid();
        $this->title = $title;
        $this->content = $content;
        $this->author = $author;
        $this->createdAt = date('Y-m-d H:i:s');
        
        echo "✅ <strong>تم تهيئة المنشور بنجاح</strong><br>";
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

class MyApp_Services_EmailService {
    public function sendWelcomeEmail(MyApp_Models_User $user) {
        echo "📧 <strong>تم إرسال إيميل ترحيبي إلى:</strong> " . $user->getEmail() . "<br>";
    }
    
    public function sendNotificationEmail(MyApp_Models_User $user, $message) {
        echo "📧 <strong>تم إرسال إشعار إلى:</strong> " . $user->getEmail() . " - الرسالة: " . $message . "<br>";
    }
}

class MyApp_Controllers_UserController {
    private $emailService;
    
    public function __construct() {
        $this->emailService = new MyApp_Services_EmailService();
    }
    
    public function createUser($name, $email) {
        $user = new MyApp_Models_User($name, $email);
        $this->emailService->sendWelcomeEmail($user);
        return $user;
    }
    
    public function notifyUser(MyApp_Models_User $user, $message) {
        $this->emailService->sendNotificationEmail($user, $message);
    }
}

class MyApp_Controllers_PostController {
    private $emailService;
    
    public function __construct() {
        $this->emailService = new MyApp_Services_EmailService();
    }
    
    public function createPost($title, $content, MyApp_Models_User $author) {
        $post = new MyApp_Models_Post($title, $content, $author);
        $this->emailService->sendNotificationEmail($author, "تم إنشاء منشور جديد: " . $title);
        return $post;
    }
}

// استخدام النظام
echo "<h3>استخدام نظام إدارة المحتوى:</h3>\n";

$userController = new MyApp_Controllers_UserController();
$postController = new MyApp_Controllers_PostController();

$user = $userController->createUser("أحمد محمد", "ahmed@example.com");
$post = $postController->createPost("عنوان المنشور", "محتوى المنشور", $user);

echo $user . "<br>";
echo $post . "<br><br>";

// ==========================================
// مثال 2: نظام مع Traits
// ==========================================
echo "<h2>مثال 2: نظام مع Traits</h2>\n";

trait Loggable {
    public function log($message) {
        echo "📝 <strong>[" . date('Y-m-d H:i:s') . "]</strong> " . $message . "<br>";
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

trait Validatable {
    public function validateEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }
    
    public function validateName($name) {
        return !empty($name) && strlen($name) >= 2;
    }
    
    public function validateAge($age) {
        return $age > 0 && $age < 150;
    }
}

class User {
    use Loggable, Timestampable, Cacheable, Validatable;
    
    private $id;
    private $name;
    private $email;
    private $age;
    private $createdAt;
    private $updatedAt;
    
    public function __construct($name, $email, $age) {
        $this->id = uniqid();
        $this->name = $name;
        $this->email = $email;
        $this->age = $age;
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
    
    public function getAge() {
        return $this->age;
    }
    
    public function setName($name) {
        if ($this->validateName($name)) {
            $this->name = $name;
            $this->touch();
            $this->log("تم تحديث اسم المستخدم إلى: " . $name);
            return true;
        }
        $this->log("فشل في تحديث الاسم: " . $name);
        return false;
    }
    
    public function setEmail($email) {
        if ($this->validateEmail($email)) {
            $this->email = $email;
            $this->touch();
            $this->log("تم تحديث إيميل المستخدم إلى: " . $email);
            return true;
        }
        $this->log("فشل في تحديث الإيميل: " . $email);
        return false;
    }
    
    public function setAge($age) {
        if ($this->validateAge($age)) {
            $this->age = $age;
            $this->touch();
            $this->log("تم تحديث عمر المستخدم إلى: " . $age);
            return true;
        }
        $this->log("فشل في تحديث العمر: " . $age);
        return false;
    }
    
    public static function findById($id) {
        // البحث في التخزين المؤقت أولاً
        $user = self::getFromCache($id);
        if ($user) {
            return $user;
        }
        
        // محاكاة البحث في قاعدة البيانات
        $user = new self("مستخدم من قاعدة البيانات", "user@example.com", 25);
        self::setCache($id, $user);
        
        return $user;
    }
    
    public function getInfo() {
        $info = "<strong>المستخدم:</strong> " . $this->name . "<br>";
        $info .= "<strong>الإيميل:</strong> " . $this->email . "<br>";
        $info .= "<strong>العمر:</strong> " . $this->age . "<br>";
        $info .= "<strong>تاريخ الإنشاء:</strong> " . $this->getCreatedAt() . "<br>";
        $info .= "<strong>تاريخ آخر تحديث:</strong> " . $this->getUpdatedAt();
        return $info;
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
        $author = new User("مؤلف من قاعدة البيانات", "author@example.com", 30);
        $post = new self("منشور من قاعدة البيانات", "محتوى المنشور", $author);
        self::setCache($id, $post);
        
        return $post;
    }
    
    public function getInfo() {
        $info = "<strong>المنشور:</strong> " . $this->title . "<br>";
        $info .= "<strong>المحتوى:</strong> " . $this->content . "<br>";
        $info .= "<strong>المؤلف:</strong> " . $this->author->getName() . "<br>";
        $info .= "<strong>تاريخ الإنشاء:</strong> " . $this->getCreatedAt() . "<br>";
        $info .= "<strong>تاريخ آخر تحديث:</strong> " . $this->getUpdatedAt();
        return $info;
    }
}

// استخدام النظام مع Traits
echo "<h3>استخدام النظام مع Traits:</h3>\n";

$user = new User("أحمد محمد", "ahmed@example.com", 25);
$user->setName("أحمد السعد");
$user->setEmail("ahmed.saad@example.com");
$user->setAge(26);

$post = new Post("عنوان المنشور", "محتوى المنشور", $user);
$post->setTitle("عنوان محدث");
$post->setContent("محتوى محدث");

echo "<h4>معلومات المستخدم:</h4>\n";
echo $user->getInfo() . "<br><br>";

echo "<h4>معلومات المنشور:</h4>\n";
echo $post->getInfo() . "<br><br>";

// اختبار التخزين المؤقت
$cachedUser = User::findById("test-id");
echo "<h4>المستخدم من التخزين المؤقت:</h4>\n";
echo $cachedUser->getInfo() . "<br><br>";

// مسح التخزين المؤقت
User::clearCache();
Post::clearCache();

// ==========================================
// مثال 3: نظام مع Magic Methods
// ==========================================
echo "<h2>مثال 3: نظام مع Magic Methods</h2>\n";

class DynamicUser {
    private $data = [];
    private $callbacks = [];
    
    public function __construct($name, $email) {
        $this->data['name'] = $name;
        $this->data['email'] = $email;
        $this->data['createdAt'] = date('Y-m-d H:i:s');
        $this->data['updatedAt'] = date('Y-m-d H:i:s');
        
        echo "🏗️ <strong>تم إنشاء مستخدم ديناميكي:</strong> " . $name . "<br>";
    }
    
    // __get - الوصول للخصائص
    public function __get($name) {
        if (isset($this->data[$name])) {
            return $this->data[$name];
        }
        return null;
    }
    
    // __set - تعيين الخصائص
    public function __set($name, $value) {
        $oldValue = $this->data[$name] ?? null;
        $this->data[$name] = $value;
        $this->data['updatedAt'] = date('Y-m-d H:i:s');
        
        // استدعاء callback إذا كان موجود
        if (isset($this->callbacks[$name])) {
            $this->callbacks[$name]($name, $value, $oldValue);
        }
    }
    
    // __isset - التحقق من وجود الخاصية
    public function __isset($name) {
        return isset($this->data[$name]);
    }
    
    // __unset - حذف الخاصية
    public function __unset($name) {
        unset($this->data[$name]);
        $this->data['updatedAt'] = date('Y-m-d H:i:s');
    }
    
    // __call - استدعاء الطرق الديناميكية
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
    
    // __toString - تحويل الكائن إلى نص
    public function __toString() {
        return "المستخدم: " . $this->name . " - الإيميل: " . $this->email;
    }
    
    // __invoke - استدعاء الكائن كدالة
    public function __invoke($method, ...$arguments) {
        return $this->$method(...$arguments);
    }
    
    // __debugInfo - معلومات التصحيح
    public function __debugInfo() {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt,
            'totalProperties' => count($this->data)
        ];
    }
    
    // __sleep - تسلسل الكائن
    public function __sleep() {
        return ['data'];
    }
    
    // __wakeup - إلغاء تسلسل الكائن
    public function __wakeup() {
        $this->data['wakeupAt'] = date('Y-m-d H:i:s');
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

// استخدام النظام مع Magic Methods
echo "<h3>استخدام النظام مع Magic Methods:</h3>\n";

$user = new DynamicUser("أحمد محمد", "ahmed@example.com");

// استخدام __get و __set
echo "<h4>استخدام __get و __set:</h4>\n";
echo "الاسم: " . $user->name . "<br>";
echo "الإيميل: " . $user->email . "<br>";

$user->name = "أحمد السعد";
$user->email = "ahmed.saad@example.com";

// استخدام __call
echo "<h4>استخدام __call:</h4>\n";
echo "الاسم: " . $user->getName() . "<br>";
echo "الإيميل: " . $user->getEmail() . "<br>";

$user->setName("محمد أحمد");
$user->setEmail("mohammed@example.com");

// استخدام __isset و __unset
echo "<h4>استخدام __isset و __unset:</h4>\n";
if (isset($user->name)) {
    echo "الاسم موجود<br>";
}

unset($user->name);
if (!isset($user->name)) {
    echo "الاسم تم حذفه<br>";
}

// استخدام __invoke
echo "<h4>استخدام __invoke:</h4>\n";
$user->setName("فاطمة علي");
echo "الاسم: " . $user->getName() . "<br>";

// استخدام callback
echo "<h4>استخدام callback:</h4>\n";
$user->onPropertyChange('email', function($property, $newValue, $oldValue) {
    echo "تم تغيير $property من '$oldValue' إلى '$newValue'<br>";
});

$user->email = "fatima@example.com";

// استخدام __toString
echo "<h4>استخدام __toString:</h4>\n";
echo $user . "<br>";

// استخدام __debugInfo
echo "<h4>استخدام __debugInfo:</h4>\n";
var_dump($user);

// ==========================================
// مثال 4: نظام Autoloading محاكي
// ==========================================
echo "<h2>مثال 4: نظام Autoloading محاكي</h2>\n";

class Autoloader {
    private static $registered = false;
    private static $paths = [];
    
    public static function register() {
        if (!self::$registered) {
            spl_autoload_register([self::class, 'load']);
            self::$registered = true;
            echo "🏗️ <strong>تم تسجيل Autoloader</strong><br>";
        }
    }
    
    public static function addPath($path) {
        self::$paths[] = $path;
        echo "📁 <strong>تم إضافة مسار:</strong> " . $path . "<br>";
    }
    
    public static function load($class) {
        // تحويل namespace إلى مسار ملف
        $file = str_replace('\\', '/', $class) . '.php';
        
        // البحث في المسارات المضافة
        foreach (self::$paths as $path) {
            $fullPath = $path . '/' . $file;
            if (file_exists($fullPath)) {
                require_once $fullPath;
                echo "📥 <strong>تم تحميل الكلاس:</strong> " . $class . " من " . $fullPath . "<br>";
                return;
            }
        }
        
        // البحث في المسار الحالي
        if (file_exists($file)) {
            require_once $file;
            echo "📥 <strong>تم تحميل الكلاس:</strong> " . $class . " من " . $file . "<br>";
            return;
        }
        
        echo "❌ <strong>لم يتم العثور على الكلاس:</strong> " . $class . "<br>";
    }
    
    public static function getPaths() {
        return self::$paths;
    }
    
    public static function isRegistered() {
        return self::$registered;
    }
}

// استخدام Autoloader
echo "<h3>استخدام Autoloader:</h3>\n";

Autoloader::register();
Autoloader::addPath('src');
Autoloader::addPath('lib');

echo "المسارات المسجلة: " . implode(", ", Autoloader::getPaths()) . "<br>";
echo "حالة التسجيل: " . (Autoloader::isRegistered() ? "مسجل" : "غير مسجل") . "<br><br>";

// ==========================================
// خلاصة المحاضرة
// ==========================================
echo "<hr>";
echo "<h2>🎯 خلاصة المحاضرة</h2>";
echo "<div style='background-color: #f0f8ff; padding: 20px; border-radius: 10px;'>";
echo "<h3>ما تعلمناه:</h3>";
echo "<ul>";
echo "<li><strong>Namespaces:</strong> تنظم الكود وتجنب تضارب الأسماء</li>";
echo "<li><strong>Autoloading:</strong> يحمل الكلاسات تلقائياً عند الحاجة</li>";
echo "<li><strong>Traits:</strong> تسمح بإعادة استخدام الكود</li>";
echo "<li><strong>Magic Methods:</strong> تتحكم في السلوك الخاص للكائنات</li>";
echo "<li><strong>__get و __set:</strong> للوصول الديناميكي للخصائص</li>";
echo "<li><strong>__call:</strong> لاستدعاء الطرق الديناميكية</li>";
echo "<li><strong>__toString:</strong> لتحويل الكائن إلى نص</li>";
echo "<li><strong>__invoke:</strong> لاستدعاء الكائن كدالة</li>";
echo "</ul>";

echo "<h3>أفضل الممارسات:</h3>";
echo "<ul>";
echo "<li>استخدم Namespaces لتنظيم الكود</li>";
echo "<li>استخدم Autoloading لتجنب require</li>";
echo "<li>استخدم Traits للوظائف المشتركة</li>";
echo "<li>استخدم Magic Methods بحذر</li>";
echo "<li>وثق الكود جيداً</li>";
echo "<li>اتبع معايير PSR</li>";
echo "</ul>";
echo "</div>";
?>


