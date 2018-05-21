<?php
use  yii\helpers\Html;
use   yii\helpers\Url;
use yii\bootstrap\ActiveForm;
$this->title="租友论坛";
?>
<div class="container" style="margin-top: 100px">
    <div class="row clearfix">
        <div class="col-md-12">
            <a id="modal-334462" href="#modal-container-334462" role="button" class="btn btn-primary" data-toggle="modal">我要发布</a>
            <?php
            foreach (Yii::$app->session->getAllFlashes() as $key=>$message){
                echo '<div style="margin-top:50px" class="alert alert-' . $key . '">' . $message . "</div>\n";
            }
            ?>
        </div>
        <div class="col-md-12 column">
            <?php foreach ($data as $row){?>
                <div class="col-md-12" style="border: 1px solid #e4e6eb;margin-top: 20px">
                    <div class="col-md-1" style="margin-top: 20px;font-size: 20px;">
                          <span style="color: deepskyblue" class="glyphicon glyphicon-comment"><?=$row['forum_people_counts']?></span>
                          <?php if($row['forum_star']==1){?>
                              <span style="color: red" class="glyphicon glyphicon-star"></span>
                          <?php }?>
                    </div>
                    <div class="col-md-2">
                        <img style="height: 80px;width: 80px" src="<?=$row['user_picture']?>" class="img-circle">
                        <?=$row['username']?>
                    </div>
                    <div class="col-md-2"></div>
                    <div class="col-md-5" style="margin-top: 30px;">
                        <a href="<?=Url::to(['rentforum/detail','forum_id'=>$row['forum_id']])?>" ><?=$row['forum_name']?></a>
                    </div>
                    <div class="col-md-2" style="margin-top: 30px;">
                        <?=date('Y-m-d H:i',$row['updated_at'])?>
                    </div>
                </div>
            <?php }?>
        </div>
    </div>
</div>
<div class="container">
    <div class="row clearfix">
        <div class="col-md-4 column">
        </div>
        <div class="col-md-4 column">
            <div class="modal fade" id="modal-container-334462" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title" id="myModalLabel">
                                发布论坛
                            </h4>

                        </div>
                        <div class="modal-body">
                            <?php
                            if(!Yii::$app->user->isGuest){
                                $form = ActiveForm::begin(['id' => 'searchform','action'=> yii\helpers\Url::to(['rentforum/addforum']), 'method' => "post", 'options' => ['style' => 'margin-bottom:5px;']]); ?>
                                <div>
                                    <input type="text" name="forum_name" class="form-control" placeholder="请输入论坛名">
                                </div>

                                <div style="margin-top: 20px;margin-bottom: 20px">
                                    <input type="textarea" name="forum_content" class="form-control" placeholder="请输入论坛详细信息">
                                </div>

                                <div class="form-group">
                                    <?= Html::submitButton('提交', ['class' => 'btn btn-primary']) ?>
                                </div>
                                <?php

                                ActiveForm::end();}
                            else{   ?>
                                <span style="font-size: 20px" class="label label-warning">请点击右侧登录按钮</span>
                                <span class="glyphicon glyphicon-hand-right"></span>
                                <a href="<?=\yii\helpers\Url::to(['site/login'])?>"><span style="font-size: 20px" class="label label-primary">登陆</span></a>
                            <?php   }

                            ?>

                        </div>
                    </div>

                </div>

            </div>

        </div>
        <div class="col-md-4 column">

        </div>
    </div>
</div>

