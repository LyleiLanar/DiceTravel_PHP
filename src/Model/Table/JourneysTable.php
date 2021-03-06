<?php
declare(strict_types=1);

namespace App\Model\Table;

use App\Model\Domain\Constants;
use App\Model\Entity\Journey;
use App\Model\Entity\User;
use ArrayObject;
use Cake\Datasource\EntityInterface;
use Cake\Event\EventInterface;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Journeys Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\JourenyParticipantsTable&\Cake\ORM\Association\HasMany $JourenyParticipants
 * @property \App\Model\Table\TripsTable&\Cake\ORM\Association\HasMany $Trips
 *
 * @method \App\Model\Entity\Journey newEmptyEntity()
 * @method \App\Model\Entity\Journey newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Journey[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Journey get($primaryKey, $options = [])
 * @method \App\Model\Entity\Journey findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Journey patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Journey[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Journey|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Journey saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Journey[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Journey[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Journey[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Journey[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class JourneysTable extends Table
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

        $this->setTable('journeys');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp',
            ['events' =>
                ['Model.beforeSave' =>
                    ['start_date' => 'new']
                ]
            ]);

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('JourenyParticipants', [
            'foreignKey' => 'journey_id',
        ]);
        $this->hasMany('Trips', [
            'foreignKey' => 'journey_id',
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
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('title', Constants::createValidationErrorMessage('title', Constants::NOT_SCALAR))
            ->maxLength('title', 50, Constants::createValidationErrorMessage('title', Constants::MAX_LENGTH))
            ->notEmptyString('title', Constants::createValidationErrorMessage('title', Constants::REQUIRED));

        $validator
            ->scalar('start_location', Constants::createValidationErrorMessage('start location', Constants::NOT_SCALAR))
            ->maxLength('start_location', 20, Constants::createValidationErrorMessage('start location', Constants::MAX_LENGTH))
            ->requirePresence('start_location', 'create', Constants::createValidationErrorMessage('start location', Constants::REQUIRED))
            ->notEmptyString('start_location', Constants::createValidationErrorMessage('start location', Constants::REQUIRED));

        $validator
            ->dateTime('start_date')
            ->notEmptyDateTime('start_date');

        $validator
            ->integer('closed')
            ->notEmptyString('closed');

        $validator
            ->integer('visibility', Constants::createValidationErrorMessage('visibility', Constants::BE_INTEGER))
//          ->notEmptyString('visibility', Constants::createValidationErrorMessage('visibility', Constants::REQUIRED))
            ->add('visibility', 'visibilityRule', ['rule' => function ($value, array $context) {
                return in_array($value, Journey::VISIBILITIES);
            }, 'message' => Constants::createValidationErrorMessage('visibility', Constants::INVALID_VISIBILITY)]);

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
        $rules->add($rules->existsIn(['user_id'], 'Users'), ['errorField' => 'user_id']);
        return $rules;
    }


    public function beforeSave(EventInterface $event, EntityInterface $entity, ArrayObject $options)
    {
        /**
         * @var Journey $entity
         */

        if (!$entity->user_id) {
            $entity->user_id = 70;
        };
        if (!$entity->closed) {
            $entity->closed = 0;
        }
    }
}
