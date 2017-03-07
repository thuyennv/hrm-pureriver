<?php

namespace Nht\Hocs\Core;

use Nht\Http\Requests\Request;

/**
 * An abstract class for repository.
 *
 * @author  AlvinTran
 */
abstract class BaseRepository
{
    /**
     * Get all items of model
     * @param array|bool $filter Mảng điều kiện filter, có thể add nhiều mảng, ví dụ:
     *                           [['name', 'LIKE', '%Alvin%'], ['age', '>', 30]]
     * @param array|bool $sorter Mảng điều kiện sort, ví dụ:
     *                           ['created_at', 'desc']
     * @param number|bool $paginate Phân trang.
     * @return Illuminate\Support\Collection Model collections
     */
    public function getAll($filter = false, $sorter = false, $paginate = false)
    {
        if ($filter === false && $sorter === false && $paginate === false)
        {
            return $this->model->all();
        }

        $query = $this->model->where(function($q) use ($filter) {
            if (!empty($filter)) {
                foreach ($filter as $f) {
                    list($col, $ope, $val) = $f;
                    $q->where($col, $ope, $val);
                }
            }
        });

        if ($sorter) {
            list($col, $dir) = $sorter;
            $query->orderBy($col, $dir);
        }

        return $paginate ? $query->paginate($paginate) : $query->get();
    }

    /**
     * Get item of model. If model not exist then it will throw an exception
     * @param  int $id Model ID
     * @param  bool $showException Xác định việc hiển thị Exception khi tìm kiếm
     *                             true = show exception | false = không show exception
     * @return Model
     */
    public function getById($id, $showException = true)
    {
        return $showException ?
                $this->model->findOrFail($id)
                : $this->model->find($id);
    }

    /**
     * Create a new model
     * @param  array $attributes
     * @return Bool
     */
    public function create($attributes)
    {
        return $this->model->create($attributes);
    }

    /**
     * Update an exitst model
     * @param  int $id
     * @param  array $condition
     * @return Bool
     */
    public function update($id, $attributes)
    {
        $model = $this->getById($id);
        $model->fill($attributes)->save();
        return $model;
    }

    /**
     * Delete an exist model
     * @return Bool
     */
    public function delete($id)
    {
        $model = $this->getById($id);
        return $model->delete();
    }
}
