<!-- Large modal -->
<div class="modal fade bd-example-modal-lg" id="modal-form" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Form <?=@$judul?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-data">
                    <input type="hidden" name="kode" value="<?=@$kode?>">
                    <div class="position-relative form-group">
                        <label>Rekening</label>
                        <select name="tb_rekening1_kode" class="form-control" required>
                            <option value="5">BELANJA</option>
                        </select>
                    </div>
                    <div class="position-relative form-group">
                        <label>Tahun</label>
                        <select name="tb_monev_lra_rek1_tahun" class="form-control" required>
                            <option value="">-= Pilih Tahun =-</option>
                            <?php for($i = 1; $i <= 5; $i++){ ?>
                                <option value="<?=$i?>"><?=@$dataRpjmd->tb_rpjmd_tahun+$i-1?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="position-relative form-group">
                        <label>Bulan</label>
                        <select name="tb_monev_lra_rek1_bulan" class="form-control" required>
                            <option value="">-= Pilih Bulan =-</option>
                            <?php for($i = 1; $i <= 12; $i++){ ?>
                                <option value="<?=$i?>"><?=$i?></option>
                            <?php } ?>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary" form="form-data">Simpan</button>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
      
    $(document).ready(function() {
        
    } );
    var dataAll;
    var dataPilih;
    var kode = '<?=@$kode?>';
    var myTable = $('#table-data').DataTable();
    var formData = $('#form-data');
    var link = 'opd/penyusunan/lra';
    var page = 1;
    getData();

    function cariProgram(){
        kode = $('select[name="sasaran"]').val();
        getData();
    }
    
    function getData(_page = 1){
        page = _page;
        let url = base_url+link+"/get-data";
        let data = {
            page : page,
            kode : kode,
        }
        $.when(sendAjax(url, data)).done(function(respon){
            if(respon.status){
                setTable(respon.data);
                dataAll = respon.data;
            }else{

            }
        });
    }
        
    function setTable(data){
        myTable.clear().draw();
        no = 1;
        let kodeOneData;
        data.forEach(element => {
            kodeOneData = element['tb_monev_lra_kode']
                        +'-'+element['tb_rekening1_kode'];
            kodeShow =  element['tb_rekening1_kode'];
            tempData = [
                no,
                kodeShow,
                '<a href="'+base_url+'opd/penyusunan/lra/rek2/'+kodeOneData+'">'+element['tb_rekening1_nama']+'</a>',
                element['tb_monev_lra_rek1_tahun'],
                element['tb_monev_lra_rek1_bulan'],
                '<a class="btn btn-info"  href="#" onclick="setUpdate(\''+kodeOneData+'\')" data-toggle="modal" data-target="#modal-form" ><i class="fa fa-edit"></i></a>'+
                '<a class="btn btn-danger"  href="#"  data-setFunction="doDelete(\''+kodeOneData+'\')" data-judul="Hapus Data!" data-isi="Apakah anda yakin menghapus data?" onclick="setPesan(this)" data-toggle="modal" data-target="#modal-pesan"><i class="fa fa-trash"></i></a>',
            ]
            myTable.row.add(tempData).draw(  );
            no++;
        });
    }

    function setCreate(){
        formData[0].reset();
        formData.attr("action", base_url+link+"/create");
    }

    function setUpdate(id){
        formData[0].reset();
        formData.attr("action", base_url+link+"/update");
        dataPilih = getDataPilih(id);
        setForm(dataPilih);
    }

    function getDataPilih(id){
        dataPilih = {};
        let setKode = id.split("-");
        dataAll.forEach(element => {
            if(setKode[0] == element['tb_monev_lra_kode']  ){
                dataPilih = element;
                kode = id;
            }
        });
        return dataPilih;
    }

    function setForm(data){
        $("input[name='kode']").val(kode);
        $("select[name='tb_rekening1_kode']").val(data['tb_rekening1_kode']);
        $("select[name='tb_monev_lra_rek1_tahun']").val(data['tb_monev_lra_rek1_tahun']);
        $("select[name='tb_monev_lra_rek1_bulan']").val(data['tb_monev_lra_rek1_bulan']);
    }
    
    formData.submit(function(event){
        event.preventDefault();
        let form = $(this);
        let url = form.attr('action');
        let data = form.serializeArray();
        myModalHide();
        
        $.when(sendAjax(url, data)).done(function(respon){
            if(respon.status){
                getData();
            }
            // setPesanIsi("", respon.status, respon.pesan)
        });
    });

    function doDelete(id){

        let url = base_url+link+"/delete";
        let data = {
            kode : id,
        }
        myModalHide();
        $.when(sendAjax(url, data)).done(function(respon){
            if(respon.status){
                getData();
            }
        });
    }

    function myModalHide(){
        $('.close').click(); 
    }



</script>
