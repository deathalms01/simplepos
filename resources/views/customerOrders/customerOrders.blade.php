
@extends('layouts.orders')

@section('content')

    <div class="container" ng-controller='dataController'>
      <div class="col-md-7">
        <div class="orderNav">
          <a ng-class="classBurger" name="burger" href="" ng-click="changeType('burger')">Burger</a>
          <a ng-class="classBeverage" name="beverage" href="" ng-click="changeType('beverage')">Beverage</a>
          <a ng-class="classCombo" name="combo" href="" ng-click="changeType('combo')">Combo Meal</a>
        </div>
        <div class="orderBody col-md-12 ">
          <ul class="list-group col-md-4 " ng-repeat='product in products' ng-show="product.type==type && product.qty>0" ng-click="addCartItem($index)">
            <li class="list-group-item"><img class="img-thumbnail" src="img/<%product.imglink%>"></li>
            <li class="list-group-item text-center d-inline-block"><%product.description%></li>
            <li class="list-group-item  text-center d-inline-block">₱ <%product.price%></li>
          </ul>
        </div>
      </div>

      <div class="col-md-5">
        <div class="orderOrderList panel panel-default">
          <div class="panel-heading">
            <div class="title">
              Products
            </div>
          </div>

          <div class="panel-body">
            <div class="table">
                <table class="table">
                  <thead class="orderTable">
                    <tr>
                      <td></td>
                      <td>Qty</td>
                      <td>Item</td>
                      <td>Price</td>
                      <td></td>
                    </tr>
                  </thead>

                  <tbody>
                    <tr id="orderList" ng-repeat="cartItem in cart">
                      <td></td>
                      <td>
                        <button type="button" class="btn btn-xs btn-basic" ng-click="removeQtyCartItem($index)">-</button>
                        <%cartItem.qty%>
                        <button type="button" class="btn btn-xs btn-info" ng-click="addQtyCartItem($index)">+</button>
                      </td>
                      <td><%cartItem.description%></td>
                      <td><%cartItem.totalPrice%></td>
                      <td><button type="button" class="btn btn-xs btn-danger" ng-click="removeCartItem($index)">x</button></td>
                    </tr>
                  </tbody>

                </table>
              </div>

            <div class="modal-body">

                <div class="col-md-12">
                  <span class="form-control">Total : <%totalPayable%> <%isDiscounted%></span>
                </div>

              <div class="orderCoupon" >

                  <div class="col-md-7" >
                      <input id="code" type="text" class="form-control" name="code" ng-model="couponInput" placeholder="Coupon">
                  </div>

                  <label for="code" class="col-md-5 control-label">
                      <button type="button" class="float-right btn btn-info btn-md" ng-click="submitCoupon()" >Check Coupon</button>
                  </label>
                  <div class="col-md-12">
                    <span ng-class="invalidCoupon">Invalid Coupon</span>
                    <span ng-class="validCoupon">Valid Coupon</span>
                  </div>
              </div>

              <div class="orderProceed col-md-12">
                <button type="button" class="btn btn-success btn-lg"  data-toggle="modal" data-target="#myModal" ng-click="submitOrder()"><%buttonSubmitText%></button>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection
