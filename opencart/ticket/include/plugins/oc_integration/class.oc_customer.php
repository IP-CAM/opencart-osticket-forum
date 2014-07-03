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

class Oc_customer {
    var $oc_customer_id;
    var $db_array;
    
    function __construct($oc_customer_id) {
        $this->oc_customer_id = $oc_customer_id;
        
        $sql = 'SELECT * FROM oc_customer WHERE customer_id=' . db_input($oc_customer_id);
        if ( ($res = db_query($sql)) && db_num_rows($res) ) {
            $customer = db_fetch_array($res);
            $this->db_array = $customer;
        } else {
            return false;
        }
    }
    
    function isValid() {
        return $this->getId();
    }
    
    function isCustomer() {
        return true;
    }
    
    function isGuest() {
        return false;
    }
    
    function getName() {
        $name = $this->db_array['firstname'] . ' ' . $this->db_array['lastname'];
        return $name;
    }
    
    function getId() {
        return $this->db_array['customer_id'];
    }
    
    function getUserName() {
        return $this->db_array['username'];
    }
    
    function getEmail() {
        return $this->db_array['email'];
    }
    
    function getPhoneNumber() {
        return $this->db_array['telephone'];
    }
    
    private function getStats() {

        $sql='SELECT count(open.ticket_id) as open, count(closed.ticket_id) as closed '
            .' FROM '.TICKET_TABLE.' ticket '
            .' LEFT JOIN '.TICKET_TABLE.' open
                ON (open.ticket_id=ticket.ticket_id AND open.status=\'open\') '
            .' LEFT JOIN '.TICKET_TABLE.' closed
                ON (closed.ticket_id=ticket.ticket_id AND closed.status=\'closed\')'
            .' LEFT JOIN '.TICKET_COLLABORATOR_TABLE.' collab
                ON (collab.ticket_id=ticket.ticket_id
                    AND collab.user_id = '.db_input($this->getId()).' )'
            .' WHERE ticket.user_id = '.db_input($this->getId())
            .' OR collab.user_id = '.db_input($this->getId());

        return db_fetch_array(db_query($sql));
    }
    
    function getTicketStats() {

        if (!isset($this->db_array['stats']))
            $this->db_array['stats'] = $this->getStats();

        return $this->db_array['stats'];
    }
    
    function getNumTickets() {
        return ($stats=$this->getTicketStats())?($stats['open']+$stats['closed']):0;
    }
    
    function getNumOpenTickets() {
        return ($stats=$this->getTicketStats())?$stats['open']:0;
    }
    
    function getNumClosedTickets() {
        return ($stats=$this->getTicketStats())?$stats['closed']:0;
    }
}


?>