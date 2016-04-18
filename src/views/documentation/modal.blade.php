@extends('html-generators::layouts.docs')

@section('content')
	
<h1>Modal</h1>
<hr/>
{!!
    Modal::myModal()
        ->isFade()
        ->addTitle('The modal heading title')
        ->addBody('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus aspernatur at atque dicta dolore eveniet id impedit magni nulla optio perferendis quisquam quod saepe similique velit, veniam voluptatem. Earum, porro?')
        ->addFooter(
            Button::primary('Save')->dismissModal() .
            Button::regular('Close')->dismissModal()
        )
!!}

<p>{!! Button::primary('Launch modal')->openModal('#Modal_myModal') !!}</p>

<pre>
Modal::myModal()
    ->isFade()
    ->addTitle('The modal heading title')
    ->addBody('The modal body text')
    ->addFooter(
        Button::primary('Save')->dismissModal() .
        Button::regular('Close')->dismissModal()
    )
</pre>
<pre>
Button::primary('Launch modal')->openModal('#Modal_myModal')
</pre>
@stop