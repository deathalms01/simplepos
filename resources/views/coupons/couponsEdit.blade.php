@extends('layouts.app')

@section('content')
<div class="container">
  <div class="table-responsive">
      <div class="col-md-10 col-md-offset-1">
          <div class="panel panel-default">
            <div class="panel-heading">
              Edit Product
            </div>
            <div class="panel-body">

              <form class="form-horizontal" method="POST" action="../../coupons/{{ $coupon->id }}">
                <div class="modal-body">

                  {{ method_field('PUT') }}
                  {{ csrf_field() }}


                  <div class="form-group{{ $errors->has('code') ? ' has-error' : '' }}">
                      <label for="code" class="col-md-4 control-label">Coupon</label>

                      <div class="col-md-6">
                          <input id="code" type="text" class="form-control" name="code" value="{{ $coupon->code }}" required autofocus>

                          @if ($errors->has('code'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('code') }}</strong>
                              </span>
                          @endif
                      </div>
                  </div>

                  <div class="form-group{{ $errors->has('discount') ? ' has-error' : '' }}">
                      <label for="qty" class="col-md-4 control-label">Discount</label>

                      <div class="col-md-6">
                          <input id="discount" type="number" min="0" max="1000" class="form-control" name="discount" value="{{ $coupon->discount*100 }}" placeholder="%" required autofocus>

                          @if ($errors->has('discount'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('discount') }}</strong>
                              </span>
                          @endif
                      </div>
                  </div>

                  <div class="form-group{{ $errors->has('available') ? ' has-error' : '' }}">
                      <label for="available" class="col-md-4 control-label">Type</label>

                      <div class="col-md-6">
                          <select id="available" class="form-control" name="available" value="{{ old('available') }}" style="width: 130px;">
                            @if ($coupon->available==1)
                              <option value="1" selected>Available</option>
                              <option value="0">Not Available</option>
                            @else
                              <option value="1">Available</option>
                              <option value="0" selected>Not Available</option>
                            @endif
                          </select>
                          @if ($errors->has('available'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('available') }}</strong>
                              </span>
                          @endif
                      </div>
                  </div>

                  <input type="hidden" value="{{ csrf_token() }}" name="_token">

                </div>

                <div class="col-md-6 col-md-offset-4">
                  <button type="submit" class="btn btn-primary float-right">Update</button>
                </div>
              </form>
            </div>
        </div>
    </div>
</div>

@endsection
