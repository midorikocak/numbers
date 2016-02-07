<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Numbers Controller
 *
 * @property \App\Model\Table\NumbersTable $Numbers
 */
class NumbersController extends AppController
{

    public function isAuthorized($user)
    {
        // All registered users can add numbers
        if ($this->request->action === 'add') {
            return true;
        }

        // The owner of an article can edit and delete it
        if (in_array($this->request->action, ['edit', 'delete'])) {
            $numberId = (int)$this->request->params['pass'][0];
            if ($this->Numbers->isOwnedBy($numberId, $user['id'])) {
                return true;
            }
        }

        return parent::isAuthorized($user);
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $numbers = $this->paginate($this->Numbers);

        $this->set(compact('numbers'));
        $this->set('_serialize', ['numbers']);
    }

    /**
     * View method
     *
     * @param string|null $id number id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $number = $this->Numbers->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('number', $number);
        $this->set('_serialize', ['number']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $number = $this->Numbers->newEntity();
        if ($this->request->is('post')) {
            $number = $this->Numbers->patchEntity($number, $this->request->data);
            $number->user_id = $this->Auth->user('id');
            if ($this->Numbers->save($number)) {
                $this->Flash->success(__('The number has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The number could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('number'));
        $this->set('_serialize', ['number']);
    }

    public function search($keyword=null) {
        $number = $this->Numbers->newEntity();
        if ($this->request->is(['patch', 'post', 'put'])) {

            if($keyword==null){
                if ($this->request->is('post')) {
                    $keyword = $this->request->data['number'];
                }
            }
            $keyword = $this->Numbers->cleanNumber($keyword);
            $searched = $this->Numbers->find()->where(['number LIKE' => '%'.$keyword.'%']);
            $this->set('numbers', $this->paginate($searched));
            $this->render('index');
        }
        $this->set(compact('number'));
        $this->set('_serialize', ['number']);
    }

    /**
     * Edit method
     *
     * @param string|null $id number id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $number = $this->Numbers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $number = $this->Numbers->patchEntity($number, $this->request->data);
            $number->user_id = $this->Auth->user('id');
            if ($this->Numbers->save($number)) {
                $this->Flash->success(__('The number has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The number could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('number'));
        $this->set('_serialize', ['number']);
    }

    /**
     * Delete method
     *
     * @param string|null $id number id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $number = $this->Numbers->get($id);
        if ($this->Numbers->delete($number)) {
            $this->Flash->success(__('The number has been deleted.'));
        } else {
            $this->Flash->error(__('The number could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
