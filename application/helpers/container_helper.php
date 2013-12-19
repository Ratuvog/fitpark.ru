<?php

/*
 * Группиовка элементов из $data по $group_size
 * в каждой из групп (кроме, возможно, последней)
 */
function groupOf($data, $group_size)
{
    if (count($data) < $group_size || $group_size == 0)
        return $data;

    $group_data = [];
    $cnt = 0;
    foreach ($data as $item)
    {
        $group_data[$cnt/$group_size] []= $item;
        $cnt++;
    }
    return $group_data;
}
?>
