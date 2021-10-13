<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\Entity\Journey;
use Cake\ORM\Exception\PersistenceFailedException;
use mysql_xdevapi\Exception;
use PhpParser\Node\Expr\Array_;
use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;
use function PHPUnit\Framework\throwException;

/**
 * Journeys Controller
 *
 * @property \App\Model\Table\JourneysTable $Journeys
 * @property \App\Controller\Component\UsersComponent $C_Users
 * @method \App\Model\Entity\Journey[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class JourneysController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('C_Users', ['className' => 'Users']);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $loginName = $this->C_Users->getUserNameById(70);
        $this->set(compact(['loginName']));
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
     * @throws \Exception
     */
    public function add()
    {
        $success = true;
        $message = "The Journey has been saved!";
        if (!$this->getRequest()->is('ajax')) {
            $success = false;
            $message = 'You cannot do that!';
        }

        //$entity = new Journey();
        $entity = $this->Journeys->newEntity($this->getRequest()->getData());
        $errors = $this->collectErrorMsgs($entity);

        if (empty($errors)) {

            try {
                $entity = $this->Journeys->saveOrFail($entity);
            } catch (PersistenceFailedException $e) {
                $success = false;
                $message = "Something went wrong: " . $e->getMessage();
            }
        } else {
            $success = false;
            $message = "Save was unsuccesfull, there are some errors: " . implode(' ', $errors);
        }

        $dataArray = ['success', 'message', 'entity'];
        $this->set(compact($dataArray));
        $this->viewBuilder()->setOption('serialize', $dataArray);

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

    private function collectErrorMsgs(?Journey $entity): array|null
    {
        if (!$entity) {
            return null;
        }

        $returnErrors = [];

        foreach ($entity->getErrors() as $fieldErrors) {
            foreach ($fieldErrors as $error) {
                //array_push($returnErrors, $error); // a procedurális módszer
                $returnErrors[] = $error;
            }
        }
        return $returnErrors;
    }
}
