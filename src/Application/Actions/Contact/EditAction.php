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

namespace App\Application\Actions\Contact;

use App\Domain\Contact\Service\ContactEditor;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class EditAction
{
    /**
     * @Injection
     * @var ContactEditor
     */
    private ContactEditor $contactEditor;

    /**
     * @Injection
     * @var ContainerInterface
     */
    private $ci;

    /**
     * The constructor
     * 
     * @param ContactEditor $contactEditor
     * @param ContainerInterface $ci;
     */
    public function __construct(ContactEditor $contactEditor, ContainerInterface $ci)
    {
        $this->contactEditor = $contactEditor;
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
        $contact = $this->contactEditor->readContact($args['id']);

        $html = $this->ci->get('view')->render('contact/edit', $contact);
        $response->getBody()->write($html);

        return $response;
    }
}