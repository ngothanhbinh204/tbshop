@extends('frontend.client.layout')

@section('title', 'Trang Giỏ Hàng')

@section('content')
    <div ng-app="shoppingCartApp" ng-controller="CartController" ng-init="initCart({{ json_encode($cartItems) }})">
        <!-- Giỏ hàng của bạn sẽ được hiển thị tại đây -->
        <table>
            <thead>
                <tr>
                    <th>Sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Giá gốc</th>
                    <th>Giảm giá ( % )</th>
                    <th>Tổng cộng</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="item in cart.items">
                    <td>
                        <img ng-src="@{{ item.product.image }}" width="100px" alt="">
                        <a href="@{{ '/client/product/detail/' + item.id_product }}">
                            <h6>@{{ item.product.name }}</h6>
                        </a>
                        <span>@{{ item.product_size }}</span>
                        <span style="color: @{{ item.product_color }}" class="fa fa-circle"></span>
                    </td>
                    <td>
                        <input id="productQuantityInput-@{{ item.id }}" ng-model="item.product_quantity"
                            min="0" type="number" class="form-control form-control-sm"
                            ng-change="updateQuantity(item)" />
                    </td>
                    <td>
                        <p ng-style="{'text-decoration': item.product.price_sale ? 'line-through' : ''}">
                            @{{ item.product_price }} ₫
                        </p>
                        <p ng-if="item.product.price_sale">
                            @{{ item.product_price - item.product.price_sale * 0.01 * item.product_price }} ₫
                        </p>
                    </td>
                    <td>@{{ item.product.price_sale }} %</td>
                    <td>@{{ item.product_quantity * (item.product_price - item.product.price_sale * 0.01 * item.product_price) }} ₫</td>
                    <td>
                        <i ng-click="removeProduct(item)" class="fa fa-close"></i>
                    </td>
                </tr>
            </tbody>
        </table>
        <div>
            <button class="primary-btn continue__btn update__btn" ng-click="reloadPage()">
                <i class="fa fa-spinner"></i> Cập nhật giỏ hàng
            </button>
        </div>
    </div>

    <script>
        var app = angular.module('shoppingCartApp', []);

        app.controller('CartController', function($scope, $http) {
            $scope.cart = {
                items: [],
                totalAmount: 0,
                priceCoupon: 0,
                totalPrice: 0,
                ship: 30000 // phí ship cố định
            };

            $scope.initCart = function(items) {
                $scope.cart.items = items;
                $scope.calculateTotal();
            };

            $scope.calculateTotal = function() {
                $scope.cart.totalAmount = $scope.cart.items.reduce(function(sum, item) {
                    return sum + (item.product_quantity * (item.product.price - item.product
                        .price_sale * 0.01 * item.product.price));
                }, 0);

                $scope.cart.totalPrice = ($scope.cart.totalAmount + $scope.cart.ship) - $scope.cart.priceCoupon;
            };

            $scope.updateQuantity = function(item) {
                var url = '/client/cart/update_quantity_product/' + item.id;
                var data = {
                    product_quantity: item.product_quantity
                };

                $http.post(url, data).then(function(response) {
                    if (response.data.remove_product) {
                        var index = $scope.cart.items.indexOf(item);
                        $scope.cart.items.splice(index, 1);
                        Swal.fire({
                            title: "Xoá thành công",
                            icon: "success",
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                    $scope.calculateTotal();
                }, function(error) {
                    console.error(error);
                });
            };

            $scope.removeProduct = function(item) {
                let url = '/client/cart/remove_product/' + item.id;

                Swal.fire({
                    title: 'Bạn có chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Xóa',
                    cancelButtonText: 'Hủy'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $http.post(url).then(function(response) {
                            var index = $scope.cart.items.indexOf(item);
                            $scope.cart.items.splice(index, 1);
                            Swal.fire({
                                title: "Xoá thành công",
                                icon: "success",
                                showConfirmButton: false,
                                timer: 1500
                            });
                            $scope.calculateTotal();
                        }, function(error) {
                            console.error(error);
                        });
                    }
                });
            };

            $scope.reloadPage = function() {
                location.reload();
            };
        });
    </script>
@endsection
