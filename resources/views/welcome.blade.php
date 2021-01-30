<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">


    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>ScrumTest</title>
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
    </head>


    <body class="antialiasedv" style="background-color: rgb(247, 247, 247)">
        <div class=" row relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0" id="app">
            <div class="col-md-2 sidebar-sticky">
                <button class="btn btn-link bd-search-docs-toggle d-md-none p-0 ml-3" type="button" data-toggle="collapse" data-target="#bd-docs-nav" aria-controls="bd-docs-nav" aria-expanded="false" aria-label="Toggle docs navigation"><svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 30 30" width="30" height="30" focusable="false"><title>Menu</title><path stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-miterlimit="10" d="M4 7h22M4 15h22M4 23h22"/></svg></button>
                
                <nav class="d-md-block bg-light collapse bd-links sticky-top" id="bd-docs-nav">
                    <div>
                        <h1>Logo</h1>
                    </div>
                    <div class="bd-toc-item">
                        <ul class="flex-column nav bd-sidenav">
                            <li class="nav-item">
                                <a class="nav-link active" href="#">
                                <span data-feather="home"></span>
                                Dashboard <span class="sr-only">(current)</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                <span data-feather="file"></span>
                                Orders
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>

            <main role="main" class="col-md-10 ml-sm-auto col-lg-10 pt-3 px-4">
                <activite-component></activite-component>
            </main>
        </div>
        <script src="{{asset('js/app.js')}}"></script>
    </body>


</html>
