# المحاضرة الخامسة: الوراثة (Inheritance)

## 📚 جدول المحتويات
1. [ما هي الوراثة؟](#ما-هي-الوراثة)
2. [كيفية استخدام الوراثة](#كيفية-استخدام-الوراثة)
3. [كلمة extends](#كلمة-extends)
4. [كلمة parent](#كلمة-parent)
5. [أنواع الوراثة](#أنواع-الوراثة)
6. [أمثلة عملية](#أمثلة-عملية)
7. [أفضل الممارسات](#أفضل-الممارسات)

---

## ما هي الوراثة؟

**الوراثة (Inheritance)** هي إحدى المبادئ الأساسية في البرمجة الكائنية التي تسمح للكلاس بوراثة الخصائص والطرق من كلاس آخر. يمكن تشبيهها بـ:
- 👨‍👩‍👧‍👦 **الوراثة العائلية**: الطفل يرث الصفات من والديه
- 🏗️ **البناء**: بناء منزل جديد على أساس منزل قديم
- 📚 **المعرفة**: الطالب يرث المعرفة من المعلم

### 🎯 خصائص الوراثة:
- **إعادة الاستخدام**: استخدام الكود الموجود
- **التوسع**: إضافة ميزات جديدة
- **التنظيم**: تنظيم الكود بشكل هرمي
- **المرونة**: تعديل السلوك حسب الحاجة

---

## كيفية استخدام الوراثة

### 📝 **البناء الأساسي:**
```php
<?php
// الكلاس الأساسي (Parent Class)
class Animal {
    public $name;
    public $age;
    
    public function eat() {
        return $this->name . " يأكل";
    }
    
    public function sleep() {
        return $this->name . " ينام";
    }
}

// الكلاس الموروث (Child Class)
class Dog extends Animal {
    public function bark() {
        return $this->name . " ينبح";
    }
}

// استخدام الكلاس الموروث
$dog = new Dog();
$dog->name = "ريكس";
$dog->age = 3;

echo $dog->eat();   // ريكس يأكل
echo $dog->sleep(); // ريكس ينام
echo $dog->bark();  // ريكس ينبح
```

---

## كلمة extends

**`extends`** هي الكلمة المفتاحية المستخدمة لإنشاء الوراثة في PHP.

### 🔍 **البناء:**
```php
<?php
class ChildClass extends ParentClass {
    // خصائص وطرق الكلاس الموروث
}
```

### 📝 **مثال:**
```php
<?php
class Vehicle {
    public $brand;
    public $model;
    public $year;
    
    public function start() {
        return "تم تشغيل المركبة";
    }
    
    public function stop() {
        return "تم إيقاف المركبة";
    }
}

class Car extends Vehicle {
    public $doors;
    
    public function openTrunk() {
        return "تم فتح الصندوق";
    }
}

class Motorcycle extends Vehicle {
    public $hasWindshield;
    
    public function wheelie() {
        return "تم رفع العجلة الأمامية";
    }
}
```

---

## كلمة parent

**`parent`** هي الكلمة المفتاحية المستخدمة للوصول إلى الكلاس الأساسي من الكلاس الموروث.

### 🔍 **الاستخدامات:**

#### 1. **استدعاء Constructor الأساسي**
```php
<?php
class Animal {
    public $name;
    public $age;
    
    public function __construct($name, $age) {
        $this->name = $name;
        $this->age = $age;
    }
}

class Dog extends Animal {
    public $breed;
    
    public function __construct($name, $age, $breed) {
        parent::__construct($name, $age); // استدعاء constructor الأساسي
        $this->breed = $breed;
    }
}
```

#### 2. **استدعاء الطرق الأساسية**
```php
<?php
class Animal {
    public function makeSound() {
        return "صوت عام";
    }
}

class Dog extends Animal {
    public function makeSound() {
        return parent::makeSound() . " - نباح";
    }
}
```

#### 3. **الوصول إلى الخصائص الأساسية**
```php
<?php
class Animal {
    protected $name;
    
    public function getName() {
        return $this->name;
    }
}

class Dog extends Animal {
    public function setName($name) {
        $this->name = $name; // الوصول إلى الخاصية المحمية
    }
}
```

---

## أنواع الوراثة

### 1. **الوراثة البسيطة (Single Inheritance)**
```php
<?php
class Animal {
    public $name;
}

class Dog extends Animal {
    public $breed;
}

class Puppy extends Dog {
    public $age;
}
```

### 2. **الوراثة المتعددة المستويات (Multilevel Inheritance)**
```php
<?php
class Vehicle {
    public $brand;
}

class Car extends Vehicle {
    public $doors;
}

class SportsCar extends Car {
    public $topSpeed;
}
```

### 3. **الوراثة الهرمية (Hierarchical Inheritance)**
```php
<?php
class Animal {
    public $name;
}

class Dog extends Animal {
    public $breed;
}

class Cat extends Animal {
    public $color;
}

class Bird extends Animal {
    public $canFly;
}
```

---

## أمثلة عملية

### مثال 1: نظام الحيوانات
```php
<?php
class Animal {
    protected $name;
    protected $age;
    protected $species;
    
    public function __construct($name, $age, $species) {
        $this->name = $name;
        $this->age = $age;
        $this->species = $species;
    }
    
    public function eat() {
        return $this->name . " يأكل";
    }
    
    public function sleep() {
        return $this->name . " ينام";
    }
    
    public function makeSound() {
        return $this->name . " يصدر صوتاً";
    }
    
    public function getInfo() {
        return "الاسم: " . $this->name . " - العمر: " . $this->age . " - النوع: " . $this->species;
    }
}

class Dog extends Animal {
    private $breed;
    private $isTrained;
    
    public function __construct($name, $age, $breed, $isTrained = false) {
        parent::__construct($name, $age, "كلب");
        $this->breed = $breed;
        $this->isTrained = $isTrained;
    }
    
    public function makeSound() {
        return $this->name . " ينبح";
    }
    
    public function fetch() {
        return $this->name . " يجلب الكرة";
    }
    
    public function sit() {
        if ($this->isTrained) {
            return $this->name . " يجلس";
        }
        return $this->name . " لا يعرف كيف يجلس";
    }
    
    public function getInfo() {
        $info = parent::getInfo();
        $info .= " - السلالة: " . $this->breed;
        $info .= " - مدرب: " . ($this->isTrained ? "نعم" : "لا");
        return $info;
    }
}

class Cat extends Animal {
    private $color;
    private $isIndoor;
    
    public function __construct($name, $age, $color, $isIndoor = true) {
        parent::__construct($name, $age, "قطة");
        $this->color = $color;
        $this->isIndoor = $isIndoor;
    }
    
    public function makeSound() {
        return $this->name . " يموء";
    }
    
    public function purr() {
        return $this->name . " يخرخر";
    }
    
    public function climb() {
        return $this->name . " يتسلق";
    }
    
    public function getInfo() {
        $info = parent::getInfo();
        $info .= " - اللون: " . $this->color;
        $info .= " - داخلي: " . ($this->isIndoor ? "نعم" : "لا");
        return $info;
    }
}

// استخدام الكلاسات
$dog = new Dog("ريكس", 3, "جيرمن شيبرد", true);
$cat = new Cat("ميمي", 2, "أبيض", true);

echo $dog->getInfo() . "\n";
echo $dog->makeSound() . "\n";
echo $dog->fetch() . "\n";
echo $dog->sit() . "\n\n";

echo $cat->getInfo() . "\n";
echo $cat->makeSound() . "\n";
echo $cat->purr() . "\n";
echo $cat->climb() . "\n";
```

### مثال 2: نظام المركبات
```php
<?php
class Vehicle {
    protected $brand;
    protected $model;
    protected $year;
    protected $fuel;
    protected $isRunning;
    
    public function __construct($brand, $model, $year, $fuel = 0) {
        $this->brand = $brand;
        $this->model = $model;
        $this->year = $year;
        $this->fuel = $fuel;
        $this->isRunning = false;
    }
    
    public function start() {
        if ($this->fuel > 0) {
            $this->isRunning = true;
            return "تم تشغيل " . $this->brand . " " . $this->model;
        }
        return "لا يمكن التشغيل - الوقود فارغ";
    }
    
    public function stop() {
        $this->isRunning = false;
        return "تم إيقاف " . $this->brand . " " . $this->model;
    }
    
    public function addFuel($amount) {
        $this->fuel += $amount;
        return "تم إضافة " . $amount . " لتر - الوقود الحالي: " . $this->fuel;
    }
    
    public function getInfo() {
        return "المركبة: " . $this->brand . " " . $this->model . " - السنة: " . $this->year;
    }
}

class Car extends Vehicle {
    private $doors;
    private $seats;
    private $hasAirConditioning;
    
    public function __construct($brand, $model, $year, $doors, $seats, $hasAirConditioning = true) {
        parent::__construct($brand, $model, $year);
        $this->doors = $doors;
        $this->seats = $seats;
        $this->hasAirConditioning = $hasAirConditioning;
    }
    
    public function openTrunk() {
        return "تم فتح صندوق " . $this->brand . " " . $this->model;
    }
    
    public function turnOnAC() {
        if ($this->hasAirConditioning) {
            return "تم تشغيل التكييف في " . $this->brand . " " . $this->model;
        }
        return "هذه السيارة لا تحتوي على تكييف";
    }
    
    public function getInfo() {
        $info = parent::getInfo();
        $info .= " - الأبواب: " . $this->doors;
        $info .= " - المقاعد: " . $this->seats;
        $info .= " - تكييف: " . ($this->hasAirConditioning ? "نعم" : "لا");
        return $info;
    }
}

class Motorcycle extends Vehicle {
    private $hasWindshield;
    private $engineSize;
    
    public function __construct($brand, $model, $year, $hasWindshield, $engineSize) {
        parent::__construct($brand, $model, $year);
        $this->hasWindshield = $hasWindshield;
        $this->engineSize = $engineSize;
    }
    
    public function wheelie() {
        return "تم رفع العجلة الأمامية للدراجة " . $this->brand . " " . $this->model;
    }
    
    public function revEngine() {
        return "تم تشغيل محرك " . $this->engineSize . "cc";
    }
    
    public function getInfo() {
        $info = parent::getInfo();
        $info .= " - واقي الرياح: " . ($this->hasWindshield ? "نعم" : "لا");
        $info .= " - حجم المحرك: " . $this->engineSize . "cc";
        return $info;
    }
}

class Truck extends Vehicle {
    private $cargoCapacity;
    private $hasTrailer;
    
    public function __construct($brand, $model, $year, $cargoCapacity, $hasTrailer = false) {
        parent::__construct($brand, $model, $year);
        $this->cargoCapacity = $cargoCapacity;
        $this->hasTrailer = $hasTrailer;
    }
    
    public function loadCargo($weight) {
        if ($weight <= $this->cargoCapacity) {
            return "تم تحميل " . $weight . " كيلو في " . $this->brand . " " . $this->model;
        }
        return "الوزن يتجاوز السعة القصوى";
    }
    
    public function attachTrailer() {
        if ($this->hasTrailer) {
            return "تم ربط المقطورة بـ " . $this->brand . " " . $this->model;
        }
        return "هذه الشاحنة لا تدعم المقطورة";
    }
    
    public function getInfo() {
        $info = parent::getInfo();
        $info .= " - سعة الشحن: " . $this->cargoCapacity . " كيلو";
        $info .= " - مقطورة: " . ($this->hasTrailer ? "نعم" : "لا");
        return $info;
    }
}

// استخدام الكلاسات
$car = new Car("تويوتا", "كامري", 2020, 4, 5, true);
$motorcycle = new Motorcycle("هوندا", "CBR", 2019, true, 600);
$truck = new Truck("فورد", "F-150", 2021, 1000, true);

echo $car->getInfo() . "\n";
echo $car->start() . "\n";
echo $car->openTrunk() . "\n";
echo $car->turnOnAC() . "\n\n";

echo $motorcycle->getInfo() . "\n";
echo $motorcycle->start() . "\n";
echo $motorcycle->wheelie() . "\n";
echo $motorcycle->revEngine() . "\n\n";

echo $truck->getInfo() . "\n";
echo $truck->start() . "\n";
echo $truck->loadCargo(500) . "\n";
echo $truck->attachTrailer() . "\n";
```

### مثال 3: نظام الموظفين
```php
<?php
class Employee {
    protected $name;
    protected $employeeId;
    protected $salary;
    protected $department;
    protected $hireDate;
    
    public function __construct($name, $employeeId, $salary, $department, $hireDate) {
        $this->name = $name;
        $this->employeeId = $employeeId;
        $this->salary = $salary;
        $this->department = $department;
        $this->hireDate = $hireDate;
    }
    
    public function work() {
        return $this->name . " يعمل في قسم " . $this->department;
    }
    
    public function takeBreak() {
        return $this->name . " يأخذ استراحة";
    }
    
    public function getSalary() {
        return $this->name . " الراتب: " . $this->salary . " ريال";
    }
    
    public function getInfo() {
        return "الاسم: " . $this->name . " - الرقم: " . $this->employeeId . " - القسم: " . $this->department;
    }
}

class Manager extends Employee {
    private $teamSize;
    private $bonus;
    
    public function __construct($name, $employeeId, $salary, $department, $hireDate, $teamSize, $bonus = 0) {
        parent::__construct($name, $employeeId, $salary, $department, $hireDate);
        $this->teamSize = $teamSize;
        $this->bonus = $bonus;
    }
    
    public function manageTeam() {
        return $this->name . " يدير فريق من " . $this->teamSize . " موظف";
    }
    
    public function holdMeeting() {
        return $this->name . " يعقد اجتماعاً مع الفريق";
    }
    
    public function getSalary() {
        $totalSalary = $this->salary + $this->bonus;
        return $this->name . " الراتب الإجمالي: " . $totalSalary . " ريال (راتب: " . $this->salary . " + مكافأة: " . $this->bonus . ")";
    }
    
    public function getInfo() {
        $info = parent::getInfo();
        $info .= " - حجم الفريق: " . $this->teamSize;
        $info .= " - المكافأة: " . $this->bonus . " ريال";
        return $info;
    }
}

class Developer extends Employee {
    private $programmingLanguages;
    private $experience;
    
    public function __construct($name, $employeeId, $salary, $department, $hireDate, $programmingLanguages, $experience) {
        parent::__construct($name, $employeeId, $salary, $department, $hireDate);
        $this->programmingLanguages = $programmingLanguages;
        $this->experience = $experience;
    }
    
    public function code() {
        return $this->name . " يكتب كود بـ " . implode(", ", $this->programmingLanguages);
    }
    
    public function debug() {
        return $this->name . " يصلح الأخطاء في الكود";
    }
    
    public function attendMeeting() {
        return $this->name . " يحضر اجتماعاً تقنياً";
    }
    
    public function getInfo() {
        $info = parent::getInfo();
        $info .= " - لغات البرمجة: " . implode(", ", $this->programmingLanguages);
        $info .= " - الخبرة: " . $this->experience . " سنوات";
        return $info;
    }
}

class Designer extends Employee {
    private $designTools;
    private $specialization;
    
    public function __construct($name, $employeeId, $salary, $department, $hireDate, $designTools, $specialization) {
        parent::__construct($name, $employeeId, $salary, $department, $hireDate);
        $this->designTools = $designTools;
        $this->specialization = $specialization;
    }
    
    public function design() {
        return $this->name . " يصمم باستخدام " . implode(", ", $this->designTools);
    }
    
    public function createPrototype() {
        return $this->name . " ينشئ نموذجاً أولياً";
    }
    
    public function presentDesign() {
        return $this->name . " يعرض التصميم للعميل";
    }
    
    public function getInfo() {
        $info = parent::getInfo();
        $info .= " - أدوات التصميم: " . implode(", ", $this->designTools);
        $info .= " - التخصص: " . $this->specialization;
        return $info;
    }
}

// استخدام الكلاسات
$manager = new Manager("أحمد السعد", "M001", 15000, "التطوير", "2020-01-15", 8, 3000);
$developer = new Developer("فاطمة محمد", "D001", 12000, "التطوير", "2021-03-20", ["PHP", "JavaScript", "Python"], 3);
$designer = new Designer("محمد علي", "DS001", 10000, "التصميم", "2021-06-10", ["Photoshop", "Figma", "Sketch"], "UI/UX");

echo $manager->getInfo() . "\n";
echo $manager->work() . "\n";
echo $manager->manageTeam() . "\n";
echo $manager->holdMeeting() . "\n";
echo $manager->getSalary() . "\n\n";

echo $developer->getInfo() . "\n";
echo $developer->work() . "\n";
echo $developer->code() . "\n";
echo $developer->debug() . "\n";
echo $developer->getSalary() . "\n\n";

echo $designer->getInfo() . "\n";
echo $designer->work() . "\n";
echo $designer->design() . "\n";
echo $designer->createPrototype() . "\n";
echo $designer->getSalary() . "\n";
```

---

## أفضل الممارسات

### ✅ **1. استخدام الوراثة للعلاقات الحقيقية**
```php
<?php
// ✅ صحيح - علاقة حقيقية
class Animal {
    // خصائص وطرق عامة للحيوانات
}

class Dog extends Animal {
    // خصائص وطرق خاصة بالكلاب
}
```

### ✅ **2. تجنب الوراثة العميقة**
```php
<?php
// ❌ خطأ - وراثة عميقة جداً
class A extends B extends C extends D extends E {
    // يصعب الفهم والصيانة
}

// ✅ صحيح - وراثة بسيطة
class Animal {
    // خصائص أساسية
}

class Mammal extends Animal {
    // خصائص الثدييات
}

class Dog extends Mammal {
    // خصائص الكلاب
}
```

### ✅ **3. استخدام protected للخصائص المشتركة**
```php
<?php
class Vehicle {
    protected $brand; // يمكن للكلاسات الموروثة الوصول إليها
    protected $model;
    
    public function getBrand() {
        return $this->brand;
    }
}

class Car extends Vehicle {
    public function setBrand($brand) {
        $this->brand = $brand; // يمكن الوصول للخاصية المحمية
    }
}
```

### ✅ **4. استدعاء parent constructor**
```php
<?php
class Animal {
    protected $name;
    
    public function __construct($name) {
        $this->name = $name;
    }
}

class Dog extends Animal {
    private $breed;
    
    public function __construct($name, $breed) {
        parent::__construct($name); // استدعاء constructor الأساسي
        $this->breed = $breed;
    }
}
```

### ✅ **5. تجنب الوراثة المفرطة**
```php
<?php
// ❌ خطأ - وراثة غير منطقية
class Car extends Database {
    // السيارة ليست قاعدة بيانات
}

// ✅ صحيح - استخدام Composition
class Car {
    private $database;
    
    public function __construct() {
        $this->database = new Database();
    }
}
```

---

## 🎯 خلاصة المحاضرة

1. **الوراثة** تسمح للكلاس بوراثة الخصائص والطرق من كلاس آخر
2. **extends** هي الكلمة المفتاحية لإنشاء الوراثة
3. **parent** تسمح بالوصول إلى الكلاس الأساسي
4. **استخدم الوراثة** للعلاقات الحقيقية بين الكائنات
5. **تجنب الوراثة العميقة** لسهولة الصيانة
6. **استخدم protected** للخصائص المشتركة

---

## 📝 التمرين العملي

أنشئ نظام وراثة للكتب:
- كلاس أساسي `Book` مع خصائص: `title`, `author`, `pages`
- كلاس `Novel` يرث من `Book` مع خاصية `genre`
- كلاس `Textbook` يرث من `Book` مع خاصية `subject`
- كل كلاس له طرق خاصة به

---

## 📚 المراجع والموارد
- [PHP Inheritance](https://www.php.net/manual/en/language.oop5.inheritance.php)
- [PHP Parent Keyword](https://www.php.net/manual/en/language.oop5.paamayim-nekudotayim.php)
- [PHP Extends](https://www.php.net/manual/en/language.oop5.inheritance.php#language.oop5.inheritance.extends)


