<?php namespace ThemeKit\HtmlGenerators;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use ThemeKit\HtmlGenerators\Core\IoC;

class HtmlGeneratorsServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
        IoC::setContainer($this->app);
	}

    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../../views', 'html-generators');

		$this->publishes([
			__DIR__ . '/../../views' => resource_path('views/vendor/html-generators'),
		], 'views');

		$this->publishes([
			__DIR__ . '/../../config/html-generators.php' => config_path('html-generators.php'),
		], 'config');

		$this->publishes([
			__DIR__ . '/../../../public' => public_path('vendor/html-generators'),
		], 'public');

        AliasLoader::getInstance()->alias('Widget', 'ThemeKit\HtmlGenerators\Core\Widget');
        AliasLoader::getInstance()->alias('Accordion', 'ThemeKit\HtmlGenerators\Accordion\Accordion');
        AliasLoader::getInstance()->alias('ListGroup', 'ThemeKit\HtmlGenerators\ListGroup\ListGroup');
        AliasLoader::getInstance()->alias('Dropdown', 'ThemeKit\HtmlGenerators\Dropdown\Dropdown');
        AliasLoader::getInstance()->alias('Button', 'ThemeKit\HtmlGenerators\Button\Button');
        AliasLoader::getInstance()->alias('ButtonGroup', 'ThemeKit\HtmlGenerators\ButtonGroup\ButtonGroup');
        AliasLoader::getInstance()->alias('ButtonToolbar', 'ThemeKit\HtmlGenerators\ButtonGroup\ButtonToolbar');
        AliasLoader::getInstance()->alias('FormBuilder', 'ThemeKit\HtmlGenerators\Form\FormBuilder');
        AliasLoader::getInstance()->alias('FormField', 'ThemeKit\HtmlGenerators\Form\FormField');
        AliasLoader::getInstance()->alias('Checkbox', 'ThemeKit\HtmlGenerators\Form\Checkbox');
        AliasLoader::getInstance()->alias('Grid', 'ThemeKit\HtmlGenerators\Grid\Grid');
        AliasLoader::getInstance()->alias('Panel', 'ThemeKit\HtmlGenerators\Panel\Panel');
        AliasLoader::getInstance()->alias('Media', 'ThemeKit\HtmlGenerators\Media\Media');
        AliasLoader::getInstance()->alias('Alert', 'ThemeKit\HtmlGenerators\Alert\Alert');
        AliasLoader::getInstance()->alias('Carousel', 'ThemeKit\HtmlGenerators\Carousel\Carousel');
        AliasLoader::getInstance()->alias('Tab', 'ThemeKit\HtmlGenerators\Tab\Tab');
        AliasLoader::getInstance()->alias('Nav', 'ThemeKit\HtmlGenerators\Nav\Nav');
        AliasLoader::getInstance()->alias('Modal', 'ThemeKit\HtmlGenerators\Modal\Modal');
        AliasLoader::getInstance()->alias('ProgressBar', 'ThemeKit\HtmlGenerators\ProgressBar\ProgressBar');
        AliasLoader::getInstance()->alias('Navbar', 'ThemeKit\HtmlGenerators\Navbar\Navbar');
        AliasLoader::getInstance()->alias('Table', 'ThemeKit\HtmlGenerators\Table\Table');

		if (!$this->app->routesAreCached()) {
			require __DIR__ . '/../../routes.php';
		}
    }

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}
