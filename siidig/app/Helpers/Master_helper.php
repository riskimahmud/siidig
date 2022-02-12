<?php

function ambil_data($table, $return = "getResult", $where = false)
{
    // $CI = &get_instance();
    $crud_model = new \App\Models\CrudModel();
    $ret    =    $crud_model->select_data($table, $return, $where);
    return $ret;
}

function ambil_nama($table, $field, $where = false)
{
    // $CI = &get_instance();
    $crud_model = new \App\Models\CrudModel();
    $data    =    $crud_model->select_data($table, "getRow", $where);
    if (empty($data)) {
        return false;
    } else {
        return $data->$field;
    }
}

function in_array_r($needle, $haystack, $strict = false)
{
    foreach ($haystack as $item) {
        if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
            return true;
        }
    }

    return false;
}
