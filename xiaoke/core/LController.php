<?php
/**
 * 
 */
class LController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function loadView($view,$data=null, $param=FALSE){
        $this->load->view('templates/head',['js'=>[[['jquery-3.1.0.min','vue.min'], '/assets/jslib/']], 'css' => [[['xiaoke.min'], '/assets/css/']]]);
        $this->load->view($view.'v', $data, $param);
    }
    public function  write($old, $new) {
        $maxsize=200;
        $image = new Imagick($old);
        if($image->getImageHeight() <= $image->getImageWidth())
        {
            $image->resizeImage($maxsize,0,Imagick::FILTER_LANCZOS,1);
        }
        else
        {
            $image->resizeImage(0,$maxsize,Imagick::FILTER_LANCZOS,1);
        }
        $image->setImageCompression(Imagick::COMPRESSION_JPEG);
        $image->setImageCompressionQuality(90);
        $image->stripImage();
        $image->writeImage($new);
        $image->destroy();
    }
}
