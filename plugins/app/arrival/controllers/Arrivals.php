<?php namespace App\Arrival\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

/**
 * Arrivals Back-end Controller
 */
class Arrivals extends Controller
{
    /**
     * @var array Behaviors that are implemented by this controller.
     */
    public $implement = [
        'Backend.Behaviors.FormController', // Behavior for handling single record form
        'Backend.Behaviors.ListController'  // Behavior for handling lists of records
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

        // Set the backend menu context
        BackendMenu::setContext('App.Arrival', 'arrival', 'arrivals');
        // The 'App.Arrival' is the plugin code, 'arrival' is the main menu code, and 'arrivals' is the side menu code.
    }
}