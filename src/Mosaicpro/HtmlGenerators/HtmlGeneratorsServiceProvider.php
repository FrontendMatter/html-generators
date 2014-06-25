<?php namespace Mosaicpro\HtmlGenerators;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Mosaicpro\HtmlGenerators\Core\IoC;

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
        $this->package('mosaicpro/html-generators');
        $this->app['config']->package('mosaicpro/HtmlGenerators', __DIR__ . '/../config');

        AliasLoader::getInstance()->alias('Widget', 'Mosaicpro\HtmlGenerators\Core\Widget');
        AliasLoader::getInstance()->alias('Accordion', 'Mosaicpro\HtmlGenerators\Accordion\Accordion');
        AliasLoader::getInstance()->alias('ListGroup', 'Mosaicpro\HtmlGenerators\ListGroup\ListGroup');
        AliasLoader::getInstance()->alias('Dropdown', 'Mosaicpro\HtmlGenerators\Dropdown\Dropdown');
        AliasLoader::getInstance()->alias('Button', 'Mosaicpro\HtmlGenerators\Button\Button');
        AliasLoader::getInstance()->alias('ButtonGroup', 'Mosaicpro\HtmlGenerators\ButtonGroup\ButtonGroup');
        AliasLoader::getInstance()->alias('ButtonToolbar', 'Mosaicpro\HtmlGenerators\ButtonGroup\ButtonToolbar');
        AliasLoader::getInstance()->alias('FormBuilder', 'Mosaicpro\HtmlGenerators\Form\FormBuilder');
        AliasLoader::getInstance()->alias('FormField', 'Mosaicpro\HtmlGenerators\Form\FormField');
        AliasLoader::getInstance()->alias('Checkbox', 'Mosaicpro\HtmlGenerators\Form\Checkbox');
        AliasLoader::getInstance()->alias('Grid', 'Mosaicpro\HtmlGenerators\Grid\Grid');
        AliasLoader::getInstance()->alias('Panel', 'Mosaicpro\HtmlGenerators\Panel\Panel');
        AliasLoader::getInstance()->alias('Media', 'Mosaicpro\HtmlGenerators\Media\Media');
        AliasLoader::getInstance()->alias('Alert', 'Mosaicpro\HtmlGenerators\Alert\Alert');
        AliasLoader::getInstance()->alias('Carousel', 'Mosaicpro\HtmlGenerators\Carousel\Carousel');
        AliasLoader::getInstance()->alias('Tab', 'Mosaicpro\HtmlGenerators\Tab\Tab');
        AliasLoader::getInstance()->alias('Nav', 'Mosaicpro\HtmlGenerators\Nav\Nav');
        AliasLoader::getInstance()->alias('Modal', 'Mosaicpro\HtmlGenerators\Modal\Modal');
        AliasLoader::getInstance()->alias('ProgressBar', 'Mosaicpro\HtmlGenerators\ProgressBar\ProgressBar');
        AliasLoader::getInstance()->alias('Navbar', 'Mosaicpro\HtmlGenerators\Navbar\Navbar');
        AliasLoader::getInstance()->alias('Table', 'Mosaicpro\HtmlGenerators\Table\Table');

        require __DIR__ . '/../../routes.php';
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
