# المحاضرة الرابعة: البناء والهدم (Constructor and Destructor)

## 📚 جدول المحتويات
1. [ما هو Constructor؟](#ما-هو-constructor)
2. [أنواع Constructor](#أنواع-constructor)
3. [ما هو Destructor؟](#ما-هو-destructor)
4. [معاملات البناء](#معاملات-البناء)
5. [أمثلة عملية](#أمثلة-عملية)
6. [أفضل الممارسات](#أفضل-الممارسات)

---

## ما هو Constructor؟

**Constructor (دالة البناء)** هي دالة خاصة يتم استدعاؤها تلقائياً عند إنشاء كائن جديد من الكلاس. يمكن تشبيهها بـ:
- 🏗️ **البناء**: مثل بناء منزل جديد
- 🚀 **الإقلاع**: مثل إقلاع الطائرة
- 🎬 **البداية**: مثل بداية فيلم

### 🎯 خصائص Constructor:
- **يتم استدعاؤه تلقائياً**: عند إنشاء الكائن
- **اسمه `__construct`**: كلمة مفتاحية خاصة
- **يمكن أن يأخذ معاملات**: لتهيئة الخصائص
- **يتم تنفيذه مرة واحدة**: عند إنشاء الكائن

---

## أنواع Constructor

### 1. **Constructor البسيط (بدون معاملات)**
```php
<?php
class User {
    public $name;
    public $email;
    
    public function __construct() {
        echo "تم إنشاء مستخدم جديد\n";
        $this->name = "غير محدد";
        $this->email = "غير محدد";
    }
}

$user = new User(); // سيتم استدعاء Constructor تلقائياً
```

### 2. **Constructor مع معاملات**
```php
<?php
class User {
    public $name;
    public $email;
    public $age;
    
    public function __construct($name, $email, $age) {
        echo "تم إنشاء مستخدم: " . $name . "\n";
        $this->name = $name;
        $this->email = $email;
        $this->age = $age;
    }
}

$user = new User("أحمد", "ahmed@example.com", 25);
```

### 3. **Constructor مع قيم افتراضية**
```php
<?php
class User {
    public $name;
    public $email;
    public $age;
    public $isActive;
    
    public function __construct($name, $email, $age = 0, $isActive = true) {
        $this->name = $name;
        $this->email = $email;
        $this->age = $age;
        $this->isActive = $isActive;
    }
}

$user1 = new User("أحمد", "ahmed@example.com"); // age = 0, isActive = true
$user2 = new User("فاطمة", "fatima@example.com", 30); // isActive = true
$user3 = new User("محمد", "mohammed@example.com", 25, false);
```

---

## ما هو Destructor؟

**Destructor (دالة الهدم)** هي دالة خاصة يتم استدعاؤها تلقائياً عند تدمير الكائن. يمكن تشبيهها بـ:
- 🏚️ **الهدم**: مثل هدم منزل قديم
- 🛬 **الهبوط**: مثل هبوط الطائرة
- 🎬 **النهاية**: مثل نهاية فيلم

### 🎯 خصائص Destructor:
- **يتم استدعاؤه تلقائياً**: عند تدمير الكائن
- **اسمه `__destruct`**: كلمة مفتاحية خاصة
- **لا يأخذ معاملات**: لا يمكن تمرير معاملات له
- **يتم تنفيذه مرة واحدة**: عند تدمير الكائن

### 🔍 متى يتم استدعاء Destructor؟
- عند انتهاء السكريبت
- عند استخدام `unset()`
- عند إعادة تعيين المتغير
- عند إنهاء الكائن

---

## معاملات البناء

### 📝 **معاملات إجبارية**
```php
<?php
class Product {
    public $name;
    public $price;
    
    public function __construct($name, $price) {
        $this->name = $name;
        $this->price = $price;
    }
}

// يجب تمرير جميع المعاملات
$product = new Product("لابتوب", 5000);
```

### 📝 **معاملات اختيارية**
```php
<?php
class Product {
    public $name;
    public $price;
    public $quantity;
    public $category;
    
    public function __construct($name, $price, $quantity = 0, $category = "عام") {
        $this->name = $name;
        $this->price = $price;
        $this->quantity = $quantity;
        $this->category = $category;
    }
}

$product1 = new Product("لابتوب", 5000); // quantity = 0, category = "عام"
$product2 = new Product("هاتف", 3000, 10); // category = "عام"
$product3 = new Product("كتاب", 50, 100, "كتب");
```

### 📝 **معاملات متقدمة**
```php
<?php
class User {
    public $name;
    public $email;
    public $profile;
    
    public function __construct($name, $email, array $profile = []) {
        $this->name = $name;
        $this->email = $email;
        $this->profile = array_merge([
            'age' => 0,
            'city' => 'غير محدد',
            'phone' => 'غير محدد'
        ], $profile);
    }
}

$user = new User("أحمد", "ahmed@example.com", [
    'age' => 25,
    'city' => 'الرياض',
    'phone' => '0501234567'
]);
```

---

## أمثلة عملية

### مثال 1: كلاس المستخدم مع Constructor و Destructor
```php
<?php
class User {
    public $name;
    public $email;
    public $age;
    public $isActive;
    private $createdAt;
    private $loginCount = 0;
    
    public function __construct($name, $email, $age = 0, $isActive = true) {
        echo "🏗️ تم إنشاء مستخدم جديد: " . $name . "\n";
        
        $this->name = $name;
        $this->email = $email;
        $this->age = $age;
        $this->isActive = $isActive;
        $this->createdAt = date('Y-m-d H:i:s');
        
        echo "✅ تم تهيئة المستخدم بنجاح\n";
    }
    
    public function __destruct() {
        echo "🗑️ تم تدمير مستخدم: " . $this->name . "\n";
        echo "📊 إجمالي مرات تسجيل الدخول: " . $this->loginCount . "\n";
    }
    
    public function login() {
        $this->loginCount++;
        return "تم تسجيل الدخول - العدد: " . $this->loginCount;
    }
    
    public function getInfo() {
        return "الاسم: " . $this->name . " - الإيميل: " . $this->email . " - العمر: " . $this->age;
    }
    
    public function getCreatedAt() {
        return $this->createdAt;
    }
}

// إنشاء مستخدمين
$user1 = new User("أحمد محمد", "ahmed@example.com", 25);
$user2 = new User("فاطمة علي", "fatima@example.com", 30, false);

echo $user1->login() . "\n";
echo $user1->login() . "\n";
echo $user1->getInfo() . "\n";
echo "تاريخ الإنشاء: " . $user1->getCreatedAt() . "\n\n";

echo $user2->getInfo() . "\n";
echo "تاريخ الإنشاء: " . $user2->getCreatedAt() . "\n\n";

// تدمير الكائنات يدوياً
unset($user1);
unset($user2);

echo "انتهى السكريبت\n";
```

### مثال 2: كلاس المنتج مع Constructor متقدم
```php
<?php
class Product {
    public $name;
    public $price;
    public $quantity;
    public $category;
    public $description;
    private $createdAt;
    private $views = 0;
    private $isNew = true;
    
    public function __construct($name, $price, $quantity = 0, $category = "عام", $description = "") {
        echo "🏗️ تم إنشاء منتج جديد: " . $name . "\n";
        
        // التحقق من صحة البيانات
        if (empty($name)) {
            throw new InvalidArgumentException("اسم المنتج لا يمكن أن يكون فارغاً");
        }
        
        if ($price < 0) {
            throw new InvalidArgumentException("السعر لا يمكن أن يكون سالباً");
        }
        
        if ($quantity < 0) {
            throw new InvalidArgumentException("الكمية لا يمكن أن تكون سالبة");
        }
        
        $this->name = $name;
        $this->price = $price;
        $this->quantity = $quantity;
        $this->category = $category;
        $this->description = $description;
        $this->createdAt = date('Y-m-d H:i:s');
        
        echo "✅ تم تهيئة المنتج بنجاح\n";
    }
    
    public function __destruct() {
        echo "🗑️ تم تدمير منتج: " . $this->name . "\n";
        echo "📊 إجمالي المشاهدات: " . $this->views . "\n";
    }
    
    public function view() {
        $this->views++;
        $this->isNew = false;
        return "تم عرض المنتج - المشاهدات: " . $this->views;
    }
    
    public function isNew() {
        return $this->isNew;
    }
    
    public function getCreatedAt() {
        return $this->createdAt;
    }
    
    public function getInfo() {
        $info = "المنتج: " . $this->name . "\n";
        $info .= "السعر: " . $this->price . " ريال\n";
        $info .= "الكمية: " . $this->quantity . "\n";
        $info .= "الفئة: " . $this->category . "\n";
        $info .= "الوصف: " . $this->description . "\n";
        $info .= "تاريخ الإنشاء: " . $this->createdAt . "\n";
        $info .= "جديد: " . ($this->isNew ? "نعم" : "لا") . "\n";
        $info .= "المشاهدات: " . $this->views;
        return $info;
    }
}

// إنشاء منتجات
try {
    $product1 = new Product("لابتوب ديل", 5000, 10, "إلكترونيات", "لابتوب عالي الأداء");
    $product2 = new Product("آيفون", 3000, 25, "إلكترونيات", "هاتف ذكي");
    $product3 = new Product("كتاب البرمجة", 50, 100, "كتب", "كتاب شامل لتعلم البرمجة");
    
    echo $product1->view() . "\n";
    echo $product1->view() . "\n";
    echo $product1->getInfo() . "\n\n";
    
    echo $product2->getInfo() . "\n\n";
    echo $product3->getInfo() . "\n\n";
    
} catch (InvalidArgumentException $e) {
    echo "خطأ: " . $e->getMessage() . "\n";
}
```

### مثال 3: كلاس الحساب البنكي مع Constructor و Destructor
```php
<?php
class BankAccount {
    public $accountNumber;
    public $ownerName;
    public $balance;
    public $accountType;
    private $createdAt;
    private $transactions = [];
    private $isActive = true;
    
    public function __construct($accountNumber, $ownerName, $initialBalance = 0, $accountType = "جاري") {
        echo "🏗️ تم إنشاء حساب بنكي جديد: " . $accountNumber . "\n";
        
        // التحقق من صحة البيانات
        if (strlen($accountNumber) < 8) {
            throw new InvalidArgumentException("رقم الحساب يجب أن يكون 8 أرقام على الأقل");
        }
        
        if (empty($ownerName)) {
            throw new InvalidArgumentException("اسم المالك لا يمكن أن يكون فارغاً");
        }
        
        if ($initialBalance < 0) {
            throw new InvalidArgumentException("الرصيد الأولي لا يمكن أن يكون سالباً");
        }
        
        $this->accountNumber = $accountNumber;
        $this->ownerName = $ownerName;
        $this->balance = $initialBalance;
        $this->accountType = $accountType;
        $this->createdAt = date('Y-m-d H:i:s');
        
        // إضافة معاملة إنشاء الحساب
        $this->addTransaction("إنشاء الحساب", $initialBalance);
        
        echo "✅ تم تهيئة الحساب بنجاح\n";
    }
    
    public function __destruct() {
        echo "🗑️ تم تدمير حساب: " . $this->accountNumber . "\n";
        echo "📊 إجمالي المعاملات: " . count($this->transactions) . "\n";
        echo "💰 الرصيد النهائي: " . $this->balance . " ريال\n";
    }
    
    public function deposit($amount) {
        if ($amount > 0) {
            $this->balance += $amount;
            $this->addTransaction("إيداع", $amount);
            return "تم إيداع " . $amount . " ريال - الرصيد: " . $this->balance . " ريال";
        }
        return "المبلغ يجب أن يكون أكبر من صفر";
    }
    
    public function withdraw($amount) {
        if ($amount > 0 && $amount <= $this->balance) {
            $this->balance -= $amount;
            $this->addTransaction("سحب", $amount);
            return "تم سحب " . $amount . " ريال - الرصيد: " . $this->balance . " ريال";
        }
        return "المبلغ غير صحيح أو الرصيد غير كافي";
    }
    
    private function addTransaction($type, $amount) {
        $transaction = [
            'type' => $type,
            'amount' => $amount,
            'balance' => $this->balance,
            'date' => date('Y-m-d H:i:s')
        ];
        $this->transactions[] = $transaction;
    }
    
    public function getTransactionHistory() {
        $history = "تاريخ المعاملات:\n";
        foreach ($this->transactions as $transaction) {
            $history .= $transaction['date'] . " - " . $transaction['type'] . " " . $transaction['amount'] . " ريال - الرصيد: " . $transaction['balance'] . "\n";
        }
        return $history;
    }
    
    public function getInfo() {
        $info = "رقم الحساب: " . $this->accountNumber . "\n";
        $info .= "اسم المالك: " . $this->ownerName . "\n";
        $info .= "نوع الحساب: " . $this->accountType . "\n";
        $info .= "الرصيد: " . $this->balance . " ريال\n";
        $info .= "تاريخ الإنشاء: " . $this->createdAt . "\n";
        $info .= "الحالة: " . ($this->isActive ? "نشط" : "غير نشط");
        return $info;
    }
}

// إنشاء حسابات
try {
    $account1 = new BankAccount("123456789", "أحمد السعد", 1000, "جاري");
    $account2 = new BankAccount("987654321", "فاطمة محمد", 2000, "توفير");
    
    echo $account1->deposit(500) . "\n";
    echo $account1->withdraw(200) . "\n";
    echo $account1->getInfo() . "\n\n";
    
    echo $account2->deposit(1000) . "\n";
    echo $account2->getInfo() . "\n\n";
    
    echo $account1->getTransactionHistory() . "\n";
    
} catch (InvalidArgumentException $e) {
    echo "خطأ: " . $e->getMessage() . "\n";
}
```

### مثال 4: كلاس السيارة مع Constructor متقدم
```php
<?php
class Car {
    public $brand;
    public $model;
    public $year;
    public $color;
    public $fuel;
    public $isRunning;
    private $createdAt;
    private $mileage = 0;
    private $serviceCount = 0;
    
    public function __construct($brand, $model, $year, $color, $initialFuel = 0) {
        echo "🏗️ تم إنشاء سيارة جديدة: " . $brand . " " . $model . "\n";
        
        // التحقق من صحة البيانات
        if (empty($brand) || empty($model)) {
            throw new InvalidArgumentException("الماركة والموديل مطلوبان");
        }
        
        if ($year < 1900 || $year > date('Y')) {
            throw new InvalidArgumentException("سنة الصنع غير صحيحة");
        }
        
        if ($initialFuel < 0) {
            throw new InvalidArgumentException("كمية الوقود لا يمكن أن تكون سالبة");
        }
        
        $this->brand = $brand;
        $this->model = $model;
        $this->year = $year;
        $this->color = $color;
        $this->fuel = $initialFuel;
        $this->isRunning = false;
        $this->createdAt = date('Y-m-d H:i:s');
        
        echo "✅ تم تهيئة السيارة بنجاح\n";
    }
    
    public function __destruct() {
        echo "🗑️ تم تدمير سيارة: " . $this->brand . " " . $this->model . "\n";
        echo "📊 إجمالي المسافة: " . $this->mileage . " كم\n";
        echo "🔧 عدد الخدمات: " . $this->serviceCount . "\n";
    }
    
    public function start() {
        if ($this->fuel > 0) {
            $this->isRunning = true;
            return "تم تشغيل السيارة " . $this->brand . " " . $this->model;
        }
        return "لا يمكن تشغيل السيارة - الوقود فارغ";
    }
    
    public function stop() {
        $this->isRunning = false;
        return "تم إيقاف السيارة";
    }
    
    public function addFuel($amount) {
        if ($amount > 0) {
            $this->fuel += $amount;
            return "تم إضافة " . $amount . " لتر - الوقود الحالي: " . $this->fuel . " لتر";
        }
        return "الكمية يجب أن تكون أكبر من صفر";
    }
    
    public function drive($distance) {
        if ($this->isRunning) {
            $fuelNeeded = $distance / 10; // كل 10 كم يحتاج لتر واحد
            if ($this->fuel >= $fuelNeeded) {
                $this->fuel -= $fuelNeeded;
                $this->mileage += $distance;
                return "تم السير " . $distance . " كم - الوقود المتبقي: " . $this->fuel . " لتر";
            }
            return "لا يوجد وقود كافي";
        }
        return "يجب تشغيل السيارة أولاً";
    }
    
    public function service() {
        $this->serviceCount++;
        return "تم إجراء خدمة للسيارة - العدد: " . $this->serviceCount;
    }
    
    public function getInfo() {
        $info = "السيارة: " . $this->brand . " " . $this->model . "\n";
        $info .= "السنة: " . $this->year . "\n";
        $info .= "اللون: " . $this->color . "\n";
        $info .= "الوقود: " . $this->fuel . " لتر\n";
        $info .= "المسافة: " . $this->mileage . " كم\n";
        $info .= "الخدمات: " . $this->serviceCount . "\n";
        $info .= "الحالة: " . ($this->isRunning ? "تعمل" : "متوقفة") . "\n";
        $info .= "تاريخ الإنشاء: " . $this->createdAt;
        return $info;
    }
}

// إنشاء سيارات
try {
    $car1 = new Car("تويوتا", "كامري", 2020, "أبيض", 50);
    $car2 = new Car("هونداي", "إلنترا", 2019, "أسود", 30);
    
    echo $car1->start() . "\n";
    echo $car1->drive(30) . "\n";
    echo $car1->service() . "\n";
    echo $car1->getInfo() . "\n\n";
    
    echo $car2->addFuel(20) . "\n";
    echo $car2->start() . "\n";
    echo $car2->getInfo() . "\n\n";
    
} catch (InvalidArgumentException $e) {
    echo "خطأ: " . $e->getMessage() . "\n";
}
```

---

## أفضل الممارسات

### ✅ **1. استخدام Constructor للتهيئة**
```php
<?php
class User {
    private $name;
    private $email;
    private $createdAt;
    
    public function __construct($name, $email) {
        $this->name = $name;
        $this->email = $email;
        $this->createdAt = date('Y-m-d H:i:s');
    }
}
```

### ✅ **2. التحقق من صحة البيانات**
```php
<?php
class Product {
    private $name;
    private $price;
    
    public function __construct($name, $price) {
        if (empty($name)) {
            throw new InvalidArgumentException("اسم المنتج مطلوب");
        }
        
        if ($price < 0) {
            throw new InvalidArgumentException("السعر لا يمكن أن يكون سالباً");
        }
        
        $this->name = $name;
        $this->price = $price;
    }
}
```

### ✅ **3. استخدام قيم افتراضية**
```php
<?php
class User {
    private $name;
    private $email;
    private $isActive;
    
    public function __construct($name, $email, $isActive = true) {
        $this->name = $name;
        $this->email = $email;
        $this->isActive = $isActive;
    }
}
```

### ✅ **4. تنظيف الموارد في Destructor**
```php
<?php
class DatabaseConnection {
    private $connection;
    
    public function __construct($host, $username, $password) {
        $this->connection = new PDO("mysql:host=$host", $username, $password);
    }
    
    public function __destruct() {
        if ($this->connection) {
            $this->connection = null;
            echo "تم إغلاق الاتصال بقاعدة البيانات\n";
        }
    }
}
```

### ✅ **5. تجنب العمليات المعقدة في Constructor**
```php
<?php
class User {
    private $name;
    private $email;
    private $profile;
    
    public function __construct($name, $email) {
        $this->name = $name;
        $this->email = $email;
        $this->profile = []; // تهيئة بسيطة
    }
    
    // طريقة منفصلة لتحميل الملف الشخصي
    public function loadProfile() {
        // تحميل معقد للملف الشخصي
    }
}
```

---

## 🎯 خلاصة المحاضرة

1. **Constructor** يتم استدعاؤه عند إنشاء الكائن
2. **Destructor** يتم استدعاؤه عند تدمير الكائن
3. **استخدم Constructor** لتهيئة الخصائص
4. **استخدم Destructor** لتنظيف الموارد
5. **تحقق من صحة البيانات** في Constructor
6. **استخدم قيم افتراضية** للمعاملات الاختيارية

---

## 📝 التمرين العملي

أنشئ كلاس `Employee` مع:
- Constructor يأخذ: `name`, `position`, `salary`, `department`
- Destructor يعرض رسالة وداع
- طرق: `getInfo()`, `promote()`, `getYearsOfService()`

---

## 📚 المراجع والموارد
- [PHP Constructors](https://www.php.net/manual/en/language.oop5.decon.php)
- [PHP Destructors](https://www.php.net/manual/en/language.oop5.decon.php#language.oop5.decon.destructor)
- [PHP Object Lifecycle](https://www.php.net/manual/en/language.oop5.basic.php)

