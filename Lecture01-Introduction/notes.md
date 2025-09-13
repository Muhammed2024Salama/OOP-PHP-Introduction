# المحاضرة الأولى: مقدمة في البرمجة الكائنية (OOP) في PHP

## 📚 جدول المحتويات
1. [ما هي البرمجة الكائنية؟](#ما-هي-البرمجة-الكائنية)
2. [مبادئ OOP الأساسية](#مبادئ-oop-الأساسية)
3. [الفرق بين البرمجة الإجرائية و OOP](#الفرق-بين-البرمجة-الإجرائية-و-oop)
4. [مميزات البرمجة الكائنية](#مميزات-البرمجة-الكائنية)
5. [متى نستخدم OOP؟](#متى-نستخدم-oop)
6. [أمثلة عملية](#أمثلة-عملية)

---

## ما هي البرمجة الكائنية؟

**البرمجة الكائنية (Object-Oriented Programming - OOP)** هي نمط برمجي يعتمد على مفهوم "الكائنات" (Objects) التي تحتوي على البيانات والوظائف معاً.

### 🎯 الهدف الأساسي:
- **تنظيم الكود**: جعل الكود أكثر تنظيماً ووضوحاً
- **إعادة الاستخدام**: استخدام نفس الكود في أماكن متعددة
- **سهولة التوسع**: إضافة ميزات جديدة بسهولة
- **سهولة الصيانة**: تعديل وإصلاح الكود بسهولة

---

## مبادئ OOP الأساسية

### 1. **الكلاسات (Classes)**
- قوالب لإنشاء الكائنات
- تحدد الخصائص والسلوكيات

### 2. **الكائنات (Objects)**
- نسخ من الكلاسات
- تحتوي على بيانات حقيقية

### 3. **الخصائص (Properties)**
- المتغيرات داخل الكلاس
- تخزن البيانات

### 4. **الطرق (Methods)**
- الدوال داخل الكلاس
- تنفذ العمليات

---

## الفرق بين البرمجة الإجرائية و OOP

### 🔴 البرمجة الإجرائية (Procedural)
```php
<?php
// بيانات منفصلة عن الوظائف
$name = "أحمد";
$age = 25;
$email = "ahmed@example.com";

// دوال منفصلة
function greet($name) {
    return "مرحباً " . $name;
}

function getAge($age) {
    return "العمر: " . $age;
}

// استخدام الدوال
echo greet($name);
echo getAge($age);
```

### 🟢 البرمجة الكائنية (OOP)
```php
<?php
// كل شيء مرتبط ببعضه
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
    
    public function getAge() {
        return "العمر: " . $this->age;
    }
}

// استخدام الكائن
$user = new User("أحمد", 25, "ahmed@example.com");
echo $user->greet();
echo $user->getAge();
```

---

## مميزات البرمجة الكائنية

### ✅ **1. إعادة الاستخدام (Reusability)**
- يمكن استخدام نفس الكلاس لإنشاء عدة كائنات
- توفير الوقت والجهد

### ✅ **2. التنظيم (Organization)**
- الكود منظم ومرتب
- سهولة الفهم والصيانة

### ✅ **3. التوسع (Scalability)**
- إضافة ميزات جديدة بسهولة
- تعديل الكود دون التأثير على باقي الأجزاء

### ✅ **4. الأمان (Security)**
- إخفاء البيانات الحساسة
- التحكم في الوصول للبيانات

### ✅ **5. سهولة الاختبار (Testing)**
- اختبار كل جزء منفصلاً
- اكتشاف الأخطاء بسرعة

---

## متى نستخدم OOP؟

### 🎯 **استخدم OOP عندما:**
- المشروع كبير ومعقد
- تحتاج لإعادة استخدام الكود
- تريد تنظيم الكود بشكل أفضل
- تعمل مع فريق من المطورين
- تحتاج لسهولة الصيانة

### ⚠️ **لا تستخدم OOP عندما:**
- المشروع بسيط جداً
- لا تحتاج لإعادة الاستخدام
- تريد سرعة في التطوير

---

## أمثلة عملية

### مثال 1: إدارة الطلاب
```php
<?php
class Student {
    public $name;
    public $grade;
    public $subjects = [];
    
    public function __construct($name, $grade) {
        $this->name = $name;
        $this->grade = $grade;
    }
    
    public function addSubject($subject) {
        $this->subjects[] = $subject;
    }
    
    public function getInfo() {
        return "الطالب: " . $this->name . " - الصف: " . $this->grade;
    }
}

// إنشاء طلاب
$student1 = new Student("سارة", "الثاني الثانوي");
$student1->addSubject("الرياضيات");
$student1->addSubject("الفيزياء");

$student2 = new Student("محمد", "الأول الثانوي");
$student2->addSubject("الكيمياء");

echo $student1->getInfo();
echo $student2->getInfo();
```

### مثال 2: إدارة المنتجات
```php
<?php
class Product {
    public $name;
    public $price;
    public $quantity;
    
    public function __construct($name, $price, $quantity = 0) {
        $this->name = $name;
        $this->price = $price;
        $this->quantity = $quantity;
    }
    
    public function getTotalValue() {
        return $this->price * $this->quantity;
    }
    
    public function updateQuantity($newQuantity) {
        $this->quantity = $newQuantity;
    }
}

// إنشاء منتجات
$laptop = new Product("لابتوب", 5000, 10);
$phone = new Product("هاتف", 2000, 25);

echo "قيمة اللابتوب: " . $laptop->getTotalValue() . " ريال";
echo "قيمة الهاتف: " . $phone->getTotalValue() . " ريال";
```

---

## 🎯 خلاصة المحاضرة

1. **OOP** هي نمط برمجي يعتمد على الكائنات
2. **الكلاسات** هي قوالب لإنشاء الكائنات
3. **الكائنات** تحتوي على البيانات والوظائف معاً
4. **OOP** يوفر تنظيم أفضل وإعادة استخدام للكود
5. **استخدم OOP** في المشاريع الكبيرة والمعقدة

---

## 📝 التمرين العملي

أنشئ كلاس `Car` يحتوي على:
- خصائص: `brand`, `model`, `year`, `color`
- دالة `start()` ترجع "تم تشغيل السيارة"
- دالة `getInfo()` ترجع معلومات السيارة

---

## 📚 المراجع والموارد
- [PHP Official Documentation](https://www.php.net/manual/en/language.oop5.php)
- [W3Schools PHP OOP](https://www.w3schools.com/php/php_oop.asp)
