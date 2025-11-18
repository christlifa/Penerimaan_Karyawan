<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="produk-vue">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Produk
      <small></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo site_url('adm/dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Produk</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Data Produk</h3>
          </div><!-- /.box-header -->

          <div class="box-footer">
            <button type="submit" class="btn btn-primary fa fa-plus" @click="addRow"> Tambah </button>
          </div>          

          <div class="box-body" style="overflow: auto">
            <table id="example2" class="table table-bordered table-hover table-striped">
              <thead>
                <tr class="bold" align="center">
                  <td>No.</td>
                  <td>Paket</td>
                  <td>Nama</td>
                  <td>Harga</td>
                  <td>Gambar</td>
                  <td>Keterangan</td>
                  <td>Pengaturan</td>
                </tr>
              </thead>
              <tbody>
                <!-- looping data dengan Vue Js -->
                <template v-for="(item, index) in list" v-bind:key="index">
                  <tr>
                    <td align="right">{{ index + 1 }}</td>
                    <td>{{ item.paket_nama }}</td>
                    <td>{{ item.nama }}</td>
                    <td>{{ item.harga }}</td>
                    <td>{{ item.gambar }}</td>
                    <td>{{ item.keterangan }}</td>                    
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

  <div id="myModal" class="produk-modal modal fade" role="dialog">
    <div class="modal-dialog">

      <form class="produk-form" action="<?php echo site_url('adm/produk/save'); ?>" method="post" multipart="enctype/form-data">

        <!-- konten modal-->
        <div class="modal-content">
      
          <!-- heading modal -->
          <div class="modal-header">
          
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Sunting Produk</h4>
          
          </div>
      
          <!-- body modal -->
          <div class="modal-body">

            <div class="form-group">
              <input type="hidden" class="form-control" name="id" v-model="id">
            </div>

            <div class="form-group">            
              <label>Paket</label>
                <select class="form-control" name="paket_id" v-model="paket_id">
                  <option value="">- Pilih Paket -</option>
                  <?php if ($paket_data) :?>
                      <?php foreach($paket_data as $paket_row): ?>
                          <option value="<?php echo $paket_row->paket_id; ?>"><?php echo $paket_row->paket_nama; ?></option>
                      <?php endforeach;?>
                  <?php endif; ?>
                </select>
            </div>

            <div class="form-group">
              <label>Nama</label>
              <input type="text" class="form-control" name="produk_nama" v-model="nama" required="required">
            </div>

            <div class="form-group">
              <label>Harga</label>
              <input type="text" class="form-control" name="harga" v-model="harga" required="required">
            </div>

            <div class="form-group">
              <label>Gambar</label>
              <input type="file" class="form-control" name="gambar">
            </div>

            <div class="form-group">
              <label>Keterangan</label>
              <textarea class="form-control" name="keterangan" v-model="keterangan" required="required"></textarea>
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

<script type="text/javascript" src="<?php echo base_url('assets/js/app/produk.js'); ?>"></script>
<script type="text/javascript">
    window.PRODUK.init();
</script>


