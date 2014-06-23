<?php
return [

    'FormField' => [

        /*
        * Wrap each form field with a div
        */
        'wrapper' => 'div',

        /*
         * Give the wrapping element a class of 'form-group'
         * (default Bootstrap 3)
         */
        'wrapperClass' => 'form-group',

        /*
         * Give the input a class of 'form-control'
         * (default Bootstrap 3)
         */
        'inputClass' => 'form-control',

        /*
         * Map field names with common field types
         */
        'guessInputType' => [
            'email'                 => 'email',
            'description'           => 'textarea',
            'body'                  => 'textarea',
            'bio'                   => 'textarea',
            'password'              => 'password',
            'password_confirmation' => 'password',
        ]

    ]

];