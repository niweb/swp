<h1>Passwort zurücksetzen</h1>
<?= $this->Form->create() ?>
<?= $this->Form->input('email', ['label' => 'E-Mail']) ?>
<?= $this->Form->button('Submit') ?>
<?= $this->Form->button(__('Cancel'), ['type' => 'cancel', 'onclick' => 'window.history.go(-1)']) ?>
<?= $this->Form->end() ?>