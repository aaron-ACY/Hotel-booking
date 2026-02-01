<?php

class Home extends Controller{
    public function index($a = '', $b = '', $c = ''){
        $model = new Model;
        $arr['id'] = 1;
        $arr['last_name'] = "An";
        $arr2['last_name'] = "Chi";
        $result = $model->where($arr, $arr2);

        show($result);
        $this->view('home');
    }


}

