<?php
namespace Gen;

class RoadmapHeap extends SortedList
{
    protected function compare($value1, $value2)
    {
        if ($value1->distance() < $value2->distance()) {
            return 1;
        } else {
            return -1;
        }
    }
}
