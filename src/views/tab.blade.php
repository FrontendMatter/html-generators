@extends("html-generators::layouts.docs")

@section('content')
	
<h1>Tab</h1>
<hr/>
{{
    Nav::make()
        ->isTabs()
        ->addNav(HTML::link('#tab1', 'Home', ['data-toggle' => 'tab']))->isActive()
        ->addNav(HTML::link('#tab2', 'Profile', ['data-toggle' => 'tab']))
}}
{{
    Tab::make()
        ->isFade()
        ->addTab('tab1', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem non repellat rerum similique veniam. Commodi debitis delectus, deleniti eius eligendi fugiat illum minus molestias quis sapiente sint tempora temporibus voluptas.')->isActive()
        ->addTab('tab2', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab aspernatur autem cumque distinctio dolore, expedita harum illo inventore iste itaque, iure neque, obcaecati odit optio pariatur placeat saepe voluptate voluptatem.')
}}
<hr/>
<h3>Usage</h3>
<hr/>
<h4>Create a Nav</h4>
<pre>
Nav::make()
    ->isTabs()
    ->addNav(HTML::link('#tab1', 'Home', ['data-toggle' => 'tab']))->isActive()
    ->addNav(HTML::link('#tab2', 'Profile', ['data-toggle' => 'tab']))
</pre>
<hr/>
<h4>Create the Tab panes</h4>
<pre>
Tab::make()
    ->isFade()
    ->addTab('tab1', 'tab content text')->isActive()
    ->addTab('tab2', 'tab content text')
</pre>
<hr/>

<h3>Tab in a Panel</h3>
{{
    Panel::make('default')
        ->addBody(
            Nav::make()
                ->isTabs()
                ->addNav(HTML::link('#tab3', 'Home', ['data-toggle' => 'tab']))->isActive()
                ->addNav(HTML::link('#tab4', 'Profile', ['data-toggle' => 'tab'])) .
            Tab::make()
                ->isFade()
                ->addTab('tab3', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem non repellat rerum similique veniam. Commodi debitis delectus, deleniti eius eligendi fugiat illum minus molestias quis sapiente sint tempora temporibus voluptas.')->isActive()
                ->addTab('tab4', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab aspernatur autem cumque distinctio dolore, expedita harum illo inventore iste itaque, iure neque, obcaecati odit optio pariatur placeat saepe voluptate voluptatem.')
        )
}}

<pre>
Panel::make('default')
    ->addBody(
        Nav::make()
            ->isTabs()
            ->addNav(HTML::link('#tab1', 'Home', ['data-toggle' => 'tab']))->isActive()
            ->addNav(HTML::link('#tab2', 'Profile', ['data-toggle' => 'tab'])) .
        Tab::make()
            ->isFade()
            ->addTab('tab1', 'tab content text')->isActive()
            ->addTab('tab2', 'tab content text')
    )
</pre>
@stop