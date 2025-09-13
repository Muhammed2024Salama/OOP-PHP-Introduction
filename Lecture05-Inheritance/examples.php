<?php
/**
 * المحاضرة الخامسة: أمثلة على الوراثة (Inheritance)
 * 
 * هذا الملف يحتوي على أمثلة متنوعة لشرح مفهوم الوراثة
 */

echo "<h1>المحاضرة الخامسة: الوراثة (Inheritance)</h1>\n";

// ==========================================
// مثال 1: نظام الحيوانات
// ==========================================
echo "<h2>مثال 1: نظام الحيوانات</h2>\n";

class Animal {
    protected $name;
    protected $age;
    protected $species;
    protected $isAlive;
    
    public function __construct($name, $age, $species) {
        echo "🏗️ <strong>تم إنشاء حيوان جديد:</strong> " . $name . "<br>";
        
        $this->name = $name;
        $this->age = $age;
        $this->species = $species;
        $this->isAlive = true;
        
        echo "✅ <strong>تم تهيئة الحيوان بنجاح</strong><br>";
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
        $info = "<strong>الاسم:</strong> " . $this->name . "<br>";
        $info .= "<strong>العمر:</strong> " . $this->age . "<br>";
        $info .= "<strong>النوع:</strong> " . $this->species . "<br>";
        $info .= "<strong>الحالة:</strong> " . ($this->isAlive ? "حي" : "ميت");
        return $info;
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function getAge() {
        return $this->age;
    }
    
    public function getSpecies() {
        return $this->species;
    }
}

class Dog extends Animal {
    private $breed;
    private $isTrained;
    private $tricks;
    
    public function __construct($name, $age, $breed, $isTrained = false) {
        parent::__construct($name, $age, "كلب");
        $this->breed = $breed;
        $this->isTrained = $isTrained;
        $this->tricks = [];
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
    
    public function learnTrick($trick) {
        $this->tricks[] = $trick;
        return $this->name . " تعلم خدعة جديدة: " . $trick;
    }
    
    public function performTrick($trick) {
        if (in_array($trick, $this->tricks)) {
            return $this->name . " يؤدي خدعة: " . $trick;
        }
        return $this->name . " لا يعرف خدعة: " . $trick;
    }
    
    public function getInfo() {
        $info = parent::getInfo();
        $info .= "<br><strong>السلالة:</strong> " . $this->breed;
        $info .= "<br><strong>مدرب:</strong> " . ($this->isTrained ? "نعم" : "لا");
        $info .= "<br><strong>الخدع:</strong> " . implode(", ", $this->tricks);
        return $info;
    }
    
    public function getBreed() {
        return $this->breed;
    }
    
    public function isTrained() {
        return $this->isTrained;
    }
}

class Cat extends Animal {
    private $color;
    private $isIndoor;
    private $lives;
    
    public function __construct($name, $age, $color, $isIndoor = true) {
        parent::__construct($name, $age, "قطة");
        $this->color = $color;
        $this->isIndoor = $isIndoor;
        $this->lives = 9;
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
    
    public function hunt() {
        if (!$this->isIndoor) {
            return $this->name . " يصطاد فريسة";
        }
        return $this->name . " لا يصطاد (قطة داخلية)";
    }
    
    public function loseLife() {
        if ($this->lives > 0) {
            $this->lives--;
            return $this->name . " فقد حياة - المتبقي: " . $this->lives;
        }
        return $this->name . " لا يملك حيوات متبقية";
    }
    
    public function getInfo() {
        $info = parent::getInfo();
        $info .= "<br><strong>اللون:</strong> " . $this->color;
        $info .= "<br><strong>داخلي:</strong> " . ($this->isIndoor ? "نعم" : "لا");
        $info .= "<br><strong>الحيوات:</strong> " . $this->lives;
        return $info;
    }
    
    public function getColor() {
        return $this->color;
    }
    
    public function isIndoor() {
        return $this->isIndoor;
    }
    
    public function getLives() {
        return $this->lives;
    }
}

class Bird extends Animal {
    private $canFly;
    private $wingspan;
    private $migrationDistance;
    
    public function __construct($name, $age, $canFly, $wingspan, $migrationDistance = 0) {
        parent::__construct($name, $age, "طائر");
        $this->canFly = $canFly;
        $this->wingspan = $wingspan;
        $this->migrationDistance = $migrationDistance;
    }
    
    public function makeSound() {
        return $this->name . " يغرد";
    }
    
    public function fly() {
        if ($this->canFly) {
            return $this->name . " يطير";
        }
        return $this->name . " لا يستطيع الطيران";
    }
    
    public function migrate() {
        if ($this->migrationDistance > 0) {
            return $this->name . " يهاجر مسافة " . $this->migrationDistance . " كم";
        }
        return $this->name . " لا يهاجر";
    }
    
    public function buildNest() {
        return $this->name . " يبني عشاً";
    }
    
    public function getInfo() {
        $info = parent::getInfo();
        $info .= "<br><strong>يطير:</strong> " . ($this->canFly ? "نعم" : "لا");
        $info .= "<br><strong>طول الجناح:</strong> " . $this->wingspan . " سم";
        $info .= "<br><strong>مسافة الهجرة:</strong> " . $this->migrationDistance . " كم";
        return $info;
    }
    
    public function canFly() {
        return $this->canFly;
    }
    
    public function getWingspan() {
        return $this->wingspan;
    }
}

// استخدام الكلاسات
echo "<h3>إنشاء حيوانات:</h3>\n";

$dog = new Dog("ريكس", 3, "جيرمن شيبرد", true);
$cat = new Cat("ميمي", 2, "أبيض", true);
$bird = new Bird("تويتر", 1, true, 25, 1000);

echo "<h4>الكلب:</h4>\n";
echo $dog->getInfo() . "<br><br>";
echo $dog->makeSound() . "<br>";
echo $dog->fetch() . "<br>";
echo $dog->sit() . "<br>";
echo $dog->learnTrick("دوران") . "<br>";
echo $dog->performTrick("دوران") . "<br><br>";

echo "<h4>القطة:</h4>\n";
echo $cat->getInfo() . "<br><br>";
echo $cat->makeSound() . "<br>";
echo $cat->purr() . "<br>";
echo $cat->climb() . "<br>";
echo $cat->hunt() . "<br>";
echo $cat->loseLife() . "<br><br>";

echo "<h4>الطائر:</h4>\n";
echo $bird->getInfo() . "<br><br>";
echo $bird->makeSound() . "<br>";
echo $bird->fly() . "<br>";
echo $bird->migrate() . "<br>";
echo $bird->buildNest() . "<br><br>";

// ==========================================
// مثال 2: نظام المركبات
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
    
    public function addFuel($amount) {
        $this->fuel += $amount;
        return "تم إضافة " . $amount . " لتر - الوقود الحالي: " . $this->fuel;
    }
    
    public function drive($distance) {
        if ($this->isRunning) {
            $fuelNeeded = $distance / 10; // كل 10 كم يحتاج لتر واحد
            if ($this->fuel >= $fuelNeeded) {
                $this->fuel -= $fuelNeeded;
                $this->mileage += $distance;
                return "تم السير " . $distance . " كم - الوقود المتبقي: " . $this->fuel . " لتر";
            }
            return "لا يوجد وقود كافي";
        }
        return "يجب تشغيل المركبة أولاً";
    }
    
    public function getInfo() {
        $info = "<strong>المركبة:</strong> " . $this->brand . " " . $this->model . "<br>";
        $info .= "<strong>السنة:</strong> " . $this->year . "<br>";
        $info .= "<strong>الوقود:</strong> " . $this->fuel . " لتر<br>";
        $info .= "<strong>المسافة المقطوعة:</strong> " . $this->mileage . " كم<br>";
        $info .= "<strong>الحالة:</strong> " . ($this->isRunning ? "تعمل" : "متوقفة");
        return $info;
    }
    
    public function getBrand() {
        return $this->brand;
    }
    
    public function getModel() {
        return $this->model;
    }
    
    public function getYear() {
        return $this->year;
    }
    
    public function getMileage() {
        return $this->mileage;
    }
}

class Car extends Vehicle {
    private $doors;
    private $seats;
    private $hasAirConditioning;
    private $hasSunroof;
    
    public function __construct($brand, $model, $year, $doors, $seats, $hasAirConditioning = true, $hasSunroof = false) {
        parent::__construct($brand, $model, $year);
        $this->doors = $doors;
        $this->seats = $seats;
        $this->hasAirConditioning = $hasAirConditioning;
        $this->hasSunroof = $hasSunroof;
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
    
    public function openSunroof() {
        if ($this->hasSunroof) {
            return "تم فتح السقف الشمسي في " . $this->brand . " " . $this->model;
        }
        return "هذه السيارة لا تحتوي على سقف شمسي";
    }
    
    public function getInfo() {
        $info = parent::getInfo();
        $info .= "<br><strong>الأبواب:</strong> " . $this->doors;
        $info .= "<br><strong>المقاعد:</strong> " . $this->seats;
        $info .= "<br><strong>تكييف:</strong> " . ($this->hasAirConditioning ? "نعم" : "لا");
        $info .= "<br><strong>سقف شمسي:</strong> " . ($this->hasSunroof ? "نعم" : "لا");
        return $info;
    }
    
    public function getDoors() {
        return $this->doors;
    }
    
    public function getSeats() {
        return $this->seats;
    }
}

class Motorcycle extends Vehicle {
    private $hasWindshield;
    private $engineSize;
    private $hasSidecar;
    
    public function __construct($brand, $model, $year, $hasWindshield, $engineSize, $hasSidecar = false) {
        parent::__construct($brand, $model, $year);
        $this->hasWindshield = $hasWindshield;
        $this->engineSize = $engineSize;
        $this->hasSidecar = $hasSidecar;
    }
    
    public function wheelie() {
        return "تم رفع العجلة الأمامية للدراجة " . $this->brand . " " . $this->model;
    }
    
    public function revEngine() {
        return "تم تشغيل محرك " . $this->engineSize . "cc";
    }
    
    public function lean() {
        return "تم إمالة الدراجة " . $this->brand . " " . $this->model . " في المنعطف";
    }
    
    public function getInfo() {
        $info = parent::getInfo();
        $info .= "<br><strong>واقي الرياح:</strong> " . ($this->hasWindshield ? "نعم" : "لا");
        $info .= "<br><strong>حجم المحرك:</strong> " . $this->engineSize . "cc";
        $info .= "<br><strong>عربة جانبية:</strong> " . ($this->hasSidecar ? "نعم" : "لا");
        return $info;
    }
    
    public function getEngineSize() {
        return $this->engineSize;
    }
    
    public function hasWindshield() {
        return $this->hasWindshield;
    }
}

class Truck extends Vehicle {
    private $cargoCapacity;
    private $hasTrailer;
    private $towingCapacity;
    
    public function __construct($brand, $model, $year, $cargoCapacity, $hasTrailer = false, $towingCapacity = 0) {
        parent::__construct($brand, $model, $year);
        $this->cargoCapacity = $cargoCapacity;
        $this->hasTrailer = $hasTrailer;
        $this->towingCapacity = $towingCapacity;
    }
    
    public function loadCargo($weight) {
        if ($weight <= $this->cargoCapacity) {
            return "تم تحميل " . $weight . " كيلو في " . $this->brand . " " . $this->model;
        }
        return "الوزن يتجاوز السعة القصوى (" . $this->cargoCapacity . " كيلو)";
    }
    
    public function attachTrailer() {
        if ($this->hasTrailer) {
            return "تم ربط المقطورة بـ " . $this->brand . " " . $this->model;
        }
        return "هذه الشاحنة لا تدعم المقطورة";
    }
    
    public function tow($weight) {
        if ($weight <= $this->towingCapacity) {
            return "تم سحب " . $weight . " كيلو بـ " . $this->brand . " " . $this->model;
        }
        return "الوزن يتجاوز قدرة السحب (" . $this->towingCapacity . " كيلو)";
    }
    
    public function getInfo() {
        $info = parent::getInfo();
        $info .= "<br><strong>سعة الشحن:</strong> " . $this->cargoCapacity . " كيلو";
        $info .= "<br><strong>مقطورة:</strong> " . ($this->hasTrailer ? "نعم" : "لا");
        $info .= "<br><strong>قدرة السحب:</strong> " . $this->towingCapacity . " كيلو";
        return $info;
    }
    
    public function getCargoCapacity() {
        return $this->cargoCapacity;
    }
    
    public function getTowingCapacity() {
        return $this->towingCapacity;
    }
}

// استخدام الكلاسات
echo "<h3>إنشاء مركبات:</h3>\n";

$car = new Car("تويوتا", "كامري", 2020, 4, 5, true, true);
$motorcycle = new Motorcycle("هوندا", "CBR", 2019, true, 600, false);
$truck = new Truck("فورد", "F-150", 2021, 1000, true, 5000);

echo "<h4>السيارة:</h4>\n";
echo $car->getInfo() . "<br><br>";
echo $car->start() . "<br>";
echo $car->openTrunk() . "<br>";
echo $car->turnOnAC() . "<br>";
echo $car->openSunroof() . "<br>";
echo $car->drive(50) . "<br><br>";

echo "<h4>الدراجة النارية:</h4>\n";
echo $motorcycle->getInfo() . "<br><br>";
echo $motorcycle->start() . "<br>";
echo $motorcycle->wheelie() . "<br>";
echo $motorcycle->revEngine() . "<br>";
echo $motorcycle->lean() . "<br>";
echo $motorcycle->drive(30) . "<br><br>";

echo "<h4>الشاحنة:</h4>\n";
echo $truck->getInfo() . "<br><br>";
echo $truck->start() . "<br>";
echo $truck->loadCargo(500) . "<br>";
echo $truck->attachTrailer() . "<br>";
echo $truck->tow(2000) . "<br>";
echo $truck->drive(100) . "<br><br>";

// ==========================================
// مثال 3: نظام الموظفين
// ==========================================
echo "<h2>مثال 3: نظام الموظفين</h2>\n";

class Employee {
    protected $name;
    protected $employeeId;
    protected $salary;
    protected $department;
    protected $hireDate;
    protected $isActive;
    
    public function __construct($name, $employeeId, $salary, $department, $hireDate) {
        echo "🏗️ <strong>تم إنشاء موظف جديد:</strong> " . $name . "<br>";
        
        $this->name = $name;
        $this->employeeId = $employeeId;
        $this->salary = $salary;
        $this->department = $department;
        $this->hireDate = $hireDate;
        $this->isActive = true;
        
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
    
    public function promote($newSalary) {
        $oldSalary = $this->salary;
        $this->salary = $newSalary;
        return $this->name . " تم ترقيته - الراتب الجديد: " . $newSalary . " ريال (كان: " . $oldSalary . " ريال)";
    }
    
    public function getInfo() {
        $info = "<strong>الاسم:</strong> " . $this->name . "<br>";
        $info .= "<strong>رقم الموظف:</strong> " . $this->employeeId . "<br>";
        $info .= "<strong>القسم:</strong> " . $this->department . "<br>";
        $info .= "<strong>تاريخ التوظيف:</strong> " . $this->hireDate . "<br>";
        $info .= "<strong>الحالة:</strong> " . ($this->isActive ? "نشط" : "غير نشط");
        return $info;
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function getEmployeeId() {
        return $this->employeeId;
    }
    
    public function getDepartment() {
        return $this->department;
    }
}

class Manager extends Employee {
    private $teamSize;
    private $bonus;
    private $teamMembers;
    
    public function __construct($name, $employeeId, $salary, $department, $hireDate, $teamSize, $bonus = 0) {
        parent::__construct($name, $employeeId, $salary, $department, $hireDate);
        $this->teamSize = $teamSize;
        $this->bonus = $bonus;
        $this->teamMembers = [];
    }
    
    public function manageTeam() {
        return $this->name . " يدير فريق من " . $this->teamSize . " موظف";
    }
    
    public function holdMeeting() {
        return $this->name . " يعقد اجتماعاً مع الفريق";
    }
    
    public function addTeamMember($member) {
        $this->teamMembers[] = $member;
        return $this->name . " أضاف " . $member . " إلى الفريق";
    }
    
    public function getSalary() {
        $totalSalary = $this->salary + $this->bonus;
        return $this->name . " الراتب الإجمالي: " . $totalSalary . " ريال (راتب: " . $this->salary . " + مكافأة: " . $this->bonus . ")";
    }
    
    public function getInfo() {
        $info = parent::getInfo();
        $info .= "<br><strong>حجم الفريق:</strong> " . $this->teamSize;
        $info .= "<br><strong>المكافأة:</strong> " . $this->bonus . " ريال";
        $info .= "<br><strong>أعضاء الفريق:</strong> " . implode(", ", $this->teamMembers);
        return $info;
    }
    
    public function getTeamSize() {
        return $this->teamSize;
    }
    
    public function getBonus() {
        return $this->bonus;
    }
}

class Developer extends Employee {
    private $programmingLanguages;
    private $experience;
    private $projects;
    
    public function __construct($name, $employeeId, $salary, $department, $hireDate, $programmingLanguages, $experience) {
        parent::__construct($name, $employeeId, $salary, $department, $hireDate);
        $this->programmingLanguages = $programmingLanguages;
        $this->experience = $experience;
        $this->projects = [];
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
    
    public function addProject($project) {
        $this->projects[] = $project;
        return $this->name . " أضاف مشروع جديد: " . $project;
    }
    
    public function getInfo() {
        $info = parent::getInfo();
        $info .= "<br><strong>لغات البرمجة:</strong> " . implode(", ", $this->programmingLanguages);
        $info .= "<br><strong>الخبرة:</strong> " . $this->experience . " سنوات";
        $info .= "<br><strong>المشاريع:</strong> " . implode(", ", $this->projects);
        return $info;
    }
    
    public function getProgrammingLanguages() {
        return $this->programmingLanguages;
    }
    
    public function getExperience() {
        return $this->experience;
    }
}

class Designer extends Employee {
    private $designTools;
    private $specialization;
    private $portfolio;
    
    public function __construct($name, $employeeId, $salary, $department, $hireDate, $designTools, $specialization) {
        parent::__construct($name, $employeeId, $salary, $department, $hireDate);
        $this->designTools = $designTools;
        $this->specialization = $specialization;
        $this->portfolio = [];
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
    
    public function addToPortfolio($work) {
        $this->portfolio[] = $work;
        return $this->name . " أضاف عملاً جديداً للمحفظة: " . $work;
    }
    
    public function getInfo() {
        $info = parent::getInfo();
        $info .= "<br><strong>أدوات التصميم:</strong> " . implode(", ", $this->designTools);
        $info .= "<br><strong>التخصص:</strong> " . $this->specialization;
        $info .= "<br><strong>المحفظة:</strong> " . implode(", ", $this->portfolio);
        return $info;
    }
    
    public function getDesignTools() {
        return $this->designTools;
    }
    
    public function getSpecialization() {
        return $this->specialization;
    }
}

// استخدام الكلاسات
echo "<h3>إنشاء موظفين:</h3>\n";

$manager = new Manager("أحمد السعد", "M001", 15000, "التطوير", "2020-01-15", 8, 3000);
$developer = new Developer("فاطمة محمد", "D001", 12000, "التطوير", "2021-03-20", ["PHP", "JavaScript", "Python"], 3);
$designer = new Designer("محمد علي", "DS001", 10000, "التصميم", "2021-06-10", ["Photoshop", "Figma", "Sketch"], "UI/UX");

echo "<h4>المدير:</h4>\n";
echo $manager->getInfo() . "<br><br>";
echo $manager->work() . "<br>";
echo $manager->manageTeam() . "<br>";
echo $manager->holdMeeting() . "<br>";
echo $manager->addTeamMember("فاطمة") . "<br>";
echo $manager->addTeamMember("محمد") . "<br>";
echo $manager->getSalary() . "<br><br>";

echo "<h4>المطور:</h4>\n";
echo $developer->getInfo() . "<br><br>";
echo $developer->work() . "<br>";
echo $developer->code() . "<br>";
echo $developer->debug() . "<br>";
echo $developer->attendMeeting() . "<br>";
echo $developer->addProject("موقع إلكتروني") . "<br>";
echo $developer->addProject("تطبيق جوال") . "<br>";
echo $developer->getSalary() . "<br><br>";

echo "<h4>المصمم:</h4>\n";
echo $designer->getInfo() . "<br><br>";
echo $designer->work() . "<br>";
echo $designer->design() . "<br>";
echo $designer->createPrototype() . "<br>";
echo $designer->presentDesign() . "<br>";
echo $designer->addToPortfolio("تصميم شعار") . "<br>";
echo $designer->addToPortfolio("تصميم واجهة") . "<br>";
echo $designer->getSalary() . "<br><br>";

// ==========================================
// خلاصة المحاضرة
// ==========================================
echo "<hr>";
echo "<h2>🎯 خلاصة المحاضرة</h2>";
echo "<div style='background-color: #f0f8ff; padding: 20px; border-radius: 10px;'>";
echo "<h3>ما تعلمناه:</h3>";
echo "<ul>";
echo "<li><strong>الوراثة (Inheritance):</strong> تسمح للكلاس بوراثة الخصائص والطرق من كلاس آخر</li>";
echo "<li><strong>extends:</strong> الكلمة المفتاحية لإنشاء الوراثة</li>";
echo "<li><strong>parent:</strong> للوصول إلى الكلاس الأساسي</li>";
echo "<li><strong>إعادة الاستخدام:</strong> استخدام الكود الموجود دون إعادة كتابته</li>";
echo "<li><strong>التوسع:</strong> إضافة ميزات جديدة للكلاسات الموروثة</li>";
echo "<li><strong>التنظيم:</strong> تنظيم الكود بشكل هرمي</li>";
echo "</ul>";

echo "<h3>أفضل الممارسات:</h3>";
echo "<ul>";
echo "<li>استخدم الوراثة للعلاقات الحقيقية بين الكائنات</li>";
echo "<li>تجنب الوراثة العميقة لسهولة الصيانة</li>";
echo "<li>استخدم protected للخصائص المشتركة</li>";
echo "<li>استدعِ parent constructor في الكلاسات الموروثة</li>";
echo "<li>تجنب الوراثة المفرطة</li>";
echo "<li>استخدم أسماء وصفية للكلاسات</li>";
echo "</ul>";
echo "</div>";
?>


