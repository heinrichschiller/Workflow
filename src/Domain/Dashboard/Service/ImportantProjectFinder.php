<?php

/**
 *
 * MIT License
 *
 * Copyright (c) 2019-2020 Heinrich Schiller
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 *
 */

declare( strict_types = 1 );

namespace App\Domain\Dashboard\Service;

use App\Domain\Dashboard\Repository\ImportantProjectFinderRepository;

final class ImportantProjectFinder
{
    /**
     * @Inject
     * @var ImportantProjectFinderRepository
     */
    private ImportantProjectFinderRepository $repository;

    /**
     * The constructor
     * 
     * @param ImportantProjectFinderRepository $repository
     */
    public function __construct(ImportantProjectFinderRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Find all important projects
     * 
     * @return array List of projects
     */
    public function findAll(): array
    {
        return (array) $this->repository->findAll();
    }
}