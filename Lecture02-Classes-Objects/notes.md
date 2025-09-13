# المحاضرة الثانية: الكلاسات والكائنات (Classes and Objects)

## 📚 جدول المحتويات
1. [ما هي الكلاسات؟](#ما-هي-الكلاسات)
2. [ما هي الكائنات؟](#ما-هي-الكائنات)
3. [إنشاء الكلاسات](#إنشاء-الكلاسات)
4. [إنشاء الكائنات](#إنشاء-الكائنات)
5. [الفرق بين الكلاس والكائن](#الفرق-بين-الكلاس-والكائن)
6. [أمثلة عملية](#أمثلة-عملية)
7. [أفضل الممارسات](#أفضل-الممارسات)

---

## ما هي الكلاسات؟

**الكلاس (Class)** هو قالب أو مخطط لإنشاء الكائنات. يمكن تشبيهه بـ:
- 📋 **القالب**: مثل قالب الكعك
- 🏗️ **المخطط**: مثل مخطط البناء
- 📝 **التعريف**: يحدد الخصائص والسلوكيات

### 🎯 خصائص الكلاس:
- **يحتوي على الخصائص (Properties)**: المتغيرات
- **يحتوي على الطرق (Methods)**: الدوال
- **قابل لإعادة الاستخدام**: يمكن إنشاء عدة كائنات منه
- **منظم**: يجمع البيانات والوظائف معاً

---

## ما هي الكائنات؟

**الكائن (Object)** هو نسخة حقيقية من الكلاس. يمكن تشبيهه بـ:
- 🍰 **الكعكة**: نسخة من قالب الكعك
- 🏠 **المنزل**: نسخة من مخطط البناء
- 📱 **الهاتف**: نسخة من تصميم الهاتف

### 🎯 خصائص الكائن:
- **له هوية فريدة**: كل كائن مختلف عن الآخر
- **له حالة**: قيم الخصائص الحالية
- **له سلوك**: يمكن تنفيذ الطرق عليه
- **مستقل**: تغيير كائن لا يؤثر على الآخر

---

## إنشاء الكلاسات

### 📝 بناء الكلاس الأساسي:
```php
<?php
class ClassName {
    // الخصائص (Properties)
    public $property1;
    public $property2;
    
    // الطرق (Methods)
    public function method1() {
        // كود الطريقة
    }
    
    public function method2() {
        // كود الطريقة
    }
}
```

### 🔍 شرح البنية:
- `class`: كلمة مفتاحية لإنشاء كلاس
- `ClassName`: اسم الكلاس (يبدأ بحرف كبير)
- `public`: مستوى الوصول (سنشرحه لاحقاً)
- `$property`: الخصائص (المتغيرات)
- `function`: الطرق (الدوال)

---

## إنشاء الكائنات

### 🏗️ إنشاء كائن جديد:
```php
<?php
// إنشاء كائن من الكلاس
$objectName = new ClassName();

// إنشاء عدة كائنات
$object1 = new ClassName();
$object2 = new ClassName();
$object3 = new ClassName();
```

### 🔍 شرح العملية:
- `new`: كلمة مفتاحية لإنشاء كائن جديد
- `ClassName()`: استدعاء الكلاس
- `$objectName`: متغير يحتوي على الكائن

---

## الفرق بين الكلاس والكائن

### 📊 مقارنة شاملة:

| الجانب | الكلاس (Class) | الكائن (Object) |
|--------|----------------|-----------------|
| **التعريف** | قالب أو مخطط | نسخة حقيقية |
| **العدد** | واحد لكل نوع | متعدد |
| **الذاكرة** | لا يستهلك ذاكرة | يستهلك ذاكرة |
| **البيانات** | لا يحتوي على بيانات حقيقية | يحتوي على بيانات حقيقية |
| **الاستخدام** | لإنشاء الكائنات | للعمل الفعلي |

### 🎯 مثال توضيحي:
```php
<?php
// الكلاس (القالب)
class Car {
    public $brand;
    public $model;
    public $color;
    
    public function start() {
        return "تم تشغيل السيارة";
    }
}

// الكائنات (النسخ الحقيقية)
$car1 = new Car(); // سيارة رقم 1
$car2 = new Car(); // سيارة رقم 2
$car3 = new Car(); // سيارة رقم 3

// كل كائن له بيانات مختلفة
$car1->brand = "تويوتا";
$car1->model = "كامري";
$car1->color = "أبيض";

$car2->brand = "هونداي";
$car2->model = "إلنترا";
$car2->color = "أسود";
```

---

## أمثلة عملية

### مثال 1: كلاس الطالب
```php
<?php
class Student {
    // الخصائص
    public $name;
    public $age;
    public $grade;
    public $subjects = [];
    
    // الطرق
    public function addSubject($subject) {
        $this->subjects[] = $subject;
        return "تم إضافة مادة: " . $subject;
    }
    
    public function getInfo() {
        return "الطالب: " . $this->name . " - الصف: " . $this->grade;
    }
    
    public function study($subject) {
        return $this->name . " يدرس " . $subject;
    }
}

// إنشاء كائنات طلاب
$student1 = new Student();
$student1->name = "أحمد محمد";
$student1->age = 16;
$student1->grade = "الأول الثانوي";

$student2 = new Student();
$student2->name = "فاطمة علي";
$student2->age = 17;
$student2->grade = "الثاني الثانوي";

// استخدام الكائنات
echo $student1->getInfo() . "\n";
echo $student1->addSubject("الرياضيات") . "\n";
echo $student1->study("الفيزياء") . "\n";

echo $student2->getInfo() . "\n";
echo $student2->addSubject("الكيمياء") . "\n";
```

### مثال 2: كلاس المنتج
```php
<?php
class Product {
    // الخصائص
    public $name;
    public $price;
    public $quantity;
    public $category;
    
    // الطرق
    public function getTotalValue() {
        return $this->price * $this->quantity;
    }
    
    public function updatePrice($newPrice) {
        $this->price = $newPrice;
        return "تم تحديث السعر إلى: " . $newPrice;
    }
    
    public function getInfo() {
        $info = "المنتج: " . $this->name . "\n";
        $info .= "الفئة: " . $this->category . "\n";
        $info .= "السعر: " . $this->price . " ريال\n";
        $info .= "الكمية: " . $this->quantity . "\n";
        $info .= "القيمة الإجمالية: " . $this->getTotalValue() . " ريال";
        return $info;
    }
}

// إنشاء منتجات
$laptop = new Product();
$laptop->name = "لابتوب ديل";
$laptop->price = 5000;
$laptop->quantity = 10;
$laptop->category = "إلكترونيات";

$phone = new Product();
$phone->name = "آيفون";
$phone->price = 3000;
$phone->quantity = 25;
$phone->category = "إلكترونيات";

// استخدام المنتجات
echo $laptop->getInfo() . "\n\n";
echo $phone->getInfo() . "\n\n";

echo $laptop->updatePrice(4500) . "\n";
echo $laptop->getInfo() . "\n";
```

### مثال 3: كلاس الحساب البنكي
```php
<?php
class BankAccount {
    // الخصائص
    public $accountNumber;
    public $ownerName;
    public $balance;
    public $transactions = [];
    
    // الطرق
    public function deposit($amount) {
        $this->balance += $amount;
        $this->transactions[] = "إيداع: " . $amount;
        return "تم إيداع " . $amount . " ريال";
    }
    
    public function withdraw($amount) {
        if ($amount <= $this->balance) {
            $this->balance -= $amount;
            $this->transactions[] = "سحب: " . $amount;
            return "تم سحب " . $amount . " ريال";
        }
        return "الرصيد غير كافي";
    }
    
    public function getBalance() {
        return "الرصيد الحالي: " . $this->balance . " ريال";
    }
    
    public function getTransactionHistory() {
        return $this->transactions;
    }
}

// إنشاء حسابات
$account1 = new BankAccount();
$account1->accountNumber = "123456789";
$account1->ownerName = "أحمد السعد";
$account1->balance = 1000;

$account2 = new BankAccount();
$account2->accountNumber = "987654321";
$account2->ownerName = "فاطمة محمد";
$account2->balance = 2000;

// استخدام الحسابات
echo $account1->getBalance() . "\n";
echo $account1->deposit(500) . "\n";
echo $account1->withdraw(200) . "\n";
echo $account1->getBalance() . "\n";

echo $account2->getBalance() . "\n";
echo $account2->deposit(1000) . "\n";
echo $account2->getBalance() . "\n";
```

---

## أفضل الممارسات

### ✅ **1. تسمية الكلاسات**
```php
// ✅ صحيح - يبدأ بحرف كبير
class Student {}
class BankAccount {}
class ProductManager {}

// ❌ خطأ - يبدأ بحرف صغير
class student {}
class bankAccount {}
```

### ✅ **2. تسمية الكائنات**
```php
// ✅ صحيح - يبدأ بحرف صغير
$student1 = new Student();
$bankAccount = new BankAccount();
$productManager = new ProductManager();

// ❌ خطأ - يبدأ بحرف كبير
$Student1 = new Student();
$BankAccount = new BankAccount();
```

### ✅ **3. تنظيم الكود**
```php
<?php
// ✅ صحيح - كلاس منظم
class User {
    // الخصائص أولاً
    public $name;
    public $email;
    public $age;
    
    // الطرق ثانياً
    public function getName() {
        return $this->name;
    }
    
    public function getEmail() {
        return $this->email;
    }
}
```

### ✅ **4. تعليقات واضحة**
```php
<?php
/**
 * كلاس لإدارة المستخدمين
 * يحتوي على معلومات المستخدم الأساسية
 */
class User {
    /** @var string اسم المستخدم */
    public $name;
    
    /** @var string إيميل المستخدم */
    public $email;
    
    /** @var int عمر المستخدم */
    public $age;
    
    /**
     * الحصول على اسم المستخدم
     * @return string
     */
    public function getName() {
        return $this->name;
    }
}
```

---

## 🎯 خلاصة المحاضرة

1. **الكلاس** هو قالب لإنشاء الكائنات
2. **الكائن** هو نسخة حقيقية من الكلاس
3. **كل كائن** له هوية فريدة وحالة مستقلة
4. **استخدم `new`** لإنشاء كائنات جديدة
5. **اتبع أفضل الممارسات** في التسمية والتنظيم

---

## 📝 التمرين العملي

أنشئ كلاس `Book` يحتوي على:
- خصائص: `title`, `author`, `pages`, `price`
- طرق: `getInfo()`, `read()`, `calculateReadingTime()`

ثم أنشئ 3 كائنات من هذا الكلاس مع بيانات مختلفة.

---

## 📚 المراجع والموارد
- [PHP Classes and Objects](https://www.php.net/manual/en/language.oop5.basic.php)
- [PHP Object-Oriented Programming](https://www.w3schools.com/php/php_oop_classes_objects.asp)


