<?php

namespace FL\WorldUniversitiesBundle\Service;

use League\Csv\Reader;

class WorldUniversitiesService
{
    /**
     * @var array
     */
    private $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * @return Reader
     */
    public function getReader()
    {
        if (!file_exists($this->config['pathname'])) {
            throw new \RuntimeException('World universities database cannot be found');
        }

        return Reader::createFromPath($this->config['pathname']);
    }
}
