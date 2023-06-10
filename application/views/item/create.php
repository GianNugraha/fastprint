<!doctype html>
<html lang="en">

<head>
  <?php $this->load->view('includes/header'); ?>
  <title>Tambah Item</title>
</head>

<body>

  <div class="container">
    <div class="row">

      <div class="col-lg-12 my-5">
        <h2 class="text-center mb-3">Fast Print CRUD menggunakan CI-3</h2>
      </div>

      <div class="col-lg-12">
			
			<?php echo $this->session->flashdata('message'); ?>
			
        <div class="d-flex justify-content-between ">
          <h4>Tambah Item Baru</h4>
          <a class="btn btn-warning" href="<?php echo base_url(); ?>"> <i class="fas fa-angle-left"></i> Back</a>
        </div>

        <form method="post" action="<?php echo base_url('item/store'); ?>">

          <div class="form-group">
            <label>Nama Produk</label>
            <input class="form-control" type="text" name="nama_produk">
          </div>

          <div class="form-group">
            <label>Kategori</label>
            <input class="form-control" type="text" name="kategori">
          </div>

					<div class="form-group">
            <label>Harga</label>
            <input class="form-control" type="text" name="harga">
          </div>

					<div class="form-group">
						<label for="select">Status</label>
						<select class="form-control" id="select" name="status">
							<option selected disabled>--pilih --</option>
							<option value="bisa dijual">bisa dijual</option>
							<option value="tidak bisa dijual">tidak bisa dijual</option>
						</select>
					</div>

          <div class="form-group">
            <button type="submit" class="btn btn-success"> <i class="fas fa-check"></i> Submit </button>
          </div>

        </form>


      </div>
    </div>
  </div>



  <?php $this->load->view('includes/footer'); ?>

</body>
</html>
