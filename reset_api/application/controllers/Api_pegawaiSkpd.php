<?php

require APPPATH . '/libraries/REST_Controller.php';

class Api_pegawaiSkpd extends REST_Controller {
    function __construct($config = 'rest') {
        parent::__construct($config);
    }
function index_get() {
       $kuntp = $this->get('kuntp');
       $kunkom = $this->get('kunkom');
       $peg = $this->db->query("select 
identpeg.nip, 
identpeg.nama, 
identpeg.gldepan, 
identpeg.glblk, 
jakhir.NJAB, 
eselon.neselon, 
kuntp,kunkom,kununit,kunsk,kunssk,
concat(kuntp,kunkom,kununit,kunsk,kunssk) as kun, 
unkerja.nunker, golruang.NGOLRU, golruang.PANGKAT from identpeg 
join jakhir on identpeg.NIP=jakhir.NIP 
join pakhir on identpeg.nip=pakhir.NIP
join golruang on golruang.KGOLRU =pakhir.KGOLRU
join tkerja on identpeg.nip=tkerja.NIP
join eselon on jakhir.KESELON=eselon.KESELON
join unkerja on concat(kuntp,kunkom,kununit,kunsk,kunssk)=unkerja.kunker
where nunker <> 'PENSIUN' and nunker <> 'PINDAH' and kuntp='$kuntp' and kunkom='$kunkom' order by kun asc")->result();
       $this->response($peg, 200);
       return;
//       $data = $this->format->factory($peg)->to_json();
//       echo $data;
       }
}
