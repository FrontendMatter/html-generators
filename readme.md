# Bootstrap HTML Generators for Laravel 5

## Installation

> **Prerequisites**: Composer, PHP >=5.5.9, Laravel 5.2

### 1. Create a new Laravel project

	composer create-project laravel/laravel my-project

### 2. Install HTML Markup Generators

	composer require themekit/html-generators:*

### 3. Register the service providers
Add the following to the `providers` list in `config/app.php`:

	'providers' => [
		// ...
        
		Collective\Html\HtmlServiceProvider::class,
		ThemeKit\HtmlGenerators\HtmlGeneratorsServiceProvider::class,
	],
	
Add the following to the `alias` list in `config/app.php`:

	'aliases' => [
		// ...
        
		'Html' => Collective\Html\HtmlFacade::class,
		'Form' => Collective\Html\FormFacade::class,
	],

### 4. Publish assets

	php artisan vendor:publish

### 5. Have fun

	php artisan serve

> You should now be able to open your new Laravel project in your browser and check out the examples at [http://localhost:8000](http://localhost:8000))