<?php

require APPPATH . '/libraries/REST_Controller.php';
//use Restserver\Libraries\REST_Controller;
class Api_pegawai extends REST_Controller {
    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    function index_get() {
       $nip = $this->get('nip');
       if ($nip == ""){
       $peg = $this->db->query("select identpeg.nip, identpeg.nama, identpeg.gldepan, identpeg.glblk, jakhir.NJAB, eselon.neselon, concat(kuntp,kunkom,kununit,kunsk,kunssk) as kun, 
unkerja.nunker, golruang.NGOLRU, golruang.PANGKAT from identpeg 
join jakhir on identpeg.NIP=jakhir.NIP 
join pakhir on identpeg.nip=pakhir.NIP
join golruang on golruang.KGOLRU =pakhir.KGOLRU
join tkerja on identpeg.nip=tkerja.NIP
join eselon on jakhir.KESELON=eselon.KESELON
join unkerja on concat(kuntp,kunkom,kununit,kunsk,kunssk)=unkerja.kunker
where nunker <> 'PENSIUN' and nunker <> 'PINDAH' order by NGOLRU desc, nunker asc , neselon asc")->result();
       }else{
           $peg = $this->db->query("select identpeg.nip, identpeg.nama, identpeg.gldepan, identpeg.glblk, jakhir.NJAB, eselon.neselon, concat(kuntp,kunkom,kununit,kunsk,kunssk) as kun, 
unkerja.nunker, golruang.NGOLRU, golruang.PANGKAT from identpeg 
join jakhir on identpeg.NIP=jakhir.NIP 
join pakhir on identpeg.nip=pakhir.NIP
join golruang on golruang.KGOLRU =pakhir.KGOLRU
join tkerja on identpeg.nip=tkerja.NIP
join eselon on jakhir.KESELON=eselon.KESELON
join unkerja on concat(kuntp,kunkom,kununit,kunsk,kunssk)=unkerja.kunker
 where identpeg.nip='$nip' order by NGOLRU desc, nunker asc , neselon asc")->result();
       }
       
//       $data = $this->format->factory($peg)->to_json();
       $this->response($peg, 200);
       return;
//       echo $data;
       }
       
    function pegawaiSkpd_get() {
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
       
//       $data = $this->format->factory($peg)->to_json();
       $this->response($peg, 200);
       return;
//       echo $data;
       }

}
