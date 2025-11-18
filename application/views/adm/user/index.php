<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      User
      <small></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo site_url('adm/dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">User</li>
    </ol>
  </section>

  <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Data User</h3>
              </div><!-- /.box-header -->
              
              <div class="box-footer">
                <a href="<?php echo site_url('adm/user/edit'); ?>" type="submit" class="btn btn-primary fa fa-user-plus"> Tambah </a>
              </div>
              
              <div class="box-body" style="overflow: auto">

                <table id="example2" class="table table-bordered table-hover table-striped">
                  <thead>
                    <tr>
                      <td>No.</td>
                      <td>Tipe</td>
                      <td>Usernama</td>
                      <td>Sandi</td>
                      <td>Nama</td>
                      <td>Email</td>
                      <td>Telpon</td>
                      <td>Alamat</td>
                      <td>Kabupaten</td>
                      <td>Kecamatan</td>
                      <td>Kelurahan</td>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Trident</td>
                      <td>Internet
                        Explorer 4.0</td>
                      <td>Win 95+</td>
                      <td> 4</td>
                      <td>X</td>
                      <td>X</td>
                      <td>X</td>
                      <td>X</td>
                      <td>X</td>
                      <td>X</td>
                      <td>X</td>
                    </tr>
                    
                  </tbody>
                  
                </table>
              </div><!-- /.box-body -->
            </div><!-- /.box -->
  <!-- /.content -->
 </section><!-- /.content -->

</div>


