<?php

declare(strict_types=1);

namespace App\Domain\Services\Classes;

use App\Domain\Repositories\Interfaces\IAddressRepository;
use App\Domain\Services\Interfaces\IAddressService;

class AddressService implements IAddressService
{
    /**
     * @param  IAddressRepository  $addressRepository
     */
    public function __construct(protected IAddressRepository $addressRepository)
    {
    }

    public function index()
    {
        return $this->addressRepository->findAll();
    }
}
