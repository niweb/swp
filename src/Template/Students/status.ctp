<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li class="back-button"><?= $this->Html->link(__('back'), $this->request->referer()) ?></li>
        <?php if(isset($vermittler) or isset($locationAdmin) or isset($admin)) : ?>
            <li><?= $this->Html->link(__('List waiting Students'), ['controller' => 'Students', 'action' => 'index', 'waiting']) ?></li>
            <li><?= $this->Html->link(__('List active Students'), ['controller' => 'Students', 'action' => 'index', 'active']) ?></li>
            <li><?= $this->Html->link(__('List inactive Students'), ['controller' => 'Students', 'action' => 'index', 'inactive']) ?></li>
        <?php endif; ?>
    </ul>
</div> 
<div class="partners form large-10 medium-9 columns">
    <?= $this->Form->create($student); ?>
    <fieldset>
        <legend><?= __('Status') ?></legend>
        <h2><?= h($student->first_name) ?>
        <?= h($student->last_name) ?></h2>
        <?php
            echo $this->Form->input('student_status_id', ['label' => __('Status'), 'options' => $status, 'empty' => false]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>