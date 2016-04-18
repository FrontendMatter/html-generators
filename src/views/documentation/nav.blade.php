@extends('html-generators::layouts.docs')

@section('content')
	
<h1>Nav</h1>
<hr/>

<h3>Tabs</h3>

    {!!
        Nav::myNav()
            ->isTabs()
            ->addNav(Html::link('#', 'Home'))
            ->addNav(Html::link('#', 'Profile'))
            ->addNav(Html::link('#', 'Messages'))
            ->addDropdown(
                Dropdown::myDropdown()
                    ->isListItem()
                    ->isActive()
                    ->addButton(Button::regular('My dropdown')->isDropdown()->isLink())
                    ->addMenu(Html::link('#', 'Dropdown menu item'))
                    ->addMenuHeader('My heading')
                    ->addMenuDivider()
                    ->addMenu(Html::link('#', 'Active Dropdown menu'))->isActive()
                    ->addMenu(Html::link('#', 'Another Dropdown menu item'))
                    ->addMenu(Html::link('#', 'Yet another menu item'))
            )
    !!}

<h3>Pills</h3>

{!!
    Nav::myNav()
        ->isPills()
        ->addNav(Html::link('#', 'Home'))
        ->addNav(Html::link('#', 'Profile'))
        ->addNav(Html::link('#', 'Messages'))
        ->addDropdown(
        Dropdown::myDropdown()
            ->isListItem()
            ->isActive()
            ->addButton(Button::regular('My dropdown')->isDropdown()->isLink())
            ->addMenu(Html::link('#', 'Dropdown menu item'))
            ->addMenuHeader('My heading')
            ->addMenuDivider()
            ->addMenu(Html::link('#', 'Active Dropdown menu'))->isActive()
            ->addMenu(Html::link('#', 'Another Dropdown menu item'))
            ->addMenu(Html::link('#', 'Yet another menu item'))
        )
!!}
<hr/>

<h3>Stacked</h3>

{!!
    Nav::myNav()
        ->isPills()
        ->isStacked()
        ->addNav(Html::link('#', 'Home'))
        ->addNav(Html::link('#', 'Profile'))
        ->addNav(Html::link('#', 'Messages'))
        ->addDropdown(
            Dropdown::myDropdown()
                ->isListItem()
                ->isActive()
                ->addButton(Button::regular('My dropdown')->isDropdown()->isLink())
                ->addMenu(Html::link('#', 'Dropdown menu item'))
                ->addMenuHeader('My heading')
                ->addMenuDivider()
                ->addMenu(Html::link('#', 'Active Dropdown menu'))->isActive()
                ->addMenu(Html::link('#', 'Another Dropdown menu item'))
                ->addMenu(Html::link('#', 'Yet another menu item'))
        )
!!}

<hr/>
<h3>Usage</h3>
<pre>
Nav::myNav()
    ->isTabs()
    ->isPills()
    ->isStacked()
    ->isJustified()
    ->addNav(Html::link('#', 'Home'))->isActive()
    ->addNav(Html::link('#', 'Profile'))
    ->addNav(Html::link('#', 'Messages'))
    ->addDropdown( Regular dropdown component )
</pre>
@endsection