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


<form action="./controller/controller.php" enctype="multipart/form-data" method="post">

<div class="form-row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="nama">Nama</label>
            <input type='hidden' name='id' value='<?php echo $id; ?>'>
            <input type="text" name="nama_peserta_lte" id="nama" class="form-control" required value="<?php echo $nama; ?>">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="jenis_kelamin">Jenis Kelamin</label>
            <select id="inputState" class="form-control" name="jenis_kelamin_lte" required>
                <option selected>Choose...</option>
                <option <?php echo ($jenis_kelamin == 'Laki-laki') ? "selected": "" ?> >Laki-laki</option>
                <option <?php echo ($jenis_kelamin == 'Perempuan') ? "selected": "" ?>>Perempuan</option>
            </select>
        </div>
    </div>
</div>

<div class="form-row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="tgl">Tanggal Lahir</label>
            <input type="date" name="tgl_lahir_lte" id="tgl" class="form-control datepicker" required value="<?php echo $tgl_lahir; ?>" >
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="tgl">Hoby</label>
            <select id="inputState" class="form-control" name="hoby_lte" required>
                <option selected>Choose...</option>
                <option <?php echo($hoby == 'Sepak Bola') ? "selected": "" ?> >Sepak Bola</option>
                <option <?php echo($hoby == 'Bulu Tangkis') ? "selected": "" ?> >Bulu Tangkis</option>
                <option <?php echo($hoby == 'Coding') ? "selected": "" ?> >Coding</option>
                <option <?php echo($hoby == 'Lainya') ? "selected": "" ?> >Lainya</option>
            </select>
        </div>
    </div>
</div>

<div class="form-row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="inputFile">Input Gambar</label>
            <input type="file" class="form-control-file" id="inputFile" name="filegambar" required>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
        <div class="view overlay zoom">
        <img src="no-image.png" id="imgView" class="card-img-top img-fluid img-thumbnail" style="display: none;">
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
        <button type="submit" class="btn btn-primary" name="edit" value="edit">Save</button>
    </div>
</form>

<script>
    $("#inputFile").change(function(event) {  
      fadeInAdd();
      getURL(this);    
    });

    $("#inputFile").on('click',function(event){
      fadeInAdd();
    });

    function getURL(input) {    
      if (input.files && input.files[0]) {   
        var reader = new FileReader();
        var filename = $("#inputFile").val();
        filename = filename.substring(filename.lastIndexOf('\\')+1);
        reader.onload = function(e) {
          debugger;      
          $('#imgView').attr('src', e.target.result);
          $('#imgView').hide();
          $('#imgView').fadeIn(500);      
          $('.custom-file-label').text(filename);             
        }
        reader.readAsDataURL(input.files[0]);    
      }
      $(".alert").removeClass("loadAnimate").hide();
    }

    function fadeInAdd(){
      fadeInAlert();  
    }
    function fadeInAlert(text){
      $(".alert").text(text).addClass("loadAnimate");  
    }
</script>
<?php
    }
}
?>
