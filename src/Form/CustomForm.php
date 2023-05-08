<?php

namespace Drupal\custom_general\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class CustomForm extends FormBase {

    // generated form id
    public function getFormId()
    {
        return 'custom_form_get_user_details';
    }

    // build form generates form
    public function buildForm(array $form, FormStateInterface $form_state) {
        $form['name'] = [
            '#type' => 'textfield',
            '#title' => 'Name',
            '#required' => TRUE,
            '#placeholder' => 'name',
        ];
        $form['usn'] = [
            '#type' => 'textfield',
            '#title' => 'USN',
            '#required' => TRUE,
            '#placeholder' => '123',
        ];
        $form['email'] = [
            '#type' => 'textfield',
            '#title' => 'Email',
            '#placeholder' => 'abc@gmail.com',

        ];
        $form['place'] = [
            '#type' => 'textfield',
            '#title' => 'place',
            '#required' => TRUE,
            '#placeholder' => 'place',
            '#default_value' => 'bangalore',
        ];
        $form['submit'] = [
            '#type' => 'submit',
            '#value' => 'Save the configuration',
        ];
        return $form;
    }


    // submit form
    public function submitForm(array &$form, FormStateInterface $form_state) {
        \Drupal::messenger()->addMessage("User Details Submitted Successfully");
        \Drupal::database()->insert("user_details")->fields([
            'name' => $form_state->getValue("name"),
            'usn' => $form_state->getValue("usn"),
            'email' => $form_state->getValue("email"),
            'place' => $form_state->getValue("place"),
        ])->execute();
    }
}


