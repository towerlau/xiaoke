<?php
class XiaoKe extends LController
{
    public function index(){
        $this->loadView('xiaoke');
    }
    public function touch(){
        $this->loadView('touch');
    }
    public function showData(){
        echo 'lkl';
        $this->load->model('user_model','um');
        $r=$this->um->getX();
        foreach ($r as $row)
        {
            echo $row->title;
        }
    }
    public function sImage(){

//        $this->load->model('Image_Model','IM');
//        $this ->IM->src = "../assets/imgs/banner.jpg";
//        var_dump(__FILE__);
////        $image = new Image($src);
//        $this ->IM->percent = 0.2;
//        $this ->IM->openImage();
//        $this ->IM->thumpImage();
//        $this ->IM->showImage();
//        $this ->IM->saveImage(md5("aa123"));
//        echo 'ok';
        $this->write("../assets/imgs/banner.jpg", "../assets/imgs/banner1.jpg");
        echo 'ok';
    }


}