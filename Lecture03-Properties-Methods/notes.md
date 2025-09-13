# المحاضرة الثالثة: الخصائص والطرق (Properties and Methods)

## 📚 جدول المحتويات
1. [ما هي الخصائص؟](#ما-هي-الخصائص)
2. [أنواع الخصائص](#أنواع-الخصائص)
3. [ما هي الطرق؟](#ما-هي-الطرق)
4. [أنواع الطرق](#أنواع-الطرق)
5. [مستويات الوصول](#مستويات-الوصول)
6. [أمثلة عملية](#أمثلة-عملية)
7. [أفضل الممارسات](#أفضل-الممارسات)

---

## ما هي الخصائص؟

**الخصائص (Properties)** هي المتغيرات التي تنتمي إلى الكلاس. يمكن تشبيهها بـ:
- 📦 **الصناديق**: تخزن البيانات
- 🏷️ **الملصقات**: تحمل أسماء البيانات
- 📊 **المتغيرات**: تحتوي على القيم

### 🎯 خصائص الخصائص:
- **تنتمي للكلاس**: كل كائن له نسخة من الخصائص
- **تحتوي على بيانات**: تخزن المعلومات
- **قابلة للتعديل**: يمكن تغيير قيمها
- **لها أنواع**: string, int, array, etc.

---

## أنواع الخصائص

### 1. **الخصائص العادية (Regular Properties)**
```php
<?php
class User {
    public $name;        // نص
    public $age;         // رقم
    public $email;       // نص
    public $isActive;    // منطقي
}
```

### 2. **الخصائص مع القيم الافتراضية**
```php
<?php
class User {
    public $name = "غير محدد";
    public $age = 0;
    public $email = "";
    public $isActive = true;
    public $permissions = [];
}
```

### 3. **الخصائص الثابتة (Static Properties)**
```php
<?php
class User {
    public static $totalUsers = 0;  // مشترك بين جميع الكائنات
    public $name;
    public $age;
}
```

---

## ما هي الطرق؟

**الطرق (Methods)** هي الدوال التي تنتمي إلى الكلاس. يمكن تشبيهها بـ:
- ⚙️ **الأدوات**: تنفذ العمليات
- 🎯 **الوظائف**: تؤدي مهام محددة
- 🔧 **الآلات**: تعالج البيانات

### 🎯 خصائص الطرق:
- **تنتمي للكلاس**: كل كائن يمكنه استخدامها
- **تنفذ العمليات**: تؤدي مهام محددة
- **تستطيع الوصول للخصائص**: باستخدام `$this`
- **قابلة للاستدعاء**: يمكن استدعاؤها من الكائنات

---

## أنواع الطرق

### 1. **الطرق العادية (Regular Methods)**
```php
<?php
class User {
    public $name;
    public $age;
    
    public function getName() {
        return $this->name;
    }
    
    public function setAge($age) {
        $this->age = $age;
    }
}
```

### 2. **الطرق مع المعاملات**
```php
<?php
class User {
    public function greet($message = "مرحباً") {
        return $message . " " . $this->name;
    }
    
    public function calculateAge($birthYear) {
        return date('Y') - $birthYear;
    }
}
```

### 3. **الطرق الثابتة (Static Methods)**
```php
<?php
class User {
    public static function getTotalUsers() {
        return self::$totalUsers;
    }
    
    public static function createUser($name) {
        return new User($name);
    }
}
```

---

## مستويات الوصول

### 🔓 **Public (عام)**
- **الوصول**: من أي مكان
- **الاستخدام**: للخصائص والطرق العامة
- **المثال**: `public $name;`

### 🔒 **Private (خاص)**
- **الوصول**: من داخل الكلاس فقط
- **الاستخدام**: للبيانات الحساسة
- **المثال**: `private $password;`

### 🔐 **Protected (محمي)**
- **الوصول**: من داخل الكلاس والكلاسات الموروثة
- **الاستخدام**: للبيانات المشتركة
- **المثال**: `protected $id;`

---

## أمثلة عملية

### مثال 1: كلاس المستخدم مع الخصائص والطرق
```php
<?php
class User {
    // الخصائص العامة
    public $name;
    public $email;
    public $age;
    public $isActive = true;
    
    // الخصائص الخاصة
    private $password;
    private $loginAttempts = 0;
    
    // الطرق العامة
    public function setName($name) {
        $this->name = $name;
        return "تم تحديث الاسم إلى: " . $name;
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
        return "العمر غير صحيح";
    }
    
    public function getAge() {
        return $this->age;
    }
    
    public function setPassword($password) {
        if (strlen($password) >= 6) {
            $this->password = password_hash($password, PASSWORD_DEFAULT);
            return "تم تحديث كلمة المرور";
        }
        return "كلمة المرور يجب أن تكون 6 أحرف على الأقل";
    }
    
    public function login($email, $password) {
        if ($this->email === $email && password_verify($password, $this->password)) {
            $this->loginAttempts = 0;
            return "تم تسجيل الدخول بنجاح";
        }
        $this->loginAttempts++;
        return "فشل تسجيل الدخول - المحاولة رقم: " . $this->loginAttempts;
    }
    
    public function getInfo() {
        $info = "الاسم: " . $this->name . "\n";
        $info .= "الإيميل: " . $this->email . "\n";
        $info .= "العمر: " . $this->age . "\n";
        $info .= "الحالة: " . ($this->isActive ? "نشط" : "غير نشط");
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
$user = new User();
echo $user->setName("أحمد محمد") . "\n";
echo $user->setEmail("ahmed@example.com") . "\n";
echo $user->setAge(25) . "\n";
echo $user->setPassword("123456") . "\n";
echo $user->getInfo() . "\n";
echo $user->login("ahmed@example.com", "123456") . "\n";
```

### مثال 2: كلاس المنتج مع الخصائص والطرق المتقدمة
```php
<?php
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
    
    // الطرق العامة
    public function setName($name) {
        $this->name = $name;
        return "تم تحديث اسم المنتج إلى: " . $name;
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
    
    public function getInfo() {
        $info = "المنتج: " . $this->name . "\n";
        $info .= "الفئة: " . $this->category . "\n";
        $info .= "الوصف: " . $this->description . "\n";
        $info .= "السعر الأصلي: " . $this->price . " ريال\n";
        
        if ($this->isOnSale) {
            $info .= "السعر بعد الخصم: " . $this->getDiscountedPrice() . " ريال\n";
            $info .= "نسبة الخصم: " . $this->discount . "%\n";
            $info .= "ينتهي العرض في: " . $this->saleEndDate . "\n";
        }
        
        $info .= "الكمية: " . $this->quantity . "\n";
        $info .= "القيمة الإجمالية: " . $this->getTotalValue() . " ريال\n";
        $info .= "متوفر: " . ($this->isInStock() ? "نعم" : "لا");
        
        return $info;
    }
    
    // الطرق الخاصة
    private function calculateDiscountAmount() {
        return $this->price * ($this->discount / 100);
    }
    
    private function isSaleExpired() {
        if ($this->saleEndDate) {
            return date('Y-m-d') > $this->saleEndDate;
        }
        return false;
    }
}

// استخدام الكلاس
$product = new Product();
echo $product->setName("لابتوب ديل") . "\n";
echo $product->setPrice(5000) . "\n";
echo $product->setQuantity(10) . "\n";
echo $product->setCategory("إلكترونيات") . "\n";
echo $product->setDescription("لابتوب عالي الأداء للعمل والألعاب") . "\n";
echo $product->applyDiscount(15) . "\n";
echo $product->getInfo() . "\n";
```

### مثال 3: كلاس الحساب البنكي مع الخصائص والطرق المعقدة
```php
<?php
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
    
    // الطرق العامة
    public function setAccountNumber($accountNumber) {
        $this->accountNumber = $accountNumber;
        return "تم تحديث رقم الحساب إلى: " . $accountNumber;
    }
    
    public function getAccountNumber() {
        return $this->accountNumber;
    }
    
    public function setOwnerName($ownerName) {
        $this->ownerName = $ownerName;
        return "تم تحديث اسم المالك إلى: " . $ownerName;
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
        if ($amount > 0) {
            $this->balance += $amount;
            $this->addTransaction("إيداع", $amount);
            return "تم إيداع " . $amount . " ريال - الرصيد الحالي: " . $this->balance . " ريال";
        }
        return "المبلغ يجب أن يكون أكبر من صفر";
    }
    
    public function withdraw($amount) {
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
        if ($amount > 0 && $amount <= $this->balance) {
            $this->balance -= $amount;
            $targetAccount->balance += $amount;
            $this->addTransaction("تحويل إلى " . $targetAccount->accountNumber, $amount);
            $targetAccount->addTransaction("تحويل من " . $this->accountNumber, $amount);
            return "تم تحويل " . $amount . " ريال إلى حساب " . $targetAccount->accountNumber;
        }
        return "المبلغ غير صحيح أو الرصيد غير كافي";
    }
    
    public function getTransactionHistory() {
        $history = "تاريخ المعاملات لحساب " . $this->accountNumber . ":\n";
        if (empty($this->transactions)) {
            $history .= "لا توجد معاملات";
        } else {
            foreach ($this->transactions as $transaction) {
                $history .= $transaction['date'] . " - " . $transaction['type'] . " " . $transaction['amount'] . " ريال - الرصيد: " . $transaction['balance'] . "\n";
            }
        }
        return $history;
    }
    
    public function getInfo() {
        $info = "رقم الحساب: " . $this->accountNumber . "\n";
        $info .= "اسم المالك: " . $this->ownerName . "\n";
        $info .= "نوع الحساب: " . $this->accountType . "\n";
        $info .= "الرصيد: " . $this->balance . " ريال\n";
        $info .= "الحد اليومي للسحب: " . $this->dailyLimit . " ريال\n";
        $info .= "المسحوب اليوم: " . $this->dailyWithdrawn . " ريال";
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
$account = new BankAccount();
echo $account->setAccountNumber("123456789") . "\n";
echo $account->setOwnerName("أحمد السعد") . "\n";
echo $account->setBalance(1000) . "\n";
echo $account->setAccountType("جاري") . "\n";
echo $account->deposit(500) . "\n";
echo $account->withdraw(200) . "\n";
echo $account->getInfo() . "\n";
echo $account->getTransactionHistory() . "\n";
```

---

## أفضل الممارسات

### ✅ **1. تسمية الخصائص والطرق**
```php
<?php
class User {
    // ✅ صحيح - أسماء وصفية
    public $firstName;
    public $lastName;
    public $emailAddress;
    
    public function getFullName() {
        return $this->firstName . " " . $this->lastName;
    }
    
    public function setEmailAddress($email) {
        $this->emailAddress = $email;
    }
}
```

### ✅ **2. استخدام Getters و Setters**
```php
<?php
class Product {
    private $price;
    
    // Getter
    public function getPrice() {
        return $this->price;
    }
    
    // Setter مع التحقق
    public function setPrice($price) {
        if ($price > 0) {
            $this->price = $price;
            return true;
        }
        return false;
    }
}
```

### ✅ **3. تنظيم الكود**
```php
<?php
class User {
    // الخصائص العامة أولاً
    public $name;
    public $email;
    
    // الخصائص الخاصة ثانياً
    private $password;
    private $loginAttempts;
    
    // الطرق العامة ثالثاً
    public function getName() {
        return $this->name;
    }
    
    public function setEmail($email) {
        $this->email = $email;
    }
    
    // الطرق الخاصة أخيراً
    private function validateEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
}
```

### ✅ **4. التعليقات الواضحة**
```php
<?php
class User {
    /** @var string اسم المستخدم */
    public $name;
    
    /** @var string إيميل المستخدم */
    public $email;
    
    /** @var int عدد محاولات تسجيل الدخول */
    private $loginAttempts = 0;
    
    /**
     * الحصول على اسم المستخدم
     * @return string
     */
    public function getName() {
        return $this->name;
    }
    
    /**
     * تحديث اسم المستخدم
     * @param string $name اسم المستخدم الجديد
     * @return bool true إذا تم التحديث بنجاح
     */
    public function setName($name) {
        if (!empty($name)) {
            $this->name = $name;
            return true;
        }
        return false;
    }
}
```

---

## 🎯 خلاصة المحاضرة

1. **الخصائص** هي المتغيرات التي تنتمي للكلاس
2. **الطرق** هي الدوال التي تنتمي للكلاس
3. **مستويات الوصول** تحدد من يمكنه الوصول للخصائص والطرق
4. **استخدم Getters و Setters** للتحكم في الوصول للبيانات
5. **اتبع أفضل الممارسات** في التسمية والتنظيم

---

## 📝 التمرين العملي

أنشئ كلاس `Employee` يحتوي على:
- خصائص: `name`, `position`, `salary`, `department`
- طرق: `getName()`, `setSalary()`, `getAnnualSalary()`, `promote()`
- استخدم مستويات الوصول المناسبة

---

## 📚 المراجع والموارد
- [PHP Properties](https://www.php.net/manual/en/language.oop5.properties.php)
- [PHP Methods](https://www.php.net/manual/en/language.oop5.methods.php)
- [PHP Visibility](https://www.php.net/manual/en/language.oop5.visibility.php)


