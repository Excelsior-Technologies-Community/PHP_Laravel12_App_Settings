<?php

return [

    'settings' => [

        'general' => [

            'title' => 'General Settings',

            'elements' => [

                [
                    'name' => 'app_name',
                    'type' => 'text',
                    'label' => 'App Name',
                    'rules' => 'required|min:2|max:50',
                    'value' => 'My Laravel App',
                ],

                [
                    'name' => 'app_email',
                    'type' => 'email',
                    'label' => 'App Email',
                    'rules' => 'required|email',
                    'value' => 'admin@example.com',
                ],

                [
                    'name' => 'users_limit',
                    'type' => 'number',
                    'label' => 'Users Limit',
                    'rules' => 'required|numeric|min:1',
                    'value' => 100,
                ],

            ],

        ],

    ],

];