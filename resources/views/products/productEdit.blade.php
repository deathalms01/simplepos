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

              <form class="form-horizontal" method="POST" action="../../products/{{ $product->id }}"  enctype="multipart/form-data">
                <div class="modal-body">

                  {{ method_field('PUT') }}
                  {{ csrf_field() }}

                  <img class="thumb-medium center-block" src="{{asset('img/'.$product->imglink)}}">

                  <div class="form-group{{ $errors->has('imglink') ? ' has-error' : '' }}">
                      <label for="imglink" class="col-md-4 control-label">Image Link</label>

                      <div class="col-md-6">
                          <input id="imglink" type="file" class="form-control" name="imglink" value="{{ $product->imglink }}" autofocus>
                          @if ($errors->has('imglink'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('imglink') }}</strong>
                              </span>
                          @endif
                      </div>
                  </div>

                  <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                      <label for="description" class="col-md-4 control-label">Description</label>

                      <div class="col-md-6">
                          <input id="description" type="text" class="form-control" name="description" value="{{ $product->description }}" required autofocus>

                          @if ($errors->has('description'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('description') }}</strong>
                              </span>
                          @endif
                      </div>
                  </div>

                  <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                      <label for="type" class="col-md-4 control-label">Type</label>

                      <div class="col-md-6">
                          <select id="type" class="form-control" name="type" value="{{ $product->type }}" style="width: 130px;">
                              @if (strcmp($product->type, "burger")==0)
                                <option value="burger" selected>Burger</option>
                              @else
                                <option value="burger">Burger</option>
                              @endif

                              @if (strcmp($product->type, "beverage")==0)
                                <option value="beverage" selected>Beverage</option>
                              @else
                                <option value="beverage">Beverage</option>
                              @endif

                              @if (strcmp($product->type, 'combo')==0)
                                <option value="combo" selected>Combo Meal</option>
                              @else
                                <option value="combo">Combo Meal</option>
                              @endif

                          </select>
                          @if ($errors->has('type'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('type') }}</strong>
                              </span>
                          @endif
                      </div>
                  </div>

                  <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                      <label for="price" class="col-md-4 control-label">Price</label>

                      <div class="col-md-6">
                          <input id="price" type="number" min="0" class="form-control" name="price" value="{{ $product->price }}" step=".01" required autofocus>

                          @if ($errors->has('price'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('price') }}</strong>
                              </span>
                          @endif
                      </div>
                  </div>

                  <div class="form-group{{ $errors->has('qty') ? ' has-error' : '' }}">
                      <label for="qty" class="col-md-4 control-label">Qty</label>

                      <div class="col-md-6">
                          <input id="qty" type="number" min="0" max="1000" class="form-control" name="qty" value="{{ $product->qty }}" required autofocus>

                          @if ($errors->has('qty'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('qty') }}</strong>
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
