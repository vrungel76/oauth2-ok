<?php

declare(strict_types=1);

namespace League\OAuth2\Client\Provider;

class OdnoklassnikiUser implements ResourceOwnerInterface
{
    /**
     * @var array
     */
    private $data;

    /**
     * @param array $response
     */
    public function __construct(array $response)
    {
        $this->data = $response;
    }
    /**
     * @inheritDoc
     */
    public function getId()
    {
        return $this->getField('uid');
    }

    public function getName()
    {
        return $this->getField('name');
    }

    public function getFirstName()
    {
        return $this->getField('first_name');
    }

    public function getLastName()
    {
        return $this->getField('last_name');
    }

    public function getCity()
    {
        $location = $this->getField('location');
        return $location['city'];
    }

    public function getGender()
    {
        return $this->getField('gender');
    }

    public function getLocale()
    {
        return $this->getField('locale');
    }

    /**
     * @inheritDoc
     */
    public function toArray()
    {
        return $this->data;
    }

    /**
     * Returns a field from the data.
     *
     * @param string $key
     *
     * @return string|null
     */
    private function getField($key)
    {
        return $this->data[$key] ?? null;
    }
}

