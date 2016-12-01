<?php

namespace Profman\Profile;

class Member
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $firstName;

    /**
     * @var string
     */
    protected $lastName;

    /**
     * @var array
     */
    protected $validators;

    /**
     * Member constructor.
     *
     * @param array $validators
     */
    public function __construct(array $validators = [])
    {
        $this->validators = $validators;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return Member
     */
    public function setId(string $id): Member
    {
        if (array_key_exists('uuid', $this->validators) && !$this->validators['uuid']->isValid(['uuid' => $id])) {
            throw new \InvalidArgumentException('Wrong format of UUID!');
        }
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     * @return Member
     */
    public function setFirstName(string $firstName): Member
    {
        if (array_key_exists('string', $this->validators)) {
            throw new \InvalidArgumentException(
                'We don\'t recognize your first name as a name, please check again.'
            );
        }

        if (!$this->validators['string']->isValid(['string' => $firstName])) {
            throw new \InvalidArgumentException(
                'We don\'t recognize your first name as a name, please check again.'
            );
        }
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     * @return Member
     */
    public function setLastName(string $lastName): Member
    {
        if (array_key_exists('string', $this->validators)) {
            throw new \InvalidArgumentException(
                'We don\'t recognize your last name as a name, please check again.'
            );
        }
        if (!$this->validators['string']->isValid(['string' => $lastName])) {
            throw new \InvalidArgumentException(
                'We don\'t recognize your last name as a name, please check again.'
            );
        }
        $this->lastName = $lastName;
        return $this;
    }
}
