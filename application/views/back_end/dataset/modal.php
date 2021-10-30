<div class="card-body">

    <h4 class="mt-0 header-title"><?= $detail['judul'] ?></h4>

    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#home" role="tab" aria-selected="true">
                <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                <span class="d-none d-sm-block">Data</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#profile" role="tab" aria-selected="false">
                <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                <span class="d-none d-sm-block">Metadata</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#dataset" role="tab" aria-selected="false">
                <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                <span class="d-none d-sm-block">Dataset</span>
            </a>
        </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div class="tab-pane p-3 active" id="home" role="tabpanel">
            <p class="mb-0 text-justify">
                <strong>Deskripsi : </strong><br><?= $detail['deskripsi'] ?>
            </p>
        </div>
        <div class="tab-pane p-3" id="profile" role="tabpanel">
            <div class="card-body">

                <h4 class="mt-0 header-title">Metadata</h4>

                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Dataset Diperbaharui</label>
                    <div class="col-sm-8">
                        <input class="form-control" type="text" readonly value="<?= $detail['updated_at'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Dataset Dibuat</label>
                    <div class="col-sm-8">
                        <input class="form-control" type="text" readonly value="<?= $detail['created_at'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Versi</label>
                    <div class="col-sm-8">
                        <input class="form-control" type="text" readonly value="<?= $detail['versi'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Produsen</label>
                    <div class="col-sm-8">
                        <input class="form-control" type="text" readonly value="<?= $detail['nama_opd'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Kontak Produsen</label>
                    <div class="col-sm-8">
                        <input class="form-control" type="text" readonly value="-">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Pengukuran Dataset</label>
                    <div class="col-sm-8">
                        <input class="form-control" type="text" readonly value="<?= $detail['pengukuran'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Satuan Dataset</label>
                    <div class="col-sm-8">
                        <input class="form-control" type="text" readonly value="<?= $detail['satuan'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Tahun Tersedia Dataset</label>
                    <div class="col-sm-8">
                        <input class="form-control" type="text" readonly value="<?= $detail['tahun_tersedia'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Tingkat Penyajian Dataset</label>
                    <div class="col-sm-8">
                        <input class="form-control" type="text" readonly value="<?= $detail['tingkat_penyajian'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Cakupan Dataset</label>
                    <div class="col-sm-8">
                        <input class="form-control" type="text" readonly value="<?= $detail['cakupan'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Frekuensi Dataset</label>
                    <div class="col-sm-8">
                        <input class="form-control" type="text" readonly value="<?= $detail['frekuensi'] ?>">
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane p-3" id="dataset" role="tabpanel">
            <?php
            if (!empty($detail['file'])) :
                $csv = FCPATH . '/uploads/data/' . $detail['file'];
                $dataCsv = csv2Json($csv);
                if ($dataCsv) {
                    $html = '<table id="table_dataset" class="table table-striped table-bordered dt-responsive display nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">';

                    $html .= '<thead><tr><th>No.</th>';
                    foreach ($dataCsv[0] as $baris => $nilai) :
                        $html .= '<th>' . $baris . '</th>';
                    endforeach;
                    $html .= '</tr></thead>';
                    $html .= '<tbody>';
                    $no = 1;
                    for ($i = 0; $i < count($dataCsv); $i++) {
                        $html .= '<tr>';
                        $html .= '<td>' . $no++ . '</td>';
                        foreach ($dataCsv[$i] as $baris => $nilai) :
                            $html .= '<td>' . $nilai . '</td>';
                        endforeach;
                        $html .= '</tr>';
                    }
                    $html .= '</tbody>';
                    $html .= '</table>';
                } else {
                    $html = '<table width="100%">
                        <tr>
                            <td class="text-center text-danger"> -- Data Gagal Dimuat -- </td>
                        </tr>
                    </table>';
                }

                echo $html;
            endif;
            ?>
        </div>
    </div>

</div>

<script>
    $(document).ready(function() {
        var table = $('#table_dataset').DataTable();
        table.destroy();
        $("#table_dataset").DataTable({
            'scrollX': true
        });
    });
</script>