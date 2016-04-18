@extends('html-generators::layouts.docs')

@section('content')
	
<h1>Alert</h1>
<hr/>

    {!!
        Alert::myAlert()
            ->addAlert('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium architecto aut dolor, eius id incidunt natus porro ratione veniam. Corporis dolore ea eos fugit iure nemo perferendis porro quaerat unde!')
            ->isSuccess()
            ->isDismissable()
    !!}

    {!!
        Alert::myAlert()
            ->addAlert('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium architecto aut dolor, eius id incidunt natus porro ratione veniam. Corporis dolore ea eos fugit iure nemo perferendis porro quaerat unde!')
            ->isInfo()
    !!}

    {!!
        Alert::myAlert()
            ->addAlert('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium architecto aut dolor, eius id incidunt natus porro ratione veniam. Corporis dolore ea eos fugit iure nemo perferendis porro quaerat unde!')
            ->isWarning()
    !!}

    {!!
        Alert::myAlert()
            ->addAlert('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium architecto aut dolor, eius id incidunt natus porro ratione veniam. Corporis dolore ea eos fugit iure nemo perferendis porro quaerat unde!')
            ->isDanger()
    !!}

<hr/>
<h3>Usage</h3>
<pre>
Alert::myAlert()
    ->addAlert( 'Alert content here' )
    ->isSuccess()
    ->isDismissable()
</pre>
@stop