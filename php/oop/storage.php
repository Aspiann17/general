<?php
abstract class Storage {    
    protected $price, $capacity, $write_speed, $read_speed, $cache, $lifetime;

    public function __construct(int $capacity, int $cache) {
        $this->capacity = $capacity;
        $this->cache = $cache;
        $this->lifetime = 0;
    }

    public function __get($property) {
        return $this->$property;
    }
}

class Hardisk extends Storage {
    protected $rpm, $size;

    public function __construct(int $capacity, int $cache, int $rpm, float $size) {
        if ($size !== 2.5 && $size !== 3.5) {
            throw new InvalidArgumentException("HDD size must be 2.5 or 3.5!");
        }

        parent::__construct($capacity,$cache);
        $this->rpm = $rpm;
        $this->size = $size;
    }
}

$disk2 = new Hardisk(256,5,7200,2.5);

var_dump($disk2->price);


// class SSD extends Storage {
    // public $tbw;
// }
// class LTO extends Storage {
// }

// SSD -> Sata:Nvme
// M.2 -> Sata:Nvme
echo "\n";