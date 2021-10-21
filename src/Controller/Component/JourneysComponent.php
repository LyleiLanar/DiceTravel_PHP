<?php

namespace App\Controller\Component;

use App\Model\Entity\Journey;
use Cake\ORM\Exception\PersistenceFailedException;
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

    public function getActiveJourneyByUserId($userId): array|\Cake\Datasource\EntityInterface
    {
        return $this->JourneysTable->find()
            ->contain(['Trips' => function (Query $q) {
                return $q->whereNull(['end_date']);
            }])
            ->where(['user_id' => $userId, 'closed' => 0])
            ->first();

    }

    /**
     * @param $journeyId
     * @return array|\Cake\Datasource\EntityInterface
     * @throws \Exception
     * @throws PersistenceFailedException
     */
    public function getActiveJourneyById($journeyId): array|\Cake\Datasource\EntityInterface
    {
        $result = $this->JourneysTable->find()
            ->contain(['Trips' => function (Query $q) {
                return $q->whereNull(['end_date']);
            }])
            ->where(['id' => $journeyId, 'closed' => 0])
            ->first();

        if (empty($result)) {
            throw new \Exception();
        }

        return $result;


    }

}
