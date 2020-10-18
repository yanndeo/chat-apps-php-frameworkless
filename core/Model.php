<?php

namespace app\core;

abstract class Model
{

    //What rules we need ?
    public const RULE_REQUIRED = "required";
    public const RULE_EMAIL = 'email';
    public const RULE_MIN = "min";
    public const RULE_MAX = "max";
    public const RULE_UNIQUE = "unique";
    public const RULE_MATCH = "match";


    /**
     * set Attribute class instance
     * with value passed in array
     * @param [type] $data
     * @return void
     */
    public function loadData($data)
    {
        foreach ($data as $attribute => $value) {

            if (property_exists($this, $attribute)) {

                $this->{$attribute} = $value; //use setter to filled value in properties
            }
        }

    }


    abstract public function rules(): array;

    public array $errors = [];




    public function validate(): bool
    {
        //each attributes correspond to multiple rules
        foreach ($this->rules() as $attribute => $rules) {

            $valueAttr = $this->{$attribute}; //literal // take of this attribute

            foreach ($rules as $rule) {

                $ruleName = $rule;

                //Helper::dump($rule);

                if (!is_string($rule)) {
                    $ruleName = $rule[0];
                }

                //check required value
                if ($ruleName === self::RULE_REQUIRED && !$valueAttr) {
                    $this->addErrorForRule($attribute, self::RULE_REQUIRED);
                }
                //check validate email
                if ($ruleName === self::RULE_EMAIL && !filter_var($valueAttr, FILTER_VALIDATE_EMAIL)) {
                    $this->addErrorForRule($attribute, self::RULE_EMAIL);
                }
                //check min value
                if ($ruleName === self::RULE_MIN && strlen($valueAttr) < $rule['min']) {
                    $this->addErrorForRule($attribute, self::RULE_MIN, $rule);
                }
                //check max value
                if ($ruleName === self::RULE_MAX && strlen($valueAttr) > $rule['max']) {
                    $this->addErrorForRule($attribute, self::RULE_MAX, $rule);
                }
                //check match value with an other value
                if ($ruleName === self::RULE_MATCH && $valueAttr !== $this->{$rule['match']} ){
                    $this->addErrorForRule($attribute, self::RULE_MATCH, $rule);
                }
                if($ruleName === self::RULE_UNIQUE){
                    $uniqAttr = $attribute;
                    $manager = $rule['class'];
                    $tableName = $manager::$table;
                    $sql = "SELECT * FROM $tableName WHERE $uniqAttr = :uniqAttr";
                    $record = $manager->db->prepareWithoutClass($sql, ['uniqAttr' => $valueAttr]);
                    if ($record !== false ){
                       //Helper::dump($record);
                        $this->addErrorForRule($attribute, self::RULE_UNIQUE, ['field' => $attribute ]);

                    }
                }


                /*  echo '<pre> ';
                var_dump($ruleName);
                echo '</pre>'; */
            }
        }

        return empty($this->errors);
    }


    /**
     * Undocumented function
     *
     * @param string $attribute
     * @param string $rule
     */
    public function addErrorForRule(string $attribute, string $rule, $params = [])
    {
        $message = $this->errorMessages()[$rule] ?? '';

        foreach ($params as $key => $value) {
            $message = str_replace("{{$key}}", $value, $message);
        }
        
        $this->errors[$attribute][] = $message;  //[$attribute][all messages] 
    }


    /**
     * @param string $attribute
     * @param string $message
     * @return string
     */
    public function addError(string $attribute, string $message)
    {
        return $this->errors[$attribute][] = $message;
    }



    /**
     * Check error by attribute
     * @param string $attribute
     */
    public function hasError(string $attribute)
    {
        return $this->errors[$attribute] ?? false;
    }



    /**
     * Get the 1er error in array errors
     * @param string $attribute
     */
    public function getFirstError(string $attribute)
    {
        return $this->errors[$attribute][0] ?? false ;
    }


    /**
     * Messages linked rule type
     * @return array
     */
    public function errorMessages(): array
    {
        return [
            self::RULE_REQUIRED => 'This field is required',
            self::RULE_EMAIL => 'This field must be valid email address',
            self::RULE_MIN => 'Min length of this field must be {min}',
            self::RULE_MAX => 'Max length of this field must be {max}',
            self::RULE_MATCH => 'This field must be the same as {match}',
            self::RULE_UNIQUE => 'This {field} has already used. Must be unique.',
        ];
    }
}
