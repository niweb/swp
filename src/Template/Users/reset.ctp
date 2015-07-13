<?php $this->assign('title', __('Reset Password')); ?>
<br>
<h3><?= h(__('Reset Password')) ?></h3>
<?= $this->Form->create() ?>
<?= $this->Form->input('email', ['label' => 'E-Mail']) ?>
<?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->button(__('Cancel'), ['type' => 'cancel', 'onclick' => 'window.history.go(-1)']) ?>
<?= $this->Form->end() ?>