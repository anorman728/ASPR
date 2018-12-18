<?php
namespace App;

/**
 * This is a sample controller.
 *
 * @author  Andrew Norman
 */
class SampleController extends AbstractController
{
    /**
     * This is a sample GET method.
     *
     * @return  void
     */
    public function home()
    {
        print_r("<p>This is the home page.  I'm printing this using the
        \"print_r\" command, but I could just as easily use \"include_once\" to
        reference a .php or .html file, bearing in mind that any variable I set
        would be available in whatever file I include.</p>");
        $exampleVar = "this paragraph";
        include_once(__DIR__ . '/SampleView/homepage.php');
        print_r("<p>Better yet, I could design View classes to handle displaying
        output.</p>");
    }

    /**
     * Demonstration of using templates with a layout.
     *
     * @return  void
     */
    public function templateDemo()
    {
        $layoutVars = [
            'page-heading' => 'ASPR Template and Layout Demonstration',
        ];
        $this->setLayoutVars($layoutVars);
            // This sets variables to be used in the layout.  (You'd likely want
            // to set this in a constructor, depending on the situation.)

        // The layout itself can be changed by using the setLayout function.

        $vars = ['demovar' => 'Templates'];
            // This is referenced in the template_demo template.

        $body = $this->pullView('/SampleView/template_demo', $vars);
            // This pulls from App/SampleView/template_demo.php for the template.

        $this->printToLayout($body);
            // This places the values pulled from the template into the layout
            // and prints the whole thing out.
    }

    /**
     * This is a sample POST method.
     *
     * @return  void
     */
    public function postMethod()
    {
        print_r("<p>This method can only be reached using a POST method, so just
        typing it into a browser won't work.</p>");

        print_r("<p>This is the information that came along with the POST
        request:</p>");

        print_r("<pre>");
        print_r($this->getMethodArgs());
        print_r("</pre>");

        print_r("<p>I got this information using the \$this->getMethodArgs()
        function in the controller.  It also works for GET parameters.</p>");
    }

    /**
     * This action takes an argument that's passed from the URL itself.
     *
     * @param   string  $arg
     * @return  void
     */
    public function usingAnArgument($arg)
    {
        print_r("It looks like you passed \"$arg\" into the URL bar.");
    }

    /**
     * This action logs a value.
     *
     * @return  void
     */
    public function loggingSomething()
    {
        print_r("<p>This function uses the logIt function to add to the"
        . " plaintext log in the root directory.  You can look into the log"
        . " file in the root directory to see what's logged.</p>");
        print_r("<p>This is useful for debugging.</p>");

        // The logIt
        $valueToLog = 'This is a logged value.';
        logIt($valueToLog, 'logged value');
    }

}
