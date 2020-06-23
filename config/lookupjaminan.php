<div class="modal fade" id="modaljaminan" tabindex="-1" role="dialog" aria-labelledby="modaljaminan" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 90%">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Dokumen Jaminan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body table-responsive">
                <table id="lookupjaminan" class="dt table table-bordered table-sm table-hover table-striped nowrap">
                     <thead>
                         <tr>
                            <th>No Register</th>
                            <th>Kode Jaminan</th>
                            <th>Nama Jaminan</th>
                            <th>Jenis Jaminan</th>
                            <th>Nilai Pasar</th>
                            <th>Nilai Likuidasi</th>
                            <th>Keterangan</th>
                         </tr>
                     </thead>
                     <tbody>
                         <?php
                         //Data mentah yang ditampilkan ke tabel    
                         $sql = mysqli_query($link,'SELECT dokjaminan.*, jenisjaminan.jenis_jaminan as jenis FROM dokjaminan LEFT JOIN jenisjaminan ON dokjaminan.jenis_jaminan=jenisjaminan.id');
                         while ($r = mysqli_fetch_array($sql)) {
                             ?>
                             <tr class="pilihjaminan" data-kodejaminan="<?php echo $r['kode_jaminan']; ?>">
                                 <td><?php echo $r['no_register']; ?></td>
                                 <td><?php echo $r['kode_jaminan']; ?></td>
                                 <td><?php echo $r['nama_jaminan']; ?></td>
                                 <td><?php echo $r['jenis']; ?></td>
                                 <td><?php echo $r['nilai_pasar']; ?></td>
                                 <td><?php echo $r['nilai_likuidasi']; ?></td>
                                 <td><?php echo $r['keterangan']; ?></td>
                                 
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
        $('#lookupjaminan thead tr').clone(true).appendTo( '#lookupjaminan thead' );
        $('#lookupjaminan thead tr:eq(1) th').each( function (i) {
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
        var table = $('#lookupjaminan').DataTable( {
            orderCellsTop: true,
            dom: 'lrtip',
        } );
    });
</script>