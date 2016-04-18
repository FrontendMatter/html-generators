@extends('html-generators::layouts.docs')

@section('content')
	
<h1>Grid</h1>
<hr/>

{!!
    Grid::make()
        ->addColumn(6, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid, impedit nesciunt nobis soluta veritatis voluptas. Adipisci alias delectus dolores dolorum libero quibusdam quo reprehenderit soluta, voluptatibus. Dolores dolorum excepturi pariatur!', ['class' => 'col-sm-6'])
        ->addColumn(6, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. A ab adipisci alias amet, asperiores atque autem beatae, dolorem earum exercitationem incidunt iste mollitia nostrum nulla odio perspiciatis quibusdam totam ut!')
!!}

<hr/>

{!!
    Grid::make()
        ->addColumn(4, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut autem earum obcaecati quisquam ut. Ea ipsum maxime nobis perspiciatis quo!')
        ->addColumn(8, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum molestiae quas quod veritatis? Adipisci aliquam aliquid amet at atque cumque dolor eaque et eum facere laudantium molestias nulla quae quas quibusdam quo recusandae rerum sed similique sunt tenetur vero, voluptatum!')
!!}

<hr/>

<pre>
Grid::make()
    ->addColumn(6, 'This is a col-md-6 column that is also col-sm-6', ['class' => 'col-sm-6'])
    ->addColumn(6, 'This is another col-md-6 column')
</pre>
@endsection