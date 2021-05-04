@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card">
                    <br>
                    <img class="card-img-top rounded mx-auto d-block" style="max-width: 24rem;"
                         src="{{asset('images/rahmat-waisi.jpg')}}" alt="Rahmat Waisi's Image">
                    <div class="card-body">
                        <div class="card-title">
                            <h1> About me</h1>
                        </div>
                        <div class="card-text">
                            <p>
                                I'm Rahmat Waisi,<br>
                                Graduated Software Enginner from University Of Kurdistan. <br>
                                <br>
                            </p>
                            <h3>My Skills</h3>
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <div class="progress">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 84%"
                                             aria-valuenow="84" aria-valuemin="0" aria-valuemax="100">Laravel 4.2 / 5
                                        </div>
                                    </div>
                                    <br>
                                    <div class="progress">
                                        <div class="progress-bar bg-warning text-dark" role="progressbar" style="width: 70%"
                                             aria-valuenow="70" aria-valuemin="0" aria-valuemax="100">Git 3.5 / 5
                                        </div>
                                    </div>
                                    <br>
                                    <div class="progress">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 80%"
                                             aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">MySql 4 / 5
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <br>
                            <br>
                            <h3>Hire Me!</h3>
                            <p>
                                Feel free to contact me for your projects, i'll be happy!
                                <br><br>
                                <a href="mailto:rahmatwaisi@gmail.com" class="text-dark">Gmail</a><br>
                                <a href="tel:+989360835848" class="text-dark">Phone</a>
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
