<?php

/**
 *
 * MIT License
 *
 * Copyright (c) 2019 Heinrich Schiller
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

namespace ProjectPlanner\Model;

use ProjectPlanner\Util\Collection;

class TaskModel extends BaseModel implements ModelInterface 
{
    /**
     * Id
     * 
     * @var integer
     */
    private $_id = 0;
    
    /**
     * Title
     * 
     * @var string
     */
    private $_title = '';
    
    /**
     * Description
     * 
     * @var string
     */
    private $_desc = '';
    
    /**
     * Begin
     * 
     * @var string
     */
    private $_begin = '';
    
    /**
     * End
     * 
     * @var string
     */
    private $_end = '';
    
    /**
     * Creator Id
     * 
     * @var integer
     */
    private $_creatorId = 0;
    
    /**
     * Priority Id
     * 
     * @var integer
     */
    private $_priorityId = 0;
    
    /**
     * Status Id
     * 
     * @var integer
     */
    private $_statusId = 0;
    
    /**
     * Contact Id
     * 
     * @var integer
     */
    private $_contactId = 0;
    
    /**
     * Project Id
     * 
     * @var integer
     */
    private $_projectId = 0;
    
    /**
     * Created at
     * 
     * @var string
     */
    private $_createdAt = '';
    
    /**
     * Updated At
     * 
     * @var string
     */
    private $_updatedAt = '';
    
    /**
     * Project Title
     * 
     * @var string
     */
    private $_projectTitle = '';

    /**
     * Get the value of _id
     * 
     * @return self
     */
    public function getId(): int
    {
        return $this->_id;
    }

    /**
     * Set the value of _id
     * 
     * @param int $id - The id of a task.
     */
    public function setId(int $id)
    {
        $this->_id = $id;
    }

    /**
     * Get the value of _title
     * 
     * @return self
     */
    public function getTitle(): string
    {
        return $this->_title;
    }

    /**
     * Set the value of _title
     * 
     * @param string $title - The title of a task.
     */
    public function setTitle(string $title)
    {
        $this->_title = $title;
    }

    /**
     * Get the value of _desc
     * 
     * @return self
     */ 
    public function getDesc(): string
    {
        return $this->_desc;
    }

    /**
     * Set the value of _desc
     *
     * @param string $desc - The description of a task.
     */ 
    public function setDesc(string $desc)
    {
        $this->_desc = $desc;
    }

    public function getBegin()
    {
        return $this->_beginAt;
    }

    public function setBegin(string $date)
    {
        $this->_beginAt = $date;
    }

    public function getEnd()
    {
        return $this->_endAt;
    }

    public function setEnd(string $date)
    {
        $this->_endAt = $date;
    }

    public function getCreatorId(): int
    {
        return $this->_creatorId;
    }

    public function setCreatorId(int $id)
    {
        $this->_creatorId = $id;
    }

    public function getPriorityId(): int
    {
        return $this->_priority;
    }

    public function setPriorityId(int $id)
    {
        $this->_priorityId = $id;
    }

    public function getStatusId(): int
    {
        return $this->_statusId;
    }

    public function setStatusId(int $id)
    {
        $this->_statusId = $id;
    }

    public function getContactId(): int
    {
        return $this->_contactId;
    }

    public function setContactId(int $id)
    {
        $this->_contactId = $id;
    }

    public function getProjectId(): int
    {
        return $this->_projectId;
    }

    public function setProjectId(int $id)
    {
        $this->_projectId = $id;
    }

    public function getCreatedAt()
    {
        return $this->_createdAt;
    }

    public function setCreatedAt($date)
    {
        $this->_createdAt = $date;
    }

    public function getUpdatedAt()
    {
        return $this->_updatedAt;
    }

    public function setUpdatedAt($date)
    {
        $this->_updatedAt = $date;
    }

    public function getProjectTitle(): string
    {
        return $this->_projectTitle;
    }

    public function setProjectTitle(string $title)
    {
        $this->_projectTitle;
    }

    public function create()
    {

    }

    public function read()
    {
        $taskModel = new TaskModel;
        echo $taskModel->getId();
    }

    public function readAll()
    {
        $sql = '
        SELECT `tasks`.`id`,
        	`tasks`.`title`,
            `tasks`.`desc`,
            UNIX_TIMESTAMP(`tasks`.`begin`) as begin,
            UNIX_TIMESTAMP(`tasks`.`end`) as end,
            `priority`.`desc` as priority,
            `status`.`desc` as status,
            `tasks`.`contact_id`,
            `tasks`.`project_id`,
            UNIX_TIMESTAMP(`tasks`.`created_at`) as created_at,
            `tasks`.`updated_at`,
            `projects`.`title` as projectTitle
            FROM `tasks`
            LEFT JOIN `priority` ON `priority`.`id` = `tasks`.`priority`
            LEFT JOIN `status` ON `status`.`id` = `tasks`.`status`
            LEFT JOIN `projects` ON `projects`.`id` = `tasks`.`project_id`
                WHERE `tasks`.`status` != 4 
                    AND `tasks`.`status` != 5
        ';

        $stmt = $this->getDatabaseConnection()->query($sql);

        $collection = new Collection;
        while ($row = $stmt->fetch(\PDO::FETCH_OBJ)) {
            $taskModel = new TaskModel;
            $taskModel->fetchAll($row);

            $collection->add($taskModel);
        }

        return $collection;
    }

    public function update()
    {

    }

    public function delete()
    {

    }
}