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

namespace App\Modules\Task\Controller;

use App\Helper\PriorityListHelper;
use App\Helper\StatusListHelper;
use App\Library;
use App\Library\Application;
use App\Library\Controller;


class Task extends Controller{
    private $_model = null;

    public function __construct()
    {
        $this->_model = $this->model(new \App\Modules\Task\Model\TaskModel);
    }

    /**
     * Shows all active tasks.
     */
    public function index(): void
    {
        $tasks = $this->_model->getAllActiveTasks();

        $this->render('task/index', ['tasks' => $tasks->toArray()]);
    }

    public function create(): void
    {
        $this->render('/task/create');
    }

    public function read($id): void
    {
        $task = $this->_model->read($id);

        $this->render('/task/read', $task);
    }

    public function update(): void
    {
        $this->_model->update($_POST);

        Application::redirect('tasks');
    }

    public function deleten(): void
    {
        $this->render('/task/delete');
    }

    public function new(): void
    {
        $this->render('/task/new');
    }

    public function edit($id): void
    {
        $task = $this->_model->read($id);

        $data = [
            'task' => $task,
            'statusList' => StatusListHelper::get(),
            'priorityList' => PriorityListHelper::get()
        ];

        $this->render('/task/edit', $data);
    }
}