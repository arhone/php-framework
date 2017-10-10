<?php declare(strict_types = 1);
namespace arhone\framework;
use arhone\builder\Builder;
use arhone\cache\Cache;
use arhone\trigger\Trigger;
use arhone\tpl\Tpl;

/**
 * Arhone Framework
 *
 * Class Model
 * @package arhone\framework
 */
class Model {

    /**
     * Конфигурация класса
     *
     * @var array
     */
    protected $config = [
        'directory' => [
            'extension' => __DIR__ . '/../../../web/extension',
            'module'    => __DIR__ . '/../../../web/module',
            'template'  => __DIR__ . '/../../../web/template',
        ]
    ];

    /**
     * @var $Builder Builder
     * @var $Cache Cache
     * @var $Trigger Trigger
     * @var $Tpl Tpl
     */
    protected $Builder;
    protected $Cache;
    protected $Trigger;
    protected $Tpl;

    /**
     * Controller constructor.
     *
     * @param Builder $Builder
     * @param Cache $Cache
     * @param Trigger $Trigger
     * @param Tpl $Tpl
     */
    public function __construct (Builder $Builder, Cache $Cache, Trigger $Trigger,  Tpl $Tpl) {

        $this->Builder = $Builder;
        $this->Cache = $Cache;
        $this->Trigger = $Trigger;
        $this->Tpl     = $Tpl;

    }

    /**
     *
     */
    protected function searchConfigurationFiles () {

        foreach (array_diff(scandir($this->config['directory']['module']), ['..', '.']) as $module) {

            if (is_dir($this->config['directory']['module'] . '/' . $module . '/config')) {

                foreach (array_diff(scandir($this->config['directory']['module'] . '/' . $module . '/config'), ['..', '.']) as $config) {

                    if ($config == 'builder.php') {
                        $this->Builder->instruction(include $this->config['directory']['module'] . '/' . $module . '/config/builder.php');
                    } elseif ($config == 'config.php') {
                        //$this->Config->add(include $this->config['directory']['module'] . '/' . $module . '/config/config.php');
                    } elseif ($config == 'handler.php') {

                        $handlerList = include $this->config['directory']['module'] . '/' . $module . '/config/handler.php';
                        foreach ($handlerList as $action => $instruction) {

                            $this->Trigger->add($action, function ($match, $data) use ($instruction, $container) {

                                if (isset($instruction['controller']) && isset($instruction['method'])) {

                                    $Module = $container->Builder->make($instruction['controller']);
                                    $data = $Module->{$instruction['method']}(...array_intersect_key($match, array_flip($instruction['argument'] ?? array_flip($match))));

                                    if (isset($instruction['blog']) && is_string($data)) {

                                        $container->Tpl->variable($instruction['blog'], $data);

                                    } elseif (is_object($data)) {

                                        return 'response';

                                    }

                                }

                            });

                        }

                    }

                }

            }

        }

    }

    /**
     * Автозагрузка классов
     */
    protected function autoload () {

        spl_autoload_register(function ($className) {

            $directory[] = $this->config['directory']['extension'];
            $directory[] = $this->config['directory']['module'];
            foreach ($directory as $dir) {

                $file = $dir . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $className) . '.php';

                if(is_file($file)) {

                    include_once $file;
                    break;

                }

            }

        });
    }

}