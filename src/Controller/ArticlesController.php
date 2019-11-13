<?php
namespace App\Controller;


use App\Controller\AppController;
use Cake\Filesystem\Folder;
/**
 * Articles Controller
 *
 * @property \App\Model\Table\ArticlesTable $Articles
 *
 * @method \App\Model\Entity\Article[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ArticlesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */

    public function index()
    {
        $this->paginate = [
            'contain'   => ['Users'],
            'order'     =>[
                'Articles.modified' => 'desc'
            ]
        ];
        $articles = $this->paginate($this->Articles);

        $this->set(compact('articles'));
    }

    /**
     * View method
     *
     * @param string|null $id Article id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $article = $this->Articles->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('article', $article);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $article = $this->Articles->newEntity();
        if ($this->request->is('post')) {
            $postData = $this->request->getData();
            $file = $this->request->data['fileToUpload'];
            if($file['name'] != ''){
                $dir = new Folder( WWW_ROOT . 'img/' .$this->Auth->user()["id"] , true, 0766);
                move_uploaded_file($file['tmp_name'],$dir->path.'/'. $file['name']);
            }
            $article = $this->Articles->patchEntity($article, [
                'header' => $postData['header'],
                'content' => $postData['content'],
                'author_id'=> $this->Auth->user()["id"],
                'avatar_url' => ($file['name'] != '')? $this->Auth->user()["id"].'/'.$file['name']:'default.jpg'
            ]);
            if ($this->Articles->save($article)) {
                $this->Flash->success(__('Bài viết đã được lưu lại.'));

                return $this->redirect(['action' => 'index']);
            }
            if($article->getErrors('header')){
                $this->Flash->error(__('Tiêu đề của bài viết không thể để trống.'));
            }
            return $this->redirect(['action' => 'index']);
        }
        $users = $this->Articles->Users->find('list', ['limit' => 200]);
        $this->set(compact('article', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Article id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $article = $this->Articles->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $postData = $this->request->getData();
            $file = $postData['fileToUpload'];
            if($file['name'] != ''){
                $dir = new Folder( WWW_ROOT . 'img/' .$this->Auth->user()["id"] , true, 0766);
                move_uploaded_file($file['tmp_name'],$dir->path.'/'. $file['name']);
                $postData['avatar_url'] = ($file['name'] != '')? $this->Auth->user()["id"].'/'.$file['name']:'default.jpg';

            }
            if( $postData!=null){
                $article = $this->Articles->patchEntity($article, $postData);
                if ($this->Articles->save($article)) {
                    $this->Flash->success(__('Bài viết đã được lưu lại.'));

                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('Bài viết không được lưu lại, xin vui lòng thử lại.'));
            }
        }
        $users = $this->Articles->Users->find('list', ['limit' => 200]);
        $this->set(compact('article', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Article id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $article = $this->Articles->get($id);
        if ($this->Articles->delete($article)) {
            $this->Flash->success(__('Xóa bài viết thành công.'));
        } else {
            $this->Flash->error(__('Xóa bài viết bị lỗi, vui lòng thử lại sau.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
