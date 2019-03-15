<?php

use yii\helpers\Html;

use app\models\Rt;
use kartik\select2\Select2;
use yii\bootstrap\Modal;

?>

<div class="box-header with-border">
    <h2 class="box-title"><?= 'Tambah Seksi - ' . $model->nama_rt . '/' . $nama_rw ?></h2>
</div>
<div class="box-body">

    <div class="form-horizontal">
        <?php $value_seksi = !empty($model->seksi) ? json_decode($model->seksi, true) : null; ?>
        <?php foreach ($list_seksi as $seksi): ?>
            <div class="form-group input-seksi">
                <label class="control-label col-sm-2" id="label_rt-seksi_<?= $seksi ?>">Seksi <?= ucwords(str_replace('_', ' ', $seksi)) ?></label>
                <div class="col-sm-8">
                    <?= Select2::widget([
                        'id' => 'rt-seksi_' . $seksi,
                        'name' => 'Rt[seksi][' . $seksi . ']',
                        'value' => isset($value_seksi[$seksi]) ? $value_seksi[$seksi] : null,
                        'data' => $list_warga_rt,
                        'language' => 'id',
                        'options' => ['placeholder' => '--PILIH--'],
                        'pluginOptions' => [
                            'allowClear' => true,
                            'multiple' => true,
                        ],
                    ]); ?>
                </div>
            </div>
        <?php endforeach; ?>

        <div class="form-group">
            <div class="col-sm-3 pull-right">
                <?= Html::button('Save', ['class' => 'btn btn-success', 'id' => 'btn_save']) ?>
            </div>
        </div>
    </div>

</div>

<?php
$this->registerJs(
    '
    getTableSeksi();

    function addTable(tbl_id, kolom, data)
    {
        var row_table_body = "";
        row_table_head = `
            <tr>
                <th></th>
                <th>Seksi</th>
                <th>Nama</th>
            </tr>
        `;

        if (data.length > 0) {
            for (let i = 0; i < data.length; i++) {
                row_table_body += "<tr><td>" + (i + 1) + "</td>";
                row_table_body += "<td>" + kolom[i] + "</td><td>";
                for (let j = 0; j < data[i].length; j++) {
                    row_table_body += "- " + data[i][j].text + "<br>";        
                }
                row_table_body += "</td></tr>";
            }
        } else {
            row_table_body += "<tr><td colspan=3 class=text-center>Tidak Ada Seksi</td></tr>";
        }
        
        $("#" + tbl_id).find("thead").html(row_table_head);
        $("#" + tbl_id).find("tbody").html(row_table_body);
        return true;
    }

    function getTableSeksi()
    {
        var list_seksi = [];
        var nama_seksi = [];

        $(".input-seksi [id^=rt-seksi_]").each(function() {
            var seksi = $(this).select2("data");
            if (seksi.length > 0) {
                list_seksi.push(seksi);
                nama_seksi.push($("#label_" + $(this).attr("id")).text());
            }
        });

        addTable("tbl_seksi", nama_seksi, list_seksi);
    }

    $("#btn_save").on("click", function() {
        getTableSeksi();
        $("#modal_seksi").modal("hide");
    });

    ',
    \yii\web\View::POS_READY,
    'modal-rt-js'
);
?>