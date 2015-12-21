<?php
namespace Gen;

class Life
{
    private $mutator;
    private $recombine;
    private $generation;

    public function __construct(Mutation $mutator, Recombination $recombine)
    {
        $this->mutator = $mutator;
        $this->recombine = $recombine;
        $this->setGeneration(5000);
    }

    public function setGeneration($generation)
    {
        $this->generation = $generation;
    }

    public function getShortestPath(Roadmap $roadmap)
    {
        $life = new RoadmapHeap();
        $life->insert($roadmap);
        $life->insert($this->mutator->mutate($roadmap));

        for ($i=0; $i<$this->generation; $i++) {
            if (rand(0,10) < 7) {
                $pos = abs($this->rand(0, count($life), 1)-ceil(count($life)/2));
                $pos2 = abs($this->rand(0, count($life), 1)-ceil(count($life)/2));

                list($one, $two) = $this->recombine->reproduction($life[$pos], $life[$pos2]);
                $life->insert($one);
                $life->insert($two);
            } else {
                $pos = abs($this->rand(0, count($life), 1)-ceil(count($life)/2));
                $life->insert($this->mutator->mutate($life[$pos]));
            }
        }

        return $life[0];
    }

    function rand($min,$max,$stdDev,$step=1) {
        $rand1 = (float)mt_rand()/(float)mt_getrandmax();
        $rand2 = (float)mt_rand()/(float)mt_getrandmax();
        $gaussNo = sqrt(-2 * log($rand1)) * cos(2 * M_PI * $rand2);
        $mean = ($max + $min) / 2;
        $randNo = ($gaussNo * $stdDev) + $mean;
        $randNo = round($randNo / $step) * $step;
        if($randNo < $min || $randNo > $max) {
            $randNo = $this->rand($min, $max,$stdDev);
        }
        return $randNo;
    }
}
