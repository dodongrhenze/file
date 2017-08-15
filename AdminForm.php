<?php 
	
namespace AdminBlog\Form;

use Zend\Form\Form;
use Zend\Form\Element;
use Zend\InputFilter\InputFilter;

class AdminForm extends Form 
{
	public   function __construct()
	{
		parent::__construct('genericForm');
		
		$this->setAttribute('method', 'post');
		
		$this->add(
			array(
				'name' => 'title',
				'type' => 'Text',
				'options' => array(
					'label' => 'Title :',
				),	
				'attributes' => array(
					'class' => 'form-control',
				),
			)
		);

		$this->add(
			array(
				'name' => 'description',
				'type' => 'Text',
				'options' => array(
					'label' => 'Description :',
				),	
				'attributes' => array(
					'class' => 'form-control',
				),		
			)
		);

		$this->add(
			array(
				'name' => 'writer',
				'type' => 'Text',
				'options' => array(
					'label' => 'Author :',
				),
				'attributes' => array(
					'class' => 'form-control',
				)
			)
		);

		$this->add(array(
			'type' => 'Select',
			'name' => 'type',
			'options' => array(
				'label' => 'Blog Type:',
				'empty_option' => 'Please choose your Blog Type',
				'value_options' => array(
					'Outdoor' => 'Outdoor',
					'Indoor' => 'Indoor',
				),
			),
			'attributes' => array(
				'class' => 'form-control',
			),
		
		));

		$this->add(array(
			'type' => 'Select',
			'name' => 'status',
			'options' => array(
				'label' => 'Blog Status',
				'empty_option' => 'Please choose your Blog Status',
				'value_options' => array(
					'0' => 'active',
					'1' => 'inactive',
				),
			),
			'attributes' => array(
				'class' => 'form-control',
			),
		));

		$this->add(array(
			'name' => 'submit',
			'type' => 'submit',
			'attributes' => array(
				'class' => 'btn btn-success',
			),	
		));
		$this->setInputFilter($this->getInputFilters());
	}
	
	public function getInputFilters()
	{
		$inputFilter = new InputFilter();

		$inputFilter->add(array(
		    'name' => 'title',
		    'required' => true,
		    'validators' => array(    
		        array(
		            'name' => 'string_length',
		            'options' => array(
		                'min' => 5,	 
		                'max' => 100,            		
		            ),
		        ),
		    ),
		));

		$inputFilter->add(array(
		    'name' => 'description',
		    'required' => true,
		    'validators' => array(
		    
		        array(
		            'name' => 'string_length',
		            'options' => array(
		                'min' => 5,	
		                'max' => 255,             		
		            ),
		        ),
		    ),
		));

		$inputFilter->add(array(
		    'name' => 'writer',
		    'required' => true,
		    'validators' => array(
		    
		        array(
		            'name' => 'string_length',
		            'options' => array(
		                'min' => 5,
		                'max' => 100,             		
		            ),
		        ),
		    ),
		));

		$inputFilter->add(array(
		    'name' => 'type',
		    'required' => true,
		    'validators' => array(		    
		        array(
					'name'    => 'InArray',
					'options' => array(
						'haystack' => array('Outdoor', 'Indoor'),
					)
				),
		    ),
		));

		$inputFilter->add(array(
		    'name' => 'status',
		    'required' => true,
		    'validators' => array(		    
		        array(
					'name'    => 'InArray',
					'options' => array(
						'haystack' => array('0', '1'),
					)
				),
		    ),
		));

		return $inputFilter;
	
	}

}
