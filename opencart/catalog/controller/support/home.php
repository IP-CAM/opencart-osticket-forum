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

class ControllerSupportHome extends Controller {
    public function index() {
        $this->document->setTitle($this->config->get('config_title'));
        $this->document->setDescription($this->config->get('config_meta_description'));

        $this->data['heading_title'] = $this->config->get('config_title');
        
        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/support/home.tpl')) {
            $this->template = $this->config->get('config_template') . '/template/support/home.tpl';
        } else {
            $this->template = 'default/template/support/home.tpl';
        }
        
        $this->children = array(
            'common/column_left',
            'common/column_right',
            'common/content_top',
            'common/content_bottom',
            'common/footer',
            'common/header'
        );
                                        
        $this->response->setOutput($this->render());
    }
}
?>