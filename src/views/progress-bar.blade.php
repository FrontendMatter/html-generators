@extends("html-generators::layouts.docs")

@section('content')
	
<h1>Progress Bar</h1>
<hr/>
<h3>Default</h3>
{{
    ProgressBar::make()
        ->setValue(80)
        ->setLabel('80% Complete')
}}

<pre>
ProgressBar::make()
    ->setValue(80)
    ->setLabel('80% Complete')
</pre>
<hr/>

{{
    ProgressBar::make()
        ->isStriped()
        ->addBar(60)->isSuccess()->setLabel('60% Complete (success)')
        ->addBar(10, '10%')->isDanger()
}}

<h3>Stacked</h3>
<pre>
ProgressBar::make()
    ->isStriped()
    ->addBar(60)->isSuccess()->setLabel('60% Complete (success)')
    ->addBar(10, '10%')->isDanger()
</pre>
<hr/>

<h3>Animated</h3>
{{
    ProgressBar::make()
        ->setValue(50)
        ->setLabel('50% Complete')
        ->isAnimated()
}}

<pre>
ProgressBar::make()
    ->setValue(50)
    ->setLabel('50% Complete')
    ->isAnimated()
</pre>
<hr/>
@stop