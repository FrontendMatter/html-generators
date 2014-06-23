@extends("html-generators::layouts.docs")

@section('content')

    <h1>Dropdown</h1>
    <hr/>
    <p>By default, dropdowns will be wrapped in <code>&lt;div&gt;</code> elements.</p>

    {{
        Dropdown::myDropdown()
            ->addButton(Button::success('My dropdown')->isDropdown())
            ->addMenu(HTML::link('#', 'Dropdown menu item'))
            ->addMenuHeader('My heading')
            ->addMenuDivider()
            ->addMenu(HTML::link('#', 'Active Dropdown menu'))
                ->isActive()
            ->addMenu(HTML::link('#', 'Another Dropdown menu item'))
            ->addMenu(HTML::link('#', 'Yet another menu item'))->__toString()

    }}

    <hr/>

<pre>
Dropdown::myDropdown()
    ->addButton(Button::success('My dropdown')->isDropdown())
    ->addMenu(HTML::link('#', 'Dropdown menu item'))
    ->addMenuHeader('My heading')
    ->addMenuDivider()
    ->addMenu(HTML::link('#', 'Active Dropdown menu'))
        ->isActive()
    ->addMenu(HTML::link('#', 'Another Dropdown menu item'))
    ->addMenu(HTML::link('#', 'Yet another menu item'))
</pre>

    <h3>Dropdown buttons</h3>
    <hr/>

    {{
    Dropdown::myDropdown()
        ->isButtonGroup()
        ->addButton(Button::success('Dropdown button')->isDropdown())
        ->addMenu(HTML::link('#', 'Dropdown menu item'))
        ->addMenu(HTML::link('#', 'Another Dropdown menu item'))
        ->addMenu(HTML::link('#', 'Yet another menu item'))
    }}

    {{
    Dropdown::myDropdown()
        ->isButtonGroup()
        ->pullRight()
        ->addButton(Button::primary('Aligned right')->isDropdown())
        ->addMenu(HTML::link('#', 'Dropdown menu item'))
        ->addMenu(HTML::link('#', 'Another Dropdown menu item'))
        ->addMenu(HTML::link('#', 'Yet another menu item'))
    }}

<hr/>

<pre>
Dropdown::myDropdown()
    ->isButtonGroup()
    ->addButton( ... )
    ->addMenu( ... )
</pre>

<h3>Aligned right</h3>
<hr/>
<pre>
Dropdown::myDropdown()
    ->pullRight()
    ->addButton( ... )
    ->addMenu( ... )
</pre>

<h3>Dropdown as list item</h3>
<hr/>
<p>Will be wrapped in a <code>&lt;li&gt;</code> element rather than a <code>&lt;div&gt;</code></p>
<pre>
Dropdown::myDropdown()
    ->isListItem()
    ->addButton( ... )
    ->addMenu( ... )
</pre>

@stop