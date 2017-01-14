<?php
return [

    'list' => [ //settings for grid and table entries
        'items' => 20 //Per page list items
    ],

    'lang' => [
        'default' => 'en', //default settings
        'all' => ['en', 'ar'], //available languages must be defined here
        'dir' => [ //directions for languages, default is ltr - left to right
            'en' => 'ltr',
            'ar' => 'rtl'
        ]
    ],

    'prm' => [
        'people' =>[
            'photo' => [
                'path' => 'prm/people/photos/thumbnail/',
                'original_path' => 'prm/people/photos/original/', //original file will be save as it is
                'no-photo' => 'no-photo.jpg',
                //sizes for thumbnail
                'width' => 200,
                'height' => 200
            ],
            'registration' => [

                /**
                 * if default_country set to true then default country of new register people will be set to same as selected for Country code field
                 *
                 * Example
                 * If you selected country Pakistan in registration form field "Country code"
                 * and if default_country is true then system assume users current country is Pakistan.
                 *
                 * Database example
                 * People table field country_code = PK
                 * People_contacts table field country = PK and current = true
                 * it means if on submitting information in people table, system will also add current contact entry in people_contacts table
                 */
                'default_country' => true,

                'contact' => false, //if true contact detail form will be appear after people created

            ],
            'contacts' => [
                'multi_contacts' => false, //Submit and add more button will appear, on successful added new form will appear instead going to people > contacts
                'only_multi_contacts' => false, //Multi button will show instead submit button, if true then it will force multi_contacts to ON
            ]
        ]
    ]
];