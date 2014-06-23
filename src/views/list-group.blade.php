@extends("html-generators::layouts.docs")

@section('content')

    <h1>List Group</h1>
    <hr/>

    {{
        ListGroup::myListGroup()
            ->addList(HTML::link('#', 'Lorem ipsum dolor sit amet.'))->setBadge(25)
            ->addList(HTML::link('#', 'Molestias nam nesciunt odit vitae s'))->setBadge('The badge content')
            ->addList(HTML::link('#', 'Repudiandae rerum tempora ullam ut'))->__toString()
    }}

    <hr/>

<h3>Usage</h3>
<pre>
ListGroup::myListGroup()
    ->addList(HTML::link('#', 'Lorem ipsum dolor sit amet.'))
    ->addList(HTML::link('#', 'Molestias nam nesciunt odit vitae s'))
    ->addList(HTML::link('#', 'Repudiandae rerum tempora ullam ut'))
</pre>
<hr/>

<h3>Badges</h3>
<pre>
ListGroup::myListGroup()
    ->addList( ... )->setBadge('The badge content')
</pre>
<hr/>

<h3>Linked Items</h3>
{{
    ListGroup::myListGroup()
        ->addLink('#', 'Lorem ipsum dolor sit amet')->setBadge('The badge content')
        ->addLink('#', 'Molestias nam nesciunt odit vitae s', ['class' => 'custom-link'])->setActive()
        ->addLink('#', 'Repudiandae rerum tempora ullam ut')
}}

<pre>
ListGroup::myListGroup()
    ->addLink('#', 'Lorem ipsum dolor sit amet')->setBadge('The badge content')
    ->addLink('#', 'Molestias nam nesciunt odit vitae s')->setActive()
    ->addLink('#', 'Repudiandae rerum tempora ullam ut')
</pre>
<hr/>

<h3>Custom Content</h3>
{{
    ListGroup::myListGroup()
        ->addLink('#', ListGroup::content('List group item heading', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci amet labore molestiae mollitia nesciunt odio quidem rerum saepe! Ad adipisci dolore doloremque eveniet hic ipsam, natus nesciunt nisi quod velit.'))->isActive()
        ->addLink('#', ListGroup::content('Another List group item heading', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequuntur cupiditate deleniti deserunt dolor doloremque eligendi, error ex, expedita itaque iure laboriosam modi nobis officia omnis quasi quis repudiandae tenetur voluptatem.'))
}}

<pre>
ListGroup::myListGroup()
    ->addLink('#', ListGroup::content('List group item heading', 'List group item body'))->isActive()
    ->addLink('#', ListGroup::content('Another List group item heading', 'List group item body'))
</pre>

@stop