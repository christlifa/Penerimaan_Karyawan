<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="halaman-vue">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Halaman
      <small></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo site_url('adm/dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Halaman</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Data Halaman</h3>
          </div><!-- /.box-header -->

          <div class="box-footer">
            <button type="submit" class="btn btn-primary fa fa-plus" @click="addRow"> Tambah </button>
          </div>          

          <div class="box-body" style="overflow: auto">
            <table id="example2" class="table table-bordered table-hover table-striped">
              <thead>
                <tr class="bold" align="center">
                  <td>No.</td>
                  <td>Kategori</td>
                  <td>Judul</td>
                  <td>Gambar</td>
                  <td>Konten</td>
                  <td>Pengaturan</td>
                </tr>
              </thead>
              <tbody>
                <!-- looping data dengan Vue Js -->
                <template v-for="(item, index) in list" v-bind:key="index">
                  <tr>
                    <td align="right">{{ index + 1 }}</td>
                    <td>{{ item.kategori_nama }}</td>
                    <td>{{ item.judul }}</td>
                    <td v-html="item.gambar_html"></td>
                    <td>{{ item.konten }}</td>
                    <td align="center">
                      <button class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="bottom" title="Edit" @click="editRow(index)">
                        <i class="fa fa-edit"></i>
                      </button>
                      &nbsp;
                      <button class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="bottom" title="Hapus" @click="removeRow(index)">           
                        <i class="fa fa-trash"></i>
                      </button>
                   </td>
                  </tr> 
                </template>                   
              </tbody>              
            </table>
          </div>
        </div>
  </section>

  <div id="myModal" class="halaman-modal modal fade" role="dialog">
    <div class="modal-dialog">

      <form class="halaman-form" action="<?php echo site_url('adm/halaman/save'); ?>" method="post" multipart="enctype/form-data">

        <!-- konten modal-->
        <div class="modal-content">
      
          <!-- heading modal -->
          <div class="modal-header">
          
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Sunting Halaman</h4>
          
          </div>
      
          <!-- body modal -->
          <div class="modal-body">

            <div class="form-group">
              <input type="hidden" class="form-control" name="halaman_id" v-model="id">              
            </div>

            <div class="form-group">
            <label>Kategori</label>
              <select class="form-control" name="kategori_id" v-model="kategori_id" required="required">
                <option value="">- Pilih Kategori -</option>
                  <?php if ($kategori_data) :?>
                      <?php foreach($kategori_data as $kategori_row): ?>
                          <option value="<?php echo $kategori_row->kategori_id; ?>"><?php echo $kategori_row->kategori_nama; ?></option>
                      <?php endforeach;?>
                  <?php endif; ?>
              </select>
            </div>

            <div class="form-group">
              <label>Judul</label>
              <input type="text" class="form-control" name="judul" v-model="judul" required="required">
            </div>

            <div class="form-group">
              <label>Gambar</label>
              <input type="file" class="form-control" name="gambar">
            </div>

            <div class="form-group">
              <label>Konten</label>
              <textarea class="form-control" name="konten" v-model="konten" required="required"></textarea>
            </div>                                            
          </div>
        
          <!-- footer modal -->
          <div class="modal-footer">
            <button  type="submit" class="btn btn-primary">
              <li class="fa fa-check"></li>
                Simpan
            </button>
            &nbsp;
            <button type="button" class="btn btn-default" data-dismiss="modal">
              <li class="fa fa-close"></li>
                Batal
            </button>

          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript" src="<?php echo base_url('assets/js/app/halaman.js'); ?>"></script>
<script type="text/javascript">
    window.HALAMAN.init();
</script>


