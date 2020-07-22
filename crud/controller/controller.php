<?php

class config{
    var $host = 'localhost';
    var $user = 'root';
    var $password = '';
    var $db_name = 'crud_php';

    function config()
    {
        $this->koneksi = mysqli_connect($this->host, $this->user, $this->password, $this->db_name);
        if($this->koneksi){
            return 'koneksi berhasil';
        }else{
            return 'koneksi gagal';
        }
    }
}
    
    class tampildata extends config{
        private $hasil;

        public function hitung_rechord(){
            $hitung = mysqli_query($this->koneksi, "SELECT *FROM data");
            $this->hasil = mysqli_num_rows($hitung);

            if($this->hasil == NULL){
                return 'kosong';
            }else{
                return 'ada';
            }
        }

        public function tampilkan_data($config){

            $tampil = mysqli_query($config, "SELECT *FROM data");
            while($row=mysqli_fetch_array($tampil)){
                if($this->hitung_rechord() == 'ada'){
                    $data[] = $row;
                }
            }
            if($this->hitung_rechord()=='ada'){
                return $data;
            }else{
                return '0';
            }
        }

    }

    class crud_data extends config{

        public function hapus_data($id){
            $edit = mysqli_query($this->koneksi, "DELETE FROM data WHERE id = '$id'");

            if($edit){
                header("location:../index.php?hapus");
            }else{
                echo "hapus gagal";
            }
        }

        public function liat_data($id, $config){

            $tampil = mysqli_query($config, "SELECT *FROM data WHERE id='$id'");
            while($row=mysqli_fetch_array($tampil)){
                $view[] = $row;
            }
            return $view;
        }

        public function tangkap_input(){
            $nama_peserta = $_POST['nama'];
            $jenis_kelamin = $_POST['jenis_kelamin'];
            $tgl_lahir = $_POST['tgl_lahir'];
            $hoby = $_POST['hoby'];


            //tangkap ekstensi gambar
            $type_file = explode(".", $_FILES['filegambar']['name']);

            if(strtolower(end($type_file))!="png" || strtolower(end($type_file))!="jpg"){
                header("location:../index.php?ekstensi_salah");
            }


            if($nama_peserta==NULL || $jenis_kelamin==NULL || $tgl_lahir==NULL || $hoby==NULL){
                header("location:../index.php?gagal");
            }else{
                //tangkap file gambar
                $namagambar=$_FILES['filegambar']['name'];
                $filegambar=addslashes(file_get_contents($_FILES['filegambar']['tmp_name']));

                $tambah = "INSERT INTO data (nama, jenis_kelamin, tgl_lahir, hoby, namafile, filegambar) VALUES ('$nama_peserta', '$jenis_kelamin', '$tgl_lahir','$hoby', '$namagambar', '$filegambar')";
                $aksi = mysqli_query($this->koneksi, $tambah);
    
                if($aksi){
                    header("location:../index.php?tambah");
                }else{
                    echo "tambah data gagal";
                }

            }
        }

        public function tangkap_edit(){
            $nama_peserta_lte = $_POST['nama_peserta_lte'];
            $jenis_kelamin_lte = $_POST['jenis_kelamin_lte'];
            $tgl_lahir_lte = $_POST['tgl_lahir_lte'];
            $hoby_lte = $_POST['hoby_lte'];

            //key
            $id = $_POST['id'];

            //tangkap ekstensi gambar
            $type_file = explode(".", $_FILES['filegambar']['name']);

            if(strtolower(end($type_file))!="png" || strtolower(end($type_file))!="jpg"){
                header("location:../index.php?ekstensi_salah");
            }


            if($nama_peserta_lte==NULL || $jenis_kelamin_lte==NULL || $tgl_lahir_lte==NULL || $hoby_lte==NULL || $id==NULL){
                header("location:../index.php?gagal");
            }else{

                $namagambar=$_FILES['filegambar']['name'];
                $filegambar=addslashes(file_get_contents($_FILES['filegambar']['tmp_name']));

                $update = mysqli_query($this->koneksi, "UPDATE data SET nama='$nama_peserta_lte', jenis_kelamin='$jenis_kelamin_lte', tgl_lahir='$tgl_lahir_lte', hoby='$hoby_lte', namafile='$nama_peserta_lte', filegambar='$filegambar' WHERE id='$id'");

                if($update){
                    header("location:../index.php?update");
                }else{
                    echo "update gagal";
                }
            }

        }
    }

    function main(){
        $objek_crud = new crud_data();
        $database = new config();
        $config = $database->koneksi;
    
        if(isset($_POST['simpan'])){
            $objek_crud->tangkap_input();
        }else if(isset($_POST['edit'])){
            $objek_crud->tangkap_edit();
        }else if(isset($_POST['hapus'])){
            $id = $_POST['id'];
            $objek_crud->hapus_data($id, $config);
        }
    }

    main();
    
?>