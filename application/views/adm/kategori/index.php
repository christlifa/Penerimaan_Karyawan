<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="kategori-vue">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Kategori
      <small></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo site_url('adm/dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Kategori</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Data Kategori</h3>
          </div><!-- /.box-header -->

          <div class="box-footer">
            <button type="submit" class="btn btn-primary fa fa-plus" @click="addRow"> Tambah </button>
          </div>          

          <div class="box-body" style="overflow: auto">
            <table id="example2" class="table table-bordered table-hover table-striped">
              <thead>
                <tr class="bold" align="center">
                  <td>No.</td>
                  <td>Nama</td>
                  <td>Tipe</td>
                  <td>Keterangan</td>
                  <td>Status</td>
                  <td>Pengaturan</td>
                </tr>
              </thead>
              <tbody>
                <!-- looping data dengan Vue Js -->
                <template v-for="(item, index) in list" v-bind:key="index">
                  <tr>
                    <td align="right">{{ index + 1 }}</td>
                    <td>{{ item.nama }}</td>
                    <td>{{ item.tipe }}</td>
                    <td>{{ item.keterangan }}</td>
                    <td align="center">
                        <span v-if="item.status == 1">
                          <label class="text-success">
                            <i class="fa fa-check"></i>                          
                          </label>
                        </span>
                        <span v-else="item.status">
                          <label class="text-danger">
                            <i class="fa fa-times"></i>                          
                          </label>
                        </span>
                      </td>
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
          </div><!-- /.box-body -->
        </div><!-- /.box -->
  </section><!-- /.content -->

  <div id="myModal" class="kategori-modal modal fade" role="dialog">
    <div class="modal-dialog">

    <form class="kategori-form" action="<?php echo site_url('adm/kategori/save'); ?>" method="post" multipart="enctype/form-data">

      <!-- konten modal-->
      <div class="modal-content">
    
        <!-- heading modal -->
        <div class="modal-header">
        
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Sunting Kategori</h4>
        
        </div>
    
        <!-- body modal -->
        <div class="modal-body">

          <div class="form-group">
            <label>Nama <small>*</small></label>
            <input type="hidden" class="form-control" name="id" v-model="id">
            <input type="text" class="form-control" name="kategori_nama" v-model="nama" required="required">
          </div>

          <div class="form-group">
            <label>Tipe <small>*</small></label>
              <select class="form-control" name="tipe" v-model="tipe_id" required="required">
                <option value="">- Pilih Tipe -</option>
                <?php if ($kategori_data) :?>
                    <?php foreach($kategori_data as $kategori_key => $kategori_val): ?>
                        <option value="<?php echo $kategori_key; ?>"><?php echo $kategori_val; ?></option>
                    <?php endforeach;?>
                <?php endif; ?>
              </select>
          </div>                      

          <div class="form-group">
            <label>Keterangan</label>
            <textarea type="text" class="form-control" name="keterangan" v-model="keterangan"></textarea>
          </div>

          <div class="form-group">
            <label>Status
              <input type="checkbox" name="status" v-model="status">
            </label>
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

<script type="text/javascript" src="<?php echo base_url('assets/js/app/kategori.js'); ?>"></script>
<script type="text/javascript">
    window.KATEGORI.init();
</script>


