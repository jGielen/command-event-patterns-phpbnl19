<?php

declare(strict_types=1);

namespace App\OurBank\Account;

use App\OurBank\Customer\CustomerId;

class Account
{
    /** @var AccountId */
    private $accountId;

    /** @var CustomerId */
    private $customerId;

    /** @var int */
    private $balance;

    public function __construct(
        AccountId $accountId,
        CustomerId $customerId,
        int $balance
    ) {
        $this->accountId  = $accountId;
        $this->customerId = $customerId;
        $this->balance    = $balance;
    }

    public function getAccountId(): AccountId
    {
        return $this->accountId;
    }

    public function getCustomerId(): CustomerId
    {
        return $this->customerId;
    }

    public function getBalance(): int
    {
        return $this->balance;
    }

    ///
    /// Internal methods for dumbJson
    ///

    public function serialize(): array
    {
        return [
            '__className' => get_class($this),
            'accountId'   => $this->accountId->getId(),
            'customerId'  => $this->customerId->getId(),
            'balance'     => $this->balance,
        ];
    }

    public static function deserialize(array $data): self
    {
        return new self(
            new AccountId($data['customerId']),
            new CustomerId($data['customerId']),
            $data['balance']
        );
    }

    public function getEntityId(): string
    {
        return $this->accountId->getId();
    }
}