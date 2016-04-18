<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Boilerplate</title>

    {{ Html::style('vendor/html-generators/bootstrap/css/bootstrap.min.css') }}
    {{ Html::style('vendor/html-generators/css/style.css') }}

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

        /* All levels of nav */
        .bs-docs-sidebar .nav > li > a {
            display: block;
            padding: 4px 20px;
            font-size: 13px;
            font-weight: 500;
            color: #999;
        }
        .bs-docs-sidebar .nav > li > a:hover,
        .bs-docs-sidebar .nav > li > a:focus {
            padding-left: 19px;
            color: #563d7c;
            text-decoration: none;
            background-color: transparent;
            border-left: 1px solid #563d7c;
        }
        .bs-docs-sidebar .nav > .active > a,
        .bs-docs-sidebar .nav > .active:hover > a,
        .bs-docs-sidebar .nav > .active:focus > a {
            padding-left: 18px;
            font-weight: bold;
            color: #563d7c;
            background-color: transparent;
            border-left: 2px solid #563d7c;
        }

        /* Nav: second level (shown on .active) */
        .bs-docs-sidebar .nav .nav {
            display: none; /* Hide by default, but at >768px, show it */
            padding-bottom: 10px;
        }
        .bs-docs-sidebar .nav > .active .nav {
            display: block;
        }
        .bs-docs-sidebar .nav .nav > li > a {
            padding-top: 1px;
            padding-bottom: 1px;
            padding-left: 30px;
            font-size: 12px;
            font-weight: normal;
        }
        .bs-docs-sidebar .nav .nav > li > a:hover,
        .bs-docs-sidebar .nav .nav > li > a:focus {
            padding-left: 29px;
        }
        .bs-docs-sidebar .nav .nav > .active > a,
        .bs-docs-sidebar .nav .nav > .active:hover > a,
        .bs-docs-sidebar .nav .nav > .active:focus > a {
            padding-left: 28px;
            font-weight: 500;
        }
        #Navbar_docsNav .navbar-brand img {
            top: -3px;
            position: relative;
            width: 25px;
            vertical-align: text-top;
            margin-right: 5px;
        }
    </style>

</head>
<body>

    {!!
        Navbar::docsNav()
            ->isInverse()
            ->isFixedTop()
            ->setBrand(['<img src="https://0.s3.envato.com/files/104864177/mosaic-logo.png" /> HTML Generators', '/'])
            ->addNav(
                Nav::myNav()
                    ->isNavbarLeft()
                    ->addNav(Html::link('/documentation/accordion', 'Components'))
            )
            ->addNav(
                Button::success('Buy Now &nbsp; <i class="fa fa-fw fa-credit-card"></i>')
                    ->isButton()
                    ->isNavbarRight()
            )
    !!}
    <div class="container">

        @if(Session::has('message'))
        <p class="alert alert-info">{{ Session::get('message') }}</p>
        @endif

        <div class="row">
            <div class="col-md-9">

                <!-- CONTENT -->
                @yield('content')

            </div>
            <!-- END COL-MD-9 -->

            <div class="col-md-3">
                <?php
                $current_slug = Request::segment(2);
                $current_slug = str_replace('-', ' ', $current_slug);
                $components = ['accordion', 'dropdown', 'button group', 'button', 'form', 'list group', 'panel', 'media', 'alert', 'nav', 'navbar', 'table', 'progress bar', 'modal', 'tab', 'carousel', 'grid'];
                $list = Nav::components();
                foreach($components as $component) {
                    $url = implode("-", str_word_count($component, 1));
                    $list->addNav(Html::link(url('documentation/' . $url), ucwords($component)))->isActive($current_slug == $component);
                }
                ?>
                <div class="bs-docs-sidebar">
                    <h4>Getting started</h4>

                    {!!
                    Nav::make()
                        ->addNav(Html::link(url('/'), 'Installation'))->isActive(Request::is('/'))
                    !!}

                    <hr/>

                    <h4>Components</h4>
                    {!!
                        Nav::make()
                            ->addNav(Html::link(url('documentation/accordion'), 'User Interface') . $list)->isActive(in_array($current_slug, $components))
                    !!}

                </div>
            </div>
            <!-- END COL-MD-3 -->

        </div>
        <!-- END ROW -->
    </div>

    {{ Html::script('//code.jquery.com/jquery-1.11.0.min.js') }}
    {{ Html::script('vendor/html-generators/bootstrap/js/bootstrap.min.js') }}
    @yield('footer_scripts')
</body>
</html>