@extends('admin.layout.base')
@section('title', 'Dashboard')


@section('content')

            <div id="main">
                <div class="inner">

                    <!-- Header -->
                        <header id="header">
                            <a href="/admin" class="logo"><strong>{{getenv('APP_NAME')}}</strong> Admin Panel</a>
                            <ul class="icons">
                                <li><a href="#"><i class="icon fab fa-linkedin-in fa-lg"><span class="label">Medium</span></i></a></li>
                                <li><a href="#"><i class="icon fab fa-facebook fa-lg"><span class="label">Facebook</span></i></a></li>
                                <li><a href="#"><i class="icon fab fa-instagram fa-lg"><span class="label">Instagram</span></i></a></li>
                                <li><a href="#"><i class="icon fab fa-twitter fa-lg"><span class="label">Twitter</span></i></a></li>
                            </ul>
                        </header>
                        
                        <section>
                            <h2>Dashboard</h2>
                        </section>

                </div>
            </div>

@endsection