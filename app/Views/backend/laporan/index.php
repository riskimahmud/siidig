<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form role="form" action="<?= base_url("cetak_laporan"); ?>" target="_blank" id="form" method="post">
                    <div class="row">
                        <div class="col-md-3 col-sm-12">
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="semua">Semua</option>
                                    <option value="0">Menunggu</option>
                                    <option value="1">Proses</option>
                                    <option value="2">Disetujui</option>
                                    <option value="3">Selesai</option>
                                    <option value="4">Ditolak</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-12">
                            <div class="form-group">
                                <label>Keperluan</label>
                                <select name="keperluan" id="keperluan" class="form-control">
                                    <option value="semua">Semua</option>
                                    <?php foreach ($keperluan as $kep) : ?>
                                        <option value="<?= $kep->keperluan_id; ?>"><?= $kep->keperluan; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-12">
                            <div class="form-group">
                                <label>Satuan Kerja</label>
                                <select name="satuan" id="satuan" class="form-control" <?= (user("level") == "operator") ? 'disabled="disabled"' : ''; ?>>
                                    <option value="semua">Semua</option>
                                    <?php foreach ($satuan as $sat) : ?>
                                        <option value="<?= $sat->satuan_id; ?>" <?= set_select('satuan', $sat->satuan_id, ($sat->satuan_id == user("satuan") && user("level") == "operator") ? TRUE : FALSE); ?>><?= $sat->nama_satuan; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php
                                if (user("level") == "operator") {
                                    echo form_hidden('satuan', user("satuan"));
                                }
                                ?>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <div class="form-group">
                                <label>Dari - Sampai Tanggal</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="far fa-calendar-alt"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control float-right" name="tanggal" id="daterange">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <a href="javascript:void(0)" id="cariLaporan" class="btn btn-primary"><i class="fas fa-search fa-fw"></i> Cari</a>
                            <button disabled="disabled" class="btn btn-success" id="cetak"><i class="fas fa-print"></i> Cetak</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card" id="boxCari"></div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
    //Date range picker
    $(function() {

        var start = moment().subtract(29, 'days');
        var end = moment();

        function cb(start, end) {
            $('#daterange').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }

        $('#daterange').daterangepicker({
            linkedCalendars: false,
            showDropdowns: true,
            autoUpdateInput: false,
            locale: {
                cancelLabel: 'Batal',
                customRangeLabel: "Pilih Tanggal",
            },
            alwaysShowCalendars: true,
            // startDate: start,
            // endDate: end,
            ranges: {
                'Hari Ini': [moment(), moment()],
                'Kemarin': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                '7 Hari Terakhir': [moment().subtract(6, 'days'), moment()],
                '30 Hari Terakhir': [moment().subtract(29, 'days'), moment()],
                'Bulan Ini': [moment().startOf('month'), moment().endOf('month')],
                'Bulan Terakhir': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, cb);

        cb(start, end);

        $('#daterange').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
        });

        $('#daterange').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });
    });

    function disabledButton() {
        $("#cetak").attr("disabled", "disabled");
        $("#boxCari").html("");
    }

    // $("#status").on("change", function(e) {
    $("form :input").change(function() {
        disabledButton();
    })

    $("#daterange").on("click", function() {
        disabledButton();
    })

    // $("form :select").change(function() {
    //     disabledButton();
    // })

    $("#cariLaporan").on("click", function(e) {
        const form = $('#form').serialize();
        $.ajax({
            type: 'POST',
            url: url + '/cari_laporan',
            dataType: 'json',
            data: form,
            success: function(response) {
                // console.log(response);
                if (response.pengajuan.length > 0) {
                    let content = `
                    <div class="card-body">
                    <table class="table table-bordered" id="table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Pemohon (NIK/NAMA)</th>
                                <th>Tgl Pengajuan</th>
                                <th>Satuan Tujuan</th>
                                <th>Keperluan</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                    `;
                    let no = 1;
                    response.pengajuan.forEach(e => {
                        content += `
                            <tr>
                                <td>${no++}</td>
                                <td>${e.no_identitas}<br>${e.nama}</td>
                                <td>${e.tgl_pengajuan}</td>
                                <td>${e.nama_satuan}</td>
                                <td>${e.keperluan}</td>
                                <td>${e.status}</td>
                            </tr>
                        `;
                    });
                    content += `</tbody></table></div>`;
                    console.log(content);
                    $("#boxCari").html(content);
                    $("#cetak").removeAttr("disabled", "disabled");
                    $("#table").dataTable();
                } else {
                    let content = `
                    <div class="card-body">
                    <div class="alert alert-dark">Tidak ada data untuk ditampilkan</div>
                    </div>
                    `;
                    $("#boxCari").html(content);
                    $("#cetak").attr("disabled", "disabled");
                }
            }
        });
    })
</script>
<?= $this->endSection(); ?>