<?php

namespace Teamgrid\Project\Classes\Extend;

use RainLab\User\Models\User as RainLabUser;
use Teamgrid\Project\Models\Project;

class UserExtend
{
    public static function extendUser_addProjectsRelation()
    {
        RainLabUser::extend(function ($model) {
            $model->hasMany['assignedProjects'] = [Project::class, 'key' => 'project_manager_id'];
            $model->hasMany['managedProjects'] = [Project::class, 'key' => 'customer_id'];
        });
    }

    public static function extendUserWithDynamicMethods()
    {
        RainLabUser::extend(function ($model) {
            $model->addDynamicMethod('getAssignedProjectsOptions', function() use ($model) {
                return $model->assignedProjects->lists('name', 'id');
            });
            $model->addDynamicMethod('getManagedProjectsOptions', function() use ($model) {
                return $model->managedProjects->lists('name', 'id');
            });
        });
    }   
}