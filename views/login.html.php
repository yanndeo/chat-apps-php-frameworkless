<?php

use app\core\form\Form;
use app\models\User;

/** @var $model User */
?>

<h1>LOGIN</h1>
<?php //\app\core\Helper::dump($user) ;?>
<div class="row col-md-6" style="margin-top: 50px;">
    <?php $form = Form::opening("", 'post') ?>

    <?php echo $form->field($model, 'email'); ?>
    <?php echo $form->field($model, 'password')->passwordTypeField() ; ?>

    <div class="form-group" style="margin-top: 14px;">
        <button type="submit" class="btn btn-block btn-primary">Submit</button>
    </div>
    <?php Form::closing() ?>
</div>



