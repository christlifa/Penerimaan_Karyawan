<div class="content-wrapper">
  <section class="content">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header">
            <h3 class="box-title">Sunting User</h3>
          </div><!-- /.box-header -->
          <!-- form start -->
          <form role="form">
            <div class="box-body">
            <div class="col-md-6">
            <br/>
              <div class="form-group">
                <label>Tipe</label>
                  <select class="form-control" name="user_tipe" required="required">
                    <option>== Pilih Jenis Tipe==</option>
                    <option>Admin</option>
                    <option>Member</option>
                  </select>
              </div>

              <div class="form-group">
                <label>Usernama</label>
                <input type="text" class="form-control" name="usernama">
              </div>

              <div class="form-group">
                <label>Sandi</label>
                <input type="password" class="form-control" name="sandi">
              </div>

              <div class="form-group">
                <label>Nama</label>
                <input type="text" class="form-control" name="nama">
              </div>

              <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" name="email">
              </div>
            </div>

            <div class="col-md-6">
            <br/>
              <div class="form-group">
                <label>Telpon</label>
                <input type="text" class="form-control" name="telpon">
              </div>

              <div class="form-group">
                <label>Alamat</label>
                <textarea class="form-control" name="alamat"></textarea>
              </div>

              <div class="form-group">
                <label>Kabupaten / Kota</label>
                <select class="form-control" name="kabupaten_id" required="required">
                  <option>== Pilih Jenis Kabupaten ==</option>
                  <option>Kabupaten Bogor</option>
                  <option>Kota Bogor</option>
                </select>
              </div>

              <div class="form-group">
                <label>Kecamatan</label>
                <select class="form-control" name="kecamatan_id" required="required">
                  <option>== Pilih Jenis Kecamatan ==</option>
                  <option>Kecamatan Bogor Barat</option>
                  <option>Kecamatan Bogor Selatan</option>
                </select>
              </div>

              <div class="form-group">
                <label>Kelurahan / Desa</label>
                <select class="form-control" name="kelurahan_id" required="required">
                  <option>== Pilih Jenis Kelurahan==</option>
                  <option>Kertamaya</option>
                  <option>Sinar-Sari</option>
                </select>
              </div>
            </div><!-- /.box-body -->

            <div class="box-footer">
              <button type="submit" class="btn btn-primary">
                <i class="fa fa-check"></i> Simpan
              </button>
            </div>
          </form>
        </div><!-- /.box -->
      </div>
    </div>
  </section>
</div>