<?php
namespace Gen;

class SortedList implements \ArrayAccess, \Countable
{
    private $data;
    private $position = 0;

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    public function insert($value)
    {
        array_unshift($this->data, $value);

        for ($i=0; $i<count($this)-1; $i++) {
            if ($this->compare($this[$i], $this[$i+1]) < 0) {
                $tmp = $this[$i];
                $this[$i] = $this[$i+1];
                $this[$i+1] = $tmp;
            } else {
                break;
            }
        }
    }

    protected function compare($a, $b)
    {
        if ($a < $b) {
            return 1;
        } else {
            return -1;
        }
    }

    public function count()
    {
        return count($this->data);
    }

    public function offsetExists($offset)
    {
        return array_key_exists($offset, $this->data);
    }

    public function offsetGet($key)
    {
        return $this->data[$key];
    }

    public function offsetSet($key, $value)
    {
        $this->data[$key] = $value;
    }

    public function offsetUnset($key)
    {
        unset($this->data[$key]);
    }
}
