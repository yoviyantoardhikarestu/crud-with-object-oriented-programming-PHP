

<form action="./controller/controller.php" enctype="multipart/form-data" method="post">

<div class="form-row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" name="nama" id="nama" class="form-control" required>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="jenis_kelamin">Jenis Kelamin</label>
            <select id="inputState" class="form-control" name="jenis_kelamin" required>
                <option selected>Choose...</option>
                <option>Laki-laki</option>
                <option>Perempuan</option>
            </select>
        </div>
    </div>
</div>

<div class="form-row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="tgl">Tanggal Lahir</label>
            <input type="date" name="tgl_lahir" id="tgl" class="form-control datepicker" required>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="tgl">Hoby</label>
            <select id="inputState" class="form-control" name="hoby" required>
                <option selected>Choose...</option>
                <option>Sepak Bola</option>
                <option>Bulu Tangkis</option>
                <option>Coding</option>
                <option>Lainya</option>
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
        <button type="submit" class="btn btn-primary" name="simpan" value="simpan">Save</button>
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
