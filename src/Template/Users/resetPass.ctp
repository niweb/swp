<h1>Passwort zurücksetzen</h1>
<?= $this->Form->create() ?>
<?= $this->Form->input('password', ['label' =>__('password')]) ?>
<?= $this->Form->button('Submit') ?>
<?= $this->Form->end() ?>