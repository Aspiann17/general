<?php
abstract class Storage {
    private $price, $capacity,
            $write_speed, $read_speed,
            $cache, $lifetime, $socket;

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
    private $rpm, $size,
            $max_bandwith = 6000, //Mbps
            $socket = "SATA";

    public function __construct(int $capacity, int $cache, int $rpm, float $size) {
        if (!in_array($size, [2.5,3.5])) {
            throw new InvalidArgumentException("HDD size must be 2.5 or 3.5!");
        }

        parent::__construct($capacity,$cache);
        $this->rpm = $rpm;
        $this->size = $size;
    }
}

class SSD extends Storage {
    private const SOCKET = [
        "SATA", "mSATA", "M.2 SATA", "M.2 NVMe"
    ];
    private $tbw, $socket;

    public function __construct(int $capacity, int $cache, string $socket) {
        if (!in_array($socket, self::SOCKET)) {
            throw new InvalidArgumentException(sprintf("Socket must be %s", implode(', ', self::SOCKET)));
        }
        parent::__construct($capacity, $cache);
        $this->socket = $socket;
    }
}

$disk2 = new Hardisk(256,5,7200,2.5);
$disk2 = new SSD(128,5,"SATA");


// class LTO extends Storage {
// }
echo "\n";