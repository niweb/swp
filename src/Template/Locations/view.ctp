<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Location'), ['action' => 'edit', $location->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Location'), ['action' => 'delete', $location->id], ['confirm' => __('Are you sure you want to delete # {0}?', $location->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Locations'), ['action' => 'index']) ?> </li>
    </ul>
</div>
<div class="locations view large-10 medium-9 columns">
    <h2><?= h($location->name) ?></h2>
</div>
<!----------------------------------
<div class="related row">
    <div class="column large-7">
    <?php if (!empty($location->partners)): ?>
    <h4 class="subheader"><?= __('Related Partners') ?></h4>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('first_name') ?></th>
            <th><?= __('last_name') ?></th>
            <th><?= __('Age') ?></th>
            <th><?= __('Sex') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($location->partners as $partners): ?>
        <tr>
            <td><?= h($partners->user->first_name) ?></td>
            <td><?= h($partners->user->last_name) ?></td>
            <td><?= h($partners->age) ?></td>
            <td><?= h($partners->sex) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Partners', 'action' => 'view', $partners->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'Partners', 'action' => 'edit', $partners->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Partners', 'action' => 'delete', $partners->id], ['confirm' => __('Are you sure you want to delete # {0}?', $partners->id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
------------------------------------------------->
<div class="related row">
    <div class="column large-7">
    <?php if (!empty($location->subjects)): ?>
    <h4 class="subheader"><?= __('Related Subjects') ?></h4>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Name') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($location->subjects as $subjects): ?>
        <tr>
            <td><?= h($subjects->name) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Subjects', 'action' => 'view', $subjects->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'Subjects', 'action' => 'edit', $subjects->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Subjects', 'action' => 'delete', $subjects->id], ['confirm' => __('Are you sure you want to delete # {0}?', $subjects->id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
    
    <div class="column large-7">
    <?php if (!empty($location->schooltypes)): ?>
    <h4 class="subheader"><?= __('Related Schooltypes') ?></h4>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Name') ?></th>
            <th><?= __('max_grade') ?></th>
            <th><?= __('min_grade') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($location->schooltypes as $schooltypes): ?>
        <tr>
            <td><?= h($schooltypes->name) ?></td>
            <td><?= h($schooltypes->maximum_class) ?></td>
            <td><?= h($schooltypes->minimum_class) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Schooltypes', 'action' => 'view', $schooltypes->id]) ?>
                <?= $this->Html->link(__('Edit'), ['controller' => 'Schooltypes', 'action' => 'edit', $schooltypes->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Schooltypes', 'action' => 'delete', $schooltypes->id], ['confirm' => __('Are you sure you want to delete # {0}?', $schooltypes->id)]) ?>
            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
    
    <div class="column large-7">
    <?php if (!empty($location->students)): ?>
    <h4 class="subheader"><?= __('Related Students') ?></h4>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('first_name') ?></th>
            <th><?= __('last_name') ?></th>
            <th><?= __('Telephone') ?></th>
            <th><?= __('Mobile') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($location->students as $students): ?>
        <tr>
            <td><?= h($students->first_name) ?></td>
            <td><?= h($students->last_name) ?></td>
            <td><?= h($students->telephone) ?></td>
            <td><?= h($students->mobile) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Students', 'action' => 'view', $students->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'Students', 'action' => 'edit', $students->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Students', 'action' => 'delete', $students->id], ['confirm' => __('Are you sure you want to delete # {0}?', $students->id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
    
    <div class="column large-7">
    <?php if (!empty($location->users)): ?>
    <h4 class="subheader"><?= __('Related Users') ?></h4>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('first_name') ?></th>
            <th><?= __('last_name') ?></th>
            <th><?= __('Email') ?></th>
            <th><?= __('Created') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($location->users as $users): ?>
        <tr>
            <td><?= h($users->first_name) ?></td>
            <td><?= h($users->last_name) ?></td>
            <td><?= h($users->email) ?></td>
            <td><?= h($users->created) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Users', 'action' => 'view', $users->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'Users', 'action' => 'edit', $users->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Users', 'action' => 'delete', $users->id], ['confirm' => __('Are you sure you want to delete # {0}?', $users->id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
