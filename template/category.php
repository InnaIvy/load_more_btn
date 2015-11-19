<section ng-controller="PostController as Post" class="mobile-container text-center main-cat-list">
    <div class="" ng-repeat="result in Post.result" ng-show="Post.loaded">
        <div class="cat-list-item">
            <div class="cat-list-item_image">
                <a href="{{result.link}}">
                    <img ng-hide="result.image"
                         src="<?php echo get_template_directory_uri(); ?>/library/images/no_photo.png" alt=""
                         class="img-responsive">
                    <img ng-show="result.image" src="{{result.image}}" alt="" class="img-responsive">
                </a>
            </div>
            <div class="cat-list-item_desc">
                {{result.post_title}}
            </div>
            <div class="cat-list-item_actions">
									<span class="cat-list-item_actions__link-gray" href="#">
										{{result.editor}} | </span>
                <a class="cat-list-item_actions__link-green" href="{{result.link}}">READ MORE <i
                        class="fa fa-chevron-right"></i></a>
            </div>
        </div>
    </div>
    <div ng-show="Post.loading" class="calculator__body__loader calculator-animate ng-animate ng-hide" style="">
        <i class="fa fa-refresh fa-5x fa-spin grey-color"></i>
    </div>
    <button class="load-more-btn-js btn btn-success" ng-click="Post.load_more()" ng-show="Post.show_btn">Load More
    </button>
</section>
