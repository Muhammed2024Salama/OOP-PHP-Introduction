<?php
/**
 * المحاضرة الأولى: أمثلة عملية على البرمجة الكائنية في PHP
 * 
 * هذا الملف يحتوي على أمثلة متنوعة لشرح مفاهيم OOP الأساسية
 */

echo "<h1>المحاضرة الأولى: أمثلة البرمجة الكائنية</h1>\n";

// ==========================================
// مثال 1: كلاس المستخدم البسيط
// ==========================================
echo "<h2>مثال 1: كلاس المستخدم</h2>\n";

class User {
    public $name;
    public $age;
    public $email;
    
    public function __construct($name, $age, $email) {
        $this->name = $name;
        $this->age = $age;
        $this->email = $email;
    }
    
    public function greet() {
        return "مرحباً " . $this->name;
    }
    
    public function getInfo() {
        return "الاسم: " . $this->name . " - العمر: " . $this->age . " - الإيميل: " . $this->email;
    }
}

// إنشاء كائنات من كلاس User
$user1 = new User("أحمد محمد", 25, "ahmed@example.com");
$user2 = new User("فاطمة علي", 30, "fatima@example.com");

echo $user1->greet() . "<br>";
echo $user1->getInfo() . "<br><br>";

echo $user2->greet() . "<br>";
echo $user2->getInfo() . "<br><br>";

// ==========================================
// مثال 2: كلاس الطالب
// ==========================================
echo "<h2>مثال 2: كلاس الطالب</h2>\n";

class Student {
    public $name;
    public $grade;
    public $subjects = [];
    public $gpa = 0;
    
    public function __construct($name, $grade) {
        $this->name = $name;
        $this->grade = $grade;
    }
    
    public function addSubject($subject) {
        $this->subjects[] = $subject;
        return "تم إضافة مادة: " . $subject;
    }
    
    public function calculateGPA($grades) {
        if (count($grades) > 0) {
            $this->gpa = array_sum($grades) / count($grades);
        }
        return $this->gpa;
    }
    
    public function getInfo() {
        $info = "الطالب: " . $this->name . "<br>";
        $info .= "الصف: " . $this->grade . "<br>";
        $info .= "المواد: " . implode(", ", $this->subjects) . "<br>";
        $info .= "المعدل: " . $this->gpa;
        return $info;
    }
}

// إنشاء طلاب
$student1 = new Student("سارة أحمد", "الثاني الثانوي");
$student1->addSubject("الرياضيات");
$student1->addSubject("الفيزياء");
$student1->addSubject("الكيمياء");
$student1->calculateGPA([95, 88, 92]);

$student2 = new Student("محمد علي", "الأول الثانوي");
$student2->addSubject("اللغة العربية");
$student2->addSubject("التاريخ");
$student2->calculateGPA([85, 90]);

echo $student1->getInfo() . "<br><br>";
echo $student2->getInfo() . "<br><br>";

// ==========================================
// مثال 3: كلاس المنتج
// ==========================================
echo "<h2>مثال 3: كلاس المنتج</h2>\n";

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
    
    public function getTotalValue() {
        return $this->price * $this->quantity;
    }
    
    public function updateQuantity($newQuantity) {
        if ($newQuantity >= 0) {
            $this->quantity = $newQuantity;
            return "تم تحديث الكمية إلى: " . $newQuantity;
        }
        return "الكمية يجب أن تكون أكبر من أو تساوي صفر";
    }
    
    public function applyDiscount($percentage) {
        if ($percentage > 0 && $percentage <= 100) {
            $discount = $this->price * ($percentage / 100);
            $this->price = $this->price - $discount;
            return "تم تطبيق خصم " . $percentage . "% - السعر الجديد: " . $this->price;
        }
        return "نسبة الخصم غير صحيحة";
    }
    
    public function getInfo() {
        $info = "المنتج: " . $this->name . "<br>";
        $info .= "الفئة: " . $this->category . "<br>";
        $info .= "السعر: " . $this->price . " ريال<br>";
        $info .= "الكمية: " . $this->quantity . "<br>";
        $info .= "القيمة الإجمالية: " . $this->getTotalValue() . " ريال";
        return $info;
    }
}

// إنشاء منتجات
$laptop = new Product("لابتوب ديل", 5000, 10, "إلكترونيات");
$phone = new Product("آيفون", 3000, 25, "إلكترونيات");
$book = new Product("كتاب البرمجة", 50, 100, "كتب");

echo $laptop->getInfo() . "<br><br>";
echo $phone->getInfo() . "<br><br>";
echo $book->getInfo() . "<br><br>";

// تطبيق خصم على اللابتوب
echo $laptop->applyDiscount(10) . "<br>";
echo $laptop->getInfo() . "<br><br>";

// ==========================================
// مثال 4: كلاس السيارة
// ==========================================
echo "<h2>مثال 4: كلاس السيارة</h2>\n";

class Car {
    public $brand;
    public $model;
    public $year;
    public $color;
    public $fuel = 0;
    public $isRunning = false;
    
    public function __construct($brand, $model, $year, $color) {
        $this->brand = $brand;
        $this->model = $model;
        $this->year = $year;
        $this->color = $color;
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
        $this->fuel += $amount;
        return "تم إضافة " . $amount . " لتر من الوقود - الكمية الحالية: " . $this->fuel;
    }
    
    public function drive($distance) {
        if ($this->isRunning) {
            $fuelNeeded = $distance / 10; // كل 10 كم يحتاج لتر واحد
            if ($this->fuel >= $fuelNeeded) {
                $this->fuel -= $fuelNeeded;
                return "تم السير مسافة " . $distance . " كم - الوقود المتبقي: " . $this->fuel;
            }
            return "لا يوجد وقود كافي للسير";
        }
        return "يجب تشغيل السيارة أولاً";
    }
    
    public function getInfo() {
        $status = $this->isRunning ? "تعمل" : "متوقفة";
        $info = "السيارة: " . $this->brand . " " . $this->model . "<br>";
        $info .= "السنة: " . $this->year . "<br>";
        $info .= "اللون: " . $this->color . "<br>";
        $info .= "الوقود: " . $this->fuel . " لتر<br>";
        $info .= "الحالة: " . $status;
        return $info;
    }
}

// إنشاء سيارات
$car1 = new Car("تويوتا", "كامري", 2020, "أبيض");
$car2 = new Car("هونداي", "إلنترا", 2019, "أسود");

// تشغيل السيارة الأولى
$car1->addFuel(50);
echo $car1->start() . "<br>";
echo $car1->drive(30) . "<br>";
echo $car1->getInfo() . "<br><br>";

// السيارة الثانية
echo $car2->getInfo() . "<br>";
echo $car2->start() . "<br>"; // لن تعمل لأن الوقود فارغ
echo $car2->addFuel(20) . "<br>";
echo $car2->start() . "<br><br>";

// ==========================================
// مثال 5: كلاس الحساب البنكي
// ==========================================
echo "<h2>مثال 5: كلاس الحساب البنكي</h2>\n";

class BankAccount {
    public $accountNumber;
    public $ownerName;
    public $balance = 0;
    public $transactions = [];
    
    public function __construct($accountNumber, $ownerName, $initialBalance = 0) {
        $this->accountNumber = $accountNumber;
        $this->ownerName = $ownerName;
        $this->balance = $initialBalance;
    }
    
    public function deposit($amount) {
        if ($amount > 0) {
            $this->balance += $amount;
            $this->addTransaction("إيداع", $amount);
            return "تم إيداع " . $amount . " ريال - الرصيد الحالي: " . $this->balance;
        }
        return "المبلغ يجب أن يكون أكبر من صفر";
    }
    
    public function withdraw($amount) {
        if ($amount > 0 && $amount <= $this->balance) {
            $this->balance -= $amount;
            $this->addTransaction("سحب", $amount);
            return "تم سحب " . $amount . " ريال - الرصيد المتبقي: " . $this->balance;
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
    
    public function getBalance() {
        return "الرصيد الحالي: " . $this->balance . " ريال";
    }
    
    public function getTransactionHistory() {
        $history = "تاريخ المعاملات:<br>";
        foreach ($this->transactions as $transaction) {
            $history .= $transaction['date'] . " - " . $transaction['type'] . " " . $transaction['amount'] . " ريال - الرصيد: " . $transaction['balance'] . "<br>";
        }
        return $history;
    }
    
    public function getInfo() {
        $info = "رقم الحساب: " . $this->accountNumber . "<br>";
        $info .= "اسم المالك: " . $this->ownerName . "<br>";
        $info .= $this->getBalance();
        return $info;
    }
}

// إنشاء حساب بنكي
$account = new BankAccount("123456789", "أحمد السعد", 1000);

echo $account->getInfo() . "<br><br>";
echo $account->deposit(500) . "<br>";
echo $account->withdraw(200) . "<br>";
echo $account->deposit(1000) . "<br>";
echo $account->withdraw(300) . "<br><br>";

echo $account->getTransactionHistory() . "<br>";

echo "<hr>";
echo "<h2>🎯 خلاصة الأمثلة</h2>";
echo "<p>هذه الأمثلة توضح كيفية:</p>";
echo "<ul>";
echo "<li>إنشاء الكلاسات والكائنات</li>";
echo "<li>استخدام الخصائص والطرق</li>";
echo "<li>تنظيم الكود بشكل منطقي</li>";
echo "<li>إعادة استخدام الكود</li>";
echo "</ul>";
?>
