<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Location'), ['action' => 'edit', $location->location_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Location'), ['action' => 'delete', $location->location_id], ['confirm' => __('Are you sure you want to delete # {0}?', $location->location_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Locations'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Location'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Partners'), ['controller' => 'Partners', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Partner'), ['controller' => 'Partners', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Schooltypes'), ['controller' => 'Schooltypes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Schooltype'), ['controller' => 'Schooltypes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Students'), ['controller' => 'Students', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Student'), ['controller' => 'Students', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Subjects'), ['controller' => 'Subjects', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Subject'), ['controller' => 'Subjects', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="locations view large-10 medium-9 columns">
    <h2><?= h($location->name) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Name') ?></h6>
            <p><?= h($location->name) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($location->id) ?></p>
        </div>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Partners') ?></h4>
    <?php if (!empty($location->partners)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Name') ?></th>
            <th><?= __('Lastname') ?></th>
            <th><?= __('Age') ?></th>
            <th><?= __('Sex') ?></th>
            <th><?= __('Degree Course') ?></th>
            <th><?= __('Job') ?></th>
            <th><?= __('Street') ?></th>
            <th><?= __('House Number') ?></th>
            <th><?= __('House Number Addition') ?></th>
            <th><?= __('Postcode') ?></th>
            <th><?= __('City') ?></th>
            <th><?= __('Telephone') ?></th>
            <th><?= __('Mobile') ?></th>
            <th><?= __('Teach Time') ?></th>
            <th><?= __('Extra Time') ?></th>
            <th><?= __('Spend Time') ?></th>
            <th><?= __('Experience') ?></th>
            <th><?= __('Preferred Gender') ?></th>
            <th><?= __('Support Wish') ?></th>
            <th><?= __('Reason For Decision') ?></th>
            <th><?= __('Additional Informations') ?></th>
            <th><?= __('Reason For Schuelerpaten') ?></th>
            <th><?= __('Location Id') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($location->partners as $partners): ?>
        <tr>
            <td><?= h($partners->id) ?></td>
            <td><?= h($partners->name) ?></td>
            <td><?= h($partners->lastname) ?></td>
            <td><?= h($partners->age) ?></td>
            <td><?= h($partners->sex) ?></td>
            <td><?= h($partners->degree_course) ?></td>
            <td><?= h($partners->job) ?></td>
            <td><?= h($partners->street) ?></td>
            <td><?= h($partners->house_number) ?></td>
            <td><?= h($partners->house_number_addition) ?></td>
            <td><?= h($partners->postcode) ?></td>
            <td><?= h($partners->city) ?></td>
            <td><?= h($partners->telephone) ?></td>
            <td><?= h($partners->mobile) ?></td>
            <td><?= h($partners->teach_time) ?></td>
            <td><?= h($partners->extra_time) ?></td>
            <td><?= h($partners->spend_time) ?></td>
            <td><?= h($partners->experience) ?></td>
            <td><?= h($partners->preferred_gender) ?></td>
            <td><?= h($partners->support_wish) ?></td>
            <td><?= h($partners->reason_for_decision) ?></td>
            <td><?= h($partners->additional_informations) ?></td>
            <td><?= h($partners->reason_for_schuelerpaten) ?></td>
            <td><?= h($partners->location_id) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Partners', 'action' => 'view', $partners->partner_id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'Partners', 'action' => 'edit', $partners->partner_id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Partners', 'action' => 'delete', $partners->partner_id], ['confirm' => __('Are you sure you want to delete # {0}?', $partners->partner_id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Schooltypes') ?></h4>
    <?php if (!empty($location->schooltypes)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Name') ?></th>
            <th><?= __('Maximum Class') ?></th>
            <th><?= __('Minimum Class') ?></th>
            <th><?= __('Location Id') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($location->schooltypes as $schooltypes): ?>
        <tr>
            <td><?= h($schooltypes->id) ?></td>
            <td><?= h($schooltypes->name) ?></td>
            <td><?= h($schooltypes->maximum_class) ?></td>
            <td><?= h($schooltypes->minimum_class) ?></td>
            <td><?= h($schooltypes->location_id) ?></td>

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
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Students') ?></h4>
    <?php if (!empty($location->students)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Name') ?></th>
            <th><?= __('Lastname') ?></th>
            <th><?= __('Telephone') ?></th>
            <th><?= __('Mobile') ?></th>
            <th><?= __('Location Id') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($location->students as $students): ?>
        <tr>
            <td><?= h($students->id) ?></td>
            <td><?= h($students->name) ?></td>
            <td><?= h($students->lastname) ?></td>
            <td><?= h($students->telephone) ?></td>
            <td><?= h($students->mobile) ?></td>
            <td><?= h($students->location_id) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Students', 'action' => 'view', $students->student_id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'Students', 'action' => 'edit', $students->student_id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Students', 'action' => 'delete', $students->student_id], ['confirm' => __('Are you sure you want to delete # {0}?', $students->student_id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Subjects') ?></h4>
    <?php if (!empty($location->subjects)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Name') ?></th>
            <th><?= __('Location Id') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($location->subjects as $subjects): ?>
        <tr>
            <td><?= h($subjects->id) ?></td>
            <td><?= h($subjects->name) ?></td>
            <td><?= h($subjects->location_id) ?></td>

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
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Users') ?></h4>
    <?php if (!empty($location->users)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Email') ?></th>
            <th><?= __('Password') ?></th>
            <th><?= __('Created') ?></th>
            <th><?= __('Type Id') ?></th>
            <th><?= __('Location Id') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($location->users as $users): ?>
        <tr>
            <td><?= h($users->id) ?></td>
            <td><?= h($users->email) ?></td>
            <td><?= h($users->password) ?></td>
            <td><?= h($users->created) ?></td>
            <td><?= h($users->type_id) ?></td>
            <td><?= h($users->location_id) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Users', 'action' => 'view', $users->user_id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'Users', 'action' => 'edit', $users->user_id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Users', 'action' => 'delete', $users->user_id], ['confirm' => __('Are you sure you want to delete # {0}?', $users->user_id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
