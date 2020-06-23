<div class="modal fade" id="modal_tarif" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 800px">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Data Tarif</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <table id="lookup" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>Kode Produk</th>
                            <th>Nama Produk</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        //Data mentah yang ditampilkan ke tabel    
                        $sql = mysqli_query($link,'SELECT * FROM produk_tarif');
                        while ($r = mysqli_fetch_array($sql)) {
                            ?>
                            <tr class="pilihproduk" data-kdproduk="<?php echo $r['kode_produk']; ?>" data-namaproduk="<?php echo $r['nama_produk']; ?>">
                                <td><?php echo $r['kode_produk']; ?></td>
                                <td><?php echo $r['nama_produk']; ?></td>
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