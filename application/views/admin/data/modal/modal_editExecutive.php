<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
foreach ($get_SetExecutiveWhereId as $row){
    $id_exe = $row->id;
    $id_bank = $row->id_bank;
    $id_executive = $row->id_executive;
    $nama = $row->nama;
    $email = $row->email;
    $no_rekening = $row->no_rekening;
}
?>
                        <div class="form-group col-md-12">
                            <label>Executive</label>
                            <select name='id_executive' id='id_executive' class="btn btn-default select2" style="width: 100%" required>
                                <option value='' >-- Pilih Jabatan Executive --</option>
                                <?php
                                foreach ($get_ref_executive as $gra) {
                                    $id = $gra->id;
                                    $nama_jabatan = $gra->nama;
                                    echo"<option value='" . $id . "'"; if($id_executive == $id) echo"selected"; echo">" . $nama_jabatan . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                            <div class="form-group col-md-12">
                                <label>Nama</label>
                                <input type="text" class="form-control" name="nama" id='nama' required value="<?= $nama;?>">
                            </div>
                        <div class="form-group col-md-12">
                            <label>Email</label>
                            <input type="email" class="form-control" id="email" name="email" required value="<?= $email;?>">
                        </div>
                        <div class="form-group col-md-12">
                            <label>Nama Bank</label>
                            <select name='id_bank' id='id_bank' class="btn btn-default select2" style="width: 100%" required>
                                <option value='' >-- Pilih Bank --</option>
                                <?php
                                foreach ($get_refbank as $grb) {
                                    $id = $grb->id;
                                    $nama = $grb->nama_bank;
                                    $kode = $grb->kode;
                                    echo"<option value='" . $id . "'"; if($id_bank == $id) echo"selected"; echo">".$kode. " - " . $nama . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Nomor Rekening</label>
                            <input type="text" class="form-control" id="no_rekening" name="no_rekening" required value="<?= $no_rekening;?>">
                            <input type="hidden" class="form-control" id="id" name="id" required value="<?= $id_exe;?>">
                        </div>
<script type="text/javascript">
    $(function () {
    $(".select2").select2();
    });
    </script>