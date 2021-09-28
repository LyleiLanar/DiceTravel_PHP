<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Journey[]|\Cake\Collection\CollectionInterface $journeys
 */
?>
<div class="journeys index content">
    <?= $this->Html->link(__('New Journey'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Journeys') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('user_id', 'Creator', ['direction'=>'asc']) ?></th>
                    <th><?= $this->Paginator->sort('title') ?></th>
                    <th><?= $this->Paginator->sort('start_location') ?></th>
                    <th><?= $this->Paginator->sort('start_date') ?></th>
                    <th><?= $this->Paginator->sort('closed') ?></th>
                    <th><?= $this->Paginator->sort('visibility') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($journeys as $journey): ?>
                <tr>
                    <td><?= $this->Number->format($journey->id) ?></td>
                    <td><?= $journey->has('user') ? $this->Html->link($journey->user->id, ['controller' => 'Users', 'action' => 'view', $journey->user->id]) : '' ?></td>
                    <td><?= h($journey->title) ?></td>
                    <td><?= h($journey->start_location) ?></td>
                    <td><?= h($journey->start_date) ?></td>
                    <td><?= $this->Number->format($journey->closed) ?></td>
                    <td><?= $this->Number->format($journey->visibility) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $journey->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $journey->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $journey->id], ['confirm' => __('Are you sure you want to delete # {0}?', $journey->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
