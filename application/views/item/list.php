<!doctype html>
<html lang="en">

<head>
  <?php $this->load->view('includes/header'); ?>
  <title>Daftar Item</title>
</head>

<body>

  <div class="container">
    <div class="row">

      <div class="col-lg-12 my-5">
        <h2 class="text-center mb-3">Fast Print CRUD With CI-3</h2>
      </div>

      <div class="col-lg-12">

        <?php echo $this->session->flashdata('message'); ?>

        <div class="d-flex justify-content-between mb-3">
          <h4>Daftar Item</h4>
          <a href="<?= base_url('create') ?>" class="btn btn-success"> <i class="fas fa-plus"></i> Tambah Item Baru</a>
        </div>

        <table class="table table-bordered table-default">

          <thead class="thead-light">
            <tr>
              <th width="2%">#</th>
              <th width="20%">Nama Produk</th>
              <th width="15%">Kategori</th>
              <th width="20%">Harga</th>
              <th width="15%">Status</th>
              <th width="20%">Action</th>
            </tr>
          </thead>

          <tbody>
						<?php if ($data == null || empty($data)) { ?>
							<form action="generate" method="post">
							<tr>
                <td class="text-center" colspan="6"><button type="submit" class="btn btn-info">Generat Data</button></td>
              </tr>
						</form>
            <?php }
						else { $i = 1; foreach ($data as $item) { ?>

              <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $item->nama_produk; ?></td>
                <td><?php echo $item->kategori; ?></td>
                <td><?php echo $item->harga; ?></td>
                <td><?php echo $item->status; ?></td>

                <td>
                  <a href="<?= base_url('item/edit/' . $item->id_produk) ?>" class="btn btn-primary"> <i class="fas fa-edit"></i> Edit </a>
                  <a href="<?= base_url('item/delete/' . $item->id_produk) ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this record?')"> <i class="fas fa-trash"></i> Delete </a>
                </td>

              </tr>

            <?php $i++; } }?>

          </tbody>

        </table>

      </div>
    </div>
  </div>



  <?php $this->load->view('includes/footer'); ?>

</body>
<script>

jQuery(function() {
	$("#generated").click(function(){
			$.ajax({
					url: "https://recruitment.fastprint.co.id/tes/api_tes_programmer",
					type: 'post',    
					dataType: 'json',
					data: { username: "tesprogrammer090623C16", password: md5('bisacoding-09-06-23')}, 
					success: function(data){            
							if (data.view) {
									$('#here_view').html(data.view);
							}
							if (data.error){
									console.log(data.error);
							}
					}
			});
	});
});
</script>
</html>
