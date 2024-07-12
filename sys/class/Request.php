<?php
class Request implements ArrayAccess {
    public $array = [];
    function __construct($GetArray) {
        foreach ($GetArray as $key => $value) {
            $this->array["unsafe_$key"] = $value;
            $this->array[$key] = htmlspecialchars($value);
        }
    }
    public function offsetSet($offset, $value): void {
        if (is_null($offset))
            $this->array[] = $value;
        else
            $this->array[$offset] = $value;
    }
    public function offsetExists($offset): bool {
        return isset($this->array[$offset]);
    }
    public function offsetUnset($offset): void {
       unset($this->array[$offset]);
    }
    public function offsetGet($offset): mixed {
        return (isset($this->array[$offset]) || !empty($this->array[$offset])) ? $this->array[$offset] : false;
    }
}