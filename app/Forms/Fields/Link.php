<?php namespace App\Forms\Fields;

use Kris\LaravelFormBuilder\Fields\FormField;

class Link extends FormField {

    protected function getTemplate()
    {
        return 'fields.link';
    }
}