<?php
namespace Test\TestingTraits;

use App\AbstractController;

/**
 * Traits used for testing controllers.
 *
 * @author  Andrew Norman
 */
trait ControllerTestingTrait
{
    /**
     * Get the raw html result from a controller.
     *
     * @param   App\AbstractController  $controller
     *  Instance of a child class of AbstractController.
     * @param   string                  $actionName
     *  String of name of action.
     * @param   array                   $args
     *  Arguments to pass to controller, if there are any.
     * @return  string
     */
    private function getHtml(
        AbstractController $controller,
        string $actionName,
        array $args = []
    ): string {
        ob_start();
        call_user_func_array([$controller, $actionName], $args);
        return ob_get_clean();
    }
}
