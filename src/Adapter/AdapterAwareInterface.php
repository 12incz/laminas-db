<?php

/**
 * @see       https://github.com/laminas/laminas-db for the canonical source repository
 * @copyright https://github.com/laminas/laminas-db/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-db/blob/master/LICENSE.md New BSD License
 */

namespace Laminas\Db\Adapter;

interface AdapterAwareInterface
{
    /**
     * Set db adapter
     *
     * @param Adapter $adapter
     * @return AdapterAwareInterface
     */
    public function setDbAdapter(Adapter $adapter);
}
