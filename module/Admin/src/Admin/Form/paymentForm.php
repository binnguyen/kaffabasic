<?php
/**
 * Created by PhpStorm.
 * User: MrHung
 * Date: 11/6/14
 * Time: 9:37 AM
 */

namespace Admin\Form;

use Zend\Form\Form;
use Zend\Form\Element;
use Velacolib\Utility\Utility;

class paymentForm extends Form{

    protected $translator;

    protected $inputFilter;
    public function __construct($name = null){
        parent::__construct('paymentForm');
        $this->setAttribute('method', 'post');
        $this->setAttribute('class', 'form-horizontal');
        $this->setAttribute('enctype', 'multipart/form-data');
        $this->setAttribute('action', '/admin/payment/add');
        $this->prepareElements();

    }

    public function prepareElements(){

        $translator = Utility::translate();

        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type' => 'hidden',

            ),
        ));

        $this->add(array(
            'name' => 'title',
            'options' => array(
                'label' => $translator->translate('Title'),
            ),
            'attributes' => array(
                'type' => 'text',
                'class' => 'input-xlarge'
            ),
        ));

        $this->add(array(
            'name' => 'value',
            'options' => array(
                'label' => $translator->translate('Value'),
            ),
            'attributes' => array(
                'type' => 'text',
                'class' => 'input-xlarge'
            ),
        ));

        $this->add(array(
            'name' => 'reason',
            'options' => array(
                'label' => $translator->translate('Reason'),
            ),
            'attributes' => array(
                'type' => 'textarea',
                'class' => 'input-xlarge'
            ),
        ));

        $this->add(array(
            'name' => 'time',
            'attributes' => array(
                'type' => 'hidden',
                'class' => 'input-xlarge',
                'value'=> time()
            ),
        ));


        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Go',
                'id' => 'submitbutton',
                'class' => 'btn btn-danger'
            ),
        ));
    }



} 