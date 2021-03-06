<!DOCTYPE html>
<html>
<head>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#form_dsn_jrsn").change(function(){
				$("#form_dsn_ksn").hide();
				$.ajax({
					type: "POST",
					url: "<?php echo base_url("Home/filterKonsentrasi"); ?>",
					data: {IDJurusan : $("#form_dsn_jrsn").val()},
					dataType: "json",
					success: function(response){
						$("#div_ksn_dsn").show('fast', function() {
							$("#form_dsn_ksn").html(response.list).show();
						});

					},
				});
			});
		});

		function readUrl(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();

				reader.onload = function (e) {
					$('#blah').attr('src', e.target.result);
				}
				reader.readAsDataURL(input.files[0]);
			}
		}
		$("#foto").change(function() {
			readUrl(this);
		});
	</script>
</head>
<?php if (!$konsentrasi) {?>
	<div class='container-fluid mt-5'>
		<div class='row align-items-center'>
			<div class='col-md'>
				<h2>Maafkan Saya Admin</h2>
				Data Dosen Belum Bisa Dimasukan Sebelum Data Jurusan & Konsentrasi Dimasukan.
			</div>
			<div class='col-md-3'>
				<img src="<?=base_url('assets/images/fix/sad.jpg')?>">
			</div>
		</div>
	</div>
<?php } else {?>
	<form method="post" id="Dosen" action="<?php echo base_url('Admin/saveDosen'); ?>" class="formSimpan" enctype="multipart/form-data">
		<div class="row">
			<div class="col-md-3">
				<img class="card-img-top" id="blah" src="<?=base_url('assets/images/fix/user.png');?>">
			</div>
			<div class="col-md">
				<div class="col-md-auto">
					<div class="form-row">
						<div class="form-group col-md">
							<label>NIK</label>
							<input type="number" id="nik" name="nik" class="form-control" required>
						</div>
						<div class="form-group col-md">
							<label>Nama</label>
							<input id="nama" type="text" name="nama_dosen" class="form-control" required>
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md">
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span id="nohp" class="input-group-text"><i class="fas fa-phone"></i></span>
								</div>
								<div class="custom-file">
									<input name="nohp" type="number" class="form-control" required>
								</div>
							</div>
						</div>
						<div class="form-group col">
							<select name="id_jurusan" id="form_dsn_jrsn" class="custom-select">
								<option selected>Jurusan</option>
								<?php foreach ($jurusan->result() as $j) {?>
									<option value="<?php echo $j->IDJurusan; ?>"><?php echo $j->Jurusan; ?></option>
								<?php }?>
							</select>
						</div>
						<div class="form-group col" id="div_ksn_dsn" style="display: none">
							<select name="konsentrasi" id="form_dsn_ksn"  class="custom-select">
							</select>
						</div>

						<div class="form-group col-md">
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text"> <i class="fas fa-envelope m-1"></i></span>
								</div>
								<div class="custom-file">
									<input id="email" name="email" type="email" class="form-control" required>
								</div>
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-10">
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text">Upload</span>
								</div>
								<div class="custom-file">
									<input id="foto" name="dataFoto" type="file" class="custom-file-input" required>
									<label for="foto" class="custom-file-label" for="inputGroupFile01">Choose file</label>
								</div>
							</div>
						</div>
						<div class="form-group col-md">
							<button class="btn btn-primary" type="submit" id="daftar"> Simpan </button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
<?php }?>

</html>