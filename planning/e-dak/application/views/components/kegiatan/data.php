    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Kegiatan
        <small>Mengolah data kegiatan</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?=base_url()?>"><i class="fa fa-dashboard"></i> Beranda</a></li>
        <li><a href="#">Usulan</a></li>
        <li><a href="<?=base_url()."usulan/".@$tahun."/bidang"?>">Bidang</a></li>
        <li><a href="<?=base_url()."usulan/".@$tahun."/sub-bidang/".@$kode?>">Sub Bidang</a></li>
        <li class="active">Kegiatan</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Kegiatan</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="margin: 15px;">
            <?php $level = array(1); if(in_array($_SESSION['level'], $level)){ ?>
              <button data-toggle="modal" onclick="setCreate()" data-target="#modal-form" class="btn btn-primary" style="margin: 10px"><i class="fa fa-plus"></i> Tambah</button>
            <?php } ?>
              <div class="table-responsive">
                <table id="table-user" class="table table-bordered table-striped">
                  <thead class="my-head">
                    <tr>
                      <th>No</th>
                      <th>KODE</th>
                      <th>NOMENKLATUR KEGIATAN</th>
                      <th>OPD</th>
                      <th>JENIS</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>

    <div class="modal fade" id="modal-form">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Form Pengguna</h4>
          </div>
          <form action="" id="form-action">
          <div class="modal-body">
            <input type="hidden" name="kode" value="<?=@$tahun."-".@$kode?>">
            <div class="form-group">
              <label>Kode</label>
              <input name="kegiatan_kode" type="text" class="form-control" required autofocus>
            </div>
            <div class="form-group">
              <label>Nomenklatur Sub Bidang</label>
              <input name="kegiatan_nama" type="text" class="form-control" required autofocus>
            </div>
            <div class="form-group">
              <label>Jenis</label>
              <select name="id_jenis" type="text" class="form-control" required autofocus>
                <option value="">-= Pilih Jenis =-</option>
                <?php foreach($dataJenis as $row){ ?>
                <option value="<?=$row['id_jenis']?>"><?=$row['jenis_nama']?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label>Opd</label>
              <select name="id_opd" type="text" class="form-control select2" style="width: 100%" required autofocus>
                <option value="">-= Pilih Opd =-</option>
                <?php foreach($dataOpd as $row){ ?>
                <option value="<?=$row['id_opd']?>"><?=$row['opd_nama']?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
          </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->


    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Kegiatan Penunjang</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="margin: 15px;">
            <div class="row">
              <div class="col-sm-10">

              </div>
              <div class="col-sm-2">
                <select id="pilih-triwulan" class="form-control " required autofocus>
                  <option value="1">-= Pilih Triwulan =-</option>
                  <option value="1">Triwulan 1</option>
                  <option value="2">Triwulan 2</option>
                  <option value="3">Triwulan 3</option>
                  <option value="4">Triwulan 4</option>
                </select>
              </div>
            </div>
              <?php $level = array(1,2,3); if(in_array($_SESSION['level'], $level)){ ?>
              <button data-toggle="modal" onclick="setCreate2()" data-target="#modal-form2" class="btn btn-primary" style="margin: 10px"><i class="fa fa-plus"></i> Tambah</button>
              <?php } ?>
              <div class="table-responsive">
                <table id="table-user2" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th rowspan="3">No</th>
                      <th rowspan="3">KODE</th>
                      <th rowspan="3">JENIS KEGIATAN</th>
                      <th colspan="4">PERENCANAAN KEGIATAN</th>
                      <th colspan="5">MEKANISME PELAKSANAAN</th>
                      <th colspan="4">REALISASI (%)</th>
                      <th rowspan="3">Kodefikasi/ Keterangan/ Permasalahan</th>
                      <th rowspan="3">Aksi</th>
                    </tr>
                    <tr>
                      <th rowspan="2">VOLUME</th>
                      <th rowspan="2">SATUAN</th>
                      <th rowspan="2">JUMLAH PENERIMA MANFAAT</th>
                      <th rowspan="2">PAGU DAK</th>
                      <th colspan="2">SWAKELOLA</th>
                      <th colspan="2">KONTRAKTUAL</th>
                      <th rowspan="2">METODE PEMBAYARAN</th>
                      <th colspan="2">KEUANGAN</th>
                      <th colspan="2">FISIK</th>
                    </tr>
                    <tr>
                      <th>Volume</th>
                      <th>(Rp. Dalam Ribuan)</th>
                      <th>Volume</th>
                      <th>(Rp. Dalam Ribuan)</th>
                      <th>(Rp. Dalam Ribuan)</th>
                      <th>%</th>
                      <th>Volume</th>
                      <th>%</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>

    <div class="modal fade" id="modal-form2">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Form Pengguna</h4>
          </div>
          <form action="" id="form-action2">
          <div class="modal-body">
            <input type="hidden" name="kode2" value="<?=@$tahun."-".@$kode?>">
            <div class="form-group">
              <label>Kode</label>
              <input name="kegiatan_penunjang_kode" type="text" class="form-control" required autofocus>
            </div>
            <div class="form-group">
              <label>Nomenklatur Kegiatan Penunjang</label>
              <input name="kegiatan_penunjang_nama" type="text" class="form-control" required autofocus>
            </div>
            <div class="form-group">
              <label>Volume</label>
              <input name="kegiatan_penunjang_volume"  step="0.0001" type="number" class="form-control" required autofocus>
            </div>
            <div class="form-group">
              <label>Satuan</label>
              <select name="id_satuan" type="text" class="form-control" required autofocus>
                <option value="">-= Pilih Satuan =-</option>
                <?php foreach($dataSatuan as $row){ ?>
                <option value="<?=$row['id_satuan']?>"><?=$row['satuan_nama']?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label>Jumlah Penerima Manfaat</label>
              <input name="kegiatan_penunjang_penerima_manfaat" type="text" class="form-control" required autofocus>
            </div>
            <div class="form-group">
              <label>DAK PAGU</label>
              <input name="kegiatan_penunjang_pagu" step="0.0001" type="number" class="form-control" required autofocus>
            </div>
            <div class="form-group">
              <label>Mekanisme Pelaksana</label>
              <select name="kegiatan_penunjang_jenis" type="text" class="form-control" required autofocus>
                <option value="">-= Pilih Mekanisme Pelaksana =-</option>
                <option value="1">Swakelola</option>
                <option value="2">Kontraktual</option>
              </select>
            </div>
            <div class="form-group" id="kegiatan_penunjang_swakelola_volume">
              <label>Swakelola Volume</label>
              <input name="kegiatan_penunjang_swakelola_volume" step="0.0001" type="number" class="form-control" required autofocus>
            </div>
            <div class="form-group" id="kegiatan_penunjang_swakelola_rp">
              <label>Swakelola Rupiah</label>
              <input name="kegiatan_penunjang_swakelola_rp"  step="0.0001" type="number" class="form-control" required autofocus>
            </div>
            <div class="form-group" id="kegiatan_penunjang_konstraktual_volume">
              <label>Kontraktual Volume</label>
              <input name="kegiatan_penunjang_konstraktual_volume" step="0.0001" type="number" class="form-control" required autofocus>
            </div>
            <div class="form-group" id="kegiatan_penunjang_konstraktual_rp">
              <label>Kontraktual Rupiah</label>
              <input name="kegiatan_penunjang_konstraktual_rp" step="0.0001" type="number" class="form-control" required autofocus>
            </div>
            <div class="form-group">
              <label>Metode Pembayaran</label>
              <input name="kegiatan_penunjang_pembayaran" type="text" class="form-control" required autofocus>
            </div>
            <!-- <div class="form-group">
              <label>Keuangan Rupiah</label>
              <input name="kegiatan_penunjang_tw1_keuangan_rp" type="number" class="form-control" required autofocus>
            </div>
            <div class="form-group">
              <label>Fisik Volume</label>
              <input name="kegiatan_penunjang_tw1_fisik_volume" type="number" class="form-control" required autofocus>
            </div>
            <div class="form-group">
              <label>Fisik Persen</label>
              <input name="kegiatan_penunjang_tw1_fisik_persen" type="number" class="form-control" required autofocus>
            </div> -->
            <div class="form-group">
              <label>Masalah</label>
              <select name="id_masalah" type="text" class="form-control" required autofocus>
                <option value="">-= Pilih Masalah =-</option>
                <?php foreach($dataMasalah as $row){ ?>
                <option value="<?=$row['id_masalah']?>"><?=$row['masalah_nama']?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label>Jenis</label>
              <select name="id_jenis2" type="text" class="form-control" required autofocus>
                <option value="">-= Pilih Jenis =-</option>
                <?php foreach($dataJenis as $row){ ?>
                <option value="<?=$row['id_jenis']?>"><?=$row['jenis_nama']?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
          </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    
    <div class="modal fade" id="modal-file">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Form File</h4>
          </div>
          <form action="" id="form-file">
          <div class="modal-body">
            <input type="hidden" name="kode_file" value="<?=@$tahun."-".@$kode?>">
            <div class="form-group">
              <label>Foto</label>
              <input type="file" name="file[]">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
          </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <div class="modal fade" id="modal-triwulan">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Form Triwilan</h4>
          </div>
          <form action="" id="form-triwulan">
          <div class="modal-body">
            <input type="hidden" name="kode_triwulan" value="<?=@$tahun."-".@$kode?>">
            <div class="form-group">
              <label>Nomenklatur Detail Rincian / Nama Paket Kegiatan Berdasarkan Kontrak</label>
              <input id="paket-nama" type="text" class="form-control" disabled>
            </div>
            <div class="form-group">
              <label>Triwulan</label>
              <select name="triwulan" type="text" class="form-control" required autofocus>
                <option value="">-= Pilih Triwulan =-</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
              </select>
            </div>
            <div id="set-form-triwulan">
              <div class="form-group">
                <label>Keuangan Rupiah</label>
                <input id="triwulan-keuangan" step="0.0001" type="number" class="form-control" required autofocus>
              </div>
              <div class="form-group">
                <label>Fisik Volume</label>
                <input  id="triwulan-volume" step="0.0001" type="number" class="form-control" required autofocus>
              </div>
              <div class="form-group">
                <label>Fisik Persen</label>
                <input  id="triwulan-persen" step="0.0001" type="number" class="form-control" required autofocus>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
          </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
