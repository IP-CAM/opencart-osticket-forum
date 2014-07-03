<?php
/*
* integration pack 2.0
* 
* ## Copyright (c) <2014> <minhaj: polarglow06@gmail.com, minhaj@vimmaniac.com>
* ## https://github.com/minhaj-vimmaniac
* ## http://vimmaniac.com/
* ## under the MIT license
*
*
*
* 
*/


class ControllerSupportService extends Controller {
    function index() {
        $data = array();
        $data['c'] = array();
        $data['u'] = array();
        /*
        if ( $this->customer->isLogged() ) {
            $data['c']['logged'] = true; //logged in
            $data['c']['cid'] = $this->customer->getId();
            $data['c']['sidh'] = md5($this->session->getId());
        } else {
            $data['c']['logged'] = false;
            $data['c']['cid'] = 0;
            $data['c']['sidh'] = 0;
        }
        */
//         $this->response->setOutput(json_encode($data));
        
//         $this->response->setOutput(json_encode($this->request->post));
    }
}

?>