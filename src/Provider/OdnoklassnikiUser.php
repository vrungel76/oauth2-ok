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

    /**+
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->getField('name');
    }

    /**
     * @return string|null
     */
    public function getFirstName(): ?string
    {
        return $this->getField('first_name');
    }

    /**
     * @return string|null
     */
    public function getLastName(): ?string
    {
        return $this->getField('last_name');
    }

    /**
     * @return string|null
     */
    public function getBirthday(): ?string
    {
        return $this->getField('birthday');
    }

    /**
     * @return string|null
     */
    public function getAge(): ?string
    {
        return $this->getField('age');
    }

    /**
     * @return string|null
     */
    public function getCity(): ?string
    {
        $location = $this->getField('location');
        return $location['city'] ?? null;
    }

    /**
     * @return string|null
     */
    public function getCountry(): ?string
    {
        $location = $this->getField('location');
        return $location['country'] ?? null;
    }

    /**
     * @return string|null
     */
    public function getCountryCode(): ?string
    {
        $location = $this->getField('location');
        return $location['countryCode'] ?? null;
    }

    /**
     * @return string|null
     */
    public function getCountryName(): ?string
    {
        $location = $this->getField('location');
        return $location['countryName'] ?? null;
    }

    /**
     * @return string|null
     */
    public function getGender(): ?string
    {
        return $this->getField('gender');
    }

    /**
     * @return string|null
     */
    public function getLocale(): ?string
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
    private function getField($key): ?string
    {
        return $this->data[$key] ?? null;
    }
}

