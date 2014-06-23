@extends("html-generators::layouts.docs")

@section('content')
	
<h1>Media</h1>
<hr/>

<h3>Media containers</h3>

{{
    Media::make()
        ->addImageLeft('#', 'holder.js/60x60', 'image alt')
        ->addBody(
            'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dicta, harum!',
            'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae eaque explicabo iste maiores minus sunt! Aliquam beatae culpa, distinctio, earum eligendi harum laborum minus natus perferendis quae repellendus rerum veniam.' .
            Media::myNestedMedia()
                ->addImageLeft('#', 'holder.js/60x60', 'image alt')
                ->addBody('the media heading', 'the media content')
        )
}}
<hr/>
{{
    Media::make()
        ->addImageRight('#', 'holder.js/60x60', 'image alt')
        ->addBody(
            'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dicta, harum!',
            'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae eaque explicabo iste maiores minus sunt! Aliquam beatae culpa, distinctio, earum eligendi harum laborum minus natus perferendis quae repellendus rerum veniam.'
        )
}}
<hr/>
{{
    Media::make()
        ->addObjectLeft( 'Generic left object' )
        ->addObjectRight( 'Generic right object' )
        ->addImageLeft('#', 'holder.js/60x60', 'image alt')
        ->addBody(
            'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dicta, harum!',
            'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae eaque explicabo iste maiores minus sunt! Aliquam beatae culpa, distinctio, earum eligendi harum laborum minus natus perferendis quae repellendus rerum veniam.'
        )
}}
<hr/>
{{
    Media::make()
        ->addLinkLeft( '#', 'Generic left link' )
        ->addLinkRight( '#', 'Generic right link' )
        ->addImageLeft('#', 'holder.js/60x60', 'image alt')
        ->addBody(
            'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dicta, harum!',
            'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae eaque explicabo iste maiores minus sunt! Aliquam beatae culpa, distinctio, earum eligendi harum laborum minus natus perferendis quae repellendus rerum veniam.'
        )
}}

<hr/>
<h3>Usage</h3>
<pre>
Media::myMedia()
    ->addImageLeft( '#link', 'holder.js/60x60', 'image alt' )
    ->addImageRight( ... )
    ->addObjectLeft( 'Generic left object' )
    ->addObjectRight( ... )
    ->addLinkLeft( '#link', 'Generic left link' )
    ->addLinkRight( ... )
    ->addBody( 'Media title', 'Media body' )
</pre>
@stop

@section('footer_scripts')
{{ HTML::script('//cdnjs.cloudflare.com/ajax/libs/holder/2.3.1/holder.js') }}
@stop