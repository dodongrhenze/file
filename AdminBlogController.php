<?php 
	
namespace AdminBlog\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use AdminBlog\Form\AdminForm;

	class AdminBlogController extends AbstractActionController
	{

		public function indexAction()
    	{
	    	$view =  new ViewModel();
	    	$blogTable = $this->getServiceLocator()->get('BlogTable');

	        $view->blogs = $blogTable->select()->toArray();

	        return $view; 
   	}

   	public function addAction()
   	{
   		$view = new ViewModel();
         $form = new AdminForm();

         $request = $this->getRequest();

         if ($request->isPost()) 
         {
            $form->setData($request->getPost());

            if ($form->isValid()) 
            {
               $data = $form->getData();

               $blogTable = $this->getServiceLocator()->get('BlogTable');
               $data['date_added'] = date('Y-m-d H:i:s');
               
               unset($data['submit']);
               unset($data['id']);
               $blogTable->insert($data);
               $this->redirect()->toRoute('admin-blog');
            }
         }

         $view->form = $form;
         return $view;

   	}

   	public function editAction()
   	{
            
   		$id = $this->params()->fromRoute('id', null);
         $blogTable = $this->getServiceLocator()->get('BlogTable');
            
         if(!$id)
         {
            $this->redirect()->toRoute('admin-blog');
         }

         $view = new ViewModel();
         $form = new AdminForm();

         $request = $this->getRequest();
         
         if($request->isPost())
         {
            $form->setData($request->getPost());
          
            if($form->isValid())
            {
               $data = $form->getData();

               unset($data['submit']);
               $data['date_last_update'] = date('Y-m-d H:i:s');

               $blogTable->update($data, array('id' => $id));

               $this->redirect()->toRoute('admin-blog');
            }
         }
            else
            {
               $blog = $blogTable->select(array('id' => $id))->current();
               $form->bind($blog);
            }

            $view->form = $form;
            return $view;
   		}

   		public function deleteAction()
   		{
   			$id = $this->params()->fromRoute('id', null);
            $view =  new ViewModel();

            if(!$id)
            {
                $this->redirect()->toRoute('admin-blog');
            }

            $request = $this->getRequest();

            if($request->isPost())
            {
               $del = $request->getPost('del', 'No');
               if($del == 'Yes')
               {
                  $blogTable = $this->getServiceLocator()->get('BlogTable');
                  $blogTable->delete(array('id' => $id));

                  $this->redirect()->toRoute('admin-blog');
               }
            }

            $view->id = $id;
            return $view;
   		}
	}
