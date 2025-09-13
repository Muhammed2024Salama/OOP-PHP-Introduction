<?php
/**
 * المحاضرة الثالثة: أمثلة على الخصائص والطرق
 * 
 * هذا الملف يحتوي على أمثلة متنوعة لشرح مفهوم الخصائص والطرق
 */

echo "<h1>المحاضرة الثالثة: الخصائص والطرق</h1>\n";

// ==========================================
// مثال 1: كلاس المستخدم مع الخصائص والطرق
// ==========================================
echo "<h2>مثال 1: كلاس المستخدم</h2>\n";

class User {
    // الخصائص العامة
    public $name;
    public $email;
    public $age;
    public $isActive = true;
    
    // الخصائص الخاصة
    private $password;
    private $loginAttempts = 0;
    private $lastLogin;
    
    // الطرق العامة
    public function setName($name) {
        if (!empty($name)) {
            $this->name = $name;
            return "تم تحديث الاسم إلى: " . $name;
        }
        return "الاسم لا يمكن أن يكون فارغاً";
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function setEmail($email) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->email = $email;
            return "تم تحديث الإيميل إلى: " . $email;
        }
        return "الإيميل غير صحيح";
    }
    
    public function getEmail() {
        return $this->email;
    }
    
    public function setAge($age) {
        if ($age > 0 && $age < 150) {
            $this->age = $age;
            return "تم تحديث العمر إلى: " . $age;
        }
        return "العمر يجب أن يكون بين 1 و 150";
    }
    
    public function getAge() {
        return $this->age;
    }
    
    public function setPassword($password) {
        if (strlen($password) >= 6) {
            $this->password = password_hash($password, PASSWORD_DEFAULT);
            return "تم تحديث كلمة المرور بنجاح";
        }
        return "كلمة المرور يجب أن تكون 6 أحرف على الأقل";
    }
    
    public function login($email, $password) {
        if ($this->email === $email && password_verify($password, $this->password)) {
            $this->loginAttempts = 0;
            $this->lastLogin = date('Y-m-d H:i:s');
            return "تم تسجيل الدخول بنجاح - آخر دخول: " . $this->lastLogin;
        }
        $this->loginAttempts++;
        return "فشل تسجيل الدخول - المحاولة رقم: " . $this->loginAttempts;
    }
    
    public function getLoginAttempts() {
        return $this->loginAttempts;
    }
    
    public function getLastLogin() {
        return $this->lastLogin ? $this->lastLogin : "لم يسجل دخول من قبل";
    }
    
    public function activate() {
        $this->isActive = true;
        return "تم تفعيل الحساب";
    }
    
    public function deactivate() {
        $this->isActive = false;
        return "تم إلغاء تفعيل الحساب";
    }
    
    public function getInfo() {
        $info = "<strong>الاسم:</strong> " . $this->name . "<br>";
        $info .= "<strong>الإيميل:</strong> " . $this->email . "<br>";
        $info .= "<strong>العمر:</strong> " . $this->age . "<br>";
        $info .= "<strong>الحالة:</strong> " . ($this->isActive ? "نشط" : "غير نشط") . "<br>";
        $info .= "<strong>محاولات تسجيل الدخول:</strong> " . $this->loginAttempts . "<br>";
        $info .= "<strong>آخر دخول:</strong> " . $this->getLastLogin();
        return $info;
    }
    
    // الطرق الخاصة
    private function validateEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
    
    private function validateAge($age) {
        return $age > 0 && $age < 150;
    }
}

// استخدام الكلاس
echo "<h3>إنشاء مستخدم جديد:</h3>\n";

$user = new User();
echo $user->setName("أحمد محمد") . "<br>";
echo $user->setEmail("ahmed@example.com") . "<br>";
echo $user->setAge(25) . "<br>";
echo $user->setPassword("123456") . "<br>";

echo "<h4>معلومات المستخدم:</h4>\n";
echo $user->getInfo() . "<br><br>";

echo "<h4>محاولة تسجيل الدخول:</h4>\n";
echo $user->login("ahmed@example.com", "123456") . "<br>";
echo $user->login("ahmed@example.com", "wrong") . "<br>";
echo $user->login("ahmed@example.com", "wrong") . "<br>";

echo "<h4>معلومات المستخدم بعد محاولات تسجيل الدخول:</h4>\n";
echo $user->getInfo() . "<br><br>";

// ==========================================
// مثال 2: كلاس المنتج مع الخصائص والطرق المتقدمة
// ==========================================
echo "<h2>مثال 2: كلاس المنتج</h2>\n";

class Product {
    // الخصائص العامة
    public $name;
    public $price;
    public $quantity;
    public $category;
    public $description;
    
    // الخصائص الخاصة
    private $discount = 0;
    private $isOnSale = false;
    private $saleEndDate;
    private $views = 0;
    private $rating = 0;
    private $reviews = [];
    
    // الطرق العامة
    public function setName($name) {
        if (!empty($name)) {
            $this->name = $name;
            return "تم تحديث اسم المنتج إلى: " . $name;
        }
        return "اسم المنتج لا يمكن أن يكون فارغاً";
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function setPrice($price) {
        if ($price > 0) {
            $this->price = $price;
            return "تم تحديث السعر إلى: " . $price . " ريال";
        }
        return "السعر يجب أن يكون أكبر من صفر";
    }
    
    public function getPrice() {
        return $this->price;
    }
    
    public function setQuantity($quantity) {
        if ($quantity >= 0) {
            $this->quantity = $quantity;
            return "تم تحديث الكمية إلى: " . $quantity;
        }
        return "الكمية يجب أن تكون أكبر من أو تساوي صفر";
    }
    
    public function getQuantity() {
        return $this->quantity;
    }
    
    public function setCategory($category) {
        $this->category = $category;
        return "تم تحديث الفئة إلى: " . $category;
    }
    
    public function getCategory() {
        return $this->category;
    }
    
    public function setDescription($description) {
        $this->description = $description;
        return "تم تحديث الوصف";
    }
    
    public function getDescription() {
        return $this->description;
    }
    
    public function applyDiscount($percentage) {
        if ($percentage > 0 && $percentage <= 100) {
            $this->discount = $percentage;
            $this->isOnSale = true;
            $this->saleEndDate = date('Y-m-d', strtotime('+7 days'));
            return "تم تطبيق خصم " . $percentage . "% - ينتهي في: " . $this->saleEndDate;
        }
        return "نسبة الخصم غير صحيحة";
    }
    
    public function getDiscountedPrice() {
        if ($this->isOnSale) {
            $discountAmount = $this->price * ($this->discount / 100);
            return $this->price - $discountAmount;
        }
        return $this->price;
    }
    
    public function getTotalValue() {
        return $this->getDiscountedPrice() * $this->quantity;
    }
    
    public function isInStock() {
        return $this->quantity > 0;
    }
    
    public function view() {
        $this->views++;
        return "تم عرض المنتج - عدد المشاهدات: " . $this->views;
    }
    
    public function getViews() {
        return $this->views;
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
            return "تم إضافة تقييم من " . $reviewer;
        }
        return "التقييم يجب أن يكون بين 1 و 5";
    }
    
    public function getReviews() {
        return $this->reviews;
    }
    
    public function getRating() {
        return $this->rating;
    }
    
    public function getInfo() {
        $info = "<strong>المنتج:</strong> " . $this->name . "<br>";
        $info .= "<strong>الفئة:</strong> " . $this->category . "<br>";
        $info .= "<strong>الوصف:</strong> " . $this->description . "<br>";
        $info .= "<strong>السعر الأصلي:</strong> " . $this->price . " ريال<br>";
        
        if ($this->isOnSale) {
            $info .= "<strong>السعر بعد الخصم:</strong> " . $this->getDiscountedPrice() . " ريال<br>";
            $info .= "<strong>نسبة الخصم:</strong> " . $this->discount . "%<br>";
            $info .= "<strong>ينتهي العرض في:</strong> " . $this->saleEndDate . "<br>";
        }
        
        $info .= "<strong>الكمية:</strong> " . $this->quantity . "<br>";
        $info .= "<strong>القيمة الإجمالية:</strong> " . $this->getTotalValue() . " ريال<br>";
        $info .= "<strong>متوفر:</strong> " . ($this->isInStock() ? "نعم" : "لا") . "<br>";
        $info .= "<strong>عدد المشاهدات:</strong> " . $this->views . "<br>";
        $info .= "<strong>التقييم:</strong> " . $this->rating . "/5";
        
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

$product = new Product();
echo $product->setName("لابتوب ديل إنسبرون") . "<br>";
echo $product->setPrice(5000) . "<br>";
echo $product->setQuantity(10) . "<br>";
echo $product->setCategory("إلكترونيات") . "<br>";
echo $product->setDescription("لابتوب عالي الأداء للعمل والألعاب") . "<br>";

echo "<h4>معلومات المنتج:</h4>\n";
echo $product->getInfo() . "<br><br>";

echo "<h4>تطبيق خصم:</h4>\n";
echo $product->applyDiscount(15) . "<br>";
echo $product->getInfo() . "<br><br>";

echo "<h4>عرض المنتج وإضافة تقييمات:</h4>\n";
echo $product->view() . "<br>";
echo $product->view() . "<br>";
echo $product->addReview("أحمد", 5, "منتج ممتاز") . "<br>";
echo $product->addReview("فاطمة", 4, "جيد جداً") . "<br>";
echo $product->addReview("محمد", 5, "رائع") . "<br>";

echo "<h4>معلومات المنتج النهائية:</h4>\n";
echo $product->getInfo() . "<br><br>";

// ==========================================
// مثال 3: كلاس الحساب البنكي مع الخصائص والطرق المعقدة
// ==========================================
echo "<h2>مثال 3: كلاس الحساب البنكي</h2>\n";

class BankAccount {
    // الخصائص العامة
    public $accountNumber;
    public $ownerName;
    public $balance;
    public $accountType;
    
    // الخصائص الخاصة
    private $transactions = [];
    private $dailyLimit = 5000;
    private $dailyWithdrawn = 0;
    private $lastResetDate;
    private $isBlocked = false;
    private $blockReason = "";
    
    // الطرق العامة
    public function setAccountNumber($accountNumber) {
        if (strlen($accountNumber) >= 8) {
            $this->accountNumber = $accountNumber;
            return "تم تحديث رقم الحساب إلى: " . $accountNumber;
        }
        return "رقم الحساب يجب أن يكون 8 أرقام على الأقل";
    }
    
    public function getAccountNumber() {
        return $this->accountNumber;
    }
    
    public function setOwnerName($ownerName) {
        if (!empty($ownerName)) {
            $this->ownerName = $ownerName;
            return "تم تحديث اسم المالك إلى: " . $ownerName;
        }
        return "اسم المالك لا يمكن أن يكون فارغاً";
    }
    
    public function getOwnerName() {
        return $this->ownerName;
    }
    
    public function setBalance($balance) {
        if ($balance >= 0) {
            $this->balance = $balance;
            return "تم تحديث الرصيد إلى: " . $balance . " ريال";
        }
        return "الرصيد يجب أن يكون أكبر من أو يساوي صفر";
    }
    
    public function getBalance() {
        return $this->balance;
    }
    
    public function setAccountType($accountType) {
        $this->accountType = $accountType;
        return "تم تحديث نوع الحساب إلى: " . $accountType;
    }
    
    public function getAccountType() {
        return $this->accountType;
    }
    
    public function deposit($amount) {
        if ($this->isBlocked) {
            return "الحساب محظور: " . $this->blockReason;
        }
        
        if ($amount > 0) {
            $this->balance += $amount;
            $this->addTransaction("إيداع", $amount);
            return "تم إيداع " . $amount . " ريال - الرصيد الحالي: " . $this->balance . " ريال";
        }
        return "المبلغ يجب أن يكون أكبر من صفر";
    }
    
    public function withdraw($amount) {
        if ($this->isBlocked) {
            return "الحساب محظور: " . $this->blockReason;
        }
        
        if ($amount > 0) {
            $this->resetDailyLimit();
            
            if ($amount <= $this->balance) {
                if ($this->dailyWithdrawn + $amount <= $this->dailyLimit) {
                    $this->balance -= $amount;
                    $this->dailyWithdrawn += $amount;
                    $this->addTransaction("سحب", $amount);
                    return "تم سحب " . $amount . " ريال - الرصيد المتبقي: " . $this->balance . " ريال";
                }
                return "تجاوز الحد اليومي للسحب - المتبقي: " . ($this->dailyLimit - $this->dailyWithdrawn) . " ريال";
            }
            return "الرصيد غير كافي";
        }
        return "المبلغ يجب أن يكون أكبر من صفر";
    }
    
    public function transfer($amount, $targetAccount) {
        if ($this->isBlocked) {
            return "الحساب محظور: " . $this->blockReason;
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
    
    public function blockAccount($reason) {
        $this->isBlocked = true;
        $this->blockReason = $reason;
        return "تم حظر الحساب - السبب: " . $reason;
    }
    
    public function unblockAccount() {
        $this->isBlocked = false;
        $this->blockReason = "";
        return "تم إلغاء حظر الحساب";
    }
    
    public function isAccountBlocked() {
        return $this->isBlocked;
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
        $info .= "<strong>الرصيد:</strong> " . $this->balance . " ريال<br>";
        $info .= "<strong>الحد اليومي للسحب:</strong> " . $this->dailyLimit . " ريال<br>";
        $info .= "<strong>المسحوب اليوم:</strong> " . $this->dailyWithdrawn . " ريال<br>";
        $info .= "<strong>حالة الحساب:</strong> " . ($this->isBlocked ? "محظور - " . $this->blockReason : "نشط");
        return $info;
    }
    
    // الطرق الخاصة
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

$account = new BankAccount();
echo $account->setAccountNumber("123456789") . "<br>";
echo $account->setOwnerName("أحمد السعد") . "<br>";
echo $account->setBalance(1000) . "<br>";
echo $account->setAccountType("جاري") . "<br>";

echo "<h4>معلومات الحساب:</h4>\n";
echo $account->getInfo() . "<br><br>";

echo "<h4>عمليات الحساب:</h4>\n";
echo $account->deposit(500) . "<br>";
echo $account->withdraw(200) . "<br>";
echo $account->deposit(1000) . "<br>";
echo $account->withdraw(300) . "<br>";

echo "<h4>معلومات الحساب بعد العمليات:</h4>\n";
echo $account->getInfo() . "<br><br>";

echo "<h4>تاريخ المعاملات:</h4>\n";
echo $account->getTransactionHistory() . "<br><br>";

echo "<h4>حظر الحساب:</h4>\n";
echo $account->blockAccount("شك في نشاط مشبوه") . "<br>";
echo $account->deposit(100) . "<br>"; // لن يعمل
echo $account->unblockAccount() . "<br>";
echo $account->deposit(100) . "<br>"; // سيعمل الآن

// ==========================================
// خلاصة المحاضرة
// ==========================================
echo "<hr>";
echo "<h2>🎯 خلاصة المحاضرة</h2>";
echo "<div style='background-color: #f0f8ff; padding: 20px; border-radius: 10px;'>";
echo "<h3>ما تعلمناه:</h3>";
echo "<ul>";
echo "<li><strong>الخصائص (Properties):</strong> المتغيرات التي تنتمي للكلاس</li>";
echo "<li><strong>الطرق (Methods):</strong> الدوال التي تنتمي للكلاس</li>";
echo "<li><strong>مستويات الوصول:</strong> Public, Private, Protected</li>";
echo "<li><strong>Getters و Setters:</strong> للتحكم في الوصول للبيانات</li>";
echo "<li><strong>الطرق الخاصة:</strong> للعمليات الداخلية</li>";
echo "<li><strong>التحقق من البيانات:</strong> قبل تعيين القيم</li>";
echo "</ul>";

echo "<h3>أفضل الممارسات:</h3>";
echo "<ul>";
echo "<li>استخدم Private للبيانات الحساسة</li>";
echo "<li>استخدم Public للواجهة العامة</li>";
echo "<li>استخدم Getters و Setters للتحكم</li>";
echo "<li>تحقق من صحة البيانات قبل التعيين</li>";
echo "<li>استخدم أسماء وصفية للخصائص والطرق</li>";
echo "<li>نظم الكود: الخصائص أولاً، ثم الطرق</li>";
echo "</ul>";
echo "</div>";
?>


