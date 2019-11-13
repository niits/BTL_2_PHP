<!-- File: src/Template/Users/login.ctp -->
<div class="users">
    <?= $this->Form->create('User', array(
        'class' => 'form'
        )) ?>
    <fieldset>
        <legend><?= __('Đăng nhập') ?></legend>
        <div class="form-group">
            <?= $this->Form->control('username', [
                'label' => false,
                'class' => 'form-control',
                'placeholder' => 'Tên đăng nhập'
                ]) ?>
        </div>
        <div class="form-group">
            <?= $this->Form->control('password', [
                'label' => false,
                'class' => 'form-control',
                'placeholder' => 'Mật khẩu'
                ]) ?>
        </div>
        <?= $this->Flash->render() ?>
    </fieldset>
    <div class="form-group">
        <?= $this->Form->button(__('Đăng nhập')); ?>
    </div>
    <div class="form-group">
        <a href="users/add" class="btn btn-link">Tạo tài khoản mới</button>
    </div>
    <?= $this->Form->end() ?>
</div>
