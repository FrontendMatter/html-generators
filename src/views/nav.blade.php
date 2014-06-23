@extends("html-generators::layouts.docs")

@section('content')
	
<h1>Nav</h1>
<hr/>

<h3>Tabs</h3>

    {{
        Nav::myNav()
            ->isTabs()
            ->addNav(HTML::link('#', 'Home'))
            ->addNav(HTML::link('#', 'Profile'))
            ->addNav(HTML::link('#', 'Messages'))
            ->addDropdown(
                Dropdown::myDropdown()
                    ->isListItem()
                    ->isActive()
                    ->addButton(Button::regular('My dropdown')->isDropdown()->isLink())
                    ->addMenu(HTML::link('#', 'Dropdown menu item'))
                    ->addMenuHeader('My heading')
                    ->addMenuDivider()
                    ->addMenu(HTML::link('#', 'Active Dropdown menu'))->isActive()
                    ->addMenu(HTML::link('#', 'Another Dropdown menu item'))
                    ->addMenu(HTML::link('#', 'Yet another menu item'))
            )
    }}

<h3>Pills</h3>

{{
    Nav::myNav()
        ->isPills()
        ->addNav(HTML::link('#', 'Home'))
        ->addNav(HTML::link('#', 'Profile'))
        ->addNav(HTML::link('#', 'Messages'))
        ->addDropdown(
        Dropdown::myDropdown()
            ->isListItem()
            ->isActive()
            ->addButton(Button::regular('My dropdown')->isDropdown()->isLink())
            ->addMenu(HTML::link('#', 'Dropdown menu item'))
            ->addMenuHeader('My heading')
            ->addMenuDivider()
            ->addMenu(HTML::link('#', 'Active Dropdown menu'))->isActive()
            ->addMenu(HTML::link('#', 'Another Dropdown menu item'))
            ->addMenu(HTML::link('#', 'Yet another menu item'))
        )
}}
<hr/>

<h3>Stacked</h3>

{{
    Nav::myNav()
        ->isPills()
        ->isStacked()
        ->addNav(HTML::link('#', 'Home'))
        ->addNav(HTML::link('#', 'Profile'))
        ->addNav(HTML::link('#', 'Messages'))
        ->addDropdown(
            Dropdown::myDropdown()
                ->isListItem()
                ->isActive()
                ->addButton(Button::regular('My dropdown')->isDropdown()->isLink())
                ->addMenu(HTML::link('#', 'Dropdown menu item'))
                ->addMenuHeader('My heading')
                ->addMenuDivider()
                ->addMenu(HTML::link('#', 'Active Dropdown menu'))->isActive()
                ->addMenu(HTML::link('#', 'Another Dropdown menu item'))
                ->addMenu(HTML::link('#', 'Yet another menu item'))
        )
}}

<hr/>
<h3>Usage</h3>
<pre>
Nav::myNav()
    ->isTabs()
    ->isPills()
    ->isStacked()
    ->isJustified()
    ->addNav(HTML::link('#', 'Home'))->isActive()
    ->addNav(HTML::link('#', 'Profile'))
    ->addNav(HTML::link('#', 'Messages'))
    ->addDropdown( Regular dropdown component )
</pre>
@stop