<?php

namespace Teamgrid\Project\Models;

use Model;
use Rainlab\User\Models\User;
use Teamgrid\Task\Models\Task;

/**
 * Project Model
 */
class Project extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var array Belongs-to relationships
     */
    public $belongsTo = [
        'projectManager' => [User::class], // Use imported User model
        'customer' => [User::class], // Use imported User model
    ];
    
    /**
     * @var array Has-many relationships
     */
    public $hasMany = [
        'tasks' => [Task::class], // Use imported Task model
        'accountingPeople' => [User::class], // Use imported User model
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'teamgrid_project_projects';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Validation rules for attributes
     */
    public $rules = [
        'name' => 'required',
    ];

    /**
     * @var array Attributes to be cast to native types
     */
    protected $casts = [];

    /**
     * @var array Attributes to be cast to JSON
     */
    protected $jsonable = [];

    /**
     * @var array Attributes to be appended to the API representation of the model (ex. toArray())
     */
    protected $appends = [];

    /**
     * @var array Attributes to be removed from the API representation of the model (ex. toArray())
     */
    protected $hidden = [];

    /**
     * @var array Attributes to be cast to Argon (Carbon) instances
     */
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    /**
     * @var array Other relationship types (empty for now)
     */
    public $hasOne = [];
    public $hasOneThrough = [];
    public $hasManyThrough = [];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];
}