<!DOCTYPE html>
<html>
  <style type="text/css">
    
    .ng-cloak { 
      display: none !important;
    }


    .btn-light:hover{
      background-color: #00c0ef;
    }
  </style>  
  <head>
    <meta charset="UTF-8">
    <title>Login Admin</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.4 -->
    <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <!-- sweet alert -->
    <link rel="stylesheet" href="<?php echo base_url('bower_components/sweetalert/dist/sweetalert.css') ?>" type="text/css"/>
    <link href="<?php echo base_url('assets/css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo base_url('assets/css/AdminLTE.min.css'); ?>" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="<?php echo base_url('assets/css/square/blue.css'); ?>" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <!-- <body class="login-page" style="background: url('<?php echo base_url('assets/images/bg/bg.jpg'); ?>')" ng-app="app" ng-controller="loginController"> -->
  <body class="login-page ng-cloak" style="background: url('<?php echo base_url('assets/images/bg/background1.jpg'); ?>')" ng-app="app" ng-controller="loginController">
    <div class="login-box"  style="margin-top: 100px;box-shadow: 0px 0px 5px 5px #F0F0F0;border-radius: 5px;"  ng-show="formMaster">

     <!--  <div class="login-logo" style="height:30px;">
      </div --><!-- /.login-logo -->
      <div class="login-box-body">
          <center>

            <img src="<?php echo base_url('assets/images/logo/clslogo.PNG')?>">
            <a href="<?php echo site_url('loginweb'); ?>" style="color: #000">
           <!--  <h2>
              
              <h6><?php echo $this->config->item('app_name'); ?></h6>
            </h2> -->
            </a>
              </center>
            <p class="login-box-msg">
              <?php if($this->session->flashdata('notifikasi_login')):?>                                    
                <div class="form-group">
                   <div class="alert alert-danger">
                    <?php echo $this->session->flashdata('notifikasi_login'); ?>
                    </div>
              </div>

          <?php endif; ?>
            </p>

            <form method="post" action="<?php echo site_url('loginweb/proses_login'); ?>">

              <div class="form-group has-feedback">
                <input type="text" class="form-control" name="usernama" placeholder="Username" required="required" autofocus="" autocomplete="off" />           
              </div>

              <div class="form-group has-feedback">
                <input type="password" class="form-control" name="sandi" placeholder="password" required="required" />
              </div>

             <!--  <div class="form-group has-feedback">
                <select class="form-control" name="OutletId" required="required">
                    <option value="">- Pilih -</option>
                    <option ng-repeat="a in data" ng-value="a.OutletId" ng-bind="a.OutletName"></option>
                </select>
              </div> -->

              <div class="row">
                <div class="col-xs-8" style="padding-left: 0px;">
                      <a class="btn" ng-click="btnLamar()">Apply Job</a>
                </div><!-- /.col -->
                <div class="col-xs-4">
                  <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                </div><!-- /.col -->
              </div>
            </form>

        <!--<a href="register.html" class="text-center">Register a new membership</a>-->

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->
    <center>
      <div  class="box box-primary"  ng-show="formLamaran"  style="width: 70%;margin-top: 100px;box-shadow: 0px 0px 5px 5px #F0F0F0;border-radius: 5px;">
          <div class="box-body">
            <div class="col-md-12">
              <img src="<?php echo base_url('assets/images/logo/clslogo.PNG')?>" ng-click="clickLogo()" class="pull-left btn">
            </div>
            <div class="col-md-12" ng-show="formListJob" style="padding-left: 0px;padding-right: 0px;">
              <div class="col-md-12" style="margin-bottom: 10px;">
                <h3 style="margin-top: 0px;margin-bottom: 0px;">Our Job Offers</h3>
                <!-- <br> -->
                <span style="margin-top: 0px;">Join us, we offer you an extraordinary chance to learn, to develop and to be part of an exciting experience and team.</span>
              </div>
              <div class="col-md-12 btn btn-light"   ng-repeat ="a in pekerjaan" ng-click="showDetiail(a)" style="border:1px solid #ccc; border-radius: 3px;margin-bottom: 10px;padding-left: 0px;padding-right: 0px;">
                {{a.lowonganNama}}
              </div>
            </div>
            <div class="col-md-12"  ng-show="formDetail" style="padding-left: 0px;padding-right: 0px;margin-top: 15px; text-align: left">
                <div class="col-md-12" style="text-align: center;margin-bottom: 10px;">
                  <h3 style="margin-top: 0px;">Job Application Form</h3>
                  <h4>{{ChosedJob.Name}}</h4>
                </div>
                <div class="col-md-12" style="padding-left: 0px;padding-right: 0px;">
                  <div class="col-md-4" style="margin-top: 7px;">
                      <label>Nama</label><label style="color: red;"> *</label>
                  </div>
                  <div class="col-md-8" style="padding-left: 0px;">
                    <div class="form-group">
                      <input class="form-control" name="Nama" required type="text" ng-model="mData.Nama" placeholder="Nama" maxlength="50">
                    </div>
                  </div>
                </div>
                <div class="col-md-12" style="padding-left: 0px;padding-right: 0px;">
                  <div class="col-md-4" style="margin-top: 7px;">
                      <label>Usia</label><label style="color: red;"> *</label>
                  </div>
                  <div class="col-md-8" style="padding-left: 0px;">
                    <div class="form-group">
                      <input class="form-control" name="Usia" required type="number" ng-model="mData.Usia" placeholder="Usia" maxlength="3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                    </div>
                  </div>
                </div>
                <div class="col-md-12" style="padding-left: 0px;padding-right: 0px;">
                  <div class="col-md-4" style="margin-top: 7px;">
                      <label>Email</label><label style="color: red;"> *</label>
                  </div>
                  <div class="col-md-8" style="padding-left: 0px;">
                    <div class="form-group">
                      <input class="form-control" name="Email" required type="text" ng-model="mData.Email" placeholder="Email" maxlength="50">
                    </div>
                  </div>
                </div>
                <div class="col-md-12" style="padding-left: 0px;padding-right: 0px;">
                  <div class="col-md-4" style="margin-top: 7px;">
                      <label>No Telpon</label><label style="color: red;"> *</label>
                  </div>
                  <div class="col-md-8" style="padding-left: 0px;">
                    <div class="form-group">
                      <input class="form-control" name="Phone" required type="number" ng-model="mData.Phone" placeholder="No Telpon" maxlength="14" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                    </div>
                  </div>
                </div>
                <div class="col-md-12" style="padding-left: 0px;padding-right: 0px;">
                  <div class="col-md-4" style="margin-top: 7px;">
                      <label>Pendidikan</label><label style="color: red;"> *</label>
                  </div>
                  <div class="col-md-8" style="padding-left: 0px;">
                    <div class="form-group">
                      <div class="form-group has-feedback">
                        <select class="form-control" name="pendidikan" ng-model="mData.pendidikan" required="required">
                            <option value="">- Pilih -</option>
                            <option ng-repeat="a in dataPendidikan" ng-value="a.GlobalId" ng-bind="a.Nama"></option>
                        </select>
                      </div>
                      <!-- <input class="form-control" name="Nama" required type="text" ng-model="mData.Nama" placeholder="Nama Barang"> -->
                    </div>
                  </div>
                </div>
                <div class="col-md-12" style="padding-left: 0px;padding-right: 0px;">
                  <div class="col-md-4" style="margin-top: 7px;">
                      <label>Pengalaman Kerja</label><label style="color: red;"> *</label>
                  </div>
                  <div class="col-md-4" style="padding-left: 0px;">
                    <div class="form-group">
                       Tahun<input class="form-control" name="Pengalaman" required type="number" ng-model="mData.PengalamanTahun" placeholder="Tahun" maxlength="2" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                       <input class="form-control" name="Pengalaman" required type="number" ng-model="mData.Pengalaman" placeholder="Tahun" ng-hide="true">
                    </div>
                  </div>
                  <div class="col-md-4" style="padding-left: 0px;">
                    <div class="form-group">
                       Bulan<input class="form-control" name="Bulan" required type="number" ng-model="mData.PengalamanBulan" placeholder="Bulan" maxlength="2" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" ng-change="changeMount(mData.PengalamanBulan)">
                    </div>
                  </div>
                </div>

                <div class="col-md-12" style="padding-left: 0px;padding-right: 0px;">
                  <div class="col-md-4" style="margin-top: 7px;">
                      <label>Gaji Yang Diharapkan</label><label style="color: red;"> *</label>
                  </div>
                  <div class="col-md-8" style="padding-left: 0px;">
                    <input class="form-control" name="gaji" required type="text" ng-model="mData.gaji" ng-keyup="givePattern(mData.gaji,$event)" placeholder="Gaji Yang Diharapkan">
                  </div>
                </div>

               <!--  <div class="col-md-12" style="padding-left: 0px;padding-right: 0px;">
                  <hr style="background-color: #000;height: 1px;">
                </div> -->
                <div class="col-md-12" style="padding-left: 0px;padding-right: 0px;" ng-if="ChosedJob.Skills.length > 0">
                  <div class="col-md-4" style="margin-top: 20px;">
                      <label>Kemampuan</label>
                      
                  </div>
                  <div class="col-md-6" style="padding-left: 0px;margin-top: 20px;padding-right: 0px;">
                    <div class="col-md-12" ng-if="skillData.length == 0"> Tidak Ada Data </div>
                    <div class="col-md-12" ng-repeat="a in skillData  track by $index" ng-if="skillData.length > 0">
                      <span>- {{a.Name}} </span><a style="color: red;" class="btn" ng-click="delete(a)"> X</a>
                    </div>
                      
                    <!-- <div class="col-md-3"  ng-repeat="a in ChosedJob.Skills">
                      <input type="checkbox"  id="vehicle1" name="vehicle1" value="{{a.Name}}"><label> {{a.Name}}</label><br>
                    </div> -->
                  </div>

                  <div class="col-md-2" style="text-align: right;margin-top: 20px;">
                    <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#exampleModal">Tambah</button>
                  </div>
                </div>
                <div class="col-md-12" style="padding-left: 0px;padding-right: 0px;">
                  <hr style="background-color: #000;height: 1px;">
                </div>
                <div class="col-md-12" style="padding-left: 0px;padding-right: 0px;">
                  <div class="col-md-6">
                    <button type="button" class="btn btn-link" ng-click="clickBack()">Back</button>
                  </div>
                  <div class="col-md-6" style="text-align: right;padding-right: 0px;">
                    
                    <button type="button" class="btn btn-primary" ng-click="submitData()">Submit</button>
                  </div>
                </div>
            </div>
          </div>
      </div>
    </center>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Kemampuan</h5>
          </div>
          <div class="modal-body" style="margin-bottom: 10px;">  
            <div class="col-md-12" style="padding-left: 0px;padding-right: 0px;">
              <input class="form-control" name="Skills" required type="text" ng-model="mData.Skills" placeholder="Kemampuan">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" ng-click="savePush()" class="btn btn-primary" ng-disabled="mData.Skills == null">Simpan</button>
            <button type="button" class="btn btn-default" data-dismiss="modal" ng-click="closeModal()">Tutup</button>
          </div>
        </div>
      </div>
    </div>
    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url('assets/js/jQuery-2.1.4.min.js'); ?>" type="text/javascript"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url('assets/js/icheck.min.js'); ?>" type="text/javascript"></script>
    <!-- angular js -->
    <script src="<?php echo base_url('assets/js/angular.min.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/js/loginController.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/js/loginFactory.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/js/freamwork.js'); ?>" type="text/javascript"></script>

    <script src="<?php echo base_url('bower_components/sweetalert/dist/sweetalert.min.js') ?>" type="text/javascript"></script>

    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>
</html>
