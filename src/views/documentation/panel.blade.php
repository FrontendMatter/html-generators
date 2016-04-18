@extends('html-generators::layouts.docs')

@section('content')
	
<h1>Panel</h1>
<hr/>

<h3>Simple panel</h3>

{!!
    Panel::myPanel('default')
        ->addBody('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid, impedit nesciunt nobis soluta veritatis voluptas. Adipisci alias delectus dolores dolorum libero quibusdam quo reprehenderit soluta, voluptatibus. Dolores dolorum excepturi pariatur!')
!!}

<pre>
Panel::myPanel('default')
    ->addBody('This is the panel body')
</pre>
<hr/>

<h3>Panel heading</h3>

{!!
    Panel::myPanel('default')
        ->addHeading('This is a heading without a title')
        ->addBody('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid, impedit nesciunt nobis soluta veritatis voluptas. Adipisci alias delectus dolores dolorum libero quibusdam quo reprehenderit soluta, voluptatibus. Dolores dolorum excepturi pariatur!')
!!}

<pre>
Panel::myPanel('default')
    ->addHeading('This is a heading without a title')
</pre>
<hr/>

<h3>Panel title</h3>

{!!
    Panel::myPanel('default')
        ->addTitle('This is a heading with a title')
        ->addBody('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid, impedit nesciunt nobis soluta veritatis voluptas. Adipisci alias delectus dolores dolorum libero quibusdam quo reprehenderit soluta, voluptatibus. Dolores dolorum excepturi pariatur!')
!!}

<pre>
Panel::myPanel('default')
    ->addTitle('This is a heading with a title')
</pre>
<hr/>

<h3>Panel footer</h3>

{!!
    Panel::myPanel('default')
        ->addTitle('Lorem ipsum dolor sit amet')
        ->addBody('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid, impedit nesciunt nobis soluta veritatis voluptas. Adipisci alias delectus dolores dolorum libero quibusdam quo reprehenderit soluta, voluptatibus. Dolores dolorum excepturi pariatur!')
        ->addFooter('This is the panel footer')
!!}

<pre>
Panel::myPanel('default')
    ->addFooter('This is the panel footer')
</pre>
<hr/>

<h3>Panel with List groups</h3>

{!!
    Panel::myPanel('default')
        ->addTitle('Lorem ipsum dolor sit amet')
        ->addBody('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid, impedit nesciunt nobis soluta veritatis voluptas. Adipisci alias delectus dolores dolorum libero quibusdam quo reprehenderit soluta, voluptatibus. Dolores dolorum excepturi pariatur!')
        ->add(
            ListGroup::myListGroup()
                ->addList('Cras justo odio')
                ->addList('Dapibus ac facilisis in')
                ->addList('Morbi leo risus')
        )
!!}

<pre>
Panel::myPanel('default')
    ->addTitle( ... )
    ->addBody( ... )
    ->add(
        ListGroup::myListGroup()
            ->addList('Cras justo odio')
            ->addList('Dapibus ac facilisis in')
            ->addList('Morbi leo risus')
    )
</pre>
<hr/>

<h3>Panel with contextual classes</h3>

{!!
    Panel::myPanel('primary')
        ->addTitle('Lorem ipsum dolor sit amet')
        ->addBody('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid, impedit nesciunt nobis soluta veritatis voluptas. Adipisci alias delectus dolores dolorum libero quibusdam quo reprehenderit soluta, voluptatibus. Dolores dolorum excepturi pariatur!')
!!}

{!!
    Panel::myPanel('success')
        ->addTitle('Lorem ipsum dolor sit amet')
        ->addBody('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid, impedit nesciunt nobis soluta veritatis voluptas. Adipisci alias delectus dolores dolorum libero quibusdam quo reprehenderit soluta, voluptatibus. Dolores dolorum excepturi pariatur!')
!!}

{!!
    Panel::myPanel('info')
        ->addTitle('Lorem ipsum dolor sit amet')
        ->addBody('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid, impedit nesciunt nobis soluta veritatis voluptas. Adipisci alias delectus dolores dolorum libero quibusdam quo reprehenderit soluta, voluptatibus. Dolores dolorum excepturi pariatur!')
!!}

{!!
    Panel::myPanel('warning')
        ->addTitle('Lorem ipsum dolor sit amet')
        ->addBody('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid, impedit nesciunt nobis soluta veritatis voluptas. Adipisci alias delectus dolores dolorum libero quibusdam quo reprehenderit soluta, voluptatibus. Dolores dolorum excepturi pariatur!')
!!}

{!!
    Panel::myPanel('danger')
        ->addTitle('Lorem ipsum dolor sit amet')
        ->addBody('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid, impedit nesciunt nobis soluta veritatis voluptas. Adipisci alias delectus dolores dolorum libero quibusdam quo reprehenderit soluta, voluptatibus. Dolores dolorum excepturi pariatur!')
!!}

<pre>
Panel::myPanel('primary')
Panel::myPanel('success')
Panel::myPanel('info')
Panel::myPanel('warning')
Panel::myPanel('danger')
</pre>
@endsection