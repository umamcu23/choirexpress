<script>
    var save_method;
    var table;

    $("input").change(function() {
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
    $("textarea").change(function() {
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
    $("select").change(function() {
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });

    $(document).ready(function() {
        $('.msg-add-success').hide();
        $('.msg-update-success').hide();
        $('.msg-delete-success').hide();

        //datatables
        table = $('#tableOrder').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "<?php echo site_url('order/act_order_list') ?>",
                "type": "POST"
            },

            "columnDefs": [{
                "targets": [-1],
                "orderable": false,
            }, ],
        });
    });

    function add_order() {
        save_method = 'add';
        $('#form_order')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();
        $('#modal_form').modal('show');
        $('.modal-title-add').show();
        $('.modal-title-edit').hide();
        $('#tambah_barang').show();
        $('#ubah_order').hide();
        $('#subtotal').html('<label class="text-right">Subtotal : Rp. 0.00,-</label><br>')
        $('#totalBerat').html('<label class="text-right">Total Berat : 0.00 Kg</label><br>')
        $('#ongkosKirim').html('<label class="text-right">Ongkos Kirim : Rp. 0.00,-</label><br>')
        $('#totalHarga').html('<label class="text-right">Total Harga : Rp. 0.00,-</label><br>')
    }

    function pembayaran(idOrder) {
        save_method = 'update';
        $('#form_pembayaran')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();
        $('#tambah_order').hide();
        $('.custom-file-label').html('Cari Bukti Transfer');

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('order/act_get_by_id/') ?>" + idOrder,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('[name="idOrder"]').val(data.idOrder);
                $('#totalHargaBayar').html('Total Yang Harus Dibayarkan : Rp. ' + number_format(data.totalHarga, 2) + ",-");
                $('#modal_form_pembayaran').modal('show');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    }

    function reload_table() {
        table.ajax.reload(null, false); //reload datatable ajax 
    }

    function save_order() {
        $('#btnSave').text('Sedang menyimpan...');
        $('#btnSave').attr('disabled', true);
        var url;
        var formData = '';
        if (save_method == 'add') {
            url = "<?= base_url('order/act_order_add') ?>";
            var formData = new FormData($('#form_order')[0]);
        } else if (save_method == 'update') {
            url = "<?= base_url('order/act_order_update') ?>";
            var formData = new FormData($('#form_pembayaran')[0]);
        } else if (save_method == 'konfirmasi') {
            url = "<?= base_url('order/act_konfirmasi_update') ?>";
            var formData = new FormData($('#form_konfirmasi')[0]);
        } else if (save_method == 'kirim_paket') {
            url = "<?= base_url('order/act_kirim_update') ?>";
            var formData = new FormData($('#form_kirim')[0]);
        } else if (save_method == 'terima_paket') {
            url = "<?= base_url('order/act_terima_update') ?>";
            var formData = new FormData($('#form_terima')[0]);
        }


        // ajax adding data to database
        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            dataType: "JSON",
            processData: false,
            contentType: false,
            success: function(data) {
                if (data.status) {
                    $('#modal_form').modal('hide');
                    $('#modal_form_pembayaran').modal('hide');
                    $('#modal_form_konfirmasi').modal('hide');
                    $('#modal_form_kirim').modal('hide');
                    $('#modal_form_terima').modal('hide');

                    if (save_method == 'add') {
                        $('.msg-add-success').show('slow');
                    } else {
                        $('.msg-update-success').show('slow');
                    }
                    reload_table();
                } else {
                    for (var i = 0; i < data.inputerror.length; i++) {
                        $('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error');
                        $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]);
                    }
                }
                $('#btnSave').text('Simpan');
                $('#btnSave').attr('disabled', false);

            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error adding / update data');
                $('#btnSave').text('Simpan');
                $('#btnSave').attr('disabled', false);

            }
        });

        timerAutomatic();

    }

    function delete_barang(id) {
        Swal.fire({
            title: 'Hapus Data',
            text: "Anda yakin menghapus data ini?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonText: 'Batal',
            confirmButtonText: 'Ya, saya yakin!',
            cancelButtonColor: '#3085d6',

        }).then(result => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?php echo site_url('order/act_order_delete/') ?>" + id,
                    type: "POST",
                    dataType: "JSON",
                    success: function(data) {
                        $('#modal_form').modal('hide');
                        Swal.fire(
                            'Hapus!',
                            'Data berhasil dihapus.',
                            'success'
                        )
                        reload_table();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Error deleting data');
                    }
                });
            }
        })
        return false;
    }

    document.getElementById('modal_form').style.overflowY = 'scroll';

    $('#idBarang').change(function() {
        var idBarang = $(this).val();
        $.ajax({
            url: "<?php echo site_url('order/get_harga/') ?>" + idBarang,
            type: "POST",
            dataType: "JSON",
            success: function(data) {
                $('[name="hargaJual"]').val(data.hargaJual);
                $('[name="beratBarang"]').val(data.beratBarang);
                hitung();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error adding / update data');
            }
        });
    });

    $('.idKurir').change(function() {
        var idKurir = $(this).val();
        $.ajax({
            url: "<?php echo site_url('order/get_harga_kurir/') ?>" + idKurir,
            type: "POST",
            dataType: "JSON",
            success: function(data) {
                $('[name="ongkos"]').val(data.ongkosKirim);
                $('[name="estimasiSampai"]').val(data.estimasi);
                hitung();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error adding / update data');
            }
        });
    });

    $('#jumlahBeli').keyup(function() {
        hitung();
    });

    function hitung() {
        var hargaJual = parseInt(document.getElementById('hargaJual').value);
        var jumlahBeli = parseInt(document.getElementById('jumlahBeli').value);
        var beratBarang = parseFloat(document.getElementById('beratBarang').value);
        var ongkosKirim = (document.getElementById('ongkos').value);
        if (ongkosKirim == '') {
            ongkosKirim = 0;
        }
        var totalBerat = (beratBarang * jumlahBeli);
        var subtotal = ((jumlahBeli * hargaJual));
        var totalHarga = (subtotal + parseInt(ongkosKirim))


        $('[name="subtotalVal"]').val(subtotal);
        $('[name="totalBeratVal"]').val(totalBerat);
        $('[name="ongkosKirimVal"]').val(ongkosKirim);
        $('[name="totalHargaVal"]').val(totalHarga);

        $('#subtotal').html('<label class="text-right">Subtotal : Rp. ' + number_format(subtotal, 2) + ',-</label><br>')
        $('#totalBerat').html('<label class="text-right">Total Berat : ' + number_format(totalBerat, 2) + ' Kg</label>')
        $('#ongkosKirim').html('<label class="text-right">Ongkos Kirim : Rp. ' + number_format(ongkosKirim, 2) + ',-</label>')
        $('#totalHarga').html('<label class="text-right">Total Harga : Rp. ' + number_format(totalHarga, 2) + ',-</label><br>')
    }


    function konfirmasi_buktitransfer(idOrder) {
        save_method = 'konfirmasi';
        $('#form_konfirmasi')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('order/act_get_by_id/') ?>" + idOrder,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                var konfirmasi = '<?php echo  site_url('assets/images/bukti/'); ?>' + data.buktiTransfer;

                $('[name="idOrderKonfirmasi"]').val(data.idOrder);
                $('[name="idOrder"]').val(data.idOrder);
                $('#namaBarang').html(': <label>' + data.namaBarang + '</label>');
                $('#jumlahBeliKonfirmasi').html(': <label>' + data.jumlahBeli + '</label>');
                $('#namaKurir').html(': <label>' + data.namaKurir + '</label>');
                $('#estimasi').html(': <label>' + data.estimasi + '</label>');
                $('#createdBy').html(': <label>' + data.username + '</label>');
                $('#createdDate').html(': <label>' + data.createdDate + '</label>');
                $('#transferDate').html(': <label>' + data.transferDate + '</label>');
                $('#totalHargaKonfirmasi').html(': <label>Rp ' + number_format(data.totalHarga, 2) + ',-</label>');

                $('#konfirmasiBuktiTransfer').html('<img src="' + konfirmasi + '" alt="" class="img-fluid hover-shadow cursor" style="border:2px solid white; max-width:300px">');

                $('#modal_form_konfirmasi').modal('show');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    }

    function kirim_paket(idOrder) {
        save_method = 'kirim_paket';
        $('#form_kirim')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('order/act_get_by_id/') ?>" + idOrder,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('[name="idOrder"]').val(data.idOrder);
                $('#modal_form_kirim').modal('show');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    }

    function terima_paket(idOrder) {
        save_method = 'terima_paket';
        $('#form_terima')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('order/act_get_by_id/') ?>" + idOrder,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('[name="idOrder"]').val(data.idOrder);
                $('#modal_form_terima').modal('show');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    }

    function detail_order(idOrder) {
        save_method = 'detail_order';
        $('#form_detail')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('order/act_get_by_id/') ?>" + idOrder,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                var status = data.status;
                $('[name="idOrder"]').val(data.idOrder);
                if (status == 'SUDAH BAYAR') {
                    $('#statusProses').html('<i class="bi bi-check-all"></i> SUDAH DIBAYAR -  <label style="font-size: 10px;"> [ Tanggal : ' + data.transferDate + ' ]</label><br> <i class="bi bi-x-lg"></i> PEMBAYARAN BERHASIL <br><i class="bi bi-x-lg"></i> SEDANG PROSES<br><i class="bi bi-x-lg"></i> SUDAH DIKIRIM<br><i class="bi bi-x-lg"></i> SUDAH DITERIMA<br><i class="bi bi-x-lg"></i> SELESAI');
                } else if (status == 'PEMBAYARAN BERHASIL') {
                    $('#statusProses').html('<i class="bi bi-check-all"></i> SUDAH DIBAYAR -  <label style="font-size: 10px;"> [ Tanggal : ' + data.transferDate + ' ]</label><br> <i class="bi bi-check-all"></i> PEMBAYARAN BERHASIL -  <label style="font-size: 10px;"> [ Tanggal : ' + data.confirmationDate + ' ]</label><br><i class="bi bi-check-all"></i> SEDANG PROSES<br><i class="bi bi-x-lg"></i> SUDAH DIKIRIM<br><i class="bi bi-x-lg"></i> SUDAH DITERIMA<br><i class="bi bi-x-lg"></i> SELESAI');
                } else if (status == 'SUDAH DIKIRIM') {
                    $('#statusProses').html('<i class="bi bi-check-all"></i> SUDAH DIBAYAR -  <label style="font-size: 10px;"> [ Tanggal : ' + data.transferDate + ' ]</label><br> <i class="bi bi-check-all"></i> PEMBAYARAN BERHASIL -  <label style="font-size: 10px;"> [ Tanggal : ' + data.confirmationDate + ' ] </label><br><i class="bi bi-check-all"></i> SEDANG PROSES <br><i class="bi bi-check-all"></i> SUDAH DIKIRIM <label style="font-size: 10px;"> [ Tanggal : ' + data.sendDate + ' ]</label><br><i class="bi bi-x-lg"></i> SUDAH DITERIMA<br><i class="bi bi-x-lg"></i> SELESAI');
                } else if (status == 'SUDAH DITERIMA') {
                    $('#statusProses').html('<i class="bi bi-check-all"></i> SUDAH DIBAYAR -  <label style="font-size: 10px;"> [ Tanggal : ' + data.transferDate + ' ]</label><br> <i class="bi bi-check-all"></i> PEMBAYARAN BERHASIL -  <label style="font-size: 10px;"> [ Tanggal : ' + data.confirmationDate + ' ]</label><br><i class="bi bi-check-all"></i> SEDANG PROSES<br><i class="bi bi-check-all"></i> SUDAH DIKIRIM -  <label style="font-size: 10px;"> [ Tanggal : ' + data.sendDate + ' ]</label><br><i class="bi bi-check-all"></i> SUDAH DITERIMA - <label style="font-size: 10px;"> [ Tanggal : ' + data.finishDate + ' ]</label><br><i class="bi bi-check-all"></i> SELESAI <label style="font-size: 10px;"> [ Tanggal : ' + data.finishDate + ' ]</label> <br><br> Diterima oleh : ' + data.finishBy);
                }

                $('#modal_form_detail').modal('show');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    }
</script>