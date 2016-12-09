<?php
namespace tests\units\source\docker;

include_once __DIR__ . '/../../../../source/docker/Start.php';

use mageekguy\atoum;

class Start extends atoum
{
    public function testGetUn()
    {
        $this
            ->given($this->newTestedInstance)
            ->dump($this->testedInstance)
            ->then
            ->string($this->testedInstance->get(1))
            ->isIdenticalTo('true')
        ;
    }

    public function testGetVingt()
    {
        $this
            ->given($this->newTestedInstance)
            ->then
            ->string($this->testedInstance->get(20))
            ->isIdenticalTo('false')
        ;
    }
}
