<?php
namespace Test;

use App\SampleController;
use PHPUnit\Framework\TestCase;
use Test\TestingTraits\ControllerTestingTrait;

/**
 * Test for SampleController.
 *
 * @author  Andrew Norman
 */
class SampleControllerTest extends TestCase
{
    use ControllerTestingTrait;

    /** @var App\SampleController Sample controller object. */
    private $sampleController;

    /**
     * Setup method.
     *
     * @return  void
     */
    public function setUp()
    {
        $this->sampleController = new SampleController();
    }

    /**
     * This is an example testing the home action.
     *
     * @return  void
     */
    public function testHome()
    {
        // This function lets you build and extract the page's html into a
        // string.
        $html = $this->getHtml($this->sampleController, 'home');

        $this->assertRegexp(
            '/include_once.*View/s', // I keep forgetting that stupid "s" flag.
            $html,
            'Asserting that some values are found in the html.'
        );
    }

    /**
     * This is an example testing an action with an argument.
     *
     * @return  void
     */
    public function testUsingAnArgument()
    {
        // You can pass arguments to the controller action via an array.
        $html = $this->getHtml(
            $this->sampleController,
            'usingAnArgument',
            ['my argument']
        );

        $this->assertContains(
            'you passed "my argument"',
            $html,
            'Asserting that argument is returned in page html.'
        );
    }
}
