<?php
    include './controller.php';
    $id=$_POST['data'];

    $conn = new config();
    $data = new tampildata();

    $is_tampildata = $data->tampilkan_data($conn->koneksi);
    if(is_array($is_tampildata)){
        foreach($is_tampildata as $row){
            if($row['id'] == $id){
                $nama = $row['nama'];
            }
        }
    }


?>

<form action="./controller/controller.php" method="post">
<div class="custom-file mb-3">
    <div class="modal-body">
        <strong style="color: blue;">Anda yakin ingin menghapus data <?php echo $nama; ?></strong>
        <?php echo"<input type='hidden' name='id' value='$id'>";?>
            </div>
            <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="hapus">Hapus</button>
</div>
</form>