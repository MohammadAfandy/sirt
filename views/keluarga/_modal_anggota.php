<?php

use yii\helpers\Html;

use app\models\Rt;
use kartik\select2\Select2;
use yii\bootstrap\Modal;

?>

<div class="box-body">
    <div class="form-horizontal">
        <?php $value_anggota = !empty($model->anggota_keluarga) ? json_decode($model->anggota_keluarga, true) : null; ?>
        <?php foreach ($field_anggota as $anggota): ?>
            <div class="form-group input-anggota">
                <label class="control-label col-sm-3" id="label_keluarga-anggota_keluarga_<?= $anggota ?>"><?= ucwords(str_replace('_', ' ', $anggota)) ?></label>
                <div class="col-sm-8">
                    <?= Select2::widget([
                        'id' => 'keluarga-anggota_keluarga_' . $anggota,
                        'name' => 'Keluarga[anggota_keluarga][' . $anggota . ']',
                        'value' => isset($value_anggota[$anggota]) ? $value_anggota[$anggota] : null,
                        'data' => $list_warga,
                        'language' => 'id',
                        'options' => ['placeholder' => '--PILIH--'],
                        'pluginOptions' => [
                            'allowClear' => true,
                            // 'multiple' => $anggota == 'istri' ? false : true,
                            'multiple' => true,
                        ],
                    ]); ?>
                </div>
            </div>
        <?php endforeach; ?>

        <div class="form-group">
            <div class="col-sm-offset-10">
                <?= Html::button('Save', ['class' => 'btn btn-success', 'id' => 'btn_save']) ?>
            </div>
        </div>
    </div>

</div>

<?php
$this->registerJs(
    '
    getTableAnggota();

    function addTable(tbl_id, kolom, data)
    {
        var row_table_body = "";
        row_table_head = `
            <tr>
                <th></th>
                <th>Hubungan</th>
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
            row_table_body += "<tr><td colspan=3 class=text-center>Tidak Ada Anggota</td></tr>";
        }
        
        $("#" + tbl_id).find("thead").html(row_table_head);
        $("#" + tbl_id).find("tbody").html(row_table_body);
        return true;
    }

    function getTableAnggota()
    {
        var list_anggota = [];
        var nama_anggota = [];

        $(".input-anggota [id^=keluarga-anggota_keluarga_]").each(function() {
            var anggota = $(this).select2("data");
            console.log(anggota.length);
            if (anggota.length > 0) {
                list_anggota.push(anggota);
                nama_anggota.push($("#label_" + $(this).attr("id")).text());
            }
        });

        addTable("tbl_anggota", nama_anggota, list_anggota);
    }

    $("#btn_save").on("click", function() {
        getTableAnggota();
        $("#modal_anggota").modal("hide");
    });

    ',
    \yii\web\View::POS_READY,
    'modal-keluarga-js'
);
?>