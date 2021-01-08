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

declare(strict_types = 1);

namespace App\Application\Actions\Contact;

use App\Domain\Contact\Service\ContactFinder;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class ContactAction
{
    /**
     * @Injection
     * @var ContactFinder
     */
    private ContactFinder $contactFinder;

    /**
     * @Injection
     * @var ContainerInterface
     */
    private $ci;

    /**
     * The constructor
     * 
     * @param ContactFinder $contactFinder
     * @param ContainerInterface $ci
     */
    public function __construct(ContactFinder $contactFinder, ContainerInterface $ci)
    {
        $this->contactFinder = $contactFinder;
        $this->ci = $ci;
    }
    
    /**
     * The invoker
     * 
     * @param Request $request
     * @param Response $response
     * @param array $args
     * 
     * @return Response
     */
    public function __invoke(Request $request, Response $response, $args = []): Response
    {
        $contacts = $this->contactFinder->findAll();

        $hasContacts = !empty($contacts) ? true : false;

        $data = [
            'contacts' => $contacts,
            'hasContacts' => $hasContacts,
        ];

        $html = $this->ci->get('view')->render('contact/index', $data);
        $response->getBody()->write($html);

        return $response;
    }
}