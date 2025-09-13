<?php
/**
 * المحاضرة الثامنة: أمثلة على الكلاسات المجردة والواجهات
 * 
 * هذا الملف يحتوي على أمثلة متنوعة لشرح مفهوم Abstract Classes و Interfaces
 */

echo "<h1>المحاضرة الثامنة: الكلاسات المجردة والواجهات</h1>\n";

// ==========================================
// مثال 1: نظام الأشكال مع Abstract Classes
// ==========================================
echo "<h2>مثال 1: نظام الأشكال مع Abstract Classes</h2>\n";

abstract class Shape {
    protected $name;
    protected $color;
    protected $createdAt;
    
    public function __construct($name, $color) {
        echo "🏗️ <strong>تم إنشاء شكل جديد:</strong> " . $name . "<br>";
        
        $this->name = $name;
        $this->color = $color;
        $this->createdAt = date('Y-m-d H:i:s');
        
        echo "✅ <strong>تم تهيئة الشكل بنجاح</strong><br>";
    }
    
    // طرق عادية
    public function getName() {
        return $this->name;
    }
    
    public function getColor() {
        return $this->color;
    }
    
    public function setColor($color) {
        $this->color = $color;
        return "تم تغيير اللون إلى: " . $color;
    }
    
    public function getCreatedAt() {
        return $this->createdAt;
    }
    
    // طرق مجردة - يجب تنفيذها في الكلاسات الموروثة
    abstract public function calculateArea();
    abstract public function calculatePerimeter();
    abstract public function draw();
    abstract public function getInfo();
}

class Circle extends Shape {
    private $radius;
    
    public function __construct($name, $color, $radius) {
        parent::__construct($name, $color);
        $this->radius = $radius;
    }
    
    // تنفيذ الطرق المجردة
    public function calculateArea() {
        return 3.14 * $this->radius * $this->radius;
    }
    
    public function calculatePerimeter() {
        return 2 * 3.14 * $this->radius;
    }
    
    public function draw() {
        return "رسم دائرة " . $this->name . " باللون " . $this->color . " ونصف قطر " . $this->radius;
    }
    
    public function getInfo() {
        $info = "<strong>الشكل:</strong> " . $this->name . "<br>";
        $info .= "<strong>النوع:</strong> دائرة<br>";
        $info .= "<strong>اللون:</strong> " . $this->color . "<br>";
        $info .= "<strong>نصف القطر:</strong> " . $this->radius . "<br>";
        $info .= "<strong>المساحة:</strong> " . $this->calculateArea() . "<br>";
        $info .= "<strong>المحيط:</strong> " . $this->calculatePerimeter() . "<br>";
        $info .= "<strong>تاريخ الإنشاء:</strong> " . $this->createdAt;
        return $info;
    }
    
    public function getRadius() {
        return $this->radius;
    }
    
    public function setRadius($radius) {
        if ($radius > 0) {
            $this->radius = $radius;
            return "تم تحديث نصف القطر إلى: " . $radius;
        }
        return "نصف القطر يجب أن يكون أكبر من صفر";
    }
}

class Rectangle extends Shape {
    private $width;
    private $height;
    
    public function __construct($name, $color, $width, $height) {
        parent::__construct($name, $color);
        $this->width = $width;
        $this->height = $height;
    }
    
    // تنفيذ الطرق المجردة
    public function calculateArea() {
        return $this->width * $this->height;
    }
    
    public function calculatePerimeter() {
        return 2 * ($this->width + $this->height);
    }
    
    public function draw() {
        return "رسم مستطيل " . $this->name . " باللون " . $this->color . " وأبعاد " . $this->width . "x" . $this->height;
    }
    
    public function getInfo() {
        $info = "<strong>الشكل:</strong> " . $this->name . "<br>";
        $info .= "<strong>النوع:</strong> مستطيل<br>";
        $info .= "<strong>اللون:</strong> " . $this->color . "<br>";
        $info .= "<strong>العرض:</strong> " . $this->width . "<br>";
        $info .= "<strong>الارتفاع:</strong> " . $this->height . "<br>";
        $info .= "<strong>المساحة:</strong> " . $this->calculateArea() . "<br>";
        $info .= "<strong>المحيط:</strong> " . $this->calculatePerimeter() . "<br>";
        $info .= "<strong>تاريخ الإنشاء:</strong> " . $this->createdAt;
        return $info;
    }
    
    public function getWidth() {
        return $this->width;
    }
    
    public function getHeight() {
        return $this->height;
    }
    
    public function setDimensions($width, $height) {
        if ($width > 0 && $height > 0) {
            $this->width = $width;
            $this->height = $height;
            return "تم تحديث الأبعاد إلى: " . $width . "x" . $height;
        }
        return "الأبعاد يجب أن تكون أكبر من صفر";
    }
}

class Triangle extends Shape {
    private $base;
    private $height;
    private $side1;
    private $side2;
    private $side3;
    
    public function __construct($name, $color, $base, $height, $side1, $side2, $side3) {
        parent::__construct($name, $color);
        $this->base = $base;
        $this->height = $height;
        $this->side1 = $side1;
        $this->side2 = $side2;
        $this->side3 = $side3;
    }
    
    // تنفيذ الطرق المجردة
    public function calculateArea() {
        return 0.5 * $this->base * $this->height;
    }
    
    public function calculatePerimeter() {
        return $this->side1 + $this->side2 + $this->side3;
    }
    
    public function draw() {
        return "رسم مثلث " . $this->name . " باللون " . $this->color . " وقاعدة " . $this->base . " وارتفاع " . $this->height;
    }
    
    public function getInfo() {
        $info = "<strong>الشكل:</strong> " . $this->name . "<br>";
        $info .= "<strong>النوع:</strong> مثلث<br>";
        $info .= "<strong>اللون:</strong> " . $this->color . "<br>";
        $info .= "<strong>القاعدة:</strong> " . $this->base . "<br>";
        $info .= "<strong>الارتفاع:</strong> " . $this->height . "<br>";
        $info .= "<strong>الأضلاع:</strong> " . $this->side1 . ", " . $this->side2 . ", " . $this->side3 . "<br>";
        $info .= "<strong>المساحة:</strong> " . $this->calculateArea() . "<br>";
        $info .= "<strong>المحيط:</strong> " . $this->calculatePerimeter() . "<br>";
        $info .= "<strong>تاريخ الإنشاء:</strong> " . $this->createdAt;
        return $info;
    }
    
    public function getBase() {
        return $this->base;
    }
    
    public function getHeight() {
        return $this->height;
    }
    
    public function getSides() {
        return [$this->side1, $this->side2, $this->side3];
    }
}

// استخدام الكلاسات المجردة
echo "<h3>استخدام الكلاسات المجردة:</h3>\n";

$circle = new Circle("دائرة كبيرة", "أحمر", 5);
$rectangle = new Rectangle("مستطيل صغير", "أزرق", 4, 6);
$triangle = new Triangle("مثلث متساوي الأضلاع", "أخضر", 6, 5, 6, 6, 6);

echo "<h4>الدائرة:</h4>\n";
echo $circle->getInfo() . "<br><br>";

echo "<h4>المستطيل:</h4>\n";
echo $rectangle->getInfo() . "<br><br>";

echo "<h4>المثلث:</h4>\n";
echo $triangle->getInfo() . "<br><br>";

// ==========================================
// مثال 2: نظام الحيوانات مع Interfaces
// ==========================================
echo "<h2>مثال 2: نظام الحيوانات مع Interfaces</h2>\n";

interface Flyable {
    public function fly();
    public function land();
}

interface Swimmable {
    public function swim();
    public function dive();
}

interface Walkable {
    public function walk();
    public function run();
}

class Bird implements Flyable, Walkable {
    private $name;
    private $species;
    private $wingspan;
    
    public function __construct($name, $species, $wingspan) {
        echo "🏗️ <strong>تم إنشاء طائر جديد:</strong> " . $name . "<br>";
        
        $this->name = $name;
        $this->species = $species;
        $this->wingspan = $wingspan;
        
        echo "✅ <strong>تم تهيئة الطائر بنجاح</strong><br>";
    }
    
    // تنفيذ واجهة Flyable
    public function fly() {
        return $this->name . " يطير في السماء بجناحين طولهما " . $this->wingspan . " سم";
    }
    
    public function land() {
        return $this->name . " يهبط على الأرض";
    }
    
    // تنفيذ واجهة Walkable
    public function walk() {
        return $this->name . " يمشي على الأرض";
    }
    
    public function run() {
        return $this->name . " يركض بسرعة";
    }
    
    public function getInfo() {
        $info = "<strong>الطائر:</strong> " . $this->name . "<br>";
        $info .= "<strong>النوع:</strong> " . $this->species . "<br>";
        $info .= "<strong>طول الجناح:</strong> " . $this->wingspan . " سم<br>";
        $info .= "<strong>القدرات:</strong> طيران، مشي، ركض";
        return $info;
    }
}

class Fish implements Swimmable {
    private $name;
    private $species;
    private $size;
    
    public function __construct($name, $species, $size) {
        echo "🏗️ <strong>تم إنشاء سمكة جديدة:</strong> " . $name . "<br>";
        
        $this->name = $name;
        $this->species = $species;
        $this->size = $size;
        
        echo "✅ <strong>تم تهيئة السمكة بنجاح</strong><br>";
    }
    
    // تنفيذ واجهة Swimmable
    public function swim() {
        return $this->name . " يسبح في الماء بحركة انسيابية";
    }
    
    public function dive() {
        return $this->name . " يغوص في الأعماق";
    }
    
    public function getInfo() {
        $info = "<strong>السمكة:</strong> " . $this->name . "<br>";
        $info .= "<strong>النوع:</strong> " . $this->species . "<br>";
        $info .= "<strong>الحجم:</strong> " . $this->size . " سم<br>";
        $info .= "<strong>القدرات:</strong> سباحة، غوص";
        return $info;
    }
}

class Duck implements Flyable, Swimmable, Walkable {
    private $name;
    private $color;
    private $age;
    
    public function __construct($name, $color, $age) {
        echo "🏗️ <strong>تم إنشاء بطة جديدة:</strong> " . $name . "<br>";
        
        $this->name = $name;
        $this->color = $color;
        $this->age = $age;
        
        echo "✅ <strong>تم تهيئة البطة بنجاح</strong><br>";
    }
    
    // تنفيذ واجهة Flyable
    public function fly() {
        return $this->name . " يطير في السماء";
    }
    
    public function land() {
        return $this->name . " يهبط على الماء";
    }
    
    // تنفيذ واجهة Swimmable
    public function swim() {
        return $this->name . " يسبح في الماء";
    }
    
    public function dive() {
        return $this->name . " يغوص في الماء";
    }
    
    // تنفيذ واجهة Walkable
    public function walk() {
        return $this->name . " يمشي على الأرض";
    }
    
    public function run() {
        return $this->name . " يركض على الأرض";
    }
    
    public function getInfo() {
        $info = "<strong>البطة:</strong> " . $this->name . "<br>";
        $info .= "<strong>اللون:</strong> " . $this->color . "<br>";
        $info .= "<strong>العمر:</strong> " . $this->age . " سنوات<br>";
        $info .= "<strong>القدرات:</strong> طيران، سباحة، غوص، مشي، ركض";
        return $info;
    }
}

// استخدام الواجهات
echo "<h3>استخدام الواجهات:</h3>\n";

$bird = new Bird("عصفور", "عصفور منزلي", 15);
$fish = new Fish("سمكة ذهبية", "سمكة ذهبية", 10);
$duck = new Duck("بطة", "أبيض", 2);

echo "<h4>الطائر:</h4>\n";
echo $bird->getInfo() . "<br>";
echo $bird->fly() . "<br>";
echo $bird->land() . "<br>";
echo $bird->walk() . "<br>";
echo $bird->run() . "<br><br>";

echo "<h4>السمكة:</h4>\n";
echo $fish->getInfo() . "<br>";
echo $fish->swim() . "<br>";
echo $fish->dive() . "<br><br>";

echo "<h4>البطة:</h4>\n";
echo $duck->getInfo() . "<br>";
echo $duck->fly() . "<br>";
echo $duck->swim() . "<br>";
echo $duck->walk() . "<br>";
echo $duck->dive() . "<br><br>";

// ==========================================
// مثال 3: نظام قاعدة البيانات مع Abstract Classes و Interfaces
// ==========================================
echo "<h2>مثال 3: نظام قاعدة البيانات</h2>\n";

interface DatabaseInterface {
    public function connect();
    public function disconnect();
    public function query($sql);
    public function fetch($result);
    public function getConnectionInfo();
}

abstract class Database implements DatabaseInterface {
    protected $host;
    protected $username;
    protected $password;
    protected $database;
    protected $connection;
    protected $isConnected;
    protected $queryCount;
    
    public function __construct($host, $username, $password, $database) {
        echo "🏗️ <strong>تم إنشاء اتصال قاعدة بيانات جديد</strong><br>";
        
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
        $this->connection = null;
        $this->isConnected = false;
        $this->queryCount = 0;
        
        echo "✅ <strong>تم تهيئة الاتصال بنجاح</strong><br>";
    }
    
    // طرق عادية
    public function disconnect() {
        if ($this->isConnected) {
            $this->connection = null;
            $this->isConnected = false;
            return "تم قطع الاتصال بقاعدة البيانات";
        }
        return "لا يوجد اتصال نشط";
    }
    
    public function getQueryCount() {
        return $this->queryCount;
    }
    
    public function resetQueryCount() {
        $this->queryCount = 0;
        return "تم إعادة تعيين عداد الاستعلامات";
    }
    
    // طرق مجردة - يجب تنفيذها في الكلاسات الموروثة
    abstract public function connect();
    abstract public function query($sql);
    abstract public function fetch($result);
    abstract public function getConnectionInfo();
}

class MySQLDatabase extends Database {
    public function connect() {
        if (!$this->isConnected) {
            // محاكاة الاتصال بـ MySQL
            $this->connection = "mysql_connection_" . uniqid();
            $this->isConnected = true;
            return "تم الاتصال بـ MySQL: " . $this->database . " على " . $this->host;
        }
        return "الاتصال موجود بالفعل";
    }
    
    public function query($sql) {
        if ($this->isConnected) {
            $this->queryCount++;
            return "تم تنفيذ استعلام MySQL: " . $sql . " (الاستعلام رقم: " . $this->queryCount . ")";
        }
        return "يجب الاتصال بقاعدة البيانات أولاً";
    }
    
    public function fetch($result) {
        if ($this->isConnected) {
            return "تم جلب البيانات من MySQL";
        }
        return "يجب الاتصال بقاعدة البيانات أولاً";
    }
    
    public function getConnectionInfo() {
        $info = "<strong>نوع قاعدة البيانات:</strong> MySQL<br>";
        $info .= "<strong>المضيف:</strong> " . $this->host . "<br>";
        $info .= "<strong>اسم المستخدم:</strong> " . $this->username . "<br>";
        $info .= "<strong>قاعدة البيانات:</strong> " . $this->database . "<br>";
        $info .= "<strong>الحالة:</strong> " . ($this->isConnected ? "متصل" : "غير متصل") . "<br>";
        $info .= "<strong>عدد الاستعلامات:</strong> " . $this->queryCount;
        return $info;
    }
}

class PostgreSQLDatabase extends Database {
    public function connect() {
        if (!$this->isConnected) {
            // محاكاة الاتصال بـ PostgreSQL
            $this->connection = "postgresql_connection_" . uniqid();
            $this->isConnected = true;
            return "تم الاتصال بـ PostgreSQL: " . $this->database . " على " . $this->host;
        }
        return "الاتصال موجود بالفعل";
    }
    
    public function query($sql) {
        if ($this->isConnected) {
            $this->queryCount++;
            return "تم تنفيذ استعلام PostgreSQL: " . $sql . " (الاستعلام رقم: " . $this->queryCount . ")";
        }
        return "يجب الاتصال بقاعدة البيانات أولاً";
    }
    
    public function fetch($result) {
        if ($this->isConnected) {
            return "تم جلب البيانات من PostgreSQL";
        }
        return "يجب الاتصال بقاعدة البيانات أولاً";
    }
    
    public function getConnectionInfo() {
        $info = "<strong>نوع قاعدة البيانات:</strong> PostgreSQL<br>";
        $info .= "<strong>المضيف:</strong> " . $this->host . "<br>";
        $info .= "<strong>اسم المستخدم:</strong> " . $this->username . "<br>";
        $info .= "<strong>قاعدة البيانات:</strong> " . $this->database . "<br>";
        $info .= "<strong>الحالة:</strong> " . ($this->isConnected ? "متصل" : "غير متصل") . "<br>";
        $info .= "<strong>عدد الاستعلامات:</strong> " . $this->queryCount;
        return $info;
    }
}

class SQLiteDatabase extends Database {
    public function connect() {
        if (!$this->isConnected) {
            // محاكاة الاتصال بـ SQLite
            $this->connection = "sqlite_connection_" . uniqid();
            $this->isConnected = true;
            return "تم الاتصال بـ SQLite: " . $this->database;
        }
        return "الاتصال موجود بالفعل";
    }
    
    public function query($sql) {
        if ($this->isConnected) {
            $this->queryCount++;
            return "تم تنفيذ استعلام SQLite: " . $sql . " (الاستعلام رقم: " . $this->queryCount . ")";
        }
        return "يجب الاتصال بقاعدة البيانات أولاً";
    }
    
    public function fetch($result) {
        if ($this->isConnected) {
            return "تم جلب البيانات من SQLite";
        }
        return "يجب الاتصال بقاعدة البيانات أولاً";
    }
    
    public function getConnectionInfo() {
        $info = "<strong>نوع قاعدة البيانات:</strong> SQLite<br>";
        $info .= "<strong>المضيف:</strong> " . $this->host . "<br>";
        $info .= "<strong>اسم المستخدم:</strong> " . $this->username . "<br>";
        $info .= "<strong>قاعدة البيانات:</strong> " . $this->database . "<br>";
        $info .= "<strong>الحالة:</strong> " . ($this->isConnected ? "متصل" : "غير متصل") . "<br>";
        $info .= "<strong>عدد الاستعلامات:</strong> " . $this->queryCount;
        return $info;
    }
}

// استخدام الكلاسات المجردة والواجهات
echo "<h3>استخدام الكلاسات المجردة والواجهات:</h3>\n";

$mysql = new MySQLDatabase("localhost", "root", "password", "myapp");
$postgres = new PostgreSQLDatabase("localhost", "postgres", "password", "myapp");
$sqlite = new SQLiteDatabase("localhost", "user", "password", "myapp.db");

echo "<h4>MySQL:</h4>\n";
echo $mysql->connect() . "<br>";
echo $mysql->query("SELECT * FROM users") . "<br>";
echo $mysql->query("INSERT INTO users (name) VALUES ('أحمد')") . "<br>";
echo $mysql->fetch("result") . "<br>";
echo $mysql->getConnectionInfo() . "<br><br>";

echo "<h4>PostgreSQL:</h4>\n";
echo $postgres->connect() . "<br>";
echo $postgres->query("SELECT * FROM products") . "<br>";
echo $postgres->query("UPDATE products SET price = 100") . "<br>";
echo $postgres->fetch("result") . "<br>";
echo $postgres->getConnectionInfo() . "<br><br>";

echo "<h4>SQLite:</h4>\n";
echo $sqlite->connect() . "<br>";
echo $sqlite->query("SELECT * FROM orders") . "<br>";
echo $sqlite->query("DELETE FROM orders WHERE id = 1") . "<br>";
echo $sqlite->fetch("result") . "<br>";
echo $sqlite->getConnectionInfo() . "<br><br>";

// ==========================================
// خلاصة المحاضرة
// ==========================================
echo "<hr>";
echo "<h2>🎯 خلاصة المحاضرة</h2>";
echo "<div style='background-color: #f0f8ff; padding: 20px; border-radius: 10px;'>";
echo "<h3>ما تعلمناه:</h3>";
echo "<ul>";
echo "<li><strong>Abstract Classes:</strong> كلاسات لا يمكن إنشاء كائنات منها ولكن يمكن وراثتها</li>";
echo "<li><strong>Interfaces:</strong> عقود تحدد الطرق التي يجب تنفيذها</li>";
echo "<li><strong>الفرق بينهما:</strong> Abstract Classes يمكن أن تحتوي على طرق عادية</li>";
echo "<li><strong>استخدام Abstract Classes:</strong> للكلاسات ذات العلاقة</li>";
echo "<li><strong>استخدام Interfaces:</strong> للعقود والواجهات</li>";
echo "<li><strong>تعدد الوراثة:</strong> Interfaces تدعم تعدد الوراثة</li>";
echo "</ul>";

echo "<h3>أفضل الممارسات:</h3>";
echo "<ul>";
echo "<li>استخدم Abstract Classes للكلاسات ذات العلاقة</li>";
echo "<li>استخدم Interfaces للعقود</li>";
echo "<li>تجنب الوراثة العميقة</li>";
echo "<li>استخدم أسماء وصفية</li>";
echo "<li>وثق الطرق المجردة</li>";
echo "<li>اتبع مبدأ Single Responsibility</li>";
echo "</ul>";
echo "</div>";
?>


