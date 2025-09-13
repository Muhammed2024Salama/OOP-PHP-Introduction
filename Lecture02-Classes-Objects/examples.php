<?php
/**
 * المحاضرة الثانية: أمثلة على الكلاسات والكائنات
 * 
 * هذا الملف يحتوي على أمثلة متنوعة لشرح مفهوم الكلاسات والكائنات
 */

echo "<h1>المحاضرة الثانية: الكلاسات والكائنات</h1>\n";

// ==========================================
// مثال 1: كلاس الطالب
// ==========================================
echo "<h2>مثال 1: كلاس الطالب</h2>\n";

class Student {
    // الخصائص (Properties)
    public $name;
    public $age;
    public $grade;
    public $subjects = [];
    public $gpa = 0;
    
    // الطرق (Methods)
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
    
    public function study($subject) {
        return $this->name . " يدرس " . $subject;
    }
    
    public function getInfo() {
        $info = "الطالب: " . $this->name . "<br>";
        $info .= "العمر: " . $this->age . "<br>";
        $info .= "الصف: " . $this->grade . "<br>";
        $info .= "المواد: " . implode(", ", $this->subjects) . "<br>";
        $info .= "المعدل: " . $this->gpa;
        return $info;
    }
}

// إنشاء كائنات طلاب (Objects)
echo "<h3>إنشاء كائنات الطلاب:</h3>\n";

$student1 = new Student();
$student1->name = "أحمد محمد";
$student1->age = 16;
$student1->grade = "الأول الثانوي";

$student2 = new Student();
$student2->name = "فاطمة علي";
$student2->age = 17;
$student2->grade = "الثاني الثانوي";

$student3 = new Student();
$student3->name = "محمد أحمد";
$student3->age = 18;
$student3->grade = "الثالث الثانوي";

// استخدام الكائنات
echo "<h4>الطالب الأول:</h4>\n";
echo $student1->getInfo() . "<br>";
echo $student1->addSubject("الرياضيات") . "<br>";
echo $student1->addSubject("الفيزياء") . "<br>";
echo $student1->study("الكيمياء") . "<br>";
$student1->calculateGPA([95, 88, 92]);
echo "المعدل: " . $student1->gpa . "<br><br>";

echo "<h4>الطالب الثاني:</h4>\n";
echo $student2->getInfo() . "<br>";
echo $student2->addSubject("اللغة العربية") . "<br>";
echo $student2->addSubject("التاريخ") . "<br>";
echo $student2->study("الجغرافيا") . "<br>";
$student2->calculateGPA([85, 90, 88]);
echo "المعدل: " . $student2->gpa . "<br><br>";

echo "<h4>الطالب الثالث:</h4>\n";
echo $student3->getInfo() . "<br>";
echo $student3->addSubject("اللغة الإنجليزية") . "<br>";
echo $student3->addSubject("العلوم") . "<br>";
echo $student3->study("الرياضيات") . "<br>";
$student3->calculateGPA([92, 95, 90]);
echo "المعدل: " . $student3->gpa . "<br><br>";

// ==========================================
// مثال 2: كلاس المنتج
// ==========================================
echo "<h2>مثال 2: كلاس المنتج</h2>\n";

class Product {
    // الخصائص
    public $name;
    public $price;
    public $quantity;
    public $category;
    public $description;
    
    // الطرق
    public function getTotalValue() {
        return $this->price * $this->quantity;
    }
    
    public function updatePrice($newPrice) {
        $oldPrice = $this->price;
        $this->price = $newPrice;
        return "تم تحديث سعر " . $this->name . " من " . $oldPrice . " إلى " . $newPrice . " ريال";
    }
    
    public function updateQuantity($newQuantity) {
        $oldQuantity = $this->quantity;
        $this->quantity = $newQuantity;
        return "تم تحديث كمية " . $this->name . " من " . $oldQuantity . " إلى " . $newQuantity;
    }
    
    public function applyDiscount($percentage) {
        if ($percentage > 0 && $percentage <= 100) {
            $discount = $this->price * ($percentage / 100);
            $newPrice = $this->price - $discount;
            $this->price = $newPrice;
            return "تم تطبيق خصم " . $percentage . "% على " . $this->name . " - السعر الجديد: " . $newPrice . " ريال";
        }
        return "نسبة الخصم غير صحيحة";
    }
    
    public function getInfo() {
        $info = "<strong>المنتج:</strong> " . $this->name . "<br>";
        $info .= "<strong>الفئة:</strong> " . $this->category . "<br>";
        $info .= "<strong>الوصف:</strong> " . $this->description . "<br>";
        $info .= "<strong>السعر:</strong> " . $this->price . " ريال<br>";
        $info .= "<strong>الكمية:</strong> " . $this->quantity . "<br>";
        $info .= "<strong>القيمة الإجمالية:</strong> " . $this->getTotalValue() . " ريال";
        return $info;
    }
}

// إنشاء منتجات
echo "<h3>إنشاء كائنات المنتجات:</h3>\n";

$laptop = new Product();
$laptop->name = "لابتوب ديل إنسبرون";
$laptop->price = 5000;
$laptop->quantity = 10;
$laptop->category = "إلكترونيات";
$laptop->description = "لابتوب عالي الأداء للعمل والألعاب";

$phone = new Product();
$phone->name = "آيفون 14";
$phone->price = 3000;
$phone->quantity = 25;
$phone->category = "إلكترونيات";
$phone->description = "هاتف ذكي بمواصفات عالية";

$book = new Product();
$book->name = "كتاب تعلم البرمجة";
$book->price = 50;
$book->quantity = 100;
$book->category = "كتب";
$book->description = "كتاب شامل لتعلم البرمجة للمبتدئين";

// عرض معلومات المنتجات
echo "<h4>اللابتوب:</h4>\n";
echo $laptop->getInfo() . "<br><br>";

echo "<h4>الهاتف:</h4>\n";
echo $phone->getInfo() . "<br><br>";

echo "<h4>الكتاب:</h4>\n";
echo $book->getInfo() . "<br><br>";

// تطبيق عمليات على المنتجات
echo "<h3>تطبيق العمليات على المنتجات:</h3>\n";
echo $laptop->updatePrice(4500) . "<br>";
echo $laptop->applyDiscount(10) . "<br>";
echo $laptop->getInfo() . "<br><br>";

echo $phone->updateQuantity(30) . "<br>";
echo $phone->getInfo() . "<br><br>";

echo $book->applyDiscount(20) . "<br>";
echo $book->getInfo() . "<br><br>";

// ==========================================
// مثال 3: كلاس الحساب البنكي
// ==========================================
echo "<h2>مثال 3: كلاس الحساب البنكي</h2>\n";

class BankAccount {
    // الخصائص
    public $accountNumber;
    public $ownerName;
    public $balance;
    public $transactions = [];
    public $accountType;
    
    // الطرق
    public function deposit($amount) {
        if ($amount > 0) {
            $this->balance += $amount;
            $this->addTransaction("إيداع", $amount);
            return "تم إيداع " . $amount . " ريال في حساب " . $this->accountNumber;
        }
        return "المبلغ يجب أن يكون أكبر من صفر";
    }
    
    public function withdraw($amount) {
        if ($amount > 0 && $amount <= $this->balance) {
            $this->balance -= $amount;
            $this->addTransaction("سحب", $amount);
            return "تم سحب " . $amount . " ريال من حساب " . $this->accountNumber;
        }
        return "المبلغ غير صحيح أو الرصيد غير كافي";
    }
    
    public function transfer($amount, $targetAccount) {
        if ($amount > 0 && $amount <= $this->balance) {
            $this->balance -= $amount;
            $targetAccount->balance += $amount;
            $this->addTransaction("تحويل إلى " . $targetAccount->accountNumber, $amount);
            $targetAccount->addTransaction("تحويل من " . $this->accountNumber, $amount);
            return "تم تحويل " . $amount . " ريال إلى حساب " . $targetAccount->accountNumber;
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
        return "الرصيد الحالي في حساب " . $this->accountNumber . ": " . $this->balance . " ريال";
    }
    
    public function getTransactionHistory() {
        $history = "<strong>تاريخ المعاملات لحساب " . $this->accountNumber . ":</strong><br>";
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
        $info .= "<strong>الرصيد:</strong> " . $this->balance . " ريال";
        return $info;
    }
}

// إنشاء حسابات بنكية
echo "<h3>إنشاء كائنات الحسابات البنكية:</h3>\n";

$account1 = new BankAccount();
$account1->accountNumber = "123456789";
$account1->ownerName = "أحمد السعد";
$account1->balance = 1000;
$account1->accountType = "جاري";

$account2 = new BankAccount();
$account2->accountNumber = "987654321";
$account2->ownerName = "فاطمة محمد";
$account2->balance = 2000;
$account2->accountType = "توفير";

$account3 = new BankAccount();
$account3->accountNumber = "456789123";
$account3->ownerName = "محمد علي";
$account3->balance = 500;
$account3->accountType = "جاري";

// عرض معلومات الحسابات
echo "<h4>الحساب الأول:</h4>\n";
echo $account1->getInfo() . "<br><br>";

echo "<h4>الحساب الثاني:</h4>\n";
echo $account2->getInfo() . "<br><br>";

echo "<h4>الحساب الثالث:</h4>\n";
echo $account3->getInfo() . "<br><br>";

// تطبيق عمليات على الحسابات
echo "<h3>تطبيق العمليات على الحسابات:</h3>\n";

echo "<h4>عمليات الحساب الأول:</h4>\n";
echo $account1->deposit(500) . "<br>";
echo $account1->withdraw(200) . "<br>";
echo $account1->getBalance() . "<br><br>";

echo "<h4>عمليات الحساب الثاني:</h4>\n";
echo $account2->deposit(1000) . "<br>";
echo $account2->withdraw(300) . "<br>";
echo $account2->getBalance() . "<br><br>";

echo "<h4>تحويل من الحساب الثاني إلى الأول:</h4>\n";
echo $account2->transfer(500, $account1) . "<br>";
echo $account1->getBalance() . "<br>";
echo $account2->getBalance() . "<br><br>";

// عرض تاريخ المعاملات
echo "<h3>تاريخ المعاملات:</h3>\n";
echo $account1->getTransactionHistory() . "<br><br>";
echo $account2->getTransactionHistory() . "<br><br>";

// ==========================================
// مثال 4: كلاس السيارة
// ==========================================
echo "<h2>مثال 4: كلاس السيارة</h2>\n";

class Car {
    // الخصائص
    public $brand;
    public $model;
    public $year;
    public $color;
    public $fuel = 0;
    public $isRunning = false;
    public $mileage = 0;
    
    // الطرق
    public function start() {
        if ($this->fuel > 0) {
            $this->isRunning = true;
            return "تم تشغيل السيارة " . $this->brand . " " . $this->model;
        }
        return "لا يمكن تشغيل السيارة - الوقود فارغ";
    }
    
    public function stop() {
        $this->isRunning = false;
        return "تم إيقاف السيارة " . $this->brand . " " . $this->model;
    }
    
    public function addFuel($amount) {
        $this->fuel += $amount;
        return "تم إضافة " . $amount . " لتر من الوقود - الكمية الحالية: " . $this->fuel . " لتر";
    }
    
    public function drive($distance) {
        if ($this->isRunning) {
            $fuelNeeded = $distance / 10; // كل 10 كم يحتاج لتر واحد
            if ($this->fuel >= $fuelNeeded) {
                $this->fuel -= $fuelNeeded;
                $this->mileage += $distance;
                return "تم السير مسافة " . $distance . " كم - الوقود المتبقي: " . $this->fuel . " لتر - المسافة الإجمالية: " . $this->mileage . " كم";
            }
            return "لا يوجد وقود كافي للسير";
        }
        return "يجب تشغيل السيارة أولاً";
    }
    
    public function getInfo() {
        $status = $this->isRunning ? "تعمل" : "متوقفة";
        $info = "<strong>السيارة:</strong> " . $this->brand . " " . $this->model . "<br>";
        $info .= "<strong>السنة:</strong> " . $this->year . "<br>";
        $info .= "<strong>اللون:</strong> " . $this->color . "<br>";
        $info .= "<strong>الوقود:</strong> " . $this->fuel . " لتر<br>";
        $info .= "<strong>المسافة المقطوعة:</strong> " . $this->mileage . " كم<br>";
        $info .= "<strong>الحالة:</strong> " . $status;
        return $info;
    }
}

// إنشاء سيارات
echo "<h3>إنشاء كائنات السيارات:</h3>\n";

$car1 = new Car();
$car1->brand = "تويوتا";
$car1->model = "كامري";
$car1->year = 2020;
$car1->color = "أبيض";

$car2 = new Car();
$car2->brand = "هونداي";
$car2->model = "إلنترا";
$car2->year = 2019;
$car2->color = "أسود";

$car3 = new Car();
$car3->brand = "نيسان";
$car3->model = "التيما";
$car3->year = 2021;
$car3->color = "أزرق";

// عرض معلومات السيارات
echo "<h4>السيارة الأولى:</h4>\n";
echo $car1->getInfo() . "<br><br>";

echo "<h4>السيارة الثانية:</h4>\n";
echo $car2->getInfo() . "<br><br>";

echo "<h4>السيارة الثالثة:</h4>\n";
echo $car3->getInfo() . "<br><br>";

// تشغيل السيارات
echo "<h3>تشغيل السيارات:</h3>\n";

echo "<h4>السيارة الأولى:</h4>\n";
echo $car1->addFuel(50) . "<br>";
echo $car1->start() . "<br>";
echo $car1->drive(30) . "<br>";
echo $car1->drive(20) . "<br>";
echo $car1->stop() . "<br>";
echo $car1->getInfo() . "<br><br>";

echo "<h4>السيارة الثانية:</h4>\n";
echo $car2->start() . "<br>"; // لن تعمل لأن الوقود فارغ
echo $car2->addFuel(30) . "<br>";
echo $car2->start() . "<br>";
echo $car2->drive(50) . "<br>";
echo $car2->getInfo() . "<br><br>";

echo "<h4>السيارة الثالثة:</h4>\n";
echo $car3->addFuel(40) . "<br>";
echo $car3->start() . "<br>";
echo $car3->drive(25) . "<br>";
echo $car3->getInfo() . "<br><br>";

// ==========================================
// خلاصة المحاضرة
// ==========================================
echo "<hr>";
echo "<h2>🎯 خلاصة المحاضرة</h2>";
echo "<div style='background-color: #f0f8ff; padding: 20px; border-radius: 10px;'>";
echo "<h3>ما تعلمناه:</h3>";
echo "<ul>";
echo "<li><strong>الكلاس (Class):</strong> قالب أو مخطط لإنشاء الكائنات</li>";
echo "<li><strong>الكائن (Object):</strong> نسخة حقيقية من الكلاس</li>";
echo "<li><strong>الخصائص (Properties):</strong> المتغيرات داخل الكلاس</li>";
echo "<li><strong>الطرق (Methods):</strong> الدوال داخل الكلاس</li>";
echo "<li><strong>إنشاء الكائنات:</strong> باستخدام كلمة <code>new</code></li>";
echo "<li><strong>الاستقلالية:</strong> كل كائن له هوية فريدة وحالة مستقلة</li>";
echo "</ul>";

echo "<h3>أفضل الممارسات:</h3>";
echo "<ul>";
echo "<li>اسم الكلاس يبدأ بحرف كبير</li>";
echo "<li>اسم الكائن يبدأ بحرف صغير</li>";
echo "<li>تنظيم الكود: الخصائص أولاً، ثم الطرق</li>";
echo "<li>استخدام تعليقات واضحة</li>";
echo "<li>تسمية وصفية للخصائص والطرق</li>";
echo "</ul>";
echo "</div>";
?>


