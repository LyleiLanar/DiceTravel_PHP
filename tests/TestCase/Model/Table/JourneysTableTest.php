<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\JourneysTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\JourneysTable Test Case
 */
class JourneysTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\JourneysTable
     */
    protected $Journeys;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Journeys',
        'app.Users',
        'app.JourenyParticipants',
        'app.Trips',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Journeys') ? [] : ['className' => JourneysTable::class];
        $this->Journeys = $this->getTableLocator()->get('Journeys', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Journeys);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\JourneysTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\JourneysTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
