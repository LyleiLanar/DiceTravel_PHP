<?php
declare(strict_types=1);

namespace App\Controller\Component;

use App\Model\Entity\User;
use Cake\ORM\TableRegistry;

class UsersComponent extends \Cake\Controller\Component
{
    /**
     * @var \App\Model\Table\UsersTable
     */
    private $UsersTable;

    public function initialize(array $config): void
    {
        parent::initialize($config);
        $this->UsersTable = TableRegistry::getTableLocator()->get('Users');
    }

    /**
     * This method returns the login name by user id.
     *
     * @param int $id user_id
     * @return string login_name
     */
    public function getUserNameById(int $id): string
    {
        /**
         * @var \App\Model\Entity\User $user
         */
        $user = $this->UsersTable->find()->where(['id' => $id])->select(['login_name'])->first();

        return !is_null($user) ? $user->login_name : 'no user with this Id';
    }

    public function getUserById(int $id): ?User
    {
        return $this->UsersTable->get($id);
    }
}
