<?php

class Controller extends MarkController {

    public function test() {
        parent::setGet(array("uri" => "api/v1", "controller_name" => "Controller", "endpoint_name" => "test"));
    }
}
