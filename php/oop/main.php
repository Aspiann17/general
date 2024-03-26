<?php

class Storage {    
    protected $capacity, $write_speed, $read_speed, $cache;

    // Constructor
    public function __construct(int $capacity, int $cache) {
        $this->capacity = $capacity;
        $this->cache = $cache;
    }

    // Getter
    public function __get($property) {
        if (property_exists($this,$property)) {
            return $this->$property;
        }
    }
}


class Hardisk extends Storage {
    public function __construct(int $rpm, int $capacity, int $cache) {


    }
}
class Seagate extends Hardisk {
}
class BarraCuda extends Seagate {

}


$internal  = new Storage(512,2);
$eksternal = new BarraCuda(7200,256,5);


echo $internal->capacity;



// class SSD extends Storage {
// }
// class LTO extends Storage {
// }

echo "\n\n\n\n\n\n\n\n\n\n";