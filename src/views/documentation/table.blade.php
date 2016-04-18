@extends('html-generators::layouts.docs')

@section('content')

<?php
$body_assoc = [
    [ 'id' => 1, 'name' => 'Laza Bogdan', 'username' => 'lazabogdan', 'email' => 'lb@mail.com' ],
    [ 'id' => 2, 'name' => 'Mosaicpro', 'username' => 'mosaicpro', 'email' => 'contact@mail.com' ],
    [ 'id' => 3, 'name' => 'Some dude', 'username' => 'somedude', 'email' => 'dude@some.com' ],
    [ 'id' => 4, 'name' => 'John Doe', 'username' => 'johndoe', 'email' => 'john@doe.com' ]
];
$body_simple = [
    [ 1, 'Laza Bogdan', 'lazabogdan', 'lb@mail.com' ],
    [ 2, 'Mosaicpro', 'mosaicpro', 'contact@mosaicpro.biz' ],
    [ 3, 'Some dude', 'somedude', 'dude@some.com' ],
    [ 4, 'John Doe', 'johndoe', 'john@doe.com' ]
];
$header_assoc = ['id' => '#', 'name' => 'The name', 'username' => 'The username', 'email' => 'The email'];
$header_simple = ['#', 'The name', 'The username', 'The email'];
?>
	
<h1>Table</h1>
<hr/>

{!!
    Table::make()
        ->isBordered()
        ->isStriped()
        ->isHover()
        ->addHeader($header_assoc)
        ->addBody($body_assoc)
!!}

<pre>
Table::make()
    ->isBordered()
    ->isStriped()
    ->isHover()
    ->isCondensed()
    ->addHeader([
        'id' => '#',
        'name' => 'The name',
        'username' => 'The username',
        'email' => 'The email'
    ])
    ->addBody([
        [ 'id' => 1, 'name' => 'Laza Bogdan', 'username' => 'lazabogdan', 'email' => 'lb@mail.com' ],
        [ 'id' => 2, 'name' => 'Mosaicpro', 'username' => 'mosaicpro', 'email' => 'contact@mail.com' ],
        [ 'id' => 3, 'name' => 'Some dude', 'username' => 'somedude', 'email' => 'dude@some.com' ],
        [ 'id' => 4, 'name' => 'John Doe', 'username' => 'johndoe', 'email' => 'john@doe.com' ]
    ])
</pre>

<hr/>
<h3>Auto-generated header</h3>

{!!
    Table::make()
        ->isBordered()
        ->isStriped()
        ->isHover()
        ->addBody($body_assoc)
!!}

<hr/>
<pre>
Table::make()
    ->isBordered()
    ->isStriped()
    ->isHover()
    ->addBody([
        [ 'id' => 1, 'name' => 'Laza Bogdan', 'username' => 'lazabogdan', 'email' => 'lb@mail.com' ],
        [ 'id' => 2, 'name' => 'Mosaicpro', 'username' => 'mosaicpro', 'email' => 'contact@mail.com' ],
        [ 'id' => 3, 'name' => 'Some dude', 'username' => 'somedude', 'email' => 'dude@some.com' ],
        [ 'id' => 4, 'name' => 'John Doe', 'username' => 'johndoe', 'email' => 'john@doe.com' ]
    ])
</pre>
<hr/>

<h3>Custom columns &amp; data-binding</h3>

{!!
    Table::make()
        ->isBordered()
        ->isStriped()
        ->isHover()
        ->setHidden(['username'])
        ->setOrder(['bulk', 'id', 'name', 'custom-username'])
        ->addBody($body_assoc, [
            'actions' => [ 'class' => 'text-center'],
            'bulk' => [ 'class' => 'text-center' ]
        ])
        ->addColumn([ 'Bulk',
            Checkbox::make('something')
                ->callAttributeValue('{id}')
                ->callAttributeChecked('{id} == 1')
        ])
        ->addColumn([
            'Actions', [
                Button::success('Edit')->isSm()->call('addUrl', '#edit/{id}'),
                Button::danger('Remove')->isSm()->call('addUrl', '#remove/{id}')
            ]
        ])
        ->addColumn([
            'Custom username', [
                '<strong>{username}</strong>',
                Button::regular('Profile')->isSm()->call('addUrl', '#user/{username}')
                    ->addAttributes(['class' => 'pull-right'])
            ]
        ])
!!}

<hr/>
<pre>
Table::make()
    ->isBordered()
    ->isStriped()
    ->isHover()
    ->addBody([
        [ 'id' => 1, 'name' => 'Laza Bogdan', 'username' => 'lazabogdan', 'email' => 'lb@mail.com' ],
        [ 'id' => 2, 'name' => 'Mosaicpro', 'username' => 'mosaicpro', 'email' => 'contact@mail.com' ],
        [ 'id' => 3, 'name' => 'Some dude', 'username' => 'somedude', 'email' => 'dude@some.com' ],
        [ 'id' => 4, 'name' => 'John Doe', 'username' => 'johndoe', 'email' => 'john@doe.com' ]], [
        'actions' => [ 'class' => 'text-center' ],
        'bulk' => [ 'class' => 'text-center' ]
    ])
    ->addColumn([ 'Bulk',
        Checkbox::make('something')
            ->callAttributeValue('{id}')
            ->callAttributeChecked('{id} == 1')
    ])
    ->addColumn([
        'Actions', [
            Button::success('Edit')->isSm()->call('addUrl', '#edit/{id}'),
            Button::danger('Remove')->isSm()->call('addUrl', '#remove/{id}')
        ]
    ])
    ->addColumn([
        'username', [
            '&lt;strong&gt;{username}&lt;/strong&gt;',
            Button::regular('Profile')->isSm()->call('addUrl', '#user/{username}')
                ->addAttributes(['class' => 'pull-right'])
        ]
    ])
</pre>
@endsection