<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * JourenyParticipants Model
 *
 * @property \App\Model\Table\JourneysTable&\Cake\ORM\Association\BelongsTo $Journeys
 *
 * @method \App\Model\Entity\JourenyParticipant newEmptyEntity()
 * @method \App\Model\Entity\JourenyParticipant newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\JourenyParticipant[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\JourenyParticipant get($primaryKey, $options = [])
 * @method \App\Model\Entity\JourenyParticipant findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\JourenyParticipant patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\JourenyParticipant[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\JourenyParticipant|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\JourenyParticipant saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\JourenyParticipant[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\JourenyParticipant[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\JourenyParticipant[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\JourenyParticipant[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class JourenyParticipantsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('joureny_participants');
        $this->setDisplayField('user_id');
        $this->setPrimaryKey('user_id');

        $this->belongsTo('Journeys', [
            'foreignKey' => 'journey_id',
            'joinType' => 'INNER',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('user_id')
            ->allowEmptyString('user_id', null, 'create');

        $validator
            ->integer('accepted')
            ->notEmptyString('accepted');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['journey_id'], 'Journeys'), ['errorField' => 'journey_id']);

        return $rules;
    }
}
