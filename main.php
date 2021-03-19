<?php

$animalsList = array (
	"Корова" => 10,
	"Курица" => 20
);

abstract class Animal {
	public $minimum;
	public $maximum;
	public $product;
	public function produce () { return rand ( $this -> minimum, $this -> maximum ); }
}

class Cow extends Animal { // Класс коровы
	function __construct () {
		$this -> minimum = 8;
		$this -> maximum = 12;
		$this -> product = "Молоко";
	}
}

class Chicken extends Animal { // Класс курицы
	function __construct () {
		$this -> minimum = 0;
		$this -> maximum = 1;
		$this -> product = "Яйцо";
	}
}

class Util {
	public function MakeAnimal ( $animal ) { // Создание животного
		switch ( $animal ) {
			case "Корова":
				return new Cow ();
				break;
			case "Курица":
				return new Chicken ();
				break;
			default:
				return false;
		}
	}
	public function addAllAnimals ( $farm, $animalsList ) { // Создание сразу нескольких животных
		foreach( $animalsList as $index => $value ) {
			for ( $i = 0; $i < $value; $i++ ) $farm -> addAnimal ( $index );
		}
	}
}

class Farm {
	private $animals = array (); // Массив с животными
	public function addAnimal ( $animal ) { // Добавление/регистрация животного
		$result = Util::MakeAnimal ( $animal );
		if ( gettype ( $result ) == "object" ) {
			if ( $this -> animals[$animal] ) {
				array_push ( $this -> animals[$animal], $result );
			} else {
				$this -> animals[$animal] = array ();
				array_push ( $this -> animals[$animal], $result );
			}
		}
	}
	private function getAllTypesAnimals () { // Получение всех типов животных
		$keys = array ();
		foreach( $this -> animals as $index => $value ) array_push ( $keys, $index );
		return $keys;
	}
	public function collecting () { // Сбор продукции
		$animalTypes = $this -> getAllTypesAnimals ();
		foreach( $animalTypes as $index => $animalName ) {
			$count = 0;
			foreach( $this -> animals[$animalName] as $index => $value ) {
				$produce = $value -> produce ();
				$count += $produce;
				echo $animalName . " #" . $index . " произвела " . $value -> product . " кол-во: " . $produce . "</br>";
			}
			echo "</br>";
			echo "Итог: " . $count . "</br>";
			echo "</br>";
		}
	}
}

$farm = new Farm ();
Util::addAllAnimals ( $farm, $animalsList ); // Множественный вариант
// $farm -> addAnimal ("Курица"); Единичный вариант
$farm -> collecting (); // Сбор продукции

?>