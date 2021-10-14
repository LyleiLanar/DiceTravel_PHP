<?php

namespace App\Controller\Component;

use App\Model\Entity\Journey;
use Cake\ORM\Query;
use Cake\ORM\TableRegistry;
use Jasny\Twig\ArrayExtension;

class JourneysComponent extends \Cake\Controller\Component
{

    /**
     * @var \App\Model\Table\JourneysTable $JourneysTable
     *
     */
    private $JourneysTable;

    public function initialize(array $config): void
    {
        parent::initialize($config);
        $this->JourneysTable = TableRegistry::getTableLocator()->get('Journeys');
    }

    public function getJourneyById($id): ?Journey
    {
        return $this->JourneysTable->get($id);
    }

    public function getActiveJourneyByUserId($userId): ?Journey
    {
        return $this->JourneysTable->find()
            ->contain(['Trips' => function (Query $q) {
                return $q->whereNull(['end_date']);
            }])
            ->where(['user_id' => $userId, 'closed' => 0])
            ->first();

    }

}
