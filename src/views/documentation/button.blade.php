@extends('html-generators::layouts.docs')

@section('content')
	
	<h1>Button</h1>
    <hr/>

	{!! Button::success('Success button') !!}
    {!! Button::info('For dropdowns')->isDropdown() !!}
    {!! Button::danger('With caret')->isCaret() !!}
    {!! Button::regular('Submit button')->isSubmit() !!}
    {!! Button::regular('Button')->isButton() !!}

<hr/>
<h3>Disabled</h3>

    {!! Button::success('Disabled button')->isDisabled() !!}
    {!! Button::info('Disabled button')->isDisabled() !!}
    {!! Button::regular('Disabled button')->isDisabled() !!}

<hr/>
<h3>Block level</h3>

    {!! Button::primary('Block level button')->isBlock() !!}
    {!! Button::regular('Block level button')->isBlock() !!}
    {!! Button::regular('Block level button')->isBlock() !!}

<hr/>
<h3>Usage</h3>
<hr/>
<pre>
Button::success('Success button')
Button::info('For dropdowns')->isDropdown()
Button::danger('With caret')->addCaret()
Button::regular('Submit button')->isSubmit()
Button::xs('Small button')->addClass('btn-default')
Button::lg('Large button')->addAttributes(['class' => 'btn-default'])
Button::success('Disabled button')->isDisabled()
Button::primary('Block level button')->isBlock()
Button::regular('Button')->isButton()
</pre>

@stop