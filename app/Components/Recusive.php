<?php

namespace App\Components;

class Recusive{
    private $data;
    private $htmlSelect = '';
    public function __construct($data)
    {
        $this->data = $data;
    }
    public function categoryRecusive($parentId, $id = 0, $text = '')
    {
        foreach ($this->data as $value) {
            if($value['parent_id'] == $id){
                if(!empty($parentId) && $parentId == $value['id'] && $value['status'] == "Active"){
                    $this->htmlSelect.="<option selected value=".$value['id'].">" . $text .' '. $value['name'] . "</option>";
                } elseif($value['status'] == "Active"){
                    $this->htmlSelect.="<option value=".$value['id'].">" . $text .' '. $value['name'] . "</option>";
                }
                $this->categoryRecusive($parentId, $value['id'], $text.'--');
              
            }
        }

        return $this->htmlSelect;
    }
}