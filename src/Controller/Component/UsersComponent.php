<?php

namespace App\Controller\Component;

use App\Model\Entity\User;
use App\Model\Table\UsersTable;
use Cake\ORM\TableRegistry;

class UsersComponent extends \Cake\Controller\Component
{
    /**
     * @var UsersTable
     */
    private $UsersTable;

    public function initialize(array $config): void
    {
        parent::initialize($config);
        $this->UsersTable = TableRegistry::getTableLocator()->get('Users');
    }

    public function getUserNameById($id){
        /**
         * @var User $user
         */
        $user = $this->UsersTable->find()->where(['id'=>$id])->select(['login_name'])->first();
        return !is_null($user) ? $user->login_name : "perkele";
    }

}
