<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: nexus
 * Date: 08/03/17
 * Time: 03:16
 * This displays post that can be queried with specific urls.
 */

require_once "../application/config/reCaptcha.php";

/**
 * Class Rigid
 * @property Posts_model posts
 */
class Rigid extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Posts_model", "posts");
    }

    public function index()
    {
        $this->post();
    }

    public function post($postId = NULL)
    {
        $headerData = array();

        $headerData['style_src'] = array(
            '/assets/css/bootstrap.min.css',
            '/assets/css/main.css',
        );

        $this->load->view('parts/header', $headerData);
        $this->load->view('parts/navbar');
        $this->load->view('parts/page_content_start');
        if ($postId == NULL) {
            $post = $this->posts->getLastPosts(1);
            $this->load->view('parts/post_template', array("post" => $post[0]));
        } else {
            $post = $this->posts->getPost($postId);
            if ($post != NULL)
                $this->load->view('parts/post_template', array("post" => $post));
        }


        $this->load->view('parts/page_content_end');
        $this->load->view('parts/footer');

    }

}