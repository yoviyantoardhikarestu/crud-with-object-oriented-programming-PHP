<?php
    include_once ('./controller/controller.php');

    $db = new config();
    $objek_view = new tampildata();

    //tunjuk koneksi db
    $config = $db->koneksi;

    //masukkan variabel tampil data
    $my_data = $objek_view->tampilkan_data($config); // ini adalah array

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>

    <!-- data table js and css-->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
    <!-- end data table js and css-->

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">

    <!-- JQuery -->
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>

    <link rel="icon" type="image/png" sizes="16x16" href="./icon/logo_blue.png">

</head>
<body>

<h1 class="text-center mt-3">Cread Read Update Delete</h1>
    <footer class="blockquote-footer text-center mb-5"><cite title="Source Title">Use Object Oriented Programming PHP</cite></footer>
    
    <?php echo"<a href='#add_data' data-toggle='modal' data-data='sss' class='btn btn-primary' role='button' style='margin-left:30px;'><i class='fas fa-plus-circle'></i> Add Data</a>";?>
    <div class="card" style="margin-left: 30px; margin-right:30px;">
        <div class="card-body">
        <table class="table table-striped table-bordered table-image" id="example">
            <thead>
                <th><center>No</center></th>
                <th><center>Picture</center></th>
                <th><center>Nama peserta</center></th>
                <th><center>Jenis Kelamin</center></th>
                <th><center>Tgl Lahir</center></th>
                <th><center>Hoby</center></th>
                <th><center>Aksi</center></th>
            </thead>

            <tbody >
                <?php
                
                    $no = 1;
                    if(is_array($my_data)){
                    foreach ($objek_view->tampilkan_data($config) as $row){
                ?>
                <tr>
                    <td style="vertical-align: middle;"><center><?php echo $no; ?></center></td>
                    <td style="vertical-align: middle;"><center>
                    <img src="data:image/jpeg;base64,<?=base64_encode($row['filegambar'] )?>" alt="thumbnail" class="rounded mx-auto d-block rounded-circle" style="width: 90px">
                    </center></td>
                    <td style="vertical-align: middle;"><center><?php echo $row['nama']; ?></center></td>
                    <td style="vertical-align: middle;"><center><?php echo $row['jenis_kelamin']; ?></center></td>
                    <td style="vertical-align: middle;"><center><?php echo $row['tgl_lahir']; ?></center></td>
                    <td style="vertical-align: middle;"><center><?php echo $row['hoby']; ?></center></td>
                    <td style="vertical-align: middle;"> 
                        <center>
                        <?php echo"<a href='#edit_data' data-toggle='modal' data-id='$row[id]'><i class='fas fa-edit' style='font-size: 25px; color: #262626;'></i></a>";?>
                        <?php echo"<a href='#view_data' data-toggle='modal' data-id='$row[id]'><i class='far fa-eye' style='font-size: 25px; color: #262626;'></i></a>";?>
                        <?php echo"<a href='#delete' data-toggle='modal' data-id='$row[id]'><i class='fas fa-trash' style='font-size: 25px; color: #262626;'></i></a>"?>
                        </center>
                    </td>
                </tr>
                    <?php $no++; }} ?>
            </tbody>
        </table>
        </div>
    </div>

<!-- view add data -->
<div class="modal fade" id="add_data" role="dialog">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><b>Tambah Data</b></h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                
                </div>
                <div class="modal-body">
                    <div class="view_add_data"></div>
            </div>
        </div>
    </div>
</div>
<!-- end view add data -->

<!-- view data -->
<div class="modal fade" id="view_data" role="dialog">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><b>Detail data</b></h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                
                </div>
                <div class="modal-body">
                    <div class="view_data"></div>
            </div>
        </div>
    </div>
</div>
<!-- end view data -->

<!-- view confirm delete -->

<div class="modal fade" id="delete" role="dialog">
    <div class="modal-dialog vertical-align-center" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><b>Konfirmasi hapus</b></h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                
                </div>
                <div class="modal-body">
                    <div class="view_confirm_delete"></div>
            </div>
        </div>
    </div>
</div>

<!-- end view confirm delete -->

<!-- view edit -->

<div class="modal fade" id="edit_data" role="dialog">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><b>Edit Data</b></h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                
                </div>
                <div class="modal-body">
                    <div class="view_edit"></div>
            </div>
        </div>
    </div>
</div>

<!-- end view edit -->

<!-- Jquery function data-table -->
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );
</script>
<!-- End Jquery Function data-table -->

<!-- Jquery function add -->
<script>
    $(document).ready(function(){
        $('#add_data').on('show.bs.modal', function(e){
            var data = $(e.relatedTarget).data('data');
            $.ajax({
                url : './controller/add.php',
                data : 'data='+data,
                type : 'post',
                success : function(data){
                    $('.view_add_data').html(data);
                }
            })
        })
    });
</script>
<!-- End Jquery Function add -->

<!-- Jquery function delete -->
<script>
    $(document).ready(function(){
        $('#delete').on('show.bs.modal', function(e){
            var data = $(e.relatedTarget).data('id');
            $.ajax({
                url : './controller/delete.php',
                data : 'data='+data,
                type : 'post',
                success : function(data){
                    $('.view_confirm_delete').html(data);
                }
            })
        })
    });
</script>
<!-- end Jquery function delete -->

<!-- Jquery view data -->
<script>
    $(document).ready(function(){
        $('#view_data').on('show.bs.modal', function(e){
            var data = $(e.relatedTarget).data('id');
            $.ajax({
                url : './controller/view.php',
                data: 'data='+data,
                type : 'post',
                success : function(data){
                    $('.view_data').html(data);
                }
            })
        })
    });
</script>
<!-- end Jquery view data -->

<!-- Jquery edit data -->

<script>
    $(document).ready(function(){
        $('#edit_data').on('show.bs.modal', function(e){
            var data = $(e.relatedTarget).data('id');
            $.ajax({
                url : './controller/edit.php',
                data : 'data='+data,
                type : 'post',
                success : function(data){
                    $('.view_edit').html(data);
                }
            })
        })
    });
</script>


<!-- end Jquery edit data -->
</body>
</html>