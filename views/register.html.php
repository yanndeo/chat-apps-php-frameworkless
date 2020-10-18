<?php

use app\core\form\Form;
?>

<h1>Create an account</h1>
<?php //\app\core\Helper::dump($user) ;?>
<div class="row col-md-6" style="margin-top: 50px;">
    <?php $form = Form::opening("", 'post') ?>
    <div class="row">     
        <div class="col-md-6">
            <?php echo $form->field($user, 'firstname'); ?>
        </div>
        <div class="col-md-6">
            <?php echo $form->field($user, 'lastname'); ?>
        </div>
    </div>
    <?php echo $form->field($user, 'email'); ?>
    <?php echo $form->field($user, 'password')->passwordTypeField() ; ?>
    <?php echo $form->field($user, 'confirm_password')->passwordTypeField(); ?>

    <div class="form-group" style="margin-top: 14px;">
        <button type="submit" class="btn btn-block btn-primary">Submit</button>
    </div>
    <?php Form::closing() ?>
</div>




<div class="row">
    <div class="col-lg-8 d-flex ">
        <!-- <form method="POST" action="">
            <div class="row">
                <div class="col-md-6 form-group <?php //echo $user->hasError('firstname') ? 'has-error' : ''; ?>">
                    <label for="firstname">FirstName</label>
                    <input 
                        type="text" 
                        value="<?php //echo $user->firstname ?>"
                        name="firstname" 
                        class="form-control" 
                        placeholder="firstname">
                    <span class="has-error" > <?php// echo $user->getFirstError('firstname'); ?> </span>
                </div>

                <div class=" col-md-6 form-group">
                    <label for="lastname">Lastname</label>
                    <input type="text" name="lastname" class="form-control" placeholder="lastname">
                </div>

            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="Enter email">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="password">
            </div>

            <div class="form-group">
                <label for="confirm_password">Confirm Password </label>
                <input type="password" name="confirm_password" class="form-control" id="confirm_password" placeholder="confirm password">
            </div>
        </form> -->
    </div>
</div>