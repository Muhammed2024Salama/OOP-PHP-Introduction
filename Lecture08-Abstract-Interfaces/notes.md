# المحاضرة الثامنة: الكلاسات المجردة والواجهات (Abstract Classes and Interfaces)

## 📚 جدول المحتويات
1. [ما هي الكلاسات المجردة؟](#ما-هي-الكلاسات-المجردة)
2. [ما هي الواجهات؟](#ما-هي-الواجهات)
3. [الفرق بين Abstract Classes و Interfaces](#الفرق-بين-abstract-classes-و-interfaces)
4. [أمثلة عملية](#أمثلة-عملية)
5. [أفضل الممارسات](#أفضل-الممارسات)

---

## ما هي الكلاسات المجردة؟

**الكلاسات المجردة (Abstract Classes)** هي كلاسات لا يمكن إنشاء كائنات منها مباشرة، ولكن يمكن وراثتها من قبل كلاسات أخرى.

### 🎯 خصائص الكلاسات المجردة:
- **لا يمكن إنشاء كائنات منها**: `new AbstractClass()` ❌
- **يمكن وراثتها**: `class Child extends AbstractClass` ✅
- **يمكن أن تحتوي على طرق مجردة**: `abstract public function method()`
- **يمكن أن تحتوي على طرق عادية**: `public function normalMethod()`
- **يمكن أن تحتوي على خصائص**: `protected $property`

### 📝 **البناء الأساسي:**
```php
<?php
abstract class Animal {
    protected $name;
    
    public function __construct($name) {
        $this->name = $name;
    }
    
    // طريقة عادية
    public function getName() {
        return $this->name;
    }
    
    // طريقة مجردة - يجب تنفيذها في الكلاس الموروث
    abstract public function makeSound();
    abstract public function move();
}

class Dog extends Animal {
    public function makeSound() {
        return $this->name . " ينبح";
    }
    
    public function move() {
        return $this->name . " يركض";
    }
}
```

---

## ما هي الواجهات؟

**الواجهات (Interfaces)** هي عقود تحدد الطرق التي يجب أن تنفذها الكلاسات التي تستخدمها.

### 🎯 خصائص الواجهات:
- **لا يمكن إنشاء كائنات منها**: `new Interface()` ❌
- **يمكن تنفيذها**: `class MyClass implements Interface` ✅
- **تحتوي على طرق مجردة فقط**: `public function method()`
- **لا تحتوي على خصائص**: فقط طرق
- **يمكن تنفيذ عدة واجهات**: `implements Interface1, Interface2`

### 📝 **البناء الأساسي:**
```php
<?php
interface Flyable {
    public function fly();
    public function land();
}

interface Swimmable {
    public function swim();
    public function dive();
}

class Duck implements Flyable, Swimmable {
    public function fly() {
        return "البطة تطير";
    }
    
    public function land() {
        return "البطة تهبط";
    }
    
    public function swim() {
        return "البطة تسبح";
    }
    
    public function dive() {
        return "البطة تغوص";
    }
}
```

---

## الفرق بين Abstract Classes و Interfaces

| الجانب | Abstract Classes | Interfaces |
|--------|------------------|------------|
| **الكلمة المفتاحية** | `abstract class` | `interface` |
| **الوراثة** | `extends` | `implements` |
| **الطرق العادية** | ✅ مسموح | ❌ غير مسموح |
| **الطرق المجردة** | ✅ مسموح | ✅ مسموح فقط |
| **الخصائص** | ✅ مسموح | ❌ غير مسموح |
| **Constructor** | ✅ مسموح | ❌ غير مسموح |
| **تعدد الوراثة** | ❌ غير مسموح | ✅ مسموح |
| **الاستخدام** | للكلاسات ذات العلاقة | للعقود والواجهات |

---

## أمثلة عملية

### مثال 1: نظام الأشكال مع Abstract Classes
```php
<?php
abstract class Shape {
    protected $name;
    protected $color;
    
    public function __construct($name, $color) {
        $this->name = $name;
        $this->color = $color;
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function getColor() {
        return $this->color;
    }
    
    public function setColor($color) {
        $this->color = $color;
    }
    
    // طرق مجردة - يجب تنفيذها في الكلاسات الموروثة
    abstract public function calculateArea();
    abstract public function calculatePerimeter();
    abstract public function draw();
}

class Circle extends Shape {
    private $radius;
    
    public function __construct($name, $color, $radius) {
        parent::__construct($name, $color);
        $this->radius = $radius;
    }
    
    public function calculateArea() {
        return 3.14 * $this->radius * $this->radius;
    }
    
    public function calculatePerimeter() {
        return 2 * 3.14 * $this->radius;
    }
    
    public function draw() {
        return "رسم دائرة " . $this->name . " باللون " . $this->color . " ونصف قطر " . $this->radius;
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
    
    public function calculateArea() {
        return $this->width * $this->height;
    }
    
    public function calculatePerimeter() {
        return 2 * ($this->width + $this->height);
    }
    
    public function draw() {
        return "رسم مستطيل " . $this->name . " باللون " . $this->color . " وأبعاد " . $this->width . "x" . $this->height;
    }
}

// استخدام الكلاسات
$circle = new Circle("دائرة كبيرة", "أحمر", 5);
$rectangle = new Rectangle("مستطيل صغير", "أزرق", 4, 6);

echo $circle->draw() . "\n";
echo "المساحة: " . $circle->calculateArea() . "\n";
echo "المحيط: " . $circle->calculatePerimeter() . "\n\n";

echo $rectangle->draw() . "\n";
echo "المساحة: " . $rectangle->calculateArea() . "\n";
echo "المحيط: " . $rectangle->calculatePerimeter() . "\n";
```

### مثال 2: نظام الحيوانات مع Interfaces
```php
<?php
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
    
    public function __construct($name) {
        $this->name = $name;
    }
    
    public function fly() {
        return $this->name . " يطير في السماء";
    }
    
    public function land() {
        return $this->name . " يهبط على الأرض";
    }
    
    public function walk() {
        return $this->name . " يمشي على الأرض";
    }
    
    public function run() {
        return $this->name . " يركض بسرعة";
    }
}

class Fish implements Swimmable {
    private $name;
    
    public function __construct($name) {
        $this->name = $name;
    }
    
    public function swim() {
        return $this->name . " يسبح في الماء";
    }
    
    public function dive() {
        return $this->name . " يغوص في الأعماق";
    }
}

class Duck implements Flyable, Swimmable, Walkable {
    private $name;
    
    public function __construct($name) {
        $this->name = $name;
    }
    
    public function fly() {
        return $this->name . " يطير في السماء";
    }
    
    public function land() {
        return $this->name . " يهبط على الماء";
    }
    
    public function swim() {
        return $this->name . " يسبح في الماء";
    }
    
    public function dive() {
        return $this->name . " يغوص في الماء";
    }
    
    public function walk() {
        return $this->name . " يمشي على الأرض";
    }
    
    public function run() {
        return $this->name . " يركض على الأرض";
    }
}

// استخدام الكلاسات
$bird = new Bird("عصفور");
$fish = new Fish("سمكة");
$duck = new Duck("بطة");

echo "=== الطائر ===\n";
echo $bird->fly() . "\n";
echo $bird->land() . "\n";
echo $bird->walk() . "\n\n";

echo "=== السمكة ===\n";
echo $fish->swim() . "\n";
echo $fish->dive() . "\n\n";

echo "=== البطة ===\n";
echo $duck->fly() . "\n";
echo $duck->swim() . "\n";
echo $duck->walk() . "\n";
```

### مثال 3: نظام قاعدة البيانات مع Abstract Classes و Interfaces
```php
<?php
interface DatabaseInterface {
    public function connect();
    public function disconnect();
    public function query($sql);
    public function fetch($result);
}

abstract class Database implements DatabaseInterface {
    protected $host;
    protected $username;
    protected $password;
    protected $database;
    protected $connection;
    
    public function __construct($host, $username, $password, $database) {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
    }
    
    public function disconnect() {
        if ($this->connection) {
            $this->connection = null;
            return "تم قطع الاتصال";
        }
        return "لا يوجد اتصال نشط";
    }
    
    // طرق مجردة - يجب تنفيذها في الكلاسات الموروثة
    abstract public function connect();
    abstract public function query($sql);
    abstract public function fetch($result);
}

class MySQLDatabase extends Database {
    public function connect() {
        // محاكاة الاتصال بـ MySQL
        $this->connection = "mysql_connection_" . uniqid();
        return "تم الاتصال بـ MySQL: " . $this->database;
    }
    
    public function query($sql) {
        if ($this->connection) {
            return "تم تنفيذ استعلام MySQL: " . $sql;
        }
        return "يجب الاتصال بقاعدة البيانات أولاً";
    }
    
    public function fetch($result) {
        return "تم جلب البيانات من MySQL";
    }
}

class PostgreSQLDatabase extends Database {
    public function connect() {
        // محاكاة الاتصال بـ PostgreSQL
        $this->connection = "postgresql_connection_" . uniqid();
        return "تم الاتصال بـ PostgreSQL: " . $this->database;
    }
    
    public function query($sql) {
        if ($this->connection) {
            return "تم تنفيذ استعلام PostgreSQL: " . $sql;
        }
        return "يجب الاتصال بقاعدة البيانات أولاً";
    }
    
    public function fetch($result) {
        return "تم جلب البيانات من PostgreSQL";
    }
}

// استخدام الكلاسات
$mysql = new MySQLDatabase("localhost", "root", "password", "myapp");
$postgres = new PostgreSQLDatabase("localhost", "postgres", "password", "myapp");

echo "=== MySQL ===\n";
echo $mysql->connect() . "\n";
echo $mysql->query("SELECT * FROM users") . "\n";
echo $mysql->fetch("result") . "\n";
echo $mysql->disconnect() . "\n\n";

echo "=== PostgreSQL ===\n";
echo $postgres->connect() . "\n";
echo $postgres->query("SELECT * FROM products") . "\n";
echo $postgres->fetch("result") . "\n";
echo $postgres->disconnect() . "\n";
```

---

## أفضل الممارسات

### ✅ **1. استخدام Abstract Classes للكلاسات ذات العلاقة**
```php
<?php
abstract class Vehicle {
    protected $brand;
    protected $model;
    
    public function __construct($brand, $model) {
        $this->brand = $brand;
        $this->model = $model;
    }
    
    abstract public function start();
    abstract public function stop();
}
```

### ✅ **2. استخدام Interfaces للعقود**
```php
<?php
interface PaymentInterface {
    public function processPayment($amount);
    public function refund($amount);
}

class CreditCardPayment implements PaymentInterface {
    public function processPayment($amount) {
        return "تم الدفع بالبطاقة الائتمانية: " . $amount;
    }
    
    public function refund($amount) {
        return "تم استرداد المبلغ: " . $amount;
    }
}
```

### ✅ **3. تجنب الوراثة العميقة**
```php
<?php
// ❌ خطأ - وراثة عميقة
abstract class A extends B extends C {
    // يصعب الفهم والصيانة
}

// ✅ صحيح - وراثة بسيطة
abstract class Shape {
    // خصائص وطرق أساسية
}

class Circle extends Shape {
    // تنفيذ محدد للدائرة
}
```

### ✅ **4. استخدام أسماء وصفية**
```php
<?php
// ✅ صحيح - أسماء وصفية
interface Drawable {
    public function draw();
}

abstract class GeometricShape {
    abstract public function calculateArea();
}
```

---

## 🎯 خلاصة المحاضرة

1. **Abstract Classes** لا يمكن إنشاء كائنات منها ولكن يمكن وراثتها
2. **Interfaces** تحدد العقود التي يجب تنفيذها
3. **استخدم Abstract Classes** للكلاسات ذات العلاقة
4. **استخدم Interfaces** للعقود والواجهات
5. **تجنب الوراثة العميقة** لسهولة الصيانة
6. **استخدم أسماء وصفية** للوضوح

---

## 📝 التمرين العملي

أنشئ نظام للوسائط:
- Interface `Playable` مع طرق `play()`, `pause()`, `stop()`
- Abstract Class `Media` مع خصائص مشتركة
- Classes `Audio`, `Video` ترث من `Media` وتنفذ `Playable`

---

## 📚 المراجع والموارد
- [PHP Abstract Classes](https://www.php.net/manual/en/language.oop5.abstract.php)
- [PHP Interfaces](https://www.php.net/manual/en/language.oop5.interfaces.php)
- [PHP Object-Oriented Programming](https://www.php.net/manual/en/language.oop5.php)


