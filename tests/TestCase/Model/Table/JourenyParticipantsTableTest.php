<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\JourenyParticipantsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\JourenyParticipantsTable Test Case
 */
class JourenyParticipantsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\JourenyParticipantsTable
     */
    protected $JourenyParticipants;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.JourenyParticipants',
        'app.Journeys',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('JourenyParticipants') ? [] : ['className' => JourenyParticipantsTable::class];
        $this->JourenyParticipants = $this->getTableLocator()->get('JourenyParticipants', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->JourenyParticipants);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\JourenyParticipantsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\JourenyParticipantsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
