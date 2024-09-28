<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class TaskFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    public $relations = [];

    // Filter by category ID
    public function category($id)
    {
        return $this->where('category_id', $id);
    }

    // Search filter (by title or description)
    public function search($search)
    {
        return $this->where(function ($q) use ($search) {
            return $q->where('title', 'LIKE', "%$search%")
                ->orWhere('description', 'LIKE', "%$search%");
        });
    }

    // Filter by task status (e.g. pending, in_progress, completed)
    public function status($status)
    {
        return $this->where('status', $status);
    }

    // Filter by task priority (e.g. low, medium, high)
    public function priority($priority)
    {
        return $this->where('priority', $priority);
    }

    public function dueDate($dueDate)
    {
        return $this->where('due_date','>=', $dueDate);
    }




    // Filter tasks that have a reminder time set
    public function hasReminder($hasReminder)
    {
        return $hasReminder
            ? $this->whereNotNull('reminder_time')
            : $this->whereNull('reminder_time');
    }
}
