<?php

namespace Teamgrid\TimeEntry\Classes\RelationManager;

use Rainlab\User\Models\User as RainLabUser;
use Teamgrid\TimeEntry\Models\TimeEntry;

class UserTimeEntryRelationManager
{
    /**
     * Extend the user form fields to include time entry relation.
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

            // Check if the getTimeEntriesOptions method exists
            if ($userModel->getTimeEntriesOptions()) {
                // Add tab fields for timeEntries
                $form->addTabFields([
                    'timeEntries' => [
                        'label' => 'Time Entries',
                        'tab' => 'Time Entries',
                        'type' => 'relation',
                        'nameFrom' => 'total_time',
                        'options' => $userModel->getTimeEntriesOptions(),
                    ],
                ]);
            }
        });
    }
}