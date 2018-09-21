<?php

require APPPATH . '/libraries/REST_Controller.php';

class Api_skpd extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    function index_get() {
        $kun = $this->get('kunker');
        if ($kun == "") {
            $skpd = $this->db->query("select 
           kunker, 
           substr(kunker,1,2) as kuntp, 
           substr(kunker,3,2) as kunkom, 
           substr(kunker,5,2) as kununit,
           substr(kunker,7,2) as kunsk, 
           substr(kunker,9,2) as kunssk, 
           substr(kunker, 3, 2) as kun_esl2, 
           substr(kunker, 5, 6) as kun_1, 
           nunker 
           from unkerja 
           having kun_1='000000' 
           and kun_esl2 not in(select substr(kunker, 3, 2) as kun from unkerja having (kun between 39 and 46))
           and kun_esl2 between 1 and 47")->result();
        } else {
            $skpd = $this->db->query("select 
           kunker, 
           substr(kunker,1,2) as kuntp, 
           substr(kunker,3,2) as kunkom, 
           substr(kunker,5,2) as kununit,
           substr(kunker,7,2) as kunsk, 
           substr(kunker,9,2) as kunssk, 
           substr(kunker, 3, 2) as kun_esl2, 
           substr(kunker, 5, 6) as kun_1, 
           nunker 
           from unkerja 
           having kun_1='000000' 
           and kun_esl2 not in(select substr(kunker, 3, 2) as kun from unkerja having (kun between 39 and 46))
           and kun_esl2 between 1 and 47 and kunker = '$kun'")->result();
        }
//        $data = $this->format->factory($skpd)->to_json();
//        echo $data;
        $this->response($skpd, 200);
       return;
    }

}
