<?php
    include './controller.php';
    $id = $_POST['data'];

    $crud_data = new crud_data();
    $conn = new config();

    $is_array = $crud_data->liat_data($id, $conn->koneksi);

    if(is_array($is_array)){
        foreach($is_array as $row){
            $nama = $row['nama'];
            $jenis_kelamin = $row['jenis_kelamin'];
            $tgl_lahir = $row['tgl_lahir'];
            $hoby = $row['hoby'];
            $nama_file = $row['namafile'];
            $filegambar=$row['filegambar'];
?>

<form>

<div class="form-row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" name="nama" id="nama" class="form-control" readonly required value='<?php echo $nama; ?>'>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="jenis_kelamin">Jenis Kelamin</label>
            <select id="inputState" class="form-control" name="jenis_kelamin" required disabled>
                <?php echo"<option selected disabled>$jenis_kelamin</option>";?>
            </select>
        </div>
    </div>
</div>

<div class="form-row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="tgl">Tanggal Lahir</label>
            <input type="date" name="tgl_lahir" id="tgl" class="form-control datepicker" readonly required value="<?php echo $tgl_lahir; ?>">
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="tgl">Hoby</label>
            <select id="inputState" class="form-control" name="hoby" required readonly disabled>
                <?php echo"<option selected disabled>$hoby</option>";?>
            </select>
        </div>
    </div>
</div>

<div class="form-row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="inputFile">Input Gambar</label>
            <input type="file" class="form-control-file" id="inputFile" name="filegambar" required value="<?php echo $nama_file ?>" readonly>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
        <div class="view overlay zoom">
        <img src="data:image/jpeg;base64,<?=base64_encode($row['filegambar'])?>" id="imgView" class="card-img-top img-fluid img-thumbnail" style="width: 120px;">
        <div class="mask flex-center waves-effect waves-light">
            <p class="blue-text">Image Preview</p>
        </div>
        </div>
        </div>
    </div>
</div>
<br>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
</form>

<?php
    }
}
?>

