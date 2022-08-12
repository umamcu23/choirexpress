<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h3 class="page-title text-truncate text-dark font-weight-medium mb-1"><?= $titleMenu; ?></h3>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row box-shadow-table">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="alert alert-success msg-update-success" role="alert">
                            <h3 class="text-msg-action">Data Berhasil Diubah</h3>
                        </div>
                        <div class="alert alert-success msg-add-success" role="alert">
                            <h3 class="text-msg-action">Data Berhasil Ditambah</h3>
                        </div>
                        <button class="btn btn-primary mb-3" onclick="add_order()"><i class="bi bi-file-plus"></i> Tambah Data</button>
                        <div class="table-responsive ">
                            <table id="tableOrder" class="table table-striped table-bordered table-hover nowrap table-sm box-shadow-table" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nama Barang</th>
                                        <th scope="col">Penerima</th>
                                        <th scope="col">Alamat Penerima</th>
                                        <th scope="col">No. Hp</th>
                                        <th scope="col">Total Harga</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody style="font-size: 12px; margin:-5px;">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Start modal Add-->
    <div class=" modal fade" id="modal_form" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title-add text-center" id="tambah_order">
                        <strong style="border-radius:50px; padding:10px; color: #fff!important;background: linear-gradient(to right,#8971ea,#7f72ea,#7574ea,#6a75e9,#5f76e8);box-shadow: 0 7px 12px 0 rgb(95 118 232 / 21%);opacity: 1;">Tambah Data</strong>
                    </h3>
                    <h3 class="modal-title-add text-center" id="ubah_order">
                        <strong style="border-radius:50px; padding:10px; color: #fff!important;background: linear-gradient(to right,#8971ea,#7f72ea,#7574ea,#6a75e9,#5f76e8);box-shadow: 0 7px 12px 0 rgb(95 118 232 / 21%);opacity: 1;">Ubah Data</strong>
                    </h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>

                <div class="modal-body form">
                    <form action="#" id="form_order" class="form-horizontal form_order" method="post">
                        <input type="hidden" value="" name="idOrder" />
                        <div class="form-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="barang-tab" data-toggle="tab" href="#barang" role="tab" aria-controls="barang" aria-selected="true">Detail Pesanan</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="penerima-tab" data-toggle="tab" href="#penerima" role="tab" aria-controls="penerima" aria-selected="false">Detail Penerima</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="ekspedisi-tab" data-toggle="tab" href="#ekspedisi" role="tab" aria-controls="ekspedisi" aria-selected="false">Detail Ekspedisi</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" id="barang" role="tabpanel" aria-labelledby="barang-tab">
                                            <div class="row p-3 m-2 card-order">
                                                <div class="col-lg-12">
                                                    <div class="row mt-2">
                                                        <div class="col-lg-6">
                                                            <div class="form-group has-error">
                                                                <label for="" class="control-label">Cari Barang</label>
                                                                <select name="idBarang" id="idBarang" class="form-control idBarang">
                                                                    <option value="">--Pilih--</option>
                                                                    <?php foreach ($tb_barang as $barang) : ?>
                                                                        <option value="<?= $barang['idBarang']  ?>"><?= $barang['namaBarang'] ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                                <span class="help-block"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group has-error">
                                                                <label for="" class="control-label">Harga Barang</label>
                                                                <input type="text" name="hargaJual" id="hargaJual" class="form-control" readonly>
                                                                <span class="help-block"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group has-error">
                                                                <label for="" class="control-label">Berat Barang</label>
                                                                <input type="text" name="beratBarang" id="beratBarang" class="form-control" readonly>
                                                                <span class="help-block"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group has-error">
                                                                <label for="" class="control-label">Jumlah Beli</label>
                                                                <input type="number" name="jumlahBeli" id="jumlahBeli" class="form-control" placeholder="">
                                                                <span class="help-block"></span>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <!-- Penerima -->
                                        <div class="tab-pane fade show" id="penerima" role="tabpanel" aria-labelledby="penerima-tab">
                                            <div class="row p-3 bg-light m-2 card-order">
                                                <div class="col-lg-6">
                                                    <div class="form-group has-error">
                                                        <label for="" class="control-label">Nama Penerima</label>
                                                        <input type="text" name="penerima" id="penerima" class="form-control" placeholder="Nama Penerima">
                                                        <span class="help-block"></span>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group has-error">
                                                        <label for="" class="control-label">No. Hp Penerima</label>
                                                        <input type="text" name="noHpPenerima" id="noHpPenerima" class="form-control" placeholder="089612345678">
                                                        <span class="help-block"></span>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="form-group has-error">
                                                        <label for="" class="control-label">Alamat Penerima</label>
                                                        <textarea name="alamatPenerima" id="alamatPenerima" cols="30" rows="5" placeholder="Alamat Penerima" class="form-control"></textarea>
                                                        <span class="help-block"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end of Penerima -->

                                        <!-- Ekspedisi -->
                                        <div class="tab-pane fade show" id="ekspedisi" role="tabpanel" aria-labelledby="ekspedisi-tab">
                                            <div class="row p-3 bg-light m-2 card-order">
                                                <div class="col-lg-4">
                                                    <div class="form-group has-error">
                                                        <label for="" class="control-label">Nama Kurir</label>
                                                        <select name="idKurir" id="idKurir" class="form-control idKurir">
                                                            <option value="">--Pilih--</option>
                                                            <?php foreach ($tb_kurir as $kurir) : ?>
                                                                <option value="<?= $kurir['idKurir']  ?>"><?= $kurir['namaKurir'] ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                        <span class="help-block"></span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group has-error">
                                                        <label for="" class="control-label">Harga per Kg</label>
                                                        <input type="text" name="ongkos" id="ongkos" class="form-control" readonly>
                                                        <span class=" help-block"></span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group has-error">
                                                        <label for="" class="control-label">Estimasi</label>
                                                        <input type="text" name="estimasiSampai" id="estimasiSampai" class="form-control" readonly>
                                                        <span class=" help-block"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end of Ekspedisi -->
                                    </div>

                                    <div class="col-lg-12  mt-3 card-order-harga">
                                        <div style="height: 120px; ">
                                            <input type="hidden" name="subtotalVal" id="subtotalVal">
                                            <input type="hidden" name="totalBeratVal" id="totalBeratVal">
                                            <input type="hidden" name="ongkosKirimVal" id="ongkosKirimVal">
                                            <input type="hidden" name="totalHargaVal" id="totalHargaVal">
                                            <div class="subtotal text-right" id="subtotal"></div>
                                            <div class="totalBerat text-right" id="totalBerat"></div>
                                            <div class="ongkosKirim text-right" id="ongkosKirim"></div>
                                            <div class="totalHarga text-right" id="totalHarga"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btnSave" onclick="save_order()" class="btn btn-primary">Pesan</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- End Bootstrap modal -->


    <!-- Start modal upload-->
    <div class="modal fade" id="modal_form_pembayaran" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title-pembayaran text-center" id="newUserModalLabel">
                        <strong style="border-radius:50px; padding:10px; color: #fff!important;background: linear-gradient(to right,#8971ea,#7f72ea,#7574ea,#6a75e9,#5f76e8);box-shadow: 0 7px 12px 0 rgb(95 118 232 / 21%);opacity: 1;">Upload Bukti Transfer</strong>
                    </h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body form">
                    <form action="#" id="form_pembayaran" method="post" class="form-horizontal form_pembayaran" enctype="multipart/form-data">
                        <input type="hidden" value="" name="idTransaksi" id="idTransaksi" />
                        <div class="form-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="upload-tab" data-toggle="tab" href="#upload" role="tab" aria-controls="upload" aria-selected="true">Upload</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" id="upload" role="tabpanel" aria-labelledby="upload-tab">
                                            <div class="row p-3 m-2 card-order">
                                                <div class="form-group col-12">
                                                    <div class="col-lg-12">
                                                        <br>
                                                        <input type="hidden" class="form-control" id="idOrder" name="idOrder">
                                                        <div for="totalHarga" id="totalHargaBayar"></div>
                                                        <br>
                                                        <label for="" class="control-label">Upload Bukti Transfer</label>
                                                        <div class="form-group has-error col-lg-12 ">
                                                            <div class="form-group">
                                                                <div class="custom-file">
                                                                    <input type="file" class="custom-file-input" id="buktiTransfer" name="buktiTransfer" accept=".JPG, .PNG">
                                                                    <label class="custom-file-label" for="image">Cari Bukti Transfer</label>
                                                                    <span class="help-block"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <label class="" style="color:yellow;" for="note">Note: Format foto harus .PNG atau .JPG dan Maksimal 300KB</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button id="button" onclick="save_order()" class="btn btn-primary"> Upload Bukti Transfer </button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- End Bootstrap modal -->

    <!-- Start modal Konfirmasi-->
    <div class="modal fade" id="modal_form_konfirmasi" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title-konfirmasi text-center" id="newUserModalLabel">
                        <strong style="border-radius:50px; padding:10px; color: #fff!important;background: linear-gradient(to right,#8971ea,#7f72ea,#7574ea,#6a75e9,#5f76e8);box-shadow: 0 7px 12px 0 rgb(95 118 232 / 21%);opacity: 1;">Konfirmasi Bukti Transfer</strong>
                    </h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body form">
                    <form action="" id="form_konfirmasi" method="post" class="form-horizontal form_konfirmasi" enctype="multipart/form-data">
                        <input type="hidden" value="" name="idOrder" id="idOrder" />
                        <div class="form-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="konfirmasi-tab" data-toggle="tab" href="#konfirmasi" role="tab" aria-controls="konfirmasi" aria-selected="true">Konfirmasi</a>
                                        </li>
                                    </ul>

                                    <div class="tab-content" id="myTabContent">
                                        <div class="form-group col-12">
                                            <div class="tab-pane fade show active" id="konfirmasi" role="tabpanel" aria-labelledby="konfirmasi-tab">
                                                <div class="row p-3 m-2 card-order">
                                                    <div class="col-lg-4">
                                                        <label for="" class="control-label">File Bukti Transfer</label>
                                                        <hr style="border:1px solid white; " class="text-left justify-content-around">
                                                        <div class="konfirmasiBuktiTransfer" id="konfirmasiBuktiTransfer"></div>
                                                    </div>

                                                    <div class="col-lg-8">
                                                        <label for="" class="control-label">Detail Pembelian</label>
                                                        <hr style="border:1px solid white; width:100%">
                                                        <div class="row">
                                                            <div class="col-5">
                                                                <label for="" class="control-label">Username</label>
                                                            </div>
                                                            <strong class="col-lg-7" id="createdBy"></strong>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-5">
                                                                <label for="" class="control-label">Tanggal Pembelian </label>
                                                            </div>
                                                            <strong class="col-7" id="createdDate"></strong>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-5">
                                                                <label for="" class="control-label">Tanggal Pembayaran </label>
                                                            </div>
                                                            <strong class="col-7" id="transferDate"></strong>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-5">
                                                                <label for="" class="control-label">Nama Barang </label>
                                                            </div>
                                                            <strong class="col-7" id="namaBarang"></strong>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-5">
                                                                <label for="" class="control-label">Jumlah Beli </label>
                                                            </div>
                                                            <strong class="col-7" id="jumlahBeliKonfirmasi"></strong>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-5">
                                                                <label for="" class="control-label">Nama Kurir </label>
                                                            </div>
                                                            <strong class="col-7" id="namaKurir"></strong>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-5">
                                                                <label for="" class="control-label">Estimasi </label>
                                                            </div>
                                                            <strong class="col-7" id="estimasi"></strong>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-5">
                                                                <label for="" class="control-label">Total Harga </label>
                                                            </div>
                                                            <strong class="col-7" id="totalHargaKonfirmasi"></strong>
                                                        </div>
                                                    </div>
                                                    <select name="pilihKonfirmasi" id="pilihKonfirmasi" class="form-control m-3">
                                                        <option value="">--Pilih Konfirmasi--</option>
                                                        <option value="VALID">Bukti Transfer : VALID</option>
                                                        <option value="TIDAK VALID">Bukti Transfer : TIDAK VALID</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btnSave" onclick="save_order()" class="btn btn-primary">Konfirmasi</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- End Bootstrap modal -->

    <!-- Start modal Kirim-->
    <div class="modal fade" id="modal_form_kirim" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title-kirim text-center" id="newUserModalLabel">
                        <strong style="border-radius:50px; padding:10px; color: #fff!important;background: linear-gradient(to right,#8971ea,#7f72ea,#7574ea,#6a75e9,#5f76e8);box-shadow: 0 7px 12px 0 rgb(95 118 232 / 21%);opacity: 1;">Kirim Paket</strong>
                    </h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body form">
                    <form action="" id="form_kirim" method="post" class="form-horizontal form_kirim" enctype="multipart/form-data">
                        <input type="hidden" value="" name="idOrder" id="idOrder" />
                        <div class="form-body">
                            <div class="row">
                                <div class="form-group col-12">
                                    <div class="tab-pane fade show active" id="konfirmasi" role="tabpanel" aria-labelledby="konfirmasi-tab">
                                        <div class="row">
                                            <div class="col-lg-12 text-center">
                                                <label for="kirimpaket">Apakah Paket Siap Dikirim ?</label><br>
                                                <button type="button" id="btnSave" onclick="save_order()" class="btn btn-primary">Kirim Sekarang</button>
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- End Bootstrap modal -->

    <!-- Start modal terima-->
    <div class="modal fade" id="modal_form_terima" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title-terima text-center" id="newUserModalLabel">
                        <strong style="border-radius:50px; padding:10px; color: #fff!important;background: linear-gradient(to right,#8971ea,#7f72ea,#7574ea,#6a75e9,#5f76e8);box-shadow: 0 7px 12px 0 rgb(95 118 232 / 21%);opacity: 1;">Terima Paket</strong>
                    </h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body form">
                    <form action="#" id="form_terima" method="post" class="form-horizontal form_terima">
                        <input type="hidden" value="" name="idOrder" id="idOrder" />
                        <div class="form-body">
                            <div class="row">
                                <div class="form-group col-lg-12">
                                    <div class="row p-3 m-2 card-order">
                                        <div class="col-lg-12">
                                            <div class="form-group has-error">
                                                <label for="kirimpaket">Diterima Oleh</label>
                                                <input type="text" name="finishBy" id="finishBy" class="form-control">
                                                <span class="help-block"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="modal-footer">
                        <div class="col-lg-12 text-right">
                            <button type="button" id="btnSave" onclick="save_order()" class="btn btn-primary">Simpan</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                        </div>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- End Bootstrap modal -->


    <!-- Start modal detail-->
    <div class="modal fade" id="modal_form_detail" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title-detail text-center" id="newUserModalLabel">
                        <strong style="border-radius:50px; padding:10px; color: #fff!important;background: linear-gradient(to right,#8971ea,#7f72ea,#7574ea,#6a75e9,#5f76e8);box-shadow: 0 7px 12px 0 rgb(95 118 232 / 21%);opacity: 1;">Detail Status</strong>
                    </h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body form">
                    <form action="" id="form_detail" method="post" class="form-horizontal form_detail" enctype="multipart/form-data">
                        <input type="hidden" value="" name="idOrder" id="idOrder" />
                        <div class="form-body">
                            <div class="row">
                                <div class="form-group col-lg-12">
                                    <div class="row p-3 m-2 card-order">
                                        <div class="col-lg-12">
                                            <div class="form-group has-error">
                                                <label for="kirimpaket">Status Paket</label><br>
                                                <label for="" id="statusProses"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="modal-footer">
                        <div class="col-lg-12 text-right">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Tututp</button>
                        </div>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- End Bootstrap modal -->