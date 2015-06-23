<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <?php if(isset($locationAdmin) or isset($admin)): ?>
            <li><?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id]) ?> </li>
            <li><?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?> </li>
            <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?> </li>
        <?php else: ?>
            <li> <?=__('No Actions')?></li>
        <?php endif; ?>
    </ul>
</div>
<div class="users view large-10 medium-9 columns">
    <h2><?= h($user->first_name .' '. $user->last_name) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('First Name') ?></h6>
            <p><?= h($user->first_name) ?></p>
            <h6 class="subheader"><?= __('Last Name') ?></h6>
            <p><?= h($user->last_name) ?></p>
            <h6 class="subheader"><?= __('Email') ?></h6>
            <p><?= h($user->email) ?></p>
            <h6 class="subheader"><?= __('Type') ?></h6>
            <p><?= h($user->type->name) ?></p>
            <!--p><!?= h($type->name) ?></p-->
            <?php if(isset($admin)): ?>
            <h6 class="subheader"><?= __('Location') ?></h6>
            <p><?= h($user->location->name) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($user->id) ?></p>
        </div>
            <?php endif; ?>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Created') ?></h6>
            <p><?= h($user->created) ?></p>
        </div>
    </div>
</div>
