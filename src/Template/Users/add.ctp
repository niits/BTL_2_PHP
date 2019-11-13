<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="users">
    <?= $this->Form->create($user, [
        'class' => 'form'
    ]) ?>
    <fieldset>
        <?= $this->Flash->render() ?>
        <div class="form-group">
        <legend><?= __('Tạo tài khoản mới') ?></legend>
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
        <div class="form-group">
            <?= $this->Form->control('re-password', [
                 'label' => false,
                 'class' => 'form-control',
                 'placeholder' => 'Nhập lại mật khẩu'
            ]) ?>
        </div>
    </fieldset>
    <?= $this->Form->button(__('Tạo tài khoản')) ?>
    <div class="form-group">
        <a href="/users/login" class="btn btn-link">Đã có tài khoản. ?</button>
    </div>
    <?= $this->Form->end() ?>
</div>
