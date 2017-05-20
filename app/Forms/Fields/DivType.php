<?php namespace App\Forms\Fields;

use Kris\LaravelFormBuilder\Fields\FormField;

class DivType extends FormField {

    protected function getTemplate()
    {
        return 'fields.div';
    }
}