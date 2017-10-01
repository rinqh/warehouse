<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Products Controller
 *
 * @property \App\Model\Table\ProductsTable $Products
 *
 * @method \App\Model\Entity\Product[] paginate($object = null, array $settings = [])
 */
class ProductsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Categories', 'Units']
        ];
        $products = $this->paginate($this->Products);
        $this->set(compact('products'));
        $this->set('_serialize', ['products']);
    }

    /**
     * View method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $product = $this->Products->get($id, [
            'contain' => ['Categories', 'Units']
        ]);

        $this->set('product', $product);
        $this->set('_serialize', ['product']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $product = $this->Products->newEntity();
        if ($this->request->is('post')) {
            $product = $this->Products->patchEntity($product, $this->request->getData());
            if ($this->Products->save($product)) {
                $this->Flash->success(__('The product has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product could not be saved. Please, try again.'));
        }
        $categories = $this->Products->Categories->find('list', ['limit' => 200]);
        $units = $this->Products->Units->find('list', ['limit' => 200]);
        $this->set(compact('product', 'categories', 'units'));
        $this->set('_serialize', ['product']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $product = $this->Products->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $product = $this->Products->patchEntity($product, $this->request->getData());
            if ($this->Products->save($product)) {
                $this->Flash->success(__('The product has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product could not be saved. Please, try again.'));
        }
        $categories = $this->Products->Categories->find('list', ['limit' => 200]);
        $units = $this->Products->Units->find('list', ['limit' => 200]);
        $this->set(compact('product', 'categories', 'units'));
        $this->set('_serialize', ['product']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $product = $this->Products->get($id);
        if ($this->Products->delete($product)) {
            $this->Flash->success(__('The product has been deleted.'));
        } else {
            $this->Flash->error(__('The product could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    function search() {
        $products = null;
        $product_name = null;
        $category_id = null;

        $categories = $this->Products->Categories->find('list', ['limit' => 200]);
        $this->paginate = [
            'contain' => ['Categories', 'Units']
        ];

        if ($this->request->is('post')) {
            if ($this->request->getData('Search.name'))
                $product_name = $this->request->getData('Search.name');
            if ($this->request->getData('Search.category_id'))
                $category_id = $this->request->getData('Search.category_id');
            if ($category_id && !$product_name)
                $this->paginate = [
                    'contain' => ['Categories', 'Units'],
                    'conditions' =>  ['Products.category_id' => $category_id]
                ];
            else if (!$category_id && $product_name)
                $this->paginate = [
                    'contain' => ['Categories', 'Units'],
                    'conditions' =>  ['Products.name LIKE' => '%'.$product_name.'%']
                ];
            else if ($category_id && $product_name) {
                $condition = array (
                            'AND' => array (['Products.name LIKE' => '%'.$product_name.'%'],
                                            ['Products.category_id' => $category_id])
                );
                $this->paginate = [
                    'contain' => ['Categories', 'Units'],
                    'conditions' =>  $condition
                ];                
            }
        }
        $products = $this->paginate($this->Products);
        $this->set(compact('products', 'categories'));
        $this->set('_serialize', ['products']);
        
	}
}
