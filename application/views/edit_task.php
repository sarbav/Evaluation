<div style="width: 30%;">
<?php echo form_open('task_ctrl/edit'); ?>
<h2>Add Your Tasks</h2>
<?php
echo form_label('Task Name');
echo form_error('tname');
echo form_input(array('id'=>'tname', 'name'=>'tname','value'=>$result->task_name));
echo '<br>';
echo form_label('Task Priority');
$option = array('-1'=>'Select','1'=>'Low','2'=>'Medium','3'=>'High');
echo form_error('prior');
echo form_dropdown(array('id'=>'prior','name'=>'prior'),$option,$result->prior);
echo '<br>';
?>
<input type="hidden" value="<?php echo $result->task_id; ?>" name="tid">
<?php
//echo form_hidden(array('id' =>'tid', 'name'=>'tid', 'value' => "$result->task_id"));
echo form_submit(array('id' => 'submit', 'value' => 'Update'));
echo form_close();
?>
</div>
