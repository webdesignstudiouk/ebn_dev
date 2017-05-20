<?php namespace App\Forms\Fields;

use Kris\LaravelFormBuilder\Fields\FormField;

class Header extends FormField {

    protected function getTemplate()
    {
        return 'fields.header';
    }
}