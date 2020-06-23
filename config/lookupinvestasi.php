<div class="modal fade" id="modalinvestasi" tabindex="-1" role="dialog" aria-labelledby="modalinvestasi" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 90%">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Dokumen Investasi</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body table-responsive">
                <table id="lookupinvestasi" class="dt table table-bordered table-sm table-hover table-striped nowrap">
                     <thead>
                         <tr>
                             <th>No Register</th>
                             <th>Kode PPU</th>
                             <th>Nama PPU</th>
                             <th>Kode Fasilitas</th>
                             <th>Tanggal Pencairan</th>
                             <th>Plafond</th>
                             <th>No Perjanjian</th>
                             <th>Tanggal Perjanjian</th>
                         </tr>
                     </thead>
                     <tbody>
                         <?php
                         //Data mentah yang ditampilkan ke tabel    
                         $sql = mysqli_query($link,'SELECT * FROM dokinvestasi NATURAL JOIN ppu');
                         while ($r = mysqli_fetch_array($sql)) {
                             ?>
                             <tr class="pilihinvestasi" data-noregister="<?php echo $r['no_register']; ?>" data-kodeppu="<?php echo $r['kode_ppu']; ?>" data-namappu="<?php echo $r['nama_ppu']; ?>" data-plafond="<?php echo $r['plafond']; ?>">
                                 <td><?php echo $r['no_register']; ?></td>
                                 <td><?php echo $r['kode_ppu']; ?></td>
                                 <td><?php echo $r['nama_ppu']; ?></td>
                                 <td><?php echo $r['kode_fasilitas']; ?></td>
                                 <td><?php echo $r['tanggal_pencairan']; ?></td>
                                 <td><?php echo $r['plafond']; ?></td>
                                 <td><?php echo $r['no_perjanjian']; ?></td>
                                 <td><?php echo $r['tanggal_perjanjian']; ?></td>
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

<script src="assets/plugins/jquery/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $('#lookupinvestasi thead tr').clone(true).appendTo( '#lookupinvestasi thead' );
        $('#lookupinvestasi thead tr:eq(1) th').each( function (i) {
            var title = $(this).text();
            $(this).html( '<input class="form-control form-control-sm" type="text" placeholder="'+title+'" />' );
     
            $( 'input', this ).on( 'keyup change', function () {
                if ( table.column(i).search() !== this.value ) {
                    table
                        .column(i)
                        .search( this.value )
                        .draw();
                }
            } );
        } );
        var table = $('#lookupinvestasi').DataTable( {
            orderCellsTop: true,
            dom: 'lrtip',
        } );
    });
</script>