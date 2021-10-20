<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Http\Exception\MethodNotAllowedException;

/**
 * Trips Controller
 *
 * @property \App\Model\Table\TripsTable $Trips
 * @method \App\Model\Entity\Trip[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TripsController extends AppController
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

//    /**
//     * View method
//     *
//     * @param string|null $id Trip id.
//     * @return \Cake\Http\Response|null|void Renders view
//     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
//     */
//    public function view($id = null)
//    {
//        $trip = $this->Trips->get($id, [
//            'contain' => ['Journeys', 'Entries'],
//        ]);
//
//        $this->set(compact('trip'));
//    }

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
     * @param string|null $id Trip id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $trip = $this->Trips->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $trip = $this->Trips->patchEntity($trip, $this->request->getData());
            if ($this->Trips->save($trip)) {
                $this->Flash->success(__('The trip has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The trip could not be saved. Please, try again.'));
        }
        $journeys = $this->Trips->Journeys->find('list', ['limit' => 200]);
        $this->set(compact('trip', 'journeys'));
    }
}
