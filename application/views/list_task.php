<div>
    <h2>Task List</h2>
    <div style="padding-left: 20%;">Task:
<?php
    $option = array('1'=>'All Task','2'=>'Completed','3'=>'Deleted');
    
    $url = $_SERVER['REQUEST_URI'];
    if (strpos($_SERVER['REQUEST_URI'],'list_completed') !== false) {
        $list = 'Completed';
    }
    elseif (strpos($_SERVER['REQUEST_URI'],'list_deleted') !== false) {
        $list = 'Deleted';
    } else {
        $list = 'All';
    }
?>
        <select id="select_task" style="width: 20%;">
            <?php
            foreach ($option as $val)
            {
                if($list == $val)
                    echo "<option value='$val' selected>$val</option>";
                else
                    echo "<option value='$val'>$val</option>";
            }
            ?>
        </select>
    </div>
    <table style="width:70%;">
        <tr><th>S.No</th><th>Tasks</th><th>Priorities</th><th colspan="3">Options</th></tr>
        <?php
        $i = 1;
        foreach ($result as $val) {
            ?>
            <tr id="row<?=$val->task_id?>"><td><?=$i++?></td>
                <td><?=$val->task_name?></td>
                <td><?=$val->priority?></td>
                <td>
                    <?php if($val->task_status != 1){?>
                    <a style="cursor:pointer;" title="Mark as Completed" onclick="mark_complete(<?=$val->task_id?>)"><img src="<?php echo $this->config->base_url(); ?>images/tick.png"></a>
                    <?php } ?>
                </td>
                <td>
                    <a title="Edit" class="button2" href='<?php echo $this->config->base_url(); ?>index.php/task_ctrl/edit/<?=$val->task_id?>/'>Edit</a>
                </td>
                <td
                    <?php if($val->status != 0){?>
                    <a title="Delete" class="button1" onclick="delete_row(<?=$val->task_id?>)">X</a></td>
                    <?php } ?>
           </tr>
        <?php } ?>
    </table>
</div>
<script type="text/javascript">
    $("#select_task").change(function (){
        stext = $("#select_task option:selected").text();
        console.log(stext);
        if(stext == 'Completed')
            window.location.href='<?php echo $this->config->base_url(); ?>index.php/task_ctrl/list_completed/';
        if(stext == 'Deleted')
            window.location.href='<?php echo $this->config->base_url(); ?>index.php/task_ctrl/list_deleted/';
        if(stext == 'All Task')
            window.location.href='<?php echo $this->config->base_url(); ?>index.php/task_ctrl/list_task/';
    })
    function delete_row(id)
    {
        if(confirm("Are you sure want to Delete?"))
        $.ajax({
            method: "POST",
            url: "<?php echo $this->config->base_url(); ?>index.php/ajax_ctrl/delete_row",
            data: { id: id },
            success: function(result) {
                alert('Task Deleted!');
                $("#row"+id).hide('slow');
            }
        });
    }
    
    function mark_complete(id)
    {
        if(confirm("Are you sure want to Mark this as Completed?"))
        $.ajax({
            method: "POST",
            url: "<?php echo $this->config->base_url(); ?>index.php/ajax_ctrl/mark_complete",
            data: { id: id },
            success: function(result) {
                alert('Task Marked as Completed!');
                $("#row"+id).hide('slow');
            }
        });
    }
</script>