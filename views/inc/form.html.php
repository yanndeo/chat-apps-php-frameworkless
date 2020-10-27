<?php
    use app\core\form\Form;
?>


<div class="chat-box bg-white">

    <?php $form = Form::opening("", 'post') ?>

    <?php echo $form->field($model, 'content'); ?>

    <span class="input-group-btn">
        <button type="submit" class="btn btn-block btn-primary" id="format-chat-btn">SEND</button>
    </span>
    <?php Form::closing() ?>
</div>