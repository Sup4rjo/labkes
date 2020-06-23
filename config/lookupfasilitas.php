<div class="modal fade" id="modalfasilitas" tabindex="-1" role="dialog" aria-labelledby="modalfasilitas" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Data Fasilitas</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <table id="lookupfasilitas" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>Kode Fasilitas</th>
                            <th>Nama Fasilitas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        //Data mentah yang ditampilkan ke tabel    
                        $sql = mysqli_query($link,'SELECT * FROM jenisfasilitas');
                        while ($r = mysqli_fetch_array($sql)) {
                            ?>
                            <tr class="pilihfasilitas" data-kodefasilitas="<?php echo $r['kode_fasilitas']; ?>" data-namafasilitas="<?php echo $r['nama_fasilitas']; ?>">
                                <td><?php echo $r['kode_fasilitas']; ?></td>
                                <td><?php echo $r['nama_fasilitas']; ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>  
            </div>
        </div>
    </div>
</div>