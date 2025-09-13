<?php
/**
 * المحاضرة الرابعة: أمثلة على Constructor و Destructor
 * 
 * هذا الملف يحتوي على أمثلة متنوعة لشرح مفهوم البناء والهدم
 */

echo "<h1>المحاضرة الرابعة: البناء والهدم (Constructor & Destructor)</h1>\n";

// ==========================================
// مثال 1: كلاس المستخدم مع Constructor و Destructor
// ==========================================
echo "<h2>مثال 1: كلاس المستخدم</h2>\n";

class User {
    public $name;
    public $email;
    public $age;
    public $isActive;
    private $createdAt;
    private $loginCount = 0;
    private $lastLogin;
    
    public function __construct($name, $email, $age = 0, $isActive = true) {
        echo "🏗️ <strong>تم إنشاء مستخدم جديد:</strong> " . $name . "<br>";
        
        $this->name = $name;
        $this->email = $email;
        $this->age = $age;
        $this->isActive = $isActive;
        $this->createdAt = date('Y-m-d H:i:s');
        
        echo "✅ <strong>تم تهيئة المستخدم بنجاح</strong><br>";
    }
    
    public function __destruct() {
        echo "🗑️ <strong>تم تدمير مستخدم:</strong> " . $this->name . "<br>";
        echo "📊 <strong>إجمالي مرات تسجيل الدخول:</strong> " . $this->loginCount . "<br>";
    }
    
    public function login() {
        $this->loginCount++;
        $this->lastLogin = date('Y-m-d H:i:s');
        return "تم تسجيل الدخول - العدد: " . $this->loginCount;
    }
    
    public function getInfo() {
        $info = "<strong>الاسم:</strong> " . $this->name . "<br>";
        $info .= "<strong>الإيميل:</strong> " . $this->email . "<br>";
        $info .= "<strong>العمر:</strong> " . $this->age . "<br>";
        $info .= "<strong>الحالة:</strong> " . ($this->isActive ? "نشط" : "غير نشط") . "<br>";
        $info .= "<strong>تاريخ الإنشاء:</strong> " . $this->createdAt . "<br>";
        $info .= "<strong>آخر دخول:</strong> " . ($this->lastLogin ? $this->lastLogin : "لم يسجل دخول") . "<br>";
        $info .= "<strong>عدد مرات الدخول:</strong> " . $this->loginCount;
        return $info;
    }
    
    public function getCreatedAt() {
        return $this->createdAt;
    }
    
    public function getLoginCount() {
        return $this->loginCount;
    }
}

// إنشاء مستخدمين
echo "<h3>إنشاء مستخدمين:</h3>\n";

$user1 = new User("أحمد محمد", "ahmed@example.com", 25);
$user2 = new User("فاطمة علي", "fatima@example.com", 30, false);

echo "<h4>المستخدم الأول:</h4>\n";
echo $user1->login() . "<br>";
echo $user1->login() . "<br>";
echo $user1->getInfo() . "<br><br>";

echo "<h4>المستخدم الثاني:</h4>\n";
echo $user2->getInfo() . "<br><br>";

// ==========================================
// مثال 2: كلاس المنتج مع Constructor متقدم
// ==========================================
echo "<h2>مثال 2: كلاس المنتج</h2>\n";

class Product {
    public $name;
    public $price;
    public $quantity;
    public $category;
    public $description;
    private $createdAt;
    private $views = 0;
    private $isNew = true;
    private $productId;
    
    public function __construct($name, $price, $quantity = 0, $category = "عام", $description = "") {
        echo "🏗️ <strong>تم إنشاء منتج جديد:</strong> " . $name . "<br>";
        
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
        $this->productId = uniqid('PROD_');
        
        echo "✅ <strong>تم تهيئة المنتج بنجاح</strong> - ID: " . $this->productId . "<br>";
    }
    
    public function __destruct() {
        echo "🗑️ <strong>تم تدمير منتج:</strong> " . $this->name . "<br>";
        echo "📊 <strong>إجمالي المشاهدات:</strong> " . $this->views . "<br>";
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
    
    public function getProductId() {
        return $this->productId;
    }
    
    public function getViews() {
        return $this->views;
    }
    
    public function getInfo() {
        $info = "<strong>المنتج:</strong> " . $this->name . "<br>";
        $info .= "<strong>السعر:</strong> " . $this->price . " ريال<br>";
        $info .= "<strong>الكمية:</strong> " . $this->quantity . "<br>";
        $info .= "<strong>الفئة:</strong> " . $this->category . "<br>";
        $info .= "<strong>الوصف:</strong> " . $this->description . "<br>";
        $info .= "<strong>تاريخ الإنشاء:</strong> " . $this->createdAt . "<br>";
        $info .= "<strong>معرف المنتج:</strong> " . $this->productId . "<br>";
        $info .= "<strong>جديد:</strong> " . ($this->isNew ? "نعم" : "لا") . "<br>";
        $info .= "<strong>المشاهدات:</strong> " . $this->views;
        return $info;
    }
}

// إنشاء منتجات
echo "<h3>إنشاء منتجات:</h3>\n";

try {
    $product1 = new Product("لابتوب ديل", 5000, 10, "إلكترونيات", "لابتوب عالي الأداء");
    $product2 = new Product("آيفون", 3000, 25, "إلكترونيات", "هاتف ذكي");
    $product3 = new Product("كتاب البرمجة", 50, 100, "كتب", "كتاب شامل لتعلم البرمجة");
    
    echo "<h4>المنتج الأول:</h4>\n";
    echo $product1->view() . "<br>";
    echo $product1->view() . "<br>";
    echo $product1->getInfo() . "<br><br>";
    
    echo "<h4>المنتج الثاني:</h4>\n";
    echo $product2->getInfo() . "<br><br>";
    
    echo "<h4>المنتج الثالث:</h4>\n";
    echo $product3->getInfo() . "<br><br>";
    
} catch (InvalidArgumentException $e) {
    echo "❌ <strong>خطأ:</strong> " . $e->getMessage() . "<br>";
}

// ==========================================
// مثال 3: كلاس الحساب البنكي مع Constructor و Destructor
// ==========================================
echo "<h2>مثال 3: كلاس الحساب البنكي</h2>\n";

class BankAccount {
    public $accountNumber;
    public $ownerName;
    public $balance;
    public $accountType;
    private $createdAt;
    private $transactions = [];
    private $isActive = true;
    private $accountId;
    
    public function __construct($accountNumber, $ownerName, $initialBalance = 0, $accountType = "جاري") {
        echo "🏗️ <strong>تم إنشاء حساب بنكي جديد:</strong> " . $accountNumber . "<br>";
        
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
        $this->accountId = uniqid('ACC_');
        
        // إضافة معاملة إنشاء الحساب
        $this->addTransaction("إنشاء الحساب", $initialBalance);
        
        echo "✅ <strong>تم تهيئة الحساب بنجاح</strong> - ID: " . $this->accountId . "<br>";
    }
    
    public function __destruct() {
        echo "🗑️ <strong>تم تدمير حساب:</strong> " . $this->accountNumber . "<br>";
        echo "📊 <strong>إجمالي المعاملات:</strong> " . count($this->transactions) . "<br>";
        echo "💰 <strong>الرصيد النهائي:</strong> " . $this->balance . " ريال<br>";
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
        $history = "<strong>تاريخ المعاملات:</strong><br>";
        if (empty($this->transactions)) {
            $history .= "لا توجد معاملات";
        } else {
            foreach ($this->transactions as $transaction) {
                $history .= $transaction['date'] . " - " . $transaction['type'] . " " . $transaction['amount'] . " ريال - الرصيد: " . $transaction['balance'] . "<br>";
            }
        }
        return $history;
    }
    
    public function getInfo() {
        $info = "<strong>رقم الحساب:</strong> " . $this->accountNumber . "<br>";
        $info .= "<strong>اسم المالك:</strong> " . $this->ownerName . "<br>";
        $info .= "<strong>نوع الحساب:</strong> " . $this->accountType . "<br>";
        $info .= "<strong>الرصيد:</strong> " . $this->balance . " ريال<br>";
        $info .= "<strong>تاريخ الإنشاء:</strong> " . $this->createdAt . "<br>";
        $info .= "<strong>معرف الحساب:</strong> " . $this->accountId . "<br>";
        $info .= "<strong>الحالة:</strong> " . ($this->isActive ? "نشط" : "غير نشط");
        return $info;
    }
    
    public function getAccountId() {
        return $this->accountId;
    }
    
    public function getCreatedAt() {
        return $this->createdAt;
    }
}

// إنشاء حسابات
echo "<h3>إنشاء حسابات بنكية:</h3>\n";

try {
    $account1 = new BankAccount("123456789", "أحمد السعد", 1000, "جاري");
    $account2 = new BankAccount("987654321", "فاطمة محمد", 2000, "توفير");
    
    echo "<h4>الحساب الأول:</h4>\n";
    echo $account1->deposit(500) . "<br>";
    echo $account1->withdraw(200) . "<br>";
    echo $account1->getInfo() . "<br><br>";
    
    echo "<h4>الحساب الثاني:</h4>\n";
    echo $account2->deposit(1000) . "<br>";
    echo $account2->getInfo() . "<br><br>";
    
    echo "<h4>تاريخ معاملات الحساب الأول:</h4>\n";
    echo $account1->getTransactionHistory() . "<br><br>";
    
} catch (InvalidArgumentException $e) {
    echo "❌ <strong>خطأ:</strong> " . $e->getMessage() . "<br>";
}

// ==========================================
// مثال 4: كلاس السيارة مع Constructor متقدم
// ==========================================
echo "<h2>مثال 4: كلاس السيارة</h2>\n";

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
    private $carId;
    
    public function __construct($brand, $model, $year, $color, $initialFuel = 0) {
        echo "🏗️ <strong>تم إنشاء سيارة جديدة:</strong> " . $brand . " " . $model . "<br>";
        
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
        $this->carId = uniqid('CAR_');
        
        echo "✅ <strong>تم تهيئة السيارة بنجاح</strong> - ID: " . $this->carId . "<br>";
    }
    
    public function __destruct() {
        echo "🗑️ <strong>تم تدمير سيارة:</strong> " . $this->brand . " " . $this->model . "<br>";
        echo "📊 <strong>إجمالي المسافة:</strong> " . $this->mileage . " كم<br>";
        echo "🔧 <strong>عدد الخدمات:</strong> " . $this->serviceCount . "<br>";
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
        $info = "<strong>السيارة:</strong> " . $this->brand . " " . $this->model . "<br>";
        $info .= "<strong>السنة:</strong> " . $this->year . "<br>";
        $info .= "<strong>اللون:</strong> " . $this->color . "<br>";
        $info .= "<strong>الوقود:</strong> " . $this->fuel . " لتر<br>";
        $info .= "<strong>المسافة:</strong> " . $this->mileage . " كم<br>";
        $info .= "<strong>الخدمات:</strong> " . $this->serviceCount . "<br>";
        $info .= "<strong>الحالة:</strong> " . ($this->isRunning ? "تعمل" : "متوقفة") . "<br>";
        $info .= "<strong>تاريخ الإنشاء:</strong> " . $this->createdAt . "<br>";
        $info .= "<strong>معرف السيارة:</strong> " . $this->carId;
        return $info;
    }
    
    public function getCarId() {
        return $this->carId;
    }
    
    public function getCreatedAt() {
        return $this->createdAt;
    }
    
    public function getMileage() {
        return $this->mileage;
    }
    
    public function getServiceCount() {
        return $this->serviceCount;
    }
}

// إنشاء سيارات
echo "<h3>إنشاء سيارات:</h3>\n";

try {
    $car1 = new Car("تويوتا", "كامري", 2020, "أبيض", 50);
    $car2 = new Car("هونداي", "إلنترا", 2019, "أسود", 30);
    
    echo "<h4>السيارة الأولى:</h4>\n";
    echo $car1->start() . "<br>";
    echo $car1->drive(30) . "<br>";
    echo $car1->service() . "<br>";
    echo $car1->getInfo() . "<br><br>";
    
    echo "<h4>السيارة الثانية:</h4>\n";
    echo $car2->addFuel(20) . "<br>";
    echo $car2->start() . "<br>";
    echo $car2->getInfo() . "<br><br>";
    
} catch (InvalidArgumentException $e) {
    echo "❌ <strong>خطأ:</strong> " . $e->getMessage() . "<br>";
}

// ==========================================
// مثال 5: كلاس قاعدة البيانات مع Constructor و Destructor
// ==========================================
echo "<h2>مثال 5: كلاس قاعدة البيانات</h2>\n";

class DatabaseConnection {
    private $host;
    private $username;
    private $password;
    private $database;
    private $connection;
    private $connected = false;
    private $connectionId;
    
    public function __construct($host, $username, $password, $database) {
        echo "🏗️ <strong>تم إنشاء اتصال قاعدة بيانات جديد</strong><br>";
        
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
        $this->connectionId = uniqid('DB_');
        
        echo "✅ <strong>تم تهيئة الاتصال بنجاح</strong> - ID: " . $this->connectionId . "<br>";
    }
    
    public function __destruct() {
        echo "🗑️ <strong>تم تدمير اتصال قاعدة البيانات</strong><br>";
        if ($this->connected) {
            $this->disconnect();
        }
    }
    
    public function connect() {
        if (!$this->connected) {
            // محاكاة الاتصال بقاعدة البيانات
            $this->connected = true;
            $this->connection = "connection_" . $this->connectionId;
            return "تم الاتصال بقاعدة البيانات: " . $this->database;
        }
        return "الاتصال موجود بالفعل";
    }
    
    public function disconnect() {
        if ($this->connected) {
            $this->connected = false;
            $this->connection = null;
            return "تم قطع الاتصال بقاعدة البيانات";
        }
        return "لا يوجد اتصال نشط";
    }
    
    public function query($sql) {
        if ($this->connected) {
            return "تم تنفيذ الاستعلام: " . $sql;
        }
        return "يجب الاتصال بقاعدة البيانات أولاً";
    }
    
    public function isConnected() {
        return $this->connected;
    }
    
    public function getInfo() {
        $info = "<strong>المضيف:</strong> " . $this->host . "<br>";
        $info .= "<strong>اسم المستخدم:</strong> " . $this->username . "<br>";
        $info .= "<strong>قاعدة البيانات:</strong> " . $this->database . "<br>";
        $info .= "<strong>معرف الاتصال:</strong> " . $this->connectionId . "<br>";
        $info .= "<strong>الحالة:</strong> " . ($this->connected ? "متصل" : "غير متصل");
        return $info;
    }
}

// إنشاء اتصال قاعدة بيانات
echo "<h3>إنشاء اتصال قاعدة بيانات:</h3>\n";

$db = new DatabaseConnection("localhost", "root", "password", "my_database");

echo "<h4>معلومات الاتصال:</h4>\n";
echo $db->getInfo() . "<br><br>";

echo "<h4>الاتصال بقاعدة البيانات:</h4>\n";
echo $db->connect() . "<br>";
echo $db->query("SELECT * FROM users") . "<br>";
echo $db->query("INSERT INTO users (name) VALUES ('أحمد')") . "<br>";

echo "<h4>قطع الاتصال:</h4>\n";
echo $db->disconnect() . "<br><br>";

// ==========================================
// خلاصة المحاضرة
// ==========================================
echo "<hr>";
echo "<h2>🎯 خلاصة المحاضرة</h2>";
echo "<div style='background-color: #f0f8ff; padding: 20px; border-radius: 10px;'>";
echo "<h3>ما تعلمناه:</h3>";
echo "<ul>";
echo "<li><strong>Constructor (دالة البناء):</strong> يتم استدعاؤها عند إنشاء الكائن</li>";
echo "<li><strong>Destructor (دالة الهدم):</strong> يتم استدعاؤها عند تدمير الكائن</li>";
echo "<li><strong>التهيئة التلقائية:</strong> Constructor يهيئ الخصائص تلقائياً</li>";
echo "<li><strong>تنظيف الموارد:</strong> Destructor ينظف الموارد تلقائياً</li>";
echo "<li><strong>التحقق من البيانات:</strong> يمكن التحقق من صحة البيانات في Constructor</li>";
echo "<li><strong>القيم الافتراضية:</strong> يمكن استخدام قيم افتراضية للمعاملات</li>";
echo "</ul>";

echo "<h3>أفضل الممارسات:</h3>";
echo "<ul>";
echo "<li>استخدم Constructor لتهيئة الخصائص</li>";
echo "<li>استخدم Destructor لتنظيف الموارد</li>";
echo "<li>تحقق من صحة البيانات في Constructor</li>";
echo "<li>استخدم قيم افتراضية للمعاملات الاختيارية</li>";
echo "<li>تجنب العمليات المعقدة في Constructor</li>";
echo "<li>استخدم أسماء وصفية للمعاملات</li>";
echo "</ul>";
echo "</div>";
?>


