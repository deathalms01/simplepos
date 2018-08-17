@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif


                    <div class="homeContent col-md-3">
                      <a href="orders">
                        <img class="img-thumbnail" src="{{ asset('img/app/check.png') }}">
                        <p>
                          Orders Served: {{$orderDone}}
                        </p>
                      </a>
                    </div>

                    <div class="homeContent col-md-3">
                      <a href="orders">
                        <img class="img-thumbnail" src="{{ asset('img/app/clip.png') }}">
                        <p>
                          Pending Orders: {{$orderPending}}
                        </p>
                      </a>
                    </div>

                    <div class="homeContent col-md-3">
                      <a href="products">
                        <img class="img-thumbnail" src="{{ asset('img/app/burger.png') }}">
                        <p>
                          Products: {{$product}}
                        </p>
                      </a>
                    </div>

                    <div class="homeContent col-md-3">
                      <a href="coupons">
                        <img class="img-thumbnail" src="{{ asset('img/app/coupon.png') }}">
                        <p>
                          Counpons: {{$coupon}}
                        </p>
                      </a>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
