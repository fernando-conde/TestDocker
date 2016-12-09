<?php
include_once __DIR__ . '/../../source/docker/Start.php';

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

use source\docker\Start;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    /** @var Start */
    private $start;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }

    /**
     * @Given je démarre mon projet
     */
    public function jeDemarreMonProjet()
    {
        $this->start = new Start();
    }

    /**
     * @When j'envoie une valeur inférieur à :arg1
     */
    public function jEnvoieUneValeurInferieurA($arg1)
    {
        return 7;
    }

    /**
     * @Then j'obtient :arg1
     */
    public function jObtient($arg1)
    {
        return $this->start->get((int) $arg1);
    }

    /**
     * @When j'envoie une valeur supérieur à :arg1
     */
    public function jEnvoieUneValeurSuperieurA($arg1)
    {
        return 8;
    }
}
