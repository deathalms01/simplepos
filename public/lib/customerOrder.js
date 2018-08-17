var customerOrdersApp = angular.module('customerOrdersApp', [], function($interpolateProvider) {
  $interpolateProvider.startSymbol('<%');
  $interpolateProvider.endSymbol('%>');
});

customerOrdersApp.controller('dataController', ['$scope', '$http', function($scope, $http){


  $http({
    method: 'GET',
      url: '/getProductList'
  }).then(function successCallback(response) {
    $scope.products = response.data;
  }, function errorCallback(response) {
    console.log("Could not get data. Error: "+response.data);
  });

  $scope.classBurger='active';
  $scope.classBeverage='';
  $scope.classCombo='';
  $scope.type = "burger";

  $scope.changeType = function(type){
    $scope.type = type;

    $scope.classBurger='';
    $scope.classBeverage='';
    $scope.classCombo='';

    if(type == 'burger'){
      $scope.classBurger='active';
    }
    if(type == 'beverage'){
      $scope.classBeverage='active';
    }
    if(type == 'combo'){
      $scope.classCombo='active';
    }
  }

  $scope.cart = [];
  $scope.totalPayable = (0).toFixed(2);

  $scope.addCartItem = function(index){
    $scope.cart.push({
      id: $scope.products[index].id,
      description: $scope.products[index].description,
      price: $scope.products[index].price,
      qty: 1,
      totalPrice: $scope.products[index].price
    });
    getTotalPayable();
  };

  $scope.isDiscounted="";

  var getTotalPayable = function(){
    $scope.totalPayable = (0).toFixed(2);
    for(var i =0; i<$scope.cart.length; i+=1){
      $scope.totalPayable=parseFloat($scope.cart[i].totalPrice)+parseFloat($scope.totalPayable);
    }

    if($scope.couponcode.discount!=null){
      $scope.totalPayable = parseFloat($scope.totalPayable)-
      (parseFloat($scope.totalPayable)*parseFloat($scope.couponcode.discount));
      $scope.isDiscounted="(Discount "+$scope.couponcode.discount*100+'%)';
    }
  }

  $scope.addQtyCartItem = function(index){
    $scope.totalPayable = (0).toFixed(2);
    for(var i = 0; i < $scope.products.length; i+=1) {
        if($scope.products[i].id === $scope.cart[index].id) {
          productQty = $scope.products[i].qty;
          $scope.theIndex = productQty;
        }
    }

    if($scope.cart[index].qty<productQty){
      $scope.cart[index].qty += 1;
      $scope.cart[index].totalPrice = ($scope.cart[index].price * $scope.cart[index].qty).toFixed(2);

    }
    getTotalPayable();
  }

  $scope.removeQtyCartItem = function(index){
    if($scope.cart[index].qty>1){
      $scope.cart[index].qty -= 1;
      $scope.cart[index].totalPrice = ($scope.cart[index].price*$scope.cart[index].qty).toFixed(2);

    }
    getTotalPayable();
  }

  $scope.removeCartItem = function(index){
    getTotalPayable();
    $scope.cart.splice(index, 1);
  };

  $scope.couponcode = null;
  $scope.invalidCoupon = 'hidden';
  $scope.validCoupon = 'hidden'

  $scope.submitCoupon = function(){
    $http({
      method: 'GET',
      url: '/checkCoupon/'+$scope.couponInput
    }).then(function successCallback(response) {
      $scope.couponcode = response.data;
      $scope.data2 = response.data.discount;
      $scope.invalidCoupon = 'hidden';
      $scope.validCoupon = ''
      getTotalPayable();

      if(response.data.code==null){
        $scope.validCoupon = 'hidden'
        $scope.invalidCoupon = '';
        $scope.couponcode = null;
        $scope.isDiscounted="";
      }
      $scope.buttonSubmitText = "Proceed to Order";
    }, function errorCallback(response) {
      $scope.couponInput = null;
      console.log("Could not get data. Error: "+response.data);
    });
  }

  $scope.submitOrder = function(){
    var coupId = null;

    if($scope.cart.length<1){return}

    if($scope.couponcode==null&&$scope.couponInput!=null&&
      $scope.invalidCoupon == 'hidden'||
      $scope.couponcode!=$scope.couponInput){
      $scope.submitCoupon();
      $scope.buttonSubmitText = "Checking Coupon";
      return;
    }



    if($scope.couponcode!==null){
      coupId = $scope.couponcode.id;
    }

    var obj = [{
      couponId: coupId,
      totalPrice: $scope.totalPayable,
      items : $scope.cart
    }];

    $http({
        method: "POST",
        url: "/submitOrder",
        data: obj,
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
    }).then(function successCallback(response) {
      console.log("Success. Response: "+response.data);
      document.location.href = '/order/success',true;
    }, function errorCallback(response) {
      console.log("Could not send data. Error: "+response.data);
    });
  }

  $scope.buttonSubmitText = "Proceed to Order";
}])
