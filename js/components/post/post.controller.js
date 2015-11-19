/**
 * Created by ipl on 18/11/2015.
 */

(function() {
    'use strict';

    angular.module( 'ts.post', [] )
        .controller( 'PostController', ['$scope', '$log', 'postService',  function( $scope, $log, postService ){

            var vm = this;

            vm.result = [];
            vm.loading = false;
            vm.loaded = false;
            vm.show_btn = true;
            vm.offset = 0;
            vm.limit = 5;
            vm.remaining = null;



            vm.load_more = function(){

                vm.loading = true;

                postService.load_more(vm.offset, vm.limit)
                .then(function (response) {
                        vm.loaded = true;
                        angular.forEach(response.result, function(value, key) {
                             vm.result.push(value);
                        });

                        vm.offset = vm.result.length;
                        vm.remaining =  response.remaining;

                        if(vm.remaining < 1){
                            vm.show_btn = false;
                        }
                        vm.loading = false;
                    },
                    function(response){
                    })
                    .catch(function(){

                    });
            }

            vm.load_more();

        }])

})();
