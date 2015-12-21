<?php
namespace Gen;

class Roadmap
{
    public $places;
    public $cache;

    public function __construct(array $places)
    {
        $this->places = $places;
        $this->cache = false;
    }

    public function getPlaces()
    {
        return $this->places;
    }

    public function distance()
    {
        if ($this->cache) {
            return $this->cache;
        }

        $distance = 0;

        for ($i=0; $i<count($this->places)-1; $i++) {
            $distance += Distance::between($this->places[$i]->point, $this->places[$i+1]->point);
        }

        $this->cache = $distance;

        return $distance;
    }

    public function __clone()
    {
        $r = parent::__clone();
        $r->cache = false;

        return $r;
    }
}
