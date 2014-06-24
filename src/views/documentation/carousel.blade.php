@extends("html-generators::layouts.docs")

@section('content')
	
<h1>Carousel</h1>
<hr/>
{{
    Carousel::make()
        ->isPlaying()
        ->addItem(HTML::image('holder.js/900x500/auto/#555:#333/text:First slide'))
            ->isActive()
            ->setCaption(['First slide label', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis?'])
        ->addItem(HTML::image('holder.js/900x500/auto/#555:#333/text:Second slide'))
            ->setCaption(['Second slide label', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias.'])
        ->addItem(HTML::image('holder.js/900x500/auto/#555:#333/text:Third slide'))
            ->setCaption(['Third slide label', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Praesentium?'])
}}
<h3>Usage</h3>
<hr/>
<pre>
Carousel::make()
    ->isPlaying()
    ->addItem(HTML::image('holder.js/900x500/auto/#555:#333/text:First slide'))
        ->isActive()
        ->setCaption(['First slide label', 'Caption body text'])
    ->addItem( ... )
    ->addItem( ... )
</pre>
@stop

@section('footer_scripts')
{{ HTML::script('//cdnjs.cloudflare.com/ajax/libs/holder/2.3.1/holder.js') }}
@stop