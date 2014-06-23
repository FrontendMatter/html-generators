# Bootstrap 3 HTML Generators for Laravel 4

> **Prerequisites**: Composer, PHP >=5.4, Laravel 4.2.*

### 1. Create a new Laravel project

    composer create-project laravel/laravel my-project

### 2. Prepare the downloaded ZIP package

> Because we're using Composer to install the package and in this case there is no ability to have an online VCS repository for Composer
to download the package from, we'll be using an "artifact" or local ZIP repository. Note: the package for Laravel is not the actual ZIP file
that you downloaded from CodeCanyon, but another ZIP file placed within the main archive: **laravel/mosaicpro-html-generators-1.0.0.zip**.

    cd my-project
    mkdir mosaicpro-packages
    cp /path/to/downloaded/mosaicpro-html-generators-1.0.0.zip mosaicpro-packages/

### 3. Update Laravel's composer.json

> We need to instruct Composer to use the artifact ZIP file as the source for our package, so open up your favourite text editor
(such as VIM) and edit the project's composer.json file to include the following:

    "repositories": [
        {
            "type": "artifact",
            "url": "mosaicpro-packages/"
        }
    ],

> **Note**: If the "repositories" is the last key within the JSON structure, make sure to remove the last comma above;

### 4. Install the HTML Markup Generators

    composer require mosaicpro/html-generators:*

### 5. Register the service provider
Add the following to the `providers` list in the `app/config/app.php` file:

    'providers' => array(
        ...
        'Mosaicpro\HtmlGenerators\HtmlGeneratorsServiceProvider',
    ),

### 6. Publish the assets (public)

    php artisan asset:publish mosaicpro/html-generators

### 7. Have fun

> You should now be able to open your new Laravel project in your browser and check out the examples at
[http://localhost/path/to/your/laravel/install/html-generators/accordion](http://localhost/path/to/your/laravel/install/html-generators/accordion)