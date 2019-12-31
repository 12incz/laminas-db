<?php

/**
 * @see       https://github.com/laminas/laminas-db for the canonical source repository
 * @copyright https://github.com/laminas/laminas-db/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-db/blob/master/LICENSE.md New BSD License
 */

namespace LaminasTest\Db\Adapter\Driver\Sqlsrv;

use Laminas\Db\Adapter\Driver\Sqlsrv\Sqlsrv;
use Laminas\Db\Adapter\Driver\Sqlsrv\Statement;

/**
 * @group integration
 * @group integration-sqlserver
 */
class StatementIntegrationTest extends \PHPUnit_Framework_TestCase
{
    protected $variables = [
        'hostname' => 'TESTS_LAMINAS_DB_ADAPTER_DRIVER_SQLSRV_HOSTNAME',
        'username' => 'TESTS_LAMINAS_DB_ADAPTER_DRIVER_SQLSRV_USERNAME',
        'password' => 'TESTS_LAMINAS_DB_ADAPTER_DRIVER_SQLSRV_PASSWORD',
    ];

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        foreach ($this->variables as $name => $value) {
            if (!getenv($value)) {
                $this->markTestSkipped('Missing required variable ' . $value . ' from phpunit.xml for this integration test');
            }
            $this->variables[$name] = getenv($value);
        }

        if (!extension_loaded('sqlsrv')) {
            $this->fail('The phpunit group integration-sqlsrv was enabled, but the extension is not loaded.');
        }
    }

    /**
     * @covers Laminas\Db\Adapter\Driver\Sqlsrv\Statement::initialize
     */
    public function testInitialize()
    {
        $sqlsrvResource = sqlsrv_connect($this->variables['hostname'], ['UID' => $this->variables['username'], 'PWD' => $this->variables['password']]);

        $statement = new Statement;
        $this->assertSame($statement, $statement->initialize($sqlsrvResource));
        unset($stmtResource, $sqlsrvResource);
    }

    /**
     * @covers Laminas\Db\Adapter\Driver\Sqlsrv\Statement::getResource
     */
    public function testGetResource()
    {
        $sqlsrvResource = sqlsrv_connect($this->variables['hostname'], ['UID' => $this->variables['username'], 'PWD' => $this->variables['password']]);

        $statement = new Statement;
        $statement->initialize($sqlsrvResource);
        $statement->prepare("SELECT 'foo'");
        $resource = $statement->getResource();
        $this->assertEquals('SQL Server Statement', get_resource_type($resource));
        unset($resource, $sqlsrvResource);
    }

    /**
     * @covers Laminas\Db\Adapter\Driver\Sqlsrv\Statement::prepare
     * @covers Laminas\Db\Adapter\Driver\Sqlsrv\Statement::isPrepared
     */
    public function testPrepare()
    {
        $sqlsrvResource = sqlsrv_connect($this->variables['hostname'], ['UID' => $this->variables['username'], 'PWD' => $this->variables['password']]);

        $statement = new Statement;
        $statement->initialize($sqlsrvResource);
        $this->assertFalse($statement->isPrepared());
        $this->assertSame($statement, $statement->prepare("SELECT 'foo'"));
        $this->assertTrue($statement->isPrepared());
        unset($resource, $sqlsrvResource);
    }

    /**
     * @covers Laminas\Db\Adapter\Driver\Sqlsrv\Statement::execute
     */
    public function testExecute()
    {
        $sqlsrv = new Sqlsrv($this->variables);
        $statement = $sqlsrv->createStatement("SELECT 'foo'");
        $this->assertSame($statement, $statement->prepare());

        $result = $statement->execute();
        $this->assertInstanceOf('Laminas\Db\Adapter\Driver\Sqlsrv\Result', $result);

        unset($resource, $sqlsrvResource);
    }
}
