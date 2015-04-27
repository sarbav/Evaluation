<div style="width: 30%;">
<?php echo form_open('task_ctrl'); ?>
<h2>Add Your Tasks</h2>
<?php
echo form_label('Task Name');
echo form_error('tname');
echo form_input(array('id'=>'tname', 'name'=>'tname'));
echo '<br>';
echo form_label('Task Priority');
$option = array('-1'=>'Select','1'=>'Low','2'=>'medium','3'=>'high');
echo form_error('prior');
echo form_dropdown(array('id'=>'prior','name'=>'prior'),$option,'0');
echo '<br>';
echo form_submit(array('id' => 'submit', 'value' => 'Submit'));
echo form_close();
?>
</div>
