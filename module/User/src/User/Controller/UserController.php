<?php

namespace User\Controller;

use User\Filter\SearchFilter;
use User\Filter\UserFilter;
use User\Model\User;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;

class UserController extends AbstractActionController
{

    /**
     * @var array
     */
    private $details;
    private $filterTagsAndTrim;

    /**
     * @param $applicationDetails
     */
    public function __construct(array $details)
    {
        $this->details = $details;
    }
    public function userAction($search = null)
    {
        $view = new ViewModel(array(
            'users' => $this->details['UserTable']->fetchAll($search),
        ));
        $view->setTemplate('user/users.html');
        $viewButtonsActions = new ViewModel();
        $viewButtonsActions->setTemplate('user/buttons_action.html');
        $view->addChild($viewButtonsActions, 'buttons_actions');
        $viewFormAdd = new ViewModel();
        $viewFormAdd->setTemplate('user/form_add.html');
        $view->addChild($viewFormAdd, 'form_add');
        $viewFormDel = new ViewModel();
        $viewFormDel->setTemplate('user/form_del.html');
        $view->addChild($viewFormDel, 'form_del');
        $viewFormSearch = new ViewModel();
        $viewFormSearch->setTemplate('user/form_search.html');
        $view->addChild($viewFormSearch, 'form_search');
        $viewFormPaginator = new ViewModel();
        $viewFormPaginator->setTemplate('user/paginator.html');
        $view->addChild($viewFormPaginator, 'paginator');
        return $view;
    }

    public function addAction()
    {
        if (!$this->request->isPost()) {
            $this->alert('Неверный запрос!', 'alert-danger');
            return $this->userAction();
        }
//получаем данные из формы
        $inputFilter = new UserFilter();
        $inputFilter->setData($this->request->getPost());
        if (!$inputFilter->isValid()) {
            $this->alert('Проверьте данные формы!', 'alert-danger');
            return $this->userAction();
        }
        $data = $inputFilter->getValues();
        $user = $this->details['User']->exchangeArray($data);
        $user = $this->details['User'];
        $this->details['UserTable']->saveUser($user);
        $message = empty($user->id) ? 'Пользователь добавлен' : 'Пользователь обновлен';
        $this->alert($message, 'alert-success');
        return $this->userAction();
    }

    public function delAction()
    {
        if (!$this->request->isPost()) {
            $this->alert('Неверный запрос!', 'alert-danger');
            return $this->userAction();
        }
        $id = (int) $this->request->getPost('id');
        $this->details['UserTable']->deleteUser($id);
        $this->alert('Пользователь удален', 'alert-success');
        return $this->userAction();
    }

    public function searchAction()
    {
        if (!$this->request->isPost()) {
            $this->alert('Неверный запрос!', 'alert-danger');
            return $this->userAction();
        }
        $inputFilter = new SearchFilter();
        $inputFilter->setData($this->request->getPost());
        return $this->userAction($inputFilter->getValues());
    }

    public function alert($msg, $class)
    {
        $this->layout()->setVariables(array(
            'message' => $msg,
            'alert' => $class));
    }

    public function accessAction()
    {
        if (!$this->request->isPost() || !$this->request->isXmlHttpRequest()) {
            return new JsonModel(array(
                'message' => 'Неверный запрос',
                'alert' => 'alert-danger',
            ));
        }
        $id = (int) $this->request->getPost('id');
        $access = !(int) $this->request->getPost('access');
        $this->details['UserTable']->changeAccess($id, $access);
        return new JsonModel(array(
            'id' => $id,
            'access' => (int) $access,
        ));
    }
}
