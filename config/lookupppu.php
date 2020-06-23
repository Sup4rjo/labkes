<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Data PPU</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <table id="lookup" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>Kode PPU</th>
                            <th>Nama PPU</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        //Data mentah yang ditampilkan ke tabel    
                        $sql = mysqli_query($link,'SELECT * FROM ppu');
                        while ($r = mysqli_fetch_array($sql)) {
                            ?>
                            <tr class="pilihppu" data-kodeppu="<?php echo $r['kode_ppu']; ?>" data-namappu="<?php echo $r['nama_ppu']; ?>">
                                <td><?php echo $r['kode_ppu']; ?></td>
                                <td><?php echo $r['nama_ppu']; ?></td>
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