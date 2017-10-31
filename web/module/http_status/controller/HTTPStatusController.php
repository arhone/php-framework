<?php
namespace http_status\controller;
use \arhone\template\Template;

/**
 * Class HTTPStatusController
 * @package http_status\controller
 */
class HTTPStatusController {

    /**
     * @var $Template \arhone\template\Template
     */
    protected $Template;

    /**
     * HTTPStatusController constructor.
     *
     * @param Template $Template
     */
    public function __construct (Template $Template) {

        $this->Template = $Template;

    }

    /**
     * @param $code
     * @return string
     */
    public function code ($code) {

        if (method_exists($this, 'code' . (int)$code)) {
            return $this->{'code' . (int)$code}();
        } else {
            return $this->code0();
        }

    }

    /**
     * @return string
     */
    public function code404 () {

        return $this->Tpl->get(__DIR__ . '/../template/error.tpl', [
            'title'   => 'Страница не найдена',
            'message' => 'Страница не найдена :('
        ]);

    }

    /**
     * @return string
     */
    public function code0 () {

        return $this->Tpl->get(__DIR__ . '/../template/error.tpl', [
            'title'   => 'Неизвестная ошибка',
            'message' => 'Ой :('
        ]);

    }

}