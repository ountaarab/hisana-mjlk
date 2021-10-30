<option>--Pilih--</option>
<?php
if ($data->num_rows() > 0) :
    foreach ($data->result() as $baris) :
?>
        <option value="<?= $baris->id ?>"><?= $baris->nama ?></option>
<?php
    endforeach;
endif;
?>