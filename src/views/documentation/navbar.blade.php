@extends('html-generators::layouts.docs')

@section('content')
	
<h1>Navbar</h1>
<hr/>

<h3>Default</h3>

    {!!
        Navbar::myNav()
            ->isDefault()
            ->isFluid()
            ->setBrand('Awesome project')
            ->addNav(
                Nav::myNav()
                    ->isNavbarLeft()
                    ->addNav(Html::link('#', 'Home'))
                    ->addNav(Html::link('#', 'Messages'))
            )
            ->addNav(
                Form::open(['class' => 'navbar-form navbar-left visible-lg']) .
                FormField::search(['label'=>'', 'placeholder' => 'Search ..']) .
                Button::regular('Search')->isSubmit() .
                Form::close()
            )
            ->addNav(
                Nav::myNav2()
                    ->isNavbarRight()
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
            )
    !!}

<h3>Usage</h3>
<pre>
Navbar::myNav()
    ->isDefault()
    ->isFluid()
    ->setBrand('Awesome project')
    ->addNav(
        Nav::myNav()
            ->isNavbar()
            ->isNavbarRight()
            // regular nav component options
    )
</pre>
<hr/>

<h3>Navbar text, Non-nav links &amp; Buttons</h3>
{!!
    Navbar::myNav2()
        ->isDefault()
        ->isFluid()
        ->setBrand('Awesome project')
        ->addNav( Navbar::text('Signed in as ' . Navbar::link('#', 'Laza Bogdan')) )
        ->addNav( Navbar::textRight( Navbar::link('#', 'My account')) )
        ->addNav( Button::regular('Logout')->isButton()->isNavbarRight() )
!!}

<pre>
Navbar::myNav()
    ->isDefault()
    ->isFluid()
    ->setBrand('Awesome project')
    ->addNav( Navbar::text('Signed in as ' . Navbar::link('#', 'Laza Bogdan')) )
    ->addNav( Navbar::textRight( Navbar::link('#', 'My account')) )
    ->addNav( Button::regular('Logout')->isButton()->isNavbarRight() )
</pre>
<hr/>

<h3>Static &amp; Fixed</h3>
<pre>
Navbar::myNav()
    ->isStaticTop()
    ->isFixedTop()
    ->isFixedBottom()
</pre>
<hr/>

<h3>Navbar Inverse</h3>
{!!
    Navbar::myNav3()
        ->isInverse()
        ->isFluid()
        ->setBrand('Awesome project')
        ->addNav( Navbar::text('Signed in as ' . Navbar::link('#', 'Laza Bogdan')) )
        ->addNav( Navbar::textRight( Navbar::link('#', 'My account')) )
        ->addNav( Button::primary('Logout')->isButton()->isNavbarRight() )
!!}

<pre>
Navbar::myNav()
    ->isInverse()
    ->isFluid()
    ->setBrand('Awesome project')
    ->addNav( Navbar::text('Signed in as ' . Navbar::link('#', 'Laza Bogdan')) )
    ->addNav( Navbar::textRight( Navbar::link('#', 'My account')) )
    ->addNav( Button::primary('Logout')->isButton()->isNavbarRight() )
</pre>
@endsection