<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\Entity;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow('add', 'logout', 'login');
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        if($this->Auth->user()!=null) {
            $this->redirect('articles');
        }
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            if($data['password'] == $data['re-password']){
                $user = $this->Users->patchEntity($user, $this->request->getData());
                $user->role_id = '2';
                if ($this->Users->save($user)) {
                    $this->Flash->success(__('Tài khoản vừa tạo đã được lưu lại.'));

                    return $this->redirect(['action' => 'login']);
                }
                else{
                    $this->Flash->error(__('Quá trình lưu tài khoản bị lỗi.'));
                }
            }
            else{
                $this->Flash->error(__('Mật khẩu nhập lại không khớp.'));
            }
        }
        $this->set(compact('user'));
    }

    public function login()
    {
        if($this->Auth->user()!=null) $this->redirect('articles');
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('Sai tên đăng nhập hoặc mật khẩu.'));
        }
    }

    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }
}
