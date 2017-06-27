<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider as ServiceProvider;

class FormServiceProvider extends ServiceProvider
{
    protected $namespace = 'App\Http\Controllers';
    protected static $disabledStatus = "";

    public function boot()
    {

    }

  	public static function csrf_field(){
  		echo csrf_field();
  	}

    public static function open($params = array(), $disabled = false)
    {
        if($disabled == true){
    		    static::$disabledStatus = "disabled='disabled'";
        }
        $o = '<form';
        $o .= (isset($params['id']))        ? " id='{$params['id']}'"                       : '';
        $o .= (isset($params['name']))      ? " name='{$params['name']}'"                   : '';
        $o .= (isset($params['class']))     ? " class='{$params['class']}'"                 : '';
        $o .= (isset($params['onsubmit']))  ? " onsubmit='{$params['onsubmit']}'"           : '';
        $o .= (isset($params['method']))    ? " method='{$params['method']}'"               : ' method="post"';
        $o .= (isset($params['action']))    ? " action='{$params['action']}'"               : '';
        $o .= (isset($params['files']))     ? " enctype='multipart/form-data'"              : '';
        $o .= (isset($params['style']))     ? " style='{$params['style']}'"                 : '';
        $o .= (isset($params['role']))      ? " role='{$params['role']}'"                   : '';
        $o .= (isset($params['autocomplete'])) ? " autocomplete='{$params['autocomplete']}'" : '';
        $o .= '>';
        echo $o."\n";
    }

    public static function close()
    {
        static::$disabledStatus = null;
        echo "</form>\n";
    }

	public static function renderInputOpen($params) {
		$o  = "<div class='form-group'>\n";
		if(isset($params['label'])){
			if(isset($params['name'])){
				$o  .= "<label for='{$params['name']}'>{$params['label']}</label>\n";
			}else{
				$o  .= "<label>{$params['label']}</label>\n";
			}
		}
		return $o;
	}

	public static function renderInputClose($o, $return=null) {
		$o  .= "</div>";
		if($return == null){
			echo $o;
		}else{
			return $o;
		}
	}

    public static function textBox($params = array())
    {
        echo self::textarea($params);
    }

	public static function range($params = array())
    {
		$o = self::renderInputOpen($params);
		$o .= "</div>";
		$o .= "<div class='row'><div class='col-sm-9'>";
		$o .= "<input type='range' ";
		$o .= (isset($params['id']))        ? " id='{$params['id']}'"                           : '';
		$o .= (isset($params['name']))      ? " name='{$params['name']}'"                       : '';
		$o .= (isset($params['class']))     ? " class='{$params['class']}'"  					: "class=''";
		$o .= (isset($params['min']))  		? " min='{$params['min']}'"               			: '';
		$o .= (isset($params['max']))  		? " max='{$params['max']}'"               			: '';
		$o .= (isset($params['step']))  	? " step='{$params['step']}'"               		: '';
        $o .= (isset($params['style']))     ? " style='{$params['style']}'"                  	: '';

		if(isset($params['showValue'])){
			$o .= (isset($params['onChange']))  ? " onchange='updateTextInput(this.value);'"    : '';
		}else{
			$o .= (isset($params['onChange']))  ? " onchange='{$params['onChange']}'"         	: '';
		}

		$o .= (isset($params['onChange']))  ? " onchange='{$params['onChange']}'"         		: '';
		$o .= (isset($params['disabled']))  ? " disabled='{$params['disabled']}'"               : '';
		$o .= (isset($params['value']))     ? $params['value']                                  : '';
		$o .= "/>";
		$o .= "</div>";

		$o .= "<div class='col-sm-3'>";
		if(isset($params['showValue'])){
			$o .= self::input(['id'=>$params['name'].'_rangeValue', 'value'=>'0', 'return'=>true]);
			$o .= "<script>
					function updateTextInput(val) {
						document.getElementById('".$params['name']."_rangeValue').value=val;
					}
					</script>";
		}
		$o .= "</div></div>";

		echo $o;
	}

    public static function textarea($params = array())
    {
		$o = self::renderInputOpen($params);
        $o .= '<textarea';
        $o .= (isset($params['id']))        ? " id='{$params['id']}'"                           : '';
        $o .= (isset($params['name']))      ? " name='{$params['name']}'"                       : '';
        $o .= (isset($params['class']))     ? " class='form-control {$params['class']}'"  		: "class='form-control'";
        $o .= (isset($params['onclick']))   ? " onclick='{$params['onclick']}'"                 : '';
        $o .= (isset($params['cols']))      ? " cols='{$params['cols']}'"                       : '';
        $o .= (isset($params['rows']))      ? " rows='{$params['rows']}'"                       : '';
        $o .= (isset($params['disabled']))  ? " disabled='{$params['disabled']}'"               : static::$disabledStatus;
        $o .= (isset($params['placeholder']))  ? " placeholder='{$params['placeholder']}'"      : '';
        $o .= (isset($params['maxlength']))     ? " maxlength='{$params['maxlength']}'"         : '';
        $o .= (isset($params['style']))     ? " style='{$params['style']}'"                     : '';
        $o .= (isset($params['required']))     ? " required='required'"                         : '';
        $o .= '>';
        $o .= (isset($params['value']))     ? $params['value']                                  : '';
        $o .= "</textarea>\n";
        self::renderInputClose($o);
    }

    public static function input($params = array())
    {
		$o = self::renderInputOpen($params);
        $o .= '<input ';
        $o .= (isset($params['type']))      ? " type='{$params['type']}'"                    : ' type="text"';
        $o .= (isset($params['id']))        ? " id='{$params['id']}'"                        : '';
        $o .= (isset($params['name']))      ? " name='{$params['name']}'"                    : '';
        $o .= (isset($params['class']))     ? " class='form-control {$params['class']}'"     : " class='form-control'";
        $o .= (isset($params['onclick']))   ? " onclick='{$params['onclick']}'"              : '';
        $o .= (isset($params['onkeypress']))? " onkeypress='{$params['onkeypress']}'"        : '';
        $o .= (isset($params['value']))     ? ' value="' . $params['value'] . '"'            : '';
        $o .= (isset($params['length']))    ? " maxlength='{$params['length']}'"             : '';
        $o .= (isset($params['width']))     ? " style='width:{$params['width']}px;'"         : '';
        $o .= (isset($params['disabled']))  ? " disabled='{$params['disabled']}'"            : static::$disabledStatus;
        $o .= (isset($params['placeholder']))  ? " placeholder='{$params['placeholder']}'"   : '';
        $o .= (isset($params['accept']))     ? " accept='{$params['accept']}'"               : '';
        $o .= (isset($params['maxlength']))     ? " maxlength='{$params['maxlength']}'"      : '';
        $o .= (isset($params['style']))     ? " style='{$params['style']}'"                  : '';
        $o .= (isset($params['required']))     ? " required='required'"                      : '';
        $o .= (isset($params['autocomplete'])) ? " autocomplete='{$params['autocomplete']}'" : '';
        $o .= (isset($params['autofocus'])) ? " autofocus"                                   : '';
        $o .= " />\n";

		if(isset($params['return'])){
			$o .= "</div>";
			return $o;
		}else{
			self::renderInputClose($o);
		}
    }

	 public static function file($params = array())
    {
		$o = self::renderInputOpen($params);
        $o .= '<input ';
        $o .= "type='file'";
        $o .= (isset($params['id']))        ? " id='{$params['id']}'"                        : '';
        $o .= (isset($params['name']))      ? " name='{$params['name']}'"                    : '';
        $o .= (isset($params['class']))     ? " class='form-control {$params['class']}'"     : "class='form-control'";
        $o .= (isset($params['onclick']))   ? " onclick='{$params['onclick']}'"              : '';
        $o .= (isset($params['onkeypress']))? " onkeypress='{$params['onkeypress']}'"        : '';
        $o .= (isset($params['value']))     ? ' value="' . $params['value'] . '"'            : '';
        $o .= (isset($params['length']))    ? " maxlength='{$params['length']}'"             : '';
        $o .= (isset($params['width']))     ? " style='width:{$params['width']}px;'"         : '';
        $o .= (isset($params['disabled']))  ? " disabled='{$params['disabled']}'"            : static::$disabledStatus;
        $o .= (isset($params['placeholder']))  ? " placeholder='{$params['placeholder']}'"   : '';
        $o .= (isset($params['accept']))     ? " accept='{$params['accept']}'"               : '';
        $o .= (isset($params['maxlength']))     ? " maxlength='{$params['maxlength']}'"      : '';
        $o .= (isset($params['style']))     ? " style='{$params['style']}'"                  : '';
        $o .= (isset($params['required']))     ? " required='required'"                      : '';
        $o .= (isset($params['autocomplete'])) ? " autocomplete='{$params['autocomplete']}'" : '';
        $o .= (isset($params['autofocus'])) ? " autofocus"                                   : '';
        $o .= " />\n";
        self::renderInputClose($o);
    }

    public static function select($params = array())
    {
		$o = self::renderInputOpen($params);
        $o .= "<select";
        $o .= (isset($params['id']))        ? " id='{$params['id']}'"                           : '';
        $o .= (isset($params['name']))      ? " name='{$params['name']}'"                       : '';
        $o .= (isset($params['class']))     ? " class='{$params['class']}'"                     : "class='form-control'";
        $o .= (isset($params['onclick']))   ? " onclick='{$params['onclick']}'"                 : '';
        $o .= (isset($params['width']))     ? " style='width:{$params['width']}px;'"            : '';
        $o .= (isset($params['required']))     ? " required='required'"                         : '';
        $o .= (isset($params['disabled']))  ? " disabled='{$params['disabled']}'"               : static::$disabledStatus;
        $o .= (isset($params['style']))     ? " style='{$params['style']}'"                     : '';
        $o .= ">\n";
        $o .= "<option value=''>Select</option>\n";

		if (isset($params['data']) && is_array($params['data'])) {
            foreach ($params['data'] as $k => $v) {
                if (isset($params['value']) && $params['value'] == $k) {
                    $o .= "<option value='{$k}' selected='selected'>{$v}</option>\n";
                } else {
                    $o .= "<option value='{$k}'>{$v}</option>\n";
                }
            }
        }
        $o .= "</select>\n";
        self::renderInputClose($o);
    }

    public static function checkbox($params = array())
    {
        $o = self::renderInputOpen($params);
		$o .= "<input type='checkbox'";
		$o .= (isset($params['id']))             ? " id='{$params['id']}'"                                : '';
		$o .= (isset($params['name']))           ? " name='{$params['name']}'"                            : '';
		$o .= (isset($params['value']))          ? " value='{$params['value']}'"                          : '';
		$o .= (isset($params['class']))          ? " class='{$params['class']}'"                          : '';
		$o .= (isset($params['checked']))        ? " {$params['checked']}"                                : '';
		$o .= (isset($params['disabled']))       ? " disabled='{$params['disabled']}'"                    : static::$disabledStatus;
		$o .= (isset($params['style']))     	 ? " style='{$params['style']}'"                            : '';
		$o .= (isset($params['onchange']))     	 ? " onchange=\"$('#form').submit();\""                   : '';
		$o .= " />\n";
        self::renderInputClose($o);
    }

    public static function radio($params = array())
    {
        $o = self::renderInputOpen($params);
        if (!empty($params)) {
            $x = 0;
            foreach ($params as $k => $v) {
                $v['id'] = (isset($v['id']))        ? $v['id']                                          : "rd_id_{$x}_".rand(1000, 9999);
                $o .= "<input type='radio'";
                $o .= (isset($v['id']))             ? " id='{$v['id']}'"                                : '';
                $o .= (isset($v['name']))           ? " name='{$v['name']}'"                            : '';
                $o .= (isset($v['value']))          ? " value='{$v['value']}'"                          : '';
                $o .= (isset($v['class']))          ? " class='{$v['class']}'"                          : '';
                $o .= (isset($v['checked']))        ? " checked='checked'"                              : '';
                $o .= (isset($v['disabled']))       ? " disabled='{$v['disabled']}'"                    : static::$disabledStatus;
                $o .= (isset($params['style']))     ? " style='{$params['style']}'"                     : '';
                $o .= " />\n";
                $o .= (isset($v['label']))          ? "<label for='{$v['id']}'>{$v['label']}</label> "  : '';
                $x++;
            }
        }
        self::renderInputClose($o);
    }

    public static function button($params = array())
    {
		$o = self::renderInputOpen($params);
        $o .= "<button type='submit'";
        $o .= (isset($params['id']))        ? " id='{$params['id']}'"                           : '';
        $o .= (isset($params['name']))      ? " name='{$params['name']}'"                       : '';
        $o .= (isset($params['class']))     ? " class='{$params['class']}'"                     : '';
        $o .= (isset($params['onClick']))   ? " onclick='{$params['onClick']}'"                 : '';
        $o .= (isset($params['disabled']))  ? " disabled='{$params['disabled']}'"               : static::$disabledStatus;
        $o .= (isset($params['style']))     ? " style='{$params['style']}'"                     : '';
        $o .= ">";
        $o .= (isset($params['iclass']))    ? "<i class='fa {$params['iclass']}'></i> "         : '';
        $o .= (isset($params['value']))     ? "{$params['value']}"                              : '';
        $o .= "</button>\n";
        self::renderInputClose($o);
    }

    public static function submit($params = array())
    {
		$o = self::renderInputOpen($params);
        $o .= '<input type="submit"';
        $o .= (isset($params['id']))        ? " id='{$params['id']}'"                           : '';
        $o .= (isset($params['name']))      ? " name='{$params['name']}'"                       : '';
        $o .= (isset($params['class']))     ? " class='btn btn-primary {$params['class']}'"     : "class='btn btn-primary'";
        $o .= (isset($params['onclick']))   ? " onclick='{$params['onclick']}'"                 : '';
        $o .= (isset($params['value']))     ? " value='{$params['value']}'"                     : '';
        $o .= (isset($params['disabled']))  ? " disabled='{$params['disabled']}'"               : static::$disabledStatus;
        $o .= (isset($params['style']))     ? " style='{$params['style']}'"                     : '';
        $o .= " />\n";
		self::renderInputClose($o);
    }

    public static function hidden($params = array())
    {
        $o = '<input type="hidden"';
        $o .= (isset($params['id']))        ? " id='{$params['id']}'"                           : '';
        $o .= (isset($params['name']))      ? " name='{$params['name']}'"                       : '';
        $o .= (isset($params['class']))     ? " class='{$params['class']}'"     : '';
        $o .= (isset($params['value']))     ? " value='{$params['value']}'"                     : '';
        $o .= " />";
    }

}
