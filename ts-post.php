<?php

/**
 * User: ipl
 * Date: 18/11/2015
 */


class Post_Ajax{

    private $ajax_action = 'tsp_action';

    function __construct() {
        \TS_AJAX::processAjax('TS_POST', $this->ajax_action);
    }

}

$pajax = new Post_Ajax();

/**
 * Class TS_POST
 */


class TS_POST{

    /**
     * load_more
     *
     * @author    : Inna Plyushch | ipl@ciklum.com
     *
     * @param $data
     *
     * Get posts by category
     *
     * @copyright ReviMedia Inc. 2015
     */

   public static function load_more($data){
        $errors = 0;
        $response = array();
        $messages = array();
        $result = null;
        $offset = 0;

       $limit = $data->limit;
       if(isset($data->offset))
          $offset = $data->offset;

        try {
            $result = self::get_posts($offset, $limit);
            $remaining = self::get_total_post_count($offset, $limit);
          //  var_dump($posts);
            $messages[] = 'Success!';

        } catch (Exception $e) {
            $errors++;
            $messages[] = $e->getMessage();
        }

        $response['errors'] = $errors;
        $response['messages'] = $messages;
        $response['result'] = $result;
        $response['remaining'] = $remaining;

        exit(json_encode($response));
    }

    /**
     * get_posts
     *
     * @author    : Inna Plyushch | ipl@ciklum.com
     *
     * @param int $offset
     * @param int $item_count
     *
     * @return mixed
     *
     * @copyright ReviMedia Inc. 2015
     */
    public static function get_posts( $offset = 0, $item_count = 5){
        global $wpdb;

        $posts= $wpdb->get_results( " SELECT ID, post_title, post_author  FROM `wp_posts` WHERE `post_type` = 'post' LIMIT $offset, $item_count" );
        foreach ($posts as $post){
            //get feature image

            $thumb_id = \get_post_thumbnail_id($post->ID);
            $thumb_url = \wp_get_attachment_image_src($thumb_id,'large');
            $post->image =   $thumb_url[0];
            //get post url
            $post->link =   \get_permalink($post->ID);

            //get post author
            $author_meta =\get_the_author_meta( 'user_nicename',$post->post_author);
            $post->editor = $author_meta;
        }
        return $posts;
    }

    /**
     * get_total_post_count
     *
     * @author    : Inna Plyushch | ipl@ciklum.com
     *
     * @param int $offset
     * @param int $item_count
     *
     * @return mixed
     *
     * @copyright ReviMedia Inc. 2015
     */

    private static function get_total_post_count($offset = 0, $item_count = 5){
        global $wpdb;

        $total = $wpdb->get_var(
            "SELECT
            COUNT( DISTINCT ( ID ) )
            FROM `wp_posts`
            WHERE `post_type` = 'post'
            "
        );
        //	calculate remaining items
        $remaining = $total - ( $offset + $item_count );

        return $remaining;

    }

}