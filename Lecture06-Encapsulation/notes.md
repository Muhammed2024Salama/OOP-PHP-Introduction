# المحاضرة السادسة: التغليف (Encapsulation)

## 📚 جدول المحتويات
1. [ما هو التغليف؟](#ما-هو-التغليف)
2. [مستويات الوصول](#مستويات-الوصول)
3. [Getters و Setters](#getters-و-setters)
4. [التحقق من البيانات](#التحقق-من-البيانات)
5. [أمثلة عملية](#أمثلة-عملية)
6. [أفضل الممارسات](#أفضل-الممارسات)

---

## ما هو التغليف؟

**التغليف (Encapsulation)** هو مبدأ في البرمجة الكائنية يهدف إلى إخفاء التفاصيل الداخلية للكلاس والتحكم في الوصول للبيانات. يمكن تشبيهه بـ:
- 🏠 **المنزل**: الجدران تحمي ما بداخله
- 📦 **الصندوق**: لا نرى ما بداخله إلا من خلال الفتحات
- 🏦 **البنك**: الخزنة محمية ولا يمكن الوصول إليها مباشرة

### 🎯 أهداف التغليف:
- **حماية البيانات**: منع الوصول غير المصرح به
- **إخفاء التعقيد**: إخفاء التفاصيل الداخلية
- **التحكم في الوصول**: تحديد من يمكنه الوصول للبيانات
- **سهولة الصيانة**: تغيير التنفيذ دون التأثير على المستخدمين

---

## مستويات الوصول

### 🔓 **Public (عام)**
- **الوصول**: من أي مكان
- **الاستخدام**: للواجهة العامة
- **المثال**: `public $name;`

```php
<?php
class User {
    public $name; // يمكن الوصول من أي مكان
    
    public function getName() {
        return $this->name; // يمكن استدعاؤها من أي مكان
    }
}

$user = new User();
$user->name = "أحمد"; // ✅ مسموح
echo $user->getName(); // ✅ مسموح
```

### 🔐 **Protected (محمي)**
- **الوصول**: من داخل الكلاس والكلاسات الموروثة
- **الاستخدام**: للبيانات المشتركة
- **المثال**: `protected $id;`

```php
<?php
class Animal {
    protected $name; // يمكن الوصول من الكلاس والكلاسات الموروثة
    
    protected function makeSound() {
        return "صوت عام";
    }
}

class Dog extends Animal {
    public function getName() {
        return $this->name; // ✅ مسموح - كلاس موروث
    }
    
    public function getSound() {
        return $this->makeSound(); // ✅ مسموح - كلاس موروث
    }
}

$dog = new Dog();
echo $dog->getName(); // ✅ مسموح
// echo $dog->name; // ❌ خطأ - لا يمكن الوصول مباشرة
```

### 🔒 **Private (خاص)**
- **الوصول**: من داخل الكلاس فقط
- **الاستخدام**: للبيانات الحساسة
- **المثال**: `private $password;`

```php
<?php
class User {
    private $password; // يمكن الوصول من داخل الكلاس فقط
    
    private function hashPassword($password) {
        return password_hash($password, PASSWORD_DEFAULT);
    }
    
    public function setPassword($password) {
        $this->password = $this->hashPassword($password); // ✅ مسموح - داخل الكلاس
    }
    
    public function verifyPassword($password) {
        return password_verify($password, $this->password); // ✅ مسموح - داخل الكلاس
    }
}

$user = new User();
$user->setPassword("123456"); // ✅ مسموح
// echo $user->password; // ❌ خطأ - لا يمكن الوصول مباشرة
```

---

## Getters و Setters

**Getters و Setters** هي طرق للتحكم في الوصول للخصائص الخاصة والمحمية.

### 📝 **Getter (الحصول على القيمة)**
```php
<?php
class User {
    private $name;
    private $age;
    
    public function getName() {
        return $this->name;
    }
    
    public function getAge() {
        return $this->age;
    }
}
```

### 📝 **Setter (تعيين القيمة)**
```php
<?php
class User {
    private $name;
    private $age;
    
    public function setName($name) {
        if (!empty($name)) {
            $this->name = $name;
            return true;
        }
        return false;
    }
    
    public function setAge($age) {
        if ($age > 0 && $age < 150) {
            $this->age = $age;
            return true;
        }
        return false;
    }
}
```

### 📝 **Getter و Setter مع التحقق**
```php
<?php
class User {
    private $email;
    private $password;
    
    public function getEmail() {
        return $this->email;
    }
    
    public function setEmail($email) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->email = $email;
            return true;
        }
        return false;
    }
    
    public function setPassword($password) {
        if (strlen($password) >= 6) {
            $this->password = password_hash($password, PASSWORD_DEFAULT);
            return true;
        }
        return false;
    }
    
    public function verifyPassword($password) {
        return password_verify($password, $this->password);
    }
}
```

---

## التحقق من البيانات

### ✅ **التحقق من صحة البيانات**
```php
<?php
class Product {
    private $name;
    private $price;
    private $quantity;
    
    public function setName($name) {
        if (!empty($name) && strlen($name) >= 2) {
            $this->name = $name;
            return true;
        }
        return false;
    }
    
    public function setPrice($price) {
        if ($price > 0 && is_numeric($price)) {
            $this->price = $price;
            return true;
        }
        return false;
    }
    
    public function setQuantity($quantity) {
        if ($quantity >= 0 && is_int($quantity)) {
            $this->quantity = $quantity;
            return true;
        }
        return false;
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
}
```

### ✅ **التحقق من الأمان**
```php
<?php
class BankAccount {
    private $accountNumber;
    private $balance;
    private $pin;
    
    public function setAccountNumber($accountNumber) {
        if (strlen($accountNumber) >= 8 && is_numeric($accountNumber)) {
            $this->accountNumber = $accountNumber;
            return true;
        }
        return false;
    }
    
    public function setPin($pin) {
        if (strlen($pin) == 4 && is_numeric($pin)) {
            $this->pin = $pin;
            return true;
        }
        return false;
    }
    
    public function withdraw($amount, $pin) {
        if ($pin !== $this->pin) {
            return "PIN غير صحيح";
        }
        
        if ($amount > 0 && $amount <= $this->balance) {
            $this->balance -= $amount;
            return "تم سحب " . $amount . " ريال";
        }
        return "المبلغ غير صحيح أو الرصيد غير كافي";
    }
    
    public function getBalance($pin) {
        if ($pin !== $this->pin) {
            return "PIN غير صحيح";
        }
        return $this->balance;
    }
}
```

---

## أمثلة عملية

### مثال 1: كلاس المستخدم مع التغليف
```php
<?php
class User {
    private $name;
    private $email;
    private $age;
    private $password;
    private $isActive;
    private $loginAttempts;
    private $lastLogin;
    
    public function __construct($name, $email, $age) {
        $this->name = $name;
        $this->email = $email;
        $this->age = $age;
        $this->isActive = true;
        $this->loginAttempts = 0;
        $this->lastLogin = null;
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
    
    // Setters مع التحقق
    public function setName($name) {
        if (!empty($name) && strlen($name) >= 2) {
            $this->name = $name;
            return true;
        }
        return false;
    }
    
    public function setEmail($email) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->email = $email;
            return true;
        }
        return false;
    }
    
    public function setAge($age) {
        if ($age > 0 && $age < 150) {
            $this->age = $age;
            return true;
        }
        return false;
    }
    
    public function setPassword($password) {
        if (strlen($password) >= 6) {
            $this->password = password_hash($password, PASSWORD_DEFAULT);
            return true;
        }
        return false;
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
            return "تم تجاوز عدد المحاولات المسموح";
        }
        
        if ($this->email === $email && password_verify($password, $this->password)) {
            $this->loginAttempts = 0;
            $this->lastLogin = date('Y-m-d H:i:s');
            return "تم تسجيل الدخول بنجاح";
        }
        
        $this->loginAttempts++;
        return "فشل تسجيل الدخول - المحاولة رقم: " . $this->loginAttempts;
    }
    
    public function getInfo() {
        $info = "الاسم: " . $this->name . "\n";
        $info .= "الإيميل: " . $this->email . "\n";
        $info .= "العمر: " . $this->age . "\n";
        $info .= "الحالة: " . ($this->isActive ? "نشط" : "غير نشط") . "\n";
        $info .= "آخر دخول: " . ($this->lastLogin ? $this->lastLogin : "لم يسجل دخول") . "\n";
        $info .= "محاولات الدخول: " . $this->loginAttempts;
        return $info;
    }
}

// استخدام الكلاس
$user = new User("أحمد محمد", "ahmed@example.com", 25);

echo $user->setPassword("123456") ? "تم تعيين كلمة المرور" : "كلمة المرور غير صحيحة";
echo "\n";

echo $user->login("ahmed@example.com", "123456") . "\n";
echo $user->getInfo() . "\n";
```

### مثال 2: كلاس المنتج مع التغليف
```php
<?php
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
    
    public function __construct($name, $price, $category) {
        $this->id = uniqid('PROD_');
        $this->name = $name;
        $this->price = $price;
        $this->category = $category;
        $this->quantity = 0;
        $this->description = "";
        $this->isActive = true;
        $this->createdAt = date('Y-m-d H:i:s');
        $this->updatedAt = date('Y-m-d H:i:s');
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
    
    // Setters مع التحقق
    public function setName($name) {
        if (!empty($name) && strlen($name) >= 2) {
            $this->name = $name;
            $this->updatedAt = date('Y-m-d H:i:s');
            return true;
        }
        return false;
    }
    
    public function setPrice($price) {
        if ($price > 0 && is_numeric($price)) {
            $this->price = $price;
            $this->updatedAt = date('Y-m-d H:i:s');
            return true;
        }
        return false;
    }
    
    public function setQuantity($quantity) {
        if ($quantity >= 0 && is_int($quantity)) {
            $this->quantity = $quantity;
            $this->updatedAt = date('Y-m-d H:i:s');
            return true;
        }
        return false;
    }
    
    public function setCategory($category) {
        if (!empty($category)) {
            $this->category = $category;
            $this->updatedAt = date('Y-m-d H:i:s');
            return true;
        }
        return false;
    }
    
    public function setDescription($description) {
        $this->description = $description;
        $this->updatedAt = date('Y-m-d H:i:s');
        return true;
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
    
    public function isInStock() {
        return $this->quantity > 0;
    }
    
    public function getTotalValue() {
        return $this->price * $this->quantity;
    }
    
    public function getInfo() {
        $info = "معرف المنتج: " . $this->id . "\n";
        $info .= "الاسم: " . $this->name . "\n";
        $info .= "السعر: " . $this->price . " ريال\n";
        $info .= "الكمية: " . $this->quantity . "\n";
        $info .= "الفئة: " . $this->category . "\n";
        $info .= "الوصف: " . $this->description . "\n";
        $info .= "الحالة: " . ($this->isActive ? "نشط" : "غير نشط") . "\n";
        $info .= "متوفر: " . ($this->isInStock() ? "نعم" : "لا") . "\n";
        $info .= "القيمة الإجمالية: " . $this->getTotalValue() . " ريال\n";
        $info .= "تاريخ الإنشاء: " . $this->createdAt . "\n";
        $info .= "آخر تحديث: " . $this->updatedAt;
        return $info;
    }
}

// استخدام الكلاس
$product = new Product("لابتوب ديل", 5000, "إلكترونيات");

echo $product->setDescription("لابتوب عالي الأداء للعمل والألعاب") ? "تم تحديث الوصف" : "فشل تحديث الوصف";
echo "\n";

echo $product->setQuantity(10) ? "تم تحديث الكمية" : "الكمية غير صحيحة";
echo "\n";

echo $product->setPrice(4500) ? "تم تحديث السعر" : "السعر غير صحيح";
echo "\n";

echo $product->getInfo() . "\n";
```

### مثال 3: كلاس الحساب البنكي مع التغليف
```php
<?php
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
    
    public function __construct($accountNumber, $ownerName, $pin, $initialBalance = 0) {
        $this->accountNumber = $accountNumber;
        $this->ownerName = $ownerName;
        $this->pin = $pin;
        $this->balance = $initialBalance;
        $this->isActive = true;
        $this->transactions = [];
        $this->dailyLimit = 5000;
        $this->dailyWithdrawn = 0;
        $this->lastResetDate = date('Y-m-d');
        
        $this->addTransaction("إنشاء الحساب", $initialBalance);
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
    
    // Setters مع التحقق
    public function setOwnerName($newName, $pin) {
        if ($this->verifyPin($pin)) {
            if (!empty($newName)) {
                $this->ownerName = $newName;
                return "تم تحديث اسم المالك";
            }
            return "الاسم لا يمكن أن يكون فارغاً";
        }
        return "PIN غير صحيح";
    }
    
    public function setDailyLimit($newLimit, $pin) {
        if ($this->verifyPin($pin)) {
            if ($newLimit > 0) {
                $this->dailyLimit = $newLimit;
                return "تم تحديث الحد اليومي";
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
            $history = "تاريخ المعاملات:\n";
            foreach ($this->transactions as $transaction) {
                $history .= $transaction['date'] . " - " . $transaction['type'] . " " . $transaction['amount'] . " ريال - الرصيد: " . $transaction['balance'] . "\n";
            }
            return $history;
        }
        return "PIN غير صحيح";
    }
    
    public function getInfo($pin) {
        if ($this->verifyPin($pin)) {
            $info = "رقم الحساب: " . $this->accountNumber . "\n";
            $info .= "اسم المالك: " . $this->ownerName . "\n";
            $info .= "الرصيد: " . $this->balance . " ريال\n";
            $info .= "الحالة: " . ($this->isActive ? "نشط" : "محظور") . "\n";
            $info .= "الحد اليومي: " . $this->dailyLimit . " ريال\n";
            $info .= "المسحوب اليوم: " . $this->dailyWithdrawn . " ريال";
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
$account = new BankAccount("123456789", "أحمد السعد", "1234", 1000);

echo $account->deposit(500) . "\n";
echo $account->withdraw(200, "1234") . "\n";
echo $account->getBalance("1234") . "\n";
echo $account->getInfo("1234") . "\n";
echo $account->getTransactionHistory("1234") . "\n";
```

---

## أفضل الممارسات

### ✅ **1. استخدام Private للبيانات الحساسة**
```php
<?php
class User {
    private $password; // بيانات حساسة
    private $creditCard; // بيانات حساسة
    
    public function setPassword($password) {
        // التحقق من صحة كلمة المرور
        if (strlen($password) >= 6) {
            $this->password = password_hash($password, PASSWORD_DEFAULT);
            return true;
        }
        return false;
    }
}
```

### ✅ **2. استخدام Protected للبيانات المشتركة**
```php
<?php
class Animal {
    protected $name; // يمكن للكلاسات الموروثة الوصول إليها
    
    public function getName() {
        return $this->name;
    }
}

class Dog extends Animal {
    public function setName($name) {
        $this->name = $name; // يمكن الوصول للخاصية المحمية
    }
}
```

### ✅ **3. استخدام Public للواجهة العامة**
```php
<?php
class Product {
    private $price;
    
    public function getPrice() {
        return $this->price;
    }
    
    public function setPrice($price) {
        if ($price > 0) {
            $this->price = $price;
            return true;
        }
        return false;
    }
}
```

### ✅ **4. التحقق من صحة البيانات**
```php
<?php
class User {
    private $email;
    
    public function setEmail($email) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->email = $email;
            return true;
        }
        return false;
    }
}
```

### ✅ **5. استخدام Getters و Setters**
```php
<?php
class Product {
    private $name;
    private $price;
    
    public function getName() {
        return $this->name;
    }
    
    public function setName($name) {
        if (!empty($name)) {
            $this->name = $name;
            return true;
        }
        return false;
    }
    
    public function getPrice() {
        return $this->price;
    }
    
    public function setPrice($price) {
        if ($price > 0) {
            $this->price = $price;
            return true;
        }
        return false;
    }
}
```

---

## 🎯 خلاصة المحاضرة

1. **التغليف** يهدف إلى إخفاء التفاصيل الداخلية وحماية البيانات
2. **مستويات الوصول** تحدد من يمكنه الوصول للخصائص والطرق
3. **Getters و Setters** تسمح بالتحكم في الوصول للبيانات
4. **التحقق من البيانات** يضمن صحة البيانات المدخلة
5. **استخدم Private** للبيانات الحساسة
6. **استخدم Protected** للبيانات المشتركة
7. **استخدم Public** للواجهة العامة

---

## 📝 التمرين العملي

أنشئ كلاس `Student` مع التغليف:
- خصائص خاصة: `name`, `age`, `grades`, `gpa`
- Getters و Setters مع التحقق
- طرق: `addGrade()`, `calculateGPA()`, `getInfo()`

---

## 📚 المراجع والموارد
- [PHP Visibility](https://www.php.net/manual/en/language.oop5.visibility.php)
- [PHP Encapsulation](https://www.php.net/manual/en/language.oop5.visibility.php)
- [PHP Getters and Setters](https://www.php.net/manual/en/language.oop5.visibility.php)


