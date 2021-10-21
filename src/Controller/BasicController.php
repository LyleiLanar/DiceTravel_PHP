<?php

namespace App\Controller;

use Cake\ORM\Entity;

class BasicController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
    }

    protected function collectErrorMsgs(?Entity $entity): array|null
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
