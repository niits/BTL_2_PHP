<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Article $article
 */
?>
<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?= $this->Url->build(['controller' => 'Articles', 'action' => 'index']) ?>">Ti tỉ thứ linh tinh</a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a></a></li>
                <li><a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'logout']) ?>"><span class="glyphicon glyphicon-log-out"></span> Đăng xuất</a></li>
            </ul>
        </div>
    </div>
</nav>
<div class="container">
    <div class="row">
        <?= $this->Form->create($article, [
        'class' => 'form articles',
        'action' => 'edit',
        'method' => 'post',
        'enctype' => 'multipart/form-data'
    ]) ?>
        <fieldset>
            <?= $this->Flash->render() ?>
            <legend><?= __('Thêm bài viết') ?></legend>
            <div class="col-sm-12 col-md-4  text-left">
                <div class="form-group">
                    <legend class="control-label">Ảnh đại diện</legend>
                    <div class="input-group">
			            <input type="file" name="fileToUpload" onchange="readURL(this);">
                    </div>
                    <img src=" <?= $this->Url->image($article->avatar_url);?>" id="img" class="preview img-thumbnail" alt="your image" />
                </div>
            </div>
            <div class="col-sm-12 col-md-8 text-left">
                <div class="form-group">
                    <legend class="control-label">Tiêu đề</legend>

                    <?=  $this->Form->textarea('header', ['rows' => '2', 'cols' => '5', 'class' =>'form-control']); ?>
                </div>
                <div class="form-group">
                    <legend class="control-label">Nội dung</legend>
                    <?=  $this->Form->textarea('content', ['rows' => '5', 'cols' => '5', 'class' =>'form-control']); ?>
                </div>
            </div>
        </fieldset>
        <?= $this->Form->button(__('Hoàn thành và lưu lại')) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
