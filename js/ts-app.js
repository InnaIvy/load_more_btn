// JavaScript Document

( function() {
    "use strict";

    var tsApp = angular.module( 'tsApp',
        [
            'ngAnimate',
            'ts.post.service',
            'ts.post',
        ] )

        .config([

            '$animateProvider',

            function(  $animateProvider ) {
                //  CSS Animation fixes
                    $animateProvider.classNameFilter(/^((?!(fa-spin)).)*$/);

            }]);

})();
