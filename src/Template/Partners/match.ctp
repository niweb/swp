<div class="actions columns medium-5 side-nav">
    <li class="back-button"><?= $this->Html->link(__('back'), $this->request->referer()) ?></li>
    <h3><?= h($partner->user->first_name.' '.$partner->user->last_name) ?></h3>
    <h6 class="subheader"><?= __('Status')?></h6>
    <p><?= $partner->has('status') ? h($partner->status->name) : 'Kein Status'?></p>
    <h6 class="subheader"><?= __('sex') ?></h6>
    <p><?= h($partner->sex) ?></p>
    <h6 class="subheader"><?= __('age') ?></h6>
    <p><?= $this->Number->format($partner->age) ?></p>
    <h6 class="subheader"><?= __('degree_course') ?></h6>
    <p><?= $partner->has('degree_course') ? h($partner->degree_course) : __('no information')?></p>
    <h6 class="subheader"><?= __('job') ?></h6>
    <p><?= $partner->has('job') ? h($partner->job)  : __('no information')?></p>
    <hr>
    <h6 class="subheader"><?= __('teach_time') ?></h6>
    <p><?= $this->Number->format($partner->teach_time) ?></p>
    <h6 class="subheader"><?= __('extra_time') ?></h6>
    <p><?= $this->Number->format($partner->extra_time) ?></p>
    <h6 class="subheader"><?= __('spend_time') ?></h6>
    <p><?= h($partner->spend_time) ?></p>
    <h6 class="subheader"><?= __('experience') ?></h6>
    <p><?= h($partner->experience) ?></p>
    <h6 class="subheader"><?= __('preferred_gender') ?></h6>
    <p><?= $partner->preferred_gender != '' ? h($partner->preferred_gender) : __('no preference')?></p>
    <h6 class="subheader"><?= __('support_wish') ?></h6>
    <p><?= ($partner->has('support_wish') or $partner->support_wish != '') ? h($partner->support_wish) : __('no information')?></p>
    <h6 class="subheader"><?= __('reason_for_decision') ?></h6>
    <p><?= h($partner->reason_for_decision) ?></p>
    <h6 class="subheader"><?= __('additional_information') ?></h6>
    <p><?= $partner->has('additional_information') ? h($partner->additional_informations) : __('no information')?></p>
    <h6 class="subheader"><?= __('reason_for_schuelerpaten') ?></h6>
    <p><?= h($partner->reason_for_schuelerpaten) ?></p>
    <hr>
    <h6 class="subheader"><?= __('street') ?></h6>
    <p><?= h($partner->street) ?></p>
    <h6 class="subheader"><?= __('house_number') ?></h6>
    <p><?= h($partner->house_number) ?></p>
    <h6 class="subheader"><?= __('house_number_addition') ?></h6>
    <p><?= $partner->has('house_number_addition') ? h($partner->house_number_addition) : __('no information')?></p>
    <h6 class="subheader"><?= __('postcode') ?></h6>
    <p><?= h($partner->postcode) ?></p>
    <h6 class="subheader"><?= __('city') ?></h6>
    <p><?= h($partner->city) ?></p>
</div>
<br>
<?php foreach($ranges as $range):
    $noStudents = true;
    $studentNum = 0;
    $studentArray = $students->toArray();
    while($noStudents and ($studentNum < count($studentArray))){
        $studID = $studentArray[$studentNum]['id'];
        $perc = $match_results[$studID]['percentage'];
        if(($perc < $range[1]) AND ($perc >= $range[2])){
            $noStudents = false;
        } else {
            $studentNum++;
        }
    }
    if(!$noStudents):
        ?>
        <div class="partners index large-7 medium-9 columns">
            <h3><?= __($range[0]) ?></h3>
            <table cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('first_name') ?></th>
                    <th><?= $this->Paginator->sort('last_name') ?></th>
                    <th><?= $this->Paginator->sort('student_status_id', __('Status')) ?></th>
                    <th><?= __('gender') ?></th>
                    <th><?= __('Class') ?></th>
                    <th><?= __('Schooltype') ?></th>
                    <th><?= __('Subjects') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
            <?php
            foreach ($students as $student): 
                $perc = $match_results[$student['id']]['percentage'];
                  if (($perc >= $range[2]) and ($perc < $range[1])):
                ?>
                <tr>
                        <td><?= h($student->first_name) ?></td>
                        <td><?= h($student->last_name) ?></td>
                        <td><?= h($student->student_status->name) ?></td>
                        <td class='matchbool <?= $match_results[$student['id']]['gender'] ? 'true' : 'false' ?>'>
                            <span>
                                <table>
                                    <tr>
                                        <th><?=__('preferred_gender_of_partner')?></th>
                                        <th><?=__('gender_of_student')?></th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <?= ($partner->preferred_gender == '') ? __('whatever') : (($partner->preferred_gender == 'm') ? __('male') : __('female')) ?>
                                        </td>
                                        <td>
                                            <?= ($student->gender == 'm') ? __('male') : __('female') ?>
                                        </td>
                                    <tr>
                                </table>
                            </span>
                        </td>
                        <td class='matchbool <?= $match_results[$student['id']]['classrange'] ? 'true' : 'false' ?>'>
                            <span>
                                <table>
                                    <tr>
                                        <th><?=__('preferred_classranges_of_partner')?></th>
                                        <th><?=__('class_of_student')?></th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <?php foreach($partner->preferred_classranges as $clrange){
                                                echo $clrange->classrange->name.'<br>';
                                            }?>
                                        </td>
                                        <td>
                                            <?= $student->student_classrange->classrange->name ?>
                                        </td>
                                    <tr>
                                </table>
                            </span>
                        </td>
                        <td class='matchbool <?= $match_results[$student['id']]['schooltype'] ? 'true' : 'false' ?>'>
                            <span>
                                <table>
                                    <tr>
                                        <th><?=__('preferred_schooltypes_of_partner')?></th>
                                        <th><?=__('schooltype_of_student')?></th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <?php foreach($partner->preferred_schooltypes as $type){
                                                echo $type->schooltype->name.'<br>';
                                            }?>
                                        </td>
                                        <td>
                                            <?= $student->schooltype->name ?>
                                        </td>
                                    <tr>
                                </table>
                            </span>
                        </td>
                        <td class='matchbool <?= $match_results[$student['id']]['subjects'] ? 'true' : 'false' ?>'>
                            <span>
                                <table>
                                    <tr>
                                        <th><?=__('preferred_subjects_of_partner')?></th>
                                        <th><?=__('subjects_of_student')?></th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <?php foreach($partner->preferred_subjects as $subj){
                                                echo $subj->subject->name.'<br>';
                                            }?>
                                        </td>
                                        <td>
                                            <?=$subject_list[$student->student_subject->subject1]?><br>
                                            <?=$subject_list[$student->student_subject->subject2]?><br>
                                            <?=$subject_list[$student->student_subject->subject3]?>
                                        </td>
                                    <tr>
                                </table>
                            </span>
                        </td>
                        <td class="actions">
                            <?= $this->Html->link(__('Match'), ['action' => 'match', $partner->id, $student->id], ['confirm' => __('Are you sure you want to match {0} with {1}?', $student->first_name, $partner->user->first_name)])?>
                            <?= $this->Html->link(__('View'), ['controller' => 'Students', 'action' => 'view', $student->id]) ?>
                        </td>
                    </tr>
                <?php
                endif;
            endforeach;
            ?>
            </tbody>
            </table>
            <div class="paginator">
                <ul class="pagination">
                    <?= $this->Paginator->prev('< ' . __('previous')) ?>
                    <?= $this->Paginator->numbers() ?>
                    <?= $this->Paginator->next(__('next') . ' >') ?>
                </ul>
                <p><?= $this->Paginator->counter() ?></p>
            </div>
        </div>
        <?php
    endif;
endforeach; ?>
