<?php
namespace App\Classes;

use Form;

class Report
{
    public $name;
    public $title;
    public $optionsForm;


    public function __construct($name, $title)
    {
        $this->name = $name;
        $this->title = $title;
        $this->get_form();
    }

    protected function get_form()
    {
        ob_start();
        echo Form::open(array('url' => route('reports.dispatch', $this->name.'_report'), 'method'=>'post'));
        echo Form::token();
        echo Form::input('hidden', 'report_id', $this->name);
        echo Form::input('hidden', 'report_title', $this->title);
        echo view('reports.'.$this->name.'.form')->render();
        echo Form::input('submit', 'submit', 'Generate', ['class'=>'btn btn-success', 'style'=>'width:100%']);
        echo Form::close();
        $this->optionsForm = ob_get_contents();
        ob_end_clean();
    }

    public function form()
    {
        echo (string) $this->optionsForm;
    }

}