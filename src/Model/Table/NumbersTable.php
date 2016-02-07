<?php
namespace App\Model\Table;

use App\Model\Entity\Number;
use Cake\ORM\Query;
use Cake\Event\Event;
use ArrayObject;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Numbers Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 */
class NumbersTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('numbers');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->boolean('status')
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        $validator
            ->requirePresence('number', 'create')
            ->add('number', [
                'length' => [
                    'rule' => ['minLength', 10],
                    'message' => 'A Turkish phone number should be minimum 10 chars long without 0 at the beginning',
                ]
            ])
            ->notEmpty('number');

        $validator
            ->requirePresence('who', 'create')
            ->notEmpty('who');

        $validator
            ->requirePresence('comment', 'create')
            ->notEmpty('comment');

        $validator
            ->allowEmpty('photo');

        return $validator;
    }

    public function beforeMarshal(Event $event, ArrayObject $data, ArrayObject $options)
    {
        if (isset($data['number'])) {
            /*
             * Remove non numeric chars
             * Check if there is zero at beginning
             * Remove zero at the beginning
             */
            $data['number'] = $this->cleanNumber($data['number']);
        }
    }

    public function cleanNumber($number){
        $number = preg_replace( '/([^0-9])/', '', $number);
        $number = preg_replace( '/(^0*)/', '', $number) ;
        $number = substr($number, 0, 10);
        return $number;
    }
    /*
    public function get($primaryKey, $options = [])
    {
        $data = parent::get($primaryKey, $options);
        $data['number'] = "0 ".substr($data['number'],0,3)." ".substr($data['number'],3,3)." ".substr($data['number'],6,2)." ".substr($data['number'],8,2);
        return $data;
    }
    */

    public function find($type = 'all', $options = [])
    {
        $data = parent::find($type, $options);

        return $data->formatResults(function($r) {
            return $r->map(function($r) {
                $r['number'] = $this->showNumber($r['number']);
                return $r;
            });
        });
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        return $rules;
    }

    public function showNumber($number){
        $number = "0 ".substr($number,0,3)." ".substr($number,3,3)." ".substr($number,6,2)." ".substr($number,8,2);
        return $number;
    }

    public function isOwnedBy($numberId, $userId)
    {
        return $this->exists(['id' => $numberId, 'user_id' => $userId]);
    }
}
