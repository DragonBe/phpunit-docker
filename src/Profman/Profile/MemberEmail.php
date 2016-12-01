<?php

namespace Profman\Profile;

class MemberEmail
{
    /**
     * @var string
     */
    protected $id;
    /**
     * @var string
     */
    protected $memberId;
    /**
     * @var string
     */
    protected $email;

    /**
     * @var array
     */
    protected $validators;

    /**
     * MemberEmail constructor.
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
     * @return MemberEmail
     * @throws \InvalidArgumentException
     */
    public function setId(string $id): MemberEmail
    {
        if (array_key_exists('uuid', $this->validators) && !$this->validators['uuid']->isValid(['uuid' => $id])) {
            throw new \InvalidArgumentException('Provided UUID "' . $id . '" is invalid.');
        }
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getMemberId(): string
    {
        return $this->memberId;
    }

    /**
     * @param string $memberId
     * @return MemberEmail
     * @throws \InvalidArgumentException
     */
    public function setMemberId(string $memberId): MemberEmail
    {
        if (array_key_exists('uuid', $this->validators) && !$this->validators['uuid']->isValid(['uuid' => $memberId])) {
            throw new \InvalidArgumentException('Provided UUID "' . $memberId . '" is invalid.');
        }
        $this->memberId = $memberId;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return MemberEmail
     */
    public function setEmail(string $email): MemberEmail
    {
        if (array_key_exists('email', $this->validators) && !$this->validators['email']->isValid(['email' => $email])) {
            throw new \InvalidArgumentException('We don\'t recognize "' . $email . '" as a valid email address.');
        }
        $this->email = $email;
        return $this;
    }
}
