<?php namespace Teamgrid\Project\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

/**
 * Projects Back-end Controller
 */
class Projects extends Controller
{
    /**
     * @var array Behaviors that are implemented by this controller.
     */
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    /**
     * @var string Configuration file for the `FormController` behavior.
     */
    public $formConfig = 'config_form.yaml';

    /**
     * @var string Configuration file for the `ListController` behavior.
     */
    public $listConfig = 'config_list.yaml';

    /**
     * Constructor method.
     */
    public function __construct()
    {
        parent::__construct();

        // Set the active menu context
        BackendMenu::setContext('Teamgrid.Project', 'project', 'projects');
    }
}