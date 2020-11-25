<?php

class MarkController {
    /**
     * This is an array of uri, controller_name, endpoint_name
     * For request method GET.
     * @var array
     */
    private static $get = array();
    /**
     * This is an array of uri, controller_name, endpoint_name
     * For request method POST.
     * @var array
     */
    private static $post = array();
    /**
     * This is an array of uri, controller_name, endpoint_name
     * For request method PATCH.
     * @var array
     */
    private static $path = array();
    /**
     * This is an array of uri, controller_name, endpoint_name
     * For request method PUT.
     * @var array
     */
    private static $put = array();
    /**
     * This is an array of uri, controller_name, endpoint_name
     * For request method DELETE.
     * @var array
     */
    private static $delete = array();

    /**
     * These arrays are endpoint markers. This is necessary so that we can set the uri and the request method directly from the controller.
     * Format: value = url example: (value = "api/v1/login"). endpoint_name - This is the name of the function that should process the request.
     *
     * Example:
     * public function endpoint() {
     *      $this->GetMapping[] = array("value" => "api/v1/login", "endpoint_name" => "endpoint");
     * }
     *
     * @var array
     */
    public $GetMapping = array();
    public $PostMapping = array();
    public $PathMapping = array();
    public $PutMapping = array();
    public $DeleteMapping = array();

    /**
     * @return array
     */
    public static function getGet()
    {
        return self::$get;
    }

    /**
     * @param array $get
     */
    public static function setGet($get)
    {
        self::$get[] = $get;
    }

    /**
     * @return array
     */
    public static function getPost()
    {
        return self::$post;
    }

    /**
     * @param array $post
     */
    public static function setPost($post)
    {
        self::$post[] = $post;
    }

    /**
     * @return array
     */
    public static function getPath()
    {
        return self::$path;
    }

    /**
     * @param array $path
     */
    public static function setPath($path)
    {
        self::$path[] = $path;
    }

    /**
     * @return array
     */
    public static function getPut()
    {
        return self::$put;
    }

    /**
     * @param array $put
     */
    public static function setPut($put)
    {
        self::$put[] = $put;
    }

    /**
     * @return array
     */
    public static function getDelete()
    {
        return self::$delete;
    }

    /**
     * @param array $delete
     */
    public static function setDelete($delete)
    {
        self::$delete[] = $delete;
    }
}
