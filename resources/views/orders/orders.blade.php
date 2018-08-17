@extends('layouts.app')

@section('content')
<div class="container">
  <div class="table-responsive">
      <div class="col-md-10 col-md-offset-1">
          <div class="panel panel-default">
            <div class="panel-heading">
              Orders
            </div>
            <div class="panel-body">

            <table class="orderTable">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Orders</th>
                  <th>Type</th>
                  <th>Qty</th>
                  <th>SubTotal</th>
                  <th>Coupon</th>
                  <th>Discount</th>
                  <th>Total Price</th>
                  <th>Done</th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              @php
                $temp = 0;
              @endphp

              @foreach($data as $item)
                <tbody>
                  @if($temp != $item->orderid)
                    <tr class="bordered">
                  @else
                    <tr>
                  @endif



                    @if($temp != $item->orderid)
                      <td>{{ $item->orderid }}</td>
                    @else
                      <td></td>
                    @endif

                    <td>{{ $item->description }}</td>
                    <td>{{ $item->productprice }}</td>
                    <td>{{ $item->qty }}</td>
                    <td>{{ $item->producttotal }}</td>

                    @if($temp != $item->orderid)
                    <td>{{ $item->coupon }}</td>
                    <td>{{ $item->discountpercent*100 }}%</td>
                    <td>{{ $item->grosstotal }}</td>
                    @if($item->done==1)
                      <td>✔</td>
                      <td></td>
                    @else
                      <td>-</td>
                      <td>
                        <form action="../../orders/{{ $item->orderid }}/edit">
                          {{ csrf_field() }}
                          <input type="submit" class="btn btn-primary btn-sm" value="done">
                        </form>
                      </td>
                    @endif


                    @else
                      <td></td><td></td><td></td><td></td><td></td>
                    @endif

                    @php
                      $temp = $item->orderid;
                    @endphp
                  </tr>
                </tbody>
              @endforeach
            </table>

            <center>
              {{ $data->links() }}
            </center>

          </div>
      </div>

    </div>
  </div>
</div>


@endsection
