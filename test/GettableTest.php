<?php

namespace ConorSmith\Dublinbikes\Test;

use ConorSmith\Dublinbikes\Gettable;

class GettableTest extends \PHPUnit_Framework_TestCase
{
    private $object;

    public function setUp()
    {
        $this->object = new ConcreteGettable;
    }
    /**
     * @test
     */
    public function itCanGetAPrivateAttribute()
    {
        $this->object->privateAttribute;
    }

    /**
     * @test
     */
    public function itCanGetAProtectedAttribute()
    {
        $this->object->protectedAttribute;
    }

    /**
     * @test
     */
    public function itCannotGetAnAttributeThatDoesntExist()
    {
        $this->setExpectedException('RuntimeException');

        $this->object->notAnAttribute;
    }
}

class ConcreteGettable
{
    use Gettable;

    private $privateAttribute;
    protected $protectedAttribute;
}
