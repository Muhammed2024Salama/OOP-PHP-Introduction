<?php
/**
 * المحاضرة السابعة: أمثلة على تعدد الأشكال (Polymorphism)
 * 
 * هذا الملف يحتوي على أمثلة متنوعة لشرح مفهوم تعدد الأشكال
 */

echo "<h1>المحاضرة السابعة: تعدد الأشكال (Polymorphism)</h1>\n";

// ==========================================
// مثال 1: نظام الحيوانات مع تعدد الأشكال
// ==========================================
echo "<h2>مثال 1: نظام الحيوانات</h2>\n";

class Animal {
    protected $name;
    protected $age;
    protected $species;
    
    public function __construct($name, $age, $species) {
        echo "🏗️ <strong>تم إنشاء حيوان جديد:</strong> " . $name . "<br>";
        
        $this->name = $name;
        $this->age = $age;
        $this->species = $species;
        
        echo "✅ <strong>تم تهيئة الحيوان بنجاح</strong><br>";
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
        return "الحيوان: " . $this->name . " - العمر: " . $this->age . " - النوع: " . $this->species;
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
    
    // Method Overriding - تعدد الأشكال
    public function makeSound() {
        return $this->name . " ينبح";
    }
    
    public function move() {
        return $this->name . " يركض";
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
    
    // Method Overriding - تعدد الأشكال
    public function makeSound() {
        return $this->name . " يموء";
    }
    
    public function move() {
        return $this->name . " يمشي بهدوء";
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

class Bird extends Animal {
    private $canFly;
    private $wingspan;
    
    public function __construct($name, $age, $canFly, $wingspan) {
        parent::__construct($name, $age, "طائر");
        $this->canFly = $canFly;
        $this->wingspan = $wingspan;
    }
    
    // Method Overriding - تعدد الأشكال
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
    
    public function buildNest() {
        return $this->name . " يبني عشاً";
    }
    
    public function getInfo() {
        $info = parent::getInfo();
        $info .= " - يطير: " . ($this->canFly ? "نعم" : "لا");
        $info .= " - طول الجناح: " . $this->wingspan . " سم";
        return $info;
    }
}

// استخدام تعدد الأشكال
echo "<h3>تعدد الأشكال في العمل:</h3>\n";

$animals = [
    new Dog("ريكس", 3, "جيرمن شيبرد", true),
    new Cat("ميمي", 2, "أبيض", true),
    new Bird("تويتر", 1, true, 25),
    new Animal("حيوان عام", 5, "غير محدد")
];

echo "<h4>عرض معلومات الحيوانات:</h4>\n";
foreach ($animals as $animal) {
    echo "<strong>" . $animal->getInfo() . "</strong><br>";
    echo $animal->makeSound() . "<br>";
    echo $animal->move() . "<br>";
    echo $animal->eat() . "<br>";
    echo "---<br>";
}

// ==========================================
// مثال 2: نظام المركبات مع تعدد الأشكال
// ==========================================
echo "<h2>مثال 2: نظام المركبات</h2>\n";

class Vehicle {
    protected $brand;
    protected $model;
    protected $year;
    protected $fuel;
    protected $isRunning;
    protected $mileage;
    
    public function __construct($brand, $model, $year, $fuel = 0) {
        echo "🏗️ <strong>تم إنشاء مركبة جديدة:</strong> " . $brand . " " . $model . "<br>";
        
        $this->brand = $brand;
        $this->model = $model;
        $this->year = $year;
        $this->fuel = $fuel;
        $this->isRunning = false;
        $this->mileage = 0;
        
        echo "✅ <strong>تم تهيئة المركبة بنجاح</strong><br>";
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
    private $hasAirConditioning;
    
    public function __construct($brand, $model, $year, $doors, $seats, $hasAirConditioning = true, $fuel = 0) {
        parent::__construct($brand, $model, $year, $fuel);
        $this->doors = $doors;
        $this->seats = $seats;
        $this->hasAirConditioning = $hasAirConditioning;
    }
    
    // Method Overriding - تعدد الأشكال
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
                $this->mileage += $distance;
                return "تم السير " . $distance . " كم بالسيارة " . $this->brand . " " . $this->model . " - الوقود المتبقي: " . $this->fuel . " لتر";
            }
            return "لا يوجد وقود كافي للسير";
        }
        return "يجب تشغيل السيارة أولاً";
    }
    
    public function openTrunk() {
        return "تم فتح صندوق السيارة " . $this->brand . " " . $this->model;
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
    
    public function __construct($brand, $model, $year, $hasWindshield, $engineSize, $fuel = 0) {
        parent::__construct($brand, $model, $year, $fuel);
        $this->hasWindshield = $hasWindshield;
        $this->engineSize = $engineSize;
    }
    
    // Method Overriding - تعدد الأشكال
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
                $this->mileage += $distance;
                return "تم السير " . $distance . " كم بالدراجة " . $this->brand . " " . $this->model . " - الوقود المتبقي: " . $this->fuel . " لتر";
            }
            return "لا يوجد وقود كافي للسير";
        }
        return "يجب تشغيل الدراجة أولاً";
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
        $info .= " - المحرك: " . $this->engineSize . "cc";
        return $info;
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
    
    // Method Overriding - تعدد الأشكال
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
                $this->mileage += $distance;
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
        return "الوزن يتجاوز السعة القصوى (" . $this->cargoCapacity . " كيلو)";
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

// استخدام تعدد الأشكال
echo "<h3>تعدد الأشكال في المركبات:</h3>\n";

$vehicles = [
    new Car("تويوتا", "كامري", 2020, 4, 5, true, 50),
    new Motorcycle("هوندا", "CBR", 2019, true, 600, 30),
    new Truck("فورد", "F-150", 2021, 1000, true, 80)
];

echo "<h4>عرض معلومات المركبات:</h4>\n";
foreach ($vehicles as $vehicle) {
    echo "<strong>" . $vehicle->getInfo() . "</strong><br>";
    echo $vehicle->start() . "<br>";
    echo $vehicle->drive(50) . "<br>";
    echo "---<br>";
}

// ==========================================
// مثال 3: نظام الموظفين مع تعدد الأشكال
// ==========================================
echo "<h2>مثال 3: نظام الموظفين</h2>\n";

class Employee {
    protected $name;
    protected $employeeId;
    protected $salary;
    protected $department;
    
    public function __construct($name, $employeeId, $salary, $department) {
        echo "🏗️ <strong>تم إنشاء موظف جديد:</strong> " . $name . "<br>";
        
        $this->name = $name;
        $this->employeeId = $employeeId;
        $this->salary = $salary;
        $this->department = $department;
        
        echo "✅ <strong>تم تهيئة الموظف بنجاح</strong><br>";
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
    
    // Method Overriding - تعدد الأشكال
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
        $info = parent::getInfo();
        $info .= " - حجم الفريق: " . $this->teamSize;
        $info .= " - المكافأة: " . $this->bonus . " ريال";
        return $info;
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
    
    // Method Overriding - تعدد الأشكال
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
    
    public function debug() {
        return $this->name . " يصلح الأخطاء في الكود";
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
    
    public function __construct($name, $employeeId, $salary, $department, $designTools, $specialization) {
        parent::__construct($name, $employeeId, $salary, $department);
        $this->designTools = $designTools;
        $this->specialization = $specialization;
    }
    
    // Method Overriding - تعدد الأشكال
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
    
    public function createPrototype() {
        return $this->name . " ينشئ نموذجاً أولياً";
    }
    
    public function getInfo() {
        $info = parent::getInfo();
        $info .= " - أدوات التصميم: " . implode(", ", $this->designTools);
        $info .= " - التخصص: " . $this->specialization;
        return $info;
    }
}

// استخدام تعدد الأشكال
echo "<h3>تعدد الأشكال في الموظفين:</h3>\n";

$employees = [
    new Manager("أحمد السعد", "M001", 15000, "التطوير", 8, 3000),
    new Developer("فاطمة محمد", "D001", 12000, "التطوير", ["PHP", "JavaScript", "Python"], 3),
    new Designer("محمد علي", "DS001", 10000, "التصميم", ["Photoshop", "Figma", "Sketch"], "UI/UX")
];

echo "<h4>عرض معلومات الموظفين:</h4>\n";
foreach ($employees as $employee) {
    echo "<strong>" . $employee->getInfo() . "</strong><br>";
    echo $employee->work() . "<br>";
    echo $employee->takeBreak() . "<br>";
    echo $employee->getSalary() . "<br>";
    echo "---<br>";
}

// ==========================================
// مثال 4: محاكاة Method Overloading
// ==========================================
echo "<h2>مثال 4: محاكاة Method Overloading</h2>\n";

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
    
    public function power($base, $exponent = 2) {
        return pow($base, $exponent);
    }
    
    public function calculate($operation, ...$numbers) {
        switch ($operation) {
            case 'add':
                return array_sum($numbers);
            case 'multiply':
                return array_product($numbers);
            case 'average':
                return array_sum($numbers) / count($numbers);
            default:
                return "عملية غير مدعومة";
        }
    }
}

// استخدام محاكاة Method Overloading
echo "<h3>محاكاة Method Overloading:</h3>\n";

$calc = new Calculator();

echo "<h4>عمليات الجمع:</h4>\n";
echo "5 = " . $calc->add(5) . "<br>";
echo "5 + 3 = " . $calc->add(5, 3) . "<br>";
echo "5 + 3 + 2 = " . $calc->add(5, 3, 2) . "<br>";

echo "<h4>عمليات الضرب:</h4>\n";
echo "5 = " . $calc->multiply(5) . "<br>";
echo "5 × 3 = " . $calc->multiply(5, 3) . "<br>";
echo "5 × 3 × 2 = " . $calc->multiply(5, 3, 2) . "<br>";

echo "<h4>عمليات القوة:</h4>\n";
echo "2^2 = " . $calc->power(2) . "<br>";
echo "2^3 = " . $calc->power(2, 3) . "<br>";
echo "3^4 = " . $calc->power(3, 4) . "<br>";

echo "<h4>عمليات متقدمة:</h4>\n";
echo "جمع: " . $calc->calculate('add', 1, 2, 3, 4, 5) . "<br>";
echo "ضرب: " . $calc->calculate('multiply', 2, 3, 4) . "<br>";
echo "متوسط: " . $calc->calculate('average', 10, 20, 30, 40) . "<br>";

// ==========================================
// خلاصة المحاضرة
// ==========================================
echo "<hr>";
echo "<h2>🎯 خلاصة المحاضرة</h2>";
echo "<div style='background-color: #f0f8ff; padding: 20px; border-radius: 10px;'>";
echo "<h3>ما تعلمناه:</h3>";
echo "<ul>";
echo "<li><strong>تعدد الأشكال (Polymorphism):</strong> نفس الرسالة تستجيب بطرق مختلفة</li>";
echo "<li><strong>Method Overriding:</strong> إعادة تعريف الطريقة في الكلاس الموروث</li>";
echo "<li><strong>Method Overloading:</strong> محاكاة باستخدام معاملات افتراضية</li>";
echo "<li><strong>مرونة الكود:</strong> نفس الكود يعمل مع أنواع مختلفة</li>";
echo "<li><strong>سهولة التوسع:</strong> إضافة أنواع جديدة بسهولة</li>";
echo "<li><strong>إعادة الاستخدام:</strong> استخدام نفس الواجهة</li>";
echo "</ul>";

echo "<h3>أفضل الممارسات:</h3>";
echo "<ul>";
echo "<li>استخدم تعدد الأشكال للواجهات المشتركة</li>";
echo "<li>تجنب Overriding المفرط</li>";
echo "<li>استخدم معاملات افتراضية لمحاكاة Overloading</li>";
echo "<li>وثق الطرق الموروثة</li>";
echo "<li>استخدم أسماء وصفية للطرق</li>";
echo "<li>تجنب التعقيد المفرط</li>";
echo "</ul>";
echo "</div>";
?>

