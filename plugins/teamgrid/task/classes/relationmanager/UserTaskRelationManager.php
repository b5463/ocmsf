<?php

namespace Teamgrid\Task\Classes\RelationManager;

use Rainlab\User\Models\User as RainLabUser;
use Teamgrid\Task\Models\Task;

class UserTaskRelationManager
{
    /**
     * Extend the user form fields to include task relation tabs.
     *
     * @return void
     */
    public static function extendRelationManagerFields()
    {
        // Extend the form fields for the RainLab Users controller
        \Rainlab\User\Controllers\Users::extendFormFields(function ($form, $userModel, $context) {
            // Check if the user model is an instance of RainLabUser
            if (!$userModel instanceof RainLabUser) {
                return;
            }

            // Check if method for task options exists in the user model
            if ($userModel->getAssignedTasksOptions()) {
                // Add tab fields for assignedTasks
                $form->addTabFields([
                    'assignedTasks' => [
                        'label' => 'Assigned Tasks',
                        'tab' => 'Tasks',
                        'type' => 'relation',
                        'nameFrom' => 'name', // Display field from related Task model
                        'options' => $userModel->getAssignedTasksOptions(), // Retrieve options for assigned tasks
                    ],
                ]);
            }
        });
    }
}