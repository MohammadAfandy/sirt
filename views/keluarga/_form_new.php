<?php

use buttflatteryormwizard\FormWizard;

echo FormWizard::widget([
    'theme' => FormWizard::THEME_CIRCLES,
    'steps' => [
        [
            'model' => $model,
            'title' => 'My Shoots',
            'description' => 'Add your shoots',
            'formInfoText' => 'Fill all fields'
        ],
        [
            'model' => $model,
            'title' => 'Shoot Tags',
            'description' => 'Add your shoot tags',
            'formInfoText' => 'Fill all fields'
        ],
    ]
]);
