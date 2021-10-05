<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\Entity\Journey;
use Cake\ORM\ResultSet;
use SebastianBergmann\Type\IterableType;

/**
 * Journeys Controller
 *
 * @property \App\Model\Table\JourneysTable $Journeys
 * @method \App\Model\Entity\Journey[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class JourneysController extends AppController
{
    public int $kacsa = 1;
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {


    }

    /**
     * View method
     *
     * @param string|null $id Journey id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $journey = $this->Journeys->get($id, [
            'contain' => ['Users', 'JourenyParticipants', 'Trips'],
        ]);

        $this->set(compact('journey'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $journey = $this->Journeys->newEmptyEntity();
        if ($this->request->is('post')) {
            $journey = $this->Journeys->patchEntity($journey, $this->request->getData());
            if ($this->Journeys->save($journey)) {
                $this->Flash->success(__('The journey has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The journey could not be saved. Please, try again.'));
        }
        $users = $this->Journeys->Users->find('list', ['limit' => 200]);
        $this->set(compact('journey', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Journey id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $journey = $this->Journeys->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $journey = $this->Journeys->patchEntity($journey, $this->request->getData());
            if ($this->Journeys->save($journey)) {
                $this->Flash->success(__('The journey has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The journey could not be saved. Please, try again.'));
        }
        $users = $this->Journeys->Users->find('list', ['limit' => 200]);
        $this->set(compact('journey', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Journey id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $journey = $this->Journeys->get($id);
        if ($this->Journeys->delete($journey)) {
            $this->Flash->success(__('The journey has been deleted.'));
        } else {
            $this->Flash->error(__('The journey could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
