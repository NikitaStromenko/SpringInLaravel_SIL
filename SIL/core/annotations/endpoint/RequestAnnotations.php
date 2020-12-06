<?php

class RequestAnnotations
{
    const GetMapping = "GET";
    const PostMapping = "POST";
    const PathMapping = "PATH";
    const PutMapping = "PUT";
    const DeleteMapping = "DELETE";

    public static function getRequestMethod($annotation)
    {
        switch ($annotation) {
            case 'GetMapping' :
                return self::GetMapping;
                break;
            case 'PostMapping' :
                return self::PostMapping;
                break;
            case 'PathMapping' :
                return self::PathMapping;
                break;
            case 'PutMapping' :
                return self::PutMapping;
                break;
            case 'DeleteMapping' :
                return self::DeleteMapping;
                break;
            default :
                throw new HttpRequestMethodException();
        }
    }
}