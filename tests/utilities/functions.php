<?php

function create($class, $attrbiutes = [])
{
    return factory($class)->create($attrbiutes);
}

function make($class, $attrbiutes = [])
{
    return factory($class)->make($attrbiutes);
}

function raw($class, $attrbiutes = [])
{
    return factory($class)->raw($attrbiutes);
}
