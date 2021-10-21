<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Http\Exception\MethodNotAllowedException;
use Cake\ORM\Exception\PersistenceFailedException;

/**
 * Trips Controller
 *
 * @property \App\Model\Table\TripsTable $Trips
 * @method \App\Model\Entity\Trip[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TripsController extends BasicController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Journeys'],
        ];
        $trips = $this->paginate($this->Trips);

        $this->set(compact('trips'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $success = true;
        $message = "The Trip has been saved!";

        if (!$this->getRequest()->is('ajax')) {
            throw new \Exception('!!!Backend exception!!!');
        }

        try {
            $this->getRequest()->allowMethod('POST');
        } catch (MethodNotAllowedException $e) {
            $success = false;
            $message = 'You cannot do that!';
        }

        //TODO megcsinálni az trip addot tényleg
        $entity = null;

        $dataArray = ['success', 'message', 'entity'];
        $this->set(compact($dataArray));
        $this->viewBuilder()->setOption('serialize', $dataArray);

    }

    /**
     * Edit method
     *
     * @param string $id Trip id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id)
    {
        $success = true;
        $message = "The Trip has been saved!";

        if (!$this->getRequest()->is('ajax')) {
            throw new \Exception('!!!Backend exception!!!');
        }
        try {
            $this->getRequest()->allowMethod('PATCH');
        } catch (MethodNotAllowedException $e) {
            $success = false;
            $message = 'You cannot do that!';
        }

        try {
            $trip = $this->Trips->get($id);
            $trip = $this->Trips->patchEntity($trip, $this->request->getData());

            $errors = $this->collectErrorMsgs($trip);

            if (empty($errors)) {
                try {
                    $entity = $this->Trips->saveOrFail($trip);
                } catch (PersistenceFailedException $e) {
                    $success = false;
                    $message = "Something went wrong: " . $e->getMessage();
                }
            } else {
                $success = false;
                $message = "Save was unsuccesfull, there are some errors: " . implode(' ', $errors);
            }

        } catch (\Exception $e) {
            $success = false;
            $message = 'No such element with this id: #' . $id;
        }

        $dataArray = ['success', 'message', 'entity'];
        $this->set(compact($dataArray));
        $this->viewBuilder()->setOption('serialize', $dataArray);
    }
}
