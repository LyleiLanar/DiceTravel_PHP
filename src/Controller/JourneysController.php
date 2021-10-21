<?php
declare(strict_types=1);

namespace App\Controller;

use App\Controller\Component\JourneysComponent;
use App\Controller\Component\UsersComponent;
use App\Model\Entity\Journey;
use App\Model\Table\JourneysTable;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Datasource\ResultSetInterface;
use Cake\Http\Exception\MethodNotAllowedException;
use Cake\Http\Response;
use Cake\ORM\Exception\PersistenceFailedException;
use Cake\Routing\Route\Route;
use Cake\Routing\Router;
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
 * @property \App\Controller\Component\JourneysComponent $C_Journeys
 * @method \App\Model\Entity\Journey[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class JourneysController extends BasicController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('C_Users', ['className' => 'Users']);
        $this->loadComponent('C_Journeys', ['className' => 'Journeys']);
    }

    /**
     * Index method
     *
     * @return Response|null|void Renders view
     */
    public function index()
    {
        $links = [];
        $links['journeyDelete'] = Router::url(['controller' => 'Journeys', 'action' => 'delete'], true);
        $links['journeyEdit'] = Router::url(['controller' => 'Journeys', 'action' => 'edit'], true);


        $userId = 70; // ez majd más lesz
        $loginName = $this->C_Users->getUserNameById($userId);
        $loggedUser = $this->C_Users->getUserById($userId);
        $activeJourney = $this->C_Journeys->getActiveJourneyByUserId($userId);
        $this->C_ClientData->set(compact(['activeJourney', 'loggedUser', 'links']));
        $this->set(compact(['loginName', 'activeJourney']));
    }

    /**
     * Add method
     *
     * @return Response|null|void Redirects on successful add, renders view otherwise.
     * @throws \Exception
     */
    public function add()
    {
        $success = true;
        $message = "The Journey has been saved!";

        if (!$this->getRequest()->is('ajax')) {
            throw new \Exception('!!!Backend exception!!!');
        }

        try {
            $this->getRequest()->allowMethod('POST');
        } catch (MethodNotAllowedException $e) {
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
     * @return Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws RecordNotFoundException When record not found.
     */
    public function edit($id)
    {
        $success = true;
        $message = "The Journey has been saved!";

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
            $journey = $this->C_Journeys->getActiveJourneyById($id);
            $journey = $this->Journeys->patchEntity($journey, $this->request->getData());

            $errors = $this->collectErrorMsgs($journey);

            if (empty($errors)) {

                try {
                    $entity = $this->Journeys->saveOrFail($journey);
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

    /**
     * Delete method
     *
     * @param string|null $id Journey id.
     * @return Response|null|void Redirects to index.
     * @throws RecordNotFoundException When record not found.
     */
    public function delete($id)
    {
        $success = true;
        $message = 'The Journey has been DELETED!';

        if (!$this->getRequest()->is('ajax')) {
            throw new \Exception('!!!Backend exception!!!');
        }

        try {
            $this->getRequest()->allowMethod('DELETE');
        } catch (MethodNotAllowedException $e) {
            $success = false;
            $message = 'You cannot do that!';
        }

        try {
            $journey = $this->Journeys->get($id, ['contain' => ['Trips']]);
            $this->Journeys->delete($journey);
        } catch (\Exception $e) {
            $success = false;
            $message = "There is no Journey with the given id ($id)";
        }

        $success = true;
        $message = "The Journey has been deleted!";

        $dataArray = ['success', 'message'];
        $this->set(compact($dataArray));
        $this->viewBuilder()->setOption('serialize', $dataArray);
    }
}
