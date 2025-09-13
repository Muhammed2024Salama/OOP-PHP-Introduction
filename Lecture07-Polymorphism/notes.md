# المحاضرة السابعة: تعدد الأشكال (Polymorphism)

## 📚 جدول المحتويات
1. [ما هو تعدد الأشكال؟](#ما-هو-تعدد-الأشكال)
2. [أنواع تعدد الأشكال](#أنواع-تعدد-الأشكال)
3. [Method Overriding](#method-overriding)
4. [Method Overloading](#method-overloading)
5. [أمثلة عملية](#أمثلة-عملية)
6. [أفضل الممارسات](#أفضل-الممارسات)

---

## ما هو تعدد الأشكال؟

**تعدد الأشكال (Polymorphism)** هو مبدأ في البرمجة الكائنية يسمح للكائنات من أنواع مختلفة بالاستجابة لنفس الرسالة بطرق مختلفة. يمكن تشبيهه بـ:
- 🎭 **الممثل**: نفس الشخص يؤدي أدوار مختلفة
- 🎵 **الموسيقى**: نفس الآلة تعزف ألحان مختلفة
- 🚗 **المركبات**: نفس الفعل (التشغيل) يعمل بطرق مختلفة

### 🎯 خصائص تعدد الأشكال:
- **مرونة الكود**: نفس الكود يعمل مع أنواع مختلفة
- **سهولة التوسع**: إضافة أنواع جديدة بسهولة
- **إعادة الاستخدام**: استخدام نفس الواجهة
- **التحكم في السلوك**: تحديد السلوك حسب النوع

---

## أنواع تعدد الأشكال

### 1. **تعدد الأشكال في وقت التشغيل (Runtime Polymorphism)**
- يتم تحديد الطريقة المناسبة أثناء تشغيل البرنامج
- يعتمد على نوع الكائن الفعلي
- يتم تنفيذه باستخدام Method Overriding

### 2. **تعدد الأشكال في وقت التجميع (Compile-time Polymorphism)**
- يتم تحديد الطريقة المناسبة أثناء كتابة الكود
- يعتمد على نوع المتغير
- يتم تنفيذه باستخدام Method Overloading

---

## Method Overriding

**Method Overriding** هو إعادة تعريف الطريقة في الكلاس الموروث لتغيير سلوكها.

### 📝 **البناء الأساسي:**
```php
<?php
class Animal {
    public function makeSound() {
        return "صوت عام";
    }
}

class Dog extends Animal {
    public function makeSound() {
        return "نباح";
    }
}

class Cat extends Animal {
    public function makeSound() {
        return "مواء";
    }
}

// استخدام تعدد الأشكال
$animals = [
    new Dog(),
    new Cat(),
    new Animal()
];

foreach ($animals as $animal) {
    echo $animal->makeSound() . "\n";
}
```

### 🔍 **مثال متقدم:**
```php
<?php
class Vehicle {
    protected $brand;
    protected $model;
    
    public function __construct($brand, $model) {
        $this->brand = $brand;
        $this->model = $model;
    }
    
    public function start() {
        return "تم تشغيل " . $this->brand . " " . $this->model;
    }
    
    public function getInfo() {
        return "المركبة: " . $this->brand . " " . $this->model;
    }
}

class Car extends Vehicle {
    public function start() {
        return "تم تشغيل محرك السيارة " . $this->brand . " " . $this->model;
    }
    
    public function openTrunk() {
        return "تم فتح صندوق السيارة";
    }
}

class Motorcycle extends Vehicle {
    public function start() {
        return "تم تشغيل محرك الدراجة " . $this->brand . " " . $this->model;
    }
    
    public function wheelie() {
        return "تم رفع العجلة الأمامية";
    }
}
```

---

## Method Overloading

**Method Overloading** هو تعريف عدة طرق بنفس الاسم ولكن بمعاملات مختلفة.

### ⚠️ **ملاحظة مهمة:**
PHP لا تدعم Method Overloading بالطريقة التقليدية، ولكن يمكن محاكاتها باستخدام معاملات افتراضية.

### 📝 **محاكاة Method Overloading:**
```php
<?php
class Calculator {
    public function add($a, $b = null, $c = null) {
        if ($c !== null) {
            return $a + $b + $c;
        } elseif ($b !== null) {
            return $a + $b;
        } else {
            return $a;
        }
    }
    
    public function multiply($a, $b = null, $c = null) {
        if ($c !== null) {
            return $a * $b * $c;
        } elseif ($b !== null) {
            return $a * $b;
        } else {
            return $a;
        }
    }
}

$calc = new Calculator();
echo $calc->add(5) . "\n";        // 5
echo $calc->add(5, 3) . "\n";     // 8
echo $calc->add(5, 3, 2) . "\n";  // 10
```

---

## أمثلة عملية

### مثال 1: نظام الحيوانات مع تعدد الأشكال
```php
<?php
class Animal {
    protected $name;
    protected $age;
    
    public function __construct($name, $age) {
        $this->name = $name;
        $this->age = $age;
    }
    
    public function makeSound() {
        return $this->name . " يصدر صوتاً";
    }
    
    public function move() {
        return $this->name . " يتحرك";
    }
    
    public function eat() {
        return $this->name . " يأكل";
    }
    
    public function getInfo() {
        return "الحيوان: " . $this->name . " - العمر: " . $this->age;
    }
}

class Dog extends Animal {
    private $breed;
    
    public function __construct($name, $age, $breed) {
        parent::__construct($name, $age);
        $this->breed = $breed;
    }
    
    public function makeSound() {
        return $this->name . " ينبح";
    }
    
    public function move() {
        return $this->name . " يركض";
    }
    
    public function fetch() {
        return $this->name . " يجلب الكرة";
    }
    
    public function getInfo() {
        return parent::getInfo() . " - السلالة: " . $this->breed;
    }
}

class Cat extends Animal {
    private $color;
    
    public function __construct($name, $age, $color) {
        parent::__construct($name, $age);
        $this->color = $color;
    }
    
    public function makeSound() {
        return $this->name . " يموء";
    }
    
    public function move() {
        return $this->name . " يمشي بهدوء";
    }
    
    public function climb() {
        return $this->name . " يتسلق";
    }
    
    public function getInfo() {
        return parent::getInfo() . " - اللون: " . $this->color;
    }
}

class Bird extends Animal {
    private $canFly;
    
    public function __construct($name, $age, $canFly) {
        parent::__construct($name, $age);
        $this->canFly = $canFly;
    }
    
    public function makeSound() {
        return $this->name . " يغرد";
    }
    
    public function move() {
        if ($this->canFly) {
            return $this->name . " يطير";
        }
        return $this->name . " يمشي";
    }
    
    public function fly() {
        if ($this->canFly) {
            return $this->name . " يطير في السماء";
        }
        return $this->name . " لا يستطيع الطيران";
    }
    
    public function getInfo() {
        return parent::getInfo() . " - يطير: " . ($this->canFly ? "نعم" : "لا");
    }
}

// استخدام تعدد الأشكال
$animals = [
    new Dog("ريكس", 3, "جيرمن شيبرد"),
    new Cat("ميمي", 2, "أبيض"),
    new Bird("تويتر", 1, true),
    new Animal("حيوان عام", 5)
];

echo "=== تعدد الأشكال في العمل ===\n";
foreach ($animals as $animal) {
    echo $animal->getInfo() . "\n";
    echo $animal->makeSound() . "\n";
    echo $animal->move() . "\n";
    echo $animal->eat() . "\n";
    echo "---\n";
}
```

### مثال 2: نظام المركبات مع تعدد الأشكال
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
    
    public function drive($distance) {
        if ($this->isRunning) {
            return "تم السير " . $distance . " كم بـ " . $this->brand . " " . $this->model;
        }
        return "يجب تشغيل المركبة أولاً";
    }
    
    public function getInfo() {
        return "المركبة: " . $this->brand . " " . $this->model . " - السنة: " . $this->year;
    }
}

class Car extends Vehicle {
    private $doors;
    private $seats;
    
    public function __construct($brand, $model, $year, $doors, $seats, $fuel = 0) {
        parent::__construct($brand, $model, $year, $fuel);
        $this->doors = $doors;
        $this->seats = $seats;
    }
    
    public function start() {
        if ($this->fuel > 0) {
            $this->isRunning = true;
            return "تم تشغيل محرك السيارة " . $this->brand . " " . $this->model . " - الأبواب: " . $this->doors;
        }
        return "لا يمكن تشغيل السيارة - الوقود فارغ";
    }
    
    public function drive($distance) {
        if ($this->isRunning) {
            $fuelNeeded = $distance / 10; // كل 10 كم يحتاج لتر واحد
            if ($this->fuel >= $fuelNeeded) {
                $this->fuel -= $fuelNeeded;
                return "تم السير " . $distance . " كم بالسيارة " . $this->brand . " " . $this->model . " - الوقود المتبقي: " . $this->fuel . " لتر";
            }
            return "لا يوجد وقود كافي للسير";
        }
        return "يجب تشغيل السيارة أولاً";
    }
    
    public function openTrunk() {
        return "تم فتح صندوق السيارة " . $this->brand . " " . $this->model;
    }
    
    public function getInfo() {
        return parent::getInfo() . " - الأبواب: " . $this->doors . " - المقاعد: " . $this->seats;
    }
}

class Motorcycle extends Vehicle {
    private $hasWindshield;
    private $engineSize;
    
    public function __construct($brand, $model, $year, $hasWindshield, $engineSize, $fuel = 0) {
        parent::__construct($brand, $model, $year, $fuel);
        $this->hasWindshield = $hasWindshield;
        $this->engineSize = $engineSize;
    }
    
    public function start() {
        if ($this->fuel > 0) {
            $this->isRunning = true;
            return "تم تشغيل محرك الدراجة " . $this->brand . " " . $this->model . " - المحرك: " . $this->engineSize . "cc";
        }
        return "لا يمكن تشغيل الدراجة - الوقود فارغ";
    }
    
    public function drive($distance) {
        if ($this->isRunning) {
            $fuelNeeded = $distance / 15; // كل 15 كم يحتاج لتر واحد
            if ($this->fuel >= $fuelNeeded) {
                $this->fuel -= $fuelNeeded;
                return "تم السير " . $distance . " كم بالدراجة " . $this->brand . " " . $this->model . " - الوقود المتبقي: " . $this->fuel . " لتر";
            }
            return "لا يوجد وقود كافي للسير";
        }
        return "يجب تشغيل الدراجة أولاً";
    }
    
    public function wheelie() {
        return "تم رفع العجلة الأمامية للدراجة " . $this->brand . " " . $this->model;
    }
    
    public function getInfo() {
        return parent::getInfo() . " - واقي الرياح: " . ($this->hasWindshield ? "نعم" : "لا") . " - المحرك: " . $this->engineSize . "cc";
    }
}

class Truck extends Vehicle {
    private $cargoCapacity;
    private $hasTrailer;
    
    public function __construct($brand, $model, $year, $cargoCapacity, $hasTrailer = false, $fuel = 0) {
        parent::__construct($brand, $model, $year, $fuel);
        $this->cargoCapacity = $cargoCapacity;
        $this->hasTrailer = $hasTrailer;
    }
    
    public function start() {
        if ($this->fuel > 0) {
            $this->isRunning = true;
            return "تم تشغيل محرك الشاحنة " . $this->brand . " " . $this->model . " - سعة الشحن: " . $this->cargoCapacity . " كيلو";
        }
        return "لا يمكن تشغيل الشاحنة - الوقود فارغ";
    }
    
    public function drive($distance) {
        if ($this->isRunning) {
            $fuelNeeded = $distance / 8; // كل 8 كم يحتاج لتر واحد
            if ($this->fuel >= $fuelNeeded) {
                $this->fuel -= $fuelNeeded;
                return "تم السير " . $distance . " كم بالشاحنة " . $this->brand . " " . $this->model . " - الوقود المتبقي: " . $this->fuel . " لتر";
            }
            return "لا يوجد وقود كافي للسير";
        }
        return "يجب تشغيل الشاحنة أولاً";
    }
    
    public function loadCargo($weight) {
        if ($weight <= $this->cargoCapacity) {
            return "تم تحميل " . $weight . " كيلو في الشاحنة " . $this->brand . " " . $this->model;
        }
        return "الوزن يتجاوز السعة القصوى";
    }
    
    public function getInfo() {
        return parent::getInfo() . " - سعة الشحن: " . $this->cargoCapacity . " كيلو - مقطورة: " . ($this->hasTrailer ? "نعم" : "لا");
    }
}

// استخدام تعدد الأشكال
$vehicles = [
    new Car("تويوتا", "كامري", 2020, 4, 5, 50),
    new Motorcycle("هوندا", "CBR", 2019, true, 600, 30),
    new Truck("فورد", "F-150", 2021, 1000, true, 80)
];

echo "=== تعدد الأشكال في المركبات ===\n";
foreach ($vehicles as $vehicle) {
    echo $vehicle->getInfo() . "\n";
    echo $vehicle->start() . "\n";
    echo $vehicle->drive(50) . "\n";
    echo "---\n";
}
```

### مثال 3: نظام الموظفين مع تعدد الأشكال
```php
<?php
class Employee {
    protected $name;
    protected $employeeId;
    protected $salary;
    protected $department;
    
    public function __construct($name, $employeeId, $salary, $department) {
        $this->name = $name;
        $this->employeeId = $employeeId;
        $this->salary = $salary;
        $this->department = $department;
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
        return "الموظف: " . $this->name . " - الرقم: " . $this->employeeId . " - القسم: " . $this->department;
    }
}

class Manager extends Employee {
    private $teamSize;
    private $bonus;
    
    public function __construct($name, $employeeId, $salary, $department, $teamSize, $bonus = 0) {
        parent::__construct($name, $employeeId, $salary, $department);
        $this->teamSize = $teamSize;
        $this->bonus = $bonus;
    }
    
    public function work() {
        return $this->name . " يدير فريق من " . $this->teamSize . " موظف في قسم " . $this->department;
    }
    
    public function takeBreak() {
        return $this->name . " يأخذ استراحة مع الفريق";
    }
    
    public function getSalary() {
        $totalSalary = $this->salary + $this->bonus;
        return $this->name . " الراتب الإجمالي: " . $totalSalary . " ريال (راتب: " . $this->salary . " + مكافأة: " . $this->bonus . ")";
    }
    
    public function holdMeeting() {
        return $this->name . " يعقد اجتماعاً مع الفريق";
    }
    
    public function getInfo() {
        return parent::getInfo() . " - حجم الفريق: " . $this->teamSize . " - المكافأة: " . $this->bonus . " ريال";
    }
}

class Developer extends Employee {
    private $programmingLanguages;
    private $experience;
    
    public function __construct($name, $employeeId, $salary, $department, $programmingLanguages, $experience) {
        parent::__construct($name, $employeeId, $salary, $department);
        $this->programmingLanguages = $programmingLanguages;
        $this->experience = $experience;
    }
    
    public function work() {
        return $this->name . " يطور برامج بـ " . implode(", ", $this->programmingLanguages) . " في قسم " . $this->department;
    }
    
    public function takeBreak() {
        return $this->name . " يأخذ استراحة للتفكير في حل مشكلة برمجية";
    }
    
    public function getSalary() {
        return $this->name . " الراتب: " . $this->salary . " ريال - الخبرة: " . $this->experience . " سنوات";
    }
    
    public function code() {
        return $this->name . " يكتب كود بـ " . implode(", ", $this->programmingLanguages);
    }
    
    public function getInfo() {
        return parent::getInfo() . " - لغات البرمجة: " . implode(", ", $this->programmingLanguages) . " - الخبرة: " . $this->experience . " سنوات";
    }
}

class Designer extends Employee {
    private $designTools;
    private $specialization;
    
    public function __construct($name, $employeeId, $salary, $department, $designTools, $specialization) {
        parent::__construct($name, $employeeId, $salary, $department);
        $this->designTools = $designTools;
        $this->specialization = $specialization;
    }
    
    public function work() {
        return $this->name . " يصمم باستخدام " . implode(", ", $this->designTools) . " في قسم " . $this->department;
    }
    
    public function takeBreak() {
        return $this->name . " يأخذ استراحة للبحث عن إلهام جديد";
    }
    
    public function getSalary() {
        return $this->name . " الراتب: " . $this->salary . " ريال - التخصص: " . $this->specialization;
    }
    
    public function design() {
        return $this->name . " يصمم " . $this->specialization . " باستخدام " . implode(", ", $this->designTools);
    }
    
    public function getInfo() {
        return parent::getInfo() . " - أدوات التصميم: " . implode(", ", $this->designTools) . " - التخصص: " . $this->specialization;
    }
}

// استخدام تعدد الأشكال
$employees = [
    new Manager("أحمد السعد", "M001", 15000, "التطوير", 8, 3000),
    new Developer("فاطمة محمد", "D001", 12000, "التطوير", ["PHP", "JavaScript", "Python"], 3),
    new Designer("محمد علي", "DS001", 10000, "التصميم", ["Photoshop", "Figma", "Sketch"], "UI/UX")
];

echo "=== تعدد الأشكال في الموظفين ===\n";
foreach ($employees as $employee) {
    echo $employee->getInfo() . "\n";
    echo $employee->work() . "\n";
    echo $employee->takeBreak() . "\n";
    echo $employee->getSalary() . "\n";
    echo "---\n";
}
```

---

## أفضل الممارسات

### ✅ **1. استخدام تعدد الأشكال للواجهات المشتركة**
```php
<?php
class Shape {
    public function calculateArea() {
        return "مساحة الشكل";
    }
}

class Circle extends Shape {
    private $radius;
    
    public function calculateArea() {
        return 3.14 * $this->radius * $this->radius;
    }
}

class Rectangle extends Shape {
    private $width;
    private $height;
    
    public function calculateArea() {
        return $this->width * $this->height;
    }
}
```

### ✅ **2. تجنب Overriding المفرط**
```php
<?php
class Animal {
    public function makeSound() {
        return "صوت عام";
    }
}

class Dog extends Animal {
    public function makeSound() {
        return "نباح";
    }
}

// ✅ صحيح - Overriding منطقي
```

### ✅ **3. استخدام معاملات افتراضية لمحاكاة Overloading**
```php
<?php
class Database {
    public function query($sql, $params = null, $options = []) {
        if ($params !== null) {
            // تنفيذ استعلام مع معاملات
        } else {
            // تنفيذ استعلام بسيط
        }
    }
}
```

### ✅ **4. توثيق الطرق الموروثة**
```php
<?php
class Animal {
    /**
     * إصدار صوت من الحيوان
     * @return string
     */
    public function makeSound() {
        return "صوت عام";
    }
}

class Dog extends Animal {
    /**
     * إصدار صوت الكلب (نباح)
     * @return string
     */
    public function makeSound() {
        return "نباح";
    }
}
```

---

## 🎯 خلاصة المحاضرة

1. **تعدد الأشكال** يسمح للكائنات بالاستجابة لنفس الرسالة بطرق مختلفة
2. **Method Overriding** هو إعادة تعريف الطريقة في الكلاس الموروث
3. **Method Overloading** يمكن محاكاته باستخدام معاملات افتراضية
4. **استخدم تعدد الأشكال** للواجهات المشتركة
5. **تجنب Overriding المفرط** لسهولة الصيانة
6. **وثق الطرق الموروثة** لسهولة الفهم

---

## 📝 التمرين العملي

أنشئ نظام تعدد أشكال للكتب:
- كلاس أساسي `Book` مع طريقة `read()`
- كلاس `Novel` يرث من `Book` مع `read()` مختلف
- كلاس `Textbook` يرث من `Book` مع `read()` مختلف
- استخدم تعدد الأشكال لعرض أنواع مختلفة من القراءة

---

## 📚 المراجع والموارد
- [PHP Polymorphism](https://www.php.net/manual/en/language.oop5.polymorphism.php)
- [PHP Method Overriding](https://www.php.net/manual/en/language.oop5.overriding.php)
- [PHP Object-Oriented Programming](https://www.php.net/manual/en/language.oop5.php)

