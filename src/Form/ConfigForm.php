<?php

namespace Drupal\custom_general\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class ConfigForm extends ConfigFormBase {

    Const RESULT = "custom_general.settings";
    public function getFormId() {
        return "custom_general_settings";
    }

    protected function getEditableConfigNames() {
        return [
            static::RESULT,
        ];
    }

    public function buildForm(array $form, FormStateInterface $form_state) {
        $config = $this->config(static::RESULT);
        $form['NAME'] = [
            '#type' => 'textfield',
            '#title' => 'NAME',
            '#default_value' => $config->get("NAME"),
        ];

        $form['PLACE'] = [
            '#type' => 'textfield',
            '#title' => 'PLACE',
            '#default_value' => $config->get("PLACE"),
        ];
        $form['gender'] = [
            '#type' => 'select',
            '#title' => 'Gender',
            '#options' => [
                'male' => 'Male',
                'female' => 'Female',
            ],
        ];

        return Parent::buildForm($form, $form_state);
    }

    public function submitForm(array &$form, FormStateInterface $form_state) {
        $config = $this->config(static::RESULT);
        $config->set("NAME", $form_state->getValue('NAME'));
        $config->set("PLACE", $form_state->getValue('PLACE'));
        $config->set("GENDER", $form_state->getValue('GENDER'));
        $config->save();
    }

}