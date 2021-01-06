<?php
namespace Concrete\Package\HeyDj\Block\Form;

use Core;
use Database;
use Request;

class MiniSurveyA extends \Concrete\Block\Form\MiniSurvey
{
    public function loadInputType($questionData, $showEdit)
    {
        $options = explode('%%', $questionData['options']);
        $defaultDate = $questionData['defaultDate'];
        $msqID = intval($questionData['msqID']);
        $datetime = Core::make('helper/form/date_time');
        $html = '';
        switch ($questionData['inputType']) {
            case 'checkboxlist':
                // this is looking really crappy so i'm going to make it behave the same way all the time - andrew
                /*
                if (count($options) == 1) {
                    if(strlen(trim($options[0]))==0) continue;
                    $checked=(Request::request('Question'.$msqID.'_0')==trim($options[0]))?'checked':'';
                    $html.= '<input name="Question'.$msqID.'_0" type="checkbox" value="'.trim($options[0]).'" '.$checked.' />';
                } else {
                */
                $html .= '<div class="checkboxList">'."\r\n";
                for ($i = 0; $i < count($options); ++$i) {
                    if (strlen(trim($options[$i])) == 0) {
                        continue;
                    }
                    $checked = (Request::request('Question'.$msqID.'_'.$i) == trim($options[$i])) ? 'checked' : '';
                    $html .= '  <div class="checkbox"><label><input name="Question'.$msqID.'_'.$i.'" type="checkbox" value="'.trim($options[$i]).'" '.$checked.' /> <span>'.$options[$i].'</span></label></div>'."\r\n";
                }
                $html .= '</div>';
                //}
                return $html;

            case 'select':
                if ($this->frontEndMode) {
                    $selected = (!Request::request('Question'.$msqID)) ? 'selected="selected"' : '';
                    $html .= '<option value="" '.$selected.'>----</option>';
                }
                foreach ($options as $option) {
                    $checked = (Request::request('Question'.$msqID) == trim($option)) ? 'selected="selected"' : '';
                    $html .= '<option '.$checked.'>'.trim($option).'</option>';
                }

                return '<select class="form-control" name="Question'.$msqID.'" id="Question'.$msqID.'" >'.$html.'</select>';

            case 'radios':
                foreach ($options as $option) {
                    if (strlen(trim($option)) == 0) {
                        continue;
                    }
                    $checked = (Request::request('Question'.$msqID) == trim($option)) ? 'checked' : '';
                    $html .= '<div class="radio"><label><input name="Question'.$msqID.'" type="radio" value="'.trim($option).'" '.$checked.' /> <span>'.$option.'</span></label></div>';
                }

                return $html;

            case 'fileupload':
                $html = '<input type="file" name="Question'.$msqID.'" class="form-control" id="Question'.$msqID.'" />';

                return $html;

            case 'text':
                $val = (Request::request('Question'.$msqID)) ? Core::make('helper/text')->entities(Request::request('Question'.$msqID)) : '';

                return '<textarea name="Question'.$msqID.'" class="form-control" id="Question'.$msqID.'" cols="'.$questionData['width'].'" rows="'.$questionData['height'].'">'.$val.'</textarea>';
            case 'url':
                $val = (Request::request('Question'.$msqID)) ? Request::request('Question'.$msqID) : '';

                return '<input name="Question'.$msqID.'" id="Question'.$msqID.'" class="form-control" type="url" value="'.stripslashes(htmlspecialchars($val)).'" />';
            case 'telephone':
                $val = (Request::request('Question'.$msqID)) ? Request::request('Question'.$msqID) : '';

                return '<input name="Question'.$msqID.'" id="Question'.$msqID.'" class="form-control" type="tel" value="'.stripslashes(htmlspecialchars($val)).'" />';
            case 'email':
                $val = (Request::request('Question'.$msqID)) ? Request::request('Question'.$msqID) : '';

                return '<input name="Question'.$msqID.'" id="Question'.$msqID.'" class="form-control" type="email" value="'.stripslashes(htmlspecialchars($val)).'" />';
            case 'date':
                $val = (Request::request('Question'.$msqID)) ? Request::request('Question'.$msqID) : $defaultDate;

                return $datetime->date('Question'.$msqID, $val);
            case 'datetime':
                $val = Request::request('Question'.$msqID);
                if (!isset($val)) {
                    if (
                        Request::request('Question'.$msqID.'_dt') && Request::request('Question'.$msqID.'_h')
                        && Request::request('Question'.$msqID.'_m') && Request::request('Question'.$msqID.'_a')
                    ) {
                        $val = Request::request('Question'.$msqID.'_dt') . ' ' . Request::request('Question'.$msqID.'_h')
                            . ':' . Request::request('Question'.$msqID.'_m') . ' ' . Request::request('Question'.$msqID.'_a');
                    } else {
                        $val = $defaultDate;
                    }
                }

                return $datetime->datetime('Question'.$msqID, $val);
            case 'field':
            default:
                $val = (Request::request('Question'.$msqID)) ? Request::request('Question'.$msqID) : '';

                return '<input name="Question'.$msqID.'" id="Question'.$msqID.'" class="form-control" type="text" value="'.stripslashes(htmlspecialchars($val)).'" />';
        }
    }

}
