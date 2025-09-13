<?php
/**
 * المحاضرة السادسة: أمثلة على التغليف (Encapsulation)
 * 
 * هذا الملف يحتوي على أمثلة متنوعة لشرح مفهوم التغليف
 */

echo "<h1>المحاضرة السادسة: التغليف (Encapsulation)</h1>\n";

// ==========================================
// مثال 1: كلاس المستخدم مع التغليف
// ==========================================
echo "<h2>مثال 1: كلاس المستخدم</h2>\n";

class User {
    private $name;
    private $email;
    private $age;
    private $password;
    private $isActive;
    private $loginAttempts;
    private $lastLogin;
    private $createdAt;
    
    public function __construct($name, $email, $age) {
        echo "🏗️ <strong>تم إنشاء مستخدم جديد:</strong> " . $name . "<br>";
        
        $this->name = $name;
        $this->email = $email;
        $this->age = $age;
        $this->isActive = true;
        $this->loginAttempts = 0;
        $this->lastLogin = null;
        $this->createdAt = date('Y-m-d H:i:s');
        
        echo "✅ <strong>تم تهيئة المستخدم بنجاح</strong><br>";
    }
    
    // Getters
    public function getName() {
        return $this->name;
    }
    
    public function getEmail() {
        return $this->email;
    }
    
    public function getAge() {
        return $this->age;
    }
    
    public function isActive() {
        return $this->isActive;
    }
    
    public function getLastLogin() {
        return $this->lastLogin;
    }
    
    public function getCreatedAt() {
        return $this->createdAt;
    }
    
    public function getLoginAttempts() {
        return $this->loginAttempts;
    }
    
    // Setters مع التحقق
    public function setName($name) {
        if (!empty($name) && strlen($name) >= 2) {
            $this->name = $name;
            return "تم تحديث الاسم إلى: " . $name;
        }
        return "الاسم يجب أن يكون حرفين على الأقل";
    }
    
    public function setEmail($email) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->email = $email;
            return "تم تحديث الإيميل إلى: " . $email;
        }
        return "الإيميل غير صحيح";
    }
    
    public function setAge($age) {
        if ($age > 0 && $age < 150) {
            $this->age = $age;
            return "تم تحديث العمر إلى: " . $age;
        }
        return "العمر يجب أن يكون بين 1 و 150";
    }
    
    public function setPassword($password) {
        if (strlen($password) >= 6) {
            $this->password = password_hash($password, PASSWORD_DEFAULT);
            return "تم تعيين كلمة المرور بنجاح";
        }
        return "كلمة المرور يجب أن تكون 6 أحرف على الأقل";
    }
    
    public function activate() {
        $this->isActive = true;
        return "تم تفعيل الحساب";
    }
    
    public function deactivate() {
        $this->isActive = false;
        return "تم إلغاء تفعيل الحساب";
    }
    
    public function login($email, $password) {
        if (!$this->isActive) {
            return "الحساب غير مفعل";
        }
        
        if ($this->loginAttempts >= 3) {
            return "تم تجاوز عدد المحاولات المسموح - الحساب محظور مؤقتاً";
        }
        
        if ($this->email === $email && password_verify($password, $this->password)) {
            $this->loginAttempts = 0;
            $this->lastLogin = date('Y-m-d H:i:s');
            return "تم تسجيل الدخول بنجاح - آخر دخول: " . $this->lastLogin;
        }
        
        $this->loginAttempts++;
        return "فشل تسجيل الدخول - المحاولة رقم: " . $this->loginAttempts;
    }
    
    public function resetLoginAttempts() {
        $this->loginAttempts = 0;
        return "تم إعادة تعيين محاولات تسجيل الدخول";
    }
    
    public function getInfo() {
        $info = "<strong>الاسم:</strong> " . $this->name . "<br>";
        $info .= "<strong>الإيميل:</strong> " . $this->email . "<br>";
        $info .= "<strong>العمر:</strong> " . $this->age . "<br>";
        $info .= "<strong>الحالة:</strong> " . ($this->isActive ? "نشط" : "غير نشط") . "<br>";
        $info .= "<strong>آخر دخول:</strong> " . ($this->lastLogin ? $this->lastLogin : "لم يسجل دخول") . "<br>";
        $info .= "<strong>محاولات الدخول:</strong> " . $this->loginAttempts . "<br>";
        $info .= "<strong>تاريخ الإنشاء:</strong> " . $this->createdAt;
        return $info;
    }
}

// استخدام الكلاس
echo "<h3>إنشاء مستخدم جديد:</h3>\n";

$user = new User("أحمد محمد", "ahmed@example.com", 25);

echo "<h4>تعيين كلمة المرور:</h4>\n";
echo $user->setPassword("123456") . "<br>";

echo "<h4>محاولة تسجيل الدخول:</h4>\n";
echo $user->login("ahmed@example.com", "123456") . "<br>";

echo "<h4>معلومات المستخدم:</h4>\n";
echo $user->getInfo() . "<br><br>";

echo "<h4>تحديث المعلومات:</h4>\n";
echo $user->setName("أحمد السعد") . "<br>";
echo $user->setAge(26) . "<br>";
echo $user->setEmail("ahmed.saad@example.com") . "<br><br>";

echo "<h4>معلومات المستخدم المحدثة:</h4>\n";
echo $user->getInfo() . "<br><br>";

// ==========================================
// مثال 2: كلاس المنتج مع التغليف
// ==========================================
echo "<h2>مثال 2: كلاس المنتج</h2>\n";

class Product {
    private $id;
    private $name;
    private $price;
    private $quantity;
    private $category;
    private $description;
    private $isActive;
    private $createdAt;
    private $updatedAt;
    private $views;
    private $rating;
    private $reviews;
    
    public function __construct($name, $price, $category) {
        echo "🏗️ <strong>تم إنشاء منتج جديد:</strong> " . $name . "<br>";
        
        $this->id = uniqid('PROD_');
        $this->name = $name;
        $this->price = $price;
        $this->category = $category;
        $this->quantity = 0;
        $this->description = "";
        $this->isActive = true;
        $this->createdAt = date('Y-m-d H:i:s');
        $this->updatedAt = date('Y-m-d H:i:s');
        $this->views = 0;
        $this->rating = 0;
        $this->reviews = [];
        
        echo "✅ <strong>تم تهيئة المنتج بنجاح</strong> - ID: " . $this->id . "<br>";
    }
    
    // Getters
    public function getId() {
        return $this->id;
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function getPrice() {
        return $this->price;
    }
    
    public function getQuantity() {
        return $this->quantity;
    }
    
    public function getCategory() {
        return $this->category;
    }
    
    public function getDescription() {
        return $this->description;
    }
    
    public function isActive() {
        return $this->isActive;
    }
    
    public function getCreatedAt() {
        return $this->createdAt;
    }
    
    public function getUpdatedAt() {
        return $this->updatedAt;
    }
    
    public function getViews() {
        return $this->views;
    }
    
    public function getRating() {
        return $this->rating;
    }
    
    public function getReviews() {
        return $this->reviews;
    }
    
    // Setters مع التحقق
    public function setName($name) {
        if (!empty($name) && strlen($name) >= 2) {
            $this->name = $name;
            $this->updatedAt = date('Y-m-d H:i:s');
            return "تم تحديث اسم المنتج إلى: " . $name;
        }
        return "اسم المنتج يجب أن يكون حرفين على الأقل";
    }
    
    public function setPrice($price) {
        if ($price > 0 && is_numeric($price)) {
            $this->price = $price;
            $this->updatedAt = date('Y-m-d H:i:s');
            return "تم تحديث السعر إلى: " . $price . " ريال";
        }
        return "السعر يجب أن يكون رقم أكبر من صفر";
    }
    
    public function setQuantity($quantity) {
        if ($quantity >= 0 && is_int($quantity)) {
            $this->quantity = $quantity;
            $this->updatedAt = date('Y-m-d H:i:s');
            return "تم تحديث الكمية إلى: " . $quantity;
        }
        return "الكمية يجب أن تكون رقم صحيح أكبر من أو يساوي صفر";
    }
    
    public function setCategory($category) {
        if (!empty($category)) {
            $this->category = $category;
            $this->updatedAt = date('Y-m-d H:i:s');
            return "تم تحديث الفئة إلى: " . $category;
        }
        return "الفئة لا يمكن أن تكون فارغة";
    }
    
    public function setDescription($description) {
        $this->description = $description;
        $this->updatedAt = date('Y-m-d H:i:s');
        return "تم تحديث الوصف";
    }
    
    public function activate() {
        $this->isActive = true;
        $this->updatedAt = date('Y-m-d H:i:s');
        return "تم تفعيل المنتج";
    }
    
    public function deactivate() {
        $this->isActive = false;
        $this->updatedAt = date('Y-m-d H:i:s');
        return "تم إلغاء تفعيل المنتج";
    }
    
    public function view() {
        $this->views++;
        $this->updatedAt = date('Y-m-d H:i:s');
        return "تم عرض المنتج - المشاهدات: " . $this->views;
    }
    
    public function addReview($reviewer, $rating, $comment) {
        if ($rating >= 1 && $rating <= 5) {
            $review = [
                'reviewer' => $reviewer,
                'rating' => $rating,
                'comment' => $comment,
                'date' => date('Y-m-d H:i:s')
            ];
            $this->reviews[] = $review;
            $this->updateRating();
            $this->updatedAt = date('Y-m-d H:i:s');
            return "تم إضافة تقييم من " . $reviewer . " - التقييم: " . $rating . "/5";
        }
        return "التقييم يجب أن يكون بين 1 و 5";
    }
    
    public function isInStock() {
        return $this->quantity > 0;
    }
    
    public function getTotalValue() {
        return $this->price * $this->quantity;
    }
    
    public function getInfo() {
        $info = "<strong>معرف المنتج:</strong> " . $this->id . "<br>";
        $info .= "<strong>الاسم:</strong> " . $this->name . "<br>";
        $info .= "<strong>السعر:</strong> " . $this->price . " ريال<br>";
        $info .= "<strong>الكمية:</strong> " . $this->quantity . "<br>";
        $info .= "<strong>الفئة:</strong> " . $this->category . "<br>";
        $info .= "<strong>الوصف:</strong> " . $this->description . "<br>";
        $info .= "<strong>الحالة:</strong> " . ($this->isActive ? "نشط" : "غير نشط") . "<br>";
        $info .= "<strong>متوفر:</strong> " . ($this->isInStock() ? "نعم" : "لا") . "<br>";
        $info .= "<strong>القيمة الإجمالية:</strong> " . $this->getTotalValue() . " ريال<br>";
        $info .= "<strong>المشاهدات:</strong> " . $this->views . "<br>";
        $info .= "<strong>التقييم:</strong> " . $this->rating . "/5<br>";
        $info .= "<strong>عدد التقييمات:</strong> " . count($this->reviews) . "<br>";
        $info .= "<strong>تاريخ الإنشاء:</strong> " . $this->createdAt . "<br>";
        $info .= "<strong>آخر تحديث:</strong> " . $this->updatedAt;
        return $info;
    }
    
    // الطرق الخاصة
    private function updateRating() {
        if (!empty($this->reviews)) {
            $totalRating = 0;
            foreach ($this->reviews as $review) {
                $totalRating += $review['rating'];
            }
            $this->rating = round($totalRating / count($this->reviews), 1);
        }
    }
}

// استخدام الكلاس
echo "<h3>إنشاء منتج جديد:</h3>\n";

$product = new Product("لابتوب ديل", 5000, "إلكترونيات");

echo "<h4>تحديث معلومات المنتج:</h4>\n";
echo $product->setDescription("لابتوب عالي الأداء للعمل والألعاب") . "<br>";
echo $product->setQuantity(10) . "<br>";
echo $product->setPrice(4500) . "<br>";

echo "<h4>عرض المنتج وإضافة تقييمات:</h4>\n";
echo $product->view() . "<br>";
echo $product->view() . "<br>";
echo $product->addReview("أحمد", 5, "منتج ممتاز") . "<br>";
echo $product->addReview("فاطمة", 4, "جيد جداً") . "<br>";
echo $product->addReview("محمد", 5, "رائع") . "<br>";

echo "<h4>معلومات المنتج:</h4>\n";
echo $product->getInfo() . "<br><br>";

// ==========================================
// مثال 3: كلاس الحساب البنكي مع التغليف
// ==========================================
echo "<h2>مثال 3: كلاس الحساب البنكي</h2>\n";

class BankAccount {
    private $accountNumber;
    private $ownerName;
    private $balance;
    private $pin;
    private $isActive;
    private $transactions;
    private $dailyLimit;
    private $dailyWithdrawn;
    private $lastResetDate;
    private $createdAt;
    
    public function __construct($accountNumber, $ownerName, $pin, $initialBalance = 0) {
        echo "🏗️ <strong>تم إنشاء حساب بنكي جديد:</strong> " . $accountNumber . "<br>";
        
        $this->accountNumber = $accountNumber;
        $this->ownerName = $ownerName;
        $this->pin = $pin;
        $this->balance = $initialBalance;
        $this->isActive = true;
        $this->transactions = [];
        $this->dailyLimit = 5000;
        $this->dailyWithdrawn = 0;
        $this->lastResetDate = date('Y-m-d');
        $this->createdAt = date('Y-m-d H:i:s');
        
        $this->addTransaction("إنشاء الحساب", $initialBalance);
        
        echo "✅ <strong>تم تهيئة الحساب بنجاح</strong><br>";
    }
    
    // Getters
    public function getAccountNumber() {
        return $this->accountNumber;
    }
    
    public function getOwnerName() {
        return $this->ownerName;
    }
    
    public function getBalance($pin) {
        if ($this->verifyPin($pin)) {
            return $this->balance;
        }
        return "PIN غير صحيح";
    }
    
    public function isActive() {
        return $this->isActive;
    }
    
    public function getDailyLimit() {
        return $this->dailyLimit;
    }
    
    public function getCreatedAt() {
        return $this->createdAt;
    }
    
    // Setters مع التحقق
    public function setOwnerName($newName, $pin) {
        if ($this->verifyPin($pin)) {
            if (!empty($newName)) {
                $this->ownerName = $newName;
                return "تم تحديث اسم المالك إلى: " . $newName;
            }
            return "الاسم لا يمكن أن يكون فارغاً";
        }
        return "PIN غير صحيح";
    }
    
    public function setDailyLimit($newLimit, $pin) {
        if ($this->verifyPin($pin)) {
            if ($newLimit > 0) {
                $this->dailyLimit = $newLimit;
                return "تم تحديث الحد اليومي إلى: " . $newLimit . " ريال";
            }
            return "الحد يجب أن يكون أكبر من صفر";
        }
        return "PIN غير صحيح";
    }
    
    public function changePin($oldPin, $newPin) {
        if ($this->verifyPin($oldPin)) {
            if (strlen($newPin) == 4 && is_numeric($newPin)) {
                $this->pin = $newPin;
                return "تم تغيير PIN بنجاح";
            }
            return "PIN الجديد يجب أن يكون 4 أرقام";
        }
        return "PIN الحالي غير صحيح";
    }
    
    public function deposit($amount) {
        if (!$this->isActive) {
            return "الحساب غير نشط";
        }
        
        if ($amount > 0) {
            $this->balance += $amount;
            $this->addTransaction("إيداع", $amount);
            return "تم إيداع " . $amount . " ريال - الرصيد: " . $this->balance . " ريال";
        }
        return "المبلغ يجب أن يكون أكبر من صفر";
    }
    
    public function withdraw($amount, $pin) {
        if (!$this->isActive) {
            return "الحساب غير نشط";
        }
        
        if (!$this->verifyPin($pin)) {
            return "PIN غير صحيح";
        }
        
        $this->resetDailyLimit();
        
        if ($amount > 0) {
            if ($amount <= $this->balance) {
                if ($this->dailyWithdrawn + $amount <= $this->dailyLimit) {
                    $this->balance -= $amount;
                    $this->dailyWithdrawn += $amount;
                    $this->addTransaction("سحب", $amount);
                    return "تم سحب " . $amount . " ريال - الرصيد: " . $this->balance . " ريال";
                }
                return "تجاوز الحد اليومي - المتبقي: " . ($this->dailyLimit - $this->dailyWithdrawn) . " ريال";
            }
            return "الرصيد غير كافي";
        }
        return "المبلغ يجب أن يكون أكبر من صفر";
    }
    
    public function transfer($amount, $targetAccount, $pin) {
        if (!$this->isActive) {
            return "الحساب غير نشط";
        }
        
        if (!$this->verifyPin($pin)) {
            return "PIN غير صحيح";
        }
        
        if ($amount > 0 && $amount <= $this->balance) {
            $this->balance -= $amount;
            $targetAccount->balance += $amount;
            $this->addTransaction("تحويل إلى " . $targetAccount->accountNumber, $amount);
            $targetAccount->addTransaction("تحويل من " . $this->accountNumber, $amount);
            return "تم تحويل " . $amount . " ريال إلى حساب " . $targetAccount->accountNumber;
        }
        return "المبلغ غير صحيح أو الرصيد غير كافي";
    }
    
    public function blockAccount($pin) {
        if ($this->verifyPin($pin)) {
            $this->isActive = false;
            return "تم حظر الحساب";
        }
        return "PIN غير صحيح";
    }
    
    public function unblockAccount($pin) {
        if ($this->verifyPin($pin)) {
            $this->isActive = true;
            return "تم إلغاء حظر الحساب";
        }
        return "PIN غير صحيح";
    }
    
    public function getTransactionHistory($pin) {
        if ($this->verifyPin($pin)) {
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
        return "PIN غير صحيح";
    }
    
    public function getInfo($pin) {
        if ($this->verifyPin($pin)) {
            $info = "<strong>رقم الحساب:</strong> " . $this->accountNumber . "<br>";
            $info .= "<strong>اسم المالك:</strong> " . $this->ownerName . "<br>";
            $info .= "<strong>الرصيد:</strong> " . $this->balance . " ريال<br>";
            $info .= "<strong>الحالة:</strong> " . ($this->isActive ? "نشط" : "محظور") . "<br>";
            $info .= "<strong>الحد اليومي:</strong> " . $this->dailyLimit . " ريال<br>";
            $info .= "<strong>المسحوب اليوم:</strong> " . $this->dailyWithdrawn . " ريال<br>";
            $info .= "<strong>تاريخ الإنشاء:</strong> " . $this->createdAt;
            return $info;
        }
        return "PIN غير صحيح";
    }
    
    // الطرق الخاصة
    private function verifyPin($pin) {
        return $pin === $this->pin;
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
    
    private function resetDailyLimit() {
        $today = date('Y-m-d');
        if ($this->lastResetDate !== $today) {
            $this->dailyWithdrawn = 0;
            $this->lastResetDate = $today;
        }
    }
}

// استخدام الكلاس
echo "<h3>إنشاء حساب بنكي جديد:</h3>\n";

$account = new BankAccount("123456789", "أحمد السعد", "1234", 1000);

echo "<h4>عمليات الحساب:</h4>\n";
echo $account->deposit(500) . "<br>";
echo $account->withdraw(200, "1234") . "<br>";
echo $account->getBalance("1234") . "<br>";

echo "<h4>معلومات الحساب:</h4>\n";
echo $account->getInfo("1234") . "<br><br>";

echo "<h4>تاريخ المعاملات:</h4>\n";
echo $account->getTransactionHistory("1234") . "<br><br>";

echo "<h4>تحديث معلومات الحساب:</h4>\n";
echo $account->setOwnerName("أحمد السعد محمد", "1234") . "<br>";
echo $account->setDailyLimit(7000, "1234") . "<br>";
echo $account->changePin("1234", "5678") . "<br><br>";

echo "<h4>معلومات الحساب المحدثة:</h4>\n";
echo $account->getInfo("5678") . "<br><br>";

// ==========================================
// مثال 4: كلاس الطالب مع التغليف
// ==========================================
echo "<h2>مثال 4: كلاس الطالب</h2>\n";

class Student {
    private $name;
    private $age;
    private $grade;
    private $subjects;
    private $grades;
    private $gpa;
    private $isActive;
    private $enrollmentDate;
    
    public function __construct($name, $age, $grade) {
        echo "🏗️ <strong>تم إنشاء طالب جديد:</strong> " . $name . "<br>";
        
        $this->name = $name;
        $this->age = $age;
        $this->grade = $grade;
        $this->subjects = [];
        $this->grades = [];
        $this->gpa = 0;
        $this->isActive = true;
        $this->enrollmentDate = date('Y-m-d H:i:s');
        
        echo "✅ <strong>تم تهيئة الطالب بنجاح</strong><br>";
    }
    
    // Getters
    public function getName() {
        return $this->name;
    }
    
    public function getAge() {
        return $this->age;
    }
    
    public function getGrade() {
        return $this->grade;
    }
    
    public function getSubjects() {
        return $this->subjects;
    }
    
    public function getGrades() {
        return $this->grades;
    }
    
    public function getGPA() {
        return $this->gpa;
    }
    
    public function isActive() {
        return $this->isActive;
    }
    
    public function getEnrollmentDate() {
        return $this->enrollmentDate;
    }
    
    // Setters مع التحقق
    public function setName($name) {
        if (!empty($name) && strlen($name) >= 2) {
            $this->name = $name;
            return "تم تحديث اسم الطالب إلى: " . $name;
        }
        return "اسم الطالب يجب أن يكون حرفين على الأقل";
    }
    
    public function setAge($age) {
        if ($age > 0 && $age < 100) {
            $this->age = $age;
            return "تم تحديث عمر الطالب إلى: " . $age;
        }
        return "عمر الطالب يجب أن يكون بين 1 و 100";
    }
    
    public function setGrade($grade) {
        if (!empty($grade)) {
            $this->grade = $grade;
            return "تم تحديث صف الطالب إلى: " . $grade;
        }
        return "صف الطالب لا يمكن أن يكون فارغاً";
    }
    
    public function addSubject($subject) {
        if (!empty($subject) && !in_array($subject, $this->subjects)) {
            $this->subjects[] = $subject;
            return "تم إضافة مادة: " . $subject;
        }
        return "المادة موجودة بالفعل أو فارغة";
    }
    
    public function removeSubject($subject) {
        $key = array_search($subject, $this->subjects);
        if ($key !== false) {
            unset($this->subjects[$key]);
            $this->subjects = array_values($this->subjects);
            if (isset($this->grades[$subject])) {
                unset($this->grades[$subject]);
            }
            $this->calculateGPA();
            return "تم حذف مادة: " . $subject;
        }
        return "المادة غير موجودة";
    }
    
    public function addGrade($subject, $grade) {
        if (in_array($subject, $this->subjects)) {
            if ($grade >= 0 && $grade <= 100) {
                $this->grades[$subject] = $grade;
                $this->calculateGPA();
                return "تم إضافة درجة " . $grade . " لمادة " . $subject;
            }
            return "الدرجة يجب أن تكون بين 0 و 100";
        }
        return "المادة غير مسجلة للطالب";
    }
    
    public function updateGrade($subject, $grade) {
        if (isset($this->grades[$subject])) {
            if ($grade >= 0 && $grade <= 100) {
                $this->grades[$subject] = $grade;
                $this->calculateGPA();
                return "تم تحديث درجة " . $subject . " إلى " . $grade;
            }
            return "الدرجة يجب أن تكون بين 0 و 100";
        }
        return "المادة غير موجودة في سجل الدرجات";
    }
    
    public function activate() {
        $this->isActive = true;
        return "تم تفعيل الطالب";
    }
    
    public function deactivate() {
        $this->isActive = false;
        return "تم إلغاء تفعيل الطالب";
    }
    
    public function getInfo() {
        $info = "<strong>الاسم:</strong> " . $this->name . "<br>";
        $info .= "<strong>العمر:</strong> " . $this->age . "<br>";
        $info .= "<strong>الصف:</strong> " . $this->grade . "<br>";
        $info .= "<strong>المواد:</strong> " . implode(", ", $this->subjects) . "<br>";
        $info .= "<strong>المعدل:</strong> " . $this->gpa . "<br>";
        $info .= "<strong>الحالة:</strong> " . ($this->isActive ? "نشط" : "غير نشط") . "<br>";
        $info .= "<strong>تاريخ التسجيل:</strong> " . $this->enrollmentDate;
        return $info;
    }
    
    public function getGradesInfo() {
        $info = "<strong>درجات الطالب:</strong><br>";
        if (empty($this->grades)) {
            $info .= "لا توجد درجات مسجلة";
        } else {
            foreach ($this->grades as $subject => $grade) {
                $info .= $subject . ": " . $grade . "<br>";
            }
        }
        return $info;
    }
    
    // الطرق الخاصة
    private function calculateGPA() {
        if (!empty($this->grades)) {
            $total = array_sum($this->grades);
            $count = count($this->grades);
            $this->gpa = round($total / $count, 2);
        } else {
            $this->gpa = 0;
        }
    }
}

// استخدام الكلاس
echo "<h3>إنشاء طالب جديد:</h3>\n";

$student = new Student("سارة أحمد", 16, "الأول الثانوي");

echo "<h4>إضافة المواد:</h4>\n";
echo $student->addSubject("الرياضيات") . "<br>";
echo $student->addSubject("الفيزياء") . "<br>";
echo $student->addSubject("الكيمياء") . "<br>";
echo $student->addSubject("اللغة العربية") . "<br>";

echo "<h4>إضافة الدرجات:</h4>\n";
echo $student->addGrade("الرياضيات", 95) . "<br>";
echo $student->addGrade("الفيزياء", 88) . "<br>";
echo $student->addGrade("الكيمياء", 92) . "<br>";
echo $student->addGrade("اللغة العربية", 90) . "<br>";

echo "<h4>معلومات الطالب:</h4>\n";
echo $student->getInfo() . "<br><br>";

echo "<h4>درجات الطالب:</h4>\n";
echo $student->getGradesInfo() . "<br><br>";

echo "<h4>تحديث الدرجات:</h4>\n";
echo $student->updateGrade("الرياضيات", 98) . "<br>";
echo $student->addGrade("التاريخ", 85) . "<br>";

echo "<h4>معلومات الطالب المحدثة:</h4>\n";
echo $student->getInfo() . "<br><br>";

// ==========================================
// خلاصة المحاضرة
// ==========================================
echo "<hr>";
echo "<h2>🎯 خلاصة المحاضرة</h2>";
echo "<div style='background-color: #f0f8ff; padding: 20px; border-radius: 10px;'>";
echo "<h3>ما تعلمناه:</h3>";
echo "<ul>";
echo "<li><strong>التغليف (Encapsulation):</strong> إخفاء التفاصيل الداخلية وحماية البيانات</li>";
echo "<li><strong>مستويات الوصول:</strong> Public, Protected, Private</li>";
echo "<li><strong>Getters و Setters:</strong> للتحكم في الوصول للبيانات</li>";
echo "<li><strong>التحقق من البيانات:</strong> ضمان صحة البيانات المدخلة</li>";
echo "<li><strong>حماية البيانات:</strong> منع الوصول غير المصرح به</li>";
echo "<li><strong>إخفاء التعقيد:</strong> إخفاء التفاصيل الداخلية</li>";
echo "</ul>";

echo "<h3>أفضل الممارسات:</h3>";
echo "<ul>";
echo "<li>استخدم Private للبيانات الحساسة</li>";
echo "<li>استخدم Protected للبيانات المشتركة</li>";
echo "<li>استخدم Public للواجهة العامة</li>";
echo "<li>استخدم Getters و Setters للتحكم</li>";
echo "<li>تحقق من صحة البيانات قبل التعيين</li>";
echo "<li>استخدم أسماء وصفية للطرق</li>";
echo "</ul>";
echo "</div>";
?>


