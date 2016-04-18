@extends('html-generators::layouts.docs')

@section('content')
	
<h1>Button Group</h1>
<hr/>

    {!!
        ButtonGroup::make()
            ->add(Button::regular('Left'))
            ->add(Button::regular('Middle'))
            ->add(Button::regular('Right'))
    !!}

<hr/>
<pre>
ButtonGroup::make()
    ->add(Button::regular('Left'))
    ->add(Button::regular('Middle'))
    ->add(Button::regular('Right'))
</pre>

<h3>Button Toolbar</h3>

    {!!
        ButtonToolbar::make()
            ->add(
                ButtonGroup::myGroup()
                    ->add(Button::regular('1'))
                    ->add(Button::regular('2'))
                    ->add(Button::regular('3'))
                    ->add(Button::regular('4'))
            )
            ->add(
                ButtonGroup::myGroup()
                    ->add(Button::regular('5'))
                    ->add(Button::regular('6'))
                    ->add(Button::regular('7'))
            )
            ->add(
                ButtonGroup::myGroup()
                    ->add(Button::regular('8'))
            )
    !!}

<hr/>

<pre>
ButtonToolbar::myBar()
    ->add( ButtonGroup )
    ->add( ... )
</pre>

<h3>Nesting</h3>

{!!
    ButtonGroup::make()
        ->add(Button::regular('1'))
        ->add(Button::regular('2'))
        ->add(
            Dropdown::myDropdown()
                ->isButtonGroup()
                ->addButton(Button::primary('Dropdown')->isDropdown())
                ->addMenu(Html::link('#', 'Dropdown menu item'))
                ->addMenu(Html::link('#', 'Another Dropdown menu item'))
                ->addMenu(Html::link('#', 'Yet another menu item'))
        )
!!}

<hr/>
<pre>
ButtonGroup::make()
    ->add( Button )
    ->add( Dropdown )
</pre>

<h3>Vertical</h3>

{!!
    ButtonGroup::make()
        ->isVertical()
        ->add(Button::regular('1'))
        ->add(Button::regular('2'))
        ->add(
            Dropdown::myDropdown()
                ->isButtonGroup()
                ->addButton(Button::primary('Dropdown')->isDropdown())
                ->addMenu(Html::link('#', 'Dropdown menu item'))
                ->addMenu(Html::link('#', 'Another Dropdown menu item'))
                ->addMenu(Html::link('#', 'Yet another menu item'))
        )
!!}

<hr/>
<pre>
ButtonGroup::make()
    ->isVertical()
    ->add( Button )
    ->add( Dropdown )
</pre>

<h3>Justified</h3>

{!!
    ButtonGroup::make()
        ->isJustified()
        ->add(Button::regular('1'))
        ->add(Button::regular('2'))
        ->add(
            Dropdown::myDropdown()
                ->isButtonGroup()
                ->addButton(Button::primary('Dropdown')->isDropdown())
                ->addMenu(Html::link('#', 'Dropdown menu item'))
                ->addMenu(Html::link('#', 'Another Dropdown menu item'))
                ->addMenu(Html::link('#', 'Yet another menu item'))
        )
!!}

<hr/>
<pre>
ButtonGroup::make()
    ->isJustified()
    ->add( Button )
    ->add( Dropdown )
</pre>
@stop