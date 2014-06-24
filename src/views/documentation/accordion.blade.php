@extends("html-generators::layouts.docs")

@section('content')
	
	<h1>Accordion</h1>
    <hr/>

    {{
        Accordion::make()
            ->addAccordion('Accordion heading', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim, necessitatibus, harum, culpa suscipit ab obcaecati laboriosam ipsam exercitationem quod illum iure vel soluta porro in corporis perferendis commodi quo rerum.')
            ->addAccordion('Another accordion heading', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odit, nesciunt, enim ipsum voluptas soluta aliquid dignissimos error iste veritatis qui illo deserunt rem praesentium perferendis quas. Facere, necessitatibus atque modi.')
                ->isActive()
    }}

<h3>Usage</h3>
<hr/>
<pre>
Accordion::make()
    ->addAccordion('Accordion heading', 'Accordion body text')
    ->addAccordion('Another accordion heading', 'Accordion body text')
</pre>

<h3>Collapsible</h3>
<hr/>
<pre>
Accordion::make()
    ->isCollapsible()
    ->add( ... )
</pre>

<h3>Active state</h3>
<hr/>
<pre>
Accordion::myAccordion()
    ->add( ... )->isActive()
</pre>

@stop