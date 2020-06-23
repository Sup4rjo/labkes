<div class="modal fade" id="modal_katagori" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Data Katagori</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <table id="lookup" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>Kode Katagori</th>
                            <th>Nama Katagori</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        //Data mentah yang ditampilkan ke tabel    
                        $sql = mysqli_query($link,'SELECT * FROM katagori_tarif');
                        while ($r = mysqli_fetch_array($sql)) {
                            ?>
                            <tr class="pilihkatagori" data-kdkatagori="<?php echo $r['kode_katagori']; ?>" data-namakatagori="<?php echo $r['nama_katagori']; ?>">
                                <td><?php echo $r['kode_katagori']; ?></td>
                                <td><?php echo $r['nama_katagori']; ?></td>
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