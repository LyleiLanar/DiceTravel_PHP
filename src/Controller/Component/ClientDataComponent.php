<?php

namespace App\Controller\Component;

class ClientDataComponent extends \Cake\Controller\Component
{

    private $data = [];

    public function set($key, $value)
    {
        $this->data[$key] = $value;
    }

    public function beforeRender()
    {
        $controller = $this->getController();
        $controller->set('clientData', $this->data);
    }

}
