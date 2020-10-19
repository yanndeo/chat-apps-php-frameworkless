<?php
/** @var $model Message */
/** @var $users User */


use app\core\form\Form;
use app\models\Message;
use app\models\User;


$images = array("user_6", "user_2", "user_3", "user_5", "user_1");

?>
<div class="row">
    <div class="col-md-4 bg-white ">
        <div class=" row border-bottom padding-sm" style="height: 40px; padding: 10px">
            <?php echo count($users) -1 ; ?> Member(s) online
        </div>

        <!-- =============================================================== -->
        <!-- member list -->
        <ul class="friend-list">

            <?php  foreach ($users as $user ): ?>
            <?php if(\app\core\Helper::getUser()->id !== $user->id): ?>
                <li>
                    <a href="#" class="clearfix">
                        <img src="https://bootdey.com/img/Content/<?php echo $user->profile ?>.jpg" alt="" class="img-circle">
                        <div class="friend-name">
                            <strong><?php echo ucfirst($user->firstname. ' '.$user->lastname) ; ?> </strong>
                        </div>
                        <div class="last-message text-muted">Lorem ipsum dolor sit amet.</div>
                        <small class="time text-muted " id="status_icon"></small>
                    </a>
                </li>
                <?php endif ; ?>
            <?php endforeach; ?>

        </ul>
    </div>

    <!--=========================================================-->
    <!-- selected chat -->
    <div class="col-md-8 bg-white ">
        <div class="chat-message">
            <ul class="chat">
                <li class="left clearfix">
                    	<span class="chat-img pull-left">
                    		<img src="https://bootdey.com/img/Content/user_3.jpg" alt="User Avatar">
                    	</span>
                    <div class="chat-body clearfix">
                        <div class="header">
                            <strong class="primary-font">John Doe</strong>
                            <small class="pull-right text-muted"><i class="fa fa-clock-o"></i> 12 mins ago</small>
                        </div>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        </p>
                    </div>
                </li>
                <li class="right clearfix">
                    	<span class="chat-img pull-right">
                    		<img src="https://bootdey.com/img/Content/user_1.jpg" alt="User Avatar">
                    	</span>
                    <div class="chat-body clearfix">
                        <div class="header">
                            <strong class="primary-font">Sarah</strong>
                            <small class="pull-right text-muted"><i class="fa fa-clock-o"></i> 13 mins ago</small>
                        </div>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales at.
                        </p>
                    </div>
                </li>
                <li class="left clearfix">
                        <span class="chat-img pull-left">
                    		<img src="https://bootdey.com/img/Content/user_3.jpg" alt="User Avatar">
                    	</span>
                    <div class="chat-body clearfix">
                        <div class="header">
                            <strong class="primary-font">John Doe</strong>
                            <small class="pull-right text-muted"><i class="fa fa-clock-o"></i> 12 mins ago</small>
                        </div>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        </p>
                    </div>
                </li>
                <li class="right clearfix">
                        <span class="chat-img pull-right">
                    		<img src="https://bootdey.com/img/Content/user_1.jpg" alt="User Avatar">
                    	</span>
                    <div class="chat-body clearfix">
                        <div class="header">
                            <strong class="primary-font">Sarah</strong>
                            <small class="pull-right text-muted"><i class="fa fa-clock-o"></i> 13 mins ago</small>
                        </div>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales at.
                        </p>
                    </div>
                </li>
                <li class="left clearfix">
                        <span class="chat-img pull-left">
                    		<img src="https://bootdey.com/img/Content/user_3.jpg" alt="User Avatar">
                    	</span>
                    <div class="chat-body clearfix">
                        <div class="header">
                            <strong class="primary-font">John Doe</strong>
                            <small class="pull-right text-muted"><i class="fa fa-clock-o"></i> 12 mins ago</small>
                        </div>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        </p>
                    </div>
                </li>
                <li class="right clearfix">
                        <span class="chat-img pull-right">
                    		<img src="https://bootdey.com/img/Content/user_1.jpg" alt="User Avatar">
                    	</span>
                    <div class="chat-body clearfix">
                        <div class="header">
                            <strong class="primary-font">Sarah</strong>
                            <small class="pull-right text-muted"><i class="fa fa-clock-o"></i> 13 mins ago</small>
                        </div>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales at.
                        </p>
                    </div>
                </li>
                <li class="right clearfix">
                        <span class="chat-img pull-right">
                    		<img src="https://bootdey.com/img/Content/user_1.jpg" alt="User Avatar">
                    	</span>
                    <div class="chat-body clearfix">
                        <div class="header">
                            <strong class="primary-font">Sarah</strong>
                            <small class="pull-right text-muted"><i class="fa fa-clock-o"></i> 13 mins ago</small>
                        </div>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales at.
                        </p>
                    </div>
                </li>
            </ul>
        </div>


        <div class="chat-box bg-white">

        <?php $form = Form::opening("", 'post') ?>

            <?php echo $form->field($model, 'content'); ?>

            <span class="input-group-btn">
                <button type="submit" class="btn btn-block btn-primary">Submit</button>
            </span>
            <?php Form::closing() ?>
        </div>


        <!--<div class="chat-box bg-white">
            <div class="input-group">
                <input class="form-control border no-shadow no-rounded" placeholder="Type your message here">
                <span class="input-group-btn">
            			<button class="btn btn-success no-rounded" type="button">Send</button>
            		</span>
            </div><!-- /input-group -->
        </div>-->
    </div>
</div>