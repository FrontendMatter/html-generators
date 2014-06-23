<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Boilerplate</title>

    {{ HTML::style('packages/mosaicpro/html-generators/bootstrap/css/bootstrap.min.css'); }}
    {{ HTML::style('packages/mosaicpro/html-generators/css/style.css'); }}

    <!-- Font Awesome CDN -->
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style>
        body {
            padding-top:70px;
        }
    </style>

</head>
<body>

    {{
        Navbar::myNav()
            ->isInverse()
            ->isFixedTop()
            ->setBrand('HTML Generators')
            ->addNav(
                Nav::myNav()
                    ->isNavbarLeft()
                    ->addNav(HTML::link('#', 'Setup'))
                    ->addNav(HTML::link('#', 'Tutorials'))
                    ->addNav(HTML::link('#', 'Documentation'))
            )
            ->addNav(
                Button::danger('Buy Now <i class="fa fa-credit-card"></i>')
                    ->isButton()
                    ->isNavbarRight()
            )
    }}
    <div class="container">

        @if(Session::has('message'))
        <p class="alert alert-info">{{ Session::get('message') }}</p>
        @endif

        <div class="row">
            <div class="col-md-9">
                @yield('content')
            </div>
            <div class="col-md-3">
                <?php
                $components = ['accordion', 'dropdown', 'button group', 'button', 'form field', 'list group', 'panel', 'media', 'alert', 'nav', 'navbar', 'table', 'progress bar', 'modal', 'tab', 'carousel', 'grid'];
                $list = ListGroup::components();
                foreach($components as $component) {
                    $todo = stristr($component, '(todo)');
                    if ($todo) $component = str_replace(" (todo)", "", $component);
                    $url = implode("-", str_word_count($component, 1));
                    $list->addLink(url('html-generators/' . $url), ucwords($component))->isActive(Request::segment(2) == $url)->setBadge($todo);
                }
                ?>

                {{ $list }}
            </div>
        </div>

    </div>

    {{ HTML::script('//code.jquery.com/jquery-1.11.0.min.js') }}
    {{ HTML::script('packages/mosaicpro/html-generators/bootstrap/js/bootstrap.min.js'); }}
    @yield('footer_scripts')
</body>
</html>