@extends('layouts.app')

@section('content')
<div class="container">
  <div class="table-responsive">
      <div class="col-md-10 col-md-offset-1">
          <div class="panel panel-default">
            <div class="panel-heading">
              Coupons
            </div>
            <div class="panel-body">
              <button type="button" class="btn btn-info btn-lg float-right" data-toggle="modal" data-target="#myModal">New Item</button>
            <table class="table">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Coupon Code</th>
                  <th>Valid</th>
                  <th>Discount</th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>

              @foreach($coupons as $coupon)
                <tbody>
                  <tr>
                    <td>{{ $coupon->id }}</td>
                    <td>{{ $coupon->code }}</td>
                    @if($coupon->available==1)
                      <td>True</td>
                    @else
                      <td>False</td>
                    @endif
                    <td>{{ $coupon->discount*100 }}%</td>
                    <td>
                      <form action="../../coupons/{{ $coupon->id }}/edit">
                        {{ csrf_field() }}
            						<input type="submit" class="btn btn-primary btn-sm" value="edit">
            					</form>
                    </td>
                    <td>
                      <form action="../../coupons/{{ $coupon->id }}" method="POST" onsubmit = 'return confirmDelete()'>
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
              {{ $coupons->links() }}
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
          <h4 class="modal-title">Add New Coupon</h4>
        </div>

        <form class="form-horizontal" method="POST" action="/coupons">
          <div class="modal-body">

            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('code') ? ' has-error' : '' }}">
                <label for="code" class="col-md-4 control-label">Cooupon Code</label>

                <div class="col-md-6">
                    <input id="code" type="text" class="form-control" name="code" value="{{ old('code') }}" required autofocus>

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
                    <input id="discount" type="number" min="0" max="1000" class="form-control" name="discount" value="{{ old('discount') }}" placeholder="%" required autofocus>

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
                        <option value="1">Available</option>
                        <option value="0">Not Available</option>
                    </select>
                    @if ($errors->has('available'))
                        <span class="help-block">
                            <strong>{{ $errors->first('available') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

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
