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

class ControllerSupportTicket extends Controller {
    public function index() {
        $this->document->setTitle($this->config->get('config_title'));
        $this->document->setDescription($this->config->get('config_meta_description'));
        $this->document->addScript('catalog/view/javascript/jquery.iframe-auto-height.plugin.1.7.1.min.js');

        $this->data['heading_title'] = $this->config->get('config_title');
        
        $this->data['osticket_url'] = OSTICKET_URL;
        
        if ( $this->customer->isLogged() ) {
            $this->data['session_id_hash'] = md5($this->session->getId());
        } else {
            $this->data['session_id_hash'] = 0;
            $this->redirect($this->url->link('account/login'));
        }
        
        $this->data['final_url'] = OSTICKET_URL;
        
        
        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/support/support_ticket.tpl')) {
            $this->template = $this->config->get('config_template') . '/template/support/support_ticket.tpl';
        } else {
            $this->template = 'default/template/support/support_ticket.tpl';
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