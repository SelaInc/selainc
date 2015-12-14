/**
 * Created by simba on 13/12/2015.
 */

angular
    .module('SI', ['ngResource', 'angulartics', 'angulartics.google.analytics'])

    .config(['$httpProvider', function ($httpProvider) {
        //$httpProvider.defaults.withCredentials = true;
        $httpProvider.defaults.withCredentials = false;
    }])

    .directive('contactForm', function ($http) {
        return {
            restrict: 'AE',
            replace: 'true',
            templateUrl: 'partials/contact-form.html',
            link: function ($scope, element, attributes) {

                $scope.formData = {};
                $scope.submitted = false;
                $scope.resultMessage = {};
                $scope.result = 'hidden';
                $scope.submitButtonDisabled = false;
                $scope.querys = ['Website Design/Development', 'Branding/Logo Design', 'Advertising', 'Exhibition Design', 'Email Marketing','Something else'];
                $scope.formData.query = $scope.querys[0];

                $scope.submit = function (contactform) {
                    $scope.submitted = true;
                    $scope.submitButtonDisabled = true;
                    if (contactform.$valid) {
                        $http({
                            method: 'POST',
                            url: '/blog/contact-send.php',
                            data: $.param($scope.formData),  //param method from jQuery
                            headers: {'Content-Type': 'application/x-www-form-urlencoded'}  //set the headers so angular passing info as form data (not request payload)
                        }).success(function (data) {
                            console.log(data);
                            if (data.success) { //success comes from the return json object
                                $scope.submitButtonDisabled = true;
                                $scope.resultMessage = data.message;
                                $scope.result = 'bg-success';
                            } else {
                                $scope.submitButtonDisabled = false;
                                $scope.resultMessage = data.message;
                                $scope.result = 'bg-danger';
                            }
                        });
                    } else {
                        $scope.submitButtonDisabled = false;
                        $scope.resultMessage = 'Please fill out all the fields correctly.';
                        $scope.result = 'bg-danger';
                    }
                    //        console.log($scope.formData);
                }
            }
        };
    })