@extends("layouts.master")
@section('title') BikeShop | อุปกรณ์จักรยาน @stop
@section('content')

<div class="container" ng-app="app" ng-controller="ctrl">
    <div class="row">
        <div class="col-md-3">
            <div class="list-group">
                <a href="#" class="list-group-item" ng-class="{'active': category == null}" ng-click="getProductList(null)">ทั้งหมด</a>
                <a href="#" class="list-group-item" ng-repeat="c in categories" ng-click="getProductList(c)" ng-class="{'active': category.id == c.id}">@{c.name}</a>
            </div>
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-3" ng-repeat="p in products">
                    <!-- product card -->
                    <div class="panel panel-default bs-product-card">
                        <img ng-src="@{p.image_url}" class="img-responsive">
                        <div class="panel-body">
                            <h4><a href="#">@{ p.name }</a></h4>

                            <div class="form-group">
                                <div>คงเหลือ: @{p.stock_qty}</div>
                                <div>ราคา <strong>@{p.price}</strong> บาท</div>
                            </div>

                            <a href="#" class="btn btn-success btn-block" ng-click="addToCart(p)">
                            <i class="fa fa-shopping-cart"></i> หยิบใส่ตะกร้า</a>

                        </div>
                    </div>

                    <!-- end product card -->
                </div>
            </div>
        </div>

    </div>
    <script type="text/javascript">
        var app = angular.module('app', []).config(function($interpolateProvider) {
            $interpolateProvider.startSymbol('@{').endSymbol('}');
        });
        app.service('productService', function($http) {
            this.getProductList = function(category_id) {
                if(category_id) {
                    return $http.get('/api/product/' + category_id);
                    }
                return $http.get('/api/product');
            };
            this.getCategoryList = function() {
                return $http.get('/api/category');
            };
            
        });
        app.controller('ctrl', function($scope, productService) {
            $scope.products = [];
            $scope.getProductList = function () {
                productService.getProductList().then(function (res) {
                    if(!res.data.ok) return;
                        $scope.products = res.data.products;
                    });
            };
            $scope.getProductList();

            $scope.categories = [];
            $scope.getCategoryList = function () {
                productService.getCategoryList().then(function (res) {
                    if(!res.data.ok) return;
                        $scope.categories = res.data.categories;
                    });
            };
            $scope.getCategoryList();

            $scope.category = {};
            $scope.getProductList = function (category) {
                $scope.category = category;
                category_id = category != null ? category.id : '';
                productService.getProductList(category_id).then(function (res) {
                    if(!res.data.ok) return;
                        $scope.products = res.data.products;
                    });
            };
            $scope.getProductList(null);

            $scope.addToCart = function (p) {
                window.location.href = '/cart/add/' + p.id;
            };
        });
    </script>
</div>
@endsection