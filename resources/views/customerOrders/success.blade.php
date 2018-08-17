@extends('layouts.orders')

@section('content')
  <div class="container">
    <div class="col-md-8 col-md-offset-2">


      <div class="panel panel-default">
        <div class="panel-heading">
          <div class="header-big">
            Order Success
          </div>
        </div>

        <div class="panel-body">
          <p class="body-big">
            Your order is now being processed and will be delivered short after.
          </p>
          <a href="/" class="btn btn-success btn-lg">Ok</a>
        </div>
      </div>
    </div>
  </div>

@endsection
