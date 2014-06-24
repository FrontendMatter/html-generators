@extends("html-generators::layouts.docs")

@section('content')
	
	<h1>FormField</h1>
    <hr/>

    {{ Form::open(['autocomplete' => 'off']) }}
        {{ FormField::username() }}
        {{ FormField::password() }}
        {{ FormField::myCustomTextarea(['type' => 'textarea', 'label' => 'Custom Label', 'rows' => 4]) }}
    {{ Form::close() }}

<h3>Usage</h3>
<hr/>
<pre>
Form::open()
    FormField::username()
    FormField::password()
    FormField::myCustomTextarea(['type' => 'textarea', 'label' => 'Custom Label', 'rows' => 4])
Form::close()
</pre>

@stop