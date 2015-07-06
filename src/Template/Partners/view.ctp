<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <!-- alle dürfen zurück --->
        <li class="back-button"><?= $this->Html->link(__('back'), $this->request->referer()) ?></li>
        
        <!-- alle außer pate dürfen vermittlen --->    
        <?php if (!(isset($authPartner)) AND ($partner->status_id == 5)): ?>
            <li><?= $this->Html->link(__('Match Partner'), ['action' => 'match', $partner->id]) ?> </li>    
        <?php endif; ?>
        
        <?php if(isset($vermittler) or isset($locationAdmin) or isset($admin)) : ?>
        <!--- matchmaker darf nicht bearbeiten -->
            <li><?= $this->Html->link(__('Edit Partner'), ['action' => 'edit', $partner->id]) ?> </li>    
            <?php if($partner->status_id < 7) : ?>
            <!-- falls aufgehört oder abgelehnt reaktivieren, sonst deaktivieren --->
                <li><?= $this->Form->postLink(__('Deactivate'), ['action' => 'deactivate', $partner->id], ['confirm' => __('Are you sure you want to deactivate {0}?', h($partner->user->first_name.' '.$partner->user->last_name))]) ?></li>
            <?php else : ?>
                <?php if(isset($locationAdmin) or isset($admin)) : ?>
                    <!--nur standort admin und global admin dürfen reaktivieren und löschen-->
                <li><?= $this->Form->postLink(__('Reactivate'), ['action' => 'reactivate', $partner->id], ['confirm' => __('Are you sure you want to reactivate {0}?', h($partner->user->first_name.' '.$partner->user->last_name))]) ?></li>
                    <li><?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $partner->id], ['confirm' => __('Are you sure you want to delete {0}?', h($partner->user->first_name.' '.$partner->user->last_name))]) ?></li>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>
                    
        <?php if(isset($matchmaker)): ?>
            <!--- matchmaker hat nur eine paten-liste --->
            <li><?= $this->Html->link(__('List Partners'), ['controller' => 'Partners', 'action' => 'index']) ?> </li>
            
        <?php elseif(isset($vermittler) or isset($locationAdmin) OR isset($admin)): ?>
            <!-- vermittler, standortadmin und globaler admin dürfen status des paten änders --->
            <?php if($partner->status_id != 1 and $partner->status_id < 6) : ?>
                <li><?= $this->Html->link(__('Change Status of Partner'), ['action' => 'status', $partner->id]) ?> </li>
            <?php endif; ?>
            <!-- ... und haben unterteile paten-ansicht --->
            <li><?= $this->Html->link(__('List verified Partners'), ['controller' => 'Partners', 'action' => 'index', 'verified']) ?></li>
            <li><?= $this->Html->link(__('List waiting and matched Partners'), ['controller' => 'Partners', 'action' => 'index', 'active']) ?></li>
            <li><?= $this->Html->link(__('List quit and denied Partners'), ['controller' => 'Partners', 'action' => 'index', 'inactive']) ?></li>
        <?php endif; ?>
        <?php if(isset($authPartner)) : ?>
            
                <li><?= $this->Html->link(__('Edit Profile'), ['action' => 'edit', $partner->id]) ?> </li>    
        <?php endif; ?>
    </ul>
</div>

<div class="partners view large-10 medium-9 columns">
    <h2><?= h($partner->user->first_name) ?>
        <?= h($partner->user->last_name) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Status')?></h6>
			<?php if($partner->status->id == '1') : ?>
				<p><b>Angemeldet</b> <br/> Verifiziert <br/> Führungszeugnis <br/> Getroffen <br/> Wartend <br/> Vermittelt</p>
			<?php elseif($partner->status->id == '2') : ?>
				<p>Angemeldet <br/> <b>Verifiziert</b> <br/> Führungszeugnis <br/> Getroffen <br/> Wartend <br/> Vermittelt</p>
			<?php elseif($partner->status->id == '3') : ?>
				<p>Angemeldet <br/> Verifiziert <br/> <b>Führungszeugnis</b> <br/> Getroffen <br/> Wartend <br/> Vermittelt</p>
			<?php elseif($partner->status->id == '4') : ?>
				<p>Angemeldet <br/> Verifiziert <br/> Führungszeugnis <br/> <b>Getroffen</b> <br/> Wartend <br/> Vermittelt</p>
			<?php elseif($partner->status->id == '5') : ?>
				<p>Angemeldet <br/> Verifiziert <br/> Führungszeugnis <br/> Getroffen <br/> <b>Wartend</b> <br/> Vermittelt</p>
			<?php elseif($partner->status->id == '6') : ?>
				<p>Angemeldet <br/> Verifiziert <br/> Führungszeugnis <br/> Getroffen <br/> Wartend <br/> <b>Vermittelt</b></p>
			<?php elseif($partner->status->id == '7') : ?>
				<p><b><font color="#dd2d38">Aufgehört</font></b></p>
			<?php else : ?>
				<p><b><font color="#dd2d38">Abgelehnt</font></b></p>
			<?php endif; ?>
            <h6 class="subheader"><?= __('E-Mail') ?></h6>
            <p><?= h($partner->user->email) ?></p>
            <?php if (isset($admin)): ?>
            <h6 class="subheader"><?= __('Location') ?></h6>
            <p><?= $partner->has('location') ? $this->Html->link($partner->location->name, ['controller' => 'Locations', 'action' => 'view', $partner->location->id]) : 'Kein Standort zugewiesen' ?></p>
            <?php endif; ?>
            <h6 class="subheader"><?= __('Sex') ?></h6>
            <p><?= (($partner->sex)=='m') ? __('male') : __('female')?></p>
            <h6 class="subheader"><?= __('Age') ?></h6>
            <p><?= $this->Number->format($partner->age) ?></p>
            <h6 class="subheader"><?= __('Degree Course') ?></h6>
            <p><?= h($partner->degree_course) ?></p>
            <h6 class="subheader"><?= __('Job') ?></h6>
            <p><?= h($partner->job) ?></p>
            <h6 class="subheader"><?= __('Street') ?></h6>
            <p><?= h($partner->street) ?></p>
            <h6 class="subheader"><?= __('House Number') ?></h6>
            <p><?= h($partner->house_number) ?></p>
            <h6 class="subheader"><?= __('House Number Addition') ?></h6>
            <p><?= h($partner->house_number_addition) ?></p>
            <h6 class="subheader"><?= __('Postcode') ?></h6>
            <p><?= h($partner->postcode) ?></p>
            <h6 class="subheader"><?= __('City') ?></h6>
            <p><?= h($partner->city) ?></p>
            <h6 class="subheader"><?= __('Telephone') ?></h6>
            <p><?= h($partner->telephone) ?></p>
            <h6 class="subheader"><?= __('Mobile') ?></h6>
            <p><?= h($partner->mobile) ?></p>
            <h6 class="subheader"><?= __('teach_time') ?></h6>
            <p><?= $this->Number->format($partner->teach_time) ?></p>
            <h6 class="subheader"><?= __('extra_time') ?></h6>
            <p><?= $this->Number->format($partner->extra_time) ?></p>
            <h6 class="subheader"><?= __('spend_time') ?></h6>
            <p><?= h($partner->spend_time) ?></p>
            <h6 class="subheader"><?= __('experience') ?></h6>
            <p><?= h($partner->experience) ?></p>
            <h6 class="subheader"><?= __('preferred_gender') ?></h6>
            <p><?= h($partner->preferred_gender) ?></p>
            <h6 class="subheader"><?= __('support_wish') ?></h6>
            <p><?= h($partner->support_wish) ?></p>
            <h6 class="subheader"><?= __('reason_for_decision') ?></h6>
            <p><?= h($partner->reason_for_decision) ?></p>
            <h6 class="subheader"><?= __('additional_informations') ?></h6>
            <p><?= h($partner->additional_informations) ?></p>
            <h6 class="subheader"><?= __('reason_for_schuelerpaten') ?></h6>
            <p><?= h($partner->reason_for_schuelerpaten) ?></p>
			<?php if (!empty($partner->preferred_classranges)): ?>
				<h6 class="subheader"><?= __('Related PreferredClassranges') ?></h6>
                                    <table cellpadding="0" cellspacing="0">
                                            <tr>
                                                    <th><?= __('Classranges') ?></th>
                                            </tr>
                                            <?php foreach ($partner->preferred_classranges as $preferredClassranges): ?>
                                            <tr>
                                                    <td><?= h($preferredClassranges->classrange->name) ?></td>
                                            </tr>
                                            <?php endforeach; ?>
                                    </table>
                                <hr>
			<?php endif; ?>
			
			<?php if (!empty($partner->preferred_schooltypes)): ?>
				<h6 class="subheader"><?= __('Related PreferredSchooltypes') ?></h6>
                                    <table cellpadding="0" cellspacing="0">
                                            <tr>
                                                    <th><?= __('Schooltype') ?></th>
                                            </tr>
                                            <?php foreach ($partner->preferred_schooltypes as $preferredSchooltypes): ?>
                                            <tr>
                                                    <td><?= h($preferredSchooltypes->schooltype->name) ?></td>
                                            </tr>
                                            <?php endforeach; ?>
                                    </table>
				<hr>
			<?php endif; ?>
			
			<?php if (!empty($partner->preferred_subjects)): ?>
				<h6 class="subheader"><?= __('Related PreferredSubjects') ?></h6>
                                    <table cellpadding="0" cellspacing="0">
                                            <tr>
                                                    <th><?= __('Subject') ?></th>
                                                    <th><?= __('max_grade') ?></th>
                                            </tr>
                                            <?php foreach ($partner->preferred_subjects as $preferredSubjects): ?>
                                            <tr>
                                                    <td><?= h($preferredSubjects->subject->name) ?></td>
                                                    <td><?= h($preferredSubjects->maximum_class) ?></td>
                                            </tr>
                                            <?php endforeach; ?>
                                    </table>
			<?php endif; ?>
        </div>
		<?php if($partner->contact != NULL or $partner->contact != '') : ?>
			<div class="large-5 columns strings end">
				<h6 class="subheader"><?= __('Contact Person') ?></h6>
				<p>
					<?= nl2br(h($partner->contact)) ?>
				</p>
			</div>
		<?php endif; ?>
		
		<div class="large-5 columns numbers end">
			<h6 class="subheader"><?= __('Information for Partner') ?></h6>
			<p>
				<?= h($statusText->text) ?>
			</p>
			<?php if($partner->status_text != NULL or $partner->status_text != '') : ?>
				<br/>
				<p>
					<?= h($partner->status_text) ?>
				</p>
			<?php endif; ?>
		</div>
        <?php if (!isset($authPartner)) : ?>
        <div class="large-5 columns dates end">
            <h6 class="subheader"><?= __('Status History') ?></h6>
        <table>
            <tr><th>Status</th><th>Erreicht am</th><th>Notiz</th></tr>
            <?php foreach($statHis as $stat) : ?>
            <tr><td>
                <?= h($stat->status->name) ?>
                </td><td>
                <?= h($stat->timestamp) ?>
                </td><td>
                    <?php
                    if(isset($matchmaker)) :
                        echo h($stat->text);
                    else :
                        if(($stat->text) == ''):
                            $linkText = h(__('Add Status Note'));
                        else:
                            $linkText = h($stat->text);
                        endif;
                        echo $this->Html->link(
                            $linkText,
                            ['controller' => 'StatusHistorys', 'action' => 'setNote', $stat->id]
                        );
                    endif; ?>
                </td></tr>
            <?php endforeach; ?>
        </table>
        </div>
        <?php endif; ?>
        
    </div>
</div>

<!--<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related PreferredClassranges') ?></h4>
    <?php if (!empty($partner->preferred_classranges)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Partner Id') ?></th>
            <th><?= __('Classrange Id') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($partner->preferred_classranges as $preferredClassranges): ?>
        <tr>
            <td><?= h($preferredClassranges->id) ?></td>
            <td><?= h($preferredClassranges->partner_id) ?></td>
            <td><?= h($preferredClassranges->classrange_id) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'PreferredClassranges', 'action' => 'view', $preferredClassranges->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'PreferredClassranges', 'action' => 'edit', $preferredClassranges->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'PreferredClassranges', 'action' => 'delete', $preferredClassranges->id], ['confirm' => __('Are you sure you want to delete # {0}?', $preferredClassranges->id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>-->
<!--<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related PreferredSchooltypes') ?></h4>
    <?php if (!empty($partner->preferred_schooltypes)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Partner Id') ?></th>
            <th><?= __('Schooltype Id') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($partner->preferred_schooltypes as $preferredSchooltypes): ?>
        <tr>
            <td><?= h($preferredSchooltypes->id) ?></td>
            <td><?= h($preferredSchooltypes->partner_id) ?></td>
            <td><?= h($preferredSchooltypes->schooltype_id) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'PreferredSchooltypes', 'action' => 'view', $preferredSchooltypes->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'PreferredSchooltypes', 'action' => 'edit', $preferredSchooltypes->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'PreferredSchooltypes', 'action' => 'delete', $preferredSchooltypes->id], ['confirm' => __('Are you sure you want to delete # {0}?', $preferredSchooltypes->id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>-->
<!--<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related PreferredSubjects') ?></h4>
    <?php if (!empty($partner->preferred_subjects)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Subject Id') ?></th>
            <th><?= __('Partner Id') ?></th>
            <th><?= __('Maximum Class') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($partner->preferred_subjects as $preferredSubjects): ?>
        <tr>
            <td><?= h($preferredSubjects->id) ?></td>
            <td><?= h($preferredSubjects->subject_id) ?></td>
            <td><?= h($preferredSubjects->partner_id) ?></td>
            <td><?= h($preferredSubjects->maximum_class) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'PreferredSubjects', 'action' => 'view', $preferredSubjects->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'PreferredSubjects', 'action' => 'edit', $preferredSubjects->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'PreferredSubjects', 'action' => 'delete', $preferredSubjects->id], ['confirm' => __('Are you sure you want to delete # {0}?', $preferredSubjects->id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>-->
<?php if (!empty($partner->tandems)): ?>
	<div class="related row">
		<div class="column large-12">
		<h4 class="subheader"><?= __('Related Tandems') ?></h4>
			<table cellpadding="0" cellspacing="0">
				<tr>
					<th><?= __('Student') ?></th>
					<th><?= __('Activated') ?></th>
					<th><?= __('Deactivated') ?></th>
					<?php if(!isset($authPartner)) : ?>
						<th class="actions"><?= __('Actions') ?></th>
					<?php endif; ?>
				</tr>
				<?php foreach ($partner->tandems as $tandems): ?>
					<tr>
						<td><?= h($tandems->student->first_name.' '.$tandems->student->last_name) ?></td>
						<td><?= h($tandems->activated) ?></td>
						<?php if($tandems->deactivated != NULL) : ?>
							<td><?= h($tandems->activated) ?></td>
						<?php else : ?>
							<td></td>
						<?php endif; ?>	
						<?php if(!isset($authPartner)) : ?>
							<td class="actions">
								<?= $this->Html->link(__('View'), ['controller' => 'Tandems', 'action' => 'view', $tandems->id]) ?>
								<?php if($tandems->deactivated == NULL) : ?>
									<?= $this->Form->postLink(__('Deactivate'), ['controller' => 'Tandems', 'action' => 'deactivate', $tandems->id], ['confirm' => __('Are you sure you want to deactivate # {0}?', $tandems->id)]) ?>
								<?php else : ?>
									<?= $this->Form->postLink(__('Reactivate'), ['controller' => 'Tandems', 'action' => 'reactivate', $tandems->id], ['confirm' => __('Are you sure you want to reactivate # {0}?', $tandems->id)]) ?>
								<?php endif; ?>
							</td>
						<?php endif; ?>
					</tr>
				<?php endforeach; ?>
			</table>
		</div>
	</div>
<?php endif; ?>