<?php

namespace Teamgrid\Project\Classes\RelationManager;

use Rainlab\User\Models\User as RainLabUser;
use Teamgrid\Project\Models\Project;

class UserProjectRelationManager
{
    /**
     * Extend the user form fields to include project relation tabs.
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
            
            // Check if methods for project options exist in the user model
            if ($userModel->getAssignedProjectsOptions() || $userModel->getManagedProjectsOptions()) {
                // Add tab fields for assignedProjects and managedProjects
                $form->addTabFields([
                    'assignedProjects' => [
                        'label' => 'Assigned Projects',
                        'tab' => 'Projects',
                        'type' => 'partial',
                        'path' => '~/plugins/teamgrid/project/partials/_assignedprojects.htm', // Update this path to your actual partial path
                        'nameFrom' => 'name', // Display field from related Project model
                        'options' => [
                            'assigned' => $userModel->getAssignedProjectsOptions(),
                        ],
                    ],
                    'managedProjects' => [
                        'label' => 'Managed Projects',
                        'tab' => 'Projects',
                        'type' => 'partial',
                        'path' => '~/plugins/teamgrid/project/partials/_managedprojects.htm', // Update this path to your actual partial path
                        'nameFrom' => 'name', // Display field from related Project model
                        'options' => [
                            'managed' => $userModel->getManagedProjectsOptions(),
                        ],
                    ],
                ]);                
            }
        });
    }
}