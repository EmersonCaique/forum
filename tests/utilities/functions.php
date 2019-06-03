<?php

function create($class, $attrbiutes = [], $times = null)
{
    return factory($class, $times)->create($attrbiutes);
}

function make($class, $attrbiutes = [], $times = null)
{
    return factory($class, $times)->make($attrbiutes);
}

function raw($class, $attrbiutes = [], $times = null)
{
    return factory($class, $times)->raw($attrbiutes);
}
