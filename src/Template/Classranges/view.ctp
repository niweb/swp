<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Classrange'), ['action' => 'edit', $classrange->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Classrange'), ['action' => 'delete', $classrange->id], ['confirm' => __('Are you sure you want to delete # {0}?', $classrange->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Classranges'), ['action' => 'index']) ?> </li>
    </ul>
</div>
<div class="classranges view large-10 medium-9 columns">
    <h2><?= h($classrange->name) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Name') ?></h6>
            <p><?= h($classrange->name) ?></p>
        </div>
    </div>
</div>
