<?php

if (!function_exists('handlePostData'))
{
    function handlePostData($key)
    {
        if (!is_array($key))
        {
            if (isset($_POST[$key]))
            {
                return htmlspecialchars(trim($_POST[$key]));
            }
        }
        else
        {
            $out = [];
            foreach ($key as $k => $v)
            {
                $out[$v] = (isset($_POST[$v]) ? htmlspecialchars(trim($_POST[$v])) : '');
            }
            return $out;
        }
    }
}


if(!function_exists('_bsigLodFile'))
{
    function _bsigLodFile($file)
    {
        try
        {
            if(file_exists($file))
            {
                require_once($file);
                return true;
            }
        }
        catch(Excepion $e)
        {
            echo 'Error : Function _sopLodLib creating an error.';
            return false;
        }
    }
}