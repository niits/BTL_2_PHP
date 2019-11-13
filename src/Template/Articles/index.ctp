<?php
/**
 * @var \App\View\AppView $this
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
        <?= $this->Form->create('Article', [
        'class' => 'form articles',
        'action' => 'add',
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
                    <img src="<?= $this->Url->image('/img/preview.jpg');?>" id="img" class="preview img-thumbnail" src="#" alt="your image" />
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
        <?= $this->Form->button(__('Submit')) ?>
        <?= $this->Form->end() ?>
    </div>

    <?php
    foreach ($articles as $article) : ?>
        <div class="row">
            <div class="media">
                <div class="col-sm-12 col-md-4">
                    <div class="media-left">
                        <img src="<?= $this->Url->image($article->avatar_url);?>" class="media-object" />
                    </div>
                </div>
                <div class="col-sm-12 col-md-8">
                    <div class="media-body">
                        <h2 class="media-heading"><?= str_replace("\'", "'", $article->header) ?></h2>
                        <div class="col-sm-6 text-left">
                            <h5> Ngày tạo: <?= $article->created ?> </h5>
                        </div>
                        <div class="col-sm-6 text-right">
                            <h5> Sửa đổi lần cuối: <?= $article->modified ?></h5>
                        </div>
                        <div class="col-sm-12 text-left">
                            <h5> Người tạo: <?= $article->user->username ?> </h5>
                        </div>
                        <p><?= str_replace('\r\n', '<br>', $article->content) ?></p>
                    </div>
                    <?php
                        if($this->Session->read('Auth.User.id')==$article->author_id) :
                    ?>
                    <div class="col-sm-6 text-left a">
                    <?= $this->Form->postLink(
                            __('Sửa bài'),
                            ['action' => 'edit', $article->id]
                            ) ?>
                    </div>
                    <div class="col-sm-6 text-right a">
                        <?= $this->Form->postLink(
                            __('Xóa bài'),
                            ['action' => 'delete', $article->id],
                            ['confirm' => __('Bạn có chắc muốn xóa bài viết này không?')]
                            ) ?>
                    </div>
                    <?php endif ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
