<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PlateOptionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PlateOptionsTable Test Case
 */
class PlateOptionsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PlateOptionsTable
     */
    public $PlateOptions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.PlateOptions',
        'app.Plates',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('PlateOptions') ? [] : ['className' => PlateOptionsTable::class];
        $this->PlateOptions = TableRegistry::getTableLocator()->get('PlateOptions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PlateOptions);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
