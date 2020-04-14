<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Pantau Covid-19 | A Syafii</title>
  </head>
  <body>
  
    <div class="jumbotron jumbotron-fluid bg-primary text-white">
      <div class="container text-center">
        <h1 class="display-4">Corona Virus</h1>
        <p class="lead">
          <h2>
              PANTAU PENYEBARAN VIRUS COVID-19 DI DUNIA
              <br> SECARA REAL-TIME
              <br>Mari Menjaga Kesehatan Diri Kita dan Keluarga
			  <br>Dengan Selalu Menjaga Kebersihan dan Cuci Tangan
          </h2>
        </p>
      </div>
    </div>

<style type="text/css">
  .box{
    padding: 30px 40px;
    border-radius: 10px;
  }
</style>

  <div class="container">
    <div class="card-header bg-success text-white">
      <b>Data Kasus Virus Corona di Dunia, Sumber data : https://coronavirus-19-api.herokuapp.com/all</b>
    </div>
    <div class="row">
      <div class="col-md-4 mt-3">
        <div class="bg-danger box text-white">
          <div class="row">
            <div class="col-md-6">
              <h5>Positif</h5>
              <h2 id="data-kasus">234</h2>
              <h5>orang</h5>         
            </div>
            <div class="col-md-4">
              <img src="img/sad.svg" style="width: 100px;">
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-4 mt-3">
        <div class="bg-info box text-white">
          <div class="row">
            <div class="col-md-6">
              <h5>Meninggal</h5>
              <h2 id="data-mati">234</h2>
              <h5>orang</h5>         
            </div>
            <div class="col-md-4">
              <img src="img/cry.svg" style="width: 100px;">
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-4 mt-3">
        <div class="bg-success box text-white">
          <div class="row">
            <div class="col-md-6">
              <h5>Sembuh</h5>
              <h2 id="data-sembuh">234</h2>
              <h5>orang</h5>         
            </div>
            <div class="col-md-4">
              <img src="img/happy.svg" style="width: 100px;">
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-12 mt-3">
        <div class="bg-primary box text-white">
          <div class="row">
            <div class="col-md-3">
              <h2>INDONESIA</h2>
              <h5 id="data-id">Positif : 11 orang <br> Sembuh : 10 orang <br> Meninggal : 1 orang</h5>
            </div>
            <div class="col-md-4">
              <img src="img/indonesia.svg" style="width: 150px;">
            </div>
          </div>
        </div>
      </div>

    </div>
    <!-- Akhir Row -->
<div class="card mt-3">
  <div class="card-header bg-danger text-white">
    <b>Data Kasus Virus Corona di Indonesia Berdasarkan Provinsi, Sumber data : https://api.kawalcorona.com/indonesia/provinsi/</b>
  </div>
  <div class="card-body">
	<div class="table-responsive">
     <table class="table table-bordered">
      <thead>
        <th>NO.</th>
        <th>Nama Provinsi</th>
        <th>Positif</th>
        <th>Sembuh</th>
        <th>Meninggal</th>
      </thead>
      <tbody id="table-data">
        
      </tbody>
    </table>
  </div>
</div>
	</div>
	</div>
    <!-- Akhir Container -->
  <footer class="bg-primary text-center text-white mt-3 bt-2 pb-2">
    Create By. A Syafii
  </footer>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    
  </body>
</html>

<script>
  $(document).ready(function(){

    //panggil fungsi untuk menampilkan semua data global
    semuaData();
    dataNegara();
    dataProvinsi();

    //untuk refresh otomatis
    setInterval(function(){
      semuaData();
      dataNegara();
      dataProvinsi();
    }, 3000);

    function semuaData(){
      $.ajax({
        url : 'https://coronavirus-19-api.herokuapp.com/all',
        success : function(data){
          try{
            var json = data;
            var kasus = data.cases;
            var meninggal = data.deaths;
            var sembuh = data.recovered;

            $('#data-kasus').html(kasus);
            $('#data-mati').html(meninggal);
            $('#data-sembuh').html(sembuh);

          }catch{
            alert('error');
          }
        }
      });
    }

    function dataNegara(){
      $.ajax({
        url : 'https://coronavirus-19-api.herokuapp.com/countries',
        success : function(data){
          try{

            var json = data;
            var html = [];
            
            if(json.length > 0){
              var i;
              for(i = 0; i < json.length; i++){
                var dataNegara = json[i];
                var namaNegara = dataNegara.country;
                if(namaNegara === 'Indonesia'){
                  var kasus = dataNegara.cases;
                  var mati = dataNegara.deaths;
                  var sembuh = dataNegara.recovered;
                  $('#data-id').html('Positif : '+kasus+' orang <br> Meninggal : '+mati+' orang <br> Sembuh : '+sembuh+' orang')
                }
              }
            }

          }catch{
            alert('error');
          }
        }
      });
    }

    function dataProvinsi(){
      $.ajax({
        url : 'curl.php',
        type : 'GET',
        success : function(data){
          try{
            
            $('#table-data').html(data);

          }catch{
            alert('error');
          }
        }
      });
    }

  });
</script>
