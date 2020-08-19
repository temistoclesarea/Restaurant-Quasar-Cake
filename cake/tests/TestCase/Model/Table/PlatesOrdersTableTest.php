<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PlatesOrdersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PlatesOrdersTable Test Case
 */
class PlatesOrdersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PlatesOrdersTable
     */
    public $PlatesOrders;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.PlatesOrders',
        'app.Orders',
        'app.Restaurants',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('PlatesOrders') ? [] : ['className' => PlatesOrdersTable::class];
        $this->PlatesOrders = TableRegistry::getTableLocator()->get('PlatesOrders', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PlatesOrders);

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
