/**
 * Created by ipl on 18/11/2015.
 */


(function() {
    'use strict';

    angular
        .module( 'ts.post.service', [] )
        .factory('postService', postService );

    //  Inject dependencies
    postService.$inject = ['$http', '$log'];

    /**
     *
     * @param $http
     * @param $log
     * @returns {{sum: sum}}
     */
    function postService($http,$log){

        //  Using practice Revealing module Pattern
        //  http://addyosmani.com/resources/essentialjsdesignpatterns/book/#revealingmodulepatternjavascript
        var service = {
            load_more: load_more,
        };
        return service;

        /**
         * Send a post data to load_more method
         *
         * @param data
         * @returns {IPromise<TResult>}
         */
        function load_more(offset, limit){

            return 	$http.post( '', {
                tsp_action:'load_more',
                offset: offset,
                limit: limit
            } )
               .then(showPostComplete)
               .catch(showPostFailed);

            function showPostComplete(response){
                return response.data;


            }

            function showPostFailed(error){
                $log.error('XHR Failed for getAvengers.' + error.data);
            }
        }
    }
})();