<?php namespace App\Forms\Fields;

use Kris\LaravelFormBuilder\Fields\FormField;

class CloseDivType extends FormField {

    protected function getTemplate()
    {
         return 'fields.closeDiv';
    }
}