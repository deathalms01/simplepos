@extends('layouts.app')

@section('content')
<div class="container">
  <div class="table-responsive">
      <div class="col-md-10 col-md-offset-1">
          <div class="panel panel-default">
            <div class="panel-heading">
              Products
            </div>
            <div class="panel-body">
              <button type="button" class="btn btn-info btn-lg float-right" data-toggle="modal" data-target="#myModal">New Item</button>
            <table class="table">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Description</th>
                  <th>Price</th>
                  <th>Qty</th>
                  <th>Type</th>
                  <th>Image</th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>

              @foreach($products as $product)
                <tbody>
                  <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->qty }}</td>
                    <td>{{ $product->type }}</td>
                    <td><img class="thumb-small" src="{{asset('img/'.$product->imglink)}}"></td>
                    <td>
                      <form action="../../products/{{ $product->id }}/edit">
                        {{ csrf_field() }}
            						<input type="submit" class="btn btn-primary btn-sm" value="edit">
            					</form>
                    </td>
                    <td>
                      <form action="../../products/{{ $product->id }}" method="POST" onsubmit = 'return confirmDelete()'>
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
            						<input type="submit" class="btn btn-danger btn-sm" value="delete">
            					</form>
                    </td>
                  </tr>
                </tbody>
              @endforeach
            </table>

            <center>
              {{ $products->links() }}
            </center>

          </div>
      </div>

    </div>

    <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add New Product</h4>
        </div>
        <form class="form-horizontal" method="POST" action="/products"  enctype="multipart/form-data">
          <div class="modal-body">


            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                <label for="description" class="col-md-4 control-label">Description</label>

                <div class="col-md-6">
                    <input id="description" type="text" class="form-control" name="description" value="{{ old('description') }}" required autofocus>

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
                    <select id="type" class="form-control" name="type" value="{{ old('type') }}" style="width: 130px;">
                        <option value="burger">Burger</option>
                        <option value="beverage">Beverage</option>
                        <option value="combo">Combo Meal</option>
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
                    <input id="price" type="number" min="0" class="form-control" name="price" value="{{ old('price') }}" step=".01" required autofocus>

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
                    <input id="qty" type="number" min="0" max="1000" class="form-control" name="qty" value="{{ old('qty') }}" required autofocus>

                    @if ($errors->has('qty'))
                        <span class="help-block">
                            <strong>{{ $errors->first('qty') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('imglink') ? ' has-error' : '' }}">
                <label for="imglink" class="col-md-4 control-label">Image Link</label>

                <div class="col-md-6">
                    <!--<input id="imglink" type="text" class="form-control" name="imglink" value="{{ old('imglink') }}" required autofocus>-->
                    <input id="imglink" type="file" class="form-control" name="imglink" value="{{ old('imglink') }}" required autofocus>
                    @if ($errors->has('imglink'))
                        <span class="help-block">
                            <strong>{{ $errors->first('imglink') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <input type="hidden" value="{{ csrf_token() }}" name="_token">

          </div>

          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Add</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          </div>

        </form>

      </div>

      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
    function confirmDelete() {
        var result = confirm('Are you sure you want to delete this user?');

        if (result) {
            return true;
        }
        else
        {
            return false;
        }
    }
</script>

@endsection
