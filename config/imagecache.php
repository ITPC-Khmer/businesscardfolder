<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Name of route
    |--------------------------------------------------------------------------
    |
    | Enter the routes name to enable dynamic imagecache manipulation.
    | This handle will define the first part of the URI:
    | 
    | {route}/{template}/{filename}
    | 
    | Examples: "images", "img/cache"
    |
    */
   
    //'route' => null,
    'route' => 'imagecache',

    /*
    |--------------------------------------------------------------------------
    | Storage paths
    |--------------------------------------------------------------------------
    |
    | The following paths will be searched for the image filename, submited 
    | by URI. 
    | 
    | Define as many directories as you like.
    |
    */
    
    'paths' => array(
        public_path('upload'),
        public_path('upload/post'),
        public_path('images')
    ),

    /*
    |--------------------------------------------------------------------------
    | Manipulation templates
    |--------------------------------------------------------------------------
    |
    | Here you may specify your own manipulation filter templates.
    | The keys of this array will define which templates 
    | are available in the URI:
    |
    | {route}/{template}/{filename}
    |
    | The values of this array will define which filter class
    | will be applied, by its fully qualified name.
    |
    */
   //http://yourhost.com/{route-name}/download/{file-name}
   //http://yourhost.com/{route-name}/original/{file-name}
    'templates' => array(
        /*'small' => 'Intervention\Image\Templates\Small',
        'medium' => 'Intervention\Image\Templates\Medium',
        'large' => 'Intervention\Image\Templates\Large',*/

        'largex' => 'Intervention\Image\Templates\Large',
        '50x50' => 'App\Filters\Image50Filter',
        's' => 'App\Filters\ImageL1Filter',
        'm' => 'App\Filters\ImageL2Filter',
        'l' => 'App\Filters\ImageL3Filter',
    ),

    /*
    |--------------------------------------------------------------------------
    | Image Cache Lifetime
    |--------------------------------------------------------------------------
    |
    | Lifetime in minutes of the images handled by the imagecache route.
    |
    */
   
    //'lifetime' => 43200,
    'lifetime' => 30,

);
