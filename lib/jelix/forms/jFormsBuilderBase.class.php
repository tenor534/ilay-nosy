<?php
/**
* @package     jelix
* @subpackage  forms
* @author      Laurent Jouanneau
* @contributor
* @copyright   2006-2007 Laurent Jouanneau
* @link        http://www.jelix.org
* @licence     http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public Licence, see LICENCE file
*/

/**
 * base class of all builder form classes generated by the jform compiler.
 *
 * a builder form class is a class which help to generate a form for the output
 * (html form for example)
 * @package     jelix
 * @subpackage  forms
 */
abstract class jFormsBuilderBase {
    /**
     * a form object
     * @var jFormsBase
     */
    protected $_form;

    /**
     * the action selector
     * @var string
     */
    protected $_action;

    /**
     * params for the action
     * @var array
     */
    protected $_actionParams = array();

    /**
     * form name
     */
    protected $_name;

    protected $_endt = '/>';
    /**
     * @param jFormsBase $form a form object
     * @param string $action action selector where form will be submit
     * @param array $actionParams  parameters for the action
     */
    public function __construct($form, $action, $actionParams){
        $this->_form = $form;
        $this->_action = $action;
        $this->_actionParams = $actionParams;
        $this->_name = jFormsBuilderBase::generateFormName();
        if($GLOBALS['gJCoord']->response!= null && $GLOBALS['gJCoord']->response->getType() == 'html'){
            $this->_endt = ($GLOBALS['gJCoord']->response->isXhtml()?'/>':'>');
        }
    }

    public function getName(){ return  $this->_name; }

    /**
     * output the header content of the form
     * @param array $params some parameters, depending of the type of builder
     */
    abstract public function outputHeader($params);

    /**
     * output the footer content of the form
     */
    abstract public function outputFooter();

    /**
     * displays the content corresponding of the given control
     * @param jFormsControl $ctrl the control to display
     */
    abstract public function outputControl($ctrl);

    /**
     * displays the label corresponding of the given control
     * @param jFormsControl $ctrl the control to display
     */
    abstract public function outputControlLabel($ctrl);

    /**
     * generates a name for the form
     */
    public static function generateFormName(){
        static $number = 0;
        $number++;
        return 'jform'.$number;
    }
}


/**
 * HTML form builder
 * @package     jelix
 * @subpackage  forms
 */
abstract class jFormsHtmlBuilderBase extends jFormsBuilderBase {

    /**
     * output the header content of the form
     * @param array $params some parameters 0=>name of the javascript error decorator
     *    1=> name of the javascript help decorator
     */
    public function outputHeader($params){
        $url = jUrl::get($this->_action, $this->_actionParams, 2); // retourne le jurl correspondant
        echo '<form action="',$url->scriptName,$url->pathInfo,'" method="POST" name="', $this->_name,'" onsubmit="return jForms.verifyForm(this)"';
        if($this->_form->hasUpload())
            echo ' enctype="multipart/form-data">';
        else
            echo '>';

        if(count($url->params)){
            echo '<div>';
            foreach ($url->params as $p_name => $p_value) {
                echo '<input type="hidden" name="', $p_name ,'" value="', htmlspecialchars($p_value), '"',$this->_endt, "\n";
            }
            echo '</div>';
        }
        echo '<script type="text/javascript"> 
//<[CDATA[
', $this->getJavascriptCheck($params[0],$params[1]),'
//]]>
</script>';
        $errors = $this->_form->getContainer()->errors;
        if(count($errors)){
            $ctrls = $this->_form->getControls();
            echo '<ul class="jforms-error-list">';
            $errRequired='';
            foreach($errors as $cname => $err){
                if($err == JFORM_ERRDATA_REQUIRED) {
                    if($ctrls[$cname]->alertRequired){
                        echo '<li>', $ctrls[$cname]->alertRequired,'</li>';
                    }else{
                        echo '<li>', jLocale::get('jelix~formserr.js.err.required', $ctrls[$cname]->label),'</li>';
                    }
                }else{
                    if($ctrls[$cname]->alertInvalid){
                        echo '<li>', $ctrls[$cname]->alertInvalid,'</li>';
                    }else{
                        echo '<li>', jLocale::get('jelix~formserr.js.err.invalid', $ctrls[$cname]->label),'</li>';
                    }
                }

            }
            echo '</ul>';
        }
    }

    public function outputFooter(){
        echo '</form>';
    }

    public function outputControlLabel($ctrl){
        $required = ($ctrl->required == ''?'':' jforms-required');
        $inError = (isset($this->_form->getContainer()->errors[$ctrl->ref]) ?' jforms-error':'');
        $hint = ($ctrl->hint == ''?'':' title="'.htmlspecialchars($ctrl->hint).'"');
        if($ctrl->type == 'output' || $ctrl->type == 'checkboxes' || $ctrl->type == 'radiobuttons'){
            echo '<span class="jforms-label',$required,$inError,'"',$hint,'>',htmlspecialchars($ctrl->label),'</span>';
        }else if($ctrl->type != 'submit'){
            $id = $this->_name.'_'.$ctrl->ref;
            echo '<label class="jforms-label',$required,$inError,'" for="'.$id.'"',$hint,'>'.htmlspecialchars($ctrl->label).'</label>';
        }
    }

    public function outputControl($ctrl){
        $id = ' name="'.$ctrl->ref.'" id="'.$this->_name.'_'.$ctrl->ref.'"';
        $readonly = ($ctrl->readonly?' readonly="readonly"':'');
        $hint = ($ctrl->hint == ''?'':' title="'.htmlspecialchars($ctrl->hint).'"');
        $class = (isset($this->_form->getContainer()->errors[$ctrl->ref]) ?' class="jforms-error"':'');
        switch($ctrl->type){
        case 'input':
            $value = $this->_form->getData($ctrl->ref);
            if($value === null)
                $value = $ctrl->defaultValue;
            echo '<input type="text"',$id,$readonly,$hint,$class,' value="',htmlspecialchars($value),'"',$this->_endt;
            break;
        case 'checkbox':
            $value = $this->_form->getData($ctrl->ref);
            if($value =='')
                $value = $ctrl->defaultValue;

            if($ctrl->valueOnCheck == $value){
                $v=' checked="checked"';
            }else{
                $v='';
            }
            echo '<input type="checkbox"',$id,$readonly,$hint,$class,$v,' value="',$ctrl->valueOnCheck,'"',$this->_endt;
            break;
        case 'checkboxes':
            $i=0;
            $id=$this->_name.'_'.$ctrl->ref.'_';
            $attrs=' name="'.$ctrl->ref.'[]" id="'.$id;
            $value = $this->_form->getData($ctrl->ref);
            if($value == null){
                $value = $ctrl->selectedValues;
            }

            if(is_array($value) && count($value) == 1)
                $value = $value[0];

            if(is_array($value)){
                foreach($ctrl->datasource->getDatas() as $v=>$label){
                    echo '<input type="checkbox"',$attrs,$i,'" value="',htmlspecialchars($v),'"';
                    if(in_array($v,$value)) 
                        echo ' checked="checked"';
                    echo $readonly,$class,$this->_endt,'<label for="',$id,$i,'">',htmlspecialchars($label),'</label>';
                    $i++;
                }
            }else{
                foreach($ctrl->datasource->getDatas() as $v=>$label){
                    echo '<input type="checkbox"',$attrs,$i,'" value="',htmlspecialchars($v),'"';
                    if($v == $value) 
                        echo ' checked="checked"';
                    echo $readonly,$class,$this->_endt,'<label for="',$id,$i,'">',htmlspecialchars($label),'</label>';
                    $i++;
                }
            }
            break;
        case 'radiobuttons':
            $i=0;
            $id=' name="'.$ctrl->ref.'" id="'.$this->_name.'_'.$ctrl->ref.'_';
            $value = $this->_form->getData($ctrl->ref);
            if($value === null){
                if(count($ctrl->selectedValues) == 1)
                    $value = $ctrl->selectedValues[0];
            }
            foreach($ctrl->datasource->getDatas() as $v=>$label){
                echo '<input type="radio"',$id,$i,'" value="',htmlspecialchars($v),'"',($v==$value?' checked="checked"':''),$readonly,$class,$this->_endt;
                echo '<label for="',$this->_name,'_',$ctrl->ref,'_',$i,'">',htmlspecialchars($label),'</label>';
                $i++;
            }
            break;
        case 'menulist':
            echo '<select',$id,$readonly,$hint,$class,' size="1">';
            $value = $this->_form->getData($ctrl->ref);
            if($value === null){
                if(count($ctrl->selectedValues) == 1)
                    $value = $ctrl->selectedValues[0];
            }
            foreach($ctrl->datasource->getDatas() as $v=>$label){
                echo '<option value="',htmlspecialchars($v),'"',($v==$value?' selected="selected"':''),'>',htmlspecialchars($label),'</option>';
            }
            echo '</select>';
            break;
        case 'listbox':
            if($ctrl->multiple){
                echo '<select name="',$ctrl->ref,'[]" id="',$this->_name,'_',$ctrl->ref,'"',$readonly,$hint,$class,' size="',$ctrl->size,'" multiple="multiple">';
                $value = $this->_form->getData($ctrl->ref);
                if($value == null){
                    $value = $ctrl->selectedValues;
                }

                if(is_array($value) && count($value) == 1)
                    $value = $value[0];

                if(is_array($value)){
                    foreach($ctrl->datasource->getDatas() as $v=>$label){
                        echo '<option value="',htmlspecialchars($v),'"',(in_array($v,$value)?' selected="selected"':''),'>',htmlspecialchars($label),'</option>';
                    }
                }else{
                    foreach($ctrl->datasource->getDatas() as $v=>$label){
                        echo '<option value="',htmlspecialchars($v),'"',($v==$value?' selected="selected"':''),'>',htmlspecialchars($label),'</option>';
                    }
                }
                echo '</select>';
            }else{
                $value = $this->_form->getData($ctrl->ref);
                if($value == null){
                    $value = $ctrl->selectedValues;
                }

                if(is_array($value)){
                    if(count($value) >= 1)
                        $value = $value[0];
                    else
                        $value ='';
                }

                echo '<select',$id,$readonly,$hint,$class,' size="',$ctrl->size,'">';
                foreach($ctrl->datasource->getDatas() as $v=>$label){
                    echo '<option value="',htmlspecialchars($v),'"',($v==$value?' selected="selected"':''),'>',htmlspecialchars($label),'</option>';
                }
                echo '</select>';
            }
            break;
        case 'textarea':
            $value = $this->_form->getData($ctrl->ref);
            if($value === null)
                $value = $ctrl->defaultValue;
            echo '<textarea',$id,$readonly,$hint,$class,'>',htmlspecialchars($value),'</textarea>';
            break;
        case 'secret':
        case 'secretconfirm':
            echo '<input type="password"',$id,$readonly,$hint,$class,' value="',htmlspecialchars($this->_form->getData($ctrl->ref)),'"',$this->_endt;
            break;
        case 'output':
            $value = $this->_form->getData($ctrl->ref);
            if($value === null)
                $value = $ctrl->defaultValue;
            echo '<input type="hidden"',$id,' value="',htmlspecialchars($value),'"',$this->_endt;
            echo '<span class="jforms-value"',$hint,'>',htmlspecialchars($value),'</span>';
            break;
        case 'upload':
            if($ctrl->maxsize){
                echo '<input type="hidden" name="MAX_FILE_SIZE" value="',$ctrl->maxsize,'"',$this->_endt;
            }
            echo '<input type="file"',$id,$readonly,$hint,$class,' value=""',$this->_endt; // ',htmlspecialchars($this->_form->getData($ctrl->ref)),'
            break;
        case 'submit':
            if($ctrl->standalone){
                echo '<button type="submit"',$id,$hint,'>',htmlspecialchars($ctrl->label),'</button>';
            }else{
                foreach($ctrl->datasource->getDatas() as $v=>$label){
                    echo '<button type="submit"',$id,$hint,' value="',htmlspecialchars($v),'">',htmlspecialchars($label),'</button> ';
                }
            }
            break;
        }

        if ($ctrl->hasHelp) {
            if($ctrl->type == 'checkboxes' || ($ctrl->type == 'listbox' && $ctrl->multiple)){
                $name=$ctrl->ref.'[]';
            }else{
                $name=$ctrl->ref;
            }
            echo '<span class="jforms-help"><a href="javascript:jForms.showHelp(\''. $this->_name.'\',\''.$name.'\')">?</a></span>';
        }
    }


    abstract public function getJavascriptCheck($errDecorator,$helpDecorator);
}


?>