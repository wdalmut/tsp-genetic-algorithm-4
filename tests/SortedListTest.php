<?php
namespace Gen;

class SortedListTest extends \PHPUnit_Framework_TestCase
{
    public function testInsert()
    {
        $s = new SortedList();
        $s->insert(5);
        $s->insert(4);
        $s->insert(10);
        $s->insert(7);

        $this->assertEquals(4, $s[0]);
        $this->assertEquals(5, $s[1]);
        $this->assertEquals(7, $s[2]);
        $this->assertEquals(10, $s[3]);
    }

    public function testCount()
    {
        $s = new SortedList();
        $s->insert(5);
        $s->insert(4);
        $s->insert(10);
        $s->insert(7);

        $this->assertCount(4, $s);
    }
}
