<table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>

                                                        <th width="40%">Nama Urusan</th>

                                                        <th>Bidang Urusan / Sub Bidang Urusan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no=1; 
                                                        foreach ($get_SetAsistenBidangWhereAsisten as $gtdwk){
                                                        
                                                            $nama_urusan = $gtdwk->nama_urusan;
                                                    ?>
                                                    <tr>
                                                        <td><?= $no;?></td>
                                                      
                                                        <td><?= $nama_urusan;?></td>
                                                       
                                                    </tr>
                                                        <?php $no++; } ?>

                                                </tbody>
                                            </table>

